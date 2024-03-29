<?php defined('BASEPATH') or exit('No direct script access allowed');


$libraries_url = realpath(dirname(__FILE__));
$libraries_url = str_replace('controllers', 'libraries/', $libraries_url);

require_once ( $libraries_url . 'ReportCompleteOrder.php' );
require_once ( $libraries_url . 'Rest.php' );

/**
 * Controller encargado de manejar los parciales de los pedidos
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class Parcial extends MY_Controller
{
    private $template = '/pages/pageParcial.html';
    private $controller = 'parcial';
    private $modelParcial;
    private $modelOrder;
    private $modelInfoInvoice;
    private $modelInfoInvoiceDetail;
    private $modelLog;
    private $modelProduct;
    private $modelUser;
    private $modelExpenses;
    private $modelSupplier;
    private $modelPaidDetail;
    private $modelOrderReport;
    private $rest;

    /**
     * constructor de clase
     */
    function __construct()
    {
        parent::__construct();
        $this->init();
    }

    /**
     * Inicia los modelos de la clase
     *
     * @return void
     */
    public function init()
    {
        if(! isset($this->session->userdata['id_user'])){
            exit(0);
        }
        
        $this->load->model('Modelparcial');
        $this->load->model('Modelorder');
        $this->load->model('Modelinfoinvoice');
        $this->load->model('Modelinfoinvoicedetail');
        $this->load->model('Modellog');
        $this->load->model('Modelproduct');        
        $this->load->model('Modeluser');        
        $this->load->model('Modelexpenses');        
        $this->load->model('Modelsupplier');        
        $this->load->model('Modelpaiddetail');
        $this->load->model('ModelOrderReport');
        $this->modelOrderReport = new ModelOrderReport();
        $this->modelParcial = new Modelparcial();
        $this->modelOrder = new Modelorder();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelInfoInvoiceDetail = new Modelinfoinvoicedetail();
        $this->modelLog = new Modellog();
        $this->modelProduct = new Modelproduct();
        $this->modelUser = new Modeluser();
        $this->modelExpenses = new Modelexpenses();
        $this->modelSupplier = new Modelsupplier();
        $this->modelPaidDetail = new Modelpaiddetail();
        $this->rest = new Rest();
    }

    /**
     * Si se accede directamente a la clase se redirecciona a la 
     * lista de pedidos
     */
    public function index()
    {
        $this->modelLog->redirectLog('Falta de parametros parcial ', current_url());
        return ($this->redirectPage('ordersList'));
    }

    
    /**
     * Genera un nuevo parcial en la base de datos
     * luego redirecciona al formulario de factura informativa
     *
     * @param string $nroOrder
     */
    public function presentar(int $idParcial)
    {
        $parcial = $this->modelParcial->get($idParcial);
        
        if ($parcial == false) {
            $this->modelLog->warningLog('Se accede directamente a la funcion ' . current_url());
            return ($this->redirectPage('ordersList'));
        }
        
        $order = $this->modelOrder->get($parcial['nro_pedido']);
        
        $infoInvoices = $this->modelInfoInvoice->getByParcial($idParcial);
        
        if(is_array($infoInvoices)){
            foreach ($infoInvoices as $item => $invoice){
                $invoice['user'] = $this->modelUser->get($invoice['id_user']);
                $invoice['details'] = $this->modelInfoInvoiceDetail->getByFacInformative($invoice['id_factura_informativa']);
                $invoice['supplier'] = $this->modelSupplier->get($invoice['identificacion_proveedor']);
                $count = $this->modelInfoInvoiceDetail->countBoxesAnd($invoice['id_factura_informativa']);
                $invoice['boxes'] = $count['boxes'];
                $invoice['unities'] = $count['unities'];
                $infoInvoices[$item] = $invoice;
            }
        }

        $expenses = $this->modelExpenses->getPartialExpenses($idParcial);
        if ($expenses != false) {
            foreach ($expenses as $index => $expense) {
                $expense['supplier'] = $this->modelSupplier->get($expense['identificacion_proveedor']);
                $expenses[$index] = $expense;
            }
        }
        return($this->responseHttp([
            'titleContent' => "Detalle parcial [" . $this->getNumberParcial($order['nro_pedido']) . "] " .
                                  "para el pedido [" . $order['nro_pedido'] . "]",
            'show' => true,            
            'order' => $order,
            'parcial' => $parcial,
            'expenses' => $expenses,
            'infoInvoices' => $infoInvoices,
            'paidsDetails' => $this->modelPaidDetail->getByParcial($idParcial),
            'partialNumber' => $this->getNumberParcial($order['nro_pedido']),
        ]));
    }

    /**
     * lista de parciales de un pedido
     */
    public function all_partials($nro_order){
        $pedido = $this->modelOrder->get($nro_order);
        if ($pedido == false){
            $this->modelLog->errorLog('El pedido solicitado no existe');
            return $this->_responseRest(['data'=>[]],500);
        }
        
        $all_partials = $this->modelParcial->getByOrder($nro_order);
        
        if ($all_partials == false){
            $this->modelLog->errorLog('Pedido sin Parciales');
            return $this->_responseRest(['data'=>[]], 200);
        }
        $partials = [];
        foreach ($all_partials as $k => $v){
            array_push($partials, [
                'id_parcial' => $v['id_parcial'],
                'ordinal' => $k+1,
             ]);
        } 
        return $this->_responseRest(['data' => $partials],200);
    }
    
    /**
     * Genera un nuevo parcial y luego lleva a la creacion de una factura 
     * informativa Se comprueba que no exista otro parcial abierto
     * 
     * @param string $nroOrder
     * @return string template 
     */
    public function nuevo(string $nroOrder)
    {
        $order = $this->modelOrder->get($nroOrder);
        if($order == false){
            $this->modelLog->errorLog(
                'No se puede crear un parcial para un pedido inexistente'
                );
            return $this->index();
        }
        
        $order_report = new ReportCompleteOrder(
            $this->modelOrderReport->getOrderData($order)
            );
        
        $parcial = [
            'id_user' => $this->session->userdata('id_user'),
            'nro_pedido' => $nroOrder,
        ];
        
        $status_order = $order_report->getStatusData();
        
        if ($status_order['have_open_parcial'] == False){
            $id_parcial = $this->modelParcial->create($parcial);
            return($this->redirectPage('infoInvoiceNew', $id_parcial));
        }
        
        $this->modelLog->warningLog(
            'No se puede crear un parcial mientras otro esté activo', 
            current_url() 
            );
        return ($this->redirectPage('presentOrder', $nroOrder));        
    }
        

    /**
     * Elimina un parcial vacio
     * @param int $idParcial
     */
    public function eliminar(int $idParcial = 0)
    {  
        $parcial = $this->modelParcial->get($idParcial);

        if ($parcial == false || $idParcial == 0){
            $this->redirectPage('ordersList');
        }

        $order = $this->modelOrder->get($parcial['nro_pedido']);

        if($this->modelParcial->delete($parcial)){
            $this->modelLog->susessLog(
                'El parcial ' . $idParcial . 'Fue eliminado del sistema'                
            );
            print 'Eliminado';
        }else{
            print 'No se puede eliminar tiene dependencias';
            #return ($this->redirectPage('showParcial', $parcial['id_parcial']));
        }        
        
    }
   
    
    /**
     * se validan los datos que deben estar para que la consulta no falle
     *
     * @return [array] | [bolean]
     */
    private function validData($pedido)
    {
        return ($this->_checkColumnsData([
            'nro_pedido' => 6,
            'regimen' => 2,
            'incoterm' => 1,
            'pais_origen' => 1,
            'ciudad_origen' => 1,
            'nro_refrendo' => 1,
            'id_user' => 1
        ], $pedido));
    }
    
    
    /**
     * Retorna en numero del parcial 1,2,3,4, indepedientememte
     * del id autoincremental asignado po la base
     * 12 54. 544,
     * @param string $nroOrder
     * @return int secuencial parcial (primero, segundo)
     */
    private function getNumberParcial(string $nroOrder):int
    {
        $partials = $this->modelParcial->getByOrder($nroOrder);
        if(is_array($partials)){
            return (count($partials));
        }
        return 0;
    }
    

    /*
     * Redenderiza la informacion y la envia al navegador
     * @param array $config informacion de la plantilla
     */
    private function responseHttp($config)
    {
        return ($this->twig->display($this->template, array_merge($config, [
            'title' => 'Parciales',
            'base_url' => base_url(),
            'rute_url' => base_url() . 'index.php/',
            'controller' => $this->controller,
            'enterprise' => $GLOBALS['selected_enterprise'],
            'iconTitle' => 'fa-cubes',
            'content' => 'home'
        ])));
    }

    /**
     * Metodo de respuesta Rest
     * @param array $config
     */
    private function _responseRest($data, $httpstatus = 0){
        $data['session'] = $this->session->userdata();
        return $this->rest->_responseHttp($data, $httpstatus);
    }


}
   