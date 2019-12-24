var app = new Vue({
    el : '#app',
    delimiters: ['${', '}'],
    data : {
        document : JSON.parse('{{ document | json_encode() | raw }}'),
        orders : JSON.parse('{{  orders | json_encode() | raw }}'),
        current_user : JSON.parse('{{ user | json_encode() | raw }}'),
        all_provisions : JSON.parse('{{ provisions | json_encode() | raw }}'),
        route_url : '{{ rute_url | raw }}',
        paids_invoice : 0,
        value_justify : 0.0,
        selected_item : '',
        current_provision : {},
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
        },

        guardar_justificacion(){
            var data = {
                id_documento_pago: this.document.id_documento_pago,
                id_gastos_nacionalizacion : this.current_provision.id_gastos_nacionalizacion,
                valor : this.value_justify
            }
            this.$http.post('{{rute_url}}detallefacpago/validar/', data).then(response => {
                   location.reload();
                 }, response => {
                     alert('Se produjo un error, por favor recargue la página');
                 });
          },
          eliminar(item){
              this.$http.get('{{rute_url}}detallefacpago/eliminar/' + item.id_detalle_documento_pago).then(response => {
                     location.reload();
                   }, response => {
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