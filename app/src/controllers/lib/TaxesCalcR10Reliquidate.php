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
        private $iva_base = 0.12;
        private $ice_advalorem_base = 0.75;
        private $type_change_invoice = 0.0;
        private $type_change_order = 0.0;
        private $have_labes = True;
        private $gastos_origen;
        private $have_control_tasa = True;
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
                'have_tasa_control' => $this->have_control_tasa,
                'have_etiquetas' => $this->have_labes,
                'base_arancel_especifico' => $this->getTaxParam('ICE ESPECIFICO'),
                'base_advalorem' => $this->getTaxParam('BASE ADVALOREM'),
            ];
            
            $taxes['data_general'] = $data_general;
            
            return $taxes;
        }
        
        
        /**
         * Setea las configuraciones iniciales para el calculo de los impuestos
         * Coloca los parametros para el calculo de impuestos
         */
        private function setConfiguration(){
            foreach ($this->init_data['order_invoices'] as $idx => $invoice){
                if ($idx == 0) {
                    $this->type_change_invoice = $invoice['tipo_cambio'];
                }
            }
            
            if ( $this->order['tipo_cambio_impuestosR10'] == 0 ){
                $this->type_change_order = 1;
            }else{
                $this->type_change_order =
                $this->order['tipo_cambio_impuestosR10'];
            }
            
            $this->gastos_origen = 0;
            
            foreach ($this->init_data['init_expenses'] as $idx => $exp){
                if($exp['concepto'] == 'GASTO ORIGEN' ){
                    $this->gastos_origen = $exp['valor_provisionado'];
                }
            }
            
            if ($this->order['incoterm'] == 'FOB' || $this->order['incoterm'] == 'CFR'){
                $this->gastos_origen = $this->order['gasto_origen'];
            }
            
            $this->incoterm = strtoupper($this->init_data['order']['incoterm']);
            
            $this->have_labes = boolval(
                $this->order['have_etiquetas_fiscales']
                );
            
            $this->have_control_tasa = boolval(
                $this->order['bg_have_tasa_control']
                );
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
            
            $indirectos = (
                $taxes_product['ice_advalorem']
                + $taxes_product['ice_especifico']
                + $taxes_product['fodinfa']
                + $taxes_product['arancel_advalorem_pagar']
                + $taxes_product['arancel_especifico_pagar']
                + $taxes_product['etiquetas_fiscales']
                + $prorrateo_item['prorrateo_pedido']
                );
            
            return([
                'product' => $product['nombre'],
                'cod_contable' => $product['cod_contable'],
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
                'gasto_origen' => $product['gasto_origen'],
                'fob' => $product['fob'],
                'fob_percent' => $prorrateo_item['fob_percent'],
                'seguro_aduana' => $prorrateo_item['seguro_aduana'],
                'flete_aduana' =>$prorrateo_item['flete_aduana'],
                'cif' => $prorrateo_item ['cif'],
                'otros' =>  $prorrateo_item['otros'],
                'prorrateo_pedido' => $prorrateo_item['prorrateo_pedido'],
                'indirectos' => $indirectos,
                'tasa_control' => $prorrateo_item['tasa_control'],
                'fodinfa' => $taxes_product['fodinfa'],
                'iva_total' => $taxes_product['iva_total'],
                'iva' => $taxes_product['iva'],
                'iva_unidad' => $taxes_product['iva_unidad'],
                'ex_aduana' => $taxes_product['ex_aduana'],
                'ex_aduana_unitario' => $taxes_product['ex_aduana_unitario'],
                'base_advalorem' => $taxes_product['base_advalorem'],
                'base_ice_epecifico' => $taxes_product['base_ice_especifico'],
                'ice_especifico' => $taxes_product['ice_especifico'],
                'ice_especifico_unitario' =>
                $taxes_product['ice_especifico_unitario'],
                'ice_advalorem' => $taxes_product['ice_advalorem'],
                'ice_advalorem_unitario' =>
                $taxes_product['ice_advalorem_unitario'],
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
                'total_ice' => $taxes_product['total_ice'],
                'costo_caja_final' => $taxes_product['costo_total'] / $product['cajas'],
                'costo_total' => $taxes_product['costo_total'],
                'costo_botella'=> (
                    $taxes_product['costo_total']
                    / $product['unidades']),
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
            $gasto_origen = 0.0;
            
            foreach ($this->init_data['order_invoices'] as $idx => $invoice){
                $total_invoices += $invoice['valor'];
            }
            
            $percent = (
                $detail_invoice['nro_cajas']
                * $detail_order_invoice['costo_caja']
                ) / $total_invoices;
                
                if ($this->incoterm == 'CFR'){
                    #si en algun momento hay varias facturas no va a funcionar tienes
                    # se debe calcular en base a las facturas adicionales que existan
                    $fob = (
                        (
                            $detail_invoice['nro_cajas']
                            * $detail_order_invoice['costo_caja']
                            )
                        * $this->type_change_order
                        );
                    
                }elseif ($this->incoterm == 'FOB'){
                    $fob = (
                        (   $detail_invoice['nro_cajas']
                            * $detail_order_invoice['costo_caja']
                            )
                        + ($this->gastos_origen * $percent)
                        ) * $this->type_change_order;
                        
                        $gasto_origen =
                        ($this->gastos_origen * $percent)
                        * $this->type_change_order;
                        
                }else{
                    $fob = (
                        (   $detail_invoice['nro_cajas']
                            * $detail_order_invoice['costo_caja']
                            )
                        ) * $this->type_change_order
                        + ($this->gastos_origen * $percent);
                        
                        $gasto_origen = ($this->gastos_origen * $percent);
                }
                
                return ([
                    'nombre'=> $product_base['nombre'],
                    'cod_contable' => $product['cod_contable'],
                    'cajas_importadas' => $detail_order_invoice['nro_cajas'],
                    'gasto_origen' => $gasto_origen,
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
                    'peso' => $product_base['peso'] ,
                    'grado_alcoholico' => $detail_order_invoice['grado_alcoholico'],
                    'fob' => $fob,
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
                $fob_invoice = 0.0;
                $prorrateos_pedido = 0.0;
                
                foreach($this->init_data['init_expenses'] as $idx => $gst_prorrateo){
                    $prorrateos_pedido += $gst_prorrateo['valor_provisionado'];
                }
                
                foreach ($this->init_data['order_invoices'] as $idx => $invoice){
                    $fob_invoice += $invoice['valor'];
                }
                
                $fob_percent = ( $fob_invoice
                    / ($product['costo_caja'] *  $product['cajas'])
                    );
                
                $tasa_control = 0.0;
                
                foreach ($this->init_data['init_expenses'] as $key => $value) {
                    if ($this->have_control_tasa){
                        if($value['concepto'] == 'TASA DE CONTROL ADUANERO'){
                            $tasa_control = (
                                $value['valor_provisionado']
                                * $fob_percent
                                );
                        }
                    }
                }
                
                $this->gastos_origen = (
                    $this->type_change_order * $this->gastos_origen
                    );
                
                $prorrateo_item = [
                    'fob_percent' => $fob_percent,
                    'fob_invoice' => $fob_invoice * $this->type_change_order,
                    'product' => $product,
                    'seguro_aduana' => $this->order['seguro_aduana'] * $fob_percent,
                    'flete_aduana' => $this->order['flete_aduana'] * $fob_percent,
                    'otros' =>  $this->order['otros'] * $fob_percent,
                    'gasto_origen' => $this->gastos_origen * $fob_percent,
                    'tasa_control' => $tasa_control,
                    'prorrateo_pedido' => $prorrateos_pedido * $fob_percent,
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
                
                $fodinfa = 0;
                
                if ($this->order['incoterm'] == 'FOB'){
                    $fodinfa =
                    (
                        $prorrateos['fob_invoice']
                        + $prorrateos['gasto_origen']
                        )
                        * $this->getTaxParam('FODINFA');
                        
                }elseif ($this->order['incoterm'] == 'CFR'){
                    $fodinfa = (
                        $prorrateos['fob_invoice'] + $prorrateos['gasto_origen']
                        )
                        * $this->getTaxParam('FODINFA');
                }else{
                    $fodinfa = $prorrateos['fob_invoice']
                    * $this->getTaxParam('FODINFA');
                }
                
                $etiquetas_fiscales = 0.0;
                
                if( $this->have_labes){
                    $etiquetas_fiscales  = (
                        $product['unidades']
                        * $this->getTaxParam('ETIQUETAS FISCALES')
                        );
                }
                
                $arancel_advalorem = (
                    $prorrateos['cif'] *
                    $this->getTaxParam('ARANCEL ADVALOREM')
                    );
                
                $arancel_advalorem_unitario = ($arancel_advalorem / $product['unidades']);
                
                $arancel_especifico = (
                    $this->getTaxParam('ARANCEL ESPECIFICO')
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
                    
                    $ex_aduana_unitario = ($exaduana/$product['unidades']);
                    
                    $ice_advalorem = 0;
                    $base_advalorem = ($this->getTaxParam('BASE ADVALOREM') * (
                        $product['capacidad_ml']/ $limite_capacidad));
                    
                    if ($ex_aduana_unitario > $base_advalorem){
                        $ice_advalorem = (
                            $ex_aduana_unitario - $base_advalorem
                            ) * $this->ice_advalorem_base
                            * $product['unidades'];
                    }
                    
                    $ice_advalorem_unitario =  $ice_advalorem / $product['unidades'];
                    
                    
                    $iva = (
                        $prorrateos['cif']
                        + $fodinfa
                        + $ice_advalorem
                        + $ice_especifico
                        + $arancel_advalorem_pagar
                        + $arancel_especifico_pagar
                        + $etiquetas_fiscales
                        + $prorrateos['tasa_control']
                        ) * $this->iva_base;
                        
                        $iva_total =
                        (
                            $prorrateos['cif']
                            + $fodinfa
                            + $ice_advalorem
                            + $ice_especifico
                            + $arancel_advalorem
                            + $arancel_especifico
                            + $etiquetas_fiscales
                            + $prorrateos['tasa_control']
                            ) * $this->iva_base;
                            
                            return ([
                                'fodinfa' => $fodinfa,
                                'base_ice_especifico' => $base_ice_especifico,
                                'ice_especifico' => $ice_especifico,
                                'ice_especifico_unitario' => ($ice_especifico/$product['unidades']),
                                'ex_aduana' => $exaduana,
                                'ex_aduana_unitario' => $ex_aduana_unitario,
                                'etiquetas_fiscales'=> $etiquetas_fiscales,
                                'base_advalorem' => $base_advalorem,
                                'gasto_origen' => $product['gasto_origen'],
                                'ice_advalorem' => $ice_advalorem,
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
                                'costo_total' =>(
                                    $product['fob']
                                    + $fodinfa
                                    + $ice_advalorem
                                    + $ice_especifico
                                    + $prorrateos['prorrateo_pedido']
                                    ),
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
            print $tax_name;
            return False;
        }
    }