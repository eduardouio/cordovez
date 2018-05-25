<?php 
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Modelo funcional de lectura para obtener la informacion basica de un pedido
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2017, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource Source
 */

class ModelOrderInfo extends CI_Model
{
    private $modelBase;
    private $modelLog;
    private $modelOrder;
    private $modelParcial;
    private $modelOrderInvoice;
    private $modelInfoInvoice;
    private $modelExpenses;
    private $modelPaid;
    private $modelPaidDetail;
    
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
        $this->load->model('Modelexpenses');
        $this->load->model('Modelpaid');
        $this->load->model('Modelpaiddetail');
        $this->modelBase = new ModelBase();
        $this->modelLog = new Modellog();
        $this->modelOrder = new Modelorder();
        $this->modelParcial = new Modelparcial();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelExpenses = new Modelexpenses();
        $this->modelPaid = new Modelpaid();
        $this->modelPaidDetail = new Modelpaiddetail();
    }
    
    
    /**
     * Obtiene la informacion completa de un pedido
     * 
     * @return array
     */
    public function getInfoOrder($nro_order):array
    {
        $order = $this->modelOrder->get($nro_order);
        $init_expenses = $this->modelExpenses->getInitialExpenses($nro_order);
        
        return ([
            'order' => $order,
            'order_invoices' => $this->modelOrder->getInvoices($nro_order),
            'parcials' => $this->getParcialsFromOrder($order),
            'init_expenses' => $init_expenses,
            'paids' => $this->getPaidsFromExpenses($init_expenses),
            
        ]);
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
        $parcials_list = [];
        
        foreach ($parcials as $idx => $parcial){
            $expenses = $this->modelExpenses->getPartialExpenses(
                $parcial['id_parcial']
                );
            
            $parcial['detail'] = $this->modelParcial->getInvoices(
                $parcial['id_parcial']
                );
            
            $parcial['expenses'] = $expenses;
            $parcial['paids'] = $this->getPaidsFromExpenses($expenses);
            array_push($parcials_list, $parcial);
        }
        
        return([
            'parcials' => $parcials_list,
        ]);
    }
    
    
    /**
     * Retirna los pagos existenetes para los gastos del pedido
     * 
     * @param array $expenses
     * @return array
     */
    private function getPaidsFromExpenses($expenses)
    {
        if ($expenses == False){
            return False;
        }
        
        $paids = [];
        
        foreach ($expenses as $idx => $exp){
            $exp['paid_detail'] = $this->modelPaidDetail->getPaidsDetailsFromInitExpense(
                $exp['id_gastos_nacionalizacion']
                );
            array_push($paids, $exp);
            
        }
        return $paids;
    }
}

