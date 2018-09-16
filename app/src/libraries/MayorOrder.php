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
            'valor_inicial_facturado' => 0.0,
            'saldo_inicial_facturado' => 0.0,
            'valor_distribuido' => 0.0,
            'valor_distribuido_facturado' => '--',
            'saldo_distribuido_facturado' => '--',
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
        
        if ($this->order['incoterm'] == 'CFR' || $this->order['incoterm'] == 'FOB'){
            $mayor_origin_expesnes['valor_inicial_facturado'] = $mayor_origin_expesnes['valor_inicial'];
        }
        
        return $mayor_origin_expesnes;
    }
    
    
    /**
     * Obtiene el saldo de mayor para los gastos iniciales y de nacionalizacion
     * @return array
     */
    private function getMayorInitExpenses():array{
        
       $mayor_init_expenses = [
           'tipo' => 'MAYOR GASTOS INICIALES',
           'valor_inicial' => 0.0,
           'valor_inicial_facturado' => 0.0,
           'saldo_inicial_facturado' => 0.0,
           'valor_distribuido' => 0.0,
           'valor_distribuido_facturado' => '--',
           'saldo_distribuido_facturado' => '--',
           'valor_por_distribuir' => 0.0,
       ];
       
       foreach ($this->init_expenses as $k => $iexp){
           $mayor_init_expenses['valor_inicial'] += $iexp['valor_provisionado'];
           $mayor_init_expenses['valor_inicial_facturado'] += $iexp['paids']['sums'];
           if ($iexp['concepto'] == 'ISD') {
               $mayor_init_expenses['valor_inicial_facturado'] += $iexp['valor_provisionado'];
           }
       }
       
       if(intval($this->order['regimen']) == 10){
           $mayor_init_expenses['valor_distribuido'] = $mayor_init_expenses['valor_inicial'];
       }else{
           foreach ($this->parcials as $k => $parcial){
               if($parcial['prorrateos']['detalle_prorrateo']){
                   foreach ($parcial['prorrateos']['detalle_prorrateo'] as $i=> $prorrateo){
                       if($prorrateo['tipo'] == 'gasto_inicial'){
                            $mayor_init_expenses['valor_distribuido'] += $prorrateo['valor_prorrateado'];
                       }
                   }
               }
           }
       }
       
       $mayor_init_expenses['valor_por_distribuir'] = (
           $mayor_init_expenses['valor_inicial'] 
           - $mayor_init_expenses['valor_distribuido']
           );
       
       $mayor_init_expenses['saldo_inicial_facturado'] = (
           $mayor_init_expenses['valor_inicial'] 
           - $mayor_init_expenses['valor_inicial_facturado']
           );       
       
       return $mayor_init_expenses;
    }
    
    
    /**
     * Obtiene el saldo de mayor para los gastos iniciales y de nacionalizacion
     * @return array
     */
    private function getMayorParcialExpenses():array{
        $mayor_parcial_expenses = [
            'tipo' => 'MAYOR GASTOS PARCIAL',
            'valor_inicial' => 0.0,
            'valor_inicial_facturado' => 0.0,
            'saldo_inicial_facturado' => 0.0,
            'valor_distribuido' => 0.0,
            'valor_distribuido_facturado' => '--',
            'saldo_distribuido_facturado' => '--',
            'valor_por_distribuir' => 0.0,
        ];
        
        if(intval($this->order['regimen']) == 10){
            return $mayor_parcial_expenses;
        }
       
        $current_parcial = $this->parcials[$this->index_last_parcial];
        
        if($current_parcial['expenses']){
            foreach ($current_parcial['expenses'] as $k => $expense) {
                if(!preg_match('/[a-zA-Z]-[0-9]/' , $expense['concepto'] ) )
                {
                    $mayor_parcial_expenses['valor_distribuido'] = $mayor_parcial_expenses['valor_inicial'] += $expense['valor_provisionado'];
                                      
                    if($expense['pagos']){
                        foreach ($expense['pagos'] as $i => $paid){
                            $mayor_parcial_expenses['valor_inicial_facturado'] += $paid['valor'];
                        }
                    }                 
                }
            }
        }      
        
        $mayor_parcial_expenses['saldo_inicial_facturado'] = (
            $mayor_parcial_expenses['valor_inicial'] 
            - $mayor_parcial_expenses['valor_inicial_facturado']
            );     
        
        $mayor_parcial_expenses['valor_por_distribuir'] = (
            $mayor_parcial_expenses['valor_inicial'] 
            - $mayor_parcial_expenses['valor_distribuido']
            );
         
       
        return $mayor_parcial_expenses;
    }
    
    
    /**
     * Obtiene el valor del mayor para los bodegajes del parciales
     * @return array
     */
    private function getMayorAlmacenaje():array{
        $mayor_almacenaje = [
            'tipo' => 'MAYOR ALAMACENAJE PARCIAL',
            'valor_inicial' => 0.0,
            'valor_inicial_facturado' => 0.0,
            'saldo_inicial_facturado' => 0.0,
            'valor_distribuido' => 0.0,
            'valor_distribuido_facturado' => '--',
            'saldo_distribuido_facturado' => '--',
            'valor_por_distribuir' => 0.0,
        ];
        
        if(intval($this->order['regimen']) == 10){
            return $mayor_almacenaje;
        }
        
        foreach ($this->parcials as $k => $parcial){
            if($parcial['expenses']){
                foreach ($parcial['expenses'] as $k => $expense) {
                    if(preg_match('/[a-zA-Z]-[0-9]/' , $expense['concepto'] ) )
                    {
                        $mayor_almacenaje['valor_inicial'] += $expense['valor_provisionado'];
                        if($expense['pagos']){
                            foreach ($expense['pagos'] as $i => $paid){
                                $mayor_almacenaje['valor_inicial_facturado'] += $paid['valor'];
                            }
                        }         
                    }
                }
            }
            
        $mayor_almacenaje['valor_distribuido'] += $parcial['prorrateos']['almacenaje_aplicado'];
        
        }        
        
        $mayor_almacenaje['saldo_inicial_facturado'] = (
            $mayor_almacenaje['valor_inicial']
            - $mayor_almacenaje['valor_inicial_facturado']
            );
        
        $mayor_almacenaje['valor_por_distribuir'] = (
            $mayor_almacenaje['valor_inicial'] 
            - $mayor_almacenaje['valor_distribuido']
            );
                
        
        return $mayor_almacenaje;
    }
    
    
    
    /**
     * Retorna el valor de mayor para tributos
     */
    private function getMayorTributes():array{
        $mayor_tributos = [
            'tipo' => 'Mayor Tributos',
            'valor_inicial' => 0.0,
            'valor_inicial_facturado' => 0.0,
            'saldo_inicial_facturado' => 0.0,
            'valor_distribuido' => 0.0, 
            'valor_distribuido_facturado' => 0.0,
            'saldo_distribuido_facturado' => 0.0,
            'valor_por_distribuir' => 0.0,
        ];
        
        if(intval($this->order['regimen']) == 10){
            $tributos = [
                'fodinfa' => $this->order['fodinfa_pagado'],
                'arancel_especifico' => $this->order['arancel_especifico_pagar_pagado'],
                'arancel_advalorem' => $this->order['arancel_advalorem_pagar_pagado'],
                'ice_especifico' => $this->order['ice_especifico'],
                'ice_advalorem' => 0.0,
                'ice_advalorem_pagado' => $this->order['ice_advalorem_pagado'],
                'ice_advalorem_reliquidado' => 0.0,
            ];
            
            #para todos primero recorrer los parciales sobre este codigo
            if($this->order_invoices){
                foreach ($this->order_invoices['order_invoice_detail'] as $i => $detalle) {
                    $tributos['ice_advalorem'] =+ $detalle['ice_advalorem'];
                }
            }
        }else{
            $current_parcial = $this->parcials[$this->index_last_parcial];
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
                        $tributos['ice_advalorem'] += $detalle['ice_advalorem'];
                    }
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
        
        $mayor_tributos['valor_inicial_facturado'] = $mayor_tributos['valor_distribuido_facturado'] = (
                $mayor_tributos['valor_inicial'] 
            );
        
        $mayor_tributos['saldo_inicial_facturado'] = $mayor_tributos['saldo_distribuido_facturado'] = (
                $mayor_tributos['valor_inicial'] 
                - $mayor_tributos['valor_inicial_facturado']
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
            'valor_inicial' => 0.0,
            'valor_inicial_facturado' => 0.0,
            'saldo_inicial_facturado' => 0.0,
            'valor_distribuido' => 0.0,
            'valor_distribuido_facturado' => '--',
            'saldo_distribuido_facturado' => '--',
            'valor_por_distribuir' => 0.0,
        ]; 

        $mayor_producto['valor_inicial'] = $mayor_producto['valor_inicial_facturado'] =  ($this->order_invoices['valor'] * $this->tipo_cambio_pedido);
        
        
        if(intval($this->order['regimen']) == 10){
            $mayor_producto['valor_distribuido'] = $mayor_producto['valor_inicial'];
        }else{
            foreach ($this->parcials as $k => $parcial){
                foreach ($parcial['info_invoices'] as $i => $info_invoice){
                    $mayor_producto['valor_distribuido'] += $info_invoice['valor'] * $this->tipo_cambio_pedido;
                }
            }
        }
        
        
        
        $mayor_producto['valor_por_distribuir'] = $mayor_producto['valor_inicial'] - $mayor_producto['valor_distribuido'];
        
        return $mayor_producto;
    }   
    
}