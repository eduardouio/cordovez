<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Indica el estado de un pedido R70, para saber si se puede hacer una nuevo
 * paricial
 *
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @version 1.0
 * @copyright 2018 Representaciones Cordovez
 * @license Representaciones Cordovez
 * @package Controllers
 */    
class ReportCompleteOrder{
    private $order;
    private $order_invoices;
    private $products;
    private $paids_order;
    private $parcials;
    private $init_expenses;
    private $localtion_order = [
                'buque' => false,
                'puerto' => false,
                'almacenera' => false,
                'cordovez' => false,
            ];
    
    /**
     * Constructor de la clase
     * @param array $order
     * @param array|bool $order_invoices
     * @param array|bool $info_invoices
     */
    function __construct(
        array $params
        )
    {
        $this->order =  $params['order'];
        $this->order_invoices =  $params['order_invoices'];
        $this->products =  $params['products'];
        $this->init_expenses =  $params['init_expenses'];
        $this->paids_order =  $params['paids_order'];
        if ($this->order['regimen'] != 10){
            $this->parcials =  $params['partials'];            
        }
    }
    
    
    /**
     * Rertorna el estado del pedido
     */
    public function getStatusData(){
        $this->whereIsOrder();
        
        return([
            'have_open_parcial' => $this->checkPartials(),
            'where_is' => $this->localtion_order,
        ]);
    }
    
    
    /**
     * Comprueba si existe un parcial Abierto
     * @return bool
     */
    private function checkPartials():bool
    {   
        
        if ($this->order['regimen'] == 10){
            return False;
        }
        
        foreach ($this->parcials as $idx => $parcial){
            if (
                $parcial['bg_isliquidated'] == 0
                )
            {
                return True;       
            }
        }
        return False;
    }
    
    
    /**
     * Retorna un arreglo indicando el lugar donde se encuentra el pedido
     * 
     * @return array
     */
    private function whereIsOrder()
    {        
        
        if ($this->order['bg_isclosed']){
            return $this->localtion_order['cordovez'] = 'active';
        }
        
        if($this->order['fecha_arribo'] == null){
            return $this->localtion_order['buque'] = 'active';
        }else{
            
            if($this->order['fecha_salida_bodega_puerto'] == null){
                    return $this->localtion_order['puerto'] = 'active';
            }
            
            if(
                ($this->order['fecha_ingreso_almacenera'] == null) &&
                ($this->order['regimen'] == 70)
                )
            {
                return $this->localtion_order['transporte'] = 'active';
                    
            }
            
            if(
                ($this->order['fecha_ingreso_almacenera'] != null) &&
                ($this->order['regimen'] == 70)
                )
            {
                return $this->localtion_order['almacenera'] = 'active';
                
            }
            
            if(
                ($this->order['fecha_llegada_cliente'] == null) &&
                ($this->order['regimen'] == 10)
                )
            {
                return $this->localtion_order['transporte'] = 'active';
                
            }
            
            if(
                ($this->order['fecha_llegada_cliente'] != null) &&
                ($this->order['regimen'] == 10)
                )
            {
                return $this->localtion_order['cordovez'] = 'active';
                
            }
            
        }
        }
        
        
        /**
         * Obtioene la lista de parciales con la informacion 
         */
        public function getPartialInfo(){
            $parcials = [];
            
            if($this->order['regimen'] == '10'){
                return [];
            }
            
            foreach ($this->parcials as $idx => $par){
                $par['value'] = 0.0;
                $par['cajas'] = 0.0;
                $par['factura_informativa'] = '' ;
                $par['fecha_factura_informativa'] = '';
                if($par['info_invoices']){
                    foreach ($par['info_invoices'] as $key => $val){
                        $par['value'] += ($val['valor'] * $val['tipo_cambio']);
                        $par['factura_informativa'] = 
                                                   $par['factura_informativa'] . 
                                                   $val['nro_factura_informativa'];
                        $par['fecha_factura_informativa'] = $val['fecha_emision'];
                        
                        if($val['detalle_factura']){
                            foreach ($val['detalle_factura'] as $k => $v){
                                $par['cajas'] += $v['nro_cajas'];
                            }
                        }
                    }
                }
                
                array_push($parcials, $par);
            }
            
            return $parcials;
        }
    
}    