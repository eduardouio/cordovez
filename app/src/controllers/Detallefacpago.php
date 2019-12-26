<?php
defined('BASEPATH') or exit('No direct script access allowed');
$libraries_url = realpath(dirname(__FILE__));
$libraries_url = str_replace('controllers', 'libraries/', $libraries_url);
require_once ( $libraries_url . 'Rest.php' );

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
class Detallefacpago extends MY_Controller
{
    private $template = "/pages/pageFacturasDetalles.html";
    private $controller = 'detalle_documento_pago';
    private $modelOrder;
    private $modelPaid;
    private $modelLog;
    private $modelPaidDetail;
    private $modelUser;
    private $modelExpenses;
    private $modelSupplier;
    private $myModel;
    private $rest;


    /**
     * constructor de la clase
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

        if(! isset($this->session->userdata['id_user'])){
            exit(0);
        }

        $this->load->model('modelorder');
        $this->load->model('modelpaid');
        $this->load->model('modeluser');
        $this->load->model('modelexpenses');
        $this->load->model('modelpaiddetail');
        $this->load->model('modelsupplier');
        $this->load->model('mymodel');
        $this->load->model('modellog');
        $this->rest = new Rest();
        $this->modelOrder = new Modelorder();
        $this->modelPaid = new Modelpaid();
        $this->modelUser = new Modeluser();
        $this->modelExpenses = new Modelexpenses();
        $this->modelPaidDetail = new Modelpaiddetail();
        $this->modelSupplier = new Modelsupplier();
        $this->myModel =  new Mymodel();
        $this->modelLog = new Modellog();
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
     * Registra el detalle de una factura de pago servicios
     * y a la vez registra un gasto en la tabla de gastos de nacionalizacion
     * como gasto no provisionado y lo deja con estatus gb_closed
     * El gasto es tomado como gasto inicial en R10
     * y si no pertenece a ningun parcial gasto inicial en R70
     * @param int $idDocument => identificacion Factura Pago
     */
    public function noProvisionado(){
        $id_parcial = 0;
        $nro_pedido = '000-00';


        if (isset($_POST['id_parcial'])){
            $id_parcial = $_POST['id_parcial'];
        }else{
            $nro_pedido = $_POST['nro_pedido'];
        }

        $document = $this->modelPaid->getDocument($_POST['id_documento_pago']);

        $idExpense = $this->modelExpenses->create([
            'nro_pedido' => $nro_pedido,
            'id_parcial' => $id_parcial,
            'identificacion_proveedor' => $document['identificacion_proveedor'],
            'concepto' => $_POST['concepto'],
            'tipo' => 'NO PROVISIONADO',
            'valor_provisionado' => $_POST['valor'],
            'comentarios' => $_POST['comentarios'],
            'fecha' => date('Y-m-d'),
            'id_user' => $this->session->userdata('id_user'),
            'bg_closed' => 1,
            ]);

        if($idExpense == false){
            $this->modelLog->errorLog(
                            'No se puede proceder con el gasto no provisionado'
                                     );
            return (print('Error en el Sistema'));
        }

        if($this->modelPaidDetail->create([
            'id_gastos_nacionalizacion' => $idExpense,
            'id_documento_pago' => $_POST['id_documento_pago'],
            'valor' => $_POST['valor'],
            'id_user' => $this->session->userdata('id_user'),
            'bg_isnotprovisioned' => 1,
            'bg_closed' => 1,
        ])){
            $this->redirectPage('paidPresent' , $_POST['id_documento_pago']);
        };
    }



    /**
     * Presenta un formulario para editar la justificacion
     * recupera la informacion de las otras justificaciones
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
        $details = $this->modelPaidDetail->getByExpense($detail['id_gastos_nacionalizacion']);
        $valJustified = ($details['sums'] - $detail['valor']);

        $arreglo = [
            'invoiceDetail' => $detail,
        ];
        $this->responseHttp([
            'edit' => true,
            'titleContent' => 'Editar Item Docuemento Pago Factura [ ' .
                                $document['nro_factura'] . '] <small>' .
                                $document['supplier']['nombre'] . '</small>',
            'document' => $document,
            'details' => $details,
            'valJustified' => $valJustified,
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
    public function validar(){
        $justification = json_decode(file_get_contents('php://input'),true);
        $justification['id_user'] = $this->session->userdata('id_user');
        $status = $this->validData($justification);
        if ($status['status']) {
            if(isset($justification['id_detalle_documento_pago'])){
                $justification['last_update'] = date('Y-m-d H:m:s');
                $this->insertDB($justification, 'update');
            }else{
                $this->insertDB($justification, 'insert');
            }
            return $this->_responseRest([],201);
        } else {
            return $this->_responseRest([],500);
        }
    }


    /**
     * Elimina el detalle de una documento de pago y verifica que la
     * provision quede injustificada
     * @param int $idDetail
     */
    public function eliminar($idDetail){
        $detail = $this->modelPaidDetail->getDetail($idDetail);
        if ($detail == false){
            $this->redirectPage('paidsList');
            return false;
        }
        $provision = $this->modelExpenses->getExpense(
                                                $detail['id_gastos_nacionalizacion']);
        $provisonUpdate = [
            'bg_closed' => 0,
        ];
        $this->db->where('id_detalle_documento_pago', $idDetail);
        if ($this->db->delete($this->controller)){
            if($provision['bg_closed']){
                $this->db->where('id_gastos_nacionalizacion',
                                                $detail['id_gastos_nacionalizacion']);
                $this->db->update('gastos_nacionalizacion', $provisonUpdate );
            }
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

        return($this->responseHttp([
            'titleContent' => 'Detalle Justificación de Provision',
            'show' => true,
            'detail' => $detail,
            'user' => $this->modelUser->get($detail['id_user']),
            'provision' => $this->modelExpenses->getExpense($detail['id_gastos_nacionalizacion']),
            'document' => $document,
            'supplier' => $this->modelSupplier->get($document['identificacion_proveedor']),
        ]));

    }


    /**
     * Verifica si un gasto esta completo o no antes de regitrarlo en la bd
     * @param array $row registro a insertar o actualizar
     * @param string action update | insert
     * @return bool
     */
    private function insertDB(array $row, string $action): bool
    {
        $provision = $this->modelExpenses->getExpense(
                                            $row['id_gastos_nacionalizacion']
            );
        $details = $this->modelPaidDetail->getByExpense($row['id_gastos_nacionalizacion']);
        $valRegister = 0.0;
        $provisonUpdate = [
            'bg_closed' => 0,
        ];

        if (($action == 'update') && ($details != false)){
            foreach ($details as $index => $val){
                if($val['id_detalle_documento_pago'] ==
                    $row['id_detalle_documento_pago']){
                    unset($details[$index]);
                }
            }
        }

        if(($action == 'insert') && ($details != 'false')){
            $valRegister = $details['sums'];
        }

        if(($valRegister == 0) && ($provision['valor_provisionado'] == $row['valor'])){
            $provisonUpdate['bg_closed'] = 1;
        }elseif($valRegister + $row['valor'] == $provision['valor_provisionado']){
            $provisonUpdate = [
                'bg_closed' => '1',
            ];
        }
        if ($action == 'insert'){
            if($this->db->insert($this->controller, $row)){

                $this->db->where(
                            'id_gastos_nacionalizacion',
                            $provision['id_gastos_nacionalizacion']
                    );
                $this->db->update('gastos_nacionalizacion', $provisonUpdate);
                return true;
            }
           print $this->db->last_query();
        }else{
            $this->db->where('id_detalle_documento_pago',
                $row['id_detalle_documento_pago']);
            if($this->db->update($this->controller, $row)){
                $this->db->where(
                    'id_gastos_nacionalizacion',
                    $provision['id_gastos_nacionalizacion']);
                $this->db->update('gastos_nacionalizacion', $provisonUpdate);
                return true;
            }
        }
        return false;
    }


    /**
     * Se validan las columnas que debe tener la consulta para que no falle
     *
     * @return [array] | [bolean]
     */
    private function validData($data){
        $paramsData = [
            'id_documento_pago' => 1,
            'id_gastos_nacionalizacion' => 1,
            'valor' => 0,
            'id_user' => 1
        ];
        return $this->_checkColumnsData($paramsData, $data);
    }

    /**
     * Metodo de respuesta Rest
     * @param array $config
     */
    private function _responseRest($data, $httpstatus = 0){
        $data['session'] = $this->session->userdata();
        return $this->rest->_responseHttp($data, $httpstatus);
    }

    /**
     * Envia el render html al navegador
     *
     * @param array $config arreglo de configiraciones
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
            'controller' => $this->controller,
            'enterprise' => $GLOBALS['selected_enterprise'],
        ];
        return $this->twig->display($this->template, array_merge($config, $params));
    }
}
