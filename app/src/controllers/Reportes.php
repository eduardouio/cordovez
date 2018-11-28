<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$libraries_url = realpath(dirname(__FILE__));
$libraries_url = str_replace('controllers', 'libraries/', $libraries_url);

require_once ( $libraries_url . 'StockOrder.php' );
require_once ( $libraries_url . 'ReportICE.php' );
require_once ( $libraries_url . 'ReportCompleteOrder.php' );
require_once ( $libraries_url . 'ReportStatusProduct.php' );
    
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
    private $modelReportProvisi;
    private $modelReportPagos;
    private $modelParcial;
    private $modelOrder;
    private $modelSupplier;
    private $modelOrderReport;
    private $modelProduct;
    private $modelInfoInvoiceDetail;
    private $modelInfoInvoice;
    private $modelReporICE;
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
        
        
        $models = [
            'ModelReportProvisiones',
            'ModelReportPagos',
            'Modelorder',
            'ModelOrderReport' ,
            'Modelinfoinvoice',
            'Modelinfoinvoicedetail',
            'Modelproduct',
            'Modelsupplier',
            'ModelReportICE',
            'Modelparcial',
        ];  
        
        foreach ($models as $model){
            $this->load->model($model);
        }
        
        $this->modelReporICE = new ModelReportICE();
        $this->modelSupplier = new Modelsupplier();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelInfoInvoiceDetail = new Modelinfoinvoicedetail();
        $this->modelProduct = new Modelproduct();
        $this->modelOrderReport = new ModelOrderReport();
        $this->modelReportProvisiones = new ModelReportProvisiones();
        $this->modelReportPagos = new ModelReportPagos();
        $this->modelOrder = new Modelorder();
        $this->modelParcial = new Modelparcial();
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
    
    
    /**
    * Presenta un Reporte mensual del ICE
    */
    public function reporteice(){
        $mes = [
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Septiembre',
            'Octubre',
            'Noviembre',
            'Diciembre',
        ];
        if($_GET){            
            $repor_ice = new ReportICE(
                $this->modelReporICE->getData($_GET['anio'], $_GET['mes'])
                );
            $data_report = $repor_ice->getReport();
            $have_unclosed_items = False;
            
            if($data_report['errors']['orders'] || $data_report['errors']['parcials']){
                $have_unclosed_items   = True;
            }
            
            return $this->responseHttp([
                'titleContent' => 'Reporte de ICE de ' . $mes[$_GET['mes'] - 1] . ' del ' . $_GET['anio'] ,
                'report' => $data_report['report'],
                'errors' => $data_report['errors'],
                'have_unclosed_items' => $have_unclosed_items,
                'reporte_ice' => true,
            ]);
        }else{
            return $this->responseHttp([
                'titleContent' => 'Reporte de ICE',
                'orders_list' => $this->modelOrder->getAll(),
                'reporte_ice' => true,
            ]);
        }
    }
     
        
    /**
     * Busca un producto nombre
     */
    public function saldosProducto(string $cod_contable = ''){
        $current_product = $this->modelProduct->getAllProductInfo($cod_contable);
        $this->load->model('ModelProductReport');
        $modelProductReport = new ModelProductReport();
        $data = $modelProductReport->getData($cod_contable);
        $parcials = $this->modelParcial->getAll($cod_contable);
        $ReportStatusProduct = new ReportStatusProduct($data, $parcials, $current_product);
        $product_stocks = $ReportStatusProduct->getData($cod_contable);
        $products_list = $this->modelProduct->getAll();
        $all_products = [];
        $sums = [0,0,0,0,0];
        $totals = [
            'saldo_cajas' => 0,
            'saldo_unidades' => 0,
            'fob_total' => 0.0,
        ];
        
        if($product_stocks){
            $sums = [];
            foreach ($product_stocks as $stocks){
                if($stocks){
                   array_push($sums, $stocks['sums']['saldo_cajas']);
                   $totals['saldo_cajas'] += $stocks['sums']['saldo_cajas'];
                   $totals['saldo_unidades'] += $stocks['sums']['saldo_unidades'];
                   $totals['fob_total'] += $stocks['sums']['fob_total'];                   
                }else{
                    array_push($sums, 0);
                }
            }
        }
                      
        foreach ($products_list as $key => $value) {
            array_push($all_products, [
                'value' => $value['nombre'],
                'link' => base_url() . 'index.php/reportes/saldosProducto/' . $value['cod_contable'],
            ]);
        }

        return $this->responseHttp([
            'titleContent' => 'Reporte de Saldos Por Productos',
            'reporte_saldo_producto' => true,
            'vue_app' => True,
            'product_stocks' => $product_stocks,
            'current_product' => $current_product,
            'all_products' => $all_products,
            'total_sums' => $sums,
            'total_values' => $totals,
            'historico_costos' => @$this->getCostOfProduct($data, $parcials),
        ]);
    }
    
    
    /**
     * Obtiene los costos del producto
     */
    private function getCostOfProduct(array $orders, array $parcials ):array{
        $costos = [
            'compra' => [],
            'importacion' => [],
            'costo_compra_alto' => 0.0,
            'costo_compra_bajo' => 0.0,
            'costo_importacion_alto' => 0.0,
            'costo_importacion_bajo' => 0.0,
            'costo_promedio_compra' => 0.0,
            'costo_promedio_importacion' => 0.0,
        ];        
        $suma_costo_compra = 0.0;
        $suma_costo_importacion = 0.0;
        $compras = [];
        $impotaciones = [];
        
        foreach ($orders as $k => $order){
            array_push(
                $costos['compra'], 
                [
                    'nro_pedido' => $order['order']['nro_pedido'], 
                    'costo_caja' => $order['order']['costo_caja']
                    
                ]);
            
            if($order['order']['bg_isclosed'] && $order['order']['regimen'] == 10){
                array_push(
                    $costos['importacion'], [
                        'nro_pedido' => $order['order']['nro_pedido'],
                        'costo_caja' => $order['order']['costo_caja_final']
                    ]);
            }
        }
        
        foreach ($parcials as $k => $parcial){
            if($parcial['bg_isliquidated']){
                array_push(
                    $costos['importacion'], [
                        'nro_pedido' => $parcial['nro_pedido'],
                        'costo_caja' => $parcial['costo_caja_final']
                    ]);
            }
        }       
        
        foreach($costos['compra'] as $k => $compra){
            array_push(
                $compras, 
                $compra['costo_caja']
                );
            $suma_costo_compra += $compra['costo_caja'];
        }
        
        foreach($costos['importacion'] as $k => $importacion){
            array_push(
                $impotaciones,
                $importacion['costo_caja']
                );
            $suma_costo_importacion += $importacion['costo_caja'];
        }
        
        $costos['costo_compra_alto'] = max($compras);
        $costos['costo_compra_bajo'] = min($compras);
        $costos['costo_importacion_alto'] = max($impotaciones);
        $costos['costo_importacion_bajo'] = min($impotaciones);
        $costos['costo_promedio_compra'] = $suma_costo_compra / ((count($compras)) == 0 ? 1 : count($compras));
        $costos['costo_promedio_importacion'] = $suma_costo_importacion / ((count($impotaciones)) == 0 ? 1 : count($impotaciones));        
        
        return $costos; 
    }
    
    /**
     * Actualiza la linea del producto en el detalle de una factura informativa
     * en todas las facturas informativas del sistema
     */
    public function updateProductInInfoInvoiceDetail(){
        $this->modelInfoInvoiceDetail->updateAllDetails();
        print 'Actualizado';
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

