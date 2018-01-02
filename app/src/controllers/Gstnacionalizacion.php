<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modulo encargado de Gestionar los gastos de nacionaliacion para 
 * regimn 70 (parciales) y 10 
 *
 * @package     CordovezApp
 * @author      Eduardo Villota <eduardouio7@gmail.com>
 * @copyright   Copyright (c) 2017,  Agencias y Representaciones Cordovez S.A.
 * @license     Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link        https://gitlab.com/eduardo/APPImportaciones
 * @since       Version 1.0.0
 * @filesource  Source
 */
class Gstnacionalizacion extends MY_Controller
{
    private $controller = 'gastos_nacionalizacion';
    private $template = 'pages/pageGastosNacionalizacion.html';
    private $modelOrder;
    private $modelExpenses;
    private $modelProduct;
    private $modelOrderInvoices;
    private $modelOrderInvoiceDetail;
    private $modelInfoInvoiceDetail;
    private $modelInfoInvoice;
    private $modelLog;
    private $modelUser;
    private $modelSupplier;
    
    /**
     * constructor de la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    /**
     * Redirecciona a pedidos, sucede por entradas directas 
     * por url al metodo del controller
     */
    public function index()
    {
        $this->modelLog->redirectLog('Por Acceso directo a URL ' . current_url());
        return($this->redirectPage('ordersList'));
    }
    
    /**
     * inicia los modelos para la clase
     */
    private function init()
    {
        $this->load->model('modelorder');
        $this->load->model('modelexpenses');
        $this->load->model('modelproduct');
        $this->load->model('modelorderinvoice');
        $this->load->model('modelorderinvoicedetail');
        $this->load->model('modelinfoinvoice');
        $this->load->model('modelinfoinvoicedetail');
        $this->load->model('modellog');
        $this->load->model('modeluser');
        $this->load->model('modelsupplier');
        $this->modelOrder = new Modelorder();
        $this->modelExpenses = new Modelexpenses();
        $this->modelProduct = new Modelproduct();
        $this->modelOrderInvoices = new Modelorderinvoice();
        $this->modelOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelInfoInvoiceDetail = new Modelinfoinvoicedetail();
        $this->modelLog = new Modellog();
        $this->modelUser = new Modeluser();
        $this->modelSupplier = new Modelsupplier();      
        
    }
    
    
    /**
     * redirecciona a la pagina de lista de pedidos
     * son redirecciones por accesos sin ilegales
     * @param identificador de la factura infromativa
     */
    public function validar70(int $idInfoInvoice)
    {   
        $infoInvoice = $this->modelInfoInvoice->get($idInfoInvoice);
        if($infoInvoice == false){
            return($this->index());
        }
        $infoInvoice['supplier'] = $this->modelSupplier->get($infoInvoice['identificacion_proveedor']);
        $infoInvoice['user'] = $this->modelUser->get($infoInvoice['id_user']);
        $order = $this->modelOrder->get($infoInvoice['nro_pedido']);
        $infoInvoiceDetailsTemp = $this->modelInfoInvoiceDetail->getByFacInformative($idInfoInvoice);
        $infoInvoiceDetails = [];
        foreach ($infoInvoiceDetailsTemp as $item => $detail){
            $invoiceOrderDetail = $this->modelOrderInvoiceDetail->get($detail['detalle_pedido_factura']);
            $detail['product'] = $this->modelProduct->get($invoiceOrderDetail['cod_contable']);
            $detail['user'] = $this->modelUser->get($detail['id_user']);
            $infoInvoiceDetails[$item] = $detail;
        }
        
        print '<pre>';
        print_r($infoInvoice);
        print_r($infoInvoiceDetails);
        print '</pre>';
        return($this->responseHTTP([
            'titleContent' => 'Generar Gastos Nacionalizacion Factura Informativa ['. $infoInvoice['nro_factura_informativa'] .
                                '] Pedido: [' . $order['nro_pedido'] . '] ',
            'order' => $order,
            'infoInvoice' => $infoInvoice,
            'infoInvoiceDertails' => $infoInvoiceDetails,            
        ]));
    }
        
    /* *
     * Envia la respuestas html al navegador
     * @param array $config Arreglo con info de la plantilla
     * @return template
     */
    private function responseHttp($config){
        $config['base_url'] = base_url();
        $config['title'] = 'Gastos Nacionalización';
        $config['rute_url'] = base_url() . 'index.php/';
        $config['controller'] = $this->controller;
        $config['iconTitle'] = 'fa-file';
        $config['content'] = 'home';
        return $this->twig->display($this->template, $config);
    }
}

