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
      liquidations_items : [],
    },
    filters : {
      money : function(num){
        parseFloat(num)
        return num.toFixed(3)
      }
    }
})