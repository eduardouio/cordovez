<?php
defined('BASEPATH') or exit('No direct script access allowed');

$libraries_url = realpath(dirname(__FILE__));
$libraries_url = str_replace('controllers', 'libraries/', $libraries_url);

require_once ( $libraries_url . 'TaxesCalcR70.php' );
require_once ( $libraries_url . 'TaxesCalcR10.php' );

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
class Impuestos extends MY_Controller
{
    private $controller = "impuestos";
    private $template = '/pages/pageImpuestos.html';
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
    private function init()
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
        $this->load->helper('utils.php');
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
            'Redirecionamiento desde el controller de impuestos'
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
        
        if ($parcial['bg_isliquidated'] == 1 ){
            return $this->redirectPage('showTaxesParcialLiquidate', $id_parcial);
        }
        
        $init_data = $this->getOrderDataR70($id_parcial);
        $this->load->library('Prorrateos', $init_data);
        $prorrateo_values = $this->prorrateos->getValues();
        #seteamos la tasa de control en el producto
        if($this->prorrateos->have_tasa && $parcial['bg_isliquidated'] == 0){
            $this->updateTasaDetail(
                            $this->prorrateos->tasa_parcial, 
                            $init_data,
                            $this->prorrateos->tase_base_peso
                );
        }        
        
        $init_data['fobs_parcial'] = $prorrateo_values['fobs_parcial'];
        $init_data['warenhouses'] = $prorrateo_values['warenhouses'];

        $prorrateos = $this->updateProrrateoParcial(
                                                $prorrateo_values,
                                                $parcial
            );
                
        $param_taxes = $this->modelRatesExpenses->getTaxesParams();
        
        $parcialTaxes =  new parcialTaxes(
                                        $init_data, 
                                        $prorrateos,  
                                        $param_taxes, 
                                        $parcial
            );        
        
        
        if(checkTASAControl($init_data)){
            $weigth = False;
            foreach ($init_data['order_invoice_detail'] as $k => $item){
                if($item['peso'] == null || $item['peso'] == '' || $item['peso'] == 0){
                    $this->modelLog->warningLog(
                        'Uno de los items de la factura no tiene ingresado el peso'
                        );
                    $weigth = True;
                }
            }
            
            if($weigth){
                return $this->redirectPage('insertWeigth', $init_data['order_invoices'][0]['id_pedido_factura']);
            }
        }
        
        $all_parcials = $this->modelParcial->getAllParcials($parcial['nro_pedido']);
        $ordinal_parcial = ordinalNumberParcial($all_parcials, $parcial['id_parcial']);

        return ($this->responseHttp([
            'title' => 'Impuesto Parcial ' . $ordinal_parcial . '/' . count($all_parcials),
            'titleContent' => 'Resumen de Impuestos Liquidación Aduana [Parcial ' . 
                              $ordinal_parcial . '/' . count($all_parcials) .
                              '] [Pedido ' . $init_data['order']['nro_pedido'] . ']',
            'init_data' => $init_data,
            'parcial_taxes' => $parcialTaxes->getTaxes(),
            'prorrateos' => $prorrateos,
            'parcial' => $parcial,
            'warenhouses' => $init_data['warenhouses'],
            'regimen' => 'R70',
            'user' => $this->modelUser->get($init_data['parcial']['id_user']),
        ]));
    }
    
    
    /**
     * Actualiza la tasa en los productos de la factura informativa
     */
    private function updateTasaDetail($tasa_parcial, $init_data, $peso = false){        
        if ($peso){        
            foreach ($init_data['products'] as $i => $dt){
                foreach ($tasa_parcial as  $tp){
                    if($tp['detalle_pedido_factura'] == $dt['detalle_pedido_factura']){
                        $dt['tasa_control'] = $tp['tasa_parcial'];
                        $this->modelInfoInvoiceDetail->update($dt);
                        break;
                    }
                }
            }
            return true;
        }
       
        $total_info_invoices = 0.0;       
        
        foreach ($init_data['info_invoices'] as $i => $inv){
            $total_info_invoices += $inv['valor'];
        }
        
        foreach ($init_data['products'] as $i => $dt){
            foreach ($tasa_parcial as  $tp){
                if($tp['detalle_pedido_factura'] == $dt['detalle_pedido_factura']){
                    $dt['tasa_control'] = $tp['tasa_parcial'] * ($tp['costo_item']/$total_info_invoices);
                    $this->modelInfoInvoiceDetail->update($dt);
                    break;
                }
            }
        }        
        
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
        if($infoInfoiceDetail) {
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
            'init_expenses' => $this->modelInitExpenses->getAll($order),
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
     * Genera impuestos para R10 de un pedido
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
        
        if ($order['bg_isliquidated'] == 1){
            return $this->redirectPage('showTaxesOrderLiquidate', $nroOrder);
        }
        
        $init_data = $this->getOrderDataR10($nroOrder);
        $param_taxes = $this->modelRatesExpenses->getTaxesParams();
        
        $orderTaxes =  new orderTaxes(
            $init_data,
            $param_taxes,
            $order
            );
        
        if(checkTASAControl($init_data)){
            $weigth = False;
            foreach ($init_data['order_invoice_detail'] as $k => $item){
                if($item['peso'] == null || $item['peso'] == '' || $item['peso'] == 0){
                    $this->modelLog->warningLog(
                        'Uno de los items de la factura no tiene ingresado el peso'
                        );
                    $weigth = True;
                }
            }
            
            if($weigth){
                return $this->redirectPage('insertWeigth', $init_data['order_invoices'][0]['id_pedido_factura']);
            }
        }
                    
        $order_taxes = $orderTaxes->getTaxes();
       
        
        return ($this->responseHttp([
            'titleContent' => 'Resumen de Impuestos Liquidación Aduana del Pedido ' .
                                              $init_data['order']['nro_pedido'] . 
                                            ' [ ' . $order['incoterm'] . ' Régimen' . 
                                            $order['regimen'] .  ' ]' ,
            'init_data' => $init_data,
            'order_taxes' => $order_taxes,
            'regimen' => 'R10',
            'title' => 'Impuestos R10 ' . $order['nro_pedido'],
            'order' => $order,
            'etiquetas_fiscales' => $order_taxes['sums']['unidades'] * 0.13,
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
        
        if ($order == false) {
            $this->modelLog->errorLog(
                'El pedido no Existe'
                );
            return $this->index();
        }
        
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
     * Actualiza los parametros de calculo de impuestos para el Parcial
     *
     * @param $tipo_cambio float
     * @param $etiquetas_fiscales boolean
     * @return string redirect
     */
    public function actualizar()
    {
        
        $paramsParcial = [
            'id_parcial' => $_POST['id_parcial'],
            'bg_have_tasa_control' => 0,           
            'tipo_cambio' => $_POST['tipo_cambio'],
            'exoneracion_arancel' => $_POST['exoneracion_arancel'],
        ];
        
        if (isset($_POST['bg_have_tasa_control']) && 
            $_POST['bg_have_tasa_control'] == 'on') 
        {
            $paramsParcial['bg_have_tasa_control'] = 1;
        }
        
       $this->modelParcial->update($paramsParcial);      
           
        return ($this->redirectPage('showTaxesParcial', $_POST['id_parcial']));
    }
    
    
    /**
     * Actualiza los parametros de calculo de impuestos para 
     * Regimen 10
     * @parms array $params
     * @return $redirect
     */
    public function actualizarR10()
    {   
        if (! $_POST){
            return $this->index();
        }
        
        $order = $_POST;
        
        if (isset($order['have_etiquetas_fiscales']) && $order['have_etiquetas_fiscales'] == 'on'){
            $order['have_etiquetas_fiscales'] = 1;
        }else{
            $order['have_etiquetas_fiscales'] = 0;
        }
        
        if (isset($order['bg_have_tasa_control']) && $order['bg_have_tasa_control'] == 'on'){
            $order['bg_have_tasa_control'] = 1;
        }else{
            $order['bg_have_tasa_control'] = 0;
        }
        if($order['exoneracion_arancel'] > 100){
            $order['exoneracion_arancel'] = 100;
        }
        
        if ($this->modelOrder->update($order)){
            $this->modelLog->susessLog(
                'Se ha actualizado correctamente los parameros de impuestos'
                );
            return $this->redirectPage('showTaxesOrder', $_POST['nro_pedido']); 
            
        }else{
            $this->modelLog->errorLog(
                'No se pueden actualizar los parametros de impuestos'
                );
        }
    }
    
    /**
     * Marca un pedido como liquidado
     */
    public function liquidarIvaOrder(){
        if(!$_POST){
            return $this->index();
        }
        
        $order = $this->input->post();
        
        $order['bg_isliquidated'] = 1;
        $order['fecha_liquidacion'] = str_replace(
            '/', '-', $order['fecha_liquidacion']
            );
        $order['fecha_liquidacion'] = date(
            'Y-m-d', strtotime($order['fecha_liquidacion'])
            );                
        
        if($this->modelOrder->update($order)){
            return $this->redirectPage(
                'showTaxesOrderLiquidate', 
                $order['nro_pedido']
                );
        }
        print '<h1>Error de sistema</h1>';
        return $this->redirectPage('validargi', $order['nro_pedido']);
     }
     
     
     /**
      * Marca un parcial como liquidado
      */
    public function liquidarIvaParcial(){
        if(!$_POST){
            return $this->index();
        }
        
        $parcial = $this->input->post();
        $parcial['fecha_liquidacion'] = str_replace(
                                    '/', '-', $parcial['fecha_liquidacion']
                                    );
        $parcial['fecha_liquidacion'] = date(
                            'Y-m-d', strtotime($parcial['fecha_liquidacion'])
            );
        
        $parcial['bg_isliquidated'] = 1;
        
        if($this->modelParcial->update($parcial)){
            return $this->redirectPage(
                'showTaxesParcialLiquidate', $parcial['id_parcial']
                );
        }
        print '<h1>Error de sistema</h1>';
        return $this->redirectPage('showTaxesParcial', $parcial['id_parcial']);
     }


     /**
      * Saca a un pedido de la liquidacion final
      * 
      * @param  string $tipo tipo de registro
      * @param  string $id   idetificacion del registro a modificar
      * @return null       Retorna a los gastos del parcial del pedido uniciales
      */
     public function reverso(string $tipo, string $id){       

        if($tipo == 'pedido'){
            $order = $this->modelOrder->get($id);
            if($order && $order['bg_isclosed'] == 0){
                $order['last_update'] = date('Y-m-d');
                $order['bg_isliquidated'] = 0;
                if($this->modelOrder->update($order)){
                    return  $this->redirectPage('validargi', $id);
                }
            }

        }elseif($tipo == 'pc'){
            $parcial = $this->modelParcial->get($id);
            if($parcial && $parcial['bg_isclosed'] == 0){
                $parcial['last_update'] = date('Y-m-d');
                $parcial['bg_isliquidated'] = 0;
                if($this->modelParcial->update($parcial)){
                    return $this->redirectPage('parcial', $id);
                };
            }
        }

        $this->modelLog->errorLog(
            'Acceso restringido al sitio',
            current_url()
        );
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
        
        if($parcial['bg_isclosed']){
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
    private function responseHttp(array $config)
    {
        return ($this->twig->display($this->template, array_merge($config, [
            'base_url' => base_url(),
            'rute_url' => base_url() . 'index.php/',
            'controller' => $this->controller,
            'iconTitle' => 'fa-money',
            'content' => 'home'
        ])));
    }
}