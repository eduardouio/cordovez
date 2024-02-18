<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Libreria para construccion de reporte de busqueda por producto
 * 
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class ReportStatusProduct{
    private $data;
    private $parcilas;
    private $empy_data = False;
    private $current_product;
    const LIMIT_ORDERS_IN_LOCAL_WARENHOUSE = 5;
    
    /**
     * Costructor de la clase
     * @param array $data
     */
    function __construct(array $data, $parcials, $current_product){
        if(empty($data)){
            $this->empy_data = True;
        }
        
        $this->data = $data;
        $this->parcilas = $parcials;
        $this->current_product = $current_product;
    }
    
    
    /**
     * Obtiene el reporte completo del producto dado por el constructor 
     */
    public function getData(){
        if($this->empy_data || $this->current_product == False){
            return [];    
        }
        $product_status = [
            'product_without_date_arrived' => $this->getProductWithoutDateArrived(),
            'product_in_customs' => $this->getProductInCustoms(),
            'product_in_almagro_warenhouse' => $this->getProductInAlmagroWarenhouse(),
            'product_with_exit_autorized' => $this->getProductWithExitAutorized(),
            'product_in_local_huaren_house' => $this->getProductInLocalHuarenHouse(),            
        ];
        
        return $product_status;
    }
    

    /**
     * Obtiene todos los productos sin fecha de llegada
     * @return array
     */
    private function getProductWithoutDateArrived() : array {
        $saldos = [];
        foreach ($this->data as $k => $order){
            if(
                ($order['order']['fecha_arribo'] == Null || $order['order']['fecha_arribo'] == '')
                &&
                ($order['order']['bg_isclosed'] == 0)
                ){
                    array_push(
                        $saldos, [
                                'order' => $order['order']['nro_pedido'],
                                'regimen' => $order['order']['regimen'],
                                'bg_isclosed' => $order['order']['bg_isclosed'],
                                'saldo_cajas' => $order['order']['nro_cajas'],                                
                                'costo_caja' => $order['order']['costo_caja'],
                                'cantidad_x_caja' => $this->current_product['cantidad_x_caja'],
                                'tipo_cambio' => $order['order']['tipo_cambio'],
                                'fob_total' => $order['order']['fob'],
                                'costo_final' => 0,
                                'fecha_arribo' => 'Sin Fecha',
                                'fecha_ingreso_almacenera' => 'Sin Fecha',
                                'fecha_llegada_cliente' => 'Sin Fecha',
                        ]);
            }            
        }        
        return $this->sums($saldos);
    }
    
    
    /**
     * Obtiene el producto que se encuentra en aduana
     * @return array
     */
    private function getProductInCustoms() : array {
        $saldos = [];
        
        foreach ($this->data as $k => $order){
            if(($order['order']['fecha_arribo'] != Null || $order['order']['fecha_arribo'] != '') 
                && 
                ($order['order']['fecha_ingreso_almacenera'] == '' || $order['order']['fecha_ingreso_almacenera'] == NULL)
                &&
                ($order['order']['fecha_llegada_cliente'] == '' || $order['order']['fecha_llegada_cliente'] == NULL)
                &&
                ($order['order']['bg_isclosed'] == 0)
               ){
                   array_push(
                       $saldos, [
                           'order' => $order['order']['nro_pedido'],
                           'regimen' => $order['order']['regimen'],
                           'bg_isclosed' => $order['order']['bg_isclosed'],
                           'saldo_cajas' => $order['order']['nro_cajas'],                           
                           'costo_caja' => $order['order']['costo_caja'],
                           'cantidad_x_caja' => $this->current_product['cantidad_x_caja'],
                           'tipo_cambio' => $order['order']['tipo_cambio'],
                           'fob_total' => $order['order']['fob'],
                           'costo_final' => 0,
                           'fecha_arribo' => $order['order']['fecha_arribo'],
                           'fecha_ingreso_almacenera' => 'Sin Fecha',
                           'fecha_llegada_cliente' => 'Sin Fecha',
                       ]);
            }
        }      
        return $this->sums($saldos);
    }
    
    
    /**
     * Obtiene el producto que esta en la bodega de almagro
     * @return array
     */
    private function getProductInAlmagroWarenhouse() : array{
        $saldos = [];
        
        foreach ($this->data as $k => $order){            
            if(
                ($order['order']['fecha_ingreso_almacenera'] != Null || $order['order']['fecha_ingreso_almacenera'] != '')
                &&
                ($order['order']['regimen'] == 70 && $order['order']['bg_isclosed'] == 0)
               ){
                   $saldo_pedido = [
                           'order' => $order['order']['nro_pedido'],
                           'regimen' => $order['order']['regimen'],
                           'bg_isclosed' => $order['order']['bg_isclosed'],
                           'saldo_cajas' => $order['order']['nro_cajas'],                           
                           'costo_caja' => $order['order']['costo_caja'],
                           'cantidad_x_caja' => $this->current_product['cantidad_x_caja'],
                           'tipo_cambio' => $order['order']['tipo_cambio'],
                           'fob_total' => $order['order']['fob'],
                           'costo_final' => 0,
                           'fecha_arribo' => $order['order']['fecha_arribo'],
                           'fecha_ingreso_almacenera' => $order['order']['fecha_ingreso_almacenera'],
                           'fecha_llegada_cliente' => 'Sin Fecha',
                       ];                   
                   
                   foreach ($this->parcilas as $i => $parcial){
                       if(boolval($parcial['bg_isclosed']) || boolval($parcial['fecha_llegada_cliente'])){
                           if($saldo_pedido['order'] == $parcial['nro_pedido']){
                               $saldo_pedido['saldo_cajas'] -= $parcial['nro_cajas'];
                           }
                       }
                   }
                   array_push($saldos, $saldo_pedido);
            }                
        }        
        return $this->sums($saldos);
    }
    
    
    /**
     * Obtiene el producto que tiene salida autorizada
     * @return array
     */
    private function getProductWithExitAutorized() : array{
        $saldos = [];             
        
        foreach ($this->data as $k => $order){
            if(intval($order['order']['regimen']) == 10 && ($order['order']['bg_isclosed'] == 0)){
                if(
                    boolval($order['order']['fecha_salida_autorizada_puerto']) == True
                    &&
                    boolval($order['order']['fecha_llegada_cliente']) == False
                    &&
                    ($order['order']['bg_isclosed'] == 0)
                    ){
                        array_push(
                            $saldos, [
                                'order' => $order['order']['nro_pedido'],
                                'regimen' => $order['order']['regimen'],
                                'bg_isclosed' => $order['order']['bg_isclosed'],
                                'saldo_cajas' => $order['order']['nro_cajas'],
                                'costo_caja' => $order['order']['costo_caja'],
                                'cantidad_x_caja' => $this->current_product['cantidad_x_caja'],
                                'tipo_cambio' => $order['order']['tipo_cambio'],
                                'fob_total' => $order['order']['fob'],
                                'costo_final' => 0,
                                'fecha_arribo' => $order['order']['fecha_arribo'],
                                'fecha_ingreso_almacenera' => 'Consumo',
                                'fecha_salida_autorizada' => $order['order']['fecha_salida_autorizada_puerto'],
                                'fecha_llegada_cliente' => 'Sin Fecha',
                            ]);
                }
            }
        }
        foreach ($this->parcilas as $idx => $parcial){
            if(
                boolval($parcial['fecha_salida_autorizada_almagro']) 
                || 
                boolval($parcial['bg_isclosed']) == False 
                && 
                boolval($parcial['fecha_llegada_cliente']) == False
                ){
                array_push($saldos, [
                    'order' => $parcial['nro_pedido'],
                    'regimen' => $parcial['regimen'],
                    'bg_isclosed' => $parcial['bg_isclosed'],
                    'saldo_cajas' => $parcial['nro_cajas'],
                    'costo_caja' => $parcial['costo_caja'],
                    'cantidad_x_caja' => $this->current_product['cantidad_x_caja'],
                    'tipo_cambio' => $parcial['tipo_cambio'],
                    'fob_total' => $parcial['fob'],
                    'costo_final' => 0,
                    'fecha_arribo' => $parcial['fecha_arribo'],
                    'fecha_ingreso_almacenera' => $parcial['fecha_ingreso_almacenera'],
                    'fecha_salida_autorizada' => $parcial['fecha_salida_autorizada_almagro'],
                    'fecha_llegada_cliente' => 'Sin Fecha',
                ]);
            }
        }
        return $this->sums($saldos);
    }
    
    
    /**
     * Obtiene los ultimos 5 pedidos o parciales llegados 
     * a la bodega del cliente
     */
    private function getProductInLocalHuarenHouse(): array{
       $saldos = []; 
       $r10 = 0;
       $r70 = 0;
       
       foreach ($this->data as $k => $order){
           if(
               (intval($order['order']['regimen']) == 10) 
               && 
               boolval($order['order']['fecha_llegada_cliente'] || boolval($order['order']['bg_isclosed']))
               ){
               if($r10 < 3){
                   array_push($saldos, [
                       'order' => $order['order']['nro_pedido'],
                       'regimen' => $order['order']['regimen'],
                       'bg_isclosed' => $order['order']['bg_isclosed'],
                       'saldo_cajas' => $order['order']['nro_cajas'],
                       'costo_caja' => $order['order']['costo_caja'],
                       'cantidad_x_caja' => $this->current_product['cantidad_x_caja'],
                       'tipo_cambio' => $order['order']['tipo_cambio'],
                       'fob_total' => $order['order']['fob'],
                       'costo_final' => $order['order']['costo_caja_final'],
                       'fecha_arribo' => $order['order']['fecha_arribo'],
                       'fecha_ingreso_almacenera' => 'Consumo',
                       'fecha_llegada_cliente' => $order['order']['fecha_llegada_cliente'],
                   ]);
                   $r10 ++;
               }
           }
       }
       foreach ($this->parcilas as $k => $parcial){
           if(
               boolval($parcial['fecha_llegada_cliente'])
                ||
               boolval($parcial['bg_isclosed'])
               ){
                   if($r70<3){
                       array_push($saldos, [
                           'order' => $parcial['nro_pedido'],
                           'regimen' => $parcial['regimen'],
                           'bg_isclosed' => $parcial['bg_isclosed'],
                           'saldo_cajas' => $parcial['nro_cajas'],
                           'costo_caja' => $parcial['costo_caja'],
                           'cantidad_x_caja' => $this->current_product['cantidad_x_caja'],
                           'tipo_cambio' => $parcial['tipo_cambio'],
                           'fob_total' => $parcial['fob'],
                           'costo_final' => $parcial['costo_caja_final'],
                           'fecha_arribo' => $parcial['fecha_arribo'],
                           'fecha_ingreso_almacenera' => $parcial['fecha_ingreso_almacenera'],
                           'fecha_llegada_cliente' => $parcial['fecha_llegada_cliente'],
                       ]);
                   }
                   $r70++;
           }
       }       
       return $this->sums($saldos);
    }
    
    /**
     * Retiorna la suma de cada uno de los items
     * @param array $saldos
     * @return array
     */
    private function sums(array $saldos): array{
        if(boolval($saldos) == False){
            return [];
        }       
        $data = [
            'saldos' => $saldos,
            'sums' => [
                'saldo_cajas' => 0,
                'fob_total' => 0.0,
                'saldo_unidades' => 0,
            ],
         ];
        
        foreach($saldos as $k => $item){
            $data['sums']['saldo_cajas'] += $item['saldo_cajas'];
            $data['sums']['fob_total'] += $item['fob_total'];            
        }
        
        $data['sums']['saldo_unidades'] = (
            $data['sums']['saldo_cajas'] * $this->current_product['cantidad_x_caja']
            );

        return $data;
    }
}

