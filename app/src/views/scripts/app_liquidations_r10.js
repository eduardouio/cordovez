var app = new Vue({
    el : '#app_liquidaciones',
    delimiters: ['${', '}'],
    data : {
      show_ice_diff : true,
      parcial_taxes : JSON.parse('{{ order_taxes | json_encode() | raw  }}'),
      complete_liquidation_data : {
        nro_pedido : '{{ order.nro_pedido}}',
        base_fodinfa : parseFloat('{{ order_taxes.data_general.base_aranceles.base_fodinfa }}'),
        base_arancel_advalorem : parseFloat('{{ order_taxes.data_general.base_aranceles.base_arancel_advalorem }}'),
        base_arancel_especifico : parseFloat('{{ order_taxes.data_general.base_aranceles.base_arancel_especifico }}'),
        base_ice_especifico : parseFloat('{{ order_taxes.data_general.base_aranceles.base_ice_especifico }}'),
        base_ice_advalorem : parseFloat('{{ order_taxes.data_general.base_aranceles.base_ice_advalorem }}'),
        porcentaje_ice_advalorem : parseFloat('{{ order_taxes.data_general.base_aranceles.porcentaje_ice_advalorem }}'),
        base_iva : parseFloat('{{ order_taxes.data_general.base_aranceles.base_iva }}'),
        base_etiquetas : parseFloat('{{ order_taxes.data_general.base_aranceles.base_etiquetas }}'),
        arancel_advalorem_pagar_pagado : 0,
        arancel_especifico_pagar_pagado : 0,
        fodinfa_pagado : 0,
        ice_advalorem_pagado : 0,
        ice_especifico_pagado : 0,
        iva_pagado : parseFloat('{{ order_taxes.sums.iva }}'),
        fecha_liquidacion : '',
        nro_liquidacion : null,
        },
      liquidations_items : JSON.parse('{{ order_taxes.taxes | json_encode() | raw  }}'),
    },
    methods : {
    	checkItems : function(){
    		if (this.liquidations_items.length === 1){
    			this.liquidations_items[0]['ice_advalorem'] = this.complete_liquidation_data.ice_advalorem_pagado
    		}
    		return false
    	},
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
				totals['fodinfa'] += parseFloat(v.fodinfa)
				totals['ice_advalorem'] += parseFloat(v.ice_advalorem)
			})
			totals['fodinfa']  = Math.round(totals['fodinfa'] * 1000) /1000
			totals['ice_advalorem']  = Math.round(totals['ice_advalorem'] * 1000) /1000
			
			dif_ice_advalorem = 
					Math.abs(this.complete_liquidation_data.ice_advalorem_pagado
					- totals['ice_advalorem'])
			if (dif_ice_advalorem < 0.01){
				this.show_ice_diff = false
			}else{
				this.show_ice_diff = true
			}
			return totals[detail]
    	},
    	/**
    	 * Envia la liquidacion al backend
    	 */
    	sendLiquidation : function(type){
    		console.dir('Recolectando informacion liquidacion ' + type )
			this.$http.post('{{rute_url}}impuestos/liquidarIvaOrder/', data = {
					'complete_liquidation_data' : this.complete_liquidation_data,
					'liquidations_items' : this.liquidations_items,
						}).then(response => {
       		    location.reload();
       		  }, response => {
       			  console.dir(response)
       			  alert('Se produjo un error, por favor recargue la página' + response)
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
    computed : {
    	total_tributes : function(){
    		return (
    		parseFloat(this.complete_liquidation_data.arancel_advalorem_pagar_pagado)
			+ parseFloat(this.complete_liquidation_data.arancel_especifico_pagar_pagado)
			+ parseFloat(this.complete_liquidation_data.fodinfa_pagado)
			+ parseFloat(this.complete_liquidation_data.ice_advalorem_pagado)
			+ parseFloat(this.complete_liquidation_data.ice_especifico_pagado)
			+ parseFloat(this.complete_liquidation_data.iva_pagado)
			)
    	
    	}
    },
mounted : function(){
    	this.fixedLiquidationsItems()
    },
})