<?php 
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
    private $taxes_rates = [
        'FODINFA' => 0.0,
        'BASE ADVALOREM' => 0.0,
        'ICE ESPECIFICO' => 0.0,
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
            'product' => $product,
            'product_expenses' => $product_expenses,
            'taxes_product' => $taxes_product,
            'cif_item' => $cif,
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
                    $cif['seguro_aduana'] +
                    $cif['flete_aduana'] +
                    $cif['fob']
                        );
        
        print '<pre>';
        print_r($init_data);
        print '</pre>';
        
        return([
        'fodinfa' => ($cif_item * $taxes_rates['FODINFA']),
        'exaduana' => 0,
        'base_advalorem' =>  0,
        'fodinfa_unitario' => 0,
        'ice_especifico' => 0,
        'ice_advalorem' => 0,
        'otros' => 0,
        'exoneracion_exaduana' => 0,
       ]);
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
                ),
        ]);
    }
    
    
}