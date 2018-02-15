<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

class Impuestosparcial extends MY_Controller
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
        $this->ratesValues =  $this->modelRatesExpenses->getParcialRates();
        
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
     * @param int $idParcial
     * @retunr arrat template
     */
    public function v(int $idParcial)
    {
        $parcial = $this->modelParcial->get($idParcial);        
        $infoInvoices =  $this->modelInfoInvoice->getByParcial($idParcial);
        $order = $this->modelOrder->get($parcial['nro_pedido']);
        
        if($parcial == false){
            $this->modelLog->errorLog('No Existe El parcial para nacionalizar');
            return $this->index();
        }
        
        $params = $this->getParamsParcial($parcial, $order);
        $params['etiquetas_fiscales'] = 0.0;
        
        $moneyOrder = [
            'moneda' => '',
            'tipo_cambio' => 0.0,
        ];
        
        foreach ($infoInvoices as $index => $invoice){
            if($index == 0){
                $moneyOrder['moneda'] = $invoice['moneda'];
                $moneyOrder['tipo_cambio'] = floatval($invoice['tipo_cambio']);
            }
            $invoice['products'] = $this->modelInfoInvoiceDetail->
                           getCompleteDetail($invoice['id_factura_informativa']);
            
            foreach ($invoice['products'] as $item => $row){
                $params['etiquetas_fiscales'] += 
                            ($this->ratesValues['ETIQUETAS FISCALES']  * $row['nro_cajas'] * 
                                                    $row['cantidad_x_caja']);                   
            }
            
            $infoInvoices[$index] = $invoice;
            if($parcial['bg_have_etiquetas_fiscales'] == 0){
                $params['etiquetas_fiscales'] = 0.0;
            }
        }
        
       return( $this->responseHttp([
            'titleContent' => 'Previsualizacion de Impuestos Pedido [' . 
                                $order['nro_pedido'] . '] Parcial [' . 
                                $parcial['id_parcial'] . ']' ,
            'infoInvoices' => $infoInvoices,
            'order' => $order,
            'parcial' => $parcial,
            'numberInfoInvoices' => count($infoInvoices),
            'params' => $params,
            'moneyOrder' => $moneyOrder,
        ]));
    }
    
    
    
    /**
     * Actualiza los parametros de calculo de impuestos para el Parcial
     * @param $tipo_cambio float 
     * @param $etiquetas_fiscales boolean
     * @return string redirect
     */
    public function actualizar()
    {
        $paramsInfoInvoice = [
            'id_parcial' => $_POST['id_parcial'],
            'tipo_cambio' => $_POST['tipo_cambio'],
        ];
        
        $paramsParcial = [
            'id_parcial' => $_POST['id_parcial'],
            'bg_have_etiquetas_fiscales' => 0,
        ];
        
        if(
            isset($_POST['bg_have_etiquetas_fiscales']) && 
                 $_POST['bg_have_etiquetas_fiscales'] == 'on'
          ){
          $paramsParcial['bg_have_etiquetas_fiscales'] = 1;  
        }
        
        if (
            $this->modelParcial->updateLabelsParcial($paramsParcial)
            &&
            $this->modelInfoInvoice->updateMoney($paramsInfoInvoice)
            ){
              $this->modelLog->susessLog(
                                  'Parametros moneda y etiquetas modificadas');
        }else{            
            $this->modelLog->errorLog(
            'Uno de los cambios no se realizo en el parcial o facturas informativas'
                );
        }
        
        return ($this->redirectPage('showTaxesParcial', $_POST['id_parcial']));
    }
        
    
    /**
     * Retorna los parametros de nacionalizacion de un parcial
     * @param array $order
     * @param array $parcial 
     * @return array $params [
     *                          incoterm => float, 
     *                          seguro => float, 
     *                          flete => float, 
     *                          ];
     */
    private function getParamsParcial(array $parcial, array $order):array
    {

        $infoInvoices = $this->modelInfoInvoice->getByParcial(
                                                        $parcial['id_parcial']
                                                            );
        
        $expenses = [
            'incoterm' => $order['incoterm'],
            'seguro_aduana' => 0.0,
            'flete_aduana' => 0.0,
            'fob' => 0.0,
        ];
        
        foreach ($infoInvoices as $item => $invoice){
            $expenses['seguro_aduana'] += $invoice['seguro_aduana'];
            $expenses['flete_aduana'] += $invoice['flete_aduana'];
            $expenses['fob'] += $invoice['valor'];
        }
        
        return $expenses;
        
    }
    
   
    
    /*
     * Redenderiza la informacion y la envia al navegador
     * @param array $config informacion de la plantilla
     */
    private function responseHttp($config)
    {
        return(
            $this->twig->display($this->template, array_merge($config,[
                'title' => 'Impuestos',
                'base_url' => base_url(),
                'rute_url' => base_url() . 'index.php/',
                'controller' => $this->controller,
                'iconTitle' => 'fa-money',
                'content' => 'home']))
            );
    }
    
    
}

