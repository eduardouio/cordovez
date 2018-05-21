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

class productTaxes {
    
    private $fob_product_percent = 0.0;
    private $type_change = 0.0;
    private $have_labes = True;
    private $have_control_tasa = True;
    private $current_prorrateo = [];
    private $taxes_rates = [
        'FODINFA' => 0.0,
        'BASE ADVALOREM' => 0.0,
        'ICE ESPECIFICO' => 0.0,
        'ICE ADVALOREM' => 0.0,
        'IVA' => 0.0,
        'OTROS' => 0.0,
    ];
    
    
    /**
     * Retorna un arreglo con el detalle de los impuestos
     *
     * @param array $init_data datos iniciales del Pedido
     *          order[
     *                  init_expenses,
     *                  order_invoices,
     *                  info_invices,
     *
     * @param array $prorrateo
     * @return array
     */
    public function getTaxesProduct(
                                    array $init_data, 
                                    array $prorrateo, 
                                    array $producto,
                                    array $param_taxes
        ): array
    {       
    
        $this->current_prorrateo = $prorrateo;
        
        $this->have_labes = boolval(
            $init_data['parcial']['bg_have_etiquetas_fiscales']
            );
        
        $this->have_control_tasa = boolval(
            $init_data['parcial']['bg_have_tasa_control']
            );
        
        $this->getPercentProduct(
                                $producto, 
                                $init_data,
                                $prorrateo['prorrateo']
            
            );
        $cif = $this->getCIF($prorrateo['prorrateo']);
        $product = $this->getProductData(
                                        $producto, 
                                        $init_data,
                                        $cif['fob']
            );
        
        $product_expenses = $this->calInitExpensesForItem(
                                             $prorrateo['prorrateo_detail'] 
            );
        
        
        $taxes_product = $this->getDetailTaxesProduct(
                                            $product,
                                            $cif,
                                            $param_taxes,
                                            $product_expenses,
                                            $init_data
            );
                
        return([
            'percent_product' => $this->fob_product_percent,
            'tipo_cambio' => $this->type_change,
            'product' => $product,
            'product_expenses' => $product_expenses,
            'taxes_product' => $taxes_product,
            'cif_item' => $cif,
            'params_taxes' => $this->taxes_rates,
        ]);
        
    }
    
    
  
    
    /**
     * Retorna los impuestos que se aplica al producto
     * 
     * @param array $product
     * @param array $cif
     * @param array $param_taxes
     * @return array
     */    
    private function getDetailTaxesProduct(
                                        array $product, 
                                        array $cif, 
                                        array $param_taxes,
                                        array $product_expenses,
                                        array $init_data
        ): array
    {
        
        foreach ($param_taxes as $item => $tax){
            
            $this->taxes_rates[$tax['concepto']] = $tax['valor']; 
        }
        
        $cif_item =  (
                    $cif['seguro_aduana'] 
                    +
                    $cif['flete_aduana'] 
                    +
                    ($cif['fob'] * $this->type_change )
            );
        
  
        $tasa_servicio_aduanero = 0.0;
        $etiquetas_fiscales = 0.0;
        
        foreach ($product_expenses as $item => $expense){
            
            if (
                ($expense['concepto'] == 'TASA DE SERVICIO ADUANERO')
                &&
                ($this->have_control_tasa == True)
                ){
                $tasa_servicio_aduanero = floatval(
                                                   $expense['valor_prorrateado']
                    );
            }
            
            if (
                ($expense['concepto'] == 'ETIQUETAS FISCALES')
                &&
                ($this->have_labes == True)
                ){
                $etiquetas_fiscales = floatval(
                    $expense['valor_prorrateado']
                    );
            }
            
        }
        
        $exaduana = (
            floatval($cif_item * $this->taxes_rates['FODINFA']) +
            $cif_item + 
            $etiquetas_fiscales +
            $tasa_servicio_aduanero +
            floatval($init_data['parcial']['otros']) +
            floatval($init_data['parcial']['exoneracion_arancel'])
            );
        
        $ice_advalorem = $this->getIceAdvalorem($exaduana, $product);
        
        
        return([
        'fodinfa' => ($cif_item * $this->taxes_rates['FODINFA']),
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
     * Retorna el valor del prorrateo de los gastos iniciales y del parcial
     * para el fob de item
     */
    private function getProrrateoItem(array $product_expenses): float
    {   
        
        $prorrateo_item = 0.0;
        foreach($product_expenses as $item => $expense)
        {
            
            if($this->have_control_tasa == False){
                if($expense['concepto'] == 'ETIQUETAS FISCALES'){
                    $expense['valor_prorrateado'] = 0;
                }
            }
            
            if($this->have_labes == False){
                if($expense['concepto'] == 'TASA DE SERVICIO ADUANERO'){
                    $expense['valor_prorrateado'] = 0;
                }
            }
            
            $prorrateo_item += (
                $expense['valor_prorrateado'] * $this->fob_product_percent
                );
         
            
        }        
        
        $percent_warenhouse = (
            $this->current_prorrateo['prorrateo']['bodegaje_prorrateado'] * 
            $this->fob_product_percent
            );
        return ($prorrateo_item + $percent_warenhouse);
    }
    
    /**
     * Retorna el iva para un item de la liquidacion
     * 
     * @param array $vals
     * @return float
     */
    private function getIvaItem($cif_item): float 
    {
      return 0;
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
     * Obtiene la distribucion de gastos iniciales del parcial para
     * cada uno de los items
     * 
     * @param array $prorrateo_detail el prorrtaeo del prcial
     * @return array
     */   
    private function calInitExpensesForItem(
                                                array $prorrateo_detail
                                            ):array
    {
        $expenses_item = [];
        
        foreach ($prorrateo_detail as $item => $expense){
            $expense['valor_prorrateado'] = (
                floatval($expense['valor_prorrateado']) 
                *
                $this->fob_product_percent
                );
            array_push($expenses_item, $expense);
        }
        
        return $expenses_item;
    }
    
    
    
    /**
     * Obtiene la relacion entre un producto y su factura
     * 
     * @param array $product
     * @param array $init_data
     * @param array $init_prorrateo
     * @return float
     */
    private function getPercentProduct( 
                                        array $product, 
                                        array $init_data,
                                        array $prorrateo
        
        )
    {
        
        $product_value = 0.0;
        $order_detail = $init_data['order_invoice_detail'];
        
        foreach ($order_detail as $idx => $prd){
            if(
                $prd['detalle_pedido_factura'] == 
                $product['detalle_pedido_factura']
                ){
                    $product_value = $prd['costo_caja'];
                    break;
            }
        }
        
        $this->fob_product_percent = floatval(
            ($product_value * $product['nro_cajas'])
            /
            $prorrateo['fob_parcial']
            );   
        
        if ( floatval($init_data['parcial']['tipo_cambio']) == 0 ){
                $this->type_change = 1;               
        }else{
            $this->type_change =  $init_data['parcial']['tipo_cambio'];
        }
    }
    
    
    
    /**
     * Retorna la Informacion del producto al que se le esta calculando el 
     * los aranceles
     * 
     * @param array $product
     * @param array $init_data
     * @return array
     */
    private function getProductData(array $product, array $init_data):array
    {
       
       $product_base = [];
       $product_box_value = 0.0;
       
       
       foreach ( $init_data['products_base'] as $item => $prd){
           if( 
               $prd['detalle_pedido_factura'] 
               == 
               $product['detalle_pedido_factura'])
           {
               $product_base = $prd;
               break;
              
           }
       }
       
       foreach ($init_data['order_invoice_detail'] as $item => $dt){
           if( 
               $product['detalle_pedido_factura']
               == 
               $dt['detalle_pedido_factura']
               ){
               $product_box_value = $dt['costo_caja'];
               break;
           }
       }
       
       
       return ([
           'unidades' => (
                            $product_base['cantidad_x_caja'] 
                            *  
                            $product['nro_cajas']
               ),
           'nro_cajas' => $product['nro_cajas'],
           'costo_caja' => $product_box_value,
           'producto' => $product_base['nombre'],
           'capacidad_ml' => $product_base['capacidad_ml'] ,
           'grado_alcoholico' =>$product['grado_alcoholico'],
           ]);
    }
    
    
    
    /**
    * Retorna el valor del CIF
    * @param $prorrateo
    * @return float $cifValue
    */
    private function getCIF( array $prorrateo ) : array
    {
        
        return([
            'flete_aduana' => ( 
                                $prorrateo['prorrateo_flete_aduana'] 
                                * 
                                $this->fob_product_percent
                ),
            'seguro_aduana' => (
                                $prorrateo['prorrateo_seguro_aduana'] 
                                * 
                                $this->fob_product_percent
                ),
            'fob' => (
                                $prorrateo['fob_parcial'] 
                                *
                                $this->fob_product_percent
                                *
                                $this->type_change
                ),
        ]);
    }
    
    
}
