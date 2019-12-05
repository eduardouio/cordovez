var app = new Vue({
    el : '#app_liquidaciones',
    delimiters: ['${', '}'],
    data : {
      init_data : JSON.parse('{{ init_data | json_encode() | raw  }}'),
      parcial_taxes : JSON.parse('{{ parcial_taxes | json_encode() | raw  }}'),
      parcial : JSON.parse('{{ parcial | json_encode() | raw }}'),
      regimen : JSON.parse('{{ regimen  | json_encode() | raw }}'),
      usuario : JSON.parse('{{ usuario  | json_encode() | raw }}'),
      complete_liquidation_data : {
        id_parcial : parseFloat('{{ parcial.id_parcial }}'),
        base_fodinfa : parseFloat('{{ parcial_taxes.data_general.base_aranceles.base_fodinfa }}'),
        base_arancel_advalorem : parseFloat('{{ parcial_taxes.data_general.base_aranceles.base_arancel_advalorem }}'),
        base_arancel_especifico : parseFloat('{{ parcial_taxes.data_general.base_aranceles.base_arancel_especifico }}'),
        base_ice_especifico : parseFloat('{{ parcial_taxes.data_general.base_aranceles.base_ice_especifico }}'),
        base_ice_advalorem : parseFloat('{{ parcial_taxes.data_general.base_aranceles.base_ice_advalorem }}'),
        porcentaje_ice_advalorem : parseFloat('"{{ parcial_taxes.data_general.base_aranceles.porcentaje_ice_advalorem }}'),
        base_iva : parseFloat('{{ parcial_taxes.data_general.base_aranceles.base_iva }}'),
        base_etiquetas : parseFloat('{{ parcial_taxes.data_general.base_aranceles.base_etiquetas }}'),
        arancel_advalorem_pagar_pagado : 0,
        arancel_especifico_pagar_pagado : 0,
        fodinfa_pagado : 0,
        ice_advalorem_pagado : 0,
        ice_especifico_pagado : 0,
        iva_pagado : 0,
        },
      liquidations_items : JSON.parse('{{ parcial_taxes.taxes | json_encode() | raw  }}'),
      fecha_liquidacion : '',
      nro_liquidacion : null,
    },
    methods : {
    	fixedLiquidationsItems : function(){
    		//limpiamos el ecxeso de decimales del arreglo de tributos
    		$.each(this.liquidations_items, function(k,v){
    			v.ice_advalorem = Math.round(v.ice_advalorem *1000) /1000
    		})
    	},
    	calcDiff:function(item){
    		diff = 0
    		$.each(this.parcial_taxes.taxes , function(k,v){
    			if(v.id_registro === item.id_registro){
    				diff = parseFloat(v.ice_advalorem) - parseFloat(item.ice_advalorem)
    			}
    		});
    	return diff.toFixed(3)
    	},
    	sumLiquidationItems : function(detail){
    		//suma los items de la liqudiacion por producto
    		var totals = {
    				'boxes' : 0,
    				'bottles' : 0,
    				'fodinfa' : 0,
    				'ice_advalorem' : 0,
    		}
			$.each(this.liquidations_items, function(k,v){
				totals['boxes'] += parseInt(v.cajas)
				totals['bottles'] += parseInt(v.unidades)
				totals['fodinfa'] += v.fodinfa
				totals['ice_advalorem'] += v.ice_advalorem
			})			
			totals['fodinfa']  = Math.round(totals['fodinfa'] * 1000) /1000
			totals['ice_advalorem']  = Math.round(totals['ice_advalorem'] * 1000) /1000
			return totals[detail]
    	},
    	/**
    	 * Envia la liquidacion al backend
    	 */
    	sendLiquidation : function(type){
    		console.dir('Recolectando informacion liquidacion ' + type )
			this.$http.post('{{rute_url}}impuestos/liquidarivaparcial/', this.complete_liquidation_data).then(response => {
				console.log('Geial')
       		    //location.reload();
       		  }, response => {
       			  alert('Se produjo un error, por favor recargue la página');
       		  });    		
      	}
    },
    filters : {
      money : function(num){                                                                                
        num = parseFloat(num)                                        
        return num.toFixed(3)
      },
      int : function(num){
    	  return parseInt(num)
      }
    },
mounted : function(){
    	this.fixedLiquidationsItems()
    },
})