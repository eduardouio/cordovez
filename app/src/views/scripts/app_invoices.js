const img = '{{ provisions | json_encode() | raw }}';

var app = new Vue({
    el : '#app',
    delimiters: ['${', '}'],
    data : {
        document : JSON.parse('{{ document | json_encode() | raw }}'),
        orders : JSON.parse('{{  orders | json_encode() | raw }}'),
        partial_selected_orders: [],
        current_user : JSON.parse('{{ user | json_encode() | raw }}'),
        all_provisions : {{ provisions | json_encode() | raw }},
        route_url : '{{ rute_url | raw }}',
        show_error : false,
        error_message : '',
        http_request : false,
        paids_invoice : 0,
        value_justify : 0.0,
        no_provisionado : false,
        generar_ajuste : false,
        selected_item : '',
        current_provision : {},
        current_not_provision : {
            nro_pedido:null,
            id_parcial:0,
            concepto:"",
            tipo:null,
            valor_provisionado:0,
            valor_ajuste : 0,
            fecha:null,
            fecha_fin:null,
            comentarios:null,
            bg_closed : 1,
            identificacion_proveedor :  0,
            id_user : parseInt('{{ user.id_user }}'),
        },
        selected_provision : null ,
        current_order_provisions : [],
        saldo_provision : 0,
    },
    methods : {
        select_order() {
            var current_order = [];
            var x = this.selected_item
            this.all_provisions.forEach(function(item){
                if(item.nro_pedido === x){
                    current_order.push(item)
                }
            })
            this.current_order_provisions = current_order
        },
        show_partials(){
            this.partial_selected_orders = []
            this.http_request = true
            console.log('Mostrando los parciales disponibles en el pedido')
            this.$http.get('{{rute_url}}parcial/all_partials/' + this.current_not_provision.nro_pedido).then(
                response=>{
                    this.partial_selected_orders = response.data.data
                    this.http_request = false
                    console.dir(response)
                },error=>{
                    this.show_error = true
                    this.error_message = 'Error al obtener los paciales del pedido'
                    this.http_request = false
                    console.dir(error)
                })
        },
        select_provision(){
            var current_provision = {}
            var x = this.selected_provision
            this.all_provisions.forEach(function(item){
                if(item.id_gastos_nacionalizacion === x ){
                    current_provision = item
                }
            })
            this.saldo_provision = (current_provision.valor_provisionado - current_provision.valor_justificado - current_provision.valor_ajuste)
            this.current_provision = current_provision
        },
        change_justify_value(){
            this.saldo_provision = (this.current_provision.valor_provisionado - this.current_provision.valor_justificado) - this.value_justify
            if (this.saldo_provision < 0){
                this.generar_ajuste = true;    
            }
        },
        generar_provision(){
            console.log('Generamos una provision de valor Cero para poder Cerrar la factura')
            this.generar_ajuste = true;
            this.current_not_provision.concepto = 'AJUSTE NO PROVISIONADO ' +  this.current_not_provision.concepto
            if (this.current_not_provision.id_parcial === 0){
                this.current_not_provision.tipo = 'INICIAL'
                this.current_not_provision.id_parcial = 0
            }else{
                this.current_not_provision.tipo = 'NACIONALIZACION'
                this.current_not_provision.nro_pedido = '000-00'
            }
            this.current_not_provision.valor_ajuste =  this.current_not_provision.valor_ajuste * -1
            this.http_request = true
            this.$http.post('{{rute_url}}gstnacionalizacion/putExpenseAJAX/', this.current_not_provision).then(
                response => {
                    console.dir(response)
                    this.http_request = false
                    this.current_provision.id_gastos_nacionalizacion = response.data.id_gastos_nacionalizacion
                    this.value_justify = 0
                    this.saldo_provision = this.current_not_provision.valor_ajuste
                    this.http_request = false
                    this.guardar_justificacion()
                },
                error => {
                    this.http_request = false
                    this.show_error = true
                    this.error_message = 'No fue posible generar la provision'
                    console.dir(error)
                }
            )
        },
        actualizar_provision(){
            if(this.generar_ajuste === false){
                console.log('No se realiza el cambio de la provision')
                return false
            }
            var valor_ajuste = this.saldo_provision
            console.log('actualizamos la provision actual')
            const provision = {
                id_gastos_nacionalizacion : this.current_provision.id_gastos_nacionalizacion,
                valor_ajuste : (this.generar_ajuste ? valor_ajuste : 0) 
            }
            this.http_request = true
            this.$http.post('{{ rute_url }}gstnacionalizacion/updateExpense/', provision).then(
                response => {
                    console.log('Se ha modificado el gasto de nacionalizacion')
                    console.dir(response)
                    this.http_request = false
                },error =>{
                    console.dir(error)
                    this.error_message = 'No es posible actualizar el gasto de nacionalizacion'
                    this.show_error = true
                    this.http_request = false
                })
        },
        guardar_justificacion(){
            console.log('Preparandose para registrar la justificaciom')
            var data = {
                id_documento_pago: this.document.id_documento_pago,
                id_gastos_nacionalizacion : this.current_provision.id_gastos_nacionalizacion,
                valor : this.value_justify,
                valor_ajuste :0,
            }

            if(this.generar_ajuste === true && this.no_provisionado === false){
                console.log('Se generara Ajuste en el gastos de nacionalizacion, actualizamos el gasto')
                data.valor_ajuste = this.saldo_provision
            }
            
            if(this.no_provisionado){
                data.valor = this.current_not_provision.valor_ajuste * -1
                data.valor_ajuste = this.current_not_provision.valor_ajuste
            }

            console.dir(data)
            this.actualizar_provision()
            this.$http.post('{{rute_url}}detallefacpago/validar/', data).then(response => {
                console.dir(response)
                this.http_request = false
                if(this.show_error === false){
                    location.reload()
                }
            }, error => {
                     this.show_error = true
                     this.error_message = 'No es posible actualizar el gasto'
                     this.http_request = false
                     console.dir(error)
                 });
          },
          eliminar(item){
              this.$http.get('{{rute_url}}detallefacpago/eliminar/' + item.id_detalle_documento_pago).then(response => {
                    console.log('Se ha eliminado la justificacion')        
                     location.reload()
                   }, response => {
                        console.log('error en solicitud al servidor')
                        console.dir(response)
                       alert('Se produjo un error, por favor recargue la página');
                   });
          }
    },
    computed : {
        total_justificado() {
            justificado = 0.0
            this.document.invoiceDetails.details.forEach(function(item){
                justificado += parseFloat(item.valor)
            })
            return justificado
        },
        valor_pendiente() {
            return (this.document.valor - this.total_justificado)
        },
        class_color(){
            if(this.saldo_provision > 0){
                return 'text-center text-primary'
            }
            if(this.saldo_provision < 0){
                return 'text-center text-danger'
            }
            if(this.saldo_provision === 0){
                return 'text-center text-success'
            }
        },
        class_simbol(){
            if(this.saldo_provision > 0){
                return 'pull-right text-primary fa fa-warning'
            }
            if(this.saldo_provision < 0){
                return 'pull-right text-danger fa fa-ban'
            }
            if(this.saldo_provision === 0){
                return 'pull-right text-success fa fa-check'
            }
        }
    },
    filters : {
        money(number){
            return(parseFloat(number).toFixed(2))
        }
    },
})