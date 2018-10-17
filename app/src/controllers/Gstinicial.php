<?php
defined('BASEPATH') or exit('No direct script access allowed');

$libraries_url = realpath(dirname(__FILE__));
$libraries_url = str_replace('controllers', 'libraries/', $libraries_url);

require_once ( $libraries_url . 'checkerOrder.php' );


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
        if(! isset($this->session->userdata['id_user'])){
            exit(0);
        }
        
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
     * Presenta el formulario con los datos del gasto inicial
     *
     * @param int $idInitExpense
     * @return void | string
     */
    public function editar(int $idInitExpense)
    {
        $initExpense = $this->modelExpenses->getExpense($idInitExpense);
        $have_origin_expense = False;
        $type_change = 1;
        
        
        if ($initExpense == false) {
            return $this->index();
        }
        
        $order = $this->modelOrder->get($initExpense['nro_pedido']);
        
        
        if ($initExpense['concepto'] == 'GASTO ORIGEN'){
            $have_origin_expense = True;
        }
        
        $order_invoices = $this->modelOrderInvoice->getbyOrder(
            $initExpense['nro_pedido']
            );
        
        if($order_invoices){
            foreach ( $order_invoices as $idx => $invoice ){
                $type_change = $invoice['tipo_cambio'];
                break;
            }
        }
        
        $order = $this->modelOrder->get($initExpense['nro_pedido']);
        
        return ($this->responseHttp([
            'order' => $order,
            'initExpense' => $initExpense,
            'origin_expense' => $have_origin_expense,
            'type_change' => $type_change,
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
        
        if ($initExpense['concepto'] == 'GASTO ORIGEN'){
            
            $order = $this->modelOrder->get($initExpense['nro_pedido']);
            $order['tipo_cambio_go'] = $initExpense['tipo_cambio_go'];
            $order['gasto_origen'] = $initExpense['valor_provisionado'];
            #Evitamos que se actualize los gastos en origen del pedido
            #$this->modelOrder->update($order);
            $initExpense['valor_provisionado'] = (
                $initExpense['valor_provisionado']
                * $initExpense['tipo_cambio_go']
                );
            unset($initExpense['tipo_cambio_go']);
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
                
                if($this->modelExpenses->update($initExpense)){
                    $old_init_expense = $this->modelExpenses->getExpense(
                        $initExpense['id_gastos_nacionalizacion']
                        );
                    
                    if(floatval($initExpense['valor_provisionado']) != floatval($old_init_expense['valor_provisionado'])){
                        $initExpense['bg_closed'] = 0;
                        $this->modelExpenses->update($initExpense);
                        $this->modelLog->susessLog(
                            'La provision ha cambiado de valor'
                            );
                        
                        return($this->redirectPage('validargi', $initExpense['nro_pedido']));
                    }else{
                        $this->modelLog->warningLog(
                            'La provision mantiene el mismo valor no es modificada'
                            );
                        return($this->redirectPage('validargi', $initExpense['nro_pedido']));
                    }
                    
                }
                                
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
        
        $this->validateOriginExpenses(
            $order,
            $order_invoices,
            $paids_init_expenses 
            );
              
        return ($this->responseHttp([
            'validateExpenses' => True,
            'titleContent' => 'Generar Gastos Iniciales Pedido: [' . 
                                $nroOrder . '] ' . 
                                ' <small>Validar Información</small> ' .
                                '&nbsp;&nbsp;&nbsp;&nbsp;<small> Fecha Ingreso Bodegaje: ' .
                                $order['fecha_ingreso_almacenera'] . 
                                '</small>',
            'dates_order' => $checked_order->checkOrder(),
            'order' => $order,
            'title' => 'Gastos Iniciales [' . $nroOrder . ']',
            'have_euros' => $this->modelOrderInvoice->haveEuros($nroOrder),
            'invoices_order' => $checked_order->checkOrderInvoices(),
            'initial_tributes' => $checked_order->getInitialTributes(),
            'init_expenses' => $checked_order->checkInitExpenses(),
            'unused_expenses' => $checked_order->getInitialTributes(),
            'have_parcial' => $this->modelParcial->orderHaveCloseParcial($order['nro_pedido']),
            'exist_parcial' => $this->checkParcials($order),
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
        $check_parcial = $this->modelParcial->orderHaveCloseParcial($init_expenses_post['nro_pedido']);
        if($check_parcial){
            return($this->redirectPage('validargi', $init_expenses_post['nro_pedido']));
        }
        
        #se verifica si el formulario tiene la  fecha de llegada
        if(isset($init_expenses_post['fecha_llegada_cliente']) && $init_expenses_post['fecha_llegada_cliente'] != ''){          
            $order = [
                'nro_pedido' => $init_expenses_post['nro_pedido'],
                'fecha_llegada_cliente' => date(
                    'Y-m-d',
                    strtotime(
                        str_replace('/', '-', $init_expenses_post['fecha_llegada_cliente'])
                        )
                    )
            ];
            
            if($this->modelOrder->update($order)){
                $this->modelLog->susessLog(
                    'La fecha de llegada de la mercaderia se ha establecido'
                    );
            };
        }
        
        $nro_order = $init_expenses_post['nro_pedido'];
        $order = $this->modelOrder->get($nro_order);
        
        
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
            }elseif($expense['concepto'] == 'FLETE' && $order['incoterm'] == 'CFR'){
                $expense['bg_closed'] = 1;
            }
            
            $this->setISD($nro_order);
            $this->modelExpenses->create($expense);
        }
                
       return($this->redirectPage('validargi', $nro_order));
    }
    
    
    /**
     * recupera el ultimo parcial del pedido y comprueba que este cerrado,
     * tambien verifica que no tenga saldo
     * 
     * @param array $order
     * @return bool
     */
    private function checkParcials(array $order):bool{
        
        if($order['regimen'] == 10){
            return False;
        }
        
        $parcials = $this->modelParcial->getByOrder($order['nro_pedido']);
        
        if ($parcials){
                    return True;
        }
        
        return False;
    }
    
    
    /**
     * Obtiene la lista de facturas con sus detalles de los pagos 
     * Realizados en el pedido
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
     * Filtra los gastos iniciales que no se estan uasando
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
     *  Verifica los gastos inciales y los agrega a la lista de provisionados
     *  El gasto en origen solo tienen facturas en incoterm FCA y Exwork
     */
    private function validateOriginExpenses ( 
                                                array $order,
                                                $order_invoices,
                                                $paids_init_expenses
    ):bool {
        
       # solo aplica en EXW y FCA
        if(
            $order['incoterm'] == 'FOB' 
            || $order['incoterm'] == 'CFR' 
            || $order['bg_isclosed'] == '1'
            ){
           return False;
       }
        
        if($paids_init_expenses){
            foreach ($paids_init_expenses as $ixd => $go){
                if ($go['concepto'] == 'GASTO ORIGEN') {
                    $this->modelLog->warningLog(
                        'El gasto de Origen ya se encuentra en la lista'
                        );
                    return False;
                }
            }                
        }
        
        $type_change = 1;
        $origin_expenses = $order['gasto_origen'];
        
        if ($order_invoices){
            foreach ( $order_invoices  as $idx => $invoice){
                $type_change = $invoice['tipo_cambio'];
                break;
            }            
        }
        
        $go = [
        'concepto' => 'GASTO ORIGEN',
        'nro_pedido' => $order['nro_pedido'],
        'tipo' => 'INICIAL',
        'id_parcial' => '0',
        'identificacion_proveedor' => 0,    
        'fecha' => date('Y-m-d'),
        'id_user' => $this->session->userdata('id_user'),
        'bg_closed' => '0',
        'valor_provisionado' => round(($origin_expenses * $type_change), 2),
        ];
        
        if($this->modelExpenses->create($go)){
            $this->redirectPage('validargi', $order['nro_pedido']);
            return True;
        }
        $this->modelLog->errorLog('EL gasto en origen no fue creado');
        return False;
    }
    
    
    /**
     *  Crea la provision de ISD en los gastos iniciales
     */
    private function setISD(string $nro_order){
        $this->modelLog->warningLog(
            'Se llama a la creacion del gasto inicial ISD'
            );
        
        $order = $this->modelOrder->get($nro_order);
        $order_invoices = $this->modelOrderInvoice->getbyOrder($nro_order);
        
        $valor_base = 0.0;
        
        foreach ($order_invoices as $k => $invoice){
            $valor_base += ($invoice['valor'] * $invoice['tipo_cambio']);
        }
        
        $gasto_origen = 0.0;
        
        if($order['incoterm'] == 'CFR' || $order['incoterm'] == 'FOB' ){
            $gasto_origen = ($order['gasto_origen'] * $invoice['tipo_cambio']);
        }
        
        #aqui se calcula el ISD
        $valor_isd = ($valor_base + $gasto_origen) * 0.05;
        
        $isd_expenses = $this->modelExpenses->getByName(
            $order['nro_pedido'],
            'ISD'
            );
        
        
        if($isd_expenses){
            $isd_expenses['valor_provisionado'] = $valor_isd;
            if($this->modelExpenses->update($isd_expenses)){
                $this->modelLog->warningLog('Se actualiza el ISD ' . $order['nro_pedido']);
            }else{
                $this->modelLog->errorLog(
                    'No se puede actualizar el ISD',
                    $this->db->last_query()
                    );
            }
        }else{
            if($this->modelExpenses->create([
                'identificacion_proveedor' => 0,
                'nro_pedido' => $order['nro_pedido'],
                'valor_provisionado' => $valor_isd,
                'id_parcial' => '0',
                'concepto' => 'ISD',
                'tipo' => 'INICIAL',
                'fecha' => date('Y-m-d'),
                'id_user' => $this->session->userdata('id_user')
            ])){
                $this->modelLog->warningLog('Se registra el ISD' . $order['nro_pedido']);
            }else{
                $this->modelLog->errorLog(
                    'No se puede registrar el ISD',
                    $this->db->last_query()
                    );
            }
        }
        
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
    
    
    /**
     * Marca y desmarca un gasto inicial como contabilizado
     */
    public function contabilizar(int $id_expense){
        $this->load->library('Rest');
        $rest = new Rest();
        
        $expense = $this->modelExpenses->getExpense($id_expense);
        $bg_iscontabilizado = 0;
        
        if($expense == False){
            $this->modelLog->errorLog(
                'El gasto que intenta contabilizar no existe'
                );
            return false; 
        }
        
        if($expense['bg_iscontabilizado'] == 0){
            $bg_iscontabilizado = 1;
        }
        
        
        if($this->modelExpenses->update([
            'id_gastos_nacionalizacion' => $id_expense,
            'bg_iscontabilizado' => $bg_iscontabilizado,
            'bg_iscontabilizado_por' => $this->session->userdata('id_user')
        ])){
            return $rest->_responseHttp(['status' => 'success'],200);
        }
        
        return $rest->_responseHttp(['status' => 'deleted'],202);
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
