<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$libraries_url = realpath(dirname(__FILE__));
$libraries_url = str_replace('controllers', 'libraries/', $libraries_url);

require_once ( $libraries_url . 'StockOrder.php' );
require_once ( $libraries_url . 'ReportCompleteOrder.php' );

/**
 * muestra en panatalla los reportes obtenidos por el sistema 
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Reportes extends MY_Controller
{
    private $modelReportProvisiones;
    private $modelReportPagos;
    private $modelOrder;
    private $modelSupplier;
    private $modelOrderReport;
    private $modelProduct;
    private $modelInfoInvoiceDetail;
    private $modelInfoInvoice;
    private $controller = "reportes";
    private $template = '/pages/pageReport.html';
    
    function __construct(){
        parent::__construct();
        $this->init();
    }
        
    /**
     * Inicializa las librerias de la clase
     */
    private function init(){
        if(! isset($this->session->userdata['id_user'])){
            exit(0);
        }
        
        $this->load->model('ModelReportProvisiones');
        $this->load->model('ModelReportPagos');
        $this->load->model('Modelorder');
        $this->load->model('ModelOrderReport');      
        $this->load->model('Modelinfoinvoice');
        $this->load->model('Modelinfoinvoicedetail');
        $this->load->model('Modelproduct');
        $this->load->model('Modelsupplier');        
        $this->modelSupplier = new Modelsupplier();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelInfoInvoiceDetail = new Modelinfoinvoicedetail();
        $this->modelProduct = new Modelproduct();
        $this->modelOrderReport = new ModelOrderReport();
        $this->modelReportProvisiones = new ModelReportProvisiones();
        $this->modelReportPagos = new ModelReportPagos();
        $this->modelOrder = new Modelorder();
    }
    
    /**
     * metodo pricipal
     */
    public function index(){       
        return $this->responseHttp([
            'titleContent' => 'Reportes Sistema',
            'dashboard' => true,
        ]);
    }
    
    
    /**
     * Retorna las provisiones para un pedidp
     */
    public function pagos(){
        $data = [];
        $title_report = 'Sleccione el tipo de reporte' ;

        if($_POST){
            if(isset($_POST['por_fechas'])){
                $fecha_desde = str_replace('/', '-', $_POST['fecha_desde']);
                $fecha_hasta = str_replace('/', '-', $_POST['fecha_hasta']);
                $fecha_desde = date('Y-m-d', strtotime($fecha_desde));
                $fecha_hasta = date('Y-m-d', strtotime($fecha_hasta));
                $data = $this->modelReportPagos->getByDateRange(
                    $fecha_desde, 
                    $fecha_hasta
                );
                $title_report = (
                        'Reporte por fechas desde <strong>' 
                        . $fecha_desde 
                        . '</strong> hasta <strong>' 
                        . $fecha_hasta . '</strong>'
                    );

            }else{
                $order = $this->modelOrder->get($_POST['nro_pedido']);
                $data = $this->modelReportPagos->getbyOrder(
                    $_POST['nro_pedido']
                );
                
                $title_report = (
                    'Reporte por Pedido <strong>' 
                    . $_POST['nro_pedido']
                    . '</strong> regimen ' . $order['regimen']
                );
            }
        }
        
        return $this->responseHttp([
            'titleContent' => 'Reporte de Provisiones',
            'data' => json_encode($this->_formatData($data)),
            'orders_list' => $this->modelOrder->getAll(),
            'title_report' => $title_report,
            'provisiones' => true,
        ]);
    }


    /**
     *  Muestra el reporte de las provisiones 
     */
    public function provisiones(){
        $data = [];
        $title_report = 'Sleccione el tipo de reporte' ;

        if($_POST){
            if(isset($_POST['por_fechas'])){
                $fecha_desde = str_replace('/', '-', $_POST['fecha_desde']);
                $fecha_hasta = str_replace('/', '-', $_POST['fecha_hasta']);
                $fecha_desde = date('Y-m-d', strtotime($fecha_desde));
                $fecha_hasta = date('Y-m-d', strtotime($fecha_hasta));
                $data = $this->modelReportProvisiones->getByDateRage(
                    $fecha_desde, 
                    $fecha_hasta
                );
                $title_report = (
                        'Reporte por fechas desde <strong>' 
                        . $fecha_desde 
                        . '</strong> hasta <strong>' 
                        . $fecha_hasta . '</strong>'
                    );

            }else{
                $data = $this->modelReportProvisiones->getbyOrder(
                    $_POST['nro_pedido']
                );                
                $title_report = (
                    'Reporte por Pedido <strong>' 
                    . $_POST['nro_pedido']
                    . '</strong>'
                );
            }
        }

        return $this->responseHttp([
            'titleContent' => 'Reporte de Provisiones',
            'data' => json_encode($this->_formatData($data)),
            'orders_list' => $this->modelOrder->getAll(),
            'title_report' => $title_report,
            'provisiones' => true,
        ]);
    }


    /**
     * Retorna los saldos de los pedidos en Regimen 70
     */
    public function saldos(){
        $orders = $this->modelOrder->getOpenOrdersR70();
        $report_orders = [];
        
        foreach ($orders as $i => $ord){
            $params = $this->modelOrderReport->getOrderData($ord);
            
            $stock = [];
            $detail_order_invoices = [];
            $detail_info_invoices = [];
            
            if($params['order_invoices']){
                foreach ($params['order_invoices'] as $idx => $invoice){
                    if($invoice['detail']){
                        foreach ($invoice['detail'] as $k => $v){
                            $v['product'] = $this->modelProduct->get($v['cod_contable']);
                            array_push($detail_order_invoices, $v);
                        }
                    }
                }
            }
            
            
            $info_invoices = $this->modelInfoInvoice->getByOrder($ord['nro_pedido']);
            
            if($info_invoices){
                foreach ($info_invoices as $idx => $invoice){
                    $details = $this->modelInfoInvoiceDetail->getByFacInformative(
                        $invoice['id_factura_informativa']
                        );
                    if ($details){
                        foreach ($details as $k => $v){
                            array_push($detail_info_invoices, $v);
                        }
                    }
                }
            }
            
            $stock_order = new StockOrder(
                $ord,
                $detail_order_invoices,
                $detail_info_invoices
                );
            
            $ord['stock_current'] = $stock_order->getCurrentOrderStock();
            $ord['stock_initial'] = $stock_order->getInitStockProducts();
            $ord['stock_global'] = $stock_order->getGlobalValues();
                        
            foreach ($ord['stock_current'] as $idx => $stock){
                $suplier = $this->modelSupplier->get($stock['identificacion_proveedor']);
                array_push($report_orders, [
                    'Pedido' => $ord['nro_pedido'],
                    'Proveedor' => $suplier['nombre'],
                    'Ingreso Almacenera' => $ord['fecha_ingreso_almacenera'],
                    'Producto' => $stock['nombre'],                
                    'Grado' => $stock['grado_alcoholico'],
                    'Stock Cajas' => $stock['nro_cajas'],
                    'C X C ' => $stock['cantidad_x_caja'],
                    'Stock Unids' => $stock['unities'], 
                ]);                            
            }          
        }
        
        return $this->responseHttp([
            'titleContent' => 'Reporte de Saldos',
            'data' => $this->_formatData($report_orders),
            'orders_list' => $this->modelOrder->getAll(),
            'title_report' => 'Reporte de Saldos Pedidos Regimen 70',
            'saldos' => true,
        ]);
               
    }
     

    /*
     * Redenderiza la informacion y la envia al navegador
     * @param array $config informacion de la plantilla
     */
    private function responseHttp($config)
    {
        return ($this->twig->display($this->template, array_merge($config, [
            'title' => 'Reportes',
            'base_url' => base_url(),
            'rute_url' => base_url() . 'index.php/',
            'controller' => $this->controller,
            'iconTitle' => 'fa-table',
            'content' => 'home'
        ])));
    }
}

