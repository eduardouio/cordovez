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
    
    private $modeOrderInvoice;
    
    private $modeOrderInvoiceDetail;

    /**
     * Constructor de la funcion
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
        $this->load->model('modelorder');
        $this->load->model('modeluser');
        $this->load->model('modelsupplier');
        $this->load->model('modelorderinvoice');
        $this->load->model('modelorderinvoicedetail');
        $this->modelOrder = new Modelorder();
        $this->modelUser = new Modeluser();
        $this->modelSupplier = new Modelsupplier();
        $this->modeOrderInvoice = new Modelorderinvoice();
        $this->modeOrderInvoiceDetail = new Modelorderinvoicedetail();
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
            $this->index();
            return false;
        }
        $invoiceDetail = $this->modelOrder->getInvoiceDetail($invoiceOrder);
        $sums = false;
        
        if($invoiceDetail != false){
            $sums = $invoiceDetail['sums'];
            unset($invoiceDetail['sums']);
            $config['invoiceDetail'] = $invoiceDetail;
        }
        
        $this->responseHttp([
            'titleContent' => 'Detalle Factura [ # ' .
                                      $invoiceOrder['id_factura_proveedor'] .
                                     ' ] Pedido [ ' . $invoiceOrder['nro_pedido'] . ' ]',
            'show_invoices' => true,
            'user' => $this->modelUser->get($invoiceOrder['id_user']),
            'invoice' => $invoiceOrder,
            'invoiceDetail' => $invoiceDetail,
            'sums' => $sums,
            'supplier' => $this->modelSupplier->get($invoiceOrder['identificacion_proveedor']),
       ]);
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
            $this->index();
            return false;
        }
        $suppliers = $this->modelSupplier->getByLocation('INTERNACIONAL');
        $this->responseHttp([
            'create_invoice' => true,
            'order' => $order,
            'suppliers' => $suppliers,
            'titleContent' => 'Ingreso de Factura Pedido: [' . $nroOrder . ']'
        ]);
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
            $this->index();
            return true;
        }
        $this->responseHttp([
            'titleContent' => 'Editando Pedido Factura',
            'edit_invoice' => true,
            'invoice' => $invoiceOrder,
            'supplier' => $this->modelSupplier->get($invoiceOrder['identificacion_proveedor']),
        ]);
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
            return $this->index();
            return false;
        }
       
        if($this->modeOrderInvoice->delete($idInvoiceOrder)){
            $this->responseHttp([
                'order' => $invoiceOrder['nro_pedido'],
                'viewMessage' => true,
                'deleted' => true,
                'message' => 'Factura Eliminada Exitosamente!',
            ]);
            return true;
        }
        
    $this->responseHttp([
        'order' => $invoiceOrder['nro_pedido'],
        'viewMessage' => true,
        'message' => 'El Pedido No Puede Ser Eliminado, 
						 Tiene Dependencias!',
         ]);

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
        
        $orderInvoice['vencimiento_pago'] = date('Y-m-d', strtotime($orderInvoice['vencimiento_pago']));
        $orderInvoice['fecha_emision'] = date('Y-m-d', strtotime($orderInvoice['fecha_emision']));
        $orderInvoice['fecha_pago'] = date('Y-m-d', strtotime($orderInvoice['fecha_pago']));
        $status = $this->_validData($orderInvoice);
        
        if ($status['status']) {
            if (! isset($orderInvoice['id_pedido_factura'])) {
                $resultQuery = $this->modeOrderInvoice->create($orderInvoice);
                $this->redirectPage('orderInvoicePresent', $resultQuery);
                return true;
            } else {
                $orderInvoice['last_update'] = date('Y-m-d H:i:s');
                $this->modeOrderInvoice->update($orderInvoice);
                $this->redirectPage('orderInvoicePresent', $orderInvoice['id_pedido_factura']);
                return true;
            }
        } else {
            $config['viewMessage'] = true;
            $config['message'] = 'La información de uno de los campos es incorrecta!';
            $config['data'] = $status['columns'];
            $this->responseHttp($config);
            return true;
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
            'fecha_emision' => 10,
            'valor' => 1,
            'moneda' => 1,
            'tipo_cambio' => 1,
            'vencimiento_pago' => 10,
            'id_user' => 1
        );
        return $this->_checkColumnsData($columnsLen, $data);
    }

    /*
     * Envia la respuestas html al navegador
     */
    public function responseHttp($config)
    {
        $config['title'] = 'Facturas Pedidos';
        $config['base_url'] = base_url();
        $config['rute_url'] = base_url() . 'index.php/';
        $config['controller'] = $this->controller;
        $config['iconTitle'] = 'fa-cubes';
        $config['content'] = 'home';
        return $this->twig->display($this->template, $config);
    }
}
