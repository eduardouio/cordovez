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

class parcialTaxesReliquidate {
    private $init_data;
    private $prorrateo;
    private $param_taxes;
    private $parcial;
    private $total_items = 0;
    private $incoterm;
    private $gastos_origen = 0.0;
    private $etiquetas_fiscales_valor = 0.0;
    private $iva_base = 0.12;
    private $id_factura_informativa;
    private $nro_factura_informativa;
    private $base_tasa_aduanera = 0.10;
    private $ice_advalorem_base = 0.75;
    private $type_change_invoice = 0.0;
    private $type_change_parcial = 0.0;
    private $have_labes = True;
    private $have_control_tasa = True;
    private $taxes = [];
    
    /**
     * Datos iniciales del parcial
     * @param array $init_data => Facturas, productos, parcial
     * @param array $prorrateo =>
     * @param array $product
     * @param array $param_taxes
     */
    function __construct(
        array $init_data,
        array $prorrateo,
        array $param_taxes,
        array $parcial
        )
    {
        $this->init_data = $init_data;
        $this->prorrateo = $prorrateo;
        $this->param_taxes =  $param_taxes;
        $this->parcial = $parcial;
    }
    
    
    /**
     * Retorna los impuestos del parcial
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
        
        foreach ($this->init_data['products'] as $item => $product){
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
            'tipo_cambio_parcial' => $this->type_change_parcial,
            'fob' => $taxes['sums']['fob'],
            'have_tasa_control' => $this->have_control_tasa,
            'have_etiquetas' => $this->have_labes,
            'base_arancel_especifico' => $this->getTaxParam('ICE ESPECIFICO'),
            'base_advalorem' => $this->getTaxParam('BASE ADVALOREM'),
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

        $have_tasa = false;       
        
        foreach ( $taxes as $item => $tax ){
            $ice_advalorem_tasa += $tax['ice_advalorem_sin_etiquetas'];
        }
        
        if( round($this->parcial['ice_advalorem'], 4) == round($ice_advalorem_tasa, 4)){
            $have_tasa = true;
        }
        
        $diferencia =  (
            $this->parcial['ice_advalorem']
            - $this->parcial['ice_advalorem_pagado']
            );
        
        $diferencia_ice_especifico = (
            $this->parcial['ice_especifico']
            - $this->parcial['ice_especifico_pagado']
            );
        
        #todos los productos pagan ice especifico
        $all_products = count($taxes);
        #solo buscamos los items que tienen ice advalorem
        $num_products = 0;

        foreach ($taxes as $key => $tax) {
            if($tax['ice_advalorem'] > 0){
                $num_products ++;
            }
        }        

        $reliquidate_taxes = [];
        
        foreach ( $taxes as $idx => $tax){
            if($tax['ice_advalorem'] > 0){
                if($have_tasa){
                    $tax['ice_advalorem_pagado'] = (
                        $tax['ice_advalorem_sin_etiquetas']
                        - ( $diferencia/$num_products )
                        );

                    $tax['ice_advalorem_diferencia'] = (
                        $tax['ice_advalorem']
                        - $tax['ice_advalorem_pagado']
                        );
                    #$tax['exaduana_antes'] = $tax['exaduana_sin_etiquetas'];
                }else{

                    $tax['ice_advalorem_pagado'] = (
                        $tax['ice_advalorem_sin_tasa']
                        - ( $diferencia/$num_products )
                        );

                    $tax['ice_advalorem_diferencia'] = (
                        $tax['ice_advalorem']
                        - $tax['ice_advalorem_pagado']
                        );
                    #$tax['exaduana_antes'] = $tax['exaduana_sin_tasa'];
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
            + $tax['gasto_origen']
                );
            

            $costo_total = (
            $tax['total_ice']
            + $tax['arancel_advalorem_pagar']
            + $tax['arancel_especifico_pagar']
            + $tax['fodinfa']
            + $tax['prorrateos_total']
            + $tax['fob']
            + $tax['gasto_origen']

            );

            $tax['costo_total'] = $costo_total;
            $tax['costo_caja_final']  = $costo_total/$tax['cajas'];
            $tax['costo_botella'] = $costo_total/$tax['unidades'];
            
            array_push($reliquidate_taxes, $tax);
        }
        
        return $reliquidate_taxes;
    }
    
    
    
    /**
     * Setea las consiguraciones iniciales para el calculo de los impuestos
     * Coloca los parametros para el calculo de impuestos
     */
    private function setConfiguration(){
        $unities = 0.0;
        
        foreach ($this->init_data['products'] as $idx => $prod){
            $this->total_items++;
            $product_data = $this->getProductData($prod);
            $unities += $product_data['unidades'];
            
        }
        
        foreach ($this->init_data['order_invoices'] as $idx => $invoice){
            if ($idx == 0) {
                $this->type_change_invoice = $invoice['tipo_cambio'];
            break;
            };
        }
        
        if ( floatval($this->init_data['parcial']['tipo_cambio']) == 0 ){
            $this->type_change_parcial = 1;
        }else{
            $this->type_change_parcial =
            $this->init_data['parcial']['tipo_cambio'];
        }
        
        $this->incoterm = $this->init_data['order']['incoterm'];
        
        foreach ($this->init_data['info_invoices'] as $idx => $inv){
            $this->gastos_origen += $inv['gasto_origen'];
        }
        
        $etiquetas_fiscales = 0;
        
        foreach ($this->init_data['parcial_expenses'] as $idx => $exp){
            if($exp['concepto'] == 'ETIQUETAS FISCALES' ){
                $etiquetas_fiscales = $exp['valor_provisionado'];
            }
        }
        
        if($etiquetas_fiscales){
            $this->etiquetas_fiscales_valor = $etiquetas_fiscales / $unities;
        }       
        
        $this->have_labes = boolval(
            $this->init_data['parcial']['bg_have_etiquetas_fiscales']
            );
        
        $this->have_control_tasa = boolval(
            $this->parcial['bg_have_tasa_control']
            );        
    }
    
    
    /**
     * Retorna los impuestos para un producto
     *
     * @return  array $taxes
     *
     */
    private function getTaxesProduct(array $detail_info_invoice): array
    {
        $product = $this->getProductData($detail_info_invoice);
        $prorrateo_item = $this->getProrrateoItem(
            $detail_info_invoice,
            $product
            );
        $taxes_product = $this->getDetailTaxesProduct($product, $prorrateo_item);
        
        return([
            'product' => $product['nombre'],
            'cod_contable' => $product['cod_contable'],
            'id_factura_informativa' => $this->id_factura_informativa,
            'nro_factura_informativa' => $this->nro_factura_informativa,
            'id_factura_informativa_detalle' => $product['id_factura_informativa_detalle'],
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
            'fob_percent' => $prorrateo_item['fob_percent'],
            'seguro_aduana' => $prorrateo_item['seguro_aduana'],
            'flete_aduana' =>$prorrateo_item['flete_aduana'],
            'seguro' => $prorrateo_item['seguro'],
            'flete' =>$prorrateo_item['flete'],
            'gasto_origen' => $prorrateo_item['gasto_origen'],
            'cif' => $prorrateo_item ['cif'],
            'fecha_liquidacion' => $this->parcial['fecha_liquidacion'],
            'nro_pedido' => $this->parcial['nro_pedido'],
            'id_parcial' => $this->parcial['id_parcial'],
            'otros' =>  $prorrateo_item['otros'],
            'prorrateo_parcial' => $prorrateo_item['prorrateo_parcial'],
            'prorrateo_pedido' => $prorrateo_item['prorrateo_pedido'],
            'prorrateos_total' => $prorrateo_item['prorrateos_total'],
            'tasa_control' => $prorrateo_item['tasa_control'],
            'fodinfa' => $taxes_product['fodinfa'],
            'iva' => $taxes_product['iva'],
            'iva_unidad' => $taxes_product['iva_unidad'],
            'iva_total' => $taxes_product['iva_total'],
            'ex_aduana' => $taxes_product['ex_aduana'],
            'ex_aduana_unitario' => $taxes_product['ex_aduana_unitario'],
            'exaduana_sin_etiquetas' => $taxes_product['exaduana_sin_etiquetas'],
            'exaduana_sin_tasa' => $taxes_product['exaduana_sin_tasa'],
            'ex_aduana_unitario_sin_tasa' => $taxes_product['ex_aduana_unitario_sin_tasa'],
            'ex_aduana_unitario_sin_etiquetas' => $taxes_product['ex_aduana_unitario_sin_etiquetas'],
            'exaduana_pago' => 0.0,
            'base_advalorem' => $taxes_product['base_advalorem'],
            'base_ice_epecifico' => $taxes_product['base_ice_especifico'],
            'ice_especifico' => $taxes_product['ice_especifico'],
            'ice_especifico_unitario' => $taxes_product['ice_especifico_unitario'],
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
    private function getProductData(array $detail_info_invoice):array
    {
        
        $product_base = [];
        $detail_order_invoice = [];
        
        foreach ($this->init_data['products_base'] as $item => $product){
            if(
                $product['detalle_pedido_factura']
                ==
                $detail_info_invoice['detalle_pedido_factura'])
            {
                $product_base = $product;
                break;
                
            }
        }
        
        
        foreach ($this->init_data['order_invoice_detail'] as $item => $dt){
            if(
                $dt['detalle_pedido_factura']
                ==
                $detail_info_invoice['detalle_pedido_factura']
                ){
                    $detail_order_invoice = $dt;
                    break;
            }
        }
        
        #solo funciona para la primera factura informativa
        $fob = 0.0;
        $gasto_origen = 0.0;

        $total_invoices = $this->init_data['info_invoices'][0]['valor'];
        $this->id_factura_informativa = $this->init_data['info_invoices'][0]['id_factura_informativa'];
        $this->nro_factura_informativa = $this->init_data['info_invoices'][0]['nro_factura_informativa'];

        $percent = round((
            (   $detail_order_invoice['costo_caja']
                * $detail_info_invoice['nro_cajas']
                )
            / $total_invoices
            ),3);

        
        if ($this->incoterm == 'CFR'){
            #si en algun momento hay varias facturas no va a funcionar tienes
            # se debe calcular en base a las facturas adicionales que existan
            $fob = (
                (
                    $detail_info_invoice['nro_cajas']
                    * $detail_order_invoice['costo_caja']
                    )
                * $this->type_change_parcial
                );
            
        }elseif ($this->incoterm == 'FOB'){
            $fob = (
                (   $detail_info_invoice['nro_cajas']
                    * $detail_order_invoice['costo_caja']
                    )
                + ($this->gastos_origen * $percent)
                ) * $this->type_change_parcial;
                
                $gasto_origen =
                ($this->gastos_origen * $percent)
                * $this->type_change_parcial;
                
        }else{
            $fob = (
                (   $detail_info_invoice['nro_cajas']
                    * $detail_order_invoice['costo_caja']
                    )
                ) * $this->type_change_parcial;
                
                $gasto_origen = ($this->gastos_origen * $percent);
        }

        return ([
            'nombre'=> $product_base['nombre'],
            'id_factura_informativa_detalle' => $detail_info_invoice['id_factura_informativa_detalle'],
            'detalle_pedido_factura' => $detail_info_invoice['detalle_pedido_factura'],
            'cod_contable' => $product['cod_contable'],
            'cajas_importadas' => $detail_order_invoice['nro_cajas'],
            'gasto_origen' => $gasto_origen,
            'cantidad_x_caja' => $product_base['cantidad_x_caja'],
            'unidades_importadas' => (
                $detail_order_invoice['nro_cajas']
                * $product_base['cantidad_x_caja']
                ),
            'cajas' => $detail_info_invoice['nro_cajas'],
            'unidades' => (
                $detail_info_invoice['nro_cajas']
                * $product_base['cantidad_x_caja']
                ),
            'costo_caja' => $detail_order_invoice['costo_caja'],
            'costo_unidad' => (
                $detail_order_invoice['costo_caja']
                / $product_base['cantidad_x_caja']
                ),
            'capacidad_ml' =>  $product_base['capacidad_ml'] ,
            'peso' => $product_base['peso'] ,
            'percent' => $percent,
            'grado_alcoholico' => $detail_info_invoice['grado_alcoholico'],
            'fob' => $fob,
        ]);
    }
    
    
    /**
     * Retorna el valor del prorrateo de los gastos iniciales y del parcial
     *
     * para el fob de item
     */
    private function getProrrateoItem(
        array $detail_info_invoice,
        array $product
        ): array
        {
            $tasa_control = 0.0;
            $seguro = 0;
            $flete = 0;

            $prorrateo_detail = $this->prorrateo['prorrateo_detail'];
            $fobs_parcial = $this->init_data['fobs_parcial'];

            foreach ($prorrateo_detail as $key => $value) {
                if( $value['concepto'] == 'TASA DE CONTROL ADUANERO' 
                    &&  $this->total_items > 1
                    ){                            
                        $tasa_control = ($detail_info_invoice['peso']*1000/2000*$this->base_tasa_aduanera);
                    if($tasa_control > 700){
                        $tasa_control = 700;
                    }
                }elseif($value['concepto'] == 'TASA DE CONTROL ADUANERO' 
                    &&  $this->total_items == 1){
                    $tasa_control = $this->parcial['tasa_control'];
                }
                }

            $prorrateo_item_p = [];            
            $prorrateo_pedido = [];

            foreach($prorrateo_detail as $idx => $gst_prorrateo){
                if ($gst_prorrateo['tipo'] == 'gasto_inicial'){
                    if($gst_prorrateo['concepto'] != 'TASA DE CONTROL ADUANERO'){
                        if($gst_prorrateo['concepto'] == 'FLETE'){
                            #la primera opcion muestra el Flete sin GO
                            #segunda suma los dos para mostrarlos en el display
                            #$flete = ($gst_prorrateo['valor_prorrateado'] * $product['percent']);
                            $flete = ($gst_prorrateo['valor_prorrateado'] * $product['percent']) 
                                    + ($this->gastos_origen * $product['percent']);
                        }
                        if($gst_prorrateo['concepto'] == 'POLIZA SEGURO'){
                            $seguro = $gst_prorrateo['valor_prorrateado'] * $product['percent'];
                        }

                        array_push($prorrateo_pedido, $gst_prorrateo['valor_prorrateado'] * $product['percent']);
                    }

                }else{

                    if($gst_prorrateo['concepto'] != 'ETIQUETAS FISCALES'){

                        array_push( $prorrateo_item_p, $gst_prorrateo['valor_provisionado'] * $product['percent']);
                    }else{
                        array_push( $prorrateo_item_p, $this->etiquetas_fiscales_valor * $product['unidades']);
                    }

                }
            } 

           array_push($prorrateo_item_p, $this->init_data['warenhouses']['almacenaje_aplicado'] * $product['percent']); 
           array_push($prorrateo_pedido, $tasa_control);

            $prorrateos_parcial = 0.0;
            $prorrateos_pedido = 0.0;

            foreach ($prorrateo_pedido as $key => $value) {
                $prorrateos_pedido += $value;
            }

            foreach ($prorrateo_item_p as $key => $value) {
                $prorrateos_parcial += $value;
            }

            $fob_percent = ($product['percent']);
            
            
            $prorrateo_item = [
                'fob_percent' => $fob_percent,
                'seguro_aduana' => ($fobs_parcial['prorrateo_seguro_aduana']
                    * $fob_percent) * $this->type_change_parcial ,
                'flete_aduana' => (
                    $fobs_parcial['prorrateo_flete_aduana']
                    * $fob_percent
                    ) * $this->type_change_parcial,
                'seguro' => $seguro,
                'flete' => $flete,
                'gasto_origen' => ($this->gastos_origen * $product['percent']),
                'otros' =>  $this->parcial['otros'] * $fob_percent,
                'tasa_control' => $tasa_control,

                'prorrateo_parcial' => $prorrateos_parcial,
                'prorrateo_pedido' => $prorrateos_pedido,
                'prorrateos_total' => $prorrateos_pedido + $prorrateos_parcial,
            ];            
            

            $prorrateo_item ['cif'] = (
                (
                    $product['fob']
                    + $prorrateo_item['seguro_aduana']
                    + $prorrateo_item['flete_aduana']
                    + ($this->gastos_origen * $product['percent'])
                    )
                );
            return  $prorrateo_item;
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
        if($product['capacidad_ml'] > 1000){
            $limite_capacidad = 2000;
        }
        
        
        $fodinfa = (
            $this->parcial['fodinfa_pagado']
            * $prorrateos['fob_percent']
            );
        
        $etiquetas_fiscales  = (
            $product['unidades']
            * $this->etiquetas_fiscales_valor
            );            
        
        
        $arancel_advalorem = (
            $this->parcial['arancel_advalorem_pagar_pagado']
            * $prorrateos['fob_percent']
            );
        
        $arancel_advalorem_unitario = ($arancel_advalorem / $product['unidades']);
        
        $arancel_especifico = (
            $this->getTaxParam('ARANCEL ESPECIFICO')
            * (($product['capacidad_ml']/ $limite_capacidad) * $product['grado_alcoholico'])
            ) * $product['unidades'];
            
            $arancel_especifico_unitario = ($arancel_especifico /  $product['unidades']);
            
            $arancel_especifico_liberado =   (
                $arancel_especifico
                * ($this->parcial['exoneracion_arancel'] / 100)
                );
            
            $arancel_advalorem_liberado =  (
                $arancel_advalorem
                * ($this->parcial['exoneracion_arancel'] / 100)
                );
            
            
            $arancel_advalorem_pagar =  ($arancel_advalorem - $arancel_advalorem_liberado);
            $arancel_especifico_pagar = ($arancel_especifico - $arancel_especifico_liberado);
            
            
            
            
            $base_ice_especifico = $this->getTaxParam('ICE ESPECIFICO');
            
            $ice_especifico = (
                (
                    $base_ice_especifico
                    *
                    (
                        ($product['capacidad_ml'] / $limite_capacidad )
                        *
                        ($product['grado_alcoholico']/ 100)
                        )
                    )
                * $product['unidades']
                );
            
            $ice_especifico_unitario =  ($ice_especifico / $product['unidades']);
            
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
            
            
            $base_advalorem = ($this->getTaxParam('BASE ADVALOREM') * (
                $product['capacidad_ml']/ 1000));
            
            if ($ex_aduana_unitario > $base_advalorem){
                $ice_advalorem = (
                    $ex_aduana_unitario - $base_advalorem
                    ) * $this->ice_advalorem_base
                    * $product['unidades'];
            }
            
            if ($ex_aduana_unitario_sin_etiquetas > $base_advalorem){
                $ice_advalorem_sin_etiquetas = (
                    $ex_aduana_unitario_sin_etiquetas - $base_advalorem
                    ) * $this->ice_advalorem_base
                    * $product['unidades'];
            }
            
            if ($ex_aduana_unitario_sin_tasa > $base_advalorem){
                $ice_advalorem_sin_tasa = (
                    $ex_aduana_unitario_sin_tasa - $base_advalorem
                    ) * $this->ice_advalorem_base
                    * $product['unidades'];
            }
            
            $ice_advalorem_unitario =  $ice_advalorem / $product['unidades'];
            
            $iva = $iva_total = (
                $this->parcial['iva_pagado'] * $prorrateos['fob_percent']
                );                    
                    
            return ([
                'fodinfa' => $fodinfa,
                'base_ice_especifico' => $base_ice_especifico,
                'ice_especifico' => $ice_especifico,
                'ice_especifico_unitario' => ($ice_especifico/$product['unidades']),
                'ex_aduana' => $exaduana,
                'ex_aduana_unitario' => $ex_aduana_unitario,
                'exaduana_sin_etiquetas' => $exaduana_sin_etiquetas,
                'exaduana_sin_tasa' => $exaduana_sin_tasa,
                'ex_aduana_unitario_sin_tasa' => $ex_aduana_unitario_sin_tasa,
                'ex_aduana_unitario_sin_etiquetas' => $ex_aduana_unitario_sin_etiquetas,
                'etiquetas_fiscales'=> $etiquetas_fiscales,
                'gasto_origen' => $product['gasto_origen'],
                'base_advalorem' => $base_advalorem,
                'ice_advalorem' => $ice_advalorem,
                'ice_advalorem_sin_etiquetas' => $ice_advalorem_sin_etiquetas,
                'ice_advalorem_sin_tasa' => $ice_advalorem_sin_tasa,
                'ice_advalorem_unitario' => $ice_advalorem_unitario,
                'ice_unitario'=> $ice_advalorem_unitario,
                'arancel_advalorem' => $arancel_advalorem_pagar,
                'arancel_especifico' => $arancel_especifico_pagar,
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
    
    /**
     * Retorna el porcentaje para un impuesto o el valor
     */
    private function getTaxParam(string $tax_name):float
    {
        foreach ($this->param_taxes as $key => $tax) {
            if($tax['concepto'] == $tax_name){
                return $tax['valor'];
            }
        }
        return False;
    }
}