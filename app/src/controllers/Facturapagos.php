<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Valida los datos de las provisiones
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Facturapagos extends MY_Controller
{
    private $controller = "documento_pago";
    private $template = "/pages/pageFacturas.html";
    private $listPerPage = 100;
    private $modelOrder;
    private $modelParcial;
    private $modelLog;
    private $modelUser;
    private $modelSupplier;
    private $modelPaid;
    private $modelExpenses;
    private $modelPaidDetail;
    private $myModel;


    /**
     * constructor de la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }


    /**
     * Carga los modelos a usar en la clase
     * @return void
     */
    private function init()
    {
        if(! isset($this->session->userdata['id_user'])){
            exit(0);
        }

        $models = [
            'modelorder',
            'modelparcial',
            'modeluser',
            'modelsupplier',
            'modellog',
            'modelpaid',
            'mymodel',
            'Modelpaiddetail',
            'Modelexpenses',
        ];

        foreach ($models as $model){
            $this->load->model($model);
        }

        $this->modelExpenses = new Modelexpenses();
        $this->modelPaidDetail = new Modelpaiddetail();
        $this->modelOrder = new Modelorder();
        $this->modelParcial = new Modelparcial();
        $this->modelUser = new Modeluser();
        $this->modelSupplier = new Modelsupplier();
        $this->modelLog = new Modellog();
        $this->modelPaid = new Modelpaid();
        $this->myModel = new Mymodel();
    }

    /**
     * Redirecciona a la lista de las facturas
     * @return void
     */
    public function index()
    {
        $this->modelLog->redirectLog(
            'Se ghace el redireccionamiento a la lista de docuemntos de pago'
            );
        return $this->listar();
    }


    /**
     * Lista Todas las facturas de pagos disponibles en el sistema
     * @param $offset (int) primer elemento de la lista
     * @return mixed
     */
    public function listar()
    {
        $documentList = [];

        if($_POST){
            $documentList = $this->getInfoDocumentsData(
                                $this->modelPaid->search($_POST['param'])
                );
        }else{
            $documentList = $this->getInfoDocumentsData(
                $this->modelPaid->getAll()
                );
        }

        $this->responseHttp([
            'list' => true,
            'controller' => $this->controller,
            'list_active' => 'class="active"',
            'titleContent' => 'Lista de Comprobantes de Pago',
            'userData' => $this->session->userdata(),
            'documentsPaids' => $documentList,
        ]);
    }



    /**
     * Presenta el formulario para el registro de un nuevo documento de Pago
     * @return mixed
     */
    public function nuevo()
    {
        $this->responseHttp([
            'titleContent' => 'Registro Nuevo Comprobante De Pago Servicios',
            'suppliers' => $this->modelSupplier->getByLocation('NACIONAL'),
            'create' => true,
        ]);
    }


    /**
     * Presenta el formulario para editar las cabeceras de una facatura
     * @param $nroDocument
     */
    public function editar($nroDocument)
    {
        if (!isset($nroDocument)){
            $this->redirectPage('paidsList');
            return false;
        }

        $document = $this->modelPaid->get($nroDocument);

        if ($document == false){
            $this->redirectPage('paidsList');
            return false;
        }

        $this->responseHttp([
            'titleContent' => 'Editar Factura ['. $document['nro_factura'] .']',
            'update' => true,
            'suppliers' => $this->modelSupplier->getAll(),
            'document' => $document,
        ]);
    }

    /**
     * elimina una factura de la base de datos
     * @param $nroDocument
     */
    public function eliminar($nroDocument){
        if(!isset($nroDocument)){
            $this->redirectPage('paidsList');
            return false;
        }

        $this->db->where('id_documento_pago', $nroDocument);
        if($this->db->delete($this->controller)){
            $this->responseHttp([
                'title' => 'Factura Eliminada',
                'titleContent' => 'Registro Eliminado',
                'viewMessage' => true,
                'deleted' => true,
                'message' => 'Registro Eliminado Correctamente!',
            ]);
            return true;
        }

        $this->responseHttp([
            'titleContent' => 'Error Al Eliminal',
            'viewMessage' => true,
            'message' => 'No se puede eliminar el regitro, tiene dependencias',
            'idRow' => $nroDocument,
        ]);
        return false;
    }


    /**
     * Guarda una factura en el sistema o la actualiza si existe
     */
    public function validar()
    {
        if (!$_POST) {
            $this->redirectPage('paidsList');
            return true;
        }
        $document = $this->input->post();
        $document['fecha_emision'] = str_replace('/', '-', $document['fecha_emision']);
        $document['fecha_emision'] = date('Y-m-d', strtotime(
                                                $document['fecha_emision'])
            );
        $document['id_user'] = $this->session->userdata('id_user');
        $status = $this->validData($document);
        if($status['status']){
            if(!isset($document['id_documento_pago'])){
                $this->db->where('nro_factura', $document['nro_factura']);
                $this->db->where('identificacion_proveedor', $document['identificacion_proveedor']);
                $result = $this->db->get($this->controller);
                if ($result->num_rows() == 1){
                    $documentDb = $result->result_array();
                    $this->responseHttp([
                        'titleContent' => 'Registro Nuevo Comprobante De Pago',
                        'viewMessage' => true,
                        'message' => 'Este documento ya está registrado!',
                        'idRow' => $documentDb[0]['id_documento_pago'],
                        'suppliers' => $this->modelSupplier->getAll(),
                    ]);
                    return false;
                }
                $this->db->insert($this->controller, $document);
                $lastId = $this->db->insert_id();
                $this->redirectPage('paidPresent', $lastId);
            }else{
                $document['last_update'] = date('Y-m-d H:i:s');
                $this->db->where('id_documento_pago',
                                                $document['id_documento_pago']);
                $this->db->update($this->controller, $document);
                $this->redirectPage('paidPresent',
                                                $document['id_documento_pago']);
                }
        }else{
            $this->responseHttp([
                'titleContent' => 'Registro Nuevo Comprobante De Pago',
                'incompleteForm' => true,
                'message' => 'La información de uno de los campos es inválida!',
                'errors' => $status,
                'suppliers' => $this->modelSupplier->getAll(),
                'create' => true,
            ]);
        }
    }


    /**
     * Verifica que las facturas que estan como abiertas sean cerradas
     * si la suma de los items es igual a la suma del valor total
     * @return boolean
     */
    public function checkinvoices(){
        print 'Cerrando Facturas completas';
        $open_invoices = $this->modelPaid->getAll();

        foreach ($open_invoices as $idx => $invoice){
            $detail = $this->modelPaidDetail->get($invoice['id_documento_pago']);
            if ($invoice['valor'] == $detail['sums']){
                $invoice['bg_closed'] = 1;
                $this->modelPaid->update($invoice);
            }
        }
        return $this->redirectPage('paidsList');
    }


    /**
     * Recupera la informacion completa de una factura
     * @param $idInvoice
     * @return array | bool
     */
    public function presentar($id_document = 0){
        $document = $this->modelPaid->get($id_document);
        if ($document == false){
            $this->redirectPage('paidsList');
            return false;
        }
        $provisions = $this->modelExpenses->getAllProvisions();
        $orders  = get_nro_orders($provisions);
        $this->responseHttp([
            'title' => 'Factura #' . $document['nro_factura'] . ' ' . $document['supplier']['nombre'],
            'titleContent' => 'Detalle Documento De Pago [' .
                                  $document['nro_factura']. '] <small>'.
                                  $document['supplier']['nombre'] . '</small>',
            'document' => $document,
            'orders' => $orders,
            'provisions' => $provisions,
            'user' => $this->modelUser->get($document['id_user']),
            'vue_app' => True,
            'show' => True,
        ]);
    }


    /**
     * Recupera la información de los documentos
     * @param array $documents
     * @return array
     */
    private function getInfoDocumentsData($documents) : array {

        if ($documents == False){
           return [];
        }

        $documents_list = [];
        foreach ($documents as $idx => $doc){
            $details = $this->modelPaidDetail->get($doc['id_documento_pago']);
            $doc['details'] = $details['details'];
            $doc['orders'] = [];
            $doc['saldo'] = $doc['valor'];

            if($doc['details']){
                foreach ($doc['details'] as $k => $det){
                    if($det['expense']['nro_pedido'] == '000-00'){
                         $parcial = $this->modelParcial->get($det['expense']['id_parcial']);
                         array_push($doc['orders'], $parcial['nro_pedido']);
                    }else{
                        array_push($doc['orders'], $det['expense']['nro_pedido']);
                    }

                    $doc['saldo'] = round($doc['saldo'] -  $det['valor']);
                }

                if ($doc['saldo'] < 0.01 && $doc['bg_closed'] == 0){
                    $document_base = $this->modelPaid->get($doc['id_documento_pago']);
                    $doc['bg_closed'] = 1;
                    $document_base['bg_closed'] = 1;
                    $doc['saldo'] = 0.0;
                    $this->modelPaid->update($document_base);
                }

            }
            array_push($documents_list, $doc);
        }
      return $documents_list;
    }



    /**
     * Se validan las columnas que debe tener la consulta para que no falle
     * @return [array] | [bolean]
     */
    private function validData($data)
    {
        $paramsData = [
            'identificacion_proveedor' => 5,
            'nro_factura' => 1,
            'fecha_emision' => 10,
            'valor' => 2,
            'id_user' => 1,
        ];
        return $this->_checkColumnsData($paramsData, $data);
    }


    /**
     * Envia el render html al navegador
     * @param $config
     * @return mixed
     */
    public function responseHttp($config)
    {
        $config['base_url'] = base_url();
        $config['rute_url'] = base_url() . 'index.php/';
        $config['controller'] = $this->controller;
        $config['iconTitle'] = 'fa-file-text';
        $config['content'] = 'home';
        return $this->twig->display($this->template, $config);
    }
}
