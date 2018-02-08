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

class Impuestosparcial extends MY_Controller
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
    private $modelInitExpenses;
    
    
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
        $this->load->model('Modelparcial');
        $this->load->model('Modelorderinvoice');
        $this->load->model('Modelexpenses');
        $this->load->model('Modelproduct');
        $this->load->model('Modeluser');
        $this->load->model('Modellog');
        $this->load->model('Modelinfoinvoice');
        $this->load->model('Modelinfoinvoicedetail');
        $this->load->model('Modelinitexpenses');
        $this->modelInitExpenses = new Modelinitexpenses();
        $this->modelOrder = new Modelorder();
        $this->ModelOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelSupplier = new Modelsupplier();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelParcial = new Modelparcial();
        $this->modelExpenses = new Modelexpenses();
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
    public function validarParcial(int $idParcial)
    {
        $parcial = $this->modelParcial->get($idParcial);        
        $infoInvoices =  $this->modelInfoInvoice->getByParcial($idParcial);
        $order = $this->modelOrder->get($parcial['nro_pedido']);
        
        if($parcial == false){
            $this->modelLog->errorLog('No Existe El parcial para nacionalizar');
            return $this->index();
        }
        $params = $this->getParamsParcial($parcial, $order);
        $params['etiquetas_fiscales'] = 0.0;
        
        foreach ($infoInvoices as $index => $invoice){
            $invoice['products'] = $this->modelInfoInvoiceDetail->
                           getCompleteDetail($invoice['id_factura_informativa']);
            
            foreach ($invoice['products'] as $item => $row){
                $params['etiquetas_fiscales'] += (0.13  * $row['nro_cajas'] * $row['cantidad_x_caja'] );                   
            }
            
            $infoInvoices[$index] = $invoice;
        }
        
        
        return( $this->responseHttp([
            'titleContent' => 'Previsualizacion de Impuestos Pedido [' . 
                                $order['nro_pedido'] . '] Parcial [' . 
                                $parcial['id_parcial'] . ']' ,
            'infoInvoices' => $infoInvoices,
            'order' => $order,
            'parcial' => $parcial,
            'numberInfoInvoices' => count($infoInvoices),
            'params' => $params,
            
        ]));
        
        
    }
        
    
    /**
     * Retorna los parametros de nacionalizacion de un parcial
     * @param array $order
     * @param array $parcial 
     * @return array $params [
     *                          incoterm => float, 
     *                          seguro => float, 
     *                          flete => float, 
     *                          moneda => float, 
     *                          tipo_cambio => float, 
     *                          ]
     */
    private function getParamsParcial(array $parcial, array $order):array
    {
        $orderInvoice = $this->modelOrderInvoice->getbyOrder(
            $parcial['nro_pedido']
            );
        
        $expenses = $this->getTotalExpense($parcial['id_parcial']);
        
        return([   
            'incoterm' => $order['incoterm'],
            'seguro_aduana' => floatval($expenses['seguro_aduana']),
            'fob' => floatval($expenses['fob']),
            'flete_aduana' => floatval($expenses['flete_aduana']),
            'moneda' => $orderInvoice[0]['moneda'],
            'tipo_cambio' => floatval($parcial['tipo_cambio']),
        ]);
    }
    
    
    
    /**
     * Retrona la suma para un gasto de nacionalizacion compartidos en el 
     * parcial 
     * @param int $idparcial identificador del parcial al que pertenece
     * @return array $expenses [seuro, flete]
     */
    private function getTotalExpense( int $idparcial): array
    {
        $infoInvoices = $this->modelInfoInvoice->getByParcial($idparcial);
        
        $expenses = [
            'seguro_aduana' => 0.0,
            'flete_aduana' => 0.0,
            'fob' => 0.0,
        ];
        
        foreach ($infoInvoices as $item => $invoice){
          $expenses['seguro_aduana'] += $invoice['seguro_aduana'];  
          $expenses['flete_aduana'] += $invoice['flete_aduana'];
          $expenses['fob'] += $invoice['valor'];
        }
        
        return $expenses;
    }
    
    /*
     * Redenderiza la informacion y la envia al navegador
     * @param array $config informacion de la plantilla
     */
    private function responseHttp($config)
    {
        return(
            $this->twig->display($this->template, array_merge($config,[
                'title' => 'Impuestos',
                'base_url' => base_url(),
                'rute_url' => base_url() . 'index.php/',
                'controller' => $this->controller,
                'iconTitle' => 'fa-money',
                'content' => 'home']))
            );
    }
    
    
}

