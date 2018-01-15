<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

    /**
     * constructor de la clase
     */
    public 
    function __construct()
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
    }

    /**
     * *
     * Establece los gastos de nacionalizacion para una factura informativa
     *
     * @param string $nroOrder
     * @return string template
     */
    public 
    function putExpenses()
    {
        if (! $_POST) {
            return ($this->index());
        }
        
        $expensesInput = $this->input->post();
        $iInfoInvoice = $expensesInput['id_factura_informativa'];
        unset($expensesInput['id_factura_informativa']);
        $expenses = [];
        foreach ($expensesInput as $input => $val) {
            $expenseRate = $this->modelRateExpenses->get($val);
            $this->modelExpenses->create([
                'nro_pedido' => '000-00',
                'id_factura_informativa' => $iInfoInvoice,
                'identificacion_proveedor' => $expenseRate['identificacion_proveedor'],
                'concepto' => $expenseRate['concepto'],
                'tipo' => 'NACIONALIZACION',
                'valor_provisionado' => $expenseRate['valor'],
                'fecha' => date('Y-m-d'),
                'date_create' => date('Y-m-d H:m:s'),
                'id_user' => $this->session->userdata('id_user')
            
            ]);
        }
        
        return ($this->redirectPage('validar70', $iInfoInvoice));
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
     * @param
     *            identificador de la factura infromativa
     */
    public 
    function validar70(int $idInfoInvoice)
    {
        $infoInvoice = $this->modelInfoInvoice->get($idInfoInvoice);
        if ($infoInvoice == false) {
            return ($this->index());
        }
        
        $infoInvoice['supplier'] = $this->modelSupplier->get($infoInvoice['identificacion_proveedor']);
        $infoInvoice['user'] = $this->modelUser->get($infoInvoice['id_user']);
        $infoInvoice['detail'] = $this->modelInfoInvoiceDetail->getByFacInformative($idInfoInvoice);
        
        if ($infoInvoice['detail'] != false) {
            
            foreach ($infoInvoice['detail'] as $item => $detail) {
                $detailOrderInvoice = $this->modelOrderInvoiceDetail->get($detail['detalle_pedido_factura']);
                
                $detail['product'] = $this->modelProduct->get($detailOrderInvoice['cod_contable']);
                
                $detail['detailOrder'] = $this->modelOrderInvoiceDetail->get($detail['detalle_pedido_factura']);
                $infoInvoice['detail'][$item] = $detail;
            }
        }
        $order = $this->modelOrder->get($infoInvoice['nro_pedido']);
        $infoInvoiceDetailsTemp = $this->modelInfoInvoiceDetail->getByFacInformative($infoInvoice['id_factura_informativa']);
        $infoInvoiceDetails = [];
        if ($infoInvoiceDetailsTemp != false) {
            
            foreach ($infoInvoiceDetailsTemp as $item => $detail) {
                $invoiceOrderDetail = $this->modelOrderInvoiceDetail->get($detail['detalle_pedido_factura']);
                $detail['product'] = $this->modelProduct->get($invoiceOrderDetail['cod_contable']);
                $detail['user'] = $this->modelUser->get($detail['id_user']);
                $infoInvoiceDetails[$item] = $detail;
            }
        }
        
        $expenses = $this->modelExpenses->getPartialExpenses($idInfoInvoice);
        return ($this->responseHTTP([
            'titleContent' => 'generar gastos nacionalizacion factura informativa [' . $infoInvoice['nro_factura_informativa'] . '] Pedido: [' . $order['nro_pedido'] . '] ',
            'order' => $order,
            'expenses' => $expenses,
            'rateExpenses' => $this->filterRateExpenses($idInfoInvoice),
            'infoInvoice' => $infoInvoice,
            'showExpenses' => true,
            'infoInvoiceDertails' => $infoInvoiceDetails,
            'warenHouseDays' => $this->getWarenHouseDays($order),
            'partial' => count($this->modelInfoInvoice->getByOrder($order['nro_pedido']))
        ]));
    }

    /**
     * Registra los costos de alamcenaje en la nacionalizacion del parcial
     */
    public function putWarenhouseExpense()
    {
        if (! $_POST) {
            return ($this->index());
        }
        
        $partialPost = $_POST;
        $idInfoInvoice = $partialPost['id_factura_informativa'];
        unset($partialPost['id_factura_informativa']);
        foreach ($partialPost['periodo'] as $item => $warenHouse) {
            $warenHouse['id_factura_informativa'] = $idInfoInvoice;
            $warenHouse['valor_provisionado'] = $this->getWarenhousePartialValue($idInfoInvoice);
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
     * @param int $idInfoInvoice
     * @return float
     */
    private function getWarenhousePartialValue(int $idInfoInvoice):float
    {   
        $infoInvoice = $this->modelInfoInvoice->get($idInfoInvoice);
        $order = $this->modelOrder->get($infoInvoice['nro_pedido']);
        
    }
    
    

    /**
     * Retorna los parametros de tarifas para gastos de nacionalizacion
     * si no existen retorna false
     *
     * @param int $idInfoInvoice
     * @return array | bool
     */
    private function filterRateExpenses(int $idInfoInvoice)
    {
        $rateExpenses = $this->modelRateExpenses->getPartialRates();
        $expeses = $this->modelExpenses->getPartialExpenses($idInfoInvoice);
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
    public 
    function presentar(int $idInitExpense)
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
        
        $infoInvoice = $this->modelInfoInvoice->get($expense['id_factura_informativa']);
        $order = $this->modelOrder->get($infoInvoice['nro_pedido']);
        return ($this->responseHttp([
            'titleContent' => 'Actulalizar Gasto Nacionalizacion Pedido [' . $order['nro_pedido'] . '] Factura Informativa [' . $infoInvoice['nro_factura_informativa'] . ']',
            'order' => $order,
            'expense' => $expense,
            'supplier' => $this->modelSupplier->get($expense['identificacion_proveedor']),
            'suppliers' => $this->modelSupplier->getByLocation('NACIONAL'),
            'infoInvoice' => $infoInvoice,
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
        
        $infoInvoice['detail'] = $this->modelInfoInvoiceDetail->getByFacInformative($idInfoInvoice);
        foreach ($infoInvoice['detail'] as $item => $detail) {
            $orderDetail = $this->modelOrderInvoiceDetail->get($detail['detalle_pedido_factura']);
            $detail['product'] = $this->modelProduct->get($orderDetail['cod_contable']);
            $detail['unidades'] = ($detail['nro_cajas'] * $detail['product']['cantidad_x_caja']);
            $detail['costo_caja'] = $orderDetail['costo_caja'];
            $detail['fob_item'] = ($detail['nro_cajas'] * $orderDetail['costo_caja']);
            $detail['fob_parcial'] = ($detail['fob_item'] / $valuesPartial['fob']);
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
    public 
    function eliminar(int $idNationalizationExpense)
    {
        $expense = $this->modelExpenses->getExpense($idNationalizationExpense);
        if ($expense) {
            $this->modelExpenses->delete($idNationalizationExpense);
            return ($this->redirectPage('validar70', $expense['id_factura_informativa']));
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
    public 
    function validar()
    {
        if (! $_POST) {
            return ($this->index());
        }
        
        $expense = $_POST;
        $expense['fecha'] = date('Y-m-d', strtotime($expense['fecha']));
        $expense['fecha_fin'] = date('Y-m-d', strtotime($expense['fecha_fin']));
        $expense['id_user'] = $this->session->userdata('id_user');
        $expense['tipo'] = 'NACIONALIZACION';
        $expense['valor_provisionado'] = floatval($expense['valor_provisionado']);
        $expense['last_update'] = date('Y-m-d H:m:s');
        if ($this->modelExpenses->update($expense)) {
            return ($this->redirectPage('validar70', $expense['id_factura_informativa']));
        }
        
        print 'Error con la base de datos';
    }

    /**
     * Valida la bodega parcial para una factura informativa
     *
     * @param int $idInfoInvoice
     */
    public 
    function validarbodegaparcial(int $idInfoInvoice)
    {
        $infoInvoice = $this->modelInfoInvoice->get($idInfoInvoice);
        if ($infoInvoice == false) {
            return ($this->index());
        }
        
        $infoInvoicesOrder = $this->modelInfoInvoice->getByOrder($infoInvoice['nro_pedido']);
        $order = $this->modelOrder->get($infoInvoice['nro_pedido']);
        $lastInvoInvoice = $this->modelInfoInvoice->lastInfoInvoice($order['nro_pedido']);
        $startWarenhouse = false;
        if ($lastInvoInvoice) {
            $lastExpenses = $this->modelExpenses->getByInfoInvoice($idInfoInvoice);
            $pos = 0;
            foreach ($lastExpenses as $item => $expense) {
                if ($expense['fecha_fin'] == null) {
                    unset($lastExpenses[$item]);
                } else {
                    $pos += 1;
                }
            }
            
            $startWarenhouse = $lastExpenses[$pos];
            $dateLast = new DateTime(date('Y-m-d', strtotime($startWarenhouse['fecha_fin'])));
            $dateLast->modify('+1 day');
            $startWarenhouse['fecha_fin'] = $dateLast->format('m/d/Y');
        }
        
        return ($this->responseHttp([
            'titleContent' => 'Generar Provisiones Por Bodega Del Parcial Pedido [' . $order['nro_pedido'] . '] Factura Informativa [' . $infoInvoice['nro_factura_informativa'] . ']',
            'validWarenHouse' => 'true',
            'order' => $order,
            'infoInvoicesOrder' => (count($infoInvoicesOrder) > 1) ? $infoInvoicesOrder : false,
            'infoInvoice' => $infoInvoice,
            'startWarenhouse' => $startWarenhouse
        ]));
    }

    /**
     * Obtiene el tiempo en dias de un pedido en la almacenera publica
     * desde la fecha_ingreso_almacenera, si el pedido se encuentra cerrado
     * se calcula hasta fecha_salida_Almacenera
     *
     * @param array $order
     *            pedido a evaluar
     * @return int
     */
    private function getWarenHouseDays(array $order): int
    {
        if (gettype($order['fecha_salida_almacenera']) == 'NULL') {
            return (dateDiffInDays($order['fecha_ingreso_almacenera'], date('Y-m-d')));
        }
        
        return (dateDiffInDays($order['fecha_ingreso_almacenera'], $order['fecha_salida_almacenera']));
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