<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo base para el reporte del ICE
 * 
 * @package    modelLayer
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class ModelReportICE extends CI_Model
{
    private $year;
    private $month;
    private $modelOrder;
    private $modelParcial;   
    private $modelOrderInvoice;
    private $modelInfoIvoice;
    
    function __construct(){
        parent::__construct();
        $this->init();
    }
    
    
    
    /**
     * Inicia los modelos adicionales
     */
    private function init(){
        $models = [
            'Modelorder',
            'Modelparcial',
            'Modelorderinvoice',
            'Modelinfoinvoice',
        ];
        
        foreach ($models as $model){
            $this->load->library($model);
        }
        
        $this->modelOrder = new Modelorder();
        $this->modelParcial = new Modelparcial();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelInfoIvoice = new Modelinfoinvoice();
    }
        
    
     /**
     * Ontiene la informacion para el reporte
     * @param int $year
     * @param int $month
     */
    public function getData(int $year, int $month){
        $this->year = $year;
        $this->month = $month;
                
        return([
            'orders' => array_merge($this->getTemWarwnhouse(), $this->getOrders()),
            'parcials' => $this->getParcials(),
        ]);
    }    
    
    
    /**
     * Retiorna los pedidos llegados en las fechas indicadas
     */
    private function getOrders() : array{
       $orders = $this->modelOrder->getArrivedCellarByDate($this->year,$this->month);
       if($orders){
           foreach ($orders as $k => $order){
               $orders[$k]['invoice'] = $this->modelOrderInvoice->getCompleteInvoiceByOrder($order['nro_pedido']);
           }
           return $orders;
       }
       return [];
    }
       
    
    /**
     * Retorna los parciales llegados en el rango de fechas indicadas
     */
    private function getParcials(): array{
        $parcials = $this->modelParcial->getArrivedCellarByDate($this->year, $this->month);
        
        if($parcials){
            foreach ($parcials as $k => $par){
                $invoice = $this->modelInfoIvoice->getByParcial($par['id_parcial']);
                $invoice = $invoice[0];
                $invoice_detail = $invoice['info_invoices_detail'];
                unset($invoice['info_invoices_detail']);
                $invoice['detail'] = $invoice_detail;
                $parcials[$k]['invoice'] = $invoice;
            }
            return $parcials;
        }
        return [];        
    }
    
    
    /**
     * Retorna todos los pedidos que llegan a la almacenera
     * @return array
     */
    private function getTemWarwnhouse(): Array {
        $orders = $this->modelOrder->getArrivedCellarByDate($this->year,$this->month, True);
        if($orders){
            foreach ($orders as $k => $order){
                $orders[$k]['invoice'] = $this->modelOrderInvoice->getCompleteInvoiceByOrder($order['nro_pedido']);
                $orders[$k]['bg_isclosed'] = 1;
            }
            return $orders;
        }
        return [];
    }
}