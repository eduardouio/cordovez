<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modulo encargado de manejar los proveedores, CRUD y validaciones
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Proveedor extends MY_Controller {
	private $resultDb;
	private $controllerSPA = "proveedor";
	private $responseHTTP = array("status" => "success");
	private $viewData;

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
				'title' => 'SPA Proveedores',
				'base_url' => base_url(),
				'actionFrm' => '/validar',
				'controller' => $this->controllerSPA,
				'iconTitle' => 'fa-dropbox',
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
	 * Lista todos los proveedors que existen en la base, se puede obtener
	 * un producto a la vez
	 * @return array JSON
	 */
	public function listar($idProveedor = 0){
			if($idProveedor == 0){
				$this->resultDb = $this->db->get($this->controllerSPA);
			}else{
				$this->db->where('id_proveedor', $idProveedor);
				$this->resultDb = $this->db->get($this->controllerSPA);
			}

			if($this->resultDb->num_rows() > 0){
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["infoTable"] = $this->mymodel->getInfo($this->controllerSPA);
			$this->responseHTTP["appst"] = "Se encontraron " .
																			$this->resultDb->num_rows() .
																			" items";
		}else{
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["appst"] = "No existen registros almacenados";
		}
			$this->__responseHttp($this->responseHTTP, 200);
	}

	/**
	 *  Valida los datos recibidos por post antes de crear o actualizar el
	 * registro, solo aceptan datos por post
	 * @return array JSON
	 */
	public function validar(){
		if($this->rest->_getRequestMethod()!= 'POST'){
			$this->_notAuthorized();
		}

		$request = json_decode(file_get_contents('php://input'), true);
		$proveedor = $request['proveedor'];

		$this->db->where('identificacion_proveedor',
																				$proveedor['identificacion_proveedor']);
		$this->resultDb = $this->db->get($this->controllerSPA);
		if($this->resultDb->num_rows() != null && $request['accion'] == 'create'){
			$this->responseHTTP['appst'] =
															'Ya existe un pedido con el mismo identificador';
			$this->responseHTTP['data'] = $this->resultDb->result_array();
			$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
			$this->__responseHttp($this->responseHTTP, 400);
		}else{
		#comprobamos que el registro exista
			$status = $this->_validData($proveedor);
			if ($status['status']){
				if ($request['accion'] == 'create'){
					$this->db->insert($this->controllerSPA, $proveedor);
					$this->responseHTTP['appst'] = 'Registro agregado existosamente';
					$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
					$this->__responseHttp($this->responseHTTP, 201);
				}else{
					$proveedor['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('id_proveedor', $request['id_proveedor']);
					$this->db->update($this->controllerSPA, $proveedor);
					$this->responseHTTP['appst'] = 'Registro actualizado actualizado';
					$this->__responseHttp($this->responseHTTP, 201);
				}
			}else{
				$this->responseHTTP['appst'] =
									'Uno de los datos ingresados es incorrecto, vuelva a intentar';
				$this->responseHTTP['data'] = $status;
				$this->__responseHttp($this->responseHTTP, 400);
			}
		}

	}

	/**
	 * Elimina un registro de la tabla
	 * dependencias
	 * @return array JSONPedidos
	 */
	public function eliminar($idProveedor){
		$this->db->where('id_proveedor' , $idProveedor);
		$this->resultDb = $this->db->get($this->controllerSPA);

		if  ($this->resultDb->num_rows() > 0){
			$this->db->where('id_proveedor' , $idProveedor);
			$this->db->delete($this->controllerSPA);
			$this->responseHTTP['appst'] =
																	'Regitro eliminado correctamente';
		}else{
			$this->responseHTTP['appst'] =
																	'El registro que intenta eliminar no existe';
		}

		$this->__responseHttp($this->responseHTTP, 200);
	}

	/**
	 * se validan los datos que deben estar para que la consulta no falle
	 * @return [array] | [bolean]
	 */
	private function _validData($data){
		$columnsLen = array(
				'nombre' => 4,
				'tipo_provedor' => 6,
				'categoria' => 8,
				'identificacion_proveedor' => 6,
				'comentarios' => 0,
				'id_user' => 1
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}
}
