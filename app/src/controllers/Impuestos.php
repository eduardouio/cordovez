<?php
defined('BASEPATH') or exit('No direct script access allowed');

$libraries_url = realpath(dirname(__FILE__));
$libraries_url = str_replace('controllers', 'libraries/', $libraries_url);

require_once ( $libraries_url . 'TaxesCalc.php' );
require_once ( $libraries_url . 'StockOrder.php' );


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
    private $modelProducts;
    private $modelUser;
    private $modelLog;
    private $modelInfoInvoice;
    private $modelInfoInvoiceDetail;
    private $modelInitExpenses;
    private $modelRatesExpenses;
    private $ratesValues;

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

        $init_data = $this->getOrderDataR70($id_parcial);

        $detail_order_invoices = [];
        $detail_info_invoices = [];

        $order_invoices = $this->modelOrderInvoice->getCompleteInvoiceByOrder(
            $parcial['nro_pedido']
            );

        if($order_invoices){
            foreach ($order_invoices['detail'] as $k => $v){
                $v['product'] = $this->modelProducts->get($v['cod_contable']);
                array_push($detail_order_invoices, $v);
            }
        }

        $info_invoices = $this->modelInfoInvoice->getByOrder($parcial['nro_pedido']);
        if($info_invoices){
            foreach ($info_invoices as $idx => $invoice){
                $details = $this->modelInfoInvoiceDetail->getByFacInformative(
                    $invoice['id_factura_informativa']
                    );
                if ($details){
                    foreach ($details as $k => $v){
                        array_push($detail_info_invoices, $v);
                    }
                }
            }
        }

        $param_taxes = $this->modelRatesExpenses->getTaxesParams();
        $parcialTaxes =  new TaxesCalc(
                                        $init_data,
                                        $param_taxes
                         );

        $all_parcials = $this->modelParcial->getAllParcials($parcial['nro_pedido']);
        $ordinal_parcial = ordinalNumberParcial($all_parcials, $parcial['id_parcial']);
        $parcial_taxes = $parcialTaxes->getTaxes();

        #eliminamos la comilla sencilla de DEVILS
        $i = 0;
        foreach($parcial_taxes['taxes'] as $k){
            $parcial_taxes['taxes'][$i]['product'] =  str_replace("'","-",$k['product']);
            $i++;
        }
        $taxes = [];
        if ($parcial['bg_isliquidated'] == 0){
            foreach ($parcial_taxes['taxes'] as $item){
                $item['id_factura_informativa_detalle'] = $item['id_registro'];
                unset($item['id_registro']);
                unset($item['cajas']);
                unset($item['costo_caja']);
                unset($item['capacidad_ml']);
                unset($item['indirectos']);
                unset($item['ex_aduana_unitario_antes']);
                unset($item['gasto_origen']);
                $this->modelInfoInvoiceDetail->update($item);
                $product = $this->Modelproduct->get($item['cod_contable']);
                $item['registro_sanitario'] = $product['registro_sanitario'];
                $item['nro_registro_sanitario'] = $product['nro_registro_sanitario'];
                array_push($taxes, $item);
            }
        }

        $parcial_taxes['taxes'] = $taxes;

        return ($this->responseHttp([
            'title' => 'Impuesto Parcial ' . $ordinal_parcial . '/' . count($all_parcials),
            'titleContent' => 'Resumen de Impuestos Liquidación Aduana [Parcial ' .
                              $ordinal_parcial . '/' . count($all_parcials) .
                              '] [Pedido ' . $init_data['order']['nro_pedido'] . '] Ref ' .
                               $init_data['info_invoices'][0]['nro_refrendo'] .
                            '  ['. $init_data['order']['proveedor']  . ']',
            'init_data' => $init_data,
            'parcial_taxes' => $parcial_taxes,
            'url_sgi' => $GLOBALS['selected_enterprise']['sgi_url'],
            'parcial' => $parcial,
            'ordinal_parcial' => $ordinal_parcial,
            'count_all_parcials' => count($all_parcials),
            'vue_app' => true,
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

        $init_data = $this->getOrderDataR10($nroOrder);
        $param_taxes = $this->modelRatesExpenses->getTaxesParams();

        $orderTaxes =  new TaxesCalc(
            $init_data,
            $param_taxes,
            False
            );
        $order_taxes = $orderTaxes->getTaxes();
        if ($order['bg_isliquidated'] == 0){
            foreach($order_taxes['taxes'] as $i => $item){
                $item['detalle_pedido_factura'] = $item['id_registro'];
                unset($item['id_registro']);
                unset($item['cajas']);
                unset($item['costo_caja']);
                unset($item['capacidad_ml']);
                unset($item['indirectos']);
                unset($item['ex_aduana_unitario_antes']);
                $this->ModelOrderInvoiceDetail->update($item);
                $product = $this->Modelproduct->get($item['cod_contable']);
                $order_taxes['taxes'][$i]['nro_registro_sanitario'] = $product['nro_registro_sanitario'];
                $order_taxes['taxes'][$i]['registro_sanitario'] = $product['registro_sanitario'];
                $this->modelLog->generalLog('Prorrateo de impuestos Actualizados');
            }
        }

        return ($this->responseHttp([
            'titleContent' => 'Resumen de Impuestos Liquidación Aduana del Pedido ' .
                      $init_data['order']['nro_pedido'] .
                    ' [ ' . $order['incoterm'] . ' Régimen' .
                    $order['regimen'] .  ' ] Ref. '  . $order['nro_refrendo'] .
                    ' [' . $order['proveedor'] .']',
            'init_data' => $init_data,
            'order_taxes' => $order_taxes,
            'regimen' => 'R10',
            'title' => 'Impuestos' . $order['nro_pedido'],
            'order' => $order,
            'url_sgi' => $GLOBALS['selected_enterprise']['sgi_url'],
            'vue_app' => true,
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
    public function actualizar() {
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

        $this->load->library('Rest');
        $rest = new Rest();

        if ($rest->_getRequestMethod() != 'POST'){
            print("acceso no permitido");
            $this->modelLog->warningLog('Accediendo directamente a un metodo ajax');
            return False;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        $order = $data['complete_liquidation_data'];
        $my_order = $this->modelOrder->get($order['nro_pedido']);

        if ($my_order == false){
            $this->modelLog->warningLog('El peido no existe');
            return($this->rest->_reponseHttp('El pedido no existe', 500));
        }elseif( $my_order['bg_isliquidated'] ==  1 ){
            return($this->rest->_reponseHttp('pedido ya liquidado', 500));
        }

        $order['bg_isliquidated'] = 1;
        $order['fecha_liquidacion'] = date('Y-m-d', strtotime($order['fecha_liquidacion']));
        foreach ($data['liquidations_items'] as $item){
            if($this->ModelOrderInvoiceDetail->update(
                array (
                    'detalle_pedido_factura' => $item['id_registro'],
                    'ice_advalorem_pagado' => $item['ice_advalorem'],
                    'ice_advalorem_unitario' => ($item['ice_advalorem']/$item['unidades']),
                    'ice_unitario' => (($item['ice_advalorem']/$item['unidades']) + $item['ice_especifico_unitario']),
                    'total_ice' => ($item['ice_advalorem'] + $item['ice_especifico']),
                )
                ) == false){
                    $this->modelLog->warningLog('No es posible actualizar un item');
                    return $rest->_responseHttp('No es posible actualizar un item', 500);
                }
        }

        if($this->modelOrder->update($order)){
            return $rest->_responseHttp('Actualizado correctamente', 200);
        }
        return $rest->_responseHttp('No es posible actualizar el parcial', 500);
     }


     /**
      * Liquidar iva parcial
      * Retorna la informacion completa de las liquidaciones de la SENAE
      * tabnto por item como el global de la liquidacion
      *
      * @param complete_liquidation_data [Dict]
      * contiene la informacion de la liquidacion y de el desglose de la DAI
      * para los tributos.
      *
      */
    public function liquidarIvaParcial(){
        $this->load->library('Rest');
        $rest = new Rest();

        if ($rest->_getRequestMethod() != 'POST'){
            print("acceso no permitido");
            $this->modelLog->warningLog('Accediendo directamente a un metodo ajax');
            return False;
        }

        $data = json_decode(file_get_contents("php://input"), true);
        $parcial = $data['complete_liquidation_data'];
        $my_parcial = $this->modelParcial->get($parcial['id_parcial']);

        if ($my_parcial == false){
            $this->modelLog->warningLog('El parcial no existe');
            return($this->rest->_reponseHttp('El parcial no existe', 500));
        }elseif( $my_parcial['bg_isliquidated'] ==  1 ){
            return($this->rest->_reponseHttp('parcial ya liquidado', 500));
        }

        $parcial['bg_isliquidated'] = 1;
        $parcial['fecha_liquidacion'] = date('Y-m-d', strtotime($parcial['fecha_liquidacion']));
        foreach ($data['liquidations_items'] as $item){
            if($this->modelInfoInvoiceDetail->update(
            array (
                'id_factura_informativa_detalle' => $item['id_registro'],
                'ice_advalorem_pagado' => $item['ice_advalorem'],
                'ice_advalorem_unitario' => ($item['ice_advalorem']/$item['unidades']),
                'ice_unitario' => (($item['ice_advalorem']/$item['unidades']) + $item['ice_especifico_unitario']),
                'total_ice' => ($item['ice_advalorem'] + $item['ice_especifico']),
            )
            ) == false){
                $this->modelLog->warningLog('No es posible actualizar un item');
                return $rest->_responseHttp('No es posible actualizar un item', 500);
            }
        }

        if($this->modelParcial->update($parcial)){
            return $rest->_responseHttp('Actualizado correctamente', 200);
        }
            return $rest->_responseHttp('No es posible actualizar el parcial', 500);
     }

     /**
      * Saca a un pedido de la liquidacion final
      *
      * @param  string $tipo tipo de registro
      * @param  string $id   idetificacion del registro a modificar
      * @return null       Retorna a los gastos del parcial del pedido uniciales
      */
     public function reverso(string $tipo, string $id){

        if($tipo == 'pd'){
            $order = $this->modelOrder->get($id);
            if($order && $order['bg_isclosed'] == 0){
                $order['last_update'] = date('Y-m-d');
                $order['bg_isliquidated'] = 0;
                if($this->modelOrder->update($order)){
                    return  $this->redirectPage('showTaxesOrder', $id);
                }
            }
        }elseif($tipo == 'pc'){
            $parcial = $this->modelParcial->get($id);
            if($parcial && $parcial['bg_isclosed'] == 0){
                $parcial['last_update'] = date('Y-m-d');
                $parcial['bg_isliquidated'] = 0;
                if($this->modelParcial->update($parcial)){
                    return $this->redirectPage('showTaxesParcial', $id);
                };
            }
            print('Parcial cerrado no se puede cambiar');
        }

        $this->modelLog->errorLog( 'Acceso restringido al sitio',current_url());
        $this->modelLog->errorLog($tipo, $id);
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


    /*
     * Redenderiza la informacion y la envia al navegador
     * @param array $config informacion de la plantilla
     */
    private function responseHttp(array $config)
    {
        return ($this->twig->display($this->template, array_merge($config, [
            'base_url' => base_url(),
            'rute_url' => base_url() . 'index.php/',
            'sgi_url' => $this->sgi_url,
            'controller' => $this->controller,
            'iconTitle' => 'fa-money',
            'enterprise' => $GLOBALS['selected_enterprise'],
            'content' => 'home'
        ])));
    }
}
