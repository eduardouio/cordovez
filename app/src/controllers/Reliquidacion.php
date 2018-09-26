<?php
defined('BASEPATH') or exit('No direct script access allowed');

$libraries_url = realpath(dirname(__FILE__));
$libraries_url = str_replace('controllers', 'libraries/', $libraries_url);

require_once ( $libraries_url . 'TaxesCalcR70Reliquidate.php' );
require_once ( $libraries_url . 'TaxesCalcR10Reliquidate.php' );
require_once ( $libraries_url . 'StockOrder.php' );
require_once ( $libraries_url . 'ReportCompleteOrder.php' );
require_once ( $libraries_url . 'MayorOrder.php' );
require_once ( $libraries_url . 'Prorrateos.php' );

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
    private $controller = 'reliquidacion';
    private $template = '/pages/pageReliquidacion.html';
    private $modelOrder;
    private $modelParcial;
    private $modelPaidDetail;
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
    private $modelOrderReport;
    private $modelMayor;
    private $modelStockOrder;
    private $stockOrder;
    

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
        
        $models = [
            'Modelorder',
            'Modelorderinvoicedetail',
            'Modelsupplier',
            'Modelparcial',
            'Modelorderinvoice',
            'Modelexpenses',
            'Modelproduct',
            'Modeluser',
            'Modellog',
            'Modelinfoinvoice',
            'Modelinfoinvoicedetail',
            'Modelinitexpenses',
            'Modelrateexpenses',
            'Modelprorrateo',
            'Modelprorrateodetail',
            'ModelOrderReport',
            'Modelpaiddetail',
            'ModelMayor',
            'ModelStockOrder',
        ];
        
        foreach ($models as $model){
            $this->load->model($model);
        }
        
        $this->modelStockOrder = new ModelStockOrder();
        $this->modelPaidDetail = new Modelpaiddetail();
        $this->modelOrderReport = new ModelOrderReport();
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
        $this->modelMayor = new ModelMayor();
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
               
        $detail_order_invoices = [];
        $detail_info_invoices = [];
        
        $order_invoices = $this->modelOrderInvoice->getCompleteInvoiceByOrder($parcial['nro_pedido']);
        
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
        
        $stock_order = new StockOrder(
            $init_data['order'],
            $detail_order_invoices,
            $detail_info_invoices
            );
                
        $prorrateoLib = new Prorrateos($init_data, $stock_order->getCurrentOrderStock());        
        $prorrateo_values = $prorrateoLib->getValues();
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
        
        $product_taxes = $parcialTaxes->getTaxes();
        
        #actualizamos los productos de la lista de la factura del pedido
        #solo si el parcial no ha cerrado
        if ($parcial['bg_isclosed'] == 0){
            foreach ($product_taxes['taxes'] as $idx => $tax_product){

                $product = [
                    'id_factura_informativa_detalle' => $tax_product['id_factura_informativa_detalle'],
                    'product' => $tax_product['product'],
                    'cod_contable' => $tax_product['cod_contable'],
                    'nro_factura_informativa' => $tax_product['nro_factura_informativa'],
                    'id_factura_informativa_detalle' => $tax_product['id_factura_informativa_detalle'],
                    'detalle_pedido_factura' => $tax_product['detalle_pedido_factura'],
                    'cantidad_x_caja' => $tax_product['cantidad_x_caja'],
                    'cajas_importadas' => $tax_product['cajas_importadas'],
                    'unidades_importadas' => $tax_product['unidades_importadas'],
                    'unidades' => $tax_product['unidades'],
                    'costo_caja' => $tax_product['costo_caja'],
                    'costo_unidad' => $tax_product['costo_unidad'],
                    'peso' => $tax_product['peso'],
                    'capacidad_ml' => $tax_product['capacidad_ml'],
                    'fob' => $tax_product['fob'],
                    'fob_percent' => $tax_product['fob_percent'],
                    'seguro_aduana' => $tax_product['seguro_aduana'],
                    'flete_aduana' => $tax_product['flete_aduana'],
                    'seguro' => $tax_product['seguro'],
                    'flete' => $tax_product['flete'],
                    'gasto_origen' => $tax_product['gasto_origen'],
                    'cif' => $tax_product['cif'],
                    'fecha_liquidacion' => $tax_product['fecha_liquidacion'],
                    'nro_pedido' => $tax_product['nro_pedido'],
                    'id_parcial' => $tax_product['id_parcial'],
                    'otros' => $tax_product['otros'],
                    'prorrateo_parcial' => $tax_product['prorrateo_parcial'],
                    'prorrateo_pedido' => $tax_product['prorrateo_pedido'],
                    'prorrateos_total' => $tax_product['prorrateos_total'],
                    'tasa_control' => $tax_product['tasa_control'],
                    'fodinfa' => $tax_product['fodinfa'],
                    'iva' => $tax_product['iva'],
                    'iva_unidad' => $tax_product['iva_unidad'],
                    'iva_total' => $tax_product['iva_total'],
                    'ex_aduana' => $tax_product['ex_aduana'],
                    'ex_aduana_unitario' => $tax_product['ex_aduana_unitario'],
                    'exaduana_sin_etiquetas' => $tax_product['exaduana_sin_etiquetas'],
                    'exaduana_sin_tasa' => $tax_product['exaduana_sin_tasa'],
                    'base_advalorem' => $tax_product['base_advalorem'],
                    'base_ice_epecifico' => $tax_product['base_ice_epecifico'],
                    'ice_especifico' => $tax_product['ice_especifico'],
                    'ice_especifico_unitario' => $tax_product['ice_especifico_unitario'],
                    'ice_advalorem' => $tax_product['ice_advalorem'],
                    'ice_advalorem_sin_tasa' => $tax_product['ice_advalorem_sin_tasa'],
                    'ice_advalorem_sin_etiquetas' => $tax_product['ice_advalorem_sin_etiquetas'],
                    'ice_advalorem_unitario' => $tax_product['ice_advalorem_unitario'],
                    'arancel_especifico' => $tax_product['arancel_especifico'],
                    'arancel_advalorem' => $tax_product['arancel_advalorem'],
                    'arancel_especifico_unitario' => $tax_product['arancel_especifico_unitario'],
                    'arancel_advalorem_unitario' => $tax_product['arancel_advalorem_unitario'],
                    'arancel_especifico_liberado' => $tax_product['arancel_especifico_liberado'],
                    'arancel_advalorem_liberado' => $tax_product['arancel_advalorem_liberado'],
                    'arancel_especifico_pagar' => $tax_product['arancel_especifico_pagar'],
                    'arancel_advalorem_pagar' => $tax_product['arancel_advalorem_pagar'],
                    'etiquetas_fiscales' => $tax_product['etiquetas_fiscales'],
                    'ice_unitario' => $tax_product['ice_unitario'],
                    'total_ice' => $tax_product['total_ice'],
                    'ice_advalorem_pagado' => $tax_product['ice_advalorem_pagado'],
                    'ice_advalorem_diferencia' => $tax_product['ice_advalorem_diferencia'],
                    'indirectos' => $tax_product['indirectos'],
                    'costo_total' => $tax_product['costo_total'],
                    'costo_caja_final' => $tax_product['costo_caja_final'],
                    'costo_botella' => $tax_product['costo_botella'],
                ];
                
                if($this->modelInfoInvoiceDetail->update($product) == False){
                    print 'Error en el sistema';
                    exit();
                }
            }
        }
        
        $mayor_congelado = sumsMayor(formatMayor($this->modelMayor->get([
            'type' => 'parcial',
            'id' => $parcial['id_parcial']
        ])));
               
        
        $all_parcials = $this->modelParcial->getAllParcials($parcial['nro_pedido']);
        $ordnial_parcial = ordinalNumberParcial($all_parcials, $id_parcial);
        
        return ($this->responseHttp([
            'titleContent' => 'Resumen de Impuestos Liquidación Aduana Parcial ' . 
                                $ordnial_parcial 
                                .  ' del Pedido ' . $init_data['order']['nro_pedido'] . ' R['. $init_data['order']['regimen'] 
                .'] ' . $init_data['order']['incoterm'],
            'init_data' => $init_data,
            'parcial_taxes' => $product_taxes,
            'prorrateos' => $prorrateos,
            'parcial' => $parcial,
            'tipo' => 'parcial',
            'title' => 'Reliquidacion Parcial Pedido [' . $parcial['nro_pedido'] . ']',
            'id' => $parcial['id_parcial'],
            'warenhouses' => $init_data['warenhouses'],
            'bg_have_etiquetas' => 1,
            'mayor' => $this->getMayor($init_data),
            'mayor_congelado' => $mayor_congelado,
            'bg_hava_tasa_control' => 1,
            'regimen' => 'R70',
            'current_date' => date('d-m-Y') ,
            'user_liquidacion' => $this->modelUser->get($parcial['id_user_cierre']),
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
                'El parical aun no ha liquidado los impuestos' .
                ' redireccionando a liquidacion'
                );
            return $this->redirectPage('showTaxesParcial', $id_parcial);
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
        
        $init_expenses = $this->modelInitExpenses->getAll($order);
        
        #eliminamos los gastos de origen porque se prorratean en el FOB
        #foreach ($init_expenses as $idx => $exp){
        #    if($exp['concepto'] == 'GASTO ORIGEN'){
        #        unset($init_expenses[$idx]);
        #    }
        #}

        return([
            'order' => $order,
            'order_invoices' => $order_invoices,
            'order_invoice_detail' => $order_invoice_detail,
            'products_base' => $products_base,
            'init_expenses' => $init_expenses,
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
                'No se puede liquidar un pedido R70'
                );
            return $this->index();
        }
        
        if ($order['bg_isliquidated'] == 0){
            $this->modelLog->warningLog(
                'El pedido que intenta reliquidar está abierto'
                );
            return $this->redirectPage('showTaxesOrder', $nroOrder);
        }

        $init_data = $this->getOrderDataR10($nroOrder);
        $param_taxes = $this->modelRatesExpenses->getTaxesParams();
        
        $orderTaxes =  new orderTaxesReliquidate(
            $init_data,
            $param_taxes,
            $order
            );
        
        $product_taxes = $orderTaxes->getTaxes();
        
        
        
        #actualizamos los productos de la lista de la factura del pedido
        
        if ($order['bg_isclosed'] == 0){
            foreach ($product_taxes['taxes'] as $idx => $tax_product){
                $product = [
                    'detalle_pedido_factura' => $tax_product['detalle_pedido_factura'],  
                    'product'=> $tax_product['product'],
                    'nro_factura_informativa' => 0,
                    'cantidad_x_caja' => $tax_product['cantidad_x_caja'],
                    'cajas_importadas' => $tax_product['cajas_importadas'],
                    'unidades_importadas' => $tax_product['unidades_importadas'],
                    'unidades' => $tax_product['unidades'],
                    'costo_unidad' => $tax_product['costo_unidad'],
                    'capacidad_ml' => $tax_product['capacidad_ml'],
                    'fob' => $tax_product['fob'],
                    'fob_percent' => $tax_product['fob_percent'],
                    'seguro_aduana' => $tax_product['seguro_aduana'],
                    'flete_aduana' => $tax_product['flete_aduana'],
                    'seguro' => $tax_product['seguro'],
                    'flete' => $tax_product['flete'],
                    'gasto_origen' =>$tax_product['gasto_origen'],
                    'cif' =>$tax_product['cif'],
                    'fecha_liquidacion' =>$tax_product['fecha_liquidacion'],
                    'nro_pedido' =>$tax_product['nro_pedido'],
                    'id_parcial' =>0,
                    'tasa_control' => $tax_product['tasa_control'],
                    'otros' =>$tax_product['otros'],
                    'prorrateo_parcial' =>0,
                    'prorrateo_pedido' =>$tax_product['prorrateo_pedido'],
                    'prorrateos_total' =>$tax_product['prorrateos_total'],
                    'tasa_control' =>$tax_product['tasa_control'],
                    'fodinfa' =>$tax_product['fodinfa'],
                    'iva' =>$tax_product['iva'],
                    'iva_unidad' =>$tax_product['iva_unidad'],
                    'iva_total' =>$tax_product['iva_total'],
                    'ex_aduana' =>$tax_product['ex_aduana'],
                    'ex_aduana_unitario' =>$tax_product['ex_aduana_unitario'],
                    'exaduana_sin_etiquetas' =>$tax_product['exaduana_sin_etiquetas'],
                    'exaduana_sin_tasa' =>$tax_product['exaduana_sin_tasa'],
                    'base_advalorem' =>$tax_product['base_advalorem'],
                    'base_ice_epecifico' =>$tax_product['base_ice_epecifico'],
                    'ice_especifico' =>$tax_product['ice_especifico'],
                    'ice_especifico_unitario' =>$tax_product['ice_especifico_unitario'],
                    'ice_advalorem' =>$tax_product['ice_advalorem'],
                    'ice_advalorem_sin_tasa' =>$tax_product['ice_advalorem_sin_tasa'],
                    'ice_advalorem_sin_etiquetas' =>$tax_product['ice_advalorem_sin_etiquetas'],
                    'ice_advalorem_unitario' =>$tax_product['ice_advalorem_unitario'],
                    'arancel_especifico' =>$tax_product['arancel_especifico'],
                    'arancel_advalorem' =>$tax_product['arancel_advalorem'],
                    'arancel_especifico_unitario' =>$tax_product['arancel_especifico_unitario'],
                    'arancel_advalorem_unitario' =>$tax_product['arancel_advalorem_unitario'],
                    'arancel_especifico_liberado' =>$tax_product['arancel_especifico_liberado'],
                    'arancel_advalorem_liberado' =>$tax_product['arancel_advalorem_liberado'],
                    'arancel_especifico_pagar' =>$tax_product['arancel_especifico_pagar'],
                    'arancel_advalorem_pagar' =>$tax_product['arancel_advalorem_pagar'],
                    'etiquetas_fiscales' =>$tax_product['etiquetas_fiscales'],
                    'ice_unitario' =>$tax_product['ice_unitario'],
                    'ice_advalorem_pagado' => $tax_product['ice_advalorem_pagado'],
                    'ice_advalorem_diferencia' => $tax_product['ice_advalorem_diferencia'],
                    'indirectos' => $tax_product['indirectos'],
                    'costo_total' => $tax_product['costo_total'],
                    'costo_caja_final' => $tax_product['costo_caja_final'],
                    'costo_botella' => $tax_product['costo_botella'],
                    'total_ice' =>$tax_product['total_ice'],
                ];
                
                if($this->ModelOrderInvoiceDetail->update($product) == False){
                    print 'Error en el sistema';
                    $this->modelLog->errorLog(
                        'No se se puede modificar la reliquidacion del pedido',
                        $this->db->last_query()
                    );
                    exit();
                }
            }
        }
        
        $mayor_congelado = formatMayor( $this->modelMayor->get(
            ['id' => $order['nro_pedido'] , 'type' => 'order']
            ));
        
        
        
        return ($this->responseHttp([
            'titleContent' => 'Resumen de Reliquidación ICE Pedido ' .
                                $init_data['order']['nro_pedido'] . 
                                ' Regimen : ' . $order['regimen'],
            'init_data' => $init_data,
            'order_taxes' => $product_taxes,
            'title' => 'Reliquidacion Pedido [' . $nroOrder . ']',
            'regimen' => 'R10',
            'tipo' => 'orden',
            'bg_have_etiquetas' => 1,
            'bg_hava_tasa_control' => 1,
            'user_liquidacion' => $this->modelUser->get($order['id_user_cierre']),
            'id' => $nroOrder,
            'current_date' => date('d-m-Y') ,
            'order' => $order,
            'mayor' => $this->getMayor($init_data),
            'mayor_congelado' => sumsMayor($mayor_congelado),
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
     * Conforma el cierre de un pedido o un parcial
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
        $record['notas_cierre'] =  strtoupper($_POST['notas_cierre']);
        
        if($_POST['tipo'] == 'orden'){
            if($this->modelOrder->update($record)){
                $this->modelLog->susessLog('Pedido ' . $_POST['id'] . 'fue cerrrado');               
                $this->closeOrder($_POST['id']);
                
                return $this->redirectPage('showTaxesOrderLiquidate', $_POST['id']);
            }else{
                $this->modelLog->errorLog(
                    'No se puede cerrar el pedido',
                    $this->db->last_query()
                );
                print 'Error con la base de datos';
            }
        }

        if($this->modelParcial->update($record)){
            $this->closeOrder($record['nro_pedido']);
            
            $this->modelLog->susessLog(
                'El parcial ' . $_POST['id'] . ' fue cerrado'
            );

            return $this->redirectPage(
                'showTaxesParcialLiquidate', $_POST['id']
                );
        }else{
            $this->modelLog->errorLog(
                    'No se puede cerrar el parcial',
                    $this->db->last_query()
                );
                print 'Error con la base de datos';
        }
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

        if($parcial['bg_isclosed'] == 1){
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
            $prorrateo['id_prorrateo']
            );
        
        return [
            'prorrateo' => $prorrateo,
            'prorrateo_detail' => $prorrateo_detail,
        ];
    }
    
    
    /**
     * Comprueba si es el ultimo parcual de un pedido, en caso de que lo sea 
     * cierra el pedido
     * 
     * @param  string $nro_order [description]
     * @return boolean             cieerra un pedido si es el ultimo parcial
     */
    public function closeOrder(string $nro_order){
        
        $order = $this->modelOrder->get($nro_order);
        
        if ($order == false) {
            return($this->index());
        }
        
        if(intval($order['bg_isclosed']) == 1 || boolval($order['fecha_'])){
            $this->modelLog->warningLog(
                'El pedido ya esta cerrado, y no se puede cerrar'
                );
            return False;
        }
        
        $params  = $this->modelOrderReport->getOrderData($order);
        $order_report = new ReportCompleteOrder($params);
        $stock = [];
        $detail_order_invoices = [];
        $detail_info_invoices = [];
        
        if($params['order_invoices']){
            foreach ($params['order_invoices'] as $idx => $invoice){
                if($invoice['detail']){
                    foreach ($invoice['detail'] as $k => $v){
                        $v['product'] = $this->modelProducts->get($v['cod_contable']);
                        array_push($detail_order_invoices, $v);
                    }
                }
            }
        }
        
        
        $info_invoices = $this->modelInfoInvoice->getByOrder($nro_order);
        
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
        
        $stock_order = new StockOrder(
            $order,
            $detail_order_invoices,
            $detail_info_invoices
            );
        
        $stock['current'] = $stock_order->getCurrentOrderStock();
                    
        $close = True;
        
        foreach ($stock['current'] as $i => $item){
            if(intval($item['stock']) > 0){
                $close  = False;
            }
        }
        
        if($close){
            $this->modelLog->susessLog('Pedido Cerrado ' . $nro_order);
            return $this->modelOrder->close($nro_order);
        }
        
        $this->modelLog->warningLog(
            'El pedido ' . $nro_order . ' No puede ser cerrado, tiene saldo'
            );
        
        return False;
    
    }
    
    /**
     * Obtiene el cuadre con el moayor contable
     * 
     * @param array $order
     * @return array
     */
    private function getMayor(array $init_data) :array{        
        $order_invoices = $init_data['order_invoices'][0];
        $order_invoices['order_invoice_detail'] = $init_data['order_invoice_detail'];
        $after_parcials = [];
        $current_parcial = [];
        
        if (intval($init_data['order']['regimen']) != 10){
            $current_parcial = $init_data['parcial'];
            $current_parcial['info_invoices'] = $this->modelInfoInvoice->getByParcial($current_parcial['id_parcial']);
            $current_parcial['expenses'] = $this->modelExpenses->getByParcial($current_parcial['id_parcial']);
            $current_parcial['prorrateos'] = $this->modelProrrateoDetail->getProrrateoFromParcial($current_parcial['id_parcial']);
            
            foreach ($init_data['all_parcials'] as $k => $parcial){
                if($parcial['id_parcial'] == $current_parcial['id_parcial']){
                    break;
                }
                
                array_push($after_parcials, $parcial);
            }
            
            #recuperamos los gastos y facturas informativas del los parciales
            if($after_parcials){
                foreach ($after_parcials as $k => $par){
                    $after_parcials[$k]['info_invoices'] = $this->modelInfoInvoice->getByParcial($par['id_parcial']);
                    $after_parcials[$k]['expenses'] = $this->modelExpenses->getByParcial($par['id_parcial']);
                    $after_parcials[$k]['prorrateos'] = $this->modelProrrateoDetail->getProrrateoFromParcial($par['id_parcial']);
                }
            }
            
            array_push($after_parcials, $current_parcial);
            
        }
                       
        #adjuntamos las facturas a los GI
        foreach ($init_data['init_expenses'] as $k => $iexp){
            $init_data['init_expenses'][$k]['paids'] = $this->modelPaidDetail->getByExpense($iexp['id_gastos_nacionalizacion']);
        }
        
        $mayor = new MayorOrder(
            $init_data['order'], 
            $order_invoices, 
            $init_data['init_expenses'], 
            $after_parcials
            );
        
        $mayor = $mayor->get();        
        
        #Actualizamos para el parcial sino para el pedido 
        if($current_parcial){
            if(intval($current_parcial['bg_isclosed']) == 0){
                $this->modelMayor->putMayor(
                    $mayor, 
                    ['type' => 'parcial' , 'id' => $current_parcial['id_parcial']]
                    );                
            }
        }else{
            if(intval($init_data['order']['bg_isclosed']) == 0){
                $this->modelMayor->putMayor(
                    $mayor,
                    ['type' => 'order' , 'id' => $init_data['order']['nro_pedido']]
                    );
            }
        }
        
        return sumsMayor($mayor);
       
    }

    
    /*
     * Redenderiza la informacion y la envia al navegador
     * @param array $config informacion de la plantilla
     */
    private function responseHttp($config)
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