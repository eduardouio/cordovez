<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

    public function __construct()
    {
        parent::__construct();
        $this->init();       
    }
    
    /**
    * Metodo encargado de iniciar las variables de entorno y modelos
    */
    private function init(){
        $this->load->model('Modelorder');
        $this->load->model('Modelinfoinvoice');
        $this->load->model('modelsupplier');
        $this->load->model('modelproduct');
        $this->load->model('modeluser');
        $this->load->model('modelinfoinvoicedetail');
        $this->load->model('modellog');
        $this->load->model('modelorderinvoice');
        $this->load->model('modelorderinvoicedetail');
        $this->modelOrder = new Modelorder();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelSupplier = new Modelsupplier();
        $this->modelProduct = new Modelproduct();
        $this->modelUser = new Modeluser();
        $this->modelInfoInvoiceDetail = new Modelinfoinvoicedetail();
        $this->modelLog = new Modellog();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelOrderInvoiceDetail = new Modelorderinvoicedetail();
    }

    /**
     * Redireccioa a la lista de pedidos, por no tener un identificador
     */
    public function index(){
        $this->redirectPage('ordersList');
        return false;
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
        $order = $this->modelOrder->get($infoInvoice['nro_pedido']);
        return ($this->responseHttp([
            'titleContent' => 'Detalle Factura Informativa [ ' . $infoInvoice['nro_factura_informativa']  . ' ]' . 
                            'Pedido [' . $order['nro_pedido'] .']' ,
            'show_detail' => true,
            'order' => $order,
            'supplier' => $this->modelSupplier->get($infoInvoice['identificacion_proveedor']),
            'infoInvoice' => $infoInvoice,
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
      
      $activeStock = $this->modelOrderInvoiceDetail->getActiveStokProductsByOrder($infoInvoice['nro_pedido']);
      $orderInvoices = $this->modelOrderInvoice->getbyOrder($infoInvoice['nro_pedido']);
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
                            $infoInvoice['nro_pedido'] . ']',
          'create_detail' => true,
          'stockProducts' => $activeStock,
          'orderInvoices' => $orderInvoicesTemp,
          'infoInvoice' => $infoInvoice,
          'order' => $this->modelOrder->get($infoInvoice['nro_pedido']),
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
        $product = $this->modelProduct->get($orderInvoiceDetail['cod_contable']);
        $activeStock = $this->modelOrderInvoiceDetail->getActiveStokProductsByOrder($infoInvoice['nro_pedido']);
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
            $this->modelLog->redirectLog('Acceso Invalido a Validar ' . current_url());
            return($this->index());            
        }
        
        $inputForm = $_POST;
        $idInfoInvoice = $inputForm['id_factura_informativa'];
        $infoInvoice = $this->modelInfoInvoice->get($idInfoInvoice);
        unset($inputForm['id_factura_informativa']);
        $itemsInvoice = array_chunk($inputForm, 3, true);
        $errorInsert = false;
        foreach ($itemsInvoice as $item){
            $myItemInvoice = [];
            foreach ($item as $key => $value){
                $myItemInvoice['id_factura_informativa'] = $idInfoInvoice;
                $myItemInvoice['id_user'] = $this->session->userdata('id_user');
                $itemName = explode('-', $key);
                $myItemInvoice[$itemName[0]] = $value;
            }
            if($this->modelInfoInvoiceDetail->isAlreadyExistItem($myItemInvoice) == false && $myItemInvoice['nro_cajas'] > 0){
                $this->modelInfoInvoiceDetail->create($myItemInvoice);
            }else{
             $this->modelLog->errorLog('No se puede anadir un item dos veces key duplicada o con valor cero ' . current_url());
             $errorInsert = true;
             
            }
        }
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
            $this->modelLog->redirectLog('Acceso Invalido a Actualizar ' . current_url());
            return($this->index());
        }
        $infoInvoiceDetail = $_POST;
        $infoInvoiceDetail['last_update'] = date('Y-m-d H:m:s');
        $infoInvoiceDetail['id_user'] = $this->session->userdata('id_user');
        if($this->modelInfoInvoiceDetail->update($infoInvoiceDetail)){
           $this->modelLog->susessLog('Detalle Factura Informativa Actualizada ' .  current_url());
           return($this->redirectPage('infoInvoiceShow', $infoInvoiceDetail['id_factura_informativa']));
        }else{
           $this->modelLog->errorLog('No se puede actualizar detalle factura infromativa ' . current_url());
           print 'Error con la base de datos';
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


