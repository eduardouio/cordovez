<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once 'lib/warenHouseParcial.php';
require_once 'lib/checkerPartial.php';
require_once 'lib/resumeOrder.php';
/**
 * Modulo encargado de Gestionar los gastos de nacionaliacion para
 * regimn 70 (parciales) y 10
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2017, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource Source
 */
class Gstnacionalizacion extends MY_Controller

{
    private $controller = 'gastos_nacionalizacion';
    private $template = 'pages/pageGastosNacionalizacion.html';
    private $modelOrder;
    private $modelExpenses;
    private $modelProduct;
    private $modelOrderInvoice;
    private $modelOrderInvoiceDetail;
    private $modelInfoInvoiceDetail;
    private $modelInfoInvoice;
    private $modelLog;
    private $modelUser;
    private $modelRateExpenses;
    private $modelParcial;
    private $modelSupplier;
    private $modelPaidDetail;
    private $modelOrderInfo;

    
    /**
     * constructor de la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    
    /**
     * Redirecciona a pedidos, sucede por entradas directas
     * por url al metodo del controller
     */
    public function index()
    {
        $this->modelLog->redirectLog(
            'Redireccionamiento por error en el controller Gstinicializacion', 
            current_url()
            );
        return ($this->redirectPage('ordersList'));
    }

    
    /**
     * inicia los modelos para la clase
     */
    private function init()
    {
        if(! isset($this->session->userdata['id_user'])){
            exit(0);
        }
        
        $this->load->model('modelorder');
        $this->load->model('modelexpenses');
        $this->load->model('modelproduct');
        $this->load->model('modelorderinvoice');
        $this->load->model('modelorderinvoicedetail');
        $this->load->model('modelinfoinvoice');
        $this->load->model('modelinfoinvoicedetail');
        $this->load->model('modellog');
        $this->load->model('modeluser');
        $this->load->model('modelrateexpenses');
        $this->load->model('modelparcial');
        $this->load->model('modelsupplier');
        $this->load->model('Modelpaiddetail');
        $this->load->model('ModelOrderInfo');
        $this->modelOrderInfo = new ModelOrderInfo();
        $this->modelPaidDetail = new Modelpaiddetail();
        $this->modelOrder = new Modelorder();
        $this->modelExpenses = new Modelexpenses();
        $this->modelProduct = new Modelproduct();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelInfoInvoiceDetail = new Modelinfoinvoicedetail();
        $this->modelLog = new Modellog();
        $this->modelUser = new Modeluser();
        $this->modelSupplier = new Modelsupplier();
        $this->modelRateExpenses = new Modelrateexpenses();
        $this->modelParcial = new Modelparcial();
    }

    
     /**
     * Elimina y Crea gastos iniciales, sin tomar en cuenta FLETE y GASTOS ORIGEN
     *
     * @param array $_POST
     * @return void | boolean
     */
    public function putExpenses()
    {
        if (! $_POST) {
            return ($this->redirectPage('ordersList'));
        }
        
        $expenses_post = $this->input->post();
        
        $id_parcial = $expenses_post['id_parcial'];
        unset($expenses_post['id_parcial']);
        $expense_added = [];
        
        foreach ($expenses_post as $idx => $input){
            $patron = '/_VALUE/';
            if(! preg_match($patron, $idx)){
                array_push($expense_added, $idx);
            }
            
        }
        
        foreach ($expense_added as $idx => $input){
            $name = $input . '_VALUE';
            print $name;
            $expense = [
                'nro_pedido' => '000-00',
                'id_parcial' => $id_parcial,
                'identificacion_proveedor' => '0',
                'tipo' => 'NACIONALIZACION',
                'concepto' => str_replace('_', ' ', $input),
                'valor_provisionado' => $expenses_post[$name],
                'fecha' => date('Y-m-d='),
                'id_user' => $this->session->userdata('id_user'),
            ];
            
            if ($expense['concepto'] == 'ISD'){
                $expense['bg_closed'] = 1;
            }
            
            $this->modelExpenses->create($expense);
        }
                
       return($this->redirectPage('parcial', $id_parcial));
    }
    
    
    /**
     * Registra los costos de alamcenaje para el parcial de un pedido
     * @param array $_POST arreglo por post
     * @return string plantillas
     */
    public function putWarenhouseExpense()
    {
        if (! $_POST) {
            return ($this->index());
        }
        
        $warenhouse_post = $_POST;
        
        $idParcial = $warenhouse_post['id_parcial'];
        $dateExitWarenhouseParcial = $warenhouse_post['fecha_salida_almacenera'];
        $valor_provisionado = $warenhouse_post['valor_provisionado'];
        
        unset($warenhouse_post['id_parcial']);
        unset($warenhouse_post['fecha_salida_almacenera']);
        unset($warenhouse_post['valor_provisionado']);
        
        $index = count($warenhouse_post['periodo']) -1 ;
        
        $dataParcial = [
            'id_parcial' => $idParcial,
            'fecha_salida_almacenera' => $dateExitWarenhouseParcial,
            'proximo_almacenaje_desde' => (
                $warenhouse_post['periodo'][$index]['fecha_fin']
                ),
        ];
        
        foreach ($warenhouse_post['periodo'] as $item => $warenHouse) {
            $warenHouse['id_parcial'] = $idParcial;
            $warenHouse['valor_provisionado'] = $valor_provisionado;
            $warenHouse['id_user'] = $this->session->userdata('id_user');
            
            if ($this->modelExpenses->create($warenHouse)) {
                
                $this->modelLog->susessLog(
                    'Periodo Almacenera Registrado Correctamete'
                    );
                
            } else {
                $this->modelLog->errorLog(
                    'Error al Registrar periodo bodega',
                    current_url()
                    );
            }
        }       
    }
    
    
    /**
     * redirecciona a la pagina de lista de pedidos
     * son redirecciones por accesos sin ilegales
     *
     * @param int $idParcial
     */
    public function parcial(int $id_parcial)
    {
        $parcial = $this->modelParcial->get($id_parcial);
        
        if ($parcial == false) {
            $this->modelLog->warningLog(
                'No existe el parcial',
                current_url()
                );
            return ($this->index());
        }
        
        $order = $this->modelOrder->get($parcial['nro_pedido']);
        $info_invoices = $this->modelParcial->getInvoices($id_parcial);
        $rate_expenses = $this->modelRateExpenses->getPartialRates();
        $partial_expenses = $this->modelExpenses->getPartialExpenses(
            $id_parcial
            );
        
        $unused_expenses = $this->calcExpensesDiff(
                    $rate_expenses, $partial_expenses
            );
        
        $paids_partial_expenses = $this->getPaidsFromOrder($partial_expenses);
        
        $checkPartial = new checkerPartial(
                                    $order,
                                    $parcial, 
                                    $info_invoices, 
                                    $paids_partial_expenses, 
                                    $unused_expenses
            );      
        
        return ($this->responseHTTP([
            'showExpenses' => True,
            'titleContent' => 'generar gastos nacionalizacion Parcial Pedido: [' . 
                               $parcial['nro_pedido'] . '] Régimen 70',
            'dates_parcial' => $checkPartial->checkPartial(),
            'order' => $order,
            'parcial' => $parcial,
            'have_euros' => $this->modelInfoInvoice->haveEuros($id_parcial),
            'info_invoices' => $checkPartial->checkInfoInvoices(),
            'partial_tributes' => $checkPartial->getPartialTributes(),
            'partial_expenses' => $checkPartial->checkPartialExpenses(),
            'unused_expenses' => $checkPartial->getPartialTributes(),
            'user' => $this->modelUser->get($parcial['id_user']),
        ]));
    }
        
    
    /**
     * Pesenta la informacion completa del rgistro de gasto inicial
     *
     * @param (int) $idInitExpense
     * @return array
     */
    public function presentar(int $idInitExpense)
    {
        $initExpense = $this->modelExpenses->getExpense($idInitExpense);
        
        if ($initExpense == false) {
            $this->modelLog->errorLog(
                'Acceso a gasto nacionalizacion inexistente',
                $this->db->last_query()
                );
            $this->redirectPage('ordersList');
            return false;
        }
        
        $infoInvoice = $this->modelInfoInvoice->get($initExpense['id_parcial']);
        
        $nroOrder = $this->modelParcial->getNroOrderByParcial(
            $initExpense['id_parcial']
            );
        
        $order = $this->modelOrder->get($nroOrder);
        
        $this->responseHttp([
            'infoInvoice' => $infoInvoice,
            'initExpense' => $initExpense,
            'supplier' => $this->modelSupplier->get(
                        $initExpense['identificacion_proveedor']
                    ),
            'user' => $this->modelUser->get($infoInvoice['id_user']),
            'titleContent' => 'Descripción De Gasto Nacionalización Pedido:' . 
                                $order['nro_pedido'] . 
                                ' Factura Informativa [' . 
                                $infoInvoice['nro_factura_informativa'] . ']',
            'show' => true,
            'order' => $order,
        ]);
    }

    /**
     * Edita un gasto de nacionalizacion
     *
     * @param int $idExpense
     *            identificacion degasto nacionalizacion
     * @return string template
     */
    public function editar($idExpense)
    {
        $expense = $this->modelExpenses->getExpense($idExpense);
        if ($expense == false) {
            return ($this->index());
        }
        
        $parcial = $this->modelParcial->get($expense['id_parcial']);
        
        $nroOrder = $this->modelParcial->getNroOrderByParcial(
                                                          $expense['id_parcial']
                                                             );
        $order = $this->modelOrder->get($nroOrder);
        
        return ($this->responseHttp([
            'titleContent' => 'Actulalizar Gasto Nacionalizacion Pedido [' . 
                                $order['nro_pedido'] . '] Parcial [' . 
                                $parcial['id_parcial'] . ']',
            'order' => $order,
            'expense' => $expense,
            'supplier' => $this->modelSupplier->get(
                                            $expense['identificacion_proveedor']
                                                    ),
            'suppliers' => $this->modelSupplier->getByLocation('NACIONAL'),
            'parcial' => $parcial,
            'edit' => true
        ]));
    }

   

    /**
     * Elimina un gasto de nacionalizacion
     *
     * @param int $idNationalizationExpense
     */
    public function eliminar(int $idNationalizationExpense)
    {
        $expense = $this->modelExpenses->getExpense($idNationalizationExpense);
        
        if ($expense) {
            $this->modelExpenses->delete($idNationalizationExpense);
            return ($this->redirectPage('parcial', $expense['id_parcial']));
        }
        
        $this->modelLog->errorLog('Intenta Elimnar gasto no existente', $this->db->last_query());
        return ($this->index());
    }

    
    /**
     * Actualiza un gasto de nacionalizacion
     *
     * @param
     *            $_POST
     * @return string redirect
     */
    public function validar()
    {
        if (! $_POST) {
            return ($this->index());
        }
        
        $expense = $_POST;
        
        $expense['fecha'] = date('Y-m-d', strtotime(str_replace('/', '-', $expense['fecha'])));
        if(isset($expense['fecha_fin'])){
            unset($expense['fecha_fin']);
        };
        
        $expense['id_user'] = $this->session->userdata('id_user');
        $expense['tipo'] = 'NACIONALIZACION';
        $expense['valor_provisionado'] = floatval(
                                                 $expense['valor_provisionado']
                                                );
        $expense['last_update'] = date('Y-m-d H:m:s');        
        
        if ($this->modelExpenses->update($expense)) {
            return ($this->redirectPage('parcial', $expense['id_parcial']));
        }
        
        $this->modelLog->errorLog(
            'Error en la base de datos', 
            $this->db->last_query()
            );
        
        $this->index();
    }
    

    /**
     * Valida la bodega parcial para un parcial
     *
     * @param int $idInfoInvoice
     */
    public function validarbodegaparcial(int $idParcial)
    {
        $parcial = $this->modelParcial->get($idParcial);
        if ($parcial == false) {
            return ($this->index());
        }
        $parcial['expenses'] = $this->modelExpenses->getPartialExpenses(
            $idParcial
            );
        $order = $this->modelOrder->get($parcial['nro_pedido']);
        
        $resumeOrder = new resumeOrder(
            $this->modelOrderInfo->getInfoOrder(
                $parcial['nro_pedido'])
            );
        
        $parcialWarenhouse = new warenHouseParcial($order, $parcial);
        $lastWarenHouseParcial = $parcialWarenhouse->getLastWarenhouseParcial();       
        
        $values_order = $resumeOrder->getValuesOrder();
        
        $bodegaje = ($values_order['cif_actual']['cif'] * 4/1000);
        if($bodegaje < 165 ) {
            $bodegaje = 165.00;
        }
        
        if ($lastWarenHouseParcial == False){
            $bodegaje += 8;
        }
               
        
        return ($this->responseHttp([
            'validWarenHouse' => True,
            'titleContent' => 'Generar Provisiones Por Bodega Del Parcial Pedido [' 
                                . $order['nro_pedido'] . 
                                '] Parcial [' . $parcial['id_parcial'] . ']',
            'parcial' => $parcial,
            'almacenaje' => $bodegaje,
            'lastWarenHouseParcial' => $lastWarenHouseParcial,
            'order' => $order,
            'values' => $values_order,
        ]));
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
    
     
    
    /*
     * Envia la respuestas html al navegador
     * @param array $config Arreglo con info de la plantilla
     * @return template
     */
    private function responseHttp($config)
    {
        $config['base_url'] = base_url();
        $config['title'] = 'Gastos Nacionalización';
        $config['rute_url'] = base_url() . 'index.php/';
        $config['controller'] = $this->controller;
        $config['iconTitle'] = 'fa-cubes';
        $config['content'] = 'home';
        return $this->twig->display($this->template, $config);
    }
}
