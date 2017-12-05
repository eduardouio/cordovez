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
    private $listPerPage = 15;
    private $modelOrder;
    private $modelUser;
    private $modelSupplier;
    private $modelPaid;
    

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
        $this->load->model('modelorder');
        $this->load->model('modeluser');
        $this->load->model('modelsupplier');
        $this->load->model('modelpaid');
        $this->modelOrder = new Modelorder();
        $this->modelUser = new Modeluser();
        $this->modelSupplier = new Modelsupplier();
        $this->modelPaid = new Modelpaid();
    }

    /**
     * Redirecciona a la lista de las facturas
     * @return void
     */
    public function index()
    {
        $this->listar();
    }

    /**
     * Lista Todas las facturas de pagos disponibles en el sistema
     * @param $offset (int) primer elemento de la lista
     * @return mixed
     */
    public function listar($offset = 0)
    {
        $this->db->order_by('fecha_emision', 'DESC');
        $this->db->limit($this->listPerPage, $offset);
        $resultDb = $this->db->get($this->controller);
        $documents = $resultDb->result_array();
        $pages_links = ((count($documents) - 1) / $this->listPerPage);
        if (gettype($pages_links) == 'double') {
            (int)$pages_links = (int)$pages_links + 1;
        };
        $documentList = [];
        foreach ($documents as $item => $document) {
            $document['supplier'] = $this->modelSupplier->get(
                                        $document['identificacion_proveedor']);
            $document['documentDetail'] = $this->modelPaid->get(
                                                 $document['id_documento_pago']);
            $document['user'] = $this->modelUser->get($document['id_user']);
            $documentList[$item] = $document;
        }
        $this->responseHttp([
            'list' => true,
            'controller' => $this->controller,
            'list_active' => 'class="active"',
            'titleContent' => 'Lista de Comprobantes de Pago',
            'userData' => $this->session->userdata(),
            'pagination' => true,
            'documentsPaids' => $documentList,
            'perPage' => $this->listPerPage,
            'pagination_pages' => $pages_links,
            'current_page' => (int)(($offset) / 10) + 1,
            'last_page' => (int)(($pages_links - 1) * 10),
            'pagination_url' => base_url() . 'index.php/pedido/listar/',
        ]);
    }

    /**
     * Presenta el formulario para el registro de un nuevo documento de Pago
     * @return mixed
     */
    public function nuevo()
    {
        $this->responseHttp([
            'titleContent' => 'Registro Nuevo Comprobante De Pago',
            'suppliers' => $this->modelSupplier->getAll(),
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
                'titleContent' => 'Registro Eliminado',
                'viewMessage' => true,
                'deleted' => true,
                'message' => 'Registro Eliminado Correctamente!',
            ]);
            return true;
        }
        
        $document = $this->modelPaid->get($nroDocument);
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
        $document['fecha_emision'] = date('Y-m-d', strtotime(
                                                $document['fecha_emision']));
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
     * Recupera la informacion completa de una factura
     * @param $idInvoice
     * @return array | bool
     */
    public function presentar($nroDocument)
    {
        if(!isset($nroDocument)){
            $this->redirectPage('paidsList');
            return false;
        }        
        $document = $this->modelPaid->get($nroDocument);
        if ($document == false){
            $this->redirectPage('paidsList');
            return false;
        }
        $this->responseHttp([
            'titleContent' => 'Detalle Documento De Pago [' . 
                                  $document['nro_factura']. '] <small>'. 
                                  $document['supplier']['nombre'] . '</small>',
            'document' => $document,
            'user' => $this->modelUser->get($document['id_user']),
            'show' => true,
        ]);
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
        $config['title'] = 'Documentos   Pagos';
        $config['base_url'] = base_url();
        $config['rute_url'] = base_url() . 'index.php/';
        $config['controller'] = $this->controller;
        $config['iconTitle'] = 'fa-file-text';
        $config['content'] = 'home';
        return $this->twig->display($this->template, $config);
    }
}
