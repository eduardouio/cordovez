<?php
require 'lib/StockOrder.php';
require 'lib/ReportCompleteOrder.php';
require_once 'lib/checkerOrder.php';

defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Modulo encargado de manejar los pedidos, CRUD y validaciones
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource var $controller => Nombre del la tabla de la BD
 *             var $listPerPage => Nro de registros por pagina
 *             var $seguroVal => Valor por el que se multiplica FOB + FLETE
 *             var $template => ubicacion de la plantilla
 *
 */
class Pedido extends MY_Controller
{
    private $controller = 'pedido';
    private $listPerPage = 100;
    private $seguroVal = 2.2;
    private $template = '/pages/pagePedido.html';
    private $modelOrder;
    private $modelSupplier;
    private $modelProduct;
    private $modelInfoInvoice;
    private $modelInfoInvoiceDetail;
    private $modelBase;
    private $myModel;
    private $modelLog;
    private $modelBasicOrderInfo;
    private $modelUser;
    private $modelProductInvoice;
    private $modelExpenses;
    private $modelOrderInvoice;
    private $modelOrderInvoiceDetail;
    private $modelPaidDetail;
    private $modelParcial;    
    private $modelOrderReport;
    private $modelOrderInfo;
    /**
     * constructor de la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    
    /**
     * Carga e inicia los modelos usados por la clase
     */
    private function init()
    {
        if(! isset($this->session->userdata['id_user'])){
            exit(0);
        }
        $this->load->model('modelorder');
        $this->load->model('modelsupplier');
        $this->load->model('modelproduct');
        $this->load->model('modelinfoinvoice');
        $this->load->model('modelinfoinvoicedetail');
        $this->load->model('mymodel');
        $this->load->model('modellog');
        $this->load->model('modeluser');
        $this->load->model('modelexpenses');
        $this->load->model('modelorderinvoice');
        $this->load->model('modelorderinvoicedetail');
        $this->load->model('modelpaiddetail');
        $this->load->model('modelparcial');
        $this->load->model('ModelOrderReport');
        $this->load->model('ModelOrderInfo');
        $this->load->model('ModelBasicOrderInfo');
        $this->modelBasicOrderInfo = new ModelBasicOrderInfo();
        $this->modelOrderInfo =  new ModelOrderInfo();
        $this->modelOrderReport = new ModelOrderReport();
        $this->modelOrder = new Modelorder();
        $this->modelSupplier = new Modelsupplier();
        $this->modelProduct = new Modelproduct();
        $this->modelBase = new ModelBase();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelInfoInvoiceDetail = new Modelinfoinvoicedetail();
        $this->myModel = new Mymodel();
        $this->modelLog = new Modellog();
        $this->modelUser = new Modeluser();
        $this->modelExpenses = new Modelexpenses();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelPaidDetail = new Modelpaiddetail();
        $this->modelOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelParcial = new Modelparcial();
    }
    
    
    /**
     * redirecciona a la lista de proveedores
     *
     * @return void
     */
    public function index()
    {
        $this->modelLog->errorLog(
            'Redireccionamiento de mostrar pedidos',
            current_url()
            );
        return $this->redirectPage('ordersList');
    }
    
    
    /**
     * Presenta la lista de los pedidos, y las acciones para cada
     * uno de ellos
     *
     * @param int $offset
     *            limite inferior de la lista
     * @return string template plantilla de la pagina
     */
    public function listar(int $offset = 0)
    {       
        $init_data = [];
        $all_orders = [];
        
        if($_POST){
            $all_orders = $this->modelOrder->search($_POST['nro_pedido']);
        }else{
            $all_orders = $this->modelOrder->getAll();
        }
        
        
        $orders_open = 0;
        $orders_closed = 0;
        
        foreach ($all_orders as $idx => $order){
            $order['info'] = $this->modelBasicOrderInfo->getInfoOrder($order['nro_pedido']);
            array_push($init_data, $order);
            if($order['bg_isclosed'] == 1){
                $orders_closed ++;
            }else{
                $orders_open ++;
            }
        }       
        
        $this->responseHttp([
            'list_orders' => true,
            'title' => 'Lista de Pedidos',
            'list_active' => 'class="active"',
            'orders' => $init_data,
            'orders_closed' => $orders_closed,
            'orders_opened' => $orders_open,
            'titleContent' => 'Lista de Pedidos Cordovez',
            'infoBase' => $this->getStatisticsInfo(),
            'pagination_url' => base_url() . 'index.php/pedido/listar/'
        ]);
        
    }
    
    
    /**
     * show a complete order information
     *
     * @param string $nroOrder
     * @return void
     */
    public function presentar($nroOrder)
    {
        if (! isset($nroOrder)) {
            $this->modelLog->warningLog(
                'La url no tiene el numero del pedido'
                );
            return($this->index());
        }
        
        $order = $this->modelOrder->get($nroOrder);
        
        if ($order == false) {
            return($this->index());
        }
                
        $params = $this->modelOrderReport->getOrderData($order);
        $order_report = new ReportCompleteOrder($params);
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
        
        
        $info_invoices = $this->modelInfoInvoice->getByOrder($nroOrder);
        
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
                $order, 
                $detail_order_invoices,
                $detail_info_invoices
            );
        
        $stock['current'] = $stock_order->getCurrentOrderStock();
        $stock['initial'] = $stock_order->getInitStockProducts();
        $stock['global'] = $stock_order->getGlobalValues();    
        
        return($this->responseHttp([
            'show_order' => true,
            'order_info' => $order_report->getStatusData(),
            'order' => $order,
            'title' => 'Pedido [' . $order['nro_pedido'] . '][R' . 
                        $order['regimen'] . ']' ,
            'order_report' => $order_report->getStatusData(),
            'stock_order' => $stock, 
            'order_invoices' => $params['order_invoices'],
            'parcials' => $order_report->getPartialInfo(),
            'list_active' => 'class="active"',
            'titleContent' => 'Detalle De Pedido [ ' . $nroOrder . '] [' . $order['incoterm'] . '] [Regimen ' . $order['regimen'] . ']'
        ]));
    }
    
    
    /**
     * Muestra el formulario para crear un pedido
     */
    public function nuevo()
    {
        return($this->responseHttp([
            'incoterms' => json_encode($this->modelBase->get_table([
                                    'table' => 'tarifa_incoterm'])),
            'titleContent' => 'Registro de nuevo Pedido',
            'title' => 'Nuevo Pedido',
            'countries' => $this->myModel->getCountries(),
            'create_order' => true,
            'form' => true,
        ]));
    }
    
    
    /**
     * Muestra el formulario de edicion
     */
    public function editar($nroOrder)
    {
        $order = $this->modelOrder->get($nroOrder);
        if($order == false){
            return($this->listar());
        }
        
        if($order['fecha_arribo']){
            $order['fecha_arribo'] = date('d/m/Y', strtotime($order['fecha_arribo']));
        }else{
            $order['fecha_arribo'] = '';
        }
        
        return($this->responseHttp([
            'edit_order'    => true,
            'form' => true,
            'order' => $order,
            'title' => 'Editar Pedido ' . $order['nro_pedido'],
            'incoterms'     => json_encode($this->modelBase->get_table([
                                                   'table' => 'tarifa_incoterm'
                                ])),
            'titleContent'  => 'Se Encuentra Editando El Pedido [<b>' 
                                                          . $nroOrder . ']</b>',
        ]));
    }
    
    
    /**
     * Actualiza la fecha de entrada a la almacenera de un pedido
     */
    public function ingresoAlmacenera()
    {
        if (! $_POST) {
            $this->redirectPage('ordersList');
        }
        
        $order = $_POST;
        $order['fecha_ingreso_almacenera'] = str_replace('/', '-', $order['fecha_ingreso_almacenera']);
        $order['fecha_ingreso_almacenera'] = date('Y-m-d' , strtotime($order['fecha_ingreso_almacenera']));        
        $order['bg_haveExpenses'] = '1';
        $order['last_update'] = date('Y-m-d H:i:s');
        
        if($this->modelOrder->update($order)){
            $this->modelLog->susessLog('Pedido Actualizado Correctamente');
            
            $idParcial = $this->modelParcial->create([
                'nro_pedido' => $order['nro_pedido'],
                'id_user' => $this->session->userdata('id_user'),
                
            ]);
            
            if($idParcial){
                return($this->redirectPage('infoInvoiceNew' , $idParcial));
            }
        }
        
        $this->modelLog->errorLog(
            'No se peude actualizar el pedido', 
            $this->db->last_query()
            );
        
        return false;
    }
    
    
    
    /**
     * elimina un pedido de la tabla, solo lo elimina sino tiene parciales
     */
    public function eliminar($nroOrder)
    {
        if($this->modelOrder->delete($nroOrder)){
            return($this->responseHttp([
                'order' => $nroOrder,
                'viewMessage' => true,
                'deleted' => true,
                'message' => 'El Pedido fue eliminado Exitosamente!',
            ]));
        }else{
            return($this->responseHttp([
                'order' => $nroOrder,
                'viewMessage' => true,
                'message' => 'El pedido no puede ser Eliminado!',
            ]));
        }        
    }
    
    /**
     * crea y/o modifica un pedido
     *
     * @return array (response) JsonSerializable
     */
    public function validar()
    {
        if (! $_POST) {
            $this->redirectPage('ordersList');
        }
        
        $pedido = $_POST;
        $pedido['id_user'] = $this->session->userdata('id_user');
        
        if ($pedido['fecha_arribo'] == '' || $pedido['fecha_arribo'] == NULL) {
            unset($pedido['fecha_arribo']);
        } else {            
            $pedido['fecha_arribo'] = date( 'Y-m-d', strtotime( 
                    str_replace( '/','-', $pedido['fecha_arribo'])
                    )
                );
            
        }
        
        #coloca ceros al inicio del numero de pedido
        if (! isset($pedido['id_pedido'])) {
            if ( $pedido['n_pedido'] < 100 &&  $pedido['n_pedido'] > 9) {
                $pedido['n_pedido'] = '0' . intval($pedido['n_pedido']);
            }
            if ($pedido['n_pedido'] < 9) {
                $pedido['n_pedido'] = '00' . intval($pedido['n_pedido']);
            }
            
            $pedido['nro_pedido'] = $pedido['n_pedido'] . '-' . $pedido['y_pedido'];
            
            unset($pedido['n_pedido']);
            unset($pedido['y_pedido']);

            if ($this->modelOrder->get($pedido['nro_pedido'])) {
                $config['order'] = $pedido['nro_pedido'];
                $config['viewMessage'] = true;
                $config['message'] = 'El pedido ya existe!';
                $this->modelLog->errorLog(
                    'Se inteta registrar un pedido Existente!',
                    $this->db->last_query()
                    );
                return $this->responseHttp($config);
            }
        }
        
        $status = $this->validData($pedido);
        
        if ($status['status']) {
            if (! isset($pedido['id_pedido'])) {
                $this->modelOrder->create($pedido);
                return (
                    $this->redirectPage(
                        'presentOrder', 
                        $pedido['nro_pedido'])
                    );
            } else {
                $pedido['last_update'] = date('Y-m-d H:i:s');
                $this->modelOrder->update($pedido);
                $this->redirectPage(
                    'presentOrder', $pedido['nro_pedido']
                    );
                return true;
            }
        } else {
            $config = [
                'fail' => true,
                'fields_error' => $status['len'],
                'order' => $pedido['nro_pedido'],
                'viewMessage' => true,
                'fail' => true,
                'message' => 'La información de uno de los campos es incorrecta, 
                              presione el botón de regreso del navegador y 
                              verifique la información ingresada!',
                'data' => $status
            ];
            $this->responseHttp($config);
            return true;
        }
    }
        
    /**
     * retorna las estadisticas de los pedidos para la cabecera de la lista
     *
     * @return array [totalOrders,
     *         consumeOrders,
     *         partialOrders,
     *         ativeOrders
     *         ]
     */
    private function getStatisticsInfo()
    {
        $orders = $this->modelOrder->getAll();
        $info = [
            'totalOrders' => count($orders),
            'consumeOrders' => 0,
            'partialsOrders' => 0,
            'activeOrders' => 0
        ];
        foreach ($orders as $key => $order) {
            if ($order['regimen'] == '70') {
                $info['partialsOrders'] ++;
            } elseif (($order['regimen'] == '10')) {
                $info['consumeOrders'] ++;
            }
            if ($order['bg_isclosed'] == '0') {
                $info['activeOrders'] ++;
            }
        }
        // se resta uno por el pedido cero
        $info['consumeOrders'] --;
        $info['totalOrders'] --;
        $info['activeOrders'] --;
        return $info;
    }
    
    
    
    
    /**
     * retorna el saldo de productos en un pedido, el pedido no tiene
     * producto registrado retorna False
     *
     * @param array $order
     * @return array | bool
     */
    private function getStock($order)
    {
        $stockOrder = new StockOrder();
        $infoInvoicesDetail = [];
        $orderInvoicesDetail = [];
        
        $order_invoices = $this->modelOrderInvoice->getbyOrder(
            $order['nro_pedido']
            );
        
        if($order_invoices == False){
            $this->modelLog->warningLog(
                'El pedido no tiene facturas de pedido'
                );
            #si no hay facturas de pedidos se termina la funcion
            return False;
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
    
    /*
     * Redenderiza la informacion y la envia al navegador
     * @param array $config informacion de la plantilla
     */
    private function responseHttp($config)
    {
        return(
            $this->twig->display($this->template, array_merge($config,[
                'base_url' => base_url(),
                'rute_url' => base_url() . 'index.php/',
                'controller' => $this->controller,
                'iconTitle' => 'fa-cubes',
                'content' => 'home']))
            );
    }
    
   }
