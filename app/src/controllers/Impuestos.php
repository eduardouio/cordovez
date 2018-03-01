<?php defined('BASEPATH') or exit('No direct script access allowed');

require 'lib/taxesCalc.php';

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
        $this->modelInitExpenses = new Modelinitexpenses();
        $this->modelOrder = new Modelorder();
        $this->ModelOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelSupplier = new Modelsupplier();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelParcial = new Modelparcial();
        $this->modelExpenses = new Modelexpenses();
        $this->modelProduct = new Modelproduct();
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
        $this->modelLog->warningLog('Redirecionamiento desde el controller de impuestos');
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
    public function pc(int $idParcial)
    {
        $parcial = $this->modelParcial->get($idParcial);
        $infoInvoices = $this->modelInfoInvoice->getByParcial($idParcial);
        $order = $this->modelOrder->get($parcial['nro_pedido']);
        
        $parcialParams = [
            'moneda' => '',
            'tipo_cambio' => 1,
            'otros_impuestos' => $parcial['otros'],
            'fondinfa' => $this->getParamTaxes('FODINFA'),
            'ice_especifico' => $this->getParamTaxes('ICE ESPECIFICO'),
            'base_ice_advalorem' => $this->getParamTaxes(
                'BASE ADVALOREM'
                ),
            'etiquetas_fiscales' => $this->getParamTaxes('ETIQUETAS FISCALES'),
            'iva_param' => $this->getParamTaxes('IVA'),
            'fob_parcial' => 0.0,
            'flete_parcial' => 0.0,
            'seguro_parcial' => 0.0,
            'fodinfa_parcial' => 0.0,
            'val_etiquetas_fiscales' => 0.0,
            
        ];     
        
        if ($parcial == false) {
            $this->modelLog->errorLog('No Existe El parcial para nacionalizar');
            return $this->index();
        }
                
        foreach ($infoInvoices as $index => $invoice) {
            if($parcialParams['moneda'] == ''){
                $parcialParams['moneda'] = $invoice['moneda'];
                $parcialParams['tipo_cambio'] = $invoice['tipo_cambio'];
            }
            
            $invoice['products'] = $this->modelInfoInvoiceDetail->
                                getCompleteDetail(
                                               $invoice['id_factura_informativa']
                                                  );
            
            foreach ($invoice['products'] as $item => $row) {
                
                $cifItem = $this->getValueParcial(
                    $row['nro_cajas'] *
                    $row['cantidad_x_caja'],
                    $row['id_factura_informativa_detalle'],
                    $invoice
                    );
                                
                $taxes = new productTaxes([
                    'unidades' => $row['nro_cajas'] * $row['cantidad_x_caja'],
                    'etiquetas' => $this->getParamTaxes('ETIQUETAS FISCALES'),
                    'grado_alcolico' => $row['grado_alcoholico'],
                    'fondinfa' => $this->getParamTaxes('FODINFA'),
                    'ice_especifico' => $this->getParamTaxes('ICE ESPECIFICO'),
                    'base_ice_advalorem' => $this->getParamTaxes(
                                                                'BASE ADVALOREM'
                                                                ),
                    'iva_param' => $this->getParamTaxes('IVA'),
                    'seguro_value' => $cifItem['seguro_item'], 
                    'flete_value' => $cifItem['flete_item'],
                    'fob_value' => (
                                $cifItem['fob_item'] * $invoice['tipo_cambio']
                                    ),
                    'percent_item' => $cifItem['percent_item'],
                    'otros' => $parcial['otros'],
                    'producto' => $row['nombre'],
                    'capacidad_ml' => $row['capacidad_ml'],
                    'nro_cajas' => $row['nro_cajas'],
                    'costo_caja' => $row['costo_caja'],
                ]);
                
                $invoice['taxes'][$index] = $taxes->getTaxes();
                
                $parcialParams['fob_parcial'] += ($cifItem['fob_item'] * $invoice['tipo_cambio'] );
                $parcialParams['seguro_parcial'] += $cifItem['seguro_item'];
                $parcialParams['flete_parcial'] += $cifItem['flete_item'];
                $parcialParams['val_etiquetas_fiscales'] += $invoice['taxes'][0]['etiquetas_fiscales'];
                $parcialParams['fodinfa_parcial'] += $invoice['taxes'][0]['fodinfa'];
                
            }
            
            $infoInvoices[$index] = $invoice;
        }
        
                
        return ($this->responseHttp([
            'titleContent' => 'Previsualizacion de Impuestos Pedido [' . 
                                $order['nro_pedido'] . '] Parcial [' . 
                                $parcial['id_parcial'] . ']',
            'infoInvoices' => $infoInvoices,
            'order' => $order,
            'parcial' => $parcial,
            'numberInfoInvoices' => count($infoInvoices),
            'paramsParcial' => $parcialParams,
        ]));
    }
    
        
    /**
     * Genera impuestos para R10 de un pedido
     * @param string $nroOrder
     */
    public function pd(string $nroOrder){
        
        $order = $this->modelOrder->get($nroOrder);
        $orderInvoices = $this->modelOrderInvoice->getbyOrder($nroOrder);
        
        $orderParams = [
            'moneda' => '',
            'tipo_cambio' => 1,
            'otros_impuestos' => $order['otros'],
            'fondinfa' => $this->getParamTaxes('FODINFA'),
            'ice_especifico' => $this->getParamTaxes('ICE ESPECIFICO'),
            'base_ice_advalorem' => $this->getParamTaxes(
                'BASE ADVALOREM'
                ),
            'etiquetas_fiscales' => $this->getParamTaxes('ETIQUETAS FISCALES'),
            'iva_param' => $this->getParamTaxes('IVA'),
            'fob_pedido' => 0.0,
            'flete_pedido' => 0.0,
            'seguro_pedido' => 0.0,
            'fodinfa_pedido' => 0.0,
            'val_etiquetas_fiscales' => 0.0,
            
        ];
        
        if ($order == false) {
            $this->modelLog->errorLog('No Existe El pedido a nacionalizar');
            return $this->index();
        }
        
        foreach ($orderInvoices as $index => $invoice) {
            if($orderParams['moneda'] == ''){
                $orderParams['moneda'] = $invoice['moneda'];
                $orderParams['tipo_cambio'] = $invoice['tipo_cambio'];
            }
            
            $invoice['products'] = $this->ModelOrderInvoiceDetail->
            getCompleteDetail(
                $invoice['id_pedido_factura']
                );
            foreach ($invoice['products'] as $item => $row) {
                $cifItem = $this->getValueOrder(
                    $row['nro_cajas'] *
                    $row['cantidad_x_caja'],
                    $row['detalle_pedido_factura'],
                    $invoice,
                    $order
                    );
                
                $taxes = new productTaxes([
                    'unidades' => $row['nro_cajas'] * $row['cantidad_x_caja'],
                    'etiquetas' => $this->getParamTaxes('ETIQUETAS FISCALES'),
                    'grado_alcolico' => $row['grado_alcoholico'],
                    'fondinfa' => $this->getParamTaxes('FODINFA'),
                    'ice_especifico' => $this->getParamTaxes('ICE ESPECIFICO'),
                    'base_ice_advalorem' => $this->getParamTaxes(
                        'BASE ADVALOREM'
                        ),
                    'iva_param' => $this->getParamTaxes('IVA'),
                    'seguro_value' => $cifItem['seguro_item'],
                    'flete_value' => $cifItem['flete_item'],
                    'fob_value' => (
                        $cifItem['fob_item'] * $invoice['tipo_cambio']
                        ),
                    'percent_item' => $cifItem['percent_item'],
                    'otros' => $order['otros'],
                    'producto' => $row['nombre'],
                    'capacidad_ml' => $row['capacidad_ml'],
                    'nro_cajas' => $row['nro_cajas'],
                    'costo_caja' => $row['costo_caja'],
                ]);
                
                $invoice['taxes'][$index] = $taxes->getTaxes();
            }
            
            $orderInvoices[$index] = $invoice;
        }
        
        
        return ($this->responseHttp([
            'titleContent' => 'Previsualizacion de Impuestos Pedido [' .
            $order['nro_pedido'] ,
            'orderInvoices' => $orderInvoices,
            'order' => $order,
            'regimen' => 'R10',
            'orderParams' => $orderParams,
            'numberInvoices' => count($orderInvoices),
        ]));
    }
    
    
    /**
     * Obtiene el valor que le corresponde al item en la factura informativa
     *
     * @param int $unities
     * @param array $infoInfoice arreglo de toda la factura informariva
     * @param string $concept [flete | seguro | fob]
     * @param array $order orden relaxionado
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
                'percent_item' => 0.0,
            ];
            
            
            foreach($orderInvoice['products'] as $item => $detail){
                if (
                    $detail['detalle_pedido_factura'] == $idOrderInvoiceDetail
                    ){
                        $itemValues['fob_item'] = floatval(
                            $detail['costo_caja'] *
                            $detail['nro_cajas']
                            );
                        $itemValues['percent_item'] = floatval(
                            $itemValues['fob_item'] /
                            $orderInvoice['valor']
                            );
                        $itemValues['flete_item'] = floatval(
                            $order['flete_aduana'] *
                            $itemValues['percent_item']
                            );
                        $itemValues['seguro_item'] = floatval(
                            $order['seguro_aduana'] *
                            $itemValues['percent_item']
                            );
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
        $paramsInfoInvoice = [
            'id_parcial' => $_POST['id_parcial'],
            'tipo_cambio' => $_POST['tipo_cambio']
        ];
        
        $paramsParcial = [
            'id_parcial' => $_POST['id_parcial'],
            'bg_have_etiquetas_fiscales' => 0,
            'observaciones' => $_POST['observaciones'],
            'otros' => $_POST['otros'],
        ];
        
        if (isset($_POST['bg_have_etiquetas_fiscales']) && $_POST['bg_have_etiquetas_fiscales'] == 'on') {
            $paramsParcial['bg_have_etiquetas_fiscales'] = 1;
        }
        
        if ($this->modelParcial->updateLabelsParcial($paramsParcial) && 
            $this->modelInfoInvoice->updateMoney($paramsInfoInvoice)) {
            $this->modelLog->susessLog(
                'Parametros moneda, etiquetas y otros impuestos modificadas'
                );
        } else {
            $this->modelLog->errorLog('Uno de los cambios no se realizo en el parcial o facturas informativas');
        }
        
        return ($this->redirectPage('showTaxesParcial', $_POST['id_parcial']));
    }

    /**
     * Obtiene el valor que le corresponde al item en la factura informativa
     * 
     * @param int $unities
     * @param array $infoInfoice arreglo de toda la factura informariva
     * @param string $concept [flete | seguro | fob]
     * @return float valor del concepto
     */
    private function getValueParcial(   
                                        int $unities, 
                                        int $idInfoInvoiceDetail,
                                        array $infoInfoice 
        
                                    ): array
    {
        $itemValues = [
            'fob_item' => 0.0,
            'seguro_item' => 0.0,
            'flete_item' => 0.0,
            'percent_item' => 0.0,
        ];
        
        foreach($infoInfoice['products'] as $item => $detail){
            if ( 
               $detail['id_factura_informativa_detalle'] == $idInfoInvoiceDetail 
                ){
                $itemValues['fob_item'] = floatval(
                                                 $detail['costo_caja'] *
                                                 $detail['nro_cajas']
                                                 );
                $itemValues['percent_item'] = floatval(
                                                 $itemValues['fob_item'] /
                                                 $infoInfoice['valor']
                                                 );
                $itemValues['flete_item'] = floatval(
                                                 $infoInfoice['flete_aduana'] *
                                                 $itemValues['percent_item']
                                                 );
                $itemValues['seguro_item'] = floatval(
                                                 $infoInfoice['seguro_aduana'] *
                                                 $itemValues['percent_item']
                                                 );
                return $itemValues;
            }
        }
    }
    
    

    /**
     * Retorna un parametr basado en el nombre el impueto
     * 
     * @param string $taxeName
     *            nombre del impuesto
     * @return float valor del impuesto
     */
    private function getParamTaxes(string $taxeName): float
    {   
        foreach ($this->ratesValues as $index => $rate) {
            if ($rate['concepto'] == $taxeName) {
                $this->modelLog->susessLog("Valor para $taxeName " . $rate['valor'] );
                return $rate['valor'];
            }
        }

        $this->modelLog->errorLog("El impuesto  $taxeName solicitado no Existe");
        return false;
    }

    /*
     * Redenderiza la informacion y la envia al navegador
     * @param array $config informacion de la plantilla
     */
    private function responseHttp($config)
    {
        return ($this->twig->display($this->template, array_merge($config, [
            'title' => 'Impuestos',
            'base_url' => base_url(),
            'rute_url' => base_url() . 'index.php/',
            'controller' => $this->controller,
            'iconTitle' => 'fa-money',
            'content' => 'home'
        ])));
    }
}