<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('checkTASAControl')) {
    /**
     * Comprueba si la tasa de control aduanero se basa en lo pesos de los items
     * 
     * @param array $init_data
     * @return bool
     */
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


if (!function_exists('updateWeigth')) {
    /**
     * Actualiza el peso de prorrateo de un produtcto en la factura informativa
     * 
     * @param array $product_order productos del pedido
     * @param array $product_parcial
     * @return array
     */
    function updateWeigth(array $product_order, array $product_parcial): array{
       $box_weigth = ($product_order['peso'] / $product_order['nro_cajas']);
       $product_parcial['peso'] = $box_weigth * $product_parcial['nro_cajas'];
       return $product_parcial;
    }
}



if (!function_exists('selectCompany')) {
    /**
     * Retorn la informacion de una de las empresas
     * @param string $name
     * @return array
     */
    function selectCompany(string $name): array{
        $empresas = [
            'imnac' => [                
                'name' => 'IMNAC Importadora Nacional S.A.',
                'ruc' => '1792324289001',    
                'address' => 'Paul Rivet y James Orton',
                'logo' => base_url() . 'img/logo_imnac.jgp',
                'telephone' => '02 2400506',
                ],
            'vid' => [
                'name' => 'VID Internacional S.A.',
                'ruc' => '1791771907001',
                'address' => 'Av. 10 de Agosto N57-180 y Leonardo Murialdo',
                'logo' => base_url() . 'img/logo_vid.jgp',
                'telephone' => '02 2400506',
            ],
            'cordovez' => [
                'name' => 'Agencias y Representaciones Cordovez S.A.',
                'ruc' => '1790023516001',
                'address' => 'Av. 10 de Agosto N57-180 y Leonardo Murialdo',
                'logo' => base_url() . 'img/logo_cordovez.jpg',
                'telephone' => '02 2400506',
            ],
        ];
        
        return $empresas[$name];
    }
}