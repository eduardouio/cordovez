<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Retorna la información básica de un pedido
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2017, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource Source
 */

class ModelBasicOrderInfo extends CI_Model
{
    private $modelBase;
    private $modelLog;
    private $modelOrder;
    private $modelParcial;
    private $modelSuplier;
    private $modelOrderInvoice;
    private $modelInfoInvoice;    
    
    function __construct(){
        parent::__construct();
        $this->init();
    }
    
    /**
     * Inicia modelos base
     */
    private function init(){
        $this->load->model('ModelBase');
        $this->load->model('Modellog');
        $this->load->model('Modelorder');
        $this->load->model('Modelparcial');
        $this->load->model('Modelorderinvoice');
        $this->load->model('Modelinfoinvoice');
        $this->load->model('Modelsupplier');
        $this->modelSuplier = new Modelsupplier();
        $this->modelBase = new ModelBase();
        $this->modelLog = new Modellog();
        $this->modelOrder = new Modelorder();
        $this->modelParcial = new Modelparcial();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelInfoInvoice = new Modelinfoinvoice();
    }
    
    
    /**
     * Obtiene la informacion completa de un pedido
     * @return array
     */
    public function getInfoOrder($nro_order):array
    {
        $order = $this->modelOrder->get($nro_order);
        $parcials = $this->getParcialsFromOrder($order);
        $order_invoices = $this->modelOrder->getInvoices($nro_order);
        $info_invoices = $this->getInfoInvoices($parcials);
        
        $stock_values =  $this->getStockValues(
                            $parcials, 
                            $order_invoices,
                            $info_invoices
            );
        
        return ([
            'order' => $order,
            'order_invoices' => $order_invoices,
            'parcials' => $parcials,
            'info_invoices' => $info_invoices,
            'num_parcials' => $stock_values['num_parcials'],
            'fob' => $stock_values['fob'],
            'money' => $stock_values['money'],
            'nationalized' => $stock_values['nationalized'],
            'stock' => $stock_values['stock'],
            'supplier' => $this->getSupplier($order_invoices),
        ]);
    }
        
    
    
    /**
     * Obtiene el nombre del proveedor de la primera factura
     */
    private function getSupplier($order_invoices){            
        if($order_invoices){
            return $this->modelSuplier->get($order_invoices[0]['identificacion_proveedor']);
        }
        return False;
    }
    
    /**
     * Obtiene la lista de parciales de un pedido
     *
     * @param array $order
     */
    private function getParcialsFromOrder(array $order)
    {
        if ($order['regimen'] == 10){
            return  False;
        }
        
        $parcials = $this->modelParcial->getAllParcials($order['nro_pedido']);
        
        if($parcials == False){
            $this->modelLog->warningLog('Pedido sin Parciales');
            return False;
        }
        
        return $parcials;
    }
    
    
    /**
     * Obtiene las facturas informativas de un parcial
     * @param bool|array $parcials
     */
    private function getInfoInvoices($parcials){
        $info_invoices = [];
        if($parcials){
            foreach ($parcials as $idx => $par){
                array_push(
                    $info_invoices, 
                    $this->modelInfoInvoice->getByParcial($par['id_parcial'])
                    );                
            }
            return $info_invoices;
        }
        return False;
    }
    
    
    /**
     * Obtiene los saldos de los pedidos
     * 
     * @param bool|array $parcials
     * @param bool|array $order_invoices
     * @param bool|array $info_invoices
     */
    private function getStockValues(
                                        $parcials, 
                                        $order_invoices, 
                                        $info_invoices
        ){
        $stok_order = [
            'num_parcials' => 0,
            'fob' => 0,
            'money' => 'DOLARES',
            'nationalized' => 0,
            'stock' => 0,           ''
        ];
        
        if($parcials){
            $stok_order['num_parcials'] = count($parcials);
        }
        
        if($order_invoices){
            foreach ($order_invoices as $idx => $inv){
                if ($inv['moneda'] == 'EUROS'){
                    $stok_order['money'] = 'EUROS';
                }
                $stok_order['fob'] += $inv['valor'];
            }
        }
        
        if($info_invoices){
            foreach ($info_invoices as $idx => $invoice){
                $stok_order['nationalized'] += $invoice[0]['valor'];
            }
        }
        
        $stok_order['stock'] = ($stok_order['fob'] - $stok_order['nationalized']);
        
        return $stok_order;
    }
    
    
}   