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

class orderTaxes {
    
    private $init_data;
    private $param_taxes;
    private $order;
    private $iva_base = 0.12;
    private $ice_advalorem_base = 0.75;
    private $type_change_invoice = 0.0;
    private $type_change_order = 0.0;
    private $have_labes = True;
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
        
        $x = 1;
        foreach ($taxes['taxes'] as $dx => $tax){
            if($x == 1){
                $taxes['sums'] = $tax;
            }else{
                foreach ($taxes['sums'] as $tax_name => $val){
                    if (gettype($val) != 'string'){
                        $taxes['sums'][$tax_name] += $val;
                    }else{
                        $taxes['sums'][$tax_name] = 'String';
                    }
                }
            }
            $x++;
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
        
        
        return ([
            'nombre'=> $product_base['nombre'],
            'cod_contable' => $product['cod_contable'],
            'cajas_importadas' => $detail_order_invoice['nro_cajas'],
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
            'fob' => (
                $detail_invoice['nro_cajas']
                * $detail_order_invoice['costo_caja']
                * $this->type_change_invoice
                ),
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
                if(
                    $invoice['id_pedido_factura']
                    == $detail_invoice['id_pedido_factura']
                    ){
                        $fob_invoice = (
                            $invoice['valor']
                            * $this->type_change_invoice
                            );
                }
            }
            
            $fob_percent = ( $product['fob'] / $fob_invoice );
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
            
            $prorrateo_item = [
                'fob_percent' => $fob_percent,
                'seguro_aduana' => $this->order['seguro_aduana'] * $fob_percent,
                'flete_aduana' => $this->order['flete_aduana'] * $fob_percent,
                'otros' =>  $this->order['otros'] * $fob_percent,
                'tasa_control' => $tasa_control,
                'prorrateo_pedido' => $prorrateos_pedido * $fob_percent,
            ];
            
            $prorrateo_item ['cif'] = (
                (
                    (($product['fob'] / $this->type_change_invoice) * $this->type_change_order)
                    + $prorrateo_item['seguro_aduana']
                    + $prorrateo_item['flete_aduana'])
                * $fob_percent
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
            $fodinfa = ($prorrateos['cif'] * $this->getTaxParam('FODINFA'));
            
            $etiquetas_fiscales = 0.0;
            
            if( $this->have_labes){
                $etiquetas_fiscales  = (
                    $product['unidades']
                    * $this->getTaxParam('ETIQUETAS FISCALES')
                    );
            }
            
            $base_ice_especifico = $this->getTaxParam('ICE ESPECIFICO');
            
            $ice_especifico = (
                (
                    $base_ice_especifico
                    *
                    (
                        ($product['capacidad_ml'] / 1000 )
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
                );
            
            $ex_aduana_unitario = ($exaduana/$product['unidades']);
            
            $ice_advalorem = 0;
            $base_advalorem = ($this->getTaxParam('BASE ADVALOREM') * (
                $product['capacidad_ml']/ 1000));
            
            if ($ex_aduana_unitario > $base_advalorem){
                $ice_advalorem = (
                    $ex_aduana_unitario - $base_advalorem
                    ) * $this->ice_advalorem_base
                    * $product['unidades'];
            }
            
            $ice_advalorem_unitario =  $ice_advalorem / $product['unidades'];
            
            $arancel_advalorem = (
                $prorrateos['cif'] *
                $this->getTaxParam('ARANCEL ADVALOREM')
                );
            
            $arancel_especifico = 0;
            
            $iva = (
                $prorrateos['cif']
                + $fodinfa
                + $ice_advalorem
                + $ice_especifico
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
                    'ice_advalorem' => $ice_advalorem,
                    'ice_advalorem_unitario' => $ice_advalorem_unitario,
                    'ice_unitario'=> $ice_advalorem_unitario,
                    'arancel_especifico' => $arancel_especifico,
                    'arancel_advalorem' => $arancel_advalorem,
                    'total_ice' => $ice_advalorem +  $ice_especifico,
                    'iva' => $iva,
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
        return False;
    }
}