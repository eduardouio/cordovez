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
        $this->load->model('Modelpaiddetail');
        $this->modelOrderInvoice= new Modelorderinvoice();
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
     * Pesenta la informacion completa del rgistro de gasto inicial
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
        ;
        
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
     * Presenta el formulario con los datos del gasto inicial
     *
     * @param int $idInitExpense
     * @return void | string
     */
    public function editar(int $idInitExpense)
    {
        $initExpense = $this->modelExpenses->getExpense($idInitExpense);
        
        if ($initExpense == false) {
            $this->modelLog->redirectLog(
                'Se intenta acceder directamente a editar desde url sin id', 
                current_url()
                );
            return ($this->index());
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
            $this->redirectPage('ordersList');
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
        
       
        
        if (isset($initExpense['fecha_fin'])) {
            $initExpense['fecha_fin'] = date(
                'Y-m-d', strtotime($initExpense['fecha_fin'])
                );
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
            return ($this->redirectPage('ordersList'));
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
        $rateExpenses = $this->modelExpenses->getAllRates($order['regimen']);
        $invoicesOrder = $this->modelOrder->getInvoices($nroOrder);
        $initExpenses = $this->modelExpenses->getInitialExpenses($nroOrder);
        $minimal = $this->getMinimalParams($order, $initExpenses);
        $minimal['valuesOrder'] = $this->calcValuesOrderItems(
                                                        $order, 
                                                        $invoicesOrder, 
                                                        $initExpenses
            );
        $have_initial_warenhouse = False;
        $temp_Expenses = [];
        
        foreach( $initExpenses as $item => $expense){
            if($expense['concepto'] == 'ALMACENAJE INICIAL'){
                $have_initial_warenhouse = True;
            }
            
            $expense['paids'] = $this->modelPaidDetail->
                                         getPaidsDetailsFromInitExpense(
                                    $expense['id_gastos_nacionalizacion']
                                    );
            array_push($temp_Expenses, $expense);
            
        }
        
        return ($this->responseHttp([
            'validateExpenses' => true,
            'titleContent' => 'Generar Gastos Iniciales Pedido: [' . 
                                $nroOrder . '] ' . 
                                ' <small>Validar Información</small>',
            'rateExpenses' => $rateExpenses,
            'unusedExpenses' => $this->calcExpensesDiff(
                                                        $rateExpenses, 
                                                        $initExpenses
                ),
            'warenHouseDays' => $this->getWarenHouseDaysInitial($order),
            'invoicesOrder' => $invoicesOrder,
            'initExpenses' => $temp_Expenses,
            'have_initial_warenhouse' => $have_initial_warenhouse,
            'order' => $order,
            'minimal' => $minimal,
            'user' => $this->modeluser->get($order['id_user']),
            'isOk' => searchOrderCeroValues($minimal),
            'haveEuros' => $this->modelOrderInvoice->haveEuros($nroOrder),
        ]));
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
        $incoterms = $this->modelExpenses->getIncotermsParams($order);
        if ($incoterms == false) {
            $this->modelLog->warningLog(
                $this->controller . ' No se encuentra incoterms ' . 
                current_url()
                );
            $this->redirectPage('presentOrder', $nroOrder);
        }
        
        $id_user = $this->session->userdata('id_user');
        
        foreach ($incoterms as $key => $value) {
            $initExpense = [
                'nro_pedido' => $nroOrder,
                'id_parcial' => 0,
                'identificacion_proveedor' => 0,
                'concepto' => $value['tipo'],
                'valor_provisionado' => $value['tarifa'],
                'comentarios' => 'CREADO AUTOMATICAMENTE',
                'id_user' => $id_user,
                'fecha' => date("Y-m-d")
            ];
            $this->db->insert($this->controller, $initExpense);
        }
        return ($this->redirectPage('presentOrder', $nroOrder));
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
        $initExpenses = $this->modelExpenses->get($nroOrder);
        
        foreach ($initExpenses as $key => $expense) {
            
            if (($expense['concepto'] == 'GASTO ORIGEN') || 
                ($expense['concepto'] == 'FLETE')) 
            {
                $this->db->where(
                    'id_gastos_nacionalizacion', 
                    $expense['id_gastos_nacionalizacion']
                    );
                $this->db->delete($this->controller);
            }
        }
        $this->putIncoterms($nroOrder);
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
        $invoicesOrder = $this->modelOrder->getInvoices($initExpensesInput['nro_pedido']);
        $initExpenses = $this->modelExpenses->get($initExpensesInput['nro_pedido']);
        
        $valuesOrder = $this->calcValuesOrderItems($order, $invoicesOrder, $initExpenses);
        
        foreach ($initExpensesRates as $key => $value) {
            $insertExpense = [
                'nro_pedido' => $initExpensesInput['nro_pedido'],
                'id_parcial' => 0,
                'identificacion_proveedor' => 0,
                'concepto' => $value['concepto'],
                'valor_provisionado' => $value['valor'],
                'comentarios' => 'CREADO AUTOMATICAMENTE',
                'fecha' => date('Y-m-d'),
                'id_user' => $this->session->userdata('id_user')
            ];
            if ($value['concepto'] == 'ISD') {
                $insertExpense['valor_provisionado'] = $valuesOrder['isd'];
            } elseif ($value['concepto'] == 'POLIZA SEGURO') {
                $insertExpense['valor_provisionado'] = $valuesOrder['seguro'];
            } elseif ($value['concepto'] == 'ETIQUETAS FISCALES') {
                $insertExpense['valor_provisionado'] = $valuesOrder['etiquetas_fiscales'];
            } elseif ($value['concepto'] == 'TASA DE SERVICIO ADUANERO') {
                $insertExpense['valor_provisionado'] = $valuesOrder['tasa_de_servicio_aduanero'];
            }
            
            if ($this->db->insert($this->controller, $insertExpense)) {
                
                $this->modelLog->susessLog('Gasto Inicial Insertado, ' . current_url());
            } else {
                $this->modelLog->errorLog('No se puede Aplicar Gasto Inicial', $this->db->last_query());
            }
        }
        $this->redirectPage('validargi', $initExpensesInput['nro_pedido']);
    }

    /**
     * Calcula los Valores FOB; FLETE; CIF ; ISD ; SEGURO de un pedido, y ademas
     * comprueba que el detalle de las facturas sea igual al que se encuentra
     * registrado en el pedido
     *
     * @param array $order
     * @param array $invoicesOrder
     * @param array $initExpenses
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
            'isd' => 0.0,
            'tasa_de_servicio_aduanero' => 0.0
        ];
        
        if ($invoicesOrder) {
            foreach ($invoicesOrder as $key => $invoice) {
                $valuesOrder['totalInvoices'] += (
                        floatval($invoice['valor'] * 
                        floatval($invoice['tipo_cambio']))
                    );
                
                $valuesOrder['invoicesSum'] += (
                    floatval($invoice['detailInvoice']['sums']['valueItems']) * 
                    floatval($invoice['tipo_cambio'])
                    );
            }
            if ($valuesOrder['totalInvoices'] == $valuesOrder['invoicesSum']) {
                $valuesOrder['statusInvoices'] = true;
            }
        }
        
        if (gettype($initExpenses) == 'array') {
            foreach ($initExpenses as $key => $value) {
                if ($value['concepto'] == 'GASTO ORIGEN') {
                    $valuesOrder['gastos_origen'] = floatval(
                        $value['valor_provisionado']
                        );
                    
                } elseif ($value['concepto'] == 'FLETE') {
                    $valuesOrder['flete'] = floatval($value['valor_provisionado']);
                }
            }
        }
        
        if ($valuesOrder['statusInvoices']) {
            $valuesOrder['fob'] = (
                   (
                    $paramsIncoterm[$valuesOrder['incoterm']] * 
                    $valuesOrder['gastos_origen']
                   ) 
                    + $valuesOrder['totalInvoices']
                );
            
            
            if ($order['incoterm'] == 'CFR') {
                $valuesOrder['isd'] = (
                    ($valuesOrder['totalInvoices'] + $valuesOrder['flete']) * 
                    $this->isdPer
                    );
            } else {
                $valuesOrder['isd'] = (
                    $valuesOrder['totalInvoices'] * $this->isdPer
                    );
            }
            
            $base_seguro = (
                (
                    ($valuesOrder['fob'] + $valuesOrder['flete']) * 2.2) * 
                    $this->securePercent
                );
            
            $valuesOrder['seguro'] = ($base_seguro + 
                                    ($base_seguro * 0.035) + 
                                    ($base_seguro * 0.005) +
                                    0.45);
            
        }
        
        
        
        
        if (($order['incoterm'] == 'CFR') || ($order['incoterm'] == 'FOB')) {
            unset($valuesOrder['gastos_origen']);
        }
        
        $valLabels = 0.0;
        $initialStockProducts = $this->ModelOrderInvoiceDetail->
                            getActiveStokProductsByOrder($order['nro_pedido']);
        if ($initialStockProducts != false) {
            foreach ($initialStockProducts as $item => $product) {
                
                $valLabels += (
                    ($this->labelCost) * 
                    ($product['nro_cajas'] * 
                    $product['cantidad_x_caja'])
                    );
                
                $tasaServicio = (
                    (
                        (intval($product['capacidad_ml']) / 2000) * 0.10) * 
                        ($product['nro_cajas'] * $product['cantidad_x_caja'])
                    );
                if ($tasaServicio < 700) {
                    $valuesOrder['tasa_de_servicio_aduanero'] += $tasaServicio;
                } else {
                    $valuesOrder['tasa_de_servicio_aduanero'] += 700;
                }
            }
        }
        
        $valuesOrder['etiquetas_fiscales'] = $valLabels;
        $this->addDefaultExpenses($valuesOrder, $order);
        
        return $valuesOrder;
    }
    
    
    
    /**
     * Agrega automanticamete al pedido los gastos iniciales autocalculados,
     * en caso de que ya esten registrados no hace nada 
     * 
     * @param array $valuesOrder
     * @param array $order
     * @return bool
     */
    private function addDefaultExpenses(array  $valuesOrder, array $order): bool
    {
        $data = [
                    0 => [
                            'nro_pedido' => $order['nro_pedido'],
                            'identificacion_proveedor' => 0,
                            'concepto' => 'ISD',
                            'valor_provisionado' => $valuesOrder['isd'],
                            'comentarios' => 'REGISTRO AGREGADO POR EL ASISTENTE',
                            'fecha' => date('Y-m-d H:m:s'),
                            'id_user' => $this->session->userdata('id_user'),
                        ],
                    1 => [
                            'nro_pedido' => $order['nro_pedido'],
                            'identificacion_proveedor' => 0,
                            'concepto' => 'ETIQUETAS FISCALES',
                            'valor_provisionado' => $valuesOrder['etiquetas_fiscales'],
                            'comentarios' => 'REGISTRO AGREGADO POR EL ASISTENTE',
                            'fecha' => date('Y-m-d H:m:s'),
                            'id_user' => $this->session->userdata('id_user'),
                          ]
                ];
        
        
        $init_expenses = $this->modelExpenses->getInitialExpenses(
            $order['nro_pedido']
            );
        
        foreach ( $init_expenses as $item => $expense ){
            if($expense['concepto'] == 'ISD'){
                unset($data[0]);
            }
            
            if($expense['concepto'] == 'ETIQUETAS FISCALES'){
                unset($data[1]);
            }
            
            if(count($data) == 0){
                $this->modelLog->warningLog(
                    'Etiquetas fiscales e ISD ya estan registrados'
                    );
                return False;
            }
        }
                
        foreach ( $data as $item => $expense){
            if ( $this->modelExpenses->create($expense) == False ){
                $this->modelLog->errorLog(
                    'No fue posible agregar de forma automatica los gastos iniciales'
                    );
                return  false;
            }
        }
        
        $this->modelLog->susessLog(
            'los gastos iniciales ISD y Etiquetas fueron agregados correctamente'
            );
     
        return true;   
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
        
        $minimal['statusOrder']['fecha_arribo'] = ($order['fecha_arribo']) ? 
                                                    $order['fecha_arribo'] : 
                                                                      false;
        
        $minimal['statusOrder']['dias_libres'] = ($order['dias_libres'] > 0) ? 
                                                     $order['dias_libres'] : 
                                                                      false;
        
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
