<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modulo encargado de manejar los pedidos, CRUD y validaciones
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Pedido extends MY_Controller {
	private $controller = 'pedido';
	private $listPerPage = 10;
	private $template = '/pages/pagePedido.html';
	public $config = array();

	/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	 * Se redicrecciona a la lista de los pedidos
	 */
	public function index(){
		$this->listar();
	}

	/**
	 * Presenta una lista de todos los pedidos
	 */
	public function listar($offset = 0){
		$this->db->order_by('date_create', 'DESC');
		$this->db->limit($this->listPerPage, $offset);
		$resultDb = $this->db->get($this->controller);

		$pages_links = ($this->db->count_all_results($this->controller) /
																								$this->listPerPage);

		if (gettype($pages_links) == 'double') {
			(int)$pages_links = (int)$pages_links + 1;
		};

		$data = $this->dateDiff($resultDb->result_array(), 'fecha_arribo' ,		
																										date_create(date('Y-m-d')));
		$config = [
									'list_orders' => true,
									'list_active' => 'class="active"',
									'orders' => $data,
									'titleContent' => 'Lista de Pedidos',
									'userData' => $this->session->userdata(),
									'pagination' => true,
									'perPage' => $this->listPerPage,
									'pagination_pages' => $pages_links,
									'current_page' => (int)(($offset)/10) + 1,
									'last_page' => (int)(($pages_links - 1) * 10),
									'pagination_url' => base_url() . 'index.php/pedido/listar/',
									];

		$this->responseHttp($config);
	}

	/**
	* Mestra un pedido completo
	*/
	public function presentar($nroOrder){
		if(!$nroOrder){$this->_notAuthorized();}
		#arreglo de datos para la vista
		$data = array(
								'order' => $this->_getDb('nro_pedido', $nroOrder),
								'userData' => $this->session->userdata(),
								'orderInvoices' => $this->_getOrderInvProducts($nroOrder),
								'initialExpenses' => $this->_getInitialExpenses($nroOrder),
								'nationalizations' => $this->_getNationalizations($nroOrder),
								'invoicesInfo' => $this->_getInvoiceInformative($nroOrder)
								);

		#condiciones de cara de plantillas
		$config['show_order'] = true;
		$config['viewData'] = $data;
		$config['list_active'] = 'class="active"';
		$config['createBy'] = $this->getUserDataDb($data['order'][0]['id_user']);
		$config['titleContent'] = 'Detalle De Pedido [ ' . 
																								$data['order'][0]['nro_pedido'] . 
																								']' ;
		$this->responseHttp($config);
	}
	
	/**
	* Muestra el formulario para crear un pedido
	*/
	public function nuevo(){
		$config['new_active'] = 'class="active"';
		$config['create_order'] = true;
		$config['countries'] = $this->_getCountries();
		$config['titleContent'] = 'Registro de nuevo Pedido';
		$config['incoterms'] = json_encode($this->_getDb('1','1', 
																												'incoterm_provision'));
		$this->responseHttp($config);
	}

	/**
	* Muestra el formulario de edicion 
	*/
	public function editar($nroOrder){
		$this->db->where('nro_pedido', $nroOrder);
		$resultDb = $this->db->get($this->controller);
		$config['edit_order'] = true;
		$config['order'] = $resultDb->result_array();
		$config['incoterms'] = json_encode($this->_getDb('1','1', 
																												'incoterm_provision'));
		$config['titleContent'] = 'Se Encuentra Editando El Pedido &nbsp &nbsp <b>'. 
																														$nroOrder . '</b>' ;
		$this->responseHttp($config);
	}

	/**
	 * elimina un pedido de la tabla, solo lo elimina sino tiene parciales
	 */
	public function eliminar($nroOrder){
		$this->db->where('nro_pedido', $nroOrder);
		if ($this->db->delete($this->controller)){
			$config['order'] = $nroOrder;
			$config['viewMessage'] = true;
			$config['deleted'] = true;
			$config['message'] = 'El Pedido fue eliminado Exitosamente!';
			$this->responseHttp($config);
		}else{
			$config['order'] = $nroOrder;
			$config['viewMessage'] = true;
			$config['message'] = 'El pedido no puede ser Eliminado, 
																												 tiene dependencias!';
			$this->responseHttp($config);
		}
	}

   /**
	 * crea y/o modifica un pedido
	 * @return JSON (response)
	 */
	public function validar(){
		if($this->rest->_getRequestMethod()!= 'POST'){
			$this->listar();
		}

		$pedido = $this->input->post();
		$pedido['id_user'] = $this->session->userdata('id_user');

		if(!isset($pedido['id_pedido'])){
			if((int)$pedido['n_pedido'] < 100 && (int)$pedido['n_pedido'] > 9 ){
					$pedido['n_pedido'] = '0' . $pedido['n_pedido'];
				}elseif((int)$pedido['n_pedido'] < 9 ){
					$pedido['n_pedido'] = '00' . $pedido['n_pedido'];
				}
		 
				$pedido['nro_pedido'] =  $pedido['n_pedido']. '-'. $pedido['y_pedido'];
				unset($pedido['n_pedido']);
				unset($pedido['y_pedido']);

				$this->db->where('nro_pedido',$pedido['nro_pedido']);
				$resultDb = $this->db->get($this->controller);

				if($resultDb->num_rows() == 1 ){		
					$config['order'] = $pedido['nro_pedido'];
					$config['viewMessage'] = true;
					$config['message'] = 'El pedido ya existe!';
					$this->responseHttp($config);
					return true;
				}	
		}

		$status = $this->_validData($pedido);
			if ($status['status']){
				if (!isset($pedido['id_pedido'])){
					$pedido['fecha_arribo'] = date('Y-m-d' ,
																						strtotime($pedido['fecha_arribo']));
					$this->db->insert($this->controller, $pedido);
					$this->_setinitialExpenses($pedido);
					$this->presentar($pedido['nro_pedido']);
					return true;
				}else{
					$pedido['last_update'] = date('Y-m-d H:i:s');
					$pedido['fecha_arribo'] = date('Y-m-d' ,
																						strtotime($pedido['fecha_arribo']));
					$this->db->where('nro_pedido', $pedido['nro_pedido']);
					$this->db->update($this->controller, $pedido);
					$this->presentar($pedido['nro_pedido']);
					return true;
				}
		}else{
			$config['order'] = $pedido['nro_pedido'];
			$config['viewMessage'] = true;
			$config['message'] = 'La información de uno de los campos es incorrecta!';
			$config['data'] = $status['columns'];
			$this->responseHttp($config);
			return true;
		}
	}

		/**
		 * se validan los datos que deben estar para que la consulta no falle
		 * @return [array] | [bolean]
		 */
		private function _validData($pedido){
			$columnsLen = array(
				'nro_pedido' => 6,
				'regimen' => 2,
				'incoterm' => 1,
				'pais_origen' => 1,
				'ciudad_origen' => 1,			
				'flete_aduana' => 1,
				'nro_refrendo' => 1,
				'seguro_aduana' => 1,
				'id_user' => 1,
			);
			return $this->_checkColumnsData($columnsLen, $pedido);
		}

	
	/**
	* Obtiene el detalle de facturas y sus items de un pedido
	* @param (str) $orderId
	* @return (array) result array
	*/
	private function _getOrderInvProducts($orderId){
		$orders = $this->_getDb('nro_pedido' , $orderId , 'pedidoFacturaView');
		if(!$orders) { return false;}
		
		$ordersDetail = array();
		foreach ($orders as $key => $value) {
			$ordersDetail[$key] = $value;
			$ordersDetail[$key]['orderDetail'] = $this->_getDb('id_pedido_factura' , 
														$value['id_pedido_factura'], 'detallePedidosView');
		}
		return $ordersDetail;
	}
	

	/**
	* Obtiene los gastos iniciales del pedido
	* @param (str) $orderId
	* @return (array) initial Expenses
	*/
	private function _getInitialExpenses($orderId){
		$initialExpenses = $this->_getDb('nro_pedido' , $orderId , 
																												'gastos_iniciales_r70');
		if(!$initialExpenses) { return false;}
		$expensesDetail = array();

		foreach ($initialExpenses as $key => $value) {
			$supplier = $this->_getDb('identificacion_proveedor', 
																						$value['identificacion_proveedor'],
																						'proveedor' );
			$expensesDetail[$key] = $value;
			$expensesDetail[$key]['nombre'] = $supplier[0]['nombre'];
			$expensesDetail[$key]['id_proveedor'] = $supplier[0]['id_proveedor'];

		}
		return $expensesDetail;
	}


	/**
	* Obtiene las nacionalizaciones de un pedido
	* @param (str) $orderId
	* @return (array) resul array() | false
	*/
	private function _getNationalizations($orderId){
		$nationalizations = $this->_getDb('nro_pedido', $orderId , 
																														'nacionalizacion');
		if(!$nationalizations){return false;}

		return $nationalizations;
	}


	/**
	* Obtiene una lista de facturas informativas
	* @param (str) $orderId
	* @return (array) resul array() | false
	*/
	private function _getInvoiceInformative($orderId){
		$infoInvoices = $this->_getDb('nro_pedido',$orderId ,'factura_informativa');
		if(!$infoInvoices){return false;}
		return $infoInvoices;
	}

	/**
	* Obtiene la lista de paises y ciudades de la tabla
	*/
	private function _getCountries(){
		$this->db->select('pais');
		$this->db->group_by('pais');
		$resultDb = $this->db->get('incoterm_provision');
		$countries = $resultDb->result_array();

		foreach ($countries as $key => $value){
			$this->db->select('ciudad');
			$this->db->where('pais' , $value['pais']);
			$this->db->group_by('ciudad');
			$resultDb = $this->db->get('incoterm_provision');
			$countries[$key]['cities'] = $resultDb->result_array();
		}
		return $countries;
	}

		/**
		* Coloca los gastos iniciales de acuerdo al incoterm
		*/
		private function _setinitialExpenses($order){
			$this->db->where('pais', $order['pais_origen']);
			$this->db->where('ciudad', $order['ciudad_origen']);
			$this->db->where('incoterms', $order['incoterm']);
			$resultDb = $this->db->get('incoterm_provision');
			$initExpenses = $resultDb->result_array();

			foreach ($initExpenses as $key => $value) {
				$initGst = array(
											'nro_pedido' => $order['nro_pedido'],
											'identificacion_proveedor' =>  '0000000000000',
											'concepto' => $value['tipo'],
											'valor_provisionado' => $value['tarifa'],
											'comentarios' => 'CREADO AUTOMATICAMENTE',
											'id_user' => $this->session->userdata('id_user'),
											);
				$this->db->insert('gastos_iniciales_r70', $initGst);
			}
		}

		/* *
		* Envia la respuestas html al navegador
		*/
		public function responseHttp($config){
			$config['title'] = 'Pedidos';
			$config['base_url'] = base_url();
			$config['rute_url'] = base_url() . 'index.php/';
			$config['controller'] = $this->controller;
			$config['iconTitle'] = 'fa-cubes';
			$config['content'] = 'home';
			return $this->twig->display($this->template, $config);
		}
}