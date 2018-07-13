<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'lib/TaxesCalcR70Reliquidate.php';
require 'lib/TaxesCalcR10Reliquidate.php';
require 'lib/Prorrateo.php';

/**
 * Controller encargado del calculo de impuestos
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class Reliquidacion extends MY_Controller
{
    private $controller = "reliquidacion";
    private $template = '/pages/pageReliquidacion.html';
    private $modelOrder;
    private $modelParcial;
    private $ModelOrderInvoiceDetail;
    private $modelSupplier;
    private $modelOrderInvoice;
    private $modelExpenses;
    private $modelProducts;
    private $modelUser;
    private $modelLog;
    private $modelInfoInvoice;
    private $modelInfoInvoiceDetail;
    private $modelInitExpenses;
    private $modelRatesExpenses;
    private $ratesValues;
    private $modelProrrateo;
    private $modelProrrateoDetail;
    
    /**
     * Contructor de la clase
     */
    function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    /**
     * Inicia los modelos de la clase
     */
    public function init()
    {
        if(! isset($this->session->userdata['id_user'])){
            exit(0);
        }
        
        $this->load->model('Modelorder');
        $this->load->model('Modelorderinvoicedetail');
        $this->load->model('Modelsupplier');
        $this->load->model('Modelparcial');
        $this->load->model('Modelorderinvoice');
        $this->load->model('Modelexpenses');
        $this->load->model('Modelproduct');
        $this->load->model('Modeluser');
        $this->load->model('Modellog');
        $this->load->model('Modelinfoinvoice');
        $this->load->model('Modelinfoinvoicedetail');
        $this->load->model('Modelinitexpenses');
        $this->load->model('Modelrateexpenses');
        $this->load->model('Modelprorrateo');
        $this->load->model('Modelprorrateodetail');
        $this->modelInitExpenses = new Modelinitexpenses();
        $this->modelOrder = new Modelorder();
        $this->ModelOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelSupplier = new Modelsupplier();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelParcial = new Modelparcial();
        $this->modelExpenses = new Modelexpenses();
        $this->modelProducts = new Modelproduct();
        $this->modelUser = new Modeluser();
        $this->modelLog = new Modellog();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelInfoInvoiceDetail = new Modelinfoinvoicedetail();
        $this->modelRatesExpenses = new Modelrateexpenses();
        $this->modelProrrateo = new Modelprorrateo();
        $this->modelProrrateoDetail = new Modelprorrateodetail();
        $this->ratesValues = $this->modelRatesExpenses->getParcialRates();
    }
    
    
    /**
     * funcion por defecto del controller, se usa para redireccionar al home
     */
    public function index()
    {
        $this->modelLog->warningLog(
            'Redirecionamiento desde el controller de reliuidacion ICE'
            );
        
        return ($this->redirectPage('home'));
    }
    
    
    /**
     * Genera los impuestos para un parcial, el valor del flete y seguro
     * son sumados de cada una de las facturas informativas
     * Todos los pedidos R70 pasan por este filtro
     *
     * @param int $idParcial
     *            @retunr arrat template
     */
    public function pc(int $id_parcial)
    {
        $parcial = $this->modelParcial->get($id_parcial);
        
        if ($parcial == False){
            $this->modelLog->warningLog(
                'No se puedo continuar si el parcial no existe'
                );
            return $this->index();
        }
        
        if (
            $parcial['bg_isliquidated'] == 0
            || $parcial['bg_isliquidated'] == False
            ){
            return $this->index();
        }
        
        $init_data = $this->getOrderDataR70($id_parcial);
        $prorrateoParams = new Prorrateo($init_data);
        $prorrateo_values = $prorrateoParams->getValues();
        $init_data['fobs_parcial'] = $prorrateo_values['fobs_parcial'];
        $init_data['warenhouses'] = $prorrateo_values['warenhouses'];
        
        $prorrateos = $this->updateProrrateoParcial(
            $prorrateo_values,
            $parcial
            );
        
        $param_taxes = $this->modelRatesExpenses->getTaxesParams();
        
        $parcialTaxes =  new parcialTaxesReliquidate(
            $init_data,
            $prorrateos,
            $param_taxes,
            $parcial
            );
        

        return ($this->responseHttp([
            'titleContent' => 'Resumen de Impuestos Liquidación Aduana del Pedido ' .
            $init_data['order']['nro_pedido'],
            'init_data' => $init_data,
            'parcial_taxes' => $parcialTaxes->getTaxes(),
            'prorrateos' => $prorrateos,
            'parcial' => $parcial,
            'tipo' => 'parcial',
            'id' => $parcial['id_parcial'],
            'warenhouses' => $init_data['warenhouses'],
            'regimen' => 'R70',
            'current_date' => date('d-m-Y') ,
            'current_user' => $this->modelUser->get(
                $this->session->userdata('id_user')
                ),
            'order' => $init_data['order'],
            'user' => $this->modelUser->get($init_data['parcial']['id_user']),
        ]));
    }
    
    
    
    /**
     * Retorna la data incial para el calculo de impuestoas en R10 y 70
     *
     * @param string $nro_order
     * @param int $id_parcial
     * @return array Costos Iniciales
     */
    private function getOrderDataR70( int $id_parcial ): array
    {
        $parcial = $this->modelParcial->get($id_parcial);
        $order = $this->modelOrder->get($parcial['nro_pedido']);
        
        if ($parcial == false) {
            $this->modelLog->errorLog('No Existe El parcial para nacionalizar');
            return $this->index();
        }
        
        if($parcial['bg_isliquidated'] == 0){
            $this->modelLog->warningLog(
                'El parical aun no ha liquidado los impuestos'
                );
            return $this->index();
        }
        
        $info_invoices = $this->modelInfoInvoice->getByParcial(
            $parcial['id_parcial']
            );
        
        $infoInfoiceDetail = [];
        $products_base = [];
        
        foreach($info_invoices as $item => $invoice){
            $products = $this->modelInfoInvoiceDetail->getByFacInformative(
                $invoice['id_factura_informativa']
                );
            array_push($infoInfoiceDetail, $products);
        }
        
        $infoInfoiceDetail = $infoInfoiceDetail[0];
        
        foreach ($infoInfoiceDetail as $item => $dt){
            $invoice_detail = $this->ModelOrderInvoiceDetail->get(
                $dt['detalle_pedido_factura']
                );
            
            $product =  $this->modelProducts->get(
                $invoice_detail['cod_contable']
                );
            
            $product['detalle_pedido_factura'] = $dt['detalle_pedido_factura'];
            
            array_push($products_base, $product);
        }
        
        
        $order_invoices = $this->modelOrderInvoice->getbyOrder(
            $parcial['nro_pedido']
            );
        
        $order_invoice_detail = [];
        
        foreach ($order_invoices as $item => $invoice){
            $detail = $this->ModelOrderInvoiceDetail->getByOrderInvoice(
                $invoice['id_pedido_factura']
                );
            
            foreach ($detail as $idx => $dt){
                array_push($order_invoice_detail, $dt);
            }
        }
        
        return([
            'order' => $order,
            'order_invoices' => $order_invoices,
            'order_invoice_detail' => $order_invoice_detail,
            'products_base' => $products_base,
            'init_expeses' => $this->modelInitExpenses->getAll($order),
            'parcial' => $parcial,
            'all_parcials' => $this->modelParcial->getAllParcials(
                $parcial['nro_pedido']
                ),
            'parcial_expenses' => $this->modelExpenses->getPartialExpenses(
                $parcial['id_parcial']
                ),
            'info_invoices' => $info_invoices,
            'products' => $infoInfoiceDetail,
            'last_prorrateo' => $this->modelProrrateo->getLastProrrateo(
                $id_parcial
                ),
        ]);
        
    }
    
    
    /**
     * Genera la reliquidacion de impuestos para R10
     *
     * @param string $nroOrder
     */
    public function pd(string $nroOrder)
    {
        $order = $this->modelOrder->get($nroOrder);
        
        if($order == False){
            $this->modelLog->warningLog(
                'El pedido solicitado no existe'
                );
            return $this->index();
        }
        
        if($order['regimen'] == '70'){
            $this->modelLog->warningLog(
                'No se puede liquidar un pedidos de regimen Diferente al 70'
                );
            return $this->index();
        }
        
        if ($order['bg_isliquidated'] == 0){
            $this->modelLog->warningLog(
                'El pedido que intenta reliquidar está abierto'
                );
            return $this->index();
        }

        $init_data = $this->getOrderDataR10($nroOrder);
        $param_taxes = $this->modelRatesExpenses->getTaxesParams();
        
        $orderTaxes =  new orderTaxesReliquidate(
            $init_data,
            $param_taxes,
            $order
            );
        
        return ($this->responseHttp([
            'titleContent' => 'Resumen de Liquidacion Pedido ' .
                                $init_data['order']['nro_pedido'] . 
                                ' Regimen : ' . $order['regimen'],
            'init_data' => $init_data,
            'order_taxes' => $orderTaxes->getTaxes(),
            'regimen' => 'R10',
            'tipo' => 'orden',
            'id' => $nroOrder,
            'current_date' => date('d-m-Y') ,
            'order' => $order,
            'current_user' => $this->modelUser->get(
                            $this->session->userdata('id_user')
                ),
            'user' => $this->modelUser->get($init_data['order']['id_user']),
        ]));
    }
    
    
    /**
     * Retorna la data incial para el calculo de impuestoas en R10 y 70
     *
     * @param string $nro_order
     * @param int $id_parcial
     * @return array Costos Iniciales
     */
    private function getOrderDataR10( string $nro_pedido ): array
    {
        $order = $this->modelOrder->get($nro_pedido);
        
        $order_detail = [];
        $products_base = [];
        
        $order_invoices = $this->modelOrderInvoice->getbyOrder(
            $nro_pedido
            );
        
        $order_invoice_detail = [];
        
        foreach ($order_invoices as $item => $invoice){
            $detail = $this->ModelOrderInvoiceDetail->getByOrderInvoice(
                $invoice['id_pedido_factura']
                );
            
            foreach ($detail as $idx => $dt){
                array_push($order_invoice_detail, $dt);
                
                $product =  $this->modelProducts->get(
                    $dt['cod_contable']
                    );
                
                $product['detalle_pedido_factura'] = $dt['detalle_pedido_factura'];
                
                array_push($products_base, $product);
                
                
                
            }
        }
        
        return([
            'order' => $order,
            'order_invoices' => $order_invoices,
            'order_invoice_detail' => $order_invoice_detail,
            'products_base' => $products_base,
            'init_expenses' => $this->modelInitExpenses->getAll($order),
        ]);
        
    }
    
    
    
    /**
     * Obtiene el valor que le corresponde al item en la factura informativa
     *
     * @param int $unities
     * @param array $infoInfoice
     *            arreglo de toda la factura informariva
     * @param string $concept
     *            [flete | seguro | fob]
     * @param array $order
     *            orden relaxionado
     * @return float valor del concepto
     */
    private function getValueOrder(
        int $unities,
        int $idOrderInvoiceDetail,
        array $orderInvoice,
        array $order
        ): array
        {
            $itemValues = [
                'fob_item' => 0.0,
                'seguro_item' => 0.0,
                'flete_item' => 0.0,
                'percent_item' => 0.0
            ];
            
            foreach ($orderInvoice['products'] as $item => $detail) {
                if ($detail['detalle_pedido_factura'] == $idOrderInvoiceDetail) {
                    $itemValues['fob_item'] = floatval($detail['costo_caja'] * $detail['nro_cajas']);
                    $itemValues['percent_item'] = floatval($itemValues['fob_item'] / $orderInvoice['valor']);
                    $itemValues['flete_item'] = floatval($order['flete_aduana'] * $itemValues['percent_item']);
                    $itemValues['seguro_item'] = floatval($order['seguro_aduana'] * $itemValues['percent_item']);
                    return $itemValues;
                }
            }
    }
        
    
    /**
     * Conforma el cioerre de un pedido o un parcial
     * 
     * @param string $tipo
     * @param string $id
     */
    public function cierre(){
        if(!$_POST){
            return $this->index();
        }
        
        $record = $this->existRecord($_POST['tipo'], $_POST['id']);
        
        if ($record == False){
            $this->modelLog->errorLog(
                'El pedido o parcial que intenta cerrar no existe',
                $this->db->last_query()
                );
            return $this->index();
        }        

        $_POST['fecha_cierre'] = str_replace('/', '-', $_POST['fecha_cierre']);
        $record['bg_isclosed'] = 1;
        $record['fecha_cierre'] = date('Y-m-d', strtotime($_POST['fecha_cierre']));
        $record['id_user_cierre'] = $this->session->userdata('id_user');       
        
        if($_POST['tipo'] == 'orden'){
            $this->modelOrder->update($record);
            $this->modelLog->susessLog('Pedido ' . $_POST['id'] . 'fue cerrrado');
            return $this->redirectPage('showTaxesOrderLiquidate', $_POST['id']);
        }
        
        $this->modelParcial->update($record);
        $this->modelLog->susessLog('El parcial ' . $_POST['id'] . ' fue cerrado');
        return $this->redirectPage('showTaxesParcialLiquidate', $_POST['id']);
    }
    
    
    
    /**
     * Confirma si el registro existe
     * 
     * @param string $tipo
     * @param string $id
     */
    private function existRecord(string $tipo, string $id){
        $record = [];
        
        if ($tipo == 'orden'){
            $record = $this->modelOrder->get($id);
        }
        elseif($tipo == 'parcial'){
            $record = $this->modelParcial->get(intval($id));
            print_r($record);
        }
        
        if ($record){
            return $record;
        }
        
        return false;
    }
    

    /**
     * Retorna el valor del impuesto basado en el nombre
     *
     * @param string $taxeName
     *            nombre del impuesto
     * @return float valor del impuesto
     */
    private function getParamTaxes(string $taxeName): float
    {
        foreach ($this->ratesValues as $index => $rate) {
            if ($rate['concepto'] == $taxeName) {
                $this->modelLog->susessLog("Valor para $taxeName " . $rate['valor']);
                return floatval($rate['valor']);
            }
        }
        
        $this->modelLog->errorLog("El impuesto  $taxeName solicitado no Existe");
        return false;
    }    
    
    /**
     * Registra y/o actualiza los valores prorrateados del parcial
     *
     * @param $prorrateo_values array detalle de los prorrateos
     * @param $parcial array informacion del parcial
     */
    private function updateProrrateoParcial(
        array $prorrateo_values,
        array $parcial
        )
    {
        
        if($parcial['bg_isliquidated']){
            $this->modelLog->generalLog(
                'El parcial se encuentra cerrado no se puede continuar'
                );
            return $this->getProrrateosParcial($parcial['id_parcial']);
        }
        
        $fobs = $prorrateo_values['fobs_parcial'];
        $warenhouses = $prorrateo_values['warenhouses'];
        $prorrateos_parcial = $prorrateo_values['prorrateos']['prorrateo_parcial'];
        $prorrateo_pedido = $prorrateo_values['prorrateos']['prorrateo_pedido'];
        
        $this->modelProrrateo->deleteProrrateoByParcial($parcial['id_parcial']);
        
        $prorrateoHeader = [
            'id_parcial' => $parcial['id_parcial'],
            'porcentaje_parcial' => $fobs['fob_parcial_razon_inicial'],
            'fob_parcial_razon_inicial' => $fobs['fob_parcial_razon_inicial'],
            'fob_parcial_razon_saldo' => $fobs['fob_parcial_razon_saldo'],
            'fob_proximo_parcial' => $fobs['fob_proximo_parcial'],
            'fob_inicial' => $fobs['fob_inicial'],
            'fob_saldo' => $fobs['fob_saldo'],
            'fob_parcial' => $fobs['fob_parcial'],
            'almacenaje_parcial' => $warenhouses['almacenaje_parcial'],
            'almacenaje_anterior' => $warenhouses['almacenaje_anterior'],
            'almacenaje_aplicado' => $warenhouses['almacenaje_aplicado'],
            'almacenaje_proximo_parcial' => $warenhouses['almacenaje_proximo_parcial'],
            'prorrateo_flete_aduana' => $fobs['prorrateo_flete_aduana'],
            'prorrateo_seguro_aduana' => $fobs['prorrateo_seguro_aduana'],
            'id_user' => $this->session->userdata('id_user'),
        ];
        
        $id_prorrateo = $this->modelProrrateo->createProrrateo($prorrateoHeader);
        $prorrateo_detail = [];
        
        if($id_prorrateo){
            $prorrateos = array_merge($prorrateo_pedido, $prorrateos_parcial);
            foreach ($prorrateos as $idx => $prorrateo){
                $valor_prorrateado = 0;
                $tipo = '';
                
                if($prorrateo['tipo'] == 'INICIAL'){
                    $valor_prorrateado = $prorrateo['valor_prorrateado'];
                    $tipo = 'gasto_inicial';
                }else{
                    $valor_prorrateado = $prorrateo['valor_provisionado'];
                    $tipo = 'parcial';
                }
                
                $detail = [
                    'id_prorrateo' => $id_prorrateo,
                    'id_gastos_nacionalizacion' => $prorrateo['id_gastos_nacionalizacion'],
                    'tipo' => $tipo,
                    'concepto' => $prorrateo['concepto'],
                    'valor_prorrateado' => $valor_prorrateado,
                    'valor_provisionado' => $prorrateo['valor_provisionado'],
                    'id_user' => $this->session->userdata('id_user'),
                ];
                
                $this->modelProrrateoDetail->createProrrateoDetail($detail);
                array_push($prorrateo_detail, $detail);
                
            }
            
            return [
                'prorrateo' => $prorrateoHeader,
                'prorrateo_detail' => $prorrateo_detail,
            ];
        }
        
        $this->modelLog->errorLog(
            'No se puede actualizar el parcial Error en prorrateos',
            $this->db->last_query()
            );
        
        return False;
    }
    
    
    /**
     * Obtiene el detalle de los prorrateos del parcial
     * @param int $id_parcial
     */
    private function getProrrateosParcial($id_parcial){
        
        $prorrateo = $this->modelProrrateo->getProrrateoByParcial(
            $id_parcial
            );
        
        $prorrateo_detail = $this->modelProrrateoDetail->getAllDetailProrrateo(
            $prorrateo[0]['id_prorrateo']
            );
        
        return [
            'prorrateo' => $prorrateo,
            'prorrateo_detail' => $prorrateo_detail,
        ];
        
    }
    
    
    /*
     * Redenderiza la informacion y la envia al navegador
     * @param array $config informacion de la plantilla
     */
    private function responseHttp($config)
    {
        return ($this->twig->display($this->template, array_merge($config, [
            'title' => 'Impuestos Aduana',
            'base_url' => base_url(),
            'rute_url' => base_url() . 'index.php/',
            'controller' => $this->controller,
            'iconTitle' => 'fa-money',
            'content' => 'home'
        ])));
    }
}