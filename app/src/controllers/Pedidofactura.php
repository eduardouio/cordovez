<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Modulo encargado de manejar los pedidos, CRUD y validaciones de las facturas
 * de los pedidos
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://github.com/eduardouio/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class Pedidofactura extends MY_Controller
{

    private $controller = "pedido_factura";
    private $template = '/pages/pagePedidoFactura.html';
    private $modelSupplier;
    private $modelOrder;
    private $modelUser;
    private $modelLog;
    private $modeOrderInvoice;
    private $modeOrderInvoiceDetail;

    /**
     * Constructor de la funcion
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
        $this->modelLog->generalLog('Se carga la clase Pedido Factura');
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
        $this->load->model('modeluser');
        $this->load->model('modelsupplier');
        $this->load->model('modelorderinvoice');
        $this->load->model('modelorderinvoicedetail');
        $this->load->model('modellog');
        $this->modelOrder = new Modelorder();
        $this->modelUser = new Modeluser();
        $this->modelSupplier = new Modelsupplier();
        $this->modeOrderInvoice = new Modelorderinvoice();
        $this->modeOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelLog = new Modellog();
    }

    /**
     * redirecciona a la lista de proveedores
     */
    public function index()
    {
        $this->redirectPage('ordesList');
        return true;
    }

    /**
     * Presenta una factura pedido a detalle
     * @param int $idInvoiceOrder indetificador de tabla
     * @return string template
     */
    public function presentar($idInvoiceOrder)
    {
        $invoiceOrder = $this->modeOrderInvoice->get($idInvoiceOrder);
        if ($invoiceOrder == false ){
            return($this->index());
        }
        $invoiceDetail = $this->modelOrder->getInvoiceDetail($invoiceOrder);
        $sums = false;
        
        if($invoiceDetail != false){
            $sums = $invoiceDetail['sums'];
            unset($invoiceDetail['sums']);
            $config['invoiceDetail'] = $invoiceDetail;
        }
        
        $order = $this->modelOrder->get($invoiceOrder['nro_pedido']);
        
        return ($this->responseHttp([
            'titleContent' => 'Detalle Factura [ # ' .
                                      $invoiceOrder['id_factura_proveedor'] .
                                     ' ] Pedido [ ' . $invoiceOrder['nro_pedido'] . ' ]',
            'show_invoices' => true,
            'title' => 'Factura Pedido ' . $order['nro_pedido'],
            'user' => $this->modelUser->get($invoiceOrder['id_user']),
            'invoice' => $invoiceOrder,
            'invoiceDetail' => $invoiceDetail,
            'order' => $order,
            'sums' => $sums,
            'supplier' => $this->modelSupplier->get($invoiceOrder['identificacion_proveedor']),
       ]));
    }

    /**
     * Muestra el formulario para crear una facturapedido
     * @param string $nroOrder numero de pedido
     * @return string template
     */
    public function nuevo($nroOrder)
    {
        $order = $this->modelOrder->get($nroOrder);
        
        if ($order == false) {
            $this->modelLog->warningLog('Acceso directo, Redireccionamiento ', current_url());
            return($this->index());
        }
        
        $alert_message = False;
        $go_dollar = False;
        
        if ($order['incoterm'] != 'CFR'){
            $alert_message = True;
        }
        
        if ($order['incoterm'] == 'EXW' || $order['incoterm'] == 'FCA'){
            $go_dollar = False;
        }
        
        $suppliers = $this->modelSupplier->getByLocation('INTERNACIONAL');
        return($this->responseHttp([
            'create_invoice' => true,
            'order' => $order,
            'title' => 'Registro de Factura Pedido ' . $order['nro_pedido'],
            'alert_message' => $alert_message,
            'go_dollar' => $go_dollar,
            'suppliers' => $suppliers,
            'titleContent' => 'Ingresando Factura ' .
            ' Pedido [' . $order['nro_pedido'] . ']' .
            ' Incoterm ['. $order['incoterm'] . ']', 
        ]));
    }

    /**
     * Muestra el formulario de edicion con la informacion del pedido
     * @param int $idInvoice indentificador tabla
     * @return string template 
     */
    public function editar($idInvoice)
    {
        $invoiceOrder = $this->modeOrderInvoice->get($idInvoice);
        if($invoiceOrder == false){
            $this->modelLog->warningLog('acceso directo, aviso redireccionamiento', current_url());
            return($this->index());
        }
        
        $order = $this->modelOrder->get($invoiceOrder['nro_pedido']);
        
        $supplier = $this->modelSupplier->get($invoiceOrder['identificacion_proveedor']);
        
        $alert_message = False;
        $go_dollar = False;
        
        if ($order['incoterm'] != 'CFR'){
            $alert_message = True;
        }
        
        if ($order['incoterm'] == 'EXW' || $order['incoterm'] == 'FCA'){
            $go_dollar == True;
        }
        
        
        return($this->responseHttp([
            'titleContent' => 'Editando Factura ' . 
                                $invoiceOrder['id_factura_proveedor'] . 
                              ' <small>' . $supplier['nombre'] . '</small>' .
                               'Incoterm ['. $order['incoterm'] . ']', 
            'title' => 'Registro de Factura Pedido ' . $order['nro_pedido'],
            'edit_invoice' => true,
            'go_dollar' => $go_dollar,
            'alert_message' => $alert_message,
            'invoice' => $invoiceOrder,
            'supplier' => $this->modelSupplier->get($invoiceOrder['identificacion_proveedor']),
        ]));
    }

    /**
     * elimina un pedido de la tabla, sino tiene parciales
     * @param int $invoiceId identificador tabla
     * @return string template  
     */
    public function eliminar($idInvoiceOrder)
    {
        $invoiceOrder = $this->modeOrderInvoice->get($idInvoiceOrder);
        
        if($invoiceOrder == false){
            $this->modelLog->warningLog('Intentando eliminar directamente', current_url());
            return($this->index());
        }
       
        if($this->modeOrderInvoice->delete($idInvoiceOrder)){
            
            return($this->responseHttp([
                'order' => $invoiceOrder['nro_pedido'],
                'viewMessage' => true,
                'title' => 'Confirmacion De Eliminación de Registro',
                'deleted' => true,
                'message' => 'Factura Eliminada Exitosamente!',
            ]));
        }
        
    return($this->responseHttp([
        'order' => $invoiceOrder['nro_pedido'],
        'orderInvoice' => $invoiceOrder,
        'viewMessage' => true,
        'message' => 'El Pedido No Puede Ser Eliminado, 
						 Tiene Dependencias!',
         ]));
    }

    /**
     * crea y/o modifica una factura pedido
     * @param array arreglo de la factura
     * @return string template
     */
    public function validar()
    {
        if (! $_POST) {
            $this->index();
        }
        
        $orderInvoice = $this->input->post();
   
        
        if($orderInvoice['fecha_emision'] == ''){
            unset($orderInvoice['fecha_emision']);
        }else{
            $orderInvoice['fecha_emision'] = str_replace( '/', '-', $orderInvoice['fecha_emision']);
            $orderInvoice['fecha_emision'] = date('Y-m-d', strtotime($orderInvoice['fecha_emision']));
        }
   
     
        if($orderInvoice['vencimiento_pago'] == ''){
            unset($orderInvoice['vencimiento_pago']);
        }else{
            $orderInvoice['vencimiento_pago'] = str_replace( '/', '-', $orderInvoice['vencimiento_pago']);
            $orderInvoice['vencimiento_pago'] = date('Y-m-d', strtotime($orderInvoice['vencimiento_pago']));
        }
        
        if($orderInvoice['fecha_pago'] == ''){
            unset($orderInvoice['fecha_pago']);
        }else{
            $orderInvoice['fecha_pago'] = str_replace( '/', '-', $orderInvoice['fecha_pago']);
            $orderInvoice['fecha_pago'] = date('Y-m-d', strtotime($orderInvoice['fecha_pago']));
        }
        
        $orderInvoice['id_user'] = $this->session->userdata('id_user');
     
        
        if (! isset($orderInvoice['id_pedido_factura'])) {
            $this->db->where('id_factura_proveedor', $orderInvoice['id_factura_proveedor']);
            $this->db->where('identificacion_proveedor', $orderInvoice['identificacion_proveedor']);
            $resultDb = $this->db->get($this->controller);
            $order = $resultDb->result_array();
            
            if ($resultDb->num_rows() == 1) {
                $order = $order[0];
                $config['order'] = $order['nro_pedido'];
                $config['viewMessage'] = true;
                $config['message'] = 'Error: La factura ya se encuentra resgistrada!';
                $this->responseHttp($config);
                return true;
            }
        }
        
        $status = $this->_validData($orderInvoice);
        
        if ($status['status']) {
            if (! isset($orderInvoice['id_pedido_factura'])) {
                $resultQuery = $this->modeOrderInvoice->create($orderInvoice);
                $this->redirectPage('orderDetailAdd', $resultQuery);
                return true;
            } else {
                $orderInvoice['last_update'] = date('Y-m-d H:i:s');
                $this->modeOrderInvoice->update($orderInvoice);
                $this->redirectPage('orderInvoicePresent', $orderInvoice['id_pedido_factura']);
                return true;
            }
        } else {
            return($this->responseHttp([
                'viewMessage' => true,
                'message' => 'La información de uno de los campos es incorrecta!',
                'data' => $status['columns'],                
                ]));
        }
    }
    
    

    /**
     * se validan los datos que deben estar para que la consulta no falle
     * 
     * @return [array] | [bolean]
     */
    private function _validData($data)
    {
        $columnsLen = array(
            'nro_pedido' => 6,
            'id_factura_proveedor' => 0,
            'identificacion_proveedor' => 0,
            'valor' => 1,
            'moneda' => 1,
            'tipo_cambio' => 1,
            'id_user' => 1
        );
        return $this->_checkColumnsData($columnsLen, $data);
    }

    /*
     * Envia la respuestas html al navegador
     */
    public function responseHttp($config)
    {
        $config['base_url'] = base_url();
        $config['rute_url'] = base_url() . 'index.php/';
        $config['controller'] = $this->controller;
        $config['iconTitle'] = 'fa-cubes';
        $config['content'] = 'home';
        return $this->twig->display($this->template, $config);
    }
}
