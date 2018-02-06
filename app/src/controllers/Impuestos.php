<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Controller encargado del calculo de impuestos
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */

class Impuestos extends MY_Controller
{
    private $controller = "impuestos";
    private $template = '/pages/pageImpuestos.html';
    private $modelOrder;
    private $modelParcial;
    private $ModelOrderInvoiceDetail;
    private $modelSupplier;
    private $modelOrderInvoice;
    private $modelExpenses;
    private $modelProducts;
    private $modelUser;
    private $modelLog;
    private $modelInfoInvoice;
    private $modelInfoInvoiceDetail;
    
    
    /**
     * Contructor de la clase 
     */
    function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    
    /**
     * Inicia los modelos de la clase
     */
    public function init()
    {
        $this->load->model('Modelorder');
        $this->load->model('Modelorderinvoicedetail');
        $this->load->model('Modelsupplier');
        $this->load->model('parcial');
        $this->load->model('Modelorderinvoice');
        $this->load->model('Modelexpenses');
        $this->load->model('Modelproduct');
        $this->load->model('Modeluser');
        $this->load->model('Modellog');
        $this->load->model('Modelinfoinvoice');
        $this->load->model('Modelinfoinvoicedetail');
        $this->modelOrder = new Modelorder();
        $this->ModelOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelSupplier = new Modelsupplier();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelParcial = new Modelparcial();
        $this->modelExpense = new Modelexpenses();
        $this->modelProduct = new Modelproduct();
        $this->modelUser = new Modeluser();
        $this->modelLog = new Modellog();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelInfoInvoiceDetail = new Modelinfoinvoicedetail();
        
    }
    
    
    
    /**
     * funcion por defecto del controller, se usa para redireccionar al home
     */
    public function index()
    {
        $this->modelLog->warningLog(
            'Redirecionamiento desde el controller de impuestos'
            );
        
        return ($this->redirectPage('home'));
        
    }
    
    
    /**
     * Genera los impuestos para un parcial, el valor del flete y seguro
     * son sumados de cada una de las facturas informativas
     * Todos los pedidos R70 pasan por este filtro
     * @param int $idParcial
     * @retunr arrat template
     */
    public function validateParcial(int $idParcial)
    {
        $parcial = $this->modelParcial->get($idParcial);
        
        if($parcial == false){
            $this->modelLog->errorLog(
                'El parcial no existe, ingreso directo por URL',
                current_url()
                );
            return $this->index();
        }
        
        $infoInvoices =  $this->modelInfoInvoice->getByParcial($idParcial);
        
        if($infoInvoices == false){
            $this->modelLog->errorLog(
                'Parcial sin facturas informativas',
                current_url()
                );
        }
        
    }
    
    
    
    /**
     * Genera los impuestos para un pedido en general
     * @param string $nroOrder
     */
    public function validateOrder(string $nroOrder)
    {
        $order = $this->modelOrder->get($nroOrder);
        
        if($order == false){
            $this->modelLog->errorLog(
                'El pedido no existe, ingreso directo por URL',
                current_url()
                );
            return $this->index();
        }
        
        $orderInvoices = $this->modelOrderInvoice->getbyOrder($nroOrder);
        
        if($orderInvoices == false){
            $this->modelLog->errorLog(
                'Parcial sin facturas de producto',
                current_url()
                );
        }
        
        
    }
    
}

