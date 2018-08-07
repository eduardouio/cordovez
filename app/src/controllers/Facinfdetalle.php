<?php
defined('BASEPATH') or exit('No direct script access allowed');

$libraries_url = realpath(dirname(__FILE__));
$libraries_url = str_replace('controllers', 'libraries/', $libraries_url);

require_once ( $libraries_url . 'ReportCompleteOrder.php' );

/**
 * Controller encargado de manejar los items de las facturas informativas
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class Facinfdetalle extends MY_Controller
{
    private $template = 'pages/pageFactutaInformativaDetalle.html';
    private $controller = 'factura_informativa_detalle';
    private $modelOrder;
    private $modelOrderInvoice;
    private $modelOrderInvoiceDetail;
    private $modelInfoInvoice;
    private $modelInfoInvoiceDetail;
    private $modelSupplier;
    private $modelProduct;
    private $modelUser;
    private $modelLog;
    private $modelParcial;
    private $modelOrderReport;

    public function __construct()
    {
        parent::__construct();
        $this->init();       
    }
    
    /**
    * Metodo encargado de iniciar las variables de entorno y modelos
    */
    private function init(){
        if(! isset($this->session->userdata['id_user'])){
            exit(0);
        }
        
        $this->load->model('Modelorder');
        $this->load->model('Modelinfoinvoice');
        $this->load->model('modelsupplier');
        $this->load->model('modelproduct');
        $this->load->model('modeluser');
        $this->load->model('modelinfoinvoicedetail');
        $this->load->model('modellog');
        $this->load->model('modelorderinvoice');
        $this->load->model('modelorderinvoicedetail');
        $this->load->model('modelparcial');
        $this->load->model('ModelOrderReport');
        $this->modelOrderReport = new ModelOrderReport();
        $this->load->helper('utils');
        $this->modelOrder = new Modelorder();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelSupplier = new Modelsupplier();
        $this->modelProduct = new Modelproduct();
        $this->modelUser = new Modeluser();
        $this->modelInfoInvoiceDetail = new Modelinfoinvoicedetail();
        $this->modelLog = new Modellog();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelParcial = new Modelparcial();
    }

    /**
     * Redireccioa a la lista de pedidos, por no tener un identificador
     */
    public function index(){
        $this->modelLog->redirectLog(
            'Redireccionamiento desde FininfDetalle',
            current_url()
            );
        return $this->redirectPage('ordersList');
    }
    
    
    /**
     * Muestra un registro completo para el detalle de una factura informativa
     * @param int $idinfoDetail
     * @return bool | template
     */
    public function presentar($idInfoInvoiceDetail){
        $infoInvoiceDetail = $this->modelInfoInvoiceDetail->get($idInfoInvoiceDetail);
        if ($infoInvoiceDetail == false){
            $this->modelLog->redirectLog($this->controller . ',presentar,' . current_url());
            $this->index();
            return false;
        }
        $infoInvoice = $this->modelInfoInvoice->get($infoInvoiceDetail['id_factura_informativa']);
        $orderInvoiceDetail = $this->modelOrderInvoiceDetail->get($infoInvoiceDetail['detalle_pedido_factura']);
        $parcial = $this->modelParcial->get($infoInvoice['id_parcial']);
        $order = $this->modelOrder->get($parcial['nro_pedido']);
        
        return ($this->responseHttp([
            'titleContent' => 'Detalle Factura Informativa [' . $infoInvoice['nro_factura_informativa']  . '] ' . 
                            'Pedido [' . $order['nro_pedido'] .']' . ' Parcial [' . $parcial['id_parcial'] . ']' ,
            'show_detail' => true,
            'order' => $order,
            'supplier' => $this->modelSupplier->get($infoInvoice['identificacion_proveedor']),
            'infoInvoice' => $infoInvoice,
            'parcial' => $parcial,
            'infoInvoiceDetail' => $infoInvoiceDetail,
            'orderInvoiceDetail' => $orderInvoiceDetail,
            'product' => $this->modelProduct->get($orderInvoiceDetail['cod_contable']),
            'user' => $this->modelUser->get($infoInvoiceDetail['id_user']),
        ]));       
    }
    
    
    /**
     * Muestra el formulario para el registro del detalle de una factura infromativa
     * si no existe redirecciona a la vista de lista de ordenes
     * @param $_Post
     * @return string template
     */
    public function nuevo($idFacInformative)
    {
      $infoInvoice = $this->modelInfoInvoice->get($idFacInformative);
      if($infoInvoice == false){
          $this->modelLog->redirectLog($this->controller . ',nuevo,' . current_url());
          return($this->index());
      }
      $parcial = $this->modelParcial->get($infoInvoice['id_parcial']);
      $activeStock = $this->modelOrderInvoiceDetail->getActiveStokProductsByOrder($parcial['nro_pedido']);
      $orderInvoices = $this->modelOrderInvoice->getbyOrder($parcial['nro_pedido']);
      $orderInvoicesTemp =[];
      foreach ($orderInvoices as $item => $val){
          $val['supplier'] = $this->modelSupplier->get($val['identificacion_proveedor']);
          $val['products'] = [];
          if ($activeStock != false){
          foreach ($activeStock as $index => $product){
              if ($product['id_pedido_factura'] == $val['id_pedido_factura']){
                  array_push($val['products'], $product);
              }
          }
          }
          $orderInvoicesTemp[$item] = $val;
      }
      
      return($this->responseHttp([
          'titleContent' => 'Agregar Producto en Factura infromativa [' . 
                            $infoInvoice['nro_factura_informativa']. '] del Pedido [' . 
                            $parcial['nro_pedido'] . ']',
          'create_detail' => true,
          'stockProducts' => $activeStock,
          'orderInvoices' => $orderInvoicesTemp,
          'infoInvoice' => $infoInvoice,
          'order' => $this->modelOrder->get($parcial['nro_pedido']),
      ]));
    }
    
    
    /**
     * Muestra el formulario para editar un detalle de factura informativa
     * @param int $idInfoInvoiceDetail
     * @return string template
     */
    public function editar(int $idInfoInvoiceDetail){
        $infoInvoiceDetail = $this->modelInfoInvoiceDetail->get($idInfoInvoiceDetail);
        if($infoInvoiceDetail == false){
            $this->modelLog->errorLog('Intenta editar un registro que no existe ' . current_url());
            return($this->index());
        }
        $orderInvoiceDetail = $this->modelOrderInvoiceDetail->get($infoInvoiceDetail['detalle_pedido_factura']);
        $infoInvoice = $this->modelInfoInvoice->get($infoInvoiceDetail['id_factura_informativa']);
        $parcial = $this->modelParcial->get($infoInvoice['id_parcial']);
        $product = $this->modelProduct->get($orderInvoiceDetail['cod_contable']);
        
        $activeStock = $this->modelOrderInvoiceDetail->getActiveStokProductsByOrder($parcial['nro_pedido']);
        $productStock = 0;
        foreach($activeStock as $item => $val){
            if ($val['detalle_pedido_factura'] == $infoInvoiceDetail['detalle_pedido_factura']){
                $productStock = $val['stock'] + $infoInvoiceDetail['nro_cajas'];
            }
        }
        
        return ($this->responseHttp([
            'titleContent' => 'Editar Producto ' . $product['nombre'],
            'edit' => true,
            'product' => $product,
            'orderInvoiceDetail' => $orderInvoiceDetail,
            'productStock' => $productStock,
            'infoInvoiceDetail' => $infoInvoiceDetail,
        ]));
    }
    
    /**
     * Elimina un detalle de la factura inormativa
     * @param int $idInfoInvoiceDetail
     * @return string template
     */
    public function eliminar($idInfoInvoiceDetail)
    {
        $infoInvoiceDetail = $this->modelInfoInvoiceDetail->get($idInfoInvoiceDetail);
        
        if($infoInvoiceDetail == false){
            $this->modelLog->errorLog('El registro que intenta eliminar no existe ' . current_url());            
            return($this->index());
        }
        
        if($this->modelInfoInvoiceDetail->delete($idInfoInvoiceDetail)){
            $this->calcAndUpdateGO($infoInvoiceDetail['id_factura_informativa']);
            $this->redirectPage('infoInvoiceShow', $infoInvoiceDetail['id_factura_informativa']);
        }else{
            print 'No se puede comunicar con la Base de Datos';
        }
    }
    
    /**
     * Valida la informacion enviada por el formulario de detalle factura informativa
     * @param array $_POST arreglo de detalles factura infotmativa
     * @return string tmeplate 
     */
    public function validar()
    {
        if(!$_POST){
            return($this->index());            
        }
        
        $inputForm = $_POST;
        $idInfoInvoice = $inputForm['id_factura_informativa'];
        unset($inputForm['id_factura_informativa']);
        $infoInvoice = $this->modelInfoInvoice->get($idInfoInvoice);
        $itemsInvoice = array_chunk($inputForm, 3, true);       
        
        foreach ($itemsInvoice as $item){
            $myItemInvoice = [];
            foreach ($item as $key => $value){
                $myItemInvoice['id_factura_informativa'] = $idInfoInvoice;
                $myItemInvoice['id_user'] = $this->session->userdata('id_user');
                $itemName = explode('-', $key);
                $myItemInvoice[$itemName[0]] = $value;
            }
            
            $new_item = updateWeigth(
                $this->modelOrderInvoiceDetail->get($myItemInvoice['detalle_pedido_factura']),
                $myItemInvoice
                );
                        
            if($this->modelInfoInvoiceDetail->create($new_item) == false){
             $this->modelLog->errorLog(
                 'No se puede anadir un item en la factura', 
                 current_url()
                 );
            }             
        }
        
        $this->calcAndUpdateGO($idInfoInvoice);
        return($this->redirectPage('infoInvoiceShow', $infoInvoice['id_factura_informativa']));
    }
    
    
    /**
     * Realiza la actualizacion que le llega por post
     * @param $_POST producto a actualizar
     * @return string template 
     */
    public function actualizar()
    {
        if(!$_POST){
            return($this->index());
        }
        
        $infoInvoiceDetail = $_POST;
        $infoInvoiceDetail['last_update'] = date('Y-m-d H:m:s');
        $infoInvoiceDetail['id_user'] = $this->session->userdata('id_user');
        
        
        $new_item = updateWeigth(
            $this->modelOrderInvoiceDetail->get($infoInvoiceDetail['detalle_pedido_factura']),
            $infoInvoiceDetail
            );
        
        if($this->modelInfoInvoiceDetail->update($new_item)){
           $this->modelLog->susessLog('Detalle Factura Informativa Actualizada ' .  current_url());
           #se anade a la funcion el calculo del peso del producto
           $this->calcAndUpdateGO($new_item['id_factura_informativa']);
           

           return($this->redirectPage('infoInvoiceShow', $new_item['id_factura_informativa']));
        }else{
           $this->modelLog->errorLog('No se puede actualizar detalle factura infromativa ' . current_url());
           print 'Error con la base de datos';
        }
    }
    
    
    /**
     * Actualiza el costo de los gastos en origen para un parcial
     * Solo funciona para una sola factura informativa
     * @param int $id_parcial
     */
    private function calcAndUpdateGO(int $id_info_invoice){
        
        $params = [
            'val_parcial' => 0.0,
            'val_total' => 0.0,
            'origin_expenses' => 0.0,
            'parcial_percent' => 0.0,
            'parcial_origen_expenses' => 0.0,
            'money' => '',
        ];
        
        $info_invoice = $this->modelInfoInvoice->get($id_info_invoice);
        $parcial = $this->modelParcial->get($info_invoice['id_parcial']);
        $order = $this->modelOrder->get($parcial['nro_pedido']);
        $order_data = $this->modelOrderReport->getOrderData($order);
        
        $partials = $order_data['partials'];
        $current_parcial = [];
        
        foreach ($partials as $idx => $par){
            if ($par['id_parcial'] == $parcial['id_parcial']){
                $current_parcial = $par;
            }
        }
        
        
        foreach ($current_parcial['info_invoices'] as $idx => $invoice){
            if($invoice['detalle_factura']){
                foreach ($invoice['detalle_factura'] as $k => $v){
                    $params['val_parcial'] += (
                        $v['nro_cajas'] *
                        $this->modelOrderInvoiceDetail->getPriceProduct(
                            $v['detalle_pedido_factura']
                            )
                        );
                }
            }
        }
                    
        foreach ($order_data['order_invoices'] as $idx => $invoice ){
            if($invoice['detail']){
                foreach ($invoice['detail'] as $k => $v){
                    $params['val_total'] += ($v['costo_caja'] * $v['nro_cajas']);
                    
                }
                    $params['origin_expenses'] += $invoice['gasto_origen'];
                    $params['money'] = $invoice['moneda'];
            }
        }
        
        #cuando se sepa como hacer esta liquidacion en moneda extrangera
        # buscar la forma de implementarlo aqui.
        if($order['incoterm'] == 'EXW' || $order['incoterm'] == 'FCA')
        {
            foreach ($order_data['init_expenses'] as $idx => $exp){
                if($exp['concepto'] == 'GASTO ORIGEN'){
                    $params['origin_expenses'] = $exp['valor_provisionado'];
                    break;
                }
            }
        }
        
        
        $params['parcial_percent'] = (
                                        $params['val_parcial'] 
                                        / $params['val_total']
                );
        
        $params['parcial_origen_expenses'] = (
                $params['parcial_percent'] 
                * $params['origin_expenses']
            );
        
        if (count($current_parcial['info_invoices']) == 1){
                $current_info_invoice = $current_parcial['info_invoices'][0]; 
                $current_info_invoice['gasto_origen'] = $params['parcial_origen_expenses'];
                $current_info_invoice['valor'] = $params['val_parcial'];
                $current_info_invoice['moneda'] = $params['money'];
                unset($current_info_invoice['detalle_factura']);
                $this->modelInfoInvoice->update($current_info_invoice);
                return true;
        }else{
            $this->modelLog->errorLog(
                'Los parciales no deben tener mas de una factura informativa',
                current_url()
                );
            print 'Los pariciales al momento solo pueden tener una sola FI';
            exit();
        }
    }
    
    
    /* *
     * Envia la respuestas html al navegador
     * @param array $config Arreglo con info de la plantilla
     * @return template
     */
    private function responseHttp($config){
        $config['base_url'] = base_url();
        $config['title'] = 'Items Factura Informativa';
        $config['rute_url'] = base_url() . 'index.php/';
        $config['controller'] = $this->controller;
        $config['iconTitle'] = 'fa-list';
        $config['content'] = 'home';
        return $this->twig->display($this->template, $config);
    }
}


