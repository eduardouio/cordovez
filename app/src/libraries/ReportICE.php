<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Entrega el reporte del ICE Avalorem
 *
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @version 1.0
 * @copyright 2018 Representaciones Cordovez
 * @license Representaciones Cordovez
 * @package Controllers
 */
class ReportICE {
    private $product_data;
    private $open_order;
    private $open_parcial;
    
    
    /**
     * Parametros de instancia
     *      
     * @param array $products_data => [
     *          array 'orders' ,
     *          array 'parcials',
     * ]
     */
    function __construct(array $products_data){
        $this->product_data = $products_data;        
    }
    
    
    /**
     * Retorna el reporte del ICE
     * @return array
     */
    public function getReport():array{
        
        $report = [
            'report' => $this->getAllReport(),
            'errors' => $this->checkData(),
        ];
        
        return $this->formatReport($report);
    }
       
    
    /**
     * da formato al reporte para que se pueda imprimir
     * @param array $report
     * @return array
     */
    private function formatReport(array $report):array{
        
        
        
        return $report;
    }
    
    
    /**
     * Obtiene la informacion completa del reporte
     */
    private function getAllReport() : array{       
        $report = [];
        #extaemos el reporte de los pedidos
        foreach ($this->product_data['orders'] as $k => $order){
            $orders_report = [
                'moneda' => $order['invoice']['moneda'],
                'pedido' => $order['nro_pedido'],
                'regimen' => $order['regimen'],
                'pais_origen' => $order['pais_origen'],
                'tipo_cambio' => ($order['tipo_cambio_impuestosR10'] =! null ) ? $order['tipo_cambio_impuestosR10'] : 1,
                'fecha_liquidacion_aduana' => $order['fecha_liquidacion'],
                'fecha_llegada_cliente' => $order['fecha_llegada_cliente'],
                'nro_liquidacion' => $order['nro_liquidacion'],
                'nro_refrendo' => $order['nro_refrendo'],
                'valor_factura' => $order['invoice']['valor'],
            ];            
            
            foreach ($order['invoice']['detail'] as $j => $det){              
                
               $orders_report = array_merge($orders_report, $det);
                             
               array_push($report, $orders_report);
            }
        }
        

        #extraemos el r eporte de los parciales
        foreach ($this->product_data['parcials'] as $j => $parcial){  
            $parcials_report = [
                'moneda' => $parcial['invoice']['moneda'],
                'pedido' => $parcial['nro_pedido'],
                'regimen' => 70,
                'tipo_cambio' => ($parcial['tipo_cambio'] =! null ) ? $parcial['tipo_cambio'] : 1,
                'fecha_liquidacion_aduana' => $parcial['fecha_liquidacion'],
                'pais_origen' => $parcial['pais_origen'],
                'fecha_llegada_cliente' => $parcial['fecha_llegada_cliente'],
                'nro_liquidacion' => $parcial['nro_liquidacion'],
                'nro_refrendo' => $parcial['invoice']['nro_refrendo'],
                'valor_factura' => $parcial['invoice']['valor'],
            ];
        
        foreach ($parcial['invoice']['detail'] as $j => $det){
            $parcials_report = array_merge($parcials_report, $det);
            array_push($report, $parcials_report);
        }      
        
        }        
        return $report;
    }
    
    
    
    /**
     * Verifica que los pedidos y los parciales se encuentren 
     * cerrados en el sistema
     * 
     * @return array
     */
    private function checkData() : array{
        $errors = [
            'orders' => [],
            'parcials' => [],
        ];
        
        #comprobamos los pedidos estes
        foreach ($this->product_data['orders'] as $k => $order){
            if(intval($order['bg_isclosed']) == 0){
                array_push($errors['orders'], 
                    ['order' => $order['nro_pedido'], 'parcial' => 0, 'regimen' => $order['regimen']]
                );                
            }
        }
        
        #comprobamos los parciales
        foreach ($this->product_data['parcials'] as $k => $parcial){
            if(intval($parcial['bg_isclosed']) == 0){
                array_push($errors['parcials'], 
                    ['order' => $parcial['nro_pedido'], 'parcial' => $parcial['id_parcial'], 'regimen' => 70]
                    );
            }
        }
        
        return $errors;
    }   
    
}