<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modulo encargado de manejar los pedidos, CRUD y validaciones
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 *
 *
 * var $controller => Nombre del la tabla de la BD
 * var $listPerPage => Nro de registros por pagina
 * var $seguroVal =>  Valor por el que se multiplica FOB + FLETE
 * var $template => ubicacion de la plantilla
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
    private $modelBase;
    private $myModel;
    private $modelUser;

    
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
         $this->load->model('mymodel');
         $this->load->model('modeluser');
         $this->modelOrder = new Modelorder();
         $this->modelSupplier = new Modelsupplier();
         $this->modelProduct = new Modelproduct();
         $this->modelNationalization = new Modelnationalization();
         $this->modelBase = new ModelBase();
         $this->modelInfoInvoice = new Modelinfoinvoice();
         $this->myModel = new Mymodel();
         $this->modelUser = new Modeluser();
     }
     
     
    /**
     * redirecciona a la lista de proveedores
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
     * @param int $offset limite inferior de la lista
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
            (int)$pages_links = (int)$pages_links + 1;
        };
        
        $orderList = [];
        foreach ($orders as $item => $order) {
            $order['invoices'] = $this->modelOrder->getInvoices(
                                                    $order['nro_pedido']
                                                                );
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
            'current_page' => (int)(($offset) / 10) + 1,
            'last_page' => (int)(($pages_links - 1) * 10),
            'pagination_url' => base_url() . 'index.php/pedido/listar/',
        ]);
    }


    /**
     * retorna las estadisticas de los pedidos para la cabecera de la lista
     * @return array   [totalOrders,
     *                  consumeOrders,
     *                  partialOrders,
     *                  ativeOrders
     *                  ]
     */
    private function getStatisticsInfo()
    {
        $orders = $this->modelOrder->getAll();
        $info = [
            'totalOrders' => count($orders),
            'consumeOrders' => 0,
            'partialsOrders' => 0,
            'activeOrders' => 0,
        ];
        foreach ($orders as $key => $order) {
            if ($order['regimen'] == '70') {
                $info['partialsOrders']++;
            } elseif (($order['regimen'] == '10')) {
                $info['consumeOrders']++;
            }
            if ($order['bg_isclosed'] == '0') {
                $info['activeOrders']++;
            }
        }
        #se quita por el pedido cero
        $info['consumeOrders']--;
        $info['totalOrders']--;
        $info['activeOrders']--;
        return $info;
    }
    
    /**
     * Obtiene el tiempo en dias de un pedido en la bodega inicial
     * si el pedido se encuentra nacionalizado o tiene una factura
     * informativa retorna el tiempo que estubo en la bodega inicial
     * @param array $order pedido a evaluar
     * @return int
     */
    private function  getWarenHouseDaysInitial(array $order) : int
    {
        if( gettype($order['fecha_salida_bodega_puerto']) == 'NULL'){
            return (dateDiffInDays($order['fecha_arribo'], 
                                   date('Y-m-d'))
                   );
        }        
        return (dateDiffInDays($order['fecha_arribo'], 
                               $order['fecha_salida_bodega_puerto'])
            );
    }
    
    
    /**
     * Retorna el tiempo de dias por el bodegaje de un pedido.
     * @param array $order arreglo con los detalles de la orden
     * @return int tiempo en dias de almacenaje
     */
    private function getWarenHouseDaysPartials($order) : int{
        if( gettype($order['fecha_salida_almacenera']) == 'NULL'){
            return (dateDiffInDays($order['fecha_ingreso_almacenera'],
                date('Y-m-d'))
                );
        }
        return (dateDiffInDays($order['fecha_ingreso_almacenera'],
                               $order['fecha_salida_almacenera'])
            );
    }


    /**
     * show a complete order information
     * @param string $nroOrder
     * @return void
     */
    public function presentar($nroOrder)
    {
        if (!isset($nroOrder)) {
            $this->redirectPage('ordersList');
        }

        $order = $this->modelOrder->get($nroOrder);
        if ($order == false) {
            $this->redirectPage('orderList');
            return false;
        }
        $order['user'] = $this->modelUser->get($order['id_user']);

        $data = [
            'order' => $order,
            'userData' => $this->session->userdata(),
            'orderInvoices' => $this->myModel->getOrderInvProducts($nroOrder),
            'initialExpenses' => $this->myModel->getInitialExpenses($nroOrder),
            'nationalizations' => $this->myModel->getNationalizations($nroOrder),
            'invoicesInfo' => $this->modelInfoInvoice->getByOrder($nroOrder),
            'boxesOrder' => $this->myModel->getBoxesOrder($nroOrder, $order['regimen']),
            'provisions' => 0, #implementar
            'consolided' => 0, #implementar
        ];
        $this->responseHttp([
            'show_order' => true,
            'viewData' => $data,
            'list_active' => 'class="active"',
            'user' => $this->modelUser->get($data['order']['id_user']),
            'titleContent' => 'Detalle De Pedido [ ' . $nroOrder . ']',
        ]);
    }

    /**
     * Muestra el formulario para crear un pedido
     */
    public function nuevo()
    {
        $config['incoterms'] = json_encode($this->modelBase->get_table([
            'table' => 'tarifa_incoterm',
        ]));
        $config['new_active'] = 'class="active"';
        $config['create_order'] = true;
        $config['countries'] = $this->myModel->getCountries();
        $config['titleContent'] = 'Registro de nuevo Pedido';
        $this->responseHttp($config);
    }

    /**
     * Muestra el formulario de edicion
     */
    public function editar($nroOrder)
    {
        $order = $this->modelBase->get_table([
            'table' => $this->controller,
            'where' => ['nro_pedido' => $nroOrder,],
        ]);
        if ($order == false) {
            $this->redirectPage('ordersList');
            return false;
        }

        $config = [
            'edit_order' => true,
            'order' => $order[0],
            'incoterms' => json_encode($this->modelBase->get_table([
                'table' => 'tarifa_incoterm'
            ])),
            'titleContent' => 'Se Encuentra Editando El Pedido &nbsp &nbsp <b>' .
                $nroOrder . '</b>',
        ];
        $this->responseHttp($config);
    }

    /**
     * elimina un pedido de la tabla, solo lo elimina sino tiene parciales
     */
    public function eliminar($nroOrder)
    {
        $this->db->where('nro_pedido', $nroOrder);
        if ($this->db->delete($this->controller)) {
            $config['order'] = $nroOrder;
            $config['viewMessage'] = true;
            $config['deleted'] = true;
            $config['message'] = 'El Pedido fue eliminado Exitosamente!';
            $this->responseHttp($config);
        } else {
            $config['order'] = $nroOrder;
            $config['viewMessage'] = true;
            $config['message'] = 'El pedido no puede ser Eliminado, 
                             tiene dependencias!';
            $this->responseHttp($config);
        }
    }

    /**
     * crea y/o modifica un pedido
     * @return array (response) JsonSerializable
     */
    public function validar()
    {
        if (!$_POST) {
            $this->redirectPage('ordersList');
        }

        $pedido = $this->input->post();
        $pedido['id_user'] = $this->session->userdata('id_user');
        if ($pedido['fecha_arribo'] == '') {
            unset($pedido['fecha_arribo']);
        } else {
            $pedido['fecha_arribo'] = date('Y-m-d',
                strtotime($pedido['fecha_arribo']));
        }
        if (!isset($pedido['id_pedido'])) {
            if ((int)$pedido['n_pedido'] < 100 && intval($pedido['n_pedido']) > 9) {
                $pedido['n_pedido'] = '0' . intval($pedido['n_pedido']);
            } elseif ((int)$pedido['n_pedido'] < 9) {
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
            if (!isset($pedido['id_pedido'])) {
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
                'data' => $status,
            ];
            $this->responseHttp($config);
            return true;
        }
    }

    /**
     * se validan los datos que deben estar para que la consulta no falle
     * @return [array] | [bolean]
     */
    private function validData($pedido)
    {
        $columnsLen = array(
            'nro_pedido' => 6,
            'regimen' => 2,
            'incoterm' => 1,
            'pais_origen' => 1,
            'ciudad_origen' => 1,
            'nro_refrendo' => 1,
            'id_user' => 1,
        );
        return $this->_checkColumnsData($columnsLen, $pedido);
    }


    /* *
    * Redenderiza la informacion y la envia al navegador
    * @param array $config informacion de la plantilla
    */
    private function responseHttp($config)
    {
        $params = [
            'title' => 'Pedidos',
            'base_url' => base_url(),
            'rute_url' => base_url() . 'index.php/',
            'controller' => $this->controller,
            'iconTitle' => 'fa-cubes',
            'content' => 'home',
        ];
        return $this->twig->display($this->template, array_merge($config, $params));
    }
}