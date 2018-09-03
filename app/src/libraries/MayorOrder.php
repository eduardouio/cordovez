<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Realiza la comprobacion con el mayor de los gastos de nacionalizacion
 *
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @version 1.0
 * @copyright 2018 Representaciones Cordovez
 * @license Representaciones Cordovez
 * @package Controllers
 */
class MayorOrder {
    private $order;
    private $order_invoices;
    private $init_expenses;
    private $parcials;
    private $tipo_cambio_pedido;
    private $index_last_parcial;
    
    
    function __construct(
        array $order, 
        array $order_invoices,
        array $init_expenses, 
        array $parcials
        )
    {
            
        $this->order = $order;
        $this->order_invoices = $order_invoices;
        $this->init_expenses = $init_expenses;
        $this->parcials= $parcials;
        $this->setConfiguration();
    }
    
    
    /**
     * Sete la configuracion de la clase
     */
    private function setConfiguration(){
        #Sin tipo de cambio lo tomamos como dolares
        if(floatval($this->order_invoices['tipo_cambio']) == 0){
            $this->tipo_cambio_pedido = 1;
        }
        
        if($this->order['incoterm'] != 'FCA' || $this->order['incoterm'] != 'EXW'){
            $this->tipo_cambio_pedido = $this->order_invoices['tipo_cambio'];
        }else{
            $this->tipo_cambio_pedido = 1;
        }
        
        #marcamos el indice del ultimo parcial
        $this->index_last_parcial = (count($this->parcials) - 1); 
    }
    
    
    /**
     * Retorna los datos del mayor
     */
    public function get() :array{
        $mayor = [
            'mayor_gastos_origen' => $this->getMayorOriginExpenses(),
            'mayor_gastos_inciales' => $this->getMayorInitExpenses(),
            'mayor_parcial_expenses' => $this->getMayorParcialExpenses(),
            'mayor_almacenaje' => $this->getMayorAlmacenaje(),
            'mayor_tributos' => $this->getMayorTributes(),
            'mayor_productos' => $this->getMayorProduct(),
        ];
        
        return $mayor;
    }   
    
    
    /**
     * Ontiene el mayor de los gastos en origen
     * @return array
     */
    private function getMayorOriginExpenses():array{
        $mayor_origin_expesnes = [
            'tipo' => 'Mayor Gastos Origen',
            'valor_inicial' => $this->order['gasto_origen'] * $this->tipo_cambio_pedido,
            'valor_distribuido' => 0.0,
            'valor_por_distribuir' => 0.0,
        ]; 
        
        foreach ($this->parcials as $k => $parcial){
            $mayor_origin_expesnes['valor_distribuido'] += (
                $parcial['prorrateos']['porcentaje_parcial'] 
                * $mayor_origin_expesnes['valor_inicial']
               );                  
        }
        
        $mayor_origin_expesnes['valor_por_distribuir'] = (
            $mayor_origin_expesnes['valor_inicial'] 
            - $mayor_origin_expesnes['valor_distribuido']
            );
            
        return $mayor_origin_expesnes;
    }
    
    
    /**
     * Obtiene el saldo de mayor para los gastos iniciales y de nacionalizacion
     * @return array
     */
    private function getMayorInitExpenses():array{
       $mayor_init_expenses = [
           'tipo' => 'Mayor Gastos Iniciales',
           'valor_inicial' => 0.0,
           'valor_distribuido' => 0.0,
           'valor_por_distribuir' => 0.0,
       ];
       
       foreach ($this->init_expenses as $k => $iexp){
           $mayor_init_expenses['valor_inicial'] += $iexp['valor_provisionado'];
       }
              
       foreach ($this->parcials as $k => $parcial){
           if($parcial['prorrateos']['detalle_prorrateo']){
               foreach ($parcial['prorrateos']['detalle_prorrateo'] as $i=> $prorrateo){
                   $mayor_init_expenses['valor_distribuido'] += $prorrateo['valor_prorrateado'];
               }
           }
       }
       
       $mayor_init_expenses['valor_por_distribuir'] = (
           $mayor_init_expenses['valor_inicial'] - $mayor_init_expenses['valor_distribuido']
           );
       
       return $mayor_init_expenses;
    }
    
    
    /**
     * Obtiene el saldo de mayor para los gastos iniciales y de nacionalizacion
     * @return array
     */
    private function getMayorParcialExpenses():array{
        $mayor_parcial_expenses = [
            'tipo' => 'Mayor Gastos Parcial',
            'valor_inicial' => 0.0,
            'valor_distribuido' => 0.0,
            'valor_por_distribuir' => 0.0,
        ];
       
        $current_parcial = $this->parcials[$this->index_last_parcial];
        
        if($current_parcial['expenses']){
            foreach ($current_parcial['expenses'] as $k => $expense) {
                if(!preg_match('/[a-zA-Z]-[0-9]/' , $expense['concepto'] ) )
                {
                    $mayor_parcial_expenses['valor_inicial'] += $expense['valor_provisionado']; 
                }
            }
        }
        
        $mayor_parcial_expenses['valor_distribuido'] = $mayor_parcial_expenses['valor_inicial'];
        
        return $mayor_parcial_expenses;
    }
    
    
    /**
     * Obtiene el valor del mayor para los bodegajes del parciales
     * @return array
     */
    private function getMayorAlmacenaje():array{
        $mayor_almacenaje = [
            'tipo' => 'Mayor Almacenaje Parcial',
            'valor_inicial' => 0.0,
            'valor_distribuido' => 0.0,
            'valor_por_distribuir' => 0.0,
        ];
        
        foreach ($this->parcials as $k => $parcial){
            if($parcial['expenses']){
                foreach ($parcial['expenses'] as $k => $expense) {
                    if(preg_match('/[a-zA-Z]-[0-9]/' , $expense['concepto'] ) )
                    {
                        $mayor_almacenaje['valor_inicial'] += $expense['valor_provisionado'];
                    }
                }
            }
            
            $mayor_almacenaje['valor_distribuido'] += $parcial['prorrateos']['almacenaje_aplicado'];        
        }        
        
        $mayor_almacenaje['valor_por_distribuir'] = $mayor_almacenaje['valor_inicial'] - $mayor_almacenaje['valor_distribuido'];
        
        return $mayor_almacenaje;
    }
    
    
    
    /**
     * Retorna el valor de mayor para tributos
     */
    private function getMayorTributes():array{
        $current_parcial = $this->parcials[$this->index_last_parcial];
        
        $mayor_tributos = [
            'tipo' => 'Mayor Tributos',
            'valor_inicial' => 0.0,
            'valor_distribuido' => 0.0,
            'valor_por_distribuir' => 0.0,
        ];
        
        
        $tributos = [
            'fodinfa' => $current_parcial['fodinfa_pagado'],
            'arancel_especifico' => $current_parcial['arancel_especifico_pagar_pagado'],
            'arancel_advalorem' => $current_parcial['arancel_advalorem_pagar_pagado'],
            'ice_especifico' => $current_parcial['ice_especifico'],          
            'ice_advalorem' =>0.0,
            'ice_advalorem_pagado' => $current_parcial['ice_advalorem_pagado'],
            'ice_advalorem_reliquidado' => 0.0,
        ];
        
       #para todos primero recorrer los parciales sobre este codigo
        if($current_parcial['info_invoices']){
            foreach ($current_parcial['info_invoices'] as $k => $infoinvoice){
                  foreach ($infoinvoice['info_invoices_detail'] as $i => $detalle) {
                      $tributos['ice_advalorem'] =+ $detalle['ice_advalorem'];
                  } 
            }
        }
        
        $tributos['ice_advalorem_reliquidado'] = ($tributos['ice_advalorem'] - $tributos['ice_advalorem_pagado']);
        
        $mayor_tributos['valor_inicial'] = $mayor_tributos['valor_distribuido'] += (
            $tributos['fodinfa'] 
            + $tributos['arancel_especifico']
            + $tributos['arancel_advalorem']
            + $tributos['ice_especifico']
            + $tributos['ice_advalorem_pagado']
            + $tributos['ice_advalorem_reliquidado']
            );  
        
        return $mayor_tributos;
    }
    
    
    /**
     * Obtiebe el mayor solamente para productos
     * @return array
     */
    private function getMayorProduct():array{
        $mayor_producto = [
            'tipo' => 'Mayor Productos',
            'valor_inicial' => $this->order_invoices['valor'] * $this->tipo_cambio_pedido,
            'valor_distribuido' => 0.0,
            'valor_por_distribuir' => 0.0,
        ]; 
        
        
        foreach ($this->parcials as $k => $parcial){
            foreach ($parcial['info_invoices'] as $i => $info_invoice){
               $mayor_producto['valor_distribuido'] += $info_invoice['valor'] * $this->tipo_cambio_pedido;
            }
        }
        
        $mayor_producto['valor_por_distribuir'] = $mayor_producto['valor_inicial'] - $mayor_producto['valor_distribuido'];
        
        return $mayor_producto;
    }   
    
}