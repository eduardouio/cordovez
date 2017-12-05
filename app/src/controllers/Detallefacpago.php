<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Ingresa y edita los items de las facturas y el cruce con los pedidos
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class Detallefacpago extends \MY_Controller
{

    private $template = "/pages/pageFacturasDetalles.html";

    private $controller = 'detalle_documento_pago';

    private $modelOrder;

    private $modelPaid;
    
    private $modelPaidDetail;

    private $modelUser;

    private $modelExpenses;
    
    private $modelSupplier;

    /**
     * Se realiza la carga de los modelos necesarios para la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
       
    }
    
    /**
     * Inicia los modelos de la clase
     */
    private function init(){
        $this->load->model('modelorder');
        $this->load->model('modelpaid');
        $this->load->model('modeluser');
        $this->load->model('modelexpenses');
        $this->load->model('modelpaiddetail');
        $this->load->model('modelsupplier');
        $this->modelOrder = new Modelorder();
        $this->modelPaid = new Modelpaid();
        $this->modelUser = new Modeluser();
        $this->modelExpenses = new Modelexpenses();
        $this->modelPaidDetail = new Modelpaiddetail();
        $this->modelSupplier = new Modelsupplier();
    }

    /**
     * Redirecciona a la lista de facturas
     */
    public function index()
    {
        $this->redirectPage('paidsList');
        return true;
    }

    /**
     * Presenta el formulario para agregar un nuevo item de factura
     * 
     * @param int $nroDocument
     * @return mixed | Template
     */
    public function nuevo($nroDocument)
    {
        if (! isset($nroDocument)) {
            $this->redirectPage('paidsList');
            return false;
        }
        $document = $this->modelPaid->get($nroDocument);
        if ($document == false) {
            $this->redirectPage('paidsList');
            return false;
        }
        $activeOrders = $this->modelOrder->getActives();
        $orders = [];
 
        if (gettype($activeOrders) == 'array') {
            foreach ($activeOrders as $item) {
                $expensesTemp = $this->modelExpenses->get($item['nro_pedido']);
                $expenses = [];
                
                foreach ($expensesTemp as $index => $expense){
                    $expense['justification'] = $this->modelPaidDetail->getByExpense($expense['id_gastos_nacionalizacion']);
                    $expense['user'] = $this->modelUser->get($expense['id_user']);
                    $expenses[$index] = $expense;
                }
                
                $orders[$item['nro_pedido']] = $expenses;                
            }
        }
        
        $document = $this->modelPaid->get($nroDocument);
        $this->responseHttp([
            'titleContent' => 'Justificar Gasto [Factura #' . $document['nro_factura'] . ' ' . $document['supplier']['nombre'] . ']',
            'document' => $document,
            'create' => true,
            'activeOrders' => $activeOrders,
            'orders' => json_encode($orders),
            'user' => $this->modelUser->get($document['id_user'])
        ]);
    }
    
    /**
     * Presenta un formulario para editar la justificacion
     * @param int $idDetail
     */
    public function editar($idDetail){
        $detail = $this->modelPaidDetail->getDetail($idDetail);
        if ($detail == false){
            $this->redirectPage('paidsList');
            return false;
        }
        $document = $this->modelPaid->get($detail['id_documento_pago']);
        $provision = $this->modelExpenses->getExpense($detail['id_gastos_nacionalizacion']);
        
        $arreglo = [
            'invoiceDetail' => $detail,
        ];
        $this->responseHttp([
            'edit' => true,
            'titleContent' => 'Editar Item Docuemento Pago Factura [ ' . 
                                $document['nro_factura'] . '] <small>' . 
                                $document['supplier']['nombre'] . '</small>',
            'document' => $document,
            'provision' => $provision,
            'user' => $this->modelUser->get($provision['id_user']),
            'detailInvoice' => $detail,
        ]);
    }

    /**
     * valida y registra o actualiza una provision total o parcial
     * 
     * @param (array) $_POST
     */
    public function validar()
    {
        if (! $_POST) {
            $this->redirectPage('paidsList');
            return false;
        }
        $justification = $this->input->post();
        $justification['id_user'] = $this->session->userdata('id_user');
        
        $status = $this->validData($justification);
  
        if ($status['status']) {
            if(isset($justification['id_detalle_documento_pago'])){
                $justification['last_update'] = date('Y-m-d H:m:s');
                $this->db->where('id_detalle_documento_pago', 
                                        $justification['id_detalle_documento_pago']);
                $this->db->update($this->controller, $justification);
                
            }else{
                $this->db->insert($this->controller, $justification);
            }
            $this->redirectPage('paidPresent', $justification['id_documento_pago']);
            return true;
        } else {
            $this->responseHttp([
                'viewMessage' => true,
                'message' => 'Uno de los campos es incorrecto',
                'inputPlace' => $status['columns'],
                'idRow' => $justification['id_documento_pago'],
            ]);
            return false;
        }
    }
    
    
    /**
     * Elimina el detalle de una documento de pago
     * @param int $idDetail
     */
    public function eliminar($idDetail){
        $detail = $this->modelPaidDetail->getDetail($idDetail);
        if ($detail == false){
            $this->redirectPage('paidsList');
            return false;
        }
        $this->db->where('id_detalle_documento_pago', $idDetail);
        if ($this->db->delete($this->controller)){
            $this->redirectPage('paidPresent', $detail['id_documento_pago']);
           }
    }

    
    /**
     * Presenta los detalles completos de un gasto
     * @param integer $idDetail
     * @reuturn string template
     */
    public function presentar($idDetail){
        if (!isset($idDetail)) {
            $this->redirectPage('paidsList');
            return false;
        }
        
        $detail = $this->modelPaidDetail->getDetail($idDetail);
        
        if ($idDetail == false){
            $this->redirectPage('paidsList');
            return false;
        }
        $document = $this->modelPaid->getDocument($detail['id_documento_pago']);
        $this->responseHttp([
            'titleContent' => 'Detalle Justificación de Provision',
            'show' => true,
            'detail' => $detail,
            'user' => $this->modelUser->get($detail['id_user']),
            'provision' => $this->modelExpenses->getExpense($detail['id_gastos_nacionalizacion']),
            'document' => $document,
            'supplier' => $this->modelSupplier->get($document['identificacion_proveedor']),
        ]);
    }
    
    /**
     * Se validan las columnas que debe tener la consulta para que no falle
     * 
     * @return [array] | [bolean]
     */
    private function validData($data)
    {
        $paramsData = [
            'id_documento_pago' => 1,
            'id_gastos_nacionalizacion' => 1,
            'valor' => 2,
            'id_user' => 1
        ];
        return $this->_checkColumnsData($paramsData, $data);
    }

    /**
     * Envia el render html al navegador
     * 
     * @param
     *            $config
     * @return mixed
     */
    private function responseHttp($config)
    {
        $params = [
            'title' => 'Detalle Documentos Pagos',
            'base_url' => base_url(),
            'rute_url' => base_url() . 'index.php/',
            'controller' => $this->controller,
            'iconTitle' => 'fa-file-text',
            'content' => 'home',
            'controller' => $this->controller
        ];
        return $this->twig->display($this->template, array_merge($config, $params));
    }
}

