<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Modulo encargado de manejar los pedidos, CRUD y validaciones
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource var $controller => Nombre del la tabla de la BD
 *             var $listPerPage => Nro de registros por pagina
 *             var $seguroVal => Valor por el que se multiplica FOB + FLETE
 *             var $template => ubicacion de la plantilla
 *
 */
class Pedido extends MY_Controller
{
    private $controller = 'pedido';
    private $listPerPage = 12;
    private $seguroVal = 2.2;
    private $template = '/pages/pagePedido.html';
    private $modelOrder;
    private $modelSupplier;
    private $modelNationalization;
    private $modelProduct;
    private $modelInfoInvoice;
    private $modelInfoInvoiceDetail;
    private $modelBase;
    private $myModel;
    private $modelLog;
    private $modelUser;
    private $modelProductInvoice;
    private $modelExpenses;
    private $modelOrderInvoice;
    private $modelOrderInvoiceDetail;
    private $modelPaidDetail;
    private $modelParcial;
    
    
    /**
     * constructor de la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    /**
     * Carga e inicia los modelos usados por la clase
     */
    private function init()
    {
        $this->load->model('modelorder');
        $this->load->model('modelsupplier');
        $this->load->model('modelproduct');
        $this->load->model('modelnationalization');
        $this->load->model('modelinfoinvoice');
        $this->load->model('modelinfoinvoicedetail');
        $this->load->model('mymodel');
        $this->load->model('modellog');
        $this->load->model('modeluser');
        $this->load->model('modelexpenses');
        $this->load->model('modelorderinvoice');
        $this->load->model('modelorderinvoicedetail');
        $this->load->model('modelpaiddetail');
        $this->load->model('modelparcial');
        $this->modelOrder = new Modelorder();
        $this->modelSupplier = new Modelsupplier();
        $this->modelProduct = new Modelproduct();
        $this->modelNationalization = new Modelnationalization();
        $this->modelBase = new ModelBase();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelInfoInvoiceDetail = new Modelinfoinvoicedetail();
        $this->myModel = new Mymodel();
        $this->modelLog = new Modellog();
        $this->modelUser = new Modeluser();
        $this->modelExpenses = new Modelexpenses();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelPaidDetail = new Modelpaiddetail();
        $this->modelOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelParcial = new Modelparcial();
    }
    
    /**
     * redirecciona a la lista de proveedores
     *
     * @return void
     */
    public function index()
    {
        $this->redirectPage('ordersList');
        return true;
    }
    
    /**
     * Presenta la lista de los pedidos, y las acciones para cada
     * uno de ellos
     *
     * @param int $offset
     *            limite inferior de la lista
     * @return string template plantilla de la pagina
     */
    public function listar(int $offset = 0)
    {
        $this->db->where('nro_pedido !=', '000-00');
        $this->db->order_by('nro_pedido', 'DESC');
        $this->db->limit($this->listPerPage, $offset);
        $resultDb = $this->db->get($this->controller);
        $orders = $resultDb->result_array();
        $pages_links = (($this->db->count_all($this->controller) - 1) / $this->listPerPage);
        
        if (gettype($pages_links) == 'double') {
            (int) $pages_links = (int) $pages_links + 1;
        }
        $orderList = [];
        foreach ($orders as $item => $order) {
            $order['invoices'] = $this->modelOrder->getInvoices($order['nro_pedido']);
            $order['nationalized'] = $this->modelNationalization->getNationalizedVal($order);
            $order['warenHouseDays'] = $this->getWarenHouseDaysInitial($order);
            $orderList[$item] = $order;
        }
        
        $this->responseHttp([
            'list_orders' => true,
            'list_active' => 'class="active"',
            'orders' => $orderList,
            'titleContent' => 'Lista de Pedidos Cordovez',
            'infoBase' => $this->getStatisticsInfo(),
            'pagination' => true,
            'perPage' => $this->listPerPage,
            'pagination_pages' => $pages_links,
            'current_page' => (int) (($offset) / 10) + 1,
            'last_page' => (int) (($pages_links - 1) * 10),
            'pagination_url' => base_url() . 'index.php/pedido/listar/'
        ]);
    }
    
    /**
     * show a complete order information
     *
     * @param string $nroOrder
     * @return void
     */
    public function presentar($nroOrder)
    {
        if (! isset($nroOrder)) {
            return($this->index());
        }
        $order = $this->modelOrder->get($nroOrder);
        if ($order == false) {
            return($this->index());
        }
        
        $order['user'] = $this->modelUser->get($order['id_user']);
        $order['valuesOrder'] = $this->myModel->getValuesOrder($order);
        $invoicesOrder = $this->modelOrderInvoice->getbyOrder($nroOrder);
        $parcials = $this->modelParcial->getByOrder($nroOrder);
        $initialExpenses = $this->modelExpenses->get($nroOrder);
        $paidsDetails = $this->modelPaidDetail->getByOrder($nroOrder);
        
        if(is_array($parcials)){
            foreach ($parcials as $item => $parcial){
                $quantity = [
                    'boxesInParcial' => 0,
                    'unitiesInParcial' => 0,
                    'totalParcialValue' => 0.0,
                ];
                
                $infoInvoices = $this->modelInfoInvoice->getByParcial($parcial['id_parcial']);
                if (is_array($infoInvoices)){
                    foreach ($infoInvoices as $index => $infoInvoice)
                    {
                        $count = $this->modelInfoInvoiceDetail->countBoxesAnd($infoInvoice['id_factura_informativa']);
                        $quantity['boxesInParcial'] += $count['boxes'];
                        $quantity['unitiesInParcial'] += $count['unities'];
                        $quantity['totalParcialValue'] =+ ($infoInvoice['valor'] * $infoInvoice['tipo_cambio']);
                    }                    
                }
                $parcial['user'] = $this->modelUser->get($parcial['id_user']);
                $parcial['countInfoInvoices'] = count($this->modelInfoInvoice->getByParcial($parcial['id_parcial']));
                $parcial['boxesInParcial'] = $quantity['boxesInParcial'];
                $parcial['unitiesInParcial'] = $quantity['unitiesInParcial'];
                $parcial['totalParcialValue'] = $quantity['totalParcialValue'];
                $parcials[$item] = $parcial;
            }
        }
        
        if (gettype($invoicesOrder) == 'array' && count($invoicesOrder) > 0) {
            $invoicesOrderTemp = [];
            foreach ($invoicesOrder as $item => $value) {
                $value['supplier'] = $this->modelSupplier->get($value['identificacion_proveedor']);
                $invoicesOrderTemp[$item] = $value;
            }
            $invoicesOrder = $invoicesOrderTemp;
        }
        
        if(gettype($initialExpenses) == 'array' && count($initialExpenses) > 0){
            $initialExpensesTemp = [];
            foreach ($initialExpenses as $row => $expense){
                $expense['supplier'] = $this->modelSupplier->get($expense['identificacion_proveedor']);
                $initialExpensesTemp[$row] = $expense;
            }
            $initialExpenses = $initialExpensesTemp;
        }
        
        if(gettype($paidsDetails) == 'array' && count($paidsDetails) > 0){
            $paidsDetailsTemp = [];
            foreach ($paidsDetails as $item => $detail){
                $detail['supplier'] = $this->modelSupplier->get($detail['identificacion_proveedor']);
                $paidsDetailsTemp[$item] = $detail;
            }
            $paidsDetails = $paidsDetailsTemp;
        }
                
        return($this->responseHttp([
            'show_order' => true,
            'order' => $order,
            'ubicacion' => $this->whereIsOrder($order),
            'warenHouseDays' => $this->getWarenHouseDaysInitial($order),
            'orderInvoices' => $invoicesOrder,
            'initialExpenses' => $initialExpenses,
            'paidsDetails' => $paidsDetails,
            'activeStok' => $this->modelOrderInvoiceDetail->getActiveStokProductsByOrder($nroOrder),
            'parcials' => $parcials,
            'sumsValues' => $this->myModel->getValuesOrder($order),
            'list_active' => 'class="active"',
            'titleContent' => 'Detalle De Pedido [ ' . $nroOrder . '] [' . $order['incoterm'] . '] [Regimen ' . $order['regimen'] . ']'
        ]));
    }
    
    
    /**
     * Muestra el formulario para crear un pedido
     */
    public function nuevo()
    {
        return($this->responseHttp([
            'incoterms' => json_encode($this->modelBase->get_table([
                                    'table' => 'tarifa_incoterm'])),
            'titleContent' => 'Registro de nuevo Pedido',
            'countries' => $this->myModel->getCountries(),
            'create_order' => true,
        ]));
    }
    
    /**
     * Muestra el formulario de edicion
     */
    public function editar($nroOrder)
    {
        $order = $this->modelOrder->get($nroOrder);
        if($order == false){
            return($this->listar());
        }
        return($this->responseHttp([
            'edit_order'    => true,
            'order'         => $order,
            'incoterms'     => json_encode($this->modelBase->get_table([
                                                   'table' => 'tarifa_incoterm'
                                ])),
            'titleContent'  => 'Se Encuentra Editando El Pedido [<b>' 
                                                            . $nroOrder . ']</b>',
        ]));
    }
    
    
    /**
     * Actualiza la fecha de entrada a la almacenera de un pedido
     */
    public function ingresoAlmacenera()
    {
        if (! $_POST) {
            $this->redirectPage('ordersList');
        }
        
        $order = $_POST;
        $order['fecha_ingreso_almacenera'] = str_replace('/', '-', $order['fecha_ingreso_almacenera']);
        $order['fecha_ingreso_almacenera'] = date('Y-m-d' , strtotime($order['fecha_ingreso_almacenera']));        
        $order['bg_haveExpenses'] = '1';
        $order['last_update'] = date('Y-m-d H:i:s');
        
        if($this->modelOrder->update($order)){
            $this->modelLog->susessLog('Pedido Actualizado Correctamente');
            
            $idParcial = $this->modelParcial->create([
                'nro_pedido' => $order['nro_pedido'],
                'id_user' => $this->session->userdata('id_user'),
                
            ]);
            
            if($idParcial){
                return($this->redirectPage('infoInvoiceNew' , $idParcial));
            }
        }
        
        $this->modelLog->errorLog(
            'No se peude actualizar el pedido', 
            $this->db->last_query()
            );
        
        return false;
    }
    
    /**
     * elimina un pedido de la tabla, solo lo elimina sino tiene parciales
     */
    public function eliminar($nroOrder)
    {
        if($this->modelOrder->delete($nroOrder)){
            return($this->responseHttp([
                'order' => $nroOrder,
                'viewMessage' => true,
                'deleted' => true,
                'message' => 'El Pedido fue eliminado Exitosamente!',
            ]));
        }else{
            return($this->responseHttp([
                'order' => $nroOrder,
                'viewMessage' => true,
                'message' => 'El pedido no puede ser Eliminado,
                             tiene dependencias!',
            ]));
        }        
    }
    
    /**
     * crea y/o modifica un pedido
     *
     * @return array (response) JsonSerializable
     */
    public function validar()
    {
        if (! $_POST) {
            $this->redirectPage('ordersList');
        }
        
        $pedido = $_POST;
        $pedido['id_user'] = $this->session->userdata('id_user');
        if ($pedido['fecha_arribo'] == '') {
            unset($pedido['fecha_arribo']);
        } else {
            $pedido['fecha_arribo'] = str_replace('/', '-', $pedido['fecha_arribo']); 
            $pedido['fecha_arribo'] = date('Y-m-d', strtotime($pedido['fecha_arribo']));
        }
        if (! isset($pedido['id_pedido'])) {
            if ((int) $pedido['n_pedido'] < 100 && intval($pedido['n_pedido']) > 9) {
                $pedido['n_pedido'] = '0' . intval($pedido['n_pedido']);
            }
            if ((int) $pedido['n_pedido'] < 9) {
                $pedido['n_pedido'] = '00' . intval($pedido['n_pedido']);
            }
            
            $pedido['nro_pedido'] = $pedido['n_pedido'] . '-' . $pedido['y_pedido'];
            unset($pedido['n_pedido']);
            unset($pedido['y_pedido']);
            
            $this->db->where('nro_pedido', $pedido['nro_pedido']);
            $resultDb = $this->db->get($this->controller);
            
            if ($resultDb->num_rows() == 1) {
                $config['order'] = $pedido['nro_pedido'];
                $config['viewMessage'] = true;
                $config['message'] = 'El pedido ya existe!';
                $this->responseHttp($config);
                return true;
            }
        }
        
        $status = $this->validData($pedido);
        if ($status['status']) {
            if (! isset($pedido['id_pedido'])) {
                $this->db->insert($this->controller, $pedido);
                $this->redirectPage('putIncoterms', $pedido['nro_pedido']);
                return true;
            } else {
                $pedido['last_update'] = date('Y-m-d H:i:s');
                $this->db->where('nro_pedido', $pedido['nro_pedido']);
                $this->db->update($this->controller, $pedido);
                $this->redirectPage('replaceIncoterms', $pedido['nro_pedido']);
                return true;
            }
        } else {
            $config = [
                'fail' => true,
                'fields_error' => $status['len'],
                'order' => $pedido['nro_pedido'],
                'viewMessage' => true,
                'fail' => true,
                'message' => 'La información de uno de los campos es incorrecta!',
                'data' => $status
            ];
            $this->responseHttp($config);
            return true;
        }
    }
    
    
    /**
     * retorna las estadisticas de los pedidos para la cabecera de la lista
     *
     * @return array [totalOrders,
     *         consumeOrders,
     *         partialOrders,
     *         ativeOrders
     *         ]
     */
    private function getStatisticsInfo()
    {
        $orders = $this->modelOrder->getAll();
        $info = [
            'totalOrders' => count($orders),
            'consumeOrders' => 0,
            'partialsOrders' => 0,
            'activeOrders' => 0
        ];
        foreach ($orders as $key => $order) {
            if ($order['regimen'] == '70') {
                $info['partialsOrders'] ++;
            } elseif (($order['regimen'] == '10')) {
                $info['consumeOrders'] ++;
            }
            if ($order['bg_isclosed'] == '0') {
                $info['activeOrders'] ++;
            }
        }
        // se quita por el pedido cero
        $info['consumeOrders'] --;
        $info['totalOrders'] --;
        $info['activeOrders'] --;
        return $info;
    }
    
    
    
    /**
     * Retorna un arreglo indicando el lugar donde se encuentra el pedido
     * barco
     * bodega puerto
     * almacenera
     * u cordovez
     * @param string $nroOrder
     * @return array
     */
    private function whereIsOrder(array $order):array
    {
        $localtions = [
            'buque' => false,
            'puerto' => false,
            'almacenera' => false,
            'cordovez' => false,
        ];
           
        if($order['fecha_arribo'] == null){
                $localtions['buque'] = 'active';
                return $localtions;
        }  
        
        if( 
            ($order['fecha_arribo'] != null) &&
            ($order['fecha_salida_bodega_puerto'] == null)
            ){
                $localtions['puerto'] = 'active';
                return $localtions;
        }
        
        if( 
            ($order['fecha_arribo'] != null) &&
            ($order['fecha_salida_bodega_puerto'] != null) &&
            ($order['fecha_ingreso_almacenera'] == null) &&
            ($order['regimen'] == 70)            
            ){
                $localtions['transporte'] = 'active';
                return $localtions;
        }
        
        if( 
            ($order['fecha_arribo'] != null) &&
            ($order['fecha_ingreso_almacenera'] != null) &&
            ($order['fecha_salida_almacenera'] == null)&&
            ($order['regimen'] == 70)
            ){
                $localtions['almacenera'] = 'active';
                return $localtions;
        }
        
        if( ($order['fecha_arribo'] != null) &&
            ($order['fecha_salida_bodega_puerto'] != null) &&
            ($order['fecha_ingreso_almacenera'] != null) &&
            ($order['fecha_salida_almacenera'] != null)&&
            ($order['regimen'] == 70)
            ){
                $localtions['cordovez'] = 'active';
                return $localtions;
        }
        
        if( ($order['fecha_arribo'] != null) &&
            ($order['fecha_salida_bodega_puerto'] != null) &&
            ($order['regimen'] == 10)
            ){
                $localtions['cordovez'] = 'active';
                return $localtions;
        }
        return $localtions;
    }
    
    
    /**
     * se validan los datos que deben estar para que la consulta no falle
     *
     * @return [array] | [bolean]
     */
    private function validData($pedido)
    {
        return ($this->_checkColumnsData([
            'nro_pedido' => 6,
            'regimen' => 2,
            'incoterm' => 1,
            'pais_origen' => 1,
            'ciudad_origen' => 1,
            'nro_refrendo' => 1,
            'id_user' => 1
        ], $pedido));
    }
    
    /*
     * Redenderiza la informacion y la envia al navegador
     * @param array $config informacion de la plantilla
     */
    private function responseHttp($config)
    {
        return(
            $this->twig->display($this->template, array_merge($config,[
                'title' => 'Pedidos',
                'base_url' => base_url(),
                'rute_url' => base_url() . 'index.php/',
                'controller' => $this->controller,
                'iconTitle' => 'fa-cubes',
                'content' => 'home']))
            );
    }
}
