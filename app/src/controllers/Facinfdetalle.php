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
        $order = $this->modelOrder->get($infoInvoice['nro_pedido']);
        return ($this->responseHttp([
            'titleContent' => 'Detalle Factura Informativa [ ' . $infoInvoice['nro_factura_informativa']  . ' ]' . 
                            'Pedido [' . $order['nro_pedido'] .']' ,
            'show_detail' => true,
            'order' => $order,
            'supplier' => $this->modelSupplier->get($infoInvoice['identificacion_proveedor']),
            'infoInvoice' => $infoInvoice,
            'invoiceDetail' => $infoInvoiceDetail,
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
      $activeStock = $this->modelOrderInvoiceDetail->getAllActiveStokProductsRegimen(70);
      return($this->responseHttp([
          'titleContent' => 'Agregar Producto en Factura infromativa [' . 
                            $infoInvoice['nro_factura_informativa']. '] del Pedido [' . 
                            $infoInvoice['nro_pedido'] . ']',
          'create_detail' => true,
          'stockProducts' => json_encode($activeStock),
          'infoInvoice' => $infoInvoice,
          'order' => $this->modelOrder->get($infoInvoice['nro_pedido']),
      ]));
        
    }
    
    
     /**
     * Se validan las columnas que debe tener la consulta para que no falle
     * 
     * @return [array] | [bolean]
     */
    private function _validData($data)
    {
        $columnsLen = [
            'id_factura_informativa' => 1,
            'cod_contable' => 20,
            'nro_cajas' => 1,
            'id_user' => 1,
            'grado_alcoholico' => 1,
        ];
        return $this->_checkColumnsData($columnsLen, $data);
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
