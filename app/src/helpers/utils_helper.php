<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Comprueba si la tasa de control aduanero se basa en lo pesos de los items
*/
if (!function_exists('checkTASAControl')) {
    function checkTASAControl(array $init_data): bool{
        
        foreach ($init_data['init_expenses'] as $key => $val) {
            if($val['concepto'] == 'TASA DE CONTROL ADUANERO' && $val['valor_provisionado'] <= 40){
                return false;
            }

            if($val['concepto'] == 'TASA DE CONTROL ADUANERO' && $val['valor_provisionado'] > 40){
                return true;
            }
        }
        
        return false;
    }
}


/**
 * Actualiza el peso de prorrateo de un produtcto en la factura informativa
 */
if (!function_exists('updateWeigth')) {
    function updateWeigth(array $product_order, array $product_parcial): array{
       $box_weigth = ($product_order['peso'] / $product_order['nro_cajas']);
       $product_parcial['peso'] = $box_weigth * $product_parcial['nro_cajas'];
       return $product_parcial;
    }
}