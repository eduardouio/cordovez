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
                'name' => 'IMNAC Importadora Nacional CIA. LTDA.',
                'ruc' => 'RUC: 1792324289001 DIR: Paul Rivet y James Orton',    
                'address' => 'Paul Rivet y James Orton',
                'logo' => base_url() . 'img/logo_imnac.jgp',
                'telephone' => '02 2400506',
                ],
            'vid' => [
                'name' => 'VID Internacional S.A.',
                'ruc' => 'RUC: 1791771907001 DIR: Av. 10 de Agosto N57-180 y Leonardo Murialdo',
                'address' => 'Av. 10 de Agosto N57-180 y Leonardo Murialdo',
                'logo' => base_url() . 'img/logo_vid.jgp',
                'telephone' => '02 2400506',
            ],
            'cordovez' => [
                'name' => 'Agencias y Representaciones Cordovez S.A.',
                'ruc' => 'RUC: 1790023516001 DIR: Av. 10 de Agosto N57-180 y Leonardo Murialdo',
                'address' => 'Av. 10 de Agosto N57-180 y Leonardo Murialdo',
                'logo' => base_url() . 'img/logo_cordovez.jpg',
                'telephone' => '02 2400506',
            ],
        ];
        
        return $empresas[$name];
    }
}

if(!function_exists('formatMayor')){
    /**
     * Formatea el mayor para que puda ser consumido por la vista
     * @param array $mayor
     * @return array
     */
    function formatMayor ($mayor) : array {
        
        if(gettype($mayor) == NULL ||gettype($mayor) == 'boolean'){
            return [];
        }
        
        $mayor_formated = [
            'mayor_gastos_origen' => [],
            'mayor_gastos_inciales' => [],
            'mayor_parcial_expenses' => [],
            'mayor_almacenaje' => [],
            'mayor_tributos' => [],
            'mayor_productos' => [],
        ]; 
        
        foreach ($mayor as $k => $m){
            $mayor_formated[$m['name']] = $m;
        }
        
        return  $mayor_formated;
    }
}


if(!function_exists('sumsMayor')){
    function sumsMayor(array $mayor, float $costo_total = 0.0){
        
        $sums = [
            'valor_inicial' => 0.0,
            'valor_inicial_facturado' => 0.0,
            'saldo_valor_inicial_facturado' =>0.0,
            'valor_distribuido' => 0.0,
            'valor_por_distribuir' => 0.0,
        ];
        
        #suma los valores de los impuestos en una sola linea
        foreach ($mayor as $dx){
            $sums['valor_inicial'] += $dx['valor_inicial'];
            $sums['valor_inicial_facturado'] += $dx['valor_inicial_facturado'];
            $sums['valor_distribuido'] += $dx['valor_distribuido'];
            $sums['valor_por_distribuir'] += $dx['valor_por_distribuir'];
        }
        
        $sums['saldo_valor_inicial_facturado'] = (
            $sums['valor_inicial']
            - $sums['valor_inicial_facturado']
            );        
        
        if($sums['valor_por_distribuir'] < 0.001){
            $sums['valor_por_distribuir'] =0;
        }
        
        $cuadre_mayor = [
            'provisiones' => 0.0,
            'facturado' => 0.0,
            'saldo' => 0.0,
            'cuadre_mayor' => 0.0,
        ];
                
        foreach ($mayor as $m){
            $cuadre_mayor['provisiones'] += $m['valor_inicial'];
            $cuadre_mayor['facturado'] += $m['valor_inicial_facturado'];
        }
        
        $cuadre_mayor['saldo'] = (
            $cuadre_mayor['provisiones']
            - $cuadre_mayor['facturado']
            );

         $cuadre_mayor['cuadre_mayor'] = (
             $costo_total
            - $sums['saldo_valor_inicial_facturado']
            - $sums['valor_por_distribuir']
            );
    
        return([
            'mayor' => $mayor,
            'sums' => $sums,
            'cuadre' => $cuadre_mayor,
        ]);
    }
}
