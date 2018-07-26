<?php defined('BASEPATH') or exit('No direct script access allowed');

require 'lib/StockOrder.php';
require 'lib/ReportCompleteOrder.php';

/**
 * Modulo encargado de manejar los proveedores, CRUD y validaciones
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class Facinformativa extends MY_Controller 
{
    private $controller = "factura_informativa";
    private $template = '/pages/pageFactutaInformativa.html';
    private $almaceneraId = '0990304262001';
    private $modelOrder;
    private $modelUser;
    private $modelSupplier;
    private $modelExpenses;
    private $modelOrderInvoice;
    private $modelOrderInvoiceDetail;
    private $modelInfoInvoice;
    private $modelInfoInvoiceDetail;
    private $modelNationalization;
    private $modelProduct;
    private $modelLog;
    private $myModel;
    private $modelParcial;
    private $modelOrderReport;
    
    
    /**
     * Constructor de la funcion
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    /**
     * Carga los modelos a usar en la clase
     *
     * @return void
     */
    private function init()
    {
        if(! isset($this->session->userdata['id_user'])){
            exit(0);
        }
        
        $this->load->model('modelorder');
        $this->load->model('modeluser');
        $this->load->model('modelsupplier');
        $this->load->model('modelexpenses');
        $this->load->model('modelorderinvoice');
        $this->load->model('modelorderinvoicedetail');
        $this->load->model('modelinfoinvoice');
        $this->load->model('modelinfoinvoicedetail');
        $this->load->model('modelproduct');
        $this->load->model('mymodel');
        $this->load->model('modellog');
        $this->load->model('Modelparcial');
        $this->load->model('ModelOrderReport');
        $this->modelOrderReport = new ModelOrderReport();
        $this->modelParcial = new Modelparcial();
        $this->modelOrder = new Modelorder();
        $this->modelUser = new Modeluser();
        $this->modelSupplier = new Modelsupplier();
        $this->modelExpenses = new Modelexpenses();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelInfoInvoiceDetail = new Modelinfoinvoicedetail();
        $this->modelProduct = new Modelproduct();
        $this->modelLog = new Modellog();
        $this->myModel = new Mymodel();
    }
    
    /**
     * Redirecciona a la lista de pedidos
     */
    public function index()
    {
        $this->modelLog->redirectLog(
            'Redireccionamiento por acceso directo a metodos',
            current_url()
            );        
        
        $this->redirectPage('ordersList');
        return true;
    }
    
    /**
     * Muestra a detalle una factura informativa
     *
     * @param integer $idFacInformative
     * @return bool | template
     */
    public function presentar($idFacInformative)
    {
        $infoInvoice = $this->modelInfoInvoice->get($idFacInformative);
        
        if ($infoInvoice == false) {
            return($this->index());
        }
        
        $parcial = $this->modelParcial->get($infoInvoice['id_parcial']);
        $order = $this->modelOrder->get($parcial['nro_pedido']);
        $supplier = $this->modelSupplier->get(
                $infoInvoice['identificacion_proveedor']
            );
        
        $orderInvoices = $this->modelOrderInvoice->getbyOrder(
                                $order['nro_pedido']
            );
        
        $infoInvoice['details'] = $this->modelInfoInvoiceDetail->
                                        getByFacInformative($idFacInformative);
        
        if (gettype($infoInvoice['details']) == 'array') {
            foreach ($infoInvoice['details'] as $item => $val) {
                $invoiceOrderDetail = $this->modelOrderInvoiceDetail->get(
                    $val['detalle_pedido_factura']
                    );
                $infoInvoice['details'][$item]['product'] = 
                                        $this->modelProduct->get(
                                            $invoiceOrderDetail['cod_contable']
                                                        );
                $infoInvoice['details'][$item]['oderDetail'] = 
                                                            $invoiceOrderDetail;
            }
        }
                
        $this->responseHttp([
            'show' => true,
            'titleContent' => 'Pedido [' . $order['nro_pedido'] . '] ' . 
                                ' Detalle Factura Informativa [ <small> ' . 
                                $infoInvoice['nro_factura_informativa'] . 
                                ' => ' . $supplier['nombre'] . '</small> ]',
            'order' => $order,
            'infoInvoice' => $infoInvoice,
            'parcial' => $parcial,
            'supplier' => $supplier,
            'user' => $this->modelUser->get($infoInvoice['id_user'])
        ]);
    }
    
    
    /**
     * Presenta el formulario para registrar una nueva factura informativa
     * las facturas informativas solo se usan con regimen 70
     *
     * @param (string) $nroOrder pedido al que 
     * @return void
     */
    public function nuevo(int $idParcial)
    {
        $parcial = $this->modelParcial->get($idParcial);
        if ($parcial == false) {
            return $this->index();
        }
        
        $info_invoice = $this->modelInfoInvoice->getByParcial(
            $parcial['id_parcial']
            );
        
        #solo se toma la primera factura informativa
        $info_invoice = $info_invoice[0];
        $gasto_origen = 0.0;
        
        if ($info_invoice){
                $gasto_origen += $info_invoice['gasto_origen'];
        }
        
        $order = $this->modelOrder->get($parcial['nro_pedido']);
        $supplier = $this->modelSupplier->get($this->almaceneraId);
        $params = $this->modelOrderReport->getOrderData($order);
        $order_report = new ReportCompleteOrder($params);
        
        $parcials_data = $order_report->getPartialInfo();
        
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
        
        $stock_order = new StockOrder(
            $order,
            $detail_order_invoices,
            $detail_info_invoices
            );
        
        $stock = [
            'current' => $stock_order->getCurrentOrderStock(),
            'initial' => $stock_order->getInitStockProducts(),
            'global' => $stock_order->getGlobalValues(),
        ];
        
        return $this->responseHttp([
            'frm_invoice' => true,
            'create_invoice' => true,
            'title' => 'Nueva Factura Informativa [' . $order['nro_pedido']  . ']',
            'order' => $order,
            'stock_order' => $stock,
            'parciales_anteriores' => count( $parcials_data ) - 1,
            'parcials_info' => $parcials_data ,
            'parcial' => $parcial,
            'supplier' => $supplier,
            'haveEuros' => $this->orderHaveEuros($order['nro_pedido']),
            'titleContent' => 'Ingreso de Factura Informativa Pedido: [' . 
                                $order['nro_pedido'] . ']' . '[' . 
                                $order['incoterm']  . ']',
            'user' => $this->modelUser->get($order['id_user'])
        ]);
    }
    
    /**
     * Prepara el formulario para editar una factura informativa
     *
     * @param integer $idFacInformative
     *            id_factura_informativa
     * @return string Template
     */
    public function editar(int $id_info_invoice)
    {
        $info_invoice = $this->modelInfoInvoice->get($id_info_invoice);
        
        if($info_invoice == False){
            return $this->index();
        }
        
        $parcial = $this->modelParcial->get($info_invoice['id_parcial']);        
        
        $order = $this->modelOrder->get($parcial['nro_pedido']);
        $supplier = $this->modelSupplier->get($this->almaceneraId);
        $params = $this->modelOrderReport->getOrderData($order);
        $order_report = new ReportCompleteOrder($params);
        
        $parcials_data = $order_report->getPartialInfo();
        
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
        
        $stock_order = new StockOrder(
            $order,
            $detail_order_invoices,
            $detail_info_invoices
            );
        
        $stock = [
            'current' => $stock_order->getCurrentOrderStock(),
            'initial' => $stock_order->getInitStockProducts(),
            'global' => $stock_order->getGlobalValues(),
        ];
        
        return $this->responseHttp([
            'frm_invoice' => true,
            'edit_invoice' => true,
            'title' => 'Nueva Factura Informativa [' . $order['nro_pedido']  . ']',
            'order' => $order,
            'stock_order' => $stock,
            'info_invoice' => $info_invoice,
            'parciales_anteriores' => count( $parcials_data ) - 1,
            'parcials_info' => $parcials_data ,
            'parcial' => $parcial,
            'supplier' => $supplier,
            'haveEuros' => $this->orderHaveEuros($order['nro_pedido']),
            'titleContent' => 'Ingreso de Factura Informativa Pedido: [' .
            $order['nro_pedido'] . ']' . '[' .
            $order['incoterm']  . ']',
            'user' => $this->modelUser->get($order['id_user'])
        ]);
    }
    
    /**
     * Valida y gusrada una factura informativa si no existe redirecciona a pedidos
     *
     * @param (array) $inputdata
     * @return void
     */
    public function validar()
    {
        if (! $_POST) {
            $this->modelLog->redirectLog(
                    $this->controller . ',validar,' . current_url()
                );
            $this->redirectPage('ordersList');
            return true;
        }
        
        $infoInvoice = $this->input->post();

        #$nroOrder = $infoInvoice['nro_pedido'];
        #unset($infoInvoice['nro_pedido']);

        $parcial = $this->modelParcial->get($_POST['id_parcial']);
        
        $infoInvoice['fecha_emision'] = str_replace(
                    '/', 
                    '-', 
                    $infoInvoice['fecha_emision']
            );
        
        $infoInvoice['fecha_emision'] = date(
                'Y-m-d', 
                strtotime($infoInvoice['fecha_emision'])
            );
        
        $infoInvoice['id_user'] = $this->session->userdata('id_user');       

        if (
            ($this->modelInfoInvoice->existRow($infoInvoice) == true) && 
            (! isset($infoInvoice['id_factura_informativa']))
            ){
            
            $this->modelLog->errorLog(
                'Registro Duplicado ' . 
                current_url()
                );
            
            return ($this->responseHttp([
                'titleContent' => 'La Factura Informativa [' . 
                                    $infoInvoice['nro_factura_informativa'] . 
                                   '] ya se ecuentra Registrada!.',
                'viewMessage' => true,
                'message' => 'EL Registro que intenta ingresar ya Existe.',
                'duplicateRow' => true,
                'idInfoInvoice' => $this->modelInfoInvoice->existRow(
                                                                $infoInvoice
                    ),
            ]));
        }
        
        $status = $this->validData($infoInvoice);        
        
        if ($status['status']) {
            if (! isset($infoInvoice['id_factura_informativa'])) {
                if ($lastId = $this->modelInfoInvoice->create($infoInvoice)) {
                    return ($this->redirectPage(
                                            'newProductInfoInvoice', $lastId
                        ));
                }
            } else {
                $infoInvoice['last_update'] = date('Y-m-d H:m:s');
                if ($this->modelInfoInvoice->update($infoInvoice)) {
                    return ($this->redirectPage(
                            'infoInvoiceShow', 
                            $infoInvoice['id_factura_informativa'])
                        );
                }
                
            }
        } else {
            return ($this->responseHttp([
                'viewMessage' => 'true',
                'titleContent' => 'Verifique la información ingresada',
                'create_invoice' => true,
                'order' => $parcial,
                'supplier' => $this->modelsupplier->get($this->almaceneraId),
                'haveEuros' => $this->orderHaveEuros($order['nro_pedido']),
                'sumsValues' => $this->myModel->getValuesOrder($order),
                'message' => 'La información de uno de los campos es incorrecta!.',
                'user' => $this->modelUser->get($order['id_user']),
                'formError' => true,
                'data' => $status,
                'infoInvoice' => $infoInvoice
            ]));
        }
    }
    
    /**
     * Elimina una factura informativa de la base de datos, solo si esta
     * no tiene dependencias
     *
     * @param integer $idFacInformativa
     * @return bool | template
     */
    public function eliminar($idFacInformative)
    {
        $infoInvoice = $this->modelInfoInvoice->get($idFacInformative);
        $parcial = $this->modelParcial->get($infoInvoice['id_parcial']);
        $order = $this->modelOrder->get($parcial['nro_pedido']);


        if ($this->modelInfoInvoice->delete($idFacInformative)) {
            $this->redirectPage('presentOrder', $parcial['nro_pedido']);
        } else {
            $this->responseHttp([
                'titleContent' =>   'No se puede eliminar el registro <small>' .
                                    ' Factura Informativa [ ' . 
                                    $infoInvoice['nro_factura_informativa'] . 
                                    ' ] </small> ',
                'viewMessage' => true,
                'deleted' => true,
                'message' => 'No puede ser eliminado, tiene dependencias',
                'id_row' => $infoInvoice['id_factura_informativa'],
                'order' => $order,
            ]);
        }
    }
    
    
    /**
     * Verifica si el pedido tiene una factura en euros
     *
     * @param $nroOrder =>
     *            Numero de la orden
     * @return boolean
     */
    private function orderHaveEuros($nroOrder)
    {
        $order = $this->modelOrder->get($nroOrder);
        $haveEuros = $this->modelOrderInvoice->haveEuros($nroOrder);
        
        if($haveEuros){
            return ([
                'euros' => true,
                'tipo_cambio' => 1.25,
            ]);
        }
        
        return false;
    }
    
    
    /**
     * Obtiene el tiempo en dias de un pedido en la almacenera publica
     * desde la fecha_ingreso_almacenera, si el pedido se encuentra cerrado
     * se calcula hasta fecha_salida_Almacenera
     *
     * @param array $order
     *            pedido a evaluar
     * @return int
     */
    private function getWarenHouseDays(array $order): int
    {           
        if (gettype($order['fecha_salida_almacenera']) == 'NULL') {
            return (
                dateDiffInDays($order['fecha_ingreso_almacenera'], 
                date('Y-m-d'))
                );
        }
        
        return (dateDiffInDays(
            $order['fecha_ingreso_almacenera'], 
            $order['fecha_salida_almacenera']
            )
            );
    }
    
    
    
    /**
     * Se validan las columnas que debe tener la consulta para que no falle
     *
     * @return [array] | [bolean]
     */
    private function validData($data)
    {
        $columnsLen = array(
            'nro_factura_informativa' => 2,
            'id_parcial' => 1,
            'identificacion_proveedor' => 13,
            'fecha_emision' => 10,
            'id_user' => 1
        );
        return $this->_checkColumnsData($columnsLen, $data);
    }
    
    /*
     * Envia la respuestas html al navegador
     * @param array $config Arreglo con info de la plantilla
     * @return template
     */
    private function responseHttp($config)
    {
        $config['base_url'] = base_url();
        $config['rute_url'] = base_url() . 'index.php/';
        $config['controller'] = $this->controller;
        $config['iconTitle'] = 'fa-file';
        $config['content'] = 'home';
        return $this->twig->display($this->template, $config);
    }
}
