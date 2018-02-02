<?php defined('BASEPATH') or exit('No direct script access allowed');

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
    private $modelBase;
    private $modelLog;
    private $modelUser;
    private $modelSupplier;
    private $modelRateExpenses;
    private $modelParcial;

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
        $this->modelLog->redirectLog('Acceso directo a URL ' . current_url());
        return ($this->redirectPage('ordersList'));
    }

    /**
     * inicia los modelos para la clase
     */
    private function init()
    {
        $this->load->model('modelorder');
        $this->load->model('modelexpenses');
        $this->load->model('modelproduct');
        $this->load->model('modelorderinvoice');
        $this->load->model('modelorderinvoicedetail');
        $this->load->model('modelinfoinvoice');
        $this->load->model('modelinfoinvoicedetail');
        $this->load->model('modellog');
        $this->load->model('modeluser');
        $this->load->model('modelbase');
        $this->load->model('modelsupplier');
        $this->load->model('modelrateexpenses');
        $this->load->model('modelparcial');
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
        $this->modelBase = new ModelBase();
        $this->modelParcial = new Modelparcial();
    }

    /**
     * *
     * Establece los gastos de nacionalizacion para una factura informativa
     *
     * @param string $nroOrder
     * @return string template
     */
    public function putExpenses()
    {
        if (! $_POST) {
            return ($this->index());
        }
        
        $expensesInput = $this->input->post();
        $idParcial = $expensesInput['id_parcial'];
        unset($expensesInput['id_factura_informativa']);
        $expenses = [];
        foreach ($expensesInput as $input => $val) {
            $expenseRate = $this->modelRateExpenses->get($val);
            $this->modelExpenses->create([
                'nro_pedido' => '000-00',
                'id_parcial' => $idParcial,
                'identificacion_proveedor' => $expenseRate['identificacion_proveedor'],
                'concepto' => $expenseRate['concepto'],
                'tipo' => 'NACIONALIZACION',
                'valor_provisionado' => $expenseRate['valor'],
                'fecha' => date('Y-m-d'),
                'date_create' => date('Y-m-d H:m:s'),
                'id_user' => $this->session->userdata('id_user')
            
            ]);
        }
        
        return ($this->redirectPage('validar70', $idParcial));
    }

    /**
     * Retorna el stock en la aduana del FOB, FLETE, y SEGURO aplica para todos
     * los régimenes
     *
     * @param string $nroOrder
     * @return array valore relacionados
     */
    private function initialCIFOrderVal(string $nroOrder): array
    {
        $order = $this->modelOrder->get($nroOrder);
        
        if ($order == false) {
            $this->modelLog->errorLog('El pedido no existe ' . current_url());
            return ($this->index());
        }
        
        return ([
            'fob' => $this->modelOrderInvoice->getFOBValue($nroOrder),
            'seguro' => $this->modelExpenses->getValueByName($nroOrder, 'SEGURO'),
            'flete' => $this->modelExpenses->getValueByName($nroOrder, 'FLETE')
        ]);
    }

    /**
     * Rertorna el stock actual en CIF para un pedido solo aplica para R70
     * El stock inicial es restado de los parciales solo en las facturas
     * informativas que se encuentren cerradas
     *
     * @param string $nroOrder
     * @return array
     */
    private function currentCIFOrderVal(string $nroOrder): array
    {
        $initialCIF = $this->initialCIFOrderVal($nroOrder);
        
        return ([
            'fob' => 0,
            'seguro' => 0,
            'flete' => 0
        ]);
    }

    
    /**
     * redirecciona a la pagina de lista de pedidos
     * son redirecciones por accesos sin ilegales
     *
     * @param int $idParcial
     */
    public function validar70(int $idParcial)
    {
        $parcial = $this->modelParcial->get($idParcial);
        if ($parcial == false) {
            return ($this->index());
        }
        
        $parcial = $this->modelParcial->get($idParcial);
        $order = $this->modelOrder->get($parcial['nro_pedido']);
        $expenses = $this->modelExpenses->getPartialExpenses($idParcial);
        
        $order = $this->modelOrder->get($parcial['nro_pedido']);
        
        $infoInvoices = $this->modelInfoInvoice->getByParcial($idParcial);
        
        if(is_array($infoInvoices)){
            foreach ($infoInvoices as $item => $invoice){
                $invoice['user'] = $this->modelUser->get($invoice['id_user']);
                
                $invoice['details'] = $this->modelInfoInvoiceDetail->
                        getByFacInformative($invoice['id_factura_informativa']);
                
                $invoice['supplier'] = $this->modelSupplier->get(
                                           $invoice['identificacion_proveedor']
                                                                 );
                
                $count = $this->modelInfoInvoiceDetail->countBoxesAnd(
                                             $invoice['id_factura_informativa']
                                                                      );
                $invoice['boxes'] = $count['boxes'];
                $invoice['unities'] = $count['unities'];
                $infoInvoices[$item] = $invoice;
            }
        }
       
        return ($this->responseHTTP([
            'titleContent' => 'generar gastos nacionalizacion Parcial[' . 
                               $parcial['id_parcial'] . '] Pedido: [' . 
                               $parcial['nro_pedido'] . '] ',
            'order' => $order,
            'expenses' => $expenses,
            'rateExpenses' => $this->filterRateExpenses($idParcial),
            'parcial' => $parcial,
            'infoInvoices' => $infoInvoices,
            'showExpenses' => true,
            'user' => $this->modelUser->get($parcial['id_user']),
            'warenHouseDays' => $this->getWarenHouseDays($order),
        ]));
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
        
        $partialPost = $_POST;
        $idParcial = $partialPost['id_parcial'];
        $dateExitWarenhouseParcial = $partialPost['fecha_salida_almacenera'];
        unset($partialPost['id_parcial']);
        unset($partialPost['fecha_salida_almacenera']);
        
        $index = count($partialPost['periodo']) -1 ;
        
        $dataParcial = [
            'id_parcial' => $idParcial,
            'fecha_salida_almacenera' => $dateExitWarenhouseParcial,
            'proximo_almacenaje_desde' => (
                                $partialPost['periodo'][$index]['fecha_fin']
                                            ),
                        ];
        
        foreach ($partialPost['periodo'] as $item => $warenHouse) {
            $warenHouse['id_parcial'] = $idParcial;
            $warenHouse['valor_provisionado'] = $this->getWarenhousePartialValue($idParcial);
            $warenHouse['id_user'] = $this->session->userdata('id_user');
            if ($this->modelExpenses->create($warenHouse)) {
                $this->modelLog->susessLog('Periodo Bodega Registrado Correctamete');
                $this->modelLog->susessLog($this->db->last_query());
            } else {
                $this->modelLog->errorLog('Error al Registrar periodo bodega ' . current_url());
                $this->modelLog->errorLog($this->db->last_query());
            }
        }
    }

    /**
     * retorna el costo de la bodega para el parcial, aplicando una formula
     * 
     * @param int $idParcial
     * @return float
     */
    private function getWarenhousePartialValue(int $idParcial): float
    {   
        
        $parcial = $this->modelParcial->get($idParcial);
        $order = $this->modelOrder->get($parcial['nro_pedido']);
        
        $cifInitial = $this->modelOrderInvoice->getInitCIFOrder(
                                                        $parcial['nro_pedido']
                                                                );
        
        $cifNationalized = $this->modelParcial->getNationalicedCIF(
                                                        $parcial['nro_pedido']
                                                                    );
        $cifInitTotal = 0.0;
        $cifNationalizedTotal = 0.0;
        
        foreach ($cifInitial as $item => $value){
            $cifInitTotal += $value;
        }
        
        foreach ($cifNationalized as $item => $value){
            $cifNationalizedTotal += $value;
        }
        
        $warenHouseValue = ((($cifInitTotal - $cifNationalizedTotal)*4)/1000);
        
        $this->modelLog->susessLog('Valor de Alamacenaje calculado ' . 
                                    $warenHouseValue . ' Pedido ' . 
                                    $order['nro_pedido']
                                  );
        
        if($warenHouseValue < 165){
            return 165;
        }
        return $warenHouseValue;
        
    }

    /**
     * Retorna los parametros de tarifas para gastos de nacionalizacion
     * si no existen retorna false
     *
     * @param int $idParcial
     * @return array | bool
     */
    private function filterRateExpenses(int $idParcial)
    {
        $rateExpenses = $this->modelRateExpenses->getPartialRates();
        $expeses = $this->modelExpenses->getPartialExpenses($idParcial);
        if ($rateExpenses == false) {
            return false;
        }
        
        if ($expeses == false) {
            return $rateExpenses;
        }
        
        foreach ($rateExpenses as $item => $rateExepense) {
            foreach ($expeses as $index => $expese) {
                if ($expese['concepto'] == $rateExepense['concepto']) {
                    unset($rateExpenses[$item]);
                }
            }
        }
        
        return $rateExpenses;
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
            $this->redirectPage('ordersList');
            return false;
        }
        ;
        $infoInvoice = $this->modelInfoInvoice->get($initExpense['id_factura_informativa']);
        $order = $this->modelOrder->get($infoInvoice['nro_pedido']);
        $this->responseHttp([
            'infoInvoice' => $infoInvoice,
            'initExpense' => $initExpense,
            'supplier' => $this->modelSupplier->get($initExpense['identificacion_proveedor']),
            'user' => $this->modelUser->get($infoInvoice['id_user']),
            'titleContent' => 'Descripción De Gasto Inicial Pedido:' . $order['nro_pedido'] . ' Factura Informativa [' . $infoInvoice['nro_factura_informativa'] . ']',
            'show' => true
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
        $order = $this->modelOrder->get($parcial['nro_pedido']);
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
     * Calcula lis impuestos para un pedido y una factura informativa
     *
     * @param string $tipo
     *            => PD => Pedido | FI => Factura Informativa
     * @param string $id
     *            => nro_pedido | id_factura_informativa
     */
    public function impuestosFI(string $idInfoInvoice)
    {
        $infoInvoice = $this->modelInfoInvoice->get($idInfoInvoice);
        if ($infoInvoice == false) {
            return ($this->index());
        }
        
        $h = $this->initialCIFOrderVal($infoInvoice['nro_pedido']);
        $k = $this->currentCIFOrderVal($infoInvoice['nro_pedido']);
        
        $valuesPartial = [
            'flete_parcial' => $infoInvoice['flete_aduana'],
            'seguro_parcial' => $infoInvoice['seguro_aduana'],
            'fob' => ($infoInvoice['valor'] * $infoInvoice['tipo_cambio'])
        ];
        
        $infoInvoice['detail'] = $this->modelInfoInvoiceDetail->
                                            getByFacInformative($idInfoInvoice);
        
        foreach ($infoInvoice['detail'] as $item => $detail) {
            
            $orderDetail = $this->modelOrderInvoiceDetail->
                                         get($detail['detalle_pedido_factura']);
            
            $detail['product'] = $this->modelProduct->get(
                                                  $orderDetail['cod_contable']
                                                         );
            
            $detail['unidades'] = (
                    $detail['nro_cajas'] * $detail['product']['cantidad_x_caja']
                                  );
            
            
            $detail['costo_caja'] = $orderDetail['costo_caja'];
            $detail['fob_item'] = (
                               $detail['nro_cajas'] * $orderDetail['costo_caja']
                                    );
            
            $detail['fob_parcial'] = (
                                    $detail['fob_item'] / $valuesPartial['fob']
                                     );
            
            $infoInvoice['detail'][$item] = $detail;
        }
        
        print '<pre>';
        print_r($infoInvoice);
        print '</pre>';
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
            return ($this->redirectPage('validar70', $expense['id_parcial']));
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
        $expense['fecha'] = date('Y-m-d', strtotime($expense['fecha']));
        //$expense['fecha_fin'] = date('Y-m-d', strtotime($expense['fecha_fin']));
        $expense['id_user'] = $this->session->userdata('id_user');
        $expense['tipo'] = 'NACIONALIZACION';
        $expense['valor_provisionado'] = floatval($expense['valor_provisionado']);
        $expense['last_update'] = date('Y-m-d H:m:s');
        if ($this->modelExpenses->update($expense)) {
            return ($this->redirectPage('validar70', $expense['id_parcial']));
        }
        
        print 'Error con la base de datos';
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
        
        $infoInvoicesOrder = $this->modelInfoInvoice->getByParcial($idParcial);
        $order = $this->modelOrder->get($parcial['nro_pedido']);

        
        return ($this->responseHttp([
            'titleContent' => 'Generar Provisiones Por Bodega Del Parcial Pedido [' . $order['nro_pedido'] . '] Parcial [' . $parcial['id_parcial'] . ']',
            'validWarenHouse' => 'true',
            'lastDateWarenhouse' => $this->lastDataWarenhouse($order),
            'order' => $order,
            'parcial' => $parcial,
            'fobSaldo' => $this->getWarenhousePartialValue($idParcial),
        ]));
    }
    
    
    /**
     * Retorna la ultima fecha que se ha facturado el bodegaje parcial
     * @param string $nroOrder
     * @return string
     */
    private function lastDataWarenhouse(array $order):string
    {
        $oldParcial = $this->modelParcial->getClosedParcials(
                                          $order['nro_pedido']
                                                              );       
        if( $oldParcial == false ) {
            return( $order['fecha_ingreso_almacenera'] );            
        }
        
        return( $oldParcial['proximo_almacenaje_desde'] );
        
    }

    /**
     * Obtiene el tiempo en dias de un pedido en la almacenera publica
     * desde la fecha_ingreso_almacenera, si el pedido se encuentra cerrado
     * se calcula hasta fecha_salida_Almacenera
     *
     * @param array $order pedido a evaluar
     * @return int
     */
    private function getWarenHouseDays(array $order): int
    {
        if (gettype($order['fecha_salida_almacenera']) == 'NULL') {
            return (
                    dateDiffInDays(
                                $order['fecha_ingreso_almacenera'], 
                                date('Y-m-d')
                                )
                    );
        }
        
        return ( 
                dateDiffInDays(
                                $order['fecha_ingreso_almacenera'], 
                                $order['fecha_salida_almacenera']
                               ) 
                );
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
        $config['iconTitle'] = 'fa-file';
        $config['content'] = 'home';
        return $this->twig->display($this->template, $config);
    }
}
