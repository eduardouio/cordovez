<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Controller encargado de manejar los gastos iniciales
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class Gstinicial extends MY_Controller
{

    private $controller = "gastos_nacionalizacion";
    private $template = '/pages/pageGastoInicial.html';
    private $securePercent = 0.0018;
    private $isdPer = 0.05;
    private $modelBase;
    private $modelOrder;
    private $modelSupplier;
    private $modelExpenses;
    private $myModel;
    private $modelIncoterms;
    private $modelProducts;
    private $modelUser;

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
        $this->load->model('modelsupplier');
        $this->load->model('modelbase');
        $this->load->model('modelexpenses');
        $this->load->model('mymodel');
        $this->load->model('modelincoterms');
        $this->load->model('modelproduct');
        $this->load->model('modeluser');
        $this->modelOrder = new Modelorder();
        $this->modelSupplier = new Modelsupplier();
        $this->modelBase = new ModelBase();
        $this->modelExpenses = new Modelexpenses();
        $this->myModel = new Mymodel();
        $this->modelIncoterms = new Modelincoterms();
        $this->modelProducts = new Modelproduct();
        $this->modelUser = new Modeluser();
    }

    /**
     * Redirecciona a la lista de los pedidos
     */
    public function index()
    {
        $this->redirectPage('ordersList');
    }

    /**
     * Pesenta la informacion completa del rgistro de gasto inicial
     * 
     * @param (int) $idInitExpense
     * @return array
     */
    public function presentar($idInitExpense)
    {
        if (!isset($idInitExpense)){
            $this->redirectPage('ordersList');
            return false;
        }
        
        $initExpense = $this->modelExpenses->getExpense($idInitExpense);
        
        if ($initExpense == false){
            $this->redirectPage('ordersList');
            return false;
        };
        
        $order = $this->modelOrder->get($initExpense['nro_pedido']);
        
        $this->responseHttp([
            'order' => $order,
            'initExpense' => $initExpense,
            'supplier' => $this->modelSupplier->get($initExpense['identificacion_proveedor']),
            'createBy' => $this->session->userdata(),
            'titleContent' => 'Descripción De Gasto Inicial Pedido:' . $order['nro_pedido'],
            'show' => true
        ]);
    }

    /**
     * Muestra el formulario para regostrar un nuevo gasto inicial
     * 
     * @param (string) $nroOrder
     * @return (array)
     *
     */
    public function nuevo($nroOrder)
    {
        if (! isset($nroOrder)) {
            $this->redirectPage('ordersList');
        }
        $order = $this->modelOrder->get($nroOrder);
        $suppliers = $this->modelSupplier->getAll();
        $rateExpenses = $this->modelExpenses->getAllRates($order['regimen']);
        $usedExpenses = $this->modelExpenses->get($order['nro_pedido']);
        $unusedExpenses = $this->calcExpensesDiff($rateExpenses, $usedExpenses);
        
        $this->responseHttp([
            'used_expenses' => json_encode($rateExpenses),
            'create' => true,
            'order' => $order,
            'suppliers' => $suppliers,
            'rateExpenses' => $rateExpenses,
            'usedExpenses' => $usedExpenses,
            'unusedExpenses' => $unusedExpenses,
            'titleContent' => 'Registro De Gasto Inicial Provisionado ' . '[ Pedido ' . $nroOrder . ']'
        ]);
    }

    /**
     * Edita un gasto inicial
     */
    public function editar($idInitExpense)
    {
        $this->db->where('id_gastos_nacionalizacion', $idInitExpense);
        $resultDb = $this->db->get($this->controller);
        $initExpense = $resultDb->result_array();
        $this->db->where('identificacion_proveedor', $initExpense[0]['identificacion_proveedor']);
        $resultDb = $this->db->get('proveedor');
        $supplier = $resultDb->result_array();
        
        $resultDb = $this->db->get('proveedor');
        $suppliers = $resultDb->result_array();
        $this->db->where('nro_pedido', $initExpense[0]['nro_pedido']);
        
        $resultDb = $this->db->get('pedido');
        $order = $resultDb->result_array();
        
        $config = array(
            'order' => $order[0],
            'initExpense' => $initExpense[0],
            'supplier' => $supplier[0],
            'suppliers' => $suppliers,
            'createBy' => $this->session->userdata(),
            'titleContent' => 'Descripción De Gasto Incial Pedido:' . $order[0]['nro_pedido'],
            'edit' => true
        );
        $this->responseHttp($config);
    }

    /**
     * Valida la informacion de registro de un gasto inicial
     *
     * @param (array) $_POST
     *            gasto_inicial
     * @return (void) | false
     */
    public function validar()
    {
        if (! $_POST) {
            $this->redirectPage('ordersList');
        }
        
        $initExpense = $this->input->post();
        $initExpense['id_user'] = $this->session->userdata('id_user');
        $initExpense['fecha'] = date('Y-m-d', strtotime($initExpense['fecha']));
        if (isset($initExpense['fecha_fin'])) {
            $initExpense['fecha_fin'] = date('Y-m-d', strtotime($initExpense['fecha_fin']));
        }
        
        if (! isset($initExpense['id_gastos_nacionalizacion'])) {
            $this->db->where('nro_pedido', $initExpense['nro_pedido']);
            $this->db->where('concepto', $initExpense['concepto']);
            $resultDb = $this->db->get($this->controller);
            
            if ($resultDb->num_rows() == 1) {
                $config['orderInvoice'] = $resultDb->result_array();
                $config['viewMessage'] = true;
                $config['message'] = 'Este Gasto Inicial Ya Está Registrado!';
                $this->responseHttp($config);
                return true;
            }
        }
        
        $status = $this->validData($initExpense);
        
        if ($status['status']) {
            if (! isset($initExpense['id_gastos_nacionalizacion'])) {
                $this->db->insert($this->controller, $initExpense);
                $this->redirectPage('presentOrder', $initExpense['nro_pedido']);
                return true;
            } else {
                $initExpense['last_update'] = date('Y-m-d H:i:s');
                $this->db->where('id_gastos_nacionalizacion', $initExpense['id_gastos_nacionalizacion']);
                $this->db->update($this->controller, $initExpense);
                $this->redirectPage('presentOrder', $initExpense['nro_pedido']);
                return true;
            }
        } else {
            $this->responseHttp([
                'viewMessage' => true,
                'message' => 'La información de uno de los campos es incorrecta!',
                'data' => $status['columns']
            ]);
        }
    }

    /**
     * Elimina un Gasto inicial
     * 
     * @param $idInitiExpense =>
     *            identificador del registro a eliminar
     * @return void
     */
    public function eliminar($idInitExpense)
    {
        if (! isset($idInitExpense)) {
            $this->redirectPage('ordersList');
        }
        
        $this->db->where('id_gastos_nacionalizacion', $idInitExpense);
        $resultDb = $this->db->get($this->controller);
        $detail = $resultDb->result_array();
        
        $this->db->where('id_gastos_nacionalizacion', $idInitExpense);
        if ($this->db->delete($this->controller)) {
            $config = [
                'order' => $detail[0]['nro_pedido'],
                'viewMessage' => true,
                'deleted' => true,
                'message' => 'Gasto Inicial Eliminado Exitosamente!'
            ];
            $this->responseHttp($config);
            return true;
        } else {
            $config = [
                'orderDetail' => $detail[0]['id_pedido_factura'],
                'viewMessage' => true,
                'message' => 'El registro no puede ser Eliminado, 
																												 tiene dependencias!'
            ];
            $this->responseHttp($config);
            $this->db->where('id_gastos_nacionalizacion', $idInitExpense);
        }
    }

    /**
     * Verifica Los gastos iniciales de una Order, indica al isuario
     * Los parametros que un pedido debe cumplir para que se puedan
     * Generar los gastos iniciales
     * 
     * @param (string) $nroOrder
     * @return (array)
     */
    public function validarGI(string $nroOrder)
    {
        $order = $this->modelOrder->get($nroOrder);
        
        if ((empty($order) == true) || ($order == false)) {
            $this->redirectPage('ordersList');
            return true;
        }
        
        $rateExpenses = $this->modelExpenses->getAllRates($order['regimen']);
        $incoterms = $this->modelIncoterms->get($order);
        $invoicesOrder = $this->modelOrder->getInvoices($nroOrder);
        $initExpenses = $this->myModel->getInitialExpenses($nroOrder);
        $minimal = $this->getMinimalParams($order, $initExpenses);
        $minimal['valuesOrder'] = $this->calcValuesOrderItems($order, $invoicesOrder, $initExpenses);
        $config = [
            'validateExpenses' => true,
            'titleContent' => 'Generar Gastos Iniciales Pedido: [' . $nroOrder . '] ' . ' <small>Validar Información</small>',
            'rateExpenses' => $rateExpenses,
            'unusedExpenses' => $this->calcExpensesDiff($rateExpenses, $initExpenses),
            'incoterms' => $incoterms,
            'invoicesOrder' => $invoicesOrder,
            'initExpenses' => $initExpenses,
            'order' => $order,
            'minimal' => $minimal,
            'user' => $this->modeluser->get($order['id_user']),
            'isOk' => searchOrderCeroValues($minimal)
        ];
        $this->responseHttp($config);
    }

    /**
     * Establece los gastos iniciales de acuedo a los parametros establecidos
     * 
     * @param (string) $nroOrder
     * @return array | boolean
     */
    public function putIncoterms($nroOrder)
    {
        if (! isset($nroOrder)) {
            $this->redirectPage('ordersList');
            return false;
        }
        $order = $this->modelOrder->get($nroOrder);
        
        if ($order == false) {
            $this->redirectPage('ordersList');
            return false;
        }
        $incoterms = $this->modelIncoterms->get($order[0]);
        
        if ($incoterms == false) {
            $this->redirectPage('presentOrder', $nroOrder);
        }
        
        $id_user = $this->session->userdata('id_user');
        
        foreach ($incoterms as $key => $value) {
            $initExpense = [
                'nro_pedido' => $nroOrder,
                'id_nacionalizacion' => 0,
                'identificacion_proveedor' => 0,
                'concepto' => $value['tipo'],
                'valor_provisionado' => $value['tarifa'],
                'comentarios' => 'CREADO AUTOMATICAMENTE',
                'id_user' => $id_user,
                'fecha' => date("Y-m-d")
            ];
            $this->db->insert($this->controller, $initExpense);
        }
        $this->redirectPage('presentOrder', $nroOrder);
    }

    /**
     * Reemplaza los incoterms cuando un pedido se edita
     * por el momento siempre los cambia
     *
     * @param string $nroOrder
     * @return void
     */
    public function replaceIncoterms($nroOrder)
    {
        if (! isset($nroOrder)) {
            $this->redirectPage('ordersList');
            return false;
        }
        
        $order = $this->modelOrder->get($nroOrder);
        $initExpenses = $this->myModel->getInitialExpenses($nroOrder);
        
        foreach ($initExpenses as $key => $expense) {
            
            if (($expense['concepto'] == 'GASTO ORIGEN') || ($expense['concepto'] == 'FLETE')) {
                $this->db->where('id_gastos_nacionalizacion', $expense['id_gastos_nacionalizacion']);
                $this->db->delete($this->controller);
            }
        }
        $this->putIncoterms($nroOrder);
    }

    /**
     * Elimina y Crea gastos iniciales, sin tomar en cuenta FLETE y GASTOS ORIGEN
     * 
     * @param array $_POST
     * @return void | boolean
     */
    public function putInitialExpenses()
    {
        if (! $_POST) {
            $this->redirectPage('ordersList');
            return true;
        }
        $initExpensesInput = $this->input->post();
        $initExpensesRates = [];
        
        foreach ($initExpensesInput as $key => $value) {
            if ($key != 'nro_pedido') {
                $rates = $this->modelBase->get_table([
                    'table' => 'tarifa_gastos',
                    'where' => [
                        'id_tarifa_gastos' => $value
                    ]
                ]);
                array_push($initExpensesRates, $rates[0]);
            }
        }
        
        $order = $this->modelOrder->get($initExpensesInput['nro_pedido']);
        $order = $order[0];
        $invoicesOrder = $this->modelOrder->getInvoices($initExpensesInput['nro_pedido']);
        $initExpenses = $this->myModel->getInitialExpenses($initExpensesInput['nro_pedido']);
        
        $valuesOrder = $this->calcValuesOrderItems($order, $invoicesOrder, $initExpenses);
        
        foreach ($initExpensesRates as $key => $value) {
            $insertExpense = [
                'nro_pedido' => $initExpensesInput['nro_pedido'],
                'id_nacionalizacion' => 0,
                'identificacion_proveedor' => 0,
                'concepto' => $value['concepto'],
                'valor_provisionado' => $value['valor'],
                'comentarios' => 'CREADO AUTOMATICAMENTE',
                'fecha' => date('Y-m-d'),
                'id_user' => $this->session->userdata('id_user')
            ];
            if ($value['concepto'] == 'ISD') {
                $insertExpense['valor_provisionado'] = $valuesOrder['isd'];
            } elseif ($value['concepto'] == 'SEGURO') {
                $insertExpense['valor_provisionado'] = $valuesOrder['seguro'];
            }
            
            $this->db->insert($this->controller, $insertExpense);
        }
        $this->redirectPage('validargi', $initExpensesInput['nro_pedido']);
    }

    /**
     * Calcula los Valores FOB; FLETE; CIF ; ISD ; SEGURO de un pedido, y ademas
     * comprueba que el detalle de las facturas sea igual al que se encuentra
     * registrado en el pedido
     * 
     * @param
     *            $order
     * @param
     *            @invoicesOrder
     * @param
     *            $initExpenses
     *            
     * @return array
     */
    private function calcValuesOrderItems($order, $invoicesOrder, $initExpenses)
    {
        $paramsIncoterm = [
            'EXW' => '1',
            'FCA' => '1',
            'FOB' => '0',
            'CFR' => '-1'
        ];
        
        $valuesOrder = [
            'invoicesSum' => 0.0,
            'totalInvoices' => 0.0,
            'statusInvoices' => false,
            'gastos_origen' => 0.0,
            'incoterm' => $order['incoterm'],
            'flete' => 0.0,
            'fob' => 0.0,
            'seguro' => 0.0,
            'isd' => 0.0
        ];
        
        if ($invoicesOrder) {
            foreach ($invoicesOrder as $key => $invoice) {
                $valuesOrder['totalInvoices'] += floatval($invoice['valor'] * floatval($invoice['tipo_cambio']));
                $valuesOrder['invoicesSum'] += (floatval($invoice['detailInvoice']['sums']['valueItems']) * floatval($invoice['tipo_cambio']));
            }
            if ($valuesOrder['totalInvoices'] == $valuesOrder['invoicesSum']) {
                $valuesOrder['statusInvoices'] = true;
            }
        }
        
        if(gettype($initExpenses) == 'array'){
            foreach ($initExpenses as $key => $value) {
                if ($value['concepto'] == 'GASTO ORIGEN') {
                    $valuesOrder['gastos_origen'] = floatval($value['valor_provisionado']);
                } elseif ($value['concepto'] == 'FLETE') {
                    $valuesOrder['flete'] = floatval($value['valor_provisionado']);
                }
            }
        }
        
        if ($valuesOrder['statusInvoices']) {
            $valuesOrder['fob'] = (($paramsIncoterm[$valuesOrder['incoterm']] * $valuesOrder['gastos_origen']) + $valuesOrder['totalInvoices']);
            
            if ($order['incoterm'] == 'CFR') {
                $valuesOrder['isd'] = (($valuesOrder['totalInvoices'] + $valuesOrder['flete']) * $this->isdPer);
            } else {
                $valuesOrder['isd'] = ($valuesOrder['totalInvoices'] * $this->isdPer);
            }
            
            $valuesOrder['seguro'] = ((($valuesOrder['fob'] + $valuesOrder['flete']) * 2.2) * $this->securePercent);
        }
        
        if (($order['incoterm'] == 'CFR') || ($order['incoterm'] == 'FOB')) {
            unset($valuesOrder['gastos_origen']);
        }
        return $valuesOrder;
    }

    /**
     * Obtiene el numero minimo de parametros que debe tener una oren de compra
     * 
     * @param
     *            $nroOrder
     *            
     * @return array
     */
    private function getMinimalParams($order, $initExpenses)
    {
        $minimal = [
            'statusOrder' => [
                'have_gasto_origen' => true,
                'fecha_arribo' => false,
                'dias_libres' => false
            ],
            'initExpenses' => $initExpenses
        ];
        
        $minimal['statusOrder']['fecha_arribo'] = ($order['fecha_arribo']) ? $order['fecha_arribo'] : false;
        
        $minimal['statusOrder']['dias_libres'] = ($order['dias_libres'] > 0) ? $order['dias_libres'] : false;
        
        if (($order['incoterm'] == 'FOB') || $order['incoterm'] == 'CFR') {
            $minimal['statusOrder']['have_gasto_origen'] = false;
        }
        return $minimal;
    }

    /**
     * Calcula la diferencia entre los gastos iniciales
     *
     * @param $rateExpenses =>
     *            Gastos iniciales parametrisados
     * @param $usesExpenses =>
     *            Gastos iniciales registrados
     * @return array @unusedExpenses => gastos inciales libres
     */
    private function calcExpensesDiff($rateExpenses, $usedExpenses)
    {
        if ($usedExpenses == false) {
            return $rateExpenses;
        }
        $unusedExpenses = $rateExpenses;
        
        foreach ($rateExpenses as $key => $value) {
            foreach ($usedExpenses as $index => $val) {
                if ($value['concepto'] == $val['concepto']) {
                    unset($unusedExpenses[$key]);
                }
                ;
            }
        }
        return $unusedExpenses;
    }

    /**
     * Se validan las columnas que debe tener la consulta para que no falle
     * 
     * @return [array] | [bolean]
     */
    private function validData($data)
    {
        $columnsLen = array(
            'nro_pedido' => 6,
            'concepto' => 1,
            'valor_provisionado' => 1,
            'id_user' => 1,
            'fecha' => 10
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