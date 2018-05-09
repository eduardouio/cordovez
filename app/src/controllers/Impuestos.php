<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'lib/TaxesCalcR70.php';
require 'lib/TaxesCalcR10.php';
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
    public function init()
    {
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
        $init_data = $this->getOrderDataR70($id_parcial);
        $prorrateos = $this->getProrrateoParcial($init_data);
        $param_taxes = $this->modelRatesExpenses->getTaxesParams();
        
        $parcialtaxes = [];
        
        foreach ($init_data['products'] as $item => $product){
            $taxes = new productTaxes();
            array_push(
                        $parcialtaxes, 
                        $taxes->getTaxesProduct(
                                                $init_data, 
                                                $prorrateos,
                                                $product,
                                                $param_taxes
                            )
                );
        }
                
        return ($this->responseHttp([
            'titleContent' => 'Resumen de impuestos Pedido ' . 
                                        $init_data['order']['nro_pedido'],
            'init_data' => $init_data,
            'parcial_taxes' => $parcialtaxes,
            'prorrateos' => $prorrateos,
            'regimen' => 'R70',
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
        
        $info_invoices = $this->modelInfoInvoice->getByParcial(
            $parcial['id_parcial']
            );
        
        $infoInfoiceDetail = [];
        $products_base = [];
        
        foreach($info_invoices as $item => $invoice){
            $products = $this->modelInfoInvoiceDetail->getByFacInformative(
                $invoice['id_factura_informativa']
                );             
            array_push($infoInfoiceDetail, $products[0]);
        }     
        
        
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
            'parcial_expenses' => $this->modelExpenses->getPartialExpenses(
                                                          $parcial['id_parcial']
                                                                        ),
            'info_invoices' => $info_invoices,
            'products' => $infoInfoiceDetail,
            'last_prorrateo' => $this->modelProrrateo->getLastProrrateo(
                                                          $parcial['nro_pedido'],
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
        $init_data = $this->getOrderDataR10($nroOrder);
        $param_taxes = $this->modelRatesExpenses->getTaxesParams();
        
        $orderTaxes = [];
        
        foreach ($init_data['order_invoice_detail'] as $item => $product){
            $taxes = new productTaxesR10();
            
            array_push(
                $orderTaxes,
                $taxes->getTaxesProduct(
                    $init_data,
                    $product,
                    $param_taxes
                    )
                );
        }
        
        return ($this->responseHttp([
            'titleContent' => 'Resumen de impuestos Pedido ' .
                                              $init_data['order']['nro_pedido'],
            'init_data' => $init_data,
            'parcial_taxes' => $orderTaxes,
            'regimen' => 'R10',
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
            'bg_have_etiquetas_fiscales' => 0,
            'observaciones' => $_POST['observaciones'],
            'tipo_cambio' => $_POST['tipo_cambio'],
            'otros' => $_POST['otros'],
            'exoneracion_arancel' => $_POST['exoneracion_arancel'],
        ];
        
        if (isset($_POST['bg_have_etiquetas_fiscales']) && 
            $_POST['bg_have_etiquetas_fiscales'] == 'on') 
        {
            $paramsParcial['bg_have_etiquetas_fiscales'] = 1;
        }
        
        if (isset($_POST['bg_have_tasa_control']) && 
            $_POST['bg_have_tasa_control'] == 'on') 
        {
            $paramsParcial['bg_have_tasa_control'] = 1;
        }
        
        if ($this->modelParcial->updateLabelsParcial($paramsParcial)) {
            $this->modelLog->susessLog(
                'Parametros moneda, etiquetas y otros impuestos modificadas'
                );
        } else {
            $this->modelLog->errorLog(
                'No se realizaron los cambios en el parcial',
                $this->db->last_query()
                );
        }
        
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
        
        if($_POST['have_etiquetas_fiscales'] == 'on'){
            $_POST['have_etiquetas_fiscales'] = 1;
        }else{
            $_POST['have_etiquetas_fiscales'] = 0;
        }
        
        if($_POST['bg_have_tasa_control'] == 'on'){
            $_POST['bg_have_tasa_control'] = 1;
        }else{
            $_POST['bg_have_tasa_control'] = 0;
        }
        
        
        if ($this->modelOrder->update($_POST)){
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
     * Retorna el valor de la tasa de control para un producto en la lista
     *
     * @param array $producto
     * @return float
     */
    private function getTasaControl(
                                    array $product, 
                                    array $parcial
        ): float
    {
        if ($parcial['bg_have_tasa_control'] == 0) {
            return 0;
        }
        
        $tasaServicio = (
            ((intval($product['capacidad_ml']) / 2000) * 0.10) 
            * 
            ($product['nro_cajas'] * $product['cantidad_x_caja']));
        
        if ($tasaServicio < 700) {
            return $tasaServicio;
        }
        
        return 700;
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
     * * Obitene el valor del prorrateo para el costo de prorrateo
     *
     * @param array $init_data datos iniciales del parcial
     * @return array
     */
    private function getProrrateoParcial( array $init_data ) : array
    {
        $this->checkTypeChange($init_data['info_invoices'], $init_data['order']);
        
        $prorrateoParams = new Prorrateo([
            'infoInvoices' => $init_data['info_invoices'],
            'order' => $init_data['order'],
            'orderInvoices' => $init_data['order_invoices'],
            'parcial' => $init_data['parcial'],
            'initExpenses' => $init_data['init_expeses'],
            'parcialExpenses' => $init_data['parcial_expenses'],
            'lastProrrateo' => $init_data['last_prorrateo'],
        ]);
        
        $prorrateoValues = $prorrateoParams->getValues();
        
        return $this->putDeleteUpdateProrrateoParcial($prorrateoValues);
    }
    

    /**
     * Registra y/o actualiza los valores prorrateados del parcial
     *
     * @param array $id_parcial
     * @return bool
     */
    private function putDeleteUpdateProrrateoParcial(array $prorrateo): array
    {
        
        $prorrateo['id_user'] = $this->session->userdata['id_user'];
        $prorrateoDetail = $prorrateo['details'];
        unset($prorrateo['details']);
        
        $prorrateoParcial = $this->modelProrrateo->getProrrateoByParcial(
                                                        $prorrateo['id_parcial']
            );
        
        
        if ($prorrateoParcial) {
            return $this->updateProrrateo(
                                            $prorrateo, 
                                            $prorrateoDetail,
                                            $prorrateoParcial
                );
            
        } else {            
            return $this->createProrrateo(
                                            $prorrateo,
                                            $prorrateoDetail
                );
        }
    }

    
    /**
     * Actualiza el registro de prorrateos de un parcial
     * 
     * @param array $prorrateo prorrateo Calculado para el parcial
     * @param array $prorrateoDetail DEtalle del prorrateo calculado
     * @param array $prorrateoParcial Prorrateo Existente regitrado  
     * @return bool
     */
    private function updateProrrateo(
                                     array $prorrateo, 
                                     array $prorrateoDetailTemp,
                                     array $prorrateoParcial
        ): array
    {
             
        $prorrateoParcial = $prorrateoParcial[0];
        
        $prorrateo['last_update'] = date('Y-m-d H:m:s');
        $prorrateoDetail = [];
        
        foreach ($prorrateoDetailTemp as $item => $exp_prorrateo) {
            $exp_prorrateo['last_update'] = date('Y-m-d H:m:s');
            array_push($prorrateoDetail, $exp_prorrateo);
        }
        
        if($this->deleteProrrateo($prorrateoParcial['id_prorrateo'])){
            return (
                $this->createProrrateo(
                        $prorrateo, 
                        $prorrateoDetail
                    )
                );
        }
        
        $this->modelLog->errorLog(
            'Error al actualizar el prorrateo en la base de datos',
            $this->db->last_query()
            );
        
        return [];
    }
    

    /**
     * Regustra un nuevo prorrateo en la base de datos
     *
     * @param array $prorrateo cabeceras del prorrateo
     * @param array $prorrateoDetail detalle del nuevo prorrateo
     * @return bool
     */
    private function createProrrateo(
                                    array $prorrateo,
                                    array $prorrateoDetail
        )
    {
        
        $id_prorrateo_insert_db = $this->modelProrrateo->createProrrateo(
            $prorrateo
            );

        
        $prorrateo['id_prorrateo'] = $id_prorrateo_insert_db;
        $prorrateoDetailTemp = [];
        $allInsert = True;
        
        foreach ($prorrateoDetail as $item => $exp_prorrateo)
        {
            $exp_prorrateo['id_prorrateo'] = $id_prorrateo_insert_db;
            $exp_prorrateo['id_user'] =  $this->session->userdata['id_user'];
            $insert_id = $this->modelProrrateoDetail->createProrrateoDetail(
                                                     $exp_prorrateo);
            if($insert_id){
                $exp_prorrateo['id_prorrateo_detalle'] = $insert_id;
                array_push($prorrateoDetailTemp, $exp_prorrateo);
            }else{
                $this->modelLog->errorLog(
                    'No se puede ingresar el detalle de prorrateo parcial',
                    $this->db->last_query()
                    );
                
                return False;
                }
          }

            return ([
                'prorrateo' => $prorrateo,
                'prorrateo_detail' => $prorrateoDetailTemp,
            ]) ;
    }
    
    

    /**
     * Elimina un prorrateo y los detalles del mismo de la base
     *
     * @param array $id_prorrateo
     * @return bool
     */
    private function deleteProrrateo(int $id_prorrateo): bool
    {
        $detailForDelete = $this->modelProrrateoDetail->getAllDetailProrrateo(
                                                                $id_prorrateo
            ); 
        
        if (!$detailForDelete){
            return true;
        }
        
        $allDelete = true;
        
        foreach($detailForDelete as $item => $expense){
            if($this->modelProrrateoDetail->deleteProrrateoDetail(
                                        $expense['id_prorrateo_detalle'])){
                
            }else{
                $allDelete = false;
                $this->modelLog->errorLog(
                    'No se puede eliminar un prorrateo',
                    $this->db->last_query()
                    );
            }
        }
        
        if ($allDelete){
            if($this->modelProrrateo->deleteProrrateo($id_prorrateo)){
                $this->modelLog->generalLog(
                    'Se ha usado pa opcion de actualizar prorrateo'
                    );
                return true;
            }
            $this->modelLog->errorLog(
                                    'Problema al borrar prorrateo padre'
                );
            return false;
        }
        
        return false;
    }
    
    
    /**
     * Obtiene el tipo de cambio fijado en un pedido, se aplica el primer
     * tipo de cambioa gragado al primer parcial
     *
     * @param array $infoInvoices
     * @param array $order
     */
    private function checkTypeChange(array $infoInvoices, array $order)
    {
        if ($order['tipo_cambio_almaceneraR70'] == null || $order['tipo_cambio_almaceneraR70'] == 0 || $order['tipo_cambio_almaceneraR70'] == '') {
            $this->modelOrder->update([
                'nro_pedido' => $order['nro_pedido'],
                'tipo_cambio_almaceneraR70' => $infoInvoices[0]['tipo_cambio']
            ]);
        }
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