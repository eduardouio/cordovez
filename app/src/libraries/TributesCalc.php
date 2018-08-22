<?php
/**
 * Clase encargada de calcular los tributos de un parcial o un pedido
 *
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @version 1.0
 * @copyright 2018 Representaciones Cordovez
 * @license Representaciones Cordovez
 * @package Controllers
 */
class TributesCalc
{
    private $order;
    private $partial;
    private $invoice;
    private $invoice_detail;
    private $info_invoice;
    private $info_invoice_detail;
    private $param_taxes;
    private $products_data;
    private $apportionment;   
    public $type_change = 1;
    public $have_tasa;
    public $total_fob = 0;
    public $exoneracion_arancel = 100;
    
    
    /**
     * Constructor de la clase
     * 
     * @param array $order pedido
     * @param array $parcial parcial
     * @param array $invoice cabeceras de factura
     * @param array $invoice_details detalles de fatura
     * @param array $param_taxes parametros de impuestos
     * @param array $prorrateo fichas de los productos
     * @param array $products_data fichas de los productos
     * @param bool $is_order [opcional] indica si es pedido o Factura informativa
     */
    function __construct(
                        array $order, 
                        array $partial, 
                        array $invoice, 
                        array $invoice_details, 
                        array $param_taxes, 
                        array $products_data,
                        array $apportionment,
                        bool  $is_order,
                        array $info_invoice,
                        array $info_invoice_detail
        )
    {
     $this->order = $order;
     $this->partial = $partial;
     $this->invoice = $invoice;
     $this->invoice_detail = $invoice_details;
     $this->param_taxes = $param_taxes;
     $this->products_data = $products_data;
     $this->apportionment = $apportionment;
     $this->is_order = $is_order;
     $this->info_invoice = $info_invoice;
     $this->info_invoice_detail = $info_invoice_detail;
     
     
     if($this->invoice_detail){
         foreach ($this->invoice_detail as $k => $detail){
             $this->total_fob += round((
                 intval($detail['nro_cajas']) *  
                 floatval($detail['costo_caja'])
                 ), 3);
         }
       }
       
       if($is_order){
           $this->type_change = $order['tipo_cambio_impuestosR10'];    
           $this->have_tasa = boolval($order['bg_have_tasa_control']);
           $this->exoneracion_arancel = $order['exoneracion_arancel'];
       }else{
           $this->type_change = $partial['tipo_cambio'];
           $this->have_tasa = boolval($partial['bg_have_tasa_control']);
           $this->exoneracion_arancel = $partial['exoneracion_arancel'];
       }
    }   
    
    
    /**
     * Retorna el total de los tributos
     */
    public function getTaxes(){
        $taxes = [
            'taxes' => [],
            'sums' => [],           
        ];
                
        foreach ($this->invoice_detail as $k => $product){
            array_push($taxes['taxes'],   
                            $this->getTaxesProduct(
                                $this->getProrrateo(
                                    $this->getProductData($product)
                                )
                            )
                );
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
                
                if(!is_string($tax[$tax_name])){
                    $taxes['sums'][$tax_name] += floatval($tax[$tax_name]);
                }else{
                    $taxes['sums'][$tax_name] += 0;
                }
                
            }
        }       
                
        return $taxes;
        
    }
    
    
    /**
     * Obtiene los impuestos de un producto
     * 
     * @param array $product
     * @return array
     */
    public function getTaxesProduct(array $product): array{
        $product['fodinfa'] = round(
            ($product['cif'] * $this->getTaxesParams('FODINFA'))
            ,5);
        
        $product['arancel_advalorem'] = round(
            (
            $product['cif'] *
            $this->getTaxesParams('ARANCEL ADVALOREM')
            )
            , 5);
        
        $product['arancel_advalorem_liberado'] = round(
            ($product['arancel_advalorem'] * ($this->exoneracion_arancel / 100))
            ,5);
        
        
        $product['arancel_advalorem_pagar'] = round((
            $product['arancel_advalorem'] - $product['arancel_advalorem_liberado']
            ),5);
        
        $product['arancel_especifico'] = round(
            (
                $this->getTaxesParams('ARANCEL ESPECIFICO')
                * (
                    ($product['capacidad_ml'] / 1000) * $product['grado_alcoholico'])
                ) * $product['unidades']
            ,5);
        
        $product['arancel_especifico_liberado'] = round(
            ($product['arancel_especifico'] * ($this->exoneracion_arancel / 100))
            ,5);
        
        $product['arancel_especifico_pagar'] = (
            $product['arancel_especifico'] - $product['arancel_especifico_liberado']
            );
        
        $product['ice_especifico'] = round((
            (
                $this->getTaxesParams('ICE ESPECIFICO')
                *
                (
                    ($product['capacidad_ml'] / 1000)
                    *
                    ($product['grado_alcoholico']/ 100)
                    )
                )
            * $product['unidades']
            ), 5);
        
        $exaduana = (
            $product['cif']
            + $product['tasa_control']
            + $product['arancel_advalorem_pagar']
            + $product['arancel_especifico_pagar']
            );
        
        $product['base_advalorem']= ($this->getTaxesParams('BASE ADVALOREM') * (
            $product['capacidad_ml']/ 1000));  
        
        $product['exaduana_unitario'] = round(($exaduana/$product['unidades']), 5);
        
        if($product['exaduana_unitario'] > $product['base_advalorem']){
            $product['ice_advalorem'] = (
                $product['exaduana_unitario'] - $product['base_advalorem']
                ) * 0.75
                * $product['unidades'];
        }else{
            $product['ice_advalorem'] = 0.0;
        }
        
        $product['total_ice'] = (
            $product['ice_advalorem'] + $product['ice_especifico']
            );
        
        $product['iva'] = round(
            (
            $product['cif']
            + $product['fodinfa']
            + $product['arancel_advalorem']
            + $product['arancel_especifico']
            + $product['total_ice']
            + $product['tasa_control']
            )  * $this->getTaxesParams('IVA')
            ,5);
               
        
        $product['iva_pagar'] = round(
            (
                $product['cif']
                + $product['fodinfa']
                + $product['arancel_advalorem_pagar']
                + $product['arancel_especifico_pagar']
                + $product['total_ice']
                + $product['tasa_control']
                )  * $this->getTaxesParams('IVA')
            ,5);
        
        $product['iva_liberado'] = round(
            ($product['iva'] - $product['iva_pagar'])
            , 5);
        
        return $product;
    }
    
    
    
    /**
     * Obtiene el prorrateo de gastos en origen y tasa de control
     * @param $product $product de liquidaicion
     */
    public function getProrrateo(array $product): array {
        
        $product['gasto_origen'] = (
            ($this->apportionment['gasto_origen'] 
             * $this->apportionment['tipo_cambio_gasto_origen'])
            * $product['porcentaje']
            );
        
        $product['tasa_control'] = 0;
            
        if($this->have_tasa){
            if ($this->apportionment['tasa_base_fob']){
                $product['tasa_control'] = round((
                    $this->apportionment['tasa_control']
                    * $product['porcentaje']
                    ),5);
                
            }else{
                $peso_item = (
                    ($product['peso'] / $product['cajas_importadas'])
                    * $product['nro_cajas']
                    );
                
                $product['tasa_control'] = round((
                    $peso_item * 0.05
                    ), 5) ;
            }
        }        
                        
        $product['etiquetas_fiscales'] = (
            $product['unidades']
            * $this->getTaxesParams('ETIQUETAS FISCALES')
            );
        
        $product['fob'] = round(
            ((
            $product['valor_item'] * $this->type_change
            ) + $product['gasto_origen']),5);
        
            
            $product['seguro_aduana'] = round(
                (
                  ($this->apportionment['seguro_aduana'] * $product['porcentaje']) 
                * $this->apportionment['tipo_cambio_seguro_flete'])
                ,5
                );
            
            $product['flete_aduana'] = round(
                (
                    ($this->apportionment['flete_aduana'] * $product['porcentaje']) 
                    * $this->apportionment['tipo_cambio_seguro_flete'])
                ,5
                );     
            
        $product['cif'] = (
            $product['fob'] 
            + $product['seguro_aduana']
            + $product['flete_aduana']
            );
            
        return $product;
    }    
       
    
    /**
     * Obtiene la informacion del producto
     * 
     * @param string $cod_contable
     */
    public function getProductData(array $invoice_detail) : array{              
       
        if(count($invoice_detail) == 0){
         return [];   
        }
        
       $product_base = [];
       
       foreach ($this->products_data as $i => $product){
           if($invoice_detail['cod_contable'] == $product['cod_contable']){
               
               $product_base = [
                   'cod_contable' => $product['cod_contable'],
                   'nombre' => $product['nombre'],
                   'capacidad_ml' => $product['capacidad_ml'],
                   'cantidad_x_caja' => $product['cantidad_x_caja'],
                   'fob' => 0.0,
                   'gasto_origen' => 0.0,
                   'fob_porcentaje' => 0.0,
               ];
           }
       }      
       
       $product_base['porcentaje'] = round(
               ( $invoice_detail['nro_cajas'] * $invoice_detail['costo_caja'])
                / $this->total_fob
           ,3);
             
       return ([
           'cod_contable' => $product_base['cod_contable'],
           'nombre'=> $product_base['nombre'],
           'cantidad_x_caja' => $product_base['cantidad_x_caja'],
           'nro_cajas' => $invoice_detail['nro_cajas'],
           'cajas_importadas' => $invoice_detail['cajas_importadas'],
           'unidades' => $invoice_detail['nro_cajas'] * $product_base['cantidad_x_caja'],
           'costo_caja' => $invoice_detail['costo_caja'],           
           'capacidad_ml' =>  $product_base['capacidad_ml'] ,
           'grado_alcoholico' => $invoice_detail['grado_alcoholico'],
           'porcentaje' => $product_base['porcentaje'],
           'peso' => $invoice_detail['peso'] ,
           'valor_item' => $invoice_detail['nro_cajas'] * $invoice_detail['costo_caja'],
       ]);      
    }   
    
    
    /**
     * 
     * @param string $taxe_name
     * @return array
     */
    public  function getTaxesParams(string $taxe_name) : float {
        
        foreach ($this->param_taxes as $key => $tax) {
            if($tax['concepto'] == $taxe_name){
                return floatval($tax['valor']);
            }
        }
        
        return 0;
    }
    
}