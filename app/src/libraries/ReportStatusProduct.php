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
    private $empy_data = False;
    const LIMIT_ORDERS_IN_LOCAL_WARENHOUSE = 5;
    
    /**
     * Costructor de la clase
     * @param array $data
     */
    function __construct(array $data){
        if(empty($data)){
            $this->empy_data = True;
        }
        
        $this->data = $data;
    }
    
    
    /**
     * Obtiene el reporte completo del producto dado por el constructor 
     */
    public function getData(){
        if($this->empy_data){
            return [];    
        }
        
        $product_status = [
            'product_without_date_arrived' => $this->getProductWithoutDateArrived(),
            'product_in_customs' => $this->getProductInCustoms(),
            'product_in_almagro_warenhouse' => $this->getProductInAlmagroWarenhouse(),
            'product_with_exit_autorized' => $this->getProductWithExitAutorized(),
            'product_in_local_huaren_house' => $this->getProductInLocalHuarenHouse(),
            'historico_compras' => [],
            'historico_costos' => [],
            'historico_compas_mes_actual' => [],
            'historico_compras_current_year' => [],
        ];
        
        return $product_status;
    }
    

    /**
     * Obtiene todos los productos sin fecha de llegada
     * @return array
     */
    private function getProductWithoutDateArrived() : array {
        $product_without_date_arrived = [];        
        foreach ($this->data as $k => $order_item){
            if($order_item['order']['fecha_arribo'] == Null || $order_item['order']['fecha_arribo'] == ''){
                    array_push($product_without_date_arrived, $order_item);
            }            
        }
            
        return $product_without_date_arrived;
    }
    
    
    /**
     * Obtiene el producto que se encuentra en aduana
     * @return array
     */
    private function getProductInCustoms() : array {
        $product_in_customs = [];
        
        foreach ($this->data as $k => $order_item){
            if($order_item['order']['fecha_arribo'] != Null && $order_item['order']['fecha_arribo'] != ''){
                if($order_item['order']['fecha_salida_bodega_puerto'] == '' || $order_item['order']['fecha_salida_bodega_puerto'] == Null){
                    array_push($product_in_customs, $order_item);
                }
            }
        }
        
        return $product_in_customs;
    }
    
    
    /**
     * Obtiene el producto que esta en la bodega de almagro
     * @return array
     */
    private function getProductInAlmagroWarenhouse() : array{
        $product_in_almagro_warenhouse = [];
        foreach ($this->data as $k => $order_item){            
            if(intval($order_item['order']['regimen']) == 70 && ($order_item['order']['fecha_ingreso_almacenera'] != Null && $order_item['order']['fecha_ingreso_almacenera'] != '')){
                    array_push($product_in_almagro_warenhouse, $order_item);
                }
        }
        
        return $product_in_almagro_warenhouse;
    }
    
    
    /**
     * Obtiene el producto que tiene salida autorizada
     * @return array
     */
    private function getProductWithExitAutorized() : array{
        $product_with_exit_autorized = [];        
        foreach ($this->data as $k => $order_item){
                
        }
        
        return $product_with_exit_autorized;
    }
       
  
    /**
     * Obiene el producto que se encuentra en la bodega
     * @return array
     */
    private function getProductInLocalHuarenHouse():array{
        $product_in_local_huaren_house = [];
        foreach ($this->data as $k => $order_item){
            
        }
        return $product_in_local_huaren_house;
    }
    
    
    
    /**
     * Obtiene el producto que ha llegado a la bodega del cliente
     */
    private function getParcialProductInLocalHuarenHouse(array $parcial): array {
        $parcial_product_in_local_huarenhouse = [];
        
        return $parcial_product_in_local_huarenhouse;
    }
    
    
    /**
     * REtorna los parciales con salida a autorizada para un pedido
     * @param array $parcials
     * @return array
     */
    private function getParcialProductWithExitAuthorized(array $parcial): array{
        $parcial_product_with_exit_authorized = [];
        
        return $parcial_product_with_exit_authorized;
    }
    
    
    /**
     * Obtiene el total para mostrar en las tablas del pedido
     * @param array $orders_group
     * @return array
     */
    private function getTotalSums(array $orders_group) : array{
        $orders_group['sums'] = [
            'nro_pedido' => '',
            'fecha' => '',           
            'cajas' => 0,
            'unidades' => 0,
            'fob' => 0.0,
        ];
        
        return $orders_group;
    }
}

