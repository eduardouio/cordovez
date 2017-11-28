<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Ingresa y edita los items de las facturas y  el cruce con los pedidos
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Detallefacpago extends \MY_Controller
{
    private $template = "/pages/pageFacturasDetalles.html";
    private $controller = 'detalle_documento_pago';
    private $modelOrder;
    private $modelPaid;
    private $modelUser;
    private $modelExpenses;
     
    /**
     * Se realiza la carga de los modelos necesarios para la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelorder');
        $this->load->model('modelpaid');
        $this->load->model('modeluser');
        $this->load->model('modelexpenses');
        $this->modelOrder = new Modelorder();
        $this->modelPaid = new Modelpaid();
        $this->modelUser = new Modeluser();
        $this->modelExpenses = new Modelexpenses();
        
    }
    
    
    /**
     * Redirecciona a la lista de facturas
     */
    public function index()
    {
        $this->redirectPage('paidsList');
        return true;
    }

    
    /**
     * Presenta el formulario para agregar un nuevo item de factura            
     * @param int $nroDocument
     */
    public function nuevo($nroDocument)
    {
        if(!isset($nroDocument)){
            $this->redirectPage('paidsList');
            return false;
        }
        $document = $this->modelPaid->get($nroDocument);
        if ( $document == false){
            $this->redirectPage('paidsList');
            return false;
        }
        $activeOrders =  $this->modelOrder->getActives();
        $orders = [];

        if(gettype($activeOrders) == 'array'){
            foreach ($activeOrders as $item){
                $orders[$item['nro_pedido']] = $this->modelExpenses->get($item['nro_pedido']);
            }
        }
        $this->responseHttp([
            'titleContent' => 'Justificar Gasto',
            'document' => $this->modelPaid->get($nroDocument),
            'create' => true,
            'activeOrders' => $activeOrders,
            'orders' => json_encode($orders),
            'user' => $this->modelUser->get($document['id_user']),
        ]);
    }
    
    
    /**
     * Se validan las columnas que debe tener la consulta para que no falle
     * @return [array] | [bolean]
     */
    private function validData($data)
    {
        $paramsData = [
            'identificacion_proveedor' => 5,
            'nro_factura' => 1,
            'fecha_emision' => 10,
            'valor' => 2,
            'id_user' => 1,
        ];
        return $this->_checkColumnsData($paramsData, $data);
    }
    
    
    /**
     * Envia el render html al navegador
     * @param $config
     * @return mixed
     */
    private function responseHttp($config)
    {
        $params = [
            'title' => 'Detalle Documentos Pagos',
            'base_url' => base_url(),
            'rute_url' => base_url() . 'index.php/',
            'controller' => $this->controller,
            'iconTitle' => 'fa-file-text',
            'content' => 'home',
            'controller' => $this->controller,  6
        ];
        return $this->twig->display($this->template, 
                                        array_merge($config, $params));
    }
}

