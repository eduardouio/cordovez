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
class Pedido extends MY_Controller {
	private $controller = 'pedido';
	private $listPerPage = 15;
	private $seguroVal = 2.2;
	private $template = '/pages/pagePedido.html';

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
	public function listar(int $offset = 0){
		$this->db->where('nro_pedido !=', '000-00');
		$this->db->order_by('nro_pedido', 'DESC');
		$this->db->limit($this->listPerPage, $offset);
		$resultDb = $this->db->get($this->controller);

		$pages_links = ($this->db->count_all_results($this->controller) /
																								$this->listPerPage);
		if (gettype($pages_links) == 'double') {
			(int)$pages_links = (int)$pages_links + 1;
		};
		$data = $this->dateDiff($resultDb->result_array(), 
														'fecha_arribo' , 
														date_create(date('Y-m-d'))
													);
		$resumData = [];
		foreach ($data as $item => $order) {
		 $order['resumValues'] =  $this->mymodel->getValues($order);
		 $resumData[$item] = $order;
		}
		$config = [
									'list_orders' => true,
									'list_active' => 'class="active"',
									'orders' => $resumData,
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
		if(!isset($nroOrder)){
			$this->redirectPage('ordersList');
		}
		
		$myOrder = $this->modelbase->get_table([
															'table' => $this->controller,
															'where' => ['nro_pedido' => $nroOrder]
																				]);
		$orderData = $this->dateDiff($myOrder, 'fecha_arribo', 
																										date_create(date('Y-m-d')));

		$valuesSums = $this->mymodel->getValues($orderData[0]);
		$provisions = $this->modelbase->get_table([
																				'select' => [
																							'sum(\'*\') as provisions',
																						],
																				'table' => 'gastos_nacionalizacion',
																				'where' => [
																						'nro_pedido' => $nroOrder,
																									],
																				]);

		$resultDbAux = $this->db->query('call sp_calcConsolidated(' . 
																													$nroOrder .')');	
		$consolided = $resultDbAux->result_array();
		$this->db->close();
		$data = [
			'order' => $orderData[0],
			'valuesSums' => $valuesSums,
			'userData' => $this->session->userdata(),
			'orderInvoices' => $this->mymodel->getOrderInvProducts($nroOrder),
			'initialExpenses' => $this->mymodel->getInitialExpenses($nroOrder),
			'nationalizations' => $this->mymodel->getNationalizations($nroOrder),
			'invoicesInfo' => $this->mymodel->getInvoiceInformative($nroOrder),
			'boxesOrder' => $this->mymodel->getBoxesOrder($nroOrder, $orderData[0]['regimen']),
			'provisions' => count($provisions),
			'consolided' => count($consolided),
						];

		if($data['order'] == false){
			$this->redirectPage('ordersList');
			return true;
		}

		$config['show_order'] = true;
		$config['viewData'] = $data;
		$config['list_active'] = 'class="active"';
		$config['createBy'] = $this->getUserDataDb($data['order']['id_user']);
		$config['titleContent'] = 'Detalle De Pedido [ ' . 
																								$data['order']['nro_pedido'] . 
																								']' ;
		$this->responseHttp($config);
	}
	
	/**
	* Muestra el formulario para crear un pedido
	*/
	public function nuevo(){
		$config['incoterms'] = json_encode($this->modelbase->get_table([
																									'table' => 'tarifa_incoterm',
																																]));
		$config['new_active'] = 'class="active"';
		$config['create_order'] = true;
		$config['countries'] = $this->mymodel->getCountries();
		$config['titleContent'] = 'Registro de nuevo Pedido';
		$this->responseHttp($config);
	}

	/**
	* Muestra el formulario de edicion 
	*/
	public function editar($nroOrder){
		$order = $this->modelbase->get_table([
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
				'incoterms' => json_encode($this->modelbase->get_table([
																							'table' => 'tarifa_incoterm'
																														])),
				'titleContent' => 'Se Encuentra Editando El Pedido &nbsp &nbsp <b>'. 
																														$nroOrder . '</b>',
							];
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
		if(!$_POST){$this->redirectPage('ordersList');}

		$pedido = $this->input->post();
		$pedido['id_user'] = $this->session->userdata('id_user');		
		if($pedido['fecha_arribo'] == ''){
			unset($pedido['fecha_arribo']);
		}else{
		$pedido['fecha_arribo'] = date('Y-m-d' ,
																						strtotime($pedido['fecha_arribo']));
		}
		if(!isset($pedido['id_pedido'])){
			if((int)$pedido['n_pedido'] < 100 && intval($pedido['n_pedido']) > 9 ){
					$pedido['n_pedido'] = '0' . intval($pedido['n_pedido']);
				}elseif((int)$pedido['n_pedido'] < 9 ){
					$pedido['n_pedido'] = '00' . intval($pedido['n_pedido']);
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

		$status = $this->validData($pedido);
			if ($status['status']){
				if (!isset($pedido['id_pedido'])){
					$this->db->insert($this->controller, $pedido);
					$this->redirectPage('putIncoterms', $pedido['nro_pedido']);
					return true;
				}else{
					$pedido['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('nro_pedido', $pedido['nro_pedido']);
					$this->db->update($this->controller, $pedido);
					$this->redirectPage( 'replaceIncoterms', $pedido['nro_pedido']);
					return true;
				}
		}else{
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
		private function validData($pedido){
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
		* Envia la respuestas html al navegador
		*/
		private function responseHttp($config){
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