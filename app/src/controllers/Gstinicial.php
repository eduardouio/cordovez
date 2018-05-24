<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'lib/checkerOrder.php';

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
    private $labelCost = 0.13;
    private $isdPer = 0.05;
    private $modelBase;
    private $modelOrder;
    private $ModelOrderInvoiceDetail;
    private $modelSupplier;
    private $modelOrderInvoice;
    private $modelExpenses;
    private $myModel;
    private $modelIncoterms;
    private $modelProducts;
    private $modelUser;
    private $modelLog;
    private $modelPaidDetail;
    private $modelPaid;
    private $modelParcial;

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
        $this->load->model('modellog');
        $this->load->model('Modelorderinvoice');
        $this->load->model('Modelorderinvoicedetail');
        $this->load->model('Modelpaid');
        $this->load->model('Modelpaiddetail');
        $this->load->model('Modelparcial');
        $this->modelParcial = new Modelparcial();
        $this->modelOrderInvoice= new Modelorderinvoice();
        $this->modelPaid = new Modelpaid();
        $this->modelOrder = new Modelorder();
        $this->modelSupplier = new Modelsupplier();
        $this->modelBase = new ModelBase();
        $this->modelExpenses = new Modelexpenses();
        $this->myModel = new Mymodel();
        $this->modelIncoterms = new Modelincoterms();
        $this->modelProducts = new Modelproduct();
        $this->modelUser = new Modeluser();
        $this->modelLog = new Modellog();
        $this->ModelOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelPaidDetail = new Modelpaiddetail();
    }

    
    /**
     * Redirecciona a la lista de los pedidos
     */
    public function index()
    {
        $this->modelLog->warningLog(
            'Redireccionamiento desde gasto inicial'
            );
        
        return ($this->redirectPage('ordersList'));
    }

    
    /**
     * Muestra la informacion basica de un gasto inicial
     *
     * @param (int) $idInitExpense
     * @return array
     */
    public function presentar($idInitExpense)
    {
        if (! isset($idInitExpense)) {
            $this->redirectPage('ordersList');
            return false;
        }
        
        $initExpense = $this->modelExpenses->getExpense($idInitExpense);
        
        if ($initExpense == false) {
            $this->redirectPage('ordersList');
            return false;
        }
        
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
     * Presenta el formulario con los datos del gasto inicial
     *
     * @param int $idInitExpense
     * @return void | string
     */
    public function editar(int $idInitExpense)
    {
        $initExpense = $this->modelExpenses->getExpense($idInitExpense);
        
        if ($initExpense == false) {
            return $this->index();
        }
        
        $order = $this->modelOrder->get($initExpense['nro_pedido']);
        
        return ($this->responseHttp([
            'order' => $order,
            'initExpense' => $initExpense,
            'supplier' => $this->modelSupplier->get($initExpense['identificacion_proveedor']),
            'suppliers' => $this->modelSupplier->getAll(),
            'createBy' => $this->modelUser->get($initExpense['id_user']),
            'titleContent' => 'Descripción De Gasto Incial Pedido:' . $order['nro_pedido'],
            'edit' => true
        ]));
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
            return $this->index();
        }
        
        $initExpense = $this->input->post();
        $initExpense['id_user'] = $this->session->userdata('id_user');
        $initExpense['fecha'] = str_replace('/', '-', $initExpense['fecha']);
        $initExpense['fecha'] = date(
                                'Y-m-d', 
                                strtotime($initExpense['fecha'])
            );
        
        if(isset($initExpense['fecha_fin'])){
            $initExpense['fecha_fin'] = str_replace(
                                        '/', 
                                        '-', 
                                        $initExpense['fecha_fin']
                );
            
            $initExpense['fecha_fin'] = date(
                'Y-m-d', strtotime($initExpense['fecha_fin'])
                );
        }else{
            $initExpense['fecha_fin'] = NULL;
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
                $this->redirectPage('validargi', $initExpense['nro_pedido']);
                return true;
            } else {
                $initExpense['last_update'] = date('Y-m-d H:i:s');
                
                $this->db->where(
                    'id_gastos_nacionalizacion', 
                    $initExpense['id_gastos_nacionalizacion']
                    );
                
                $this->db->update($this->controller, $initExpense);
                $this->redirectPage('validargi', $initExpense['nro_pedido']);
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
     * Elimina un Gasto inicial de la tabla
     *
     * @param $idInitiExpense =>
     *            identificador del registro a eliminar
     * @return void
     */
    public function eliminar($idInitExpense)
    {
        $initialExpense = $this->modelExpenses->getExpense($idInitExpense);
        
        if ($initialExpense == false) {
            $this->modelLog->warningLog(
                'Intendo de Eliminar un gasto inicial directamente', 
                $this->db->last_query()
                );
            return $this->index();
        }
        
        if ($this->modelExpenses->delete($idInitExpense)) {
            return ($this->redirectPage(
                'validargi', 
                $initialExpense['nro_pedido'])
                );
        }
        $this->modelLog->errorLog(
            'Error al eliminar un gasto Inicial, ya se encuentra justificado', 
            $this->db->last_query()
            );
        return ($this->redirectPage('validargi', $initialExpense['nro_pedido']));
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
        
        if ($order == false) {
            $this->redirectPage('ordersList');
            return true;
        }
        
        $rate_expenses = $this->modelExpenses->getAllRates($order['regimen']);
        $order_invoices = $this->modelOrder->getInvoices($order['nro_pedido']);
        $init_expenses = $this->modelExpenses->getInitialExpenses(
                                                            $order['nro_pedido']
            );
        
        $paids_init_expenses = $this->getPaidsFromOrder($init_expenses);
        $unused_expenses = $this->calcExpensesDiff(
            $rate_expenses,
            $init_expenses
            );
        
        $checked_order = new checkerOrder(
                                            $order,
                                            $order_invoices,
                                            $paids_init_expenses,
                                            $rate_expenses,
                                            $unused_expenses
            );
                
        return ($this->responseHttp([
            'validateExpenses' => True,
            'titleContent' => 'Generar Gastos Iniciales Pedido: [' . 
                                $nroOrder . '] ' . 
                                ' <small>Validar Información</small>',
            'dates_order' => $checked_order->checkOrder(),
            'order' => $order,
            'have_euros' => $this->modelOrderInvoice->haveEuros($nroOrder),
            'invoices_order' => $checked_order->checkOrderInvoices(),
            'initial_tributes' => $checked_order->getInitialTributes(),
            'init_expeses' => $checked_order->checkInitExpenses(),
            'unused_expenses' => $checked_order->getInitialTributes(),
            'warenhouse_days' => $this->getWarenHouseDaysInitial($order),
            'have_parcial' => $this->checkParcials($order),
            'user' => $this->modeluser->get($order['id_user']),
        ]));
    }

   
    /**
     * Inicia el asistente para establecer las provisiones de bodega inicial
     * y las provisiones de demoraje
     *
     * @param string $nroOrder
     */
    public function validarbodegainicial(string $nroOrder = '')
    {
        if ($_POST) {
            
            $this->modelLog->warningLog(
                'acceso a la funcion validarbodegainicial es por POST'
                );
            $_POST['fecha_arribo'] = str_replace(
                '/', 
                '-', 
                $_POST['fecha_arribo']
                );
            
            $_POST['fecha_salida_bodega_puerto'] = str_replace(
                '/', 
                '-', 
                $_POST['fecha_salida_bodega_puerto']
                );
            
            $_POST['fecha_arribo'] = date(
                'Y-m-d', 
                strtotime($_POST['fecha_arribo'])
                );
            
            $_POST['fecha_salida_bodega_puerto'] = date(
                'Y-m-d', 
                strtotime($_POST['fecha_salida_bodega_puerto'])
                );
            
            if ($this->modelOrder->update([
                'nro_pedido' => $_POST['nro_pedido'],
                'fecha_arribo' => $_POST['fecha_arribo'],
                'fecha_salida_bodega_puerto' => $_POST['fecha_salida_bodega_puerto'],
                'dias_libres' => $_POST['dias_libres']
            ])) {
                $this->modelExpenses->create([
                    'nro_pedido' => $_POST['nro_pedido'],
                    'id_parcial' => 0,
                    'fecha' => date('Y-m-d'),
                    'identificacion_proveedor' => 0,
                    'concepto' => 'ALMACENAJE INICIAL',
                    'tipo' => 'INICIAL',
                    'valor_provisionado' => $_POST['bodegaje_inicial'],
                    'id_user' => $this->session->userdata('id_user'),
                ]);
                
                if (isset($_POST['demoraje'])) {
                    $this->modelExpenses->create([
                        'nro_pedido' => $_POST['nro_pedido'],
                        'id_parcial' => 0,
                        'identificacion_proveedor' => 0,
                        'concepto' => 'DEMORAJE',
                        'tipo' => 'INICIAL',
                        'valor_provisionado' => $_POST['demoraje'],
                        'id_user' => $this->session->userdata('id_user'),
                    ]);
                }
            }
            
            return ($this->redirectPage('validargi', $_POST['nro_pedido']));
        }
        
        $this->modelLog->warningLog(
            'acceso a la funcion validarbodegainicial es por GET'
            );
        
        $order = $this->modelOrder->get($nroOrder);
        if ($order == false) {
            return ($this->index());
        }
        $expenses = $this->modelExpenses->get($nroOrder);
        $bodegaInicial = null;
        $demoraje = null;
        if ($expenses) {
            foreach ($expenses as $item => $expense) {
                if ($expense['concepto'] == 'ALMACENAJE INICIAL') {
                    $bodegaInicial = $expense['valor_provisionado'];
                } elseif ($expense['concepto'] == 'DEMORAJE') {
                    $demoraje = $expense['valor_provisionado'];
                }
            }
        }
        
        
        
        return ($this->responseHttp([
            'titleContent' => 'Asistente cálculo de Bodegaje Inicial y Demoraje Pedido [' . $order['nro_pedido'] . ']',
            'validateInitialWarenhouse' => true,
            'order' => $order,
            'invoicesOrder' => $this->modelOrder->getInvoices($nroOrder),
            'bodegajeIncial' => $bodegaInicial,
            'demoraje' => $demoraje
        ]));
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
            return ($this->redirectPage('ordersList'));
        }
        
        $init_expenses_post = $this->input->post();        
        $nro_order = $init_expenses_post['nro_pedido'];
        unset($init_expenses_post['nro_pedido']);
        $expense_added = [];
        
        foreach ($init_expenses_post as $idx => $input){
            $patron = '/_VALUE/';
            if(! preg_match($patron, $idx)){
                array_push($expense_added, $idx);
            }
            
        }
        
        foreach ($expense_added as $idx => $input){
            $name = $input . '_VALUE';
            $expense = [
                'nro_pedido' => $nro_order,
                'id_parcial' => 0,
                'identificacion_proveedor' => '0',
                'tipo' => 'INICIAL',
                'concepto' => str_replace('_', ' ', $input),
                'valor_provisionado' => $init_expenses_post[$name],
                'fecha' => date('Y-m-d'),
                'id_user' => $this->session->userdata('id_user'),
            ];
            
            if ($expense['concepto'] == 'ISD'){
                $expense['bg_closed'] = 1;
            }
            
            
            $this->modelExpenses->create($expense);
        }
                
       return($this->redirectPage('validargi', $nro_order));
    }
    
    
    /**
     * Comprueba si un pedido tiene algun parcial
     * 
     * @param array $order
     * @return bool
     */
    private function checkParcials(array $order):bool{
        if($order['regimen'] == 10){
            return False;
        }
        
        $parcial = $this->modelParcial->getByOrder($order['nro_pedido']);
        
        return boolval($parcial);
    }
    
    /**
     * Obtiene la lista de facturas con sus detalles de los pagos 
     * Realizados en el pedido
     * 
     * @param array $init_expenses
     * @return array | Bool
     */
    private function getPaidsFromOrder($init_expenses)
    {
        
        if($init_expenses == False){
            $this->modelLog->warningLog(
                'El pedido no tiene gastos iniciales'
                );
            return False;
        }
        
        $init_expenses_with_paid = [];
        
        foreach ($init_expenses as $item => $expense){
            
          $paids_details = $this->modelPaidDetail->
                                                getPaidsDetailsFromInitExpense(
                                          $expense['id_gastos_nacionalizacion']
                );
          
          if ($paids_details == False){
              $expense['paids'] = False;
          }else{
              $expense['paids'] = $paids_details;
          }
          array_push($init_expenses_with_paid, $expense);
        }
        
        return $init_expenses_with_paid;
         
    }
    
    
    /**
     * Calcula la diferencia entre los gastos iniciales
     *
     * @param $rateExpenses =>
     *            Gastos iniciales parametrisados
     * @param $usesExpenses =>
     *            Gastos iniciales registrados
     * @return array unusedExpenses => gastos inciales libres
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
