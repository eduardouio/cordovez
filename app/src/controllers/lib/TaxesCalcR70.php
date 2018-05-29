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

class parcialTaxes {
    private $init_data;
    private $prorrateo;
    private $param_taxes;
    private $parcial;
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
       $taxes = [];
       
       foreach ($this->init_data['products'] as $item => $product){
           array_push($taxes, $this->getTaxesProduct($product));
       }
    }
    

    /**
     * Setea las consiguraciones iniciales para el calculo de los impuestos
     * Coloca los parametros para el calculo de impuestos
     */
    private function setConfiguration(){
        
        foreach ($this->init_data['order_invoices'] as $idx => $invoice){
            if ($idx == 0) {
                $this->type_change_invoice = $invoice['tipo_cambio'];
            };

            if ( floatval($this->init_data['parcial']['tipo_cambio']) == 0 ){
                $this->type_change_parcial = 1;
            }else{
                $this->type_change_parcial =  
                                    $this->init_data['parcial']['tipo_cambio'];
            }
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
                'cantidad_x_caja' => $product['cantidad_x_caja'],
                'cajas_importadas' => $product['cajas_importadas'],
                'uindades_importadas' => $product['unidades_importadas'],
                'cajas' => $product['cajas'],
                'uindades' => $product['unidades'],
                'costo_caja' => $product['costo_x_caja'],
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
                'prorrateo_parcial' => $prorrateo['prorrateo_parcial'],
                'prorrateo_pedido' => $prorrateo['prorrateo_pedido'],
                'prorrateos_total' => $prorrateo['prorrateos_total'],
                'tasa_control' => $prorrateo['tasa_control'],
                'tasa_control' => $taxes_product['tasa_control'],
                'fodinfa' => $taxes_product['fodinfa'],
                'iva' => $taxes_product['iva'],
                'ex_aduana' => $taxes_product['ex_aduana'],
                'arancel_especifico_unitario' => 
                                    $taxes_product['arancel_especifico_unitario'],
                'arancel_advalorem_unitario' => 
                                    $taxes_product['arancel_advalorem_unitario'],
                'reliquidacion_ice_advalorem' => 
                                    $taxes_product['reliquidacion_ice_advalorem'],
                'etiquetas_fiscales'=> $taxes_product['etiquetas_fiscales'],
                'ice_unitario'=> $taxes_product['ice_unitario'],
                'total_ice' => $taxes_product['total_ice'],
                'costo_total' => $taxes_product['costo_total'],
                'costo_caja'=> $taxes_product['costo_caja'],
                'costo_botella'=> $taxes_product['costo_botella'],
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
        
        return ([
            'nombre'=> $product_base['nombre'],
            'cod_contable' => $product['cod_contable'],
            'cajas_importadas' => $detail_order_invoice['nro_cajas'],
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
            'costo_x_caja' => $detail_order_invoice['costo_caja'],
            'costo_unidad' => (
                            $detail_order_invoice['costo_caja']
                            / $product_base['cantidad_x_caja']
                ),
            'capacidad_ml' =>  $product_base['capacidad_ml'] ,
            'peso' => $product_base['peso'] ,
            'grado_alcoholico' => $product_base['grado_alcoholico'],
            'fob' => (
                $detail_info_invoice['nro_cajas']
                * $detail_order_invoice['costo_caja']
                * $this->type_change_invoice
                ),
        ]);
    }
    
    
    /**
     * Retorna el valor del prorrateo de los gastos iniciales y del parcial
     * para el fob de item
     */
    private function getProrrateoItem(
                                    array $detail_info_invoice,
                                    array $product
                                    ): array
    {   
        $prorrateo = $this->prorrateo['prorrateo'];
        $prorrateo_detail = $this->prorrateo['prorrateo_detail'];
        $fob_info_invoice = 0.0;
        $prorrateos_pedido = 0.0;
        
        # se quita el valor de la bodega del prorrateo del parcial
        # y se suma el valor que le corresponde 
        $prorrateos_parcial = (-1 * $prorrateo['bodegaje_parcial'])
                                 + $prorrateo['bodegaje_prorrateado'];
        
        foreach($this->prorrateo['prorrateo_detail'] as $idx => $gst_prorrateo){
            if ($gst_prorrateo['tipo'] == 'prorrateo'){
                $prorrateos_parcial += $gst_prorrateo['valor_prorrateado'];
            }else{
                $prorrateos_pedido += $gst_prorrateo['valor_prorrateado'];
            }
        }
        
        
        
        foreach ($this->init_data['info_invoices'] as $idx => $invoice){
            if(
                $invoice['id_factura_informativa'] 
                == $detail_info_invoice['id_factura_informativa']
                ){
                $fob_info_invoice = (
                    $invoice['valor']
                    * $this->type_change_invoice
                    );
            }
        }
        
        $fob_percent = ( $product['fob'] / $fob_info_invoice );
        $tasa_control = 0.0;
        foreach ($prorrateo_detail as $key => $value) {
            if($value['concepto'] == 'TASA DE CONTROL ADUANERO'){
                $tasa_control = (
                    $value['valor_prorrateado']
                    * $fob_percent
                );
            }
        }   
        
        $prorrateo_item = [
            'fob_percent' => $fob_percent,
            'seguro_aduana' => ($prorrateo['prorrateo_seguro_aduana']
                                * $fob_percent),
            'flete_aduana' => (
                                $prorrateo['prorrateo_flete_aduana']
                                * $fob_percent
                                ),
            'otros' =>  $this->parcial['otros'] * $fob_percent,
            'tasa_control' => $tasa_control,
            'prorrateo_parcial' => $prorrateos_parcial * $fob_percent,
            'prorrateo_pedido' => $prorrateos_pedido * $fob_percent,
            'prorrateos_total' => (
                                    ($prorrateos_parcial + $prorrateos_pedido) 
                                    * $fob_percent
                ),
        ];
        $prorrateo_item ['cif'] = (
                            ($product['fob'] 
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
        $etiquetas_fiscales =  $product['unidades'] * 0.13;

        print('<pre>') ;
        print_r($product);
        print_r($prorrateos);
        print_r($this->param_taxes);

        return ([
            'fodinfa' => $fodinfa,
            'iva' => '',
            'ex_aduana' => '',
            'arancel_especifico_unitario' => '',
            'arancel_advalorem_unitario' => '',
            'reliquidacion_ice_advalorem' => '',
            'etiquetas_fiscales'=> '',
            'ice_unitario'=> '',
            'total_ice' => '',
            'costo_total' => '',
            'costo_caja'=> '',
            'costo_botella'=> '',
        ]);
        
        return([
        'etiquetas_fiscales' => $etiquetas_fiscales,
        'tasa_servicio_aduanero' => $tasa_servicio_aduanero,
        'ice_especifico' => $this->getICEEspecifico($product),
        'otros' => $init_data['parcial']['otros'],
        'exoneracion_exaduana' => $init_data['parcial']['exoneracion_arancel'] ,
        'exaduana' => $exaduana,
        'base_advalorem' =>  $ice_advalorem['base'],
        'ice_advalorem' => $ice_advalorem['value'],
        'base_iva' => $this->taxes_rates['IVA'],
        'iva' => $this->getIvaItem($cif_item),
        'cif_item' => $cif_item,
        'prorrateos_item' => $this->getProrrateoItem($product_expenses),
       ]);
    }
    
    
    /**
     * Retorna el ice advalorem
     * SI EX ADUANA ANTES ETIQUETAS FISCALES ES MAYOR QUE CAPACIDAD*4,33/1000
     * GRAVA EL ICE ADVALOREN TARIFA ES 0,75 DEL EXADUANA POR NUMERO DE BOTELLAS
     * @return array
     */
    private function getIceAdvalorem(float $exaduana, array $product) : array
    {
        $exaduana = ($exaduana / $product['unidades']);
        
        $iceAdvalorem = [
            'base' => ($this->taxes_rates['BASE ADVALOREM']  *
                $product['capacidad_ml'])/1000,
            'value' => 0.0,
        ];
        
        
        if( $exaduana > $this->taxes_rates['BASE ADVALOREM']){
            $iceAdvalorem['value'] = ( $exaduana - $iceAdvalorem['base'] )
            * .75
            * $product['unidades'];
        }
        
        return $iceAdvalorem;
        
    }
    
    
    /**
     * Retorna el valor del ICE
     * 7,24*CAPACIDAD/1000*GRADO ALCOHOLICO/100*No. Botellas
     * @return float iceEspecifico
     */
    
    private function getICEEspecifico(array $product) : float
    {
        
        return ((
            ($this->taxes_rates['ICE ESPECIFICO'] * 
            $product['capacidad_ml'] / 1000)
            * 
            ($product['grado_alcoholico'] / 100)
            ) * $product['unidades']);
    }
    

    /**
     * Retorna el porcentaje para un impuesto o el valor
     */
    private function getTaxParam(string $tax_name ):float
    {
        foreach ($this->param_taxes as $key => $tax) {
            if($tax['concepto'] == $tax_name){
                return $tax['valor'];
            }
            return False;
        }
    }    
}
