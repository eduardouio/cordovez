var app = new Vue({
    el : '#app',
    delimiters: ['${', '}'],
    data : {
        document : JSON.parse('{{ document | json_encode() | raw }}'),
        orders : JSON.parse('{{  orders | json_encode() | raw }}'),
        partial_selected_orders: [],
        current_user : JSON.parse('{{ user | json_encode() | raw }}'),
        all_provisions : JSON.parse('{{ provisions | json_encode() | raw }}'),
        route_url : '{{ rute_url | raw }}',
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
                    console.log('Obteneniendo respuesta del server')
                    console.dir(response)
                    this.partial_selected_orders = response.data.data
                    this.http_request = false
                },error=>{
                    console.log('Error en comunicarse con el server')
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
            this.saldo_provision = (current_provision.valor_provisionado - current_provision.valor_justificado)
            this.current_provision = current_provision
        },
        change_justify_value(){
            this.saldo_provision = (this.current_provision.valor_provisionado - this.current_provision.valor_justificado) - this.value_justify
            if (this.saldo_provision < 0){
                console.log('Se marca como activo el ajuste de la provision')
                this.generar_ajuste = true;    
            }
        },
        generar_provision(){
            console.log('Generamos una provision de valor Cero para poder Cerrar la factura')
            this.generar_ajuste = true;
            this.current_not_provision.concepto = 'AJUSTE NO PROVISIONADO ' +  this.current_not_provision.concepto
            if (this.current_not_provision.id_parcial === 0){
                this.current_not_provision.tipo = 'INICIAL'
            }else{
                this.current_not_provision.tipo = 'NACIONALIZACION'
            }

            this.$http.post('{{rute_url}}gstnacionalizacion/putExpenseAJAX/', this.current_not_provision).then(
                response => {
                    console.log('Solicitud regisrada correctamente')
                    console.dir(response)
                    this.current_provision.id_gastos_nacionalizacion = response.data.id_gastos_nacionalizacion
                    this.value_justify = 0
                    this.saldo_provision = this.current_not_provision.valor_ajuste
                    this.guardar_justificacion()
                },
                error =>{
                    console.log('Error en la solicitud al servidor')
                    console.dir(error)
                }
            )
        },
        guardar_justificacion(){
            var data = {
                id_documento_pago: this.document.id_documento_pago,
                id_gastos_nacionalizacion : this.current_provision.id_gastos_nacionalizacion,
                valor : this.value_justify,
                valor : 0,
            }

            if(this.generar_ajuste === true){
                data.valor = this.saldo_provision
            }

            this.$http.post('{{rute_url}}detallefacpago/validar/', data).then(response => {
                console.log('Solicitud regisrada correctamente')
                console.dir(response)
                location.reload()
            }, error => {
                     console.log('error en solicitud al servidor')
                     console.dir(error)
                     alert('Se produjo un error, por favor recargue la página');
                 });
          },
          eliminar(item){
              this.$http.get('{{rute_url}}detallefacpago/eliminar/' + item.id_detalle_documento_pago).then(response => {
                     location.reload();
                   }, response => {
                        console.log('error en solicitud al servidor')
                        console.dir(response)
                       alert('Se produjo un error, por favor recargue la página');
                   });
          }
    },
    computed : {
        total_justificado() {
            justificado = 0.0;
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