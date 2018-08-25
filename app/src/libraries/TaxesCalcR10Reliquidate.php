<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Clase encargada de generar los impuestos totales y por
 * unidades los valores son devueltos en forma de array, el calculo
 * se lo hace por tipo de producto
 *
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @version 1.0
 * @copyright 2018 Representaciones Cordovez
 * @license Representaciones Cordovez
 * @package Controllers
 */

class orderTaxesReliquidate {
    private $init_data;
    private $param_taxes;
    private $incoterm;
    private $order;
    private $total_items = 0;
    private $type_change_invoice = 0.0;
    private $type_change_order = 0.0;
    private $gastos_origen;
    private $taxes = [];
    
    /**
     * Datos iniciales del pedido
     * @param array $init_data
     * @param array $param_taxes
     * @param array $order
     */
    function __construct(
        array $init_data,
        array $param_taxes,
        array $order
        )
    {
        $this->init_data = $init_data;
        $this->param_taxes =  $param_taxes;
        $this->order = $order;
    }
    
    
    /**
     * Retorna los impuestos del pedido
     *
     * return = [
     *  'product_taxes' => [(getTaxesProduct)],
     *  'totals' => [],
     * ]
     *
     */
    public function getTaxes():array
    {
        $this->setConfiguration();
        
        $taxes = [
            'taxes' => [],
            'sums' => [],
            'data_general' => [],
        ];
        
        foreach ($this->init_data['order_invoice_detail'] as $item => $product){
            
            array_push($taxes['taxes'], $this->getTaxesProduct($product));
        }
        
        $taxes['taxes'] = $this->calDiferenceICEAdvalorem($taxes['taxes']);
        
        
        #suma los valores de los impuestos en una sola linea
        foreach ($taxes['taxes'] as $dx => $tax){
            if($dx == 0){
                $taxes['sums'] = $tax;
            }
            
            foreach ($taxes['sums']as $tax_name => $val){
                if($dx == 0){
                    $taxes['sums'][$tax_name] = 0.0;
                }
                
                $taxes['sums'][$tax_name] += floatval($tax[$tax_name]);
            }
        }
               
        
        $data_general = [
            'tipo_cambio_factura' => $this->type_change_invoice,
            'tipo_cambio_pedido' => $this->type_change_order,
            'fob' => $taxes['sums']['fob'],           
            'base_arancel_especifico' => $this->order['base_ice_especifico'],
            'base_advalorem' => $this->order['base_ice_advalorem'],
        ];
        
        $taxes['data_general'] = $data_general;
        
        return $taxes;
    }
    
    
    /**
     * Calcula los pagos pendintes de ice advalorem
     * @param array $taxes
     */
    private function calDiferenceICEAdvalorem(array $taxes) : array{
        
        $ice_advalorem_tasa = 0.0;        
        
        foreach ( $taxes as $item => $tax ){
            $ice_advalorem_tasa += $tax['ice_advalorem_sin_etiquetas'];
        }
        
        if( round($this->order['ice_advalorem'], 4) == round($ice_advalorem_tasa, 4)){
                $have_tasa = true;
        }
        
        $diferencia =  (
            $this->order['ice_advalorem'] 
            - $this->order['ice_advalorem_pagado']
            );

        $diferencia_ice_especifico = (
            $this->order['ice_especifico'] 
            - $this->order['ice_especifico_pagado']
            ) ;
        
        #todos los productos de la liquidacion
        $all_products = count($taxes);
        #Solo los productos con Ice Advalorem
        $num_products = 0;

        foreach ($taxes as $key => $tax) {
            if($tax['ice_advalorem'] > 0){
                $num_products ++;
            }
        }    


        $reliquidate_taxes = [];

        foreach ( $taxes as $idx => $tax){
            if($tax['ice_advalorem'] > 0){

                if($this->order['bg_have_tasa_control']){
                    $tax['ice_advalorem_pagado'] = (
                        $tax['ice_advalorem_sin_etiquetas'] 
                        - ( $diferencia/$num_products )
                        );
                    $tax['ice_advalorem_diferencia'] = (
                        $tax['ice_advalorem'] 
                        - $tax['ice_advalorem_pagado']
                        );
                    $tax['exaduana_antes'] = $tax['exaduana_sin_etiquetas'];
                }else{
                    $tax['ice_advalorem_pagado'] = (
                        $tax['ice_advalorem_sin_tasa']
                        - ( $diferencia/$num_products )
                        );
                    $tax['ice_advalorem_diferencia'] = (
                        $tax['ice_advalorem']
                        - $tax['ice_advalorem_pagado']
                        );
                    $tax['exaduana_antes'] = $tax['exaduana_sin_tasa'];
                }
            }else{
                $tax['ice_advalorem_pagado'] = 0;
                $tax['ice_advalorem_diferencia'] = 0;
            }
            
            $tax['ice_especifico'] = (
                $tax['ice_especifico']
                - ( $diferencia_ice_especifico/$all_products)
                );
            
            $tax['total_ice'] = $tax['ice_especifico'] + $tax['ice_advalorem'];
            
            
            $tax['indirectos'] = (
            + $tax['arancel_advalorem_pagar']
            + $tax['arancel_especifico_pagar']
            + $tax['total_ice']
            + $tax['fodinfa']
            + $tax['prorrateos_total']
            + $tax['gasto_origen_tasa_trimestral']            
                );
            
            $costo_total = (
                $tax['total_ice']
                + $tax['arancel_advalorem_pagar']
                + $tax['arancel_especifico_pagar']
                + $tax['fodinfa']
                + $tax['prorrateos_total']
                + $tax['fob']
                + $tax['gasto_origen_tasa_trimestral']
            );
            
            #$tax['prorrateo_pedido'] += ($tax['etiquetas_fiscales'] + $tax['tasa_control']);
            #xavierquilismal1987
            #|| 'CFR'
            if($this->incoterm == 'FOB' ){
                $costo_total  = (
                    $costo_total - $tax['fob']) 
                    + $tax['fob_tasa_trimestral'];
                    + $tax['gasto_origen_tasa_trimestral'];
            }
           
            $tax['costo_total'] = $costo_total;
            $tax['costo_caja_final']  = $costo_total/$tax['cajas'];
            $tax['costo_botella'] = $costo_total/$tax['unidades'];

            
            
            array_push($reliquidate_taxes, $tax);
        }
        
        return $reliquidate_taxes;
    }
    
    
    /**
     * Setea las configuraciones iniciales para el calculo de los impuestos
     * Coloca los parametros para el calculo de impuestos
     */
    private function setConfiguration(){      
        
        foreach ($this->init_data['order_invoices'] as $idx => $invoice){
            if ($idx == 0) {
                $this->type_change_invoice = $invoice['tipo_cambio'];
            break;
            }
        }
        
        if ( $this->order['tipo_cambio_impuestosR10'] == 0 ){
            $this->type_change_order = 1;
        }else{
            $this->type_change_order =
            $this->order['tipo_cambio_impuestosR10'];
        }
        
        $this->incoterm = strtoupper($this->init_data['order']['incoterm']);
        
               
        foreach ($this->init_data['init_expenses'] as $idx => $exp){
            if($exp['concepto'] == 'GASTO ORIGEN' ){
                $this->gastos_origen = $exp['valor_provisionado'];
            }                   
        }
            
        
        #si los gastos de origen no estan en la lista de GI estan en el pedido
        # verificar si trabaja bien con los incoterms mencionados. los GO estan
        # en la moneda del pedido
        if ($this->order['incoterm'] == 'FOB' || $this->order['incoterm'] == 'CFR'){
            $this->gastos_origen = (
                $this->order['gasto_origen']
                );
        }
      }
    
    
    /**
     * Retorna los impuestos para un producto
     *
     * @return  array $taxes
     *
     */
    private function getTaxesProduct(array $detail_invoice): array
    {           
        
        $product = $this->getProductData($detail_invoice);
        $prorrateo_item = $this->getProrrateoItem(
            $detail_invoice,
            $product
            );
        
        $taxes_product = $this->getDetailTaxesProduct($product, $prorrateo_item);
       
        return([
            'product' => $product['nombre'],
            'cod_contable' => $product['cod_contable'],
            'nro_factura_informativa' => 0,
            'detalle_pedido_factura' => $product['detalle_pedido_factura'],
            'cantidad_x_caja' => $product['cantidad_x_caja'],
            'cajas_importadas' => $product['cajas_importadas'],
            'unidades_importadas' => $product['unidades_importadas'],
            'cajas' => $product['cajas'],
            'unidades' => $product['unidades'],
            'costo_caja' => $product['costo_caja'],
            'costo_unidad' => $product['costo_unidad'],
            'peso' => $product['peso'],
            'capacidad_ml'=> $product['capacidad_ml'],
            'grado_alcoholico'=> $product['grado_alcoholico'],
            'fob' => $product['fob'],
            'fob_tasa_trimestral' => $product['fob_tasa_trimestral'],
            'fob_percent' => $prorrateo_item['fob_percent'],
            'seguro_aduana' => $prorrateo_item['seguro_aduana'],
            'flete_aduana' =>$prorrateo_item['flete_aduana'],
            'seguro' => $prorrateo_item['seguro'],
            'flete' =>$prorrateo_item['flete'],
            'gasto_origen' => $product['gasto_origen'],
            'gasto_origen_tasa_trimestral' => $product['gasto_origen_tasa_trimestral'],
            'cif' => $prorrateo_item ['cif'],
            'fecha_liquidacion' => $this->order['fecha_liquidacion'],
            'nro_pedido' => $this->order['nro_pedido'],
            'id_parcial' => 0,
            'otros' =>  $prorrateo_item['otros'],
            'prorrateo_parcial' => 0,
            'prorrateo_pedido' => ($prorrateo_item['prorrateo_pedido'] + $taxes_product['etiquetas_fiscales'] + $prorrateo_item['tasa_control'] ),
            'prorrateos_total' => ($prorrateo_item['prorrateo_pedido'] + $taxes_product['etiquetas_fiscales'] + $prorrateo_item['tasa_control'] ),
            'tasa_control' => $prorrateo_item['tasa_control'],
            'fodinfa' => $taxes_product['fodinfa'],
            'iva' => $taxes_product['iva'],
            'iva_unidad' => $taxes_product['iva_unidad'],
            'iva_total' => $taxes_product['iva_total'],
            'ex_aduana' => $taxes_product['ex_aduana'],
            'exaduana_antes' => $taxes_product['exaduana_sin_tasa'],
            'ex_aduana_unitario' => $taxes_product['ex_aduana_unitario'],
            'exaduana_sin_etiquetas' => $taxes_product['exaduana_sin_etiquetas'],
            'exaduana_sin_tasa' => $taxes_product['exaduana_sin_tasa'],
            'ex_aduana_unitario_sin_tasa' => $taxes_product['ex_aduana_unitario_sin_tasa'],
            'ex_aduana_unitario_sin_etiquetas' => $taxes_product['ex_aduana_unitario_sin_etiquetas'],
            'exaduana_pago' => 0.0,
            'base_advalorem' => $taxes_product['base_advalorem'],
            'base_ice_epecifico' => $taxes_product['base_ice_especifico'],
            'ice_especifico' => $taxes_product['ice_especifico'],
            'ice_especifico_unitario' =>$taxes_product['ice_especifico_unitario'],
            'ice_advalorem' => $taxes_product['ice_advalorem'],
            'ice_advalorem_sin_tasa' => $taxes_product['ice_advalorem_sin_tasa'],
            'ice_advalorem_sin_etiquetas' => $taxes_product['ice_advalorem_sin_etiquetas'],
            'ice_advalorem_unitario' => $taxes_product['ice_advalorem_unitario'],
            'arancel_especifico' => $taxes_product['arancel_especifico'],
            'arancel_advalorem' => $taxes_product['arancel_advalorem'],
            'arancel_especifico_unitario' => $taxes_product['arancel_especifico_unitario'],
            'arancel_advalorem_unitario' => $taxes_product['arancel_advalorem_unitario'],
            'arancel_especifico_liberado' => $taxes_product['arancel_especifico_liberado'],
            'arancel_advalorem_liberado' => $taxes_product['arancel_advalorem_liberado'],
            'arancel_especifico_pagar' => $taxes_product['arancel_especifico_pagar'],
            'arancel_advalorem_pagar' => $taxes_product['arancel_advalorem_pagar'],
            'etiquetas_fiscales'=> $taxes_product['etiquetas_fiscales'],
            'ice_unitario'=> $taxes_product['ice_unitario'],
        ]);
    }

    
    /**
     * Retorna la Informacion del producto al que se le esta calculando el
     * los aranceles
     *
     * @param array $product
     * @param array $init_data
     * @return array
     */
    private function getProductData(array $detail_invoice):array
    {
        $product_base = [];
        $detail_order_invoice = [];
        
        foreach ($this->init_data['products_base'] as $item => $product){
            if(
                $product['detalle_pedido_factura']
                ==
                $detail_invoice['detalle_pedido_factura'])
            {
                $product_base = $product;
                break;
                
            }
        }
        
        
        foreach ($this->init_data['order_invoice_detail'] as $item => $dt){
            if(
                $dt['detalle_pedido_factura']
                ==
                $detail_invoice['detalle_pedido_factura']
                ){
                    $detail_order_invoice = $dt;
                    break;
            }
        }
        
        $fob = 0.0;
        $total_invoices = 0.0;
        $fob_tasa_trimestral = 0.0;
        $gasto_origen = 0.0;
        $gasto_origen_tasa_trimestral = 0.0;
              
        $total_invoices = $this->init_data['order_invoices'][0]['valor'];
        
        
        $percent = round((
            ($detail_invoice['nro_cajas']* $detail_order_invoice['costo_caja']) 
            / $total_invoices)
            ,6);
        
        $percent = ($percent * 1000000) -1;
        $percent = $percent/1000000;
        
        $product_value = (
            ($detail_invoice['nro_cajas'] * $detail_invoice['costo_caja'])
            * $this->type_change_order
            );
        
        $gasto_origen_tasa_trimestral = (
            ($this->gastos_origen * $this->type_change_invoice)
            * $percent
            );
        
        $fob_tasa_trimestral = (
            ($product_value / $this->type_change_order) 
        * $this->type_change_invoice
            );         
            
        if ($this->incoterm == 'CFR'){
            $fob = $product_value;
        }elseif ($this->incoterm == 'FOB'){
            $gasto_origen = (
                ($this->gastos_origen * $percent)
                * $this->type_change_order
                );
            
            $fob = $product_value + $gasto_origen;
                
        }elseif($this->incoterm == 'EXW' || $this->incoterm == 'FCA'){
            $gasto_origen = $this->gastos_origen * $percent;
            $gasto_origen_tasa_trimestral = 0.0;
            $fob = $product_value + $gasto_origen;
        }
        
            return ([
                'nombre'=> $product_base['nombre'],
                'detalle_pedido_factura' => $product['detalle_pedido_factura'],
                'cod_contable' => $product['cod_contable'],
                'cajas_importadas' => $detail_order_invoice['nro_cajas'],
                'gasto_origen' => $gasto_origen,
                'gasto_origen_tasa_trimestral' => $gasto_origen_tasa_trimestral,
                'cantidad_x_caja' => $product_base['cantidad_x_caja'],
                'unidades_importadas' => (
                    $detail_order_invoice['nro_cajas']
                    * $product_base['cantidad_x_caja']
                    ),
                'cajas' => $detail_invoice['nro_cajas'],
                'unidades' => (
                    $detail_invoice['nro_cajas']
                    * $product_base['cantidad_x_caja']
                    ),
                'costo_caja' => $detail_order_invoice['costo_caja'],
                'costo_unidad' => (
                    $detail_order_invoice['costo_caja']
                    / $product_base['cantidad_x_caja']
                    ),
                'capacidad_ml' =>  $product_base['capacidad_ml'] ,
                'peso' => $detail_invoice['peso'] ,
                'percent' => $percent,
                'grado_alcoholico' => $detail_order_invoice['grado_alcoholico'],
                'fob' => $fob,
                'fob_tasa_trimestral' => $fob_tasa_trimestral
            ]);
    }
    
    
    /**
     * Retorna el valor del prorrateo de los gastos iniciales
     */
    private function getProrrateoItem(
        array $detail_invoice,
        array $product
        ): array
        {           
            $seguro = 0.0;
            $flete = 0.0;
            $prorrateos_pedido = 0.0;
            
            foreach($this->init_data['init_expenses'] as $idx => $gst_prorrateo){                
                if($gst_prorrateo['concepto'] != 'ETIQUETAS FISCALES' && $gst_prorrateo['concepto'] != 'TASA DE CONTROL ADUANERO'){                    
                    $prorrateos_pedido += $gst_prorrateo['valor_provisionado'];
                }                
                 if($gst_prorrateo['concepto'] == 'FLETE'){
                            #la primera opcion muestra el Flete sin GO
                            #segunda suma los dos para mostrarlos en el display
                            #$flete = ($gst_prorrateo['valor_provisionado'] * $product['percent']);
                            $flete = ($gst_prorrateo['valor_provisionado'] * $product['percent']) 
                                    + ($this->gastos_origen * $product['percent']);
                        }
                        if($gst_prorrateo['concepto'] == 'POLIZA SEGURO'){
                            $seguro = $gst_prorrateo['valor_provisionado'] * $product['percent'];
                        }
            }
                        
            $tasa_control = $this->getTSA($product, $product['percent']);
            
            $prorrateo_item = [
                'fob_percent' => $product['percent'],
                'product' => $product,
                'seguro_aduana' => round(($this->order['seguro_aduana'] * $product['percent']), 5),
                'flete_aduana' => round(($this->order['flete_aduana'] * $product['percent']), 5),
                'seguro' => $seguro,
                'flete' => $flete,
                'gasto_origen' => $this->gastos_origen * $product['percent'],
                'otros' =>  $this->order['otros'] * $product['percent'],
                'tasa_control' => $tasa_control,
                'prorrateo_pedido' => $prorrateos_pedido * $product['percent'],
            ];
            
            $prorrateo_item ['cif'] = (
                (
                    $product['fob']
                    + $prorrateo_item['seguro_aduana']
                    + $prorrateo_item['flete_aduana']
                    )
                );
            
            return  $prorrateo_item;
    }
    
    
    
    /**
     * Calcula la tasa de control para el producto
     * @param array $product
     * @return float
     */
    private function getTSA($product, $fob_percent):float{
                      
        $tasa_control_provision = 0.0;
        $tasa_control_general = 0.0;
        
        foreach ($this->init_data['init_expenses'] as $k => $expense){
            if($expense['concepto'] == 'TASA DE CONTROL ADUANERO'){
                $tasa_control_provision = $expense['valor_provisionado'];
            }
        }
        
        #si no se halla la tasa de conrol retorna cero, indica que no esta
        #provisionada
        if($tasa_control_provision == 0){
            return 0;
        }
        
        foreach ($this->init_data['order_invoice_detail'] as $k => $item){
            #aqui cambiar el costo de tasa
            $tasa = $item['peso'] * 0.05;
            if($tasa > 700){
                $tasa_control_general += 700;
            }else{
                $tasa_control_general += $tasa;
            }
        }
        
        #los pesos corresponden a las tasas
        if(round($tasa_control_general,3) == round($tasa_control_provision,3)){
            $tasa_item = $product['peso'] * 0.05;
            if($tasa > 700){
                return 700;
            }else{
                return $tasa_item;
            }
        }
        #accion para los pesos que no cinciden
        return ($tasa_control_provision * $fob_percent);
    }
    
    
    /**
     * Retorna los impuestos que se aplica al producto
     *
     * @param array $product
     * @param array $prorateos
     * @return array
     */
    private function getDetailTaxesProduct(
        array $product,
        array $prorrateos
        ): array
        {
        
        #PAra validar cuando un producto tiene mas de un litro
        $limite_capacidad = 1000;
        
        $fodinfa = (
                    $this->order['fodinfa_pagado'] 
                    * $prorrateos['fob_percent']
            );
        
        $etiquetas_fiscales  = (
                $product['unidades']
                * $this->order['base_etiquetas']
                );            
        
        $arancel_advalorem = (
                $this->order['arancel_advalorem_pagar_pagado'] 
                * $prorrateos['fob_percent']
            );
        
        $arancel_advalorem_unitario = ($arancel_advalorem / $product['unidades']);
        
        $arancel_especifico = (
            $this->order['base_arancel_especifico']
            * (($product['capacidad_ml']/ $limite_capacidad) * $product['grado_alcoholico'])
            ) * $product['unidades'];
            
        $arancel_especifico_unitario = ($arancel_especifico /  $product['unidades']);
        
        $arancel_especifico_liberado =   (
            $arancel_especifico
            * ($this->order['exoneracion_arancel'] / 100)
            );
        
        $arancel_advalorem_liberado =  (
            $arancel_advalorem
            * ($this->order['exoneracion_arancel'] / 100)
            );
                        
        $arancel_advalorem_pagar =  ($arancel_advalorem - $arancel_advalorem_liberado);
        $arancel_especifico_pagar = ($arancel_especifico - $arancel_especifico_liberado);                       
        
        $ice_especifico = (
            (
                $this->order['base_ice_especifico']
                *
                (
                    ($product['capacidad_ml'] / $limite_capacidad )
                    *
                    ($product['grado_alcoholico']/ 100)
                    )
                )
            * $product['unidades']
            );
        
        
        $exaduana = (
            $fodinfa
            + $etiquetas_fiscales
            + $prorrateos['cif']
            + $prorrateos['tasa_control']
            + $prorrateos['otros']
            + $arancel_especifico_pagar
            + $arancel_advalorem_pagar
            );
        
        $exaduana_sin_etiquetas = (
            $fodinfa
            + $prorrateos['cif']
            + $prorrateos['tasa_control']
            + $prorrateos['otros']
            + $arancel_especifico_pagar
            + $arancel_advalorem_pagar
            );
        
        $exaduana_sin_tasa = (
            $fodinfa
            + $prorrateos['cif']
            + $prorrateos['otros']
            + $arancel_especifico_pagar
            + $arancel_advalorem_pagar
            );
        
        $ex_aduana_unitario = ($exaduana/$product['unidades']);
        
        $ex_aduana_unitario_sin_etiquetas = (
            $exaduana_sin_etiquetas/$product['unidades']
            );
        $ex_aduana_unitario_sin_tasa = (
            $exaduana_sin_tasa/$product['unidades']
            );
        
        $ice_advalorem = 0.0;
        $ice_advalorem_sin_etiquetas = 0.0;
        $ice_advalorem_sin_tasa = 0.0;
        
        $base_advalorem = ($this->order['base_ice_advalorem'] * (
            $product['capacidad_ml']/ $limite_capacidad));
        
        
        if ($ex_aduana_unitario > $base_advalorem){
            $ice_advalorem = (
                $ex_aduana_unitario - $base_advalorem
                ) * $this->order['porcentaje_ice_advalorem']
                * $product['unidades'];
        }
        
        if ($ex_aduana_unitario_sin_etiquetas > $base_advalorem){
            $ice_advalorem_sin_etiquetas = (
                $ex_aduana_unitario_sin_etiquetas - $base_advalorem
                ) * $this->order['porcentaje_ice_advalorem']
                * $product['unidades'];
        }
        
        if ($ex_aduana_unitario_sin_tasa > $base_advalorem){
            $ice_advalorem_sin_tasa = (
                $ex_aduana_unitario_sin_tasa - $base_advalorem
                ) * $this->order['porcentaje_ice_advalorem']
                * $product['unidades'];
        }
        
        
        $ice_advalorem_unitario = $ice_advalorem / $product['unidades'];                
        $iva =  $iva_total = (
            $this->order['iva_pagado'] * $prorrateos['fob_percent']
            );
            
        return ([
            'fodinfa' => $fodinfa,
            'base_ice_especifico' => $this->order['base_ice_especifico'],
            'ice_especifico' => $ice_especifico,
            'ice_especifico_unitario' => ($ice_especifico/$product['unidades']),
            'ex_aduana' => $exaduana,
            'ex_aduana_unitario' => $ex_aduana_unitario,
            'exaduana_sin_etiquetas' => $exaduana_sin_etiquetas,
            'exaduana_sin_tasa' => $exaduana_sin_tasa,
            'ex_aduana_unitario_sin_tasa' => $ex_aduana_unitario_sin_tasa,
            'ex_aduana_unitario_sin_etiquetas' => $ex_aduana_unitario_sin_etiquetas,
            'etiquetas_fiscales'=> $etiquetas_fiscales,
            'base_advalorem' => $base_advalorem,
            'gasto_origen' => $product['gasto_origen'],
            'ice_advalorem' => $ice_advalorem,
            'ice_advalorem_sin_etiquetas' => $ice_advalorem_sin_etiquetas,
            'ice_advalorem_sin_tasa' => $ice_advalorem_sin_tasa,
            'ice_advalorem_unitario' => $ice_advalorem_unitario,
            'ice_unitario'=> $ice_advalorem_unitario,
            'arancel_especifico' => $arancel_especifico,
            'arancel_advalorem' => $arancel_advalorem,
            'arancel_especifico_unitario' => $arancel_especifico_unitario,
            'arancel_advalorem_unitario' => $arancel_advalorem_unitario,
            'arancel_especifico_liberado' => $arancel_especifico_liberado,
            'arancel_advalorem_liberado' => $arancel_advalorem_liberado,
            'arancel_especifico_pagar' => $arancel_especifico_pagar,
            'arancel_advalorem_pagar' => $arancel_advalorem_pagar,
            'total_ice' => $ice_advalorem +  $ice_especifico,
            'iva' => $iva,
            'iva_total' => $iva_total,
            'iva_unidad' => $iva / $product['unidades'],
        ]);
                    
    }
}