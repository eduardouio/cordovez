<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo encargado de eliminar un pedido completo
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class Modeldeleteallorder extends CI_Model{
    private $modelOrder;
    private $modelParcial;
    private $modelInfoInvoices;
    private $modelProrrateo;
    private $modelOrderInvoice;
    private $modelPaid;
    private $modelPaidDetail;
    private $modelLog;
    private $modelBase;
    private $modelExpenses;
    
    
    function __construct(){
        parent::__construct();
        $this->init();
    }
    
    /**
     * Inicia las clases del modelo
     */
    private function init(){
        $this->load->model('Modelorder');
        $this->load->model('Modelorderinvoice');
        $this->load->model('Modelinfoinvoice');
        $this->load->model('Modelprorrateo');
        $this->load->model('Modelorderinvoice');
        $this->load->model('Modelpaid');
        $this->load->model('Modelpaiddetail');
        $this->load->model('Modellog');
        $this->load->model('ModelBase');
        $this->load->model('Modelexpenses');
        $this->modelPaidDetail = new Modelpaiddetail();
        $this->modelBase = new ModelBase();
        $this->modelLog = new Modellog();
        $this->modelPaid = new Modelpaid();
        $this->modelOrder = new Modelorder();
        $this->modelInfoInvoices = new Modelinfoinvoice();
        $this->modelParcial = new Modelparcial();
        $this->modelProrrateo = new Modelprorrateo();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelExpenses = new Modelexpenses();
    }
    
    
    /**
     * Elimina un pedido de forma permanete del sistema
     * 
     * @param string $nro_pedido
     * @return bool
     */
    public function deleteAllOrder(string $nro_order):bool{
        $order = $this->modelOrder->get($nro_order);
        
        if($order == False){
            $this->modelLog->warningLog(
                'El pedido que intenta eliminar no existe'
                );
            
            return True;
        }
        
        $status_init_expenses = $this->deleteInitExpenses($nro_order);   
        $status_parcial = $this->deteleParcials($nro_order);
        $status_order_invoice = $this->deleteOrderInvoices($nro_order);
        
        if($status_init_expenses && $status_parcial && $status_order_invoice){
            if ($this->modelOrder->delete($nro_order)){
                $this->modelLog->susessLog(
                    'El Pedido ' . $nro_order . 'Fuel Eliminado del sistema'
                    );
                return True;
            }
                    
        }
        
        $this->modelLog->errorLog(
            'El Pedido ' . $nro_order . 'No fue eliminado del sistema'
            );
        
        return False;
       
        
    }
    
   
    /**
     * Elimna todos los gastos iniciales
     * 
     * @param string $nro_order
     * @return bool
     */
    private function deleteInitExpenses(string $nro_order):bool{
        $init_expenses= $this->modelExpenses->getInitialExpenses($nro_order);
        $documents = [];
        
        if($init_expenses == False ){
            return True;
        }
        
        foreach ( $init_expenses as $k => $exp){
            $document = $this->modelPaid->getDocumentFromDetail(
                $exp['id_gastos_nacionalizacion']
                );
            
            if($document){
                array_push($documents, $document);
            }
            $this->modelPaidDetail->deletePaidDetailFromExpense($exp['id_gastos_nacionalizacion']);
            $this->modelExpenses->deleteInitExenses($nro_order);
        }
        
        if($documents){
            foreach ($documents as $k => $doc){                                
                $this->modelPaid->delete($doc[0]['id_documento_pago']);
            }
        }
        
        return True;        
      
                      
    }
    
              
    /**
     * Elimina los gastos de lois parciales
     * 
     * @param string $nro_order
     * @return bool
     */
    private function deleteParcialExpenses(int $id_parcial):bool{       
        $parcial_expenses = $this->modelExpenses->getPartialExpenses($id_parcial);
        $documents = [];
        
        if($parcial_expenses == False ){
            return True;
        }
        
        foreach ( $parcial_expenses as $k => $exp){
            $document = $this->modelPaid->getDocumentFromDetail(
                $exp['id_gastos_nacionalizacion']
                );
            
            if($document){
                array_push($documents, $document);
            }
            
            $this->modelPaidDetail->deletePaidDetailFromExpense($exp['id_gastos_nacionalizacion']);
        }
        
        if($documents){
            foreach ($documents as $k => $doc){                
                $this->modelPaid->delete($doc[0]['id_documento_pago']);
            }
        }
        
        return True;        
    }      
    
    
    /**
     * Elimina los parciales y las facturas informativas
     * @param string $nro_order
     * @return bool
     */
    private function deteleParcials(string $nro_order): bool{
        
        $paricials = $this->modelParcial->getAllParcials($nro_order);
        
        if($paricials == NULL || $paricials == FALSE || empty($paricials) ){        
            return True;
        }
        
        foreach ($paricials as $k => $par){
            $this->deleteParcialExpenses($par['id_parcial']);  
            $this->deleteInfoInvoices($par['id_parcial']);      
            $prorrateo = $this->modelProrrateo->getProrrateoByParcial($par['id_parcial']);

            if ($prorrateo){
                $this->modelProrrateo->deleteProrrateoByParcial($par['id_parcial']);
            }
        }
        
        return True;
    }
    
    
    
    /**
     * Elimina las facturas informativas de un pedido
     * 
     * @param int $id_parcial
     * @return bool
     */
    private function deleteInfoInvoices(int $id_parcial):bool{
        $info_invoices = $this->modelInfoInvoices->getByParcial($id_parcial);
        if($info_invoices == False){
            return True;
        }      
        
        foreach ($info_invoices as $k => $invoice){
            $this->modelInfoInvoices->delete($invoice['id_factura_informativa']);             
        }
        
        return True;
    }
    
    
    /**
     * Elimna las facturas de in pedido
     * @param string $nro_order
     * @return bool
     */
    private function deleteOrderInvoices(string $nro_order):bool{
        $order_invoice = $this->modelOrderInvoice->getbyOrder($nro_order);
        
        if($order_invoice == False){
            return True;
        }
        
        foreach ($order_invoice as $k => $invoice){
            $this->modelOrderInvoice->delete($invoice['id_pedido_factura']);
        }
        
        return True;
    }

}