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
	private $resultDb;
	private $dataView;
	private $controllerSPA = 'pedido';
	private $responseHTTP = array('status' => 'success');

	/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	 * Carga la configuracion inicial de la SPA
	 * @return array (config)
	 */
	private function _loadData(){
		$this->dataView = array(
				'title' => 'SPA Pedidos',
				'base_url' => base_url(),
				'actionFrm' => '/validateForm',
				'controller' => $this->controllerSPA,
				'iconTitle' => 'fa-cubes',
				'active_pedidos' => 'active left-active',
				);
	}

	/**
	 * Carga la vista y dependencias completas de la SPA
	 * @return string (template => pagePedido)
	 */
	public function index(){
		$this->_loadData();
		$this->twig->display('/pages/pagePedido.html', $this->dataView);
		log_message('Pedido', 'clase de pedido Iniciado');
	}

	/**
	 * Presenta una lista de todos los pedidos
	 */
	public function listar($idPedido = 0 ){

		if ($idPedido == 0){
			$this->resultDb = $this->db->get($this->controllerSPA);
		}else{
			$this->db->where('id_pedido', $idPedido);
			$this->resultDb = $this->db->get($this->controllerSPA);
		}

			//Verificar que existan datos
			if($this->resultDb->num_rows() > 0){
				$this->responseHTTP['data'] = $this->resultDb->result_array();
				$this->responseHTTP['message'] = 'Se encontraron ' .
																			$this->resultDb->num_rows() . 'registros';
				$this->responseHTTP["appst"] = 1100;
			}else{
				$this->responseHTTP['data'] = $this->resultDb->result_array();
				$this->responseHTTP['message'] = 'No existen registros almacenados';
				$this->responseHTTP["appst"] = 2100;
			}
			log_message('Pedido', 'se lista correctamente los pedidos');
			$this->__responseHttp($this->responseHTTP);
	}

	/**
	 * registra un pedido, si la llamada no es por post rechaza la peticion
	 * crea un pedido nuevo => comprueba que no exista y crea un nuevo registro
	 * actualiza un pedido existente => actualiza last_update con fecha del server
	 * @return JSON (response)
	 */
	public function validar(){
		if($this->rest->_getRequestMethod()!= 'POST'){
			$this->_notAuthorized();
		}

		$request = json_decode(file_get_contents('php://input'), true);

		$pedido = $request['pedido'];
		$this->db->where('nro_pedido',$pedido['nro_pedido']);
		$this->resultDb = $this->db->get($this->controllerSPA);

		if($this->resultDb->num_rows() != null && $request['accion'] == 'create'){
			$this->responseHTTP['message'] = 'Ya existe un pedido'.
																								 'con el mismo identificador';
			$this->responseHTTP["appst"] = 2300;
			$this->responseHTTP['data'] = $this->resultDb->result_array();
			$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
			$this->__responseHttp($this->responseHTTP, 400);
		}else{
			$status = $this->_validData($pedido);
			if ($status['status']){
				if ($request['accion'] == 'create'){
					$this->db->insert($this->controllerSPA, $pedido);
					$this->responseHTTP['message'] = 'Registro creado existosamente';
					$this->responseHTTP["appst"] = 1200;
					$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
					$this->__responseHttp($this->responseHTTP, 201);
				}else{
					$pedido['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('nro_pedido', $pedido['nro_pedido']);
					$this->db->update($this->controllerSPA, $pedido);
					$this->responseHTTP['message'] = 
																	'El registro fue actualizado correctamente';
					$this->responseHTTP["appst"] = 1300;
					$this->__responseHttp($this->responseHTTP, 201);
				}
			}else{
				$this->responseHTTP['message'] =
								'Uno de los datos ingresados es incorrecto, vuelva a intentar';
				$this->responseHTTP["appst"] = 1400;
				$this->responseHTTP['data'] = $status;
				$this->__responseHttp($this->responseHTTP, 400);
			}
		}
		}

		/**
		 * elimina un pedido de la tabla, solo lo elimina sino tiene parciales
		 */
		public function eliminar(){
			if($this->rest->_getRequestMethod()!= 'POST'){
				$this->_notAuthorized();
			}
			$request = json_decode(file_get_contents('php://input'), true);
			$pedido = $request['pedido'];

			$this->db->where('nro_pedido', $pedido['nro_pedido']);
			$this->resultDb = $this->db->get($this->controllerSPA);

			if($this->resultDb->num_rows() != null){
				$this->db->where('nro_pedido', $pedido['nro_pedido']);
				$this->resultDb = $this->db->get('pedido_factura');
				if($this->resultDb->num_rows() == null){
					$this->db->where('nro_pedido', $pedido['nro_pedido']);
					$this->db->delete($this->controllerSPA);
					$this->responseHTTP['message'] = 'El registro' . 
					'                     	$pedido['nro_pedido']  Ha sido eliminado';
					$this->responseHTTP["appst"] = 1500;
					$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
				}else {
					$this->responseHTTP['message'] = 'El pedido' . $pedido['nro_pedido'] .
								' No se puede eliminar, tiene dependencias en la base de datos';
					$this->responseHTTP["appst"] = 2400;
					$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
				}
			}else{
				$this->responseHTTP['message'] = 'El pedido ' . $pedido['nro_pedido'] .
												' No se puede eliminar, no existe en la base de datos';
				$this->responseHTTP["appst"] = 2100;
				$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
			}

			$this->__responseHttp($this->responseHTTP, 202);
		}

		/**
		 * se validan los datos que deben estar para que la consulta no falle
		 * @return [array] | [bolean]
		 */
		private function _validData($pedido){
			$columnsLen = array(
				'nro_pedido' => 6,
				'regimen' => 2,
				'id_incoterm' => 1,
				'antes_fob' => 1,
				'antes_fob_provisionado' => 1,
				'pais_origen' => 1,
				'ciudad_origen' => 1,			
				'flete_aduana' => 1,
				'seguro_aduana' => 1,
				'comentarios' => 0,
				'estado_pedido' => 7,
				'id_user' => 1,
			);
			return $this->_checkColumnsData($columnsLen, $pedido);
		}
}
