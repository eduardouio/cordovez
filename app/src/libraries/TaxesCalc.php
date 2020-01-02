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

class TaxesCalc {        
    private $taxes = [];
    private $base_aranceles = [];
    private $type_change = 1;
    private $exoneration_arancel = 0;
    private $is_partial;
    private $parcial;
    
        
    
     /**
     * Datos iniciales del parcial
     * @param array $init_data => Facturas, productos, parcial
     * @param array $prorrateo prorrateos del parcial 
     * @param array $product
     * @param array $param_taxes
     */
    function __construct(
                            array $init_data,
                            array $param_taxes,
                            bool $is_partial = True
        )
    {
        $this->init_data = $init_data;
        $this->param_taxes =  $param_taxes;
        $this->gastos_origen = 0.0;
        $this->is_partial = $is_partial;
        
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
             
       $all_products = [];
       if ($this->is_partial){
           $all_products = $this->init_data['products'];
       }else{
           $all_products = $this->init_data['order_invoice_detail'];
       }
       
       foreach ($all_products as $item => $product){
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
       'tipo_cambio_parcial' => $this->type_change,
       'fob' => $taxes['sums']['fob'],
       'base_arancel_especifico' => $this->getTaxParam('ICE ESPECIFICO'),
       'base_advalorem' => $this->getTaxParam('BASE ADVALOREM'),
       'base_aranceles' => $this->base_aranceles,
       ];
       
       $taxes['data_general'] = $data_general;
                    
       return $taxes;
    }
    

    /**
     * Setea las consiguraciones iniciales para el calculo de los impuestos
     * Coloca los parametros para el calculo de impuestos
     */
    private function setConfiguration(){
        
        foreach ($this->init_data['order_invoices'] as $idx => $invoice){
            if ($idx == 0) {
                $this->type_change_invoice = $invoice['tipo_cambio'];
            }
        }
            
        if($this->is_partial){
            $this->type_change = $this->init_data['parcial']['tipo_cambio'];
    
            foreach ($this->init_data['info_invoices'] as $idx => $invoice){
                $this->gastos_origen += $invoice['gasto_origen'];
            }
        }else{
            $this->type_change = $this->init_data['order']['tipo_cambio_impuestosR10'];
            if (boolval(!$this->type_change)){
                $this->type_change = 1;
            }
            $this->gastos_origen = $this->init_data['order']['gasto_origen'];
        }

        $this->incoterm = strtoupper($this->init_data['order']['incoterm']);
        
        if ($this->is_partial){
            $this->exoneration_arancel = $this->init_data['parcial']['exoneracion_arancel']/100;
        }else{
            $this->exoneration_arancel = $this->init_data['order']['exoneracion_arancel']/100;
        }
        
    }
    
    
    /**
     * Retorna los impuestos para un producto
     * 
     * @return  array $taxes 
     * 
     */
    private function getTaxesProduct(array $detail_info_invoice): array {
        $product = $this->getProductData($detail_info_invoice);
        $taxes_product = $this->getDetailTaxesProduct($product);
        
        return([
                'product' => $product['nombre'],
                'cod_contable' => $product['cod_contable'],
                'cantidad_x_caja' => $product['cantidad_x_caja'],
                'cajas_importadas' => $product['cajas_importadas'],
                'unidades_importadas' => $product['unidades_importadas'],
                'etiquetas_fiscales' => ($product['unidades'] * $this->getTaxParam('ETIQUETAS FISCALES')),
                'cajas' => $product['cajas'],
                'unidades' => $product['unidades'],
                'costo_caja' => $product['costo_caja'],
                'costo_unidad' => $product['costo_unidad'],
                'peso' => $product['peso'], 
                'capacidad_ml'=> $product['capacidad_ml'],
                'grado_alcoholico'=> $product['grado_alcoholico'],
                'fob' => $product['fob'],
                'fob_percent' => $product['percent'],
                'seguro_aduana' => $product['seguro_aduana'],
                'flete_aduana' =>$product['flete_aduana'],
                'cif' => $product ['cif'], 
                'otros' =>  $product['otros'],                           
                'gasto_origen' => $product['gasto_origen'],
                'tasa_control' => $product['tasa_control'],
                'fodinfa' => $taxes_product['fodinfa'],
                'iva' => $taxes_product['iva'],               
                'iva_total' => $taxes_product['iva_total'],               
                'ex_aduana_antes' => $taxes_product['ex_aduana'],
                'ex_aduana_unitario_antes' => $taxes_product['ex_aduana_unitario'],
                'base_advalorem' => $taxes_product['base_advalorem'],
                'base_ice_epecifico' => $taxes_product['base_ice_especifico'],
                'ice_especifico' => $taxes_product['ice_especifico'],
                'ice_especifico_unitario' =>  $taxes_product['ice_especifico_unitario'],
                'ice_advalorem' => $taxes_product['ice_advalorem'],
                'ice_advalorem_unitario' => $taxes_product['ice_advalorem_unitario'],
                'arancel_especifico' => $taxes_product['arancel_especifico'],
                'arancel_advalorem' => $taxes_product['arancel_advalorem'],
                'arancel_especifico_unitario' => $taxes_product['arancel_especifico_unitario'],
                'arancel_advalorem_unitario' => $taxes_product['arancel_advalorem_unitario'],
                'arancel_especifico_liberado' => $taxes_product['arancel_especifico_liberado'],
                'arancel_advalorem_liberado' => $taxes_product['arancel_advalorem_liberado'],
                'arancel_especifico_pagar' => $taxes_product['arancel_especifico_pagar'],
                'arancel_advalorem_pagar' => $taxes_product['arancel_advalorem_pagar'],
                'ice_unitario'=> $taxes_product['ice_unitario'],
                'total_ice' => $taxes_product['total_ice'],
                'indirectos' => $taxes_product['indirectos'],
                'id_registro' => $product['id_registro'],
                ]);
    }  
    
    
    /**
     * Retorna la Informacion del producto al que se le esta calculando el
     * los aranceles
     *
     * @param array $product
     * @return array
     */
    private function getProductData(array $detail_info_invoice):array
    {
        $product_base = [];
        $detail_order_invoice = [];
        $id_registro = $detail_info_invoice['detalle_pedido_factura'];
        
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
        
        if ($this->is_partial){     
            $id_registro = $detail_info_invoice['id_factura_informativa_detalle'];
            
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
        }else{
            $detail_order_invoice = $detail_info_invoice;
        }
        
              
        #solo funciona para la primera factura informativa
        $total_invoices = 0;
        if ($this->is_partial){                
            if(is_array($this->init_data['info_invoices'][0])){
                foreach ($this->init_data['info_invoices'][0]['info_invoices_detail'] as $k => $det){
                    $total_invoices += ($det['costo_caja'] * $det['nro_cajas']);
                }
            }
        }else{
            $total_invoices = $this->init_data['order_invoices'][0]['valor'];
        }
        
        
        $fob = 0.0;
        $gasto_origen = 0.0;
        
        $percent = (
            ($detail_order_invoice['costo_caja'] 
                * $detail_info_invoice['nro_cajas']
                )
            / $total_invoices
            );
        
       
        if ($this->incoterm == 'CFR'){               
            #solo primera factura
            $fob = (
                (
                    $detail_info_invoice['nro_cajas']
                    * $detail_order_invoice['costo_caja']
                    )
                * $this->type_change
                );
            
        }elseif ($this->incoterm == 'FOB'){            
            $fob = (
                (   $detail_info_invoice['nro_cajas']
                    * $detail_order_invoice['costo_caja']
                    )
                + ($this->gastos_origen * $percent)
                ) * $this->type_change;
                
                $gasto_origen =
                ($this->gastos_origen * $percent)
                * $this->type_change;
        }else{    
            $fob =( $detail_info_invoice['nro_cajas']
                        * $detail_order_invoice['costo_caja']) ;
            if($this->is_partial){
                $fob +=  $detail_info_invoice['gasto_origen'] * $this->type_change;
                $gasto_origen = $detail_info_invoice['gasto_origen'];
            }else{
                $fob += ($this->gastos_origen * $percent);
            }         
                
        }
        
        $seguro_aduana = 0 ;
        $flete_aduana = 0 ;
        
        if ($this->is_partial){
            $seguro_aduana = $percent * $this->init_data['info_invoices'][0]['flete_aduana'] * $this->type_change;
            $flete_aduana = $percent * $this->init_data['info_invoices'][0]['seguro_aduana'] * $this->type_change;
        }else{
            $seguro_aduana = $percent * $this->init_data['order']['flete_aduana'] ;
            $flete_aduana = $percent * $this->init_data['order']['seguro_aduana'];
        }
        
        return ([
            'id_registro' => $id_registro,
            'nombre'=> $product_base['nombre'],
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
            'peso' => $detail_info_invoice['peso'] ,
            'percent' => $percent,
            'grado_alcoholico' => $detail_info_invoice['grado_alcoholico'],
            'tasa_control' => $detail_info_invoice['tasa_control'],
            'otros' => $detail_info_invoice['otros'],
            'fob' => $fob,
            'seguro_aduana' => $seguro_aduana,
            'flete_aduana' => $flete_aduana,
            'cif' => (
                $fob
                + $seguro_aduana
                + $flete_aduana
                ),
        ]);
    }
    
               
    /**
     * Retorna los impuestos que se aplica al producto
     * 
     * @param array $product
     * @param array $prorateos
     * @return array
     */    
    private function getDetailTaxesProduct(
                                            array $product
        ): array
    {   
        
        $this->base_aranceles = [
            'base_fodinfa' => $this->getTaxParam('FODINFA'),
            'base_arancel_advalorem' => $this->getTaxParam('ARANCEL ADVALOREM'),
            'base_arancel_especifico' => $this->getTaxParam('ARANCEL ESPECIFICO'),
            'base_ice_especifico' => $this->getTaxParam('ICE ESPECIFICO'),
            'base_ice_advalorem' => $this->getTaxParam('BASE ADVALOREM'),
            'porcentaje_ice_advalorem' => 0.75,
            'base_iva' => $this->getTaxParam('IVA'),
            'base_etiquetas' => $this->getTaxParam('ETIQUETAS FISCALES'),
        ];
        
        #PAra validar cuando un producto tiene mas de un litro
        $limite_capacidad = 1000;    
        
        
        $base_fodinfa = $product['cif'];  
        $fodinfa = ($base_fodinfa * $this->getTaxParam('FODINFA'));
                      
        $arancel_advalorem = (
            $product['cif'] *
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
            * $this->exoneration_arancel
            );
        
        $arancel_advalorem_liberado =  (
            $arancel_advalorem
            * $this->exoneration_arancel
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
                
        $exaduana = (
           $fodinfa
           + $product['cif']
           + $product['tasa_control']
           + $product['otros']
           + $arancel_especifico_pagar
           + $arancel_advalorem_pagar
           );

       $ex_aduana_unitario = ($exaduana/$product['unidades']);

       $ice_advalorem = 0;  
       $base_advalorem = ($this->getTaxParam('BASE ADVALOREM') * (
           $product['capacidad_ml']/ 1000));
   
       if ($ex_aduana_unitario > $base_advalorem){
            $ice_advalorem = (
                $ex_aduana_unitario - $base_advalorem
            ) * 0.75
            * $product['unidades'];
       }

       $ice_advalorem_unitario =  $ice_advalorem / $product['unidades'];
       
       $arancel_advalorem = (
           $product['cif'] *
           $this->getTaxParam('ARANCEL ADVALOREM')
           );
       
       $iva = (
           $product['cif']
           + $fodinfa
           + $ice_advalorem
           + $ice_especifico
           + $arancel_especifico_pagar
           + $arancel_advalorem_pagar
           + $product['tasa_control']
           ) * $this->getTaxParam('IVA');
       
           $iva_total = (
               $product['cif']
               + $fodinfa
               + $ice_advalorem
               + $ice_especifico
               + $arancel_especifico
               + $arancel_advalorem
               ) * $this->getTaxParam('IVA');
              
        return ([
            'fodinfa' => $fodinfa,
            'base_ice_especifico' => $base_ice_especifico,
            'ice_especifico' => $ice_especifico,
            'ice_especifico_unitario' => ($ice_especifico/$product['unidades']),
            'ex_aduana' => $exaduana,
            'ex_aduana_unitario' => $ex_aduana_unitario,
            'tasa_control' => $product['tasa_control'],
            'gasto_origen' => $product['gasto_origen'],
            'base_advalorem' => $base_advalorem,
            'ice_advalorem' => $ice_advalorem,
            'ice_advalorem_unitario' => $ice_advalorem_unitario,
            'ice_unitario'=> $ice_advalorem_unitario,
            'arancel_advalorem' => $arancel_advalorem,
            'arancel_especifico' => $arancel_especifico,
            'arancel_especifico_unitario' => $arancel_especifico_unitario,
            'arancel_advalorem_unitario' => $arancel_advalorem_unitario,
            'arancel_especifico_liberado' => $arancel_especifico_liberado,
            'arancel_advalorem_liberado' => $arancel_advalorem_liberado,
            'arancel_especifico_pagar' => $arancel_especifico_pagar,
            'arancel_advalorem_pagar' => $arancel_advalorem_pagar,
            'total_ice' => $ice_advalorem +  $ice_especifico, 
            'iva' => $iva,    
            'iva_total' => $iva_total,
            'indirectos' => (
                $iva
                +$ice_advalorem 
                +$ice_especifico
                +$fodinfa
                +$arancel_especifico_pagar
                +$arancel_advalorem_pagar
                + $product['tasa_control']
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