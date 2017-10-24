<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modulo encargado de manejar los seguimientos, CRUD y validaciones
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Seguimiento extends MY_Controller {
	private $resultDb;
	private $controllerSPA = "seguimiento";
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
				'title' => 'SPA Seguimiento',
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
	 * Lista todos los seguimiento que existen en la base, se puede obtener
	 * un producto a la vez
	 * @return array JSON
	 */
	public function listar($idSeguimiento = 0){
			if($idSeguimiento == 0){
				$this->resultDb = $this->db->get($this->controllerSPA);
			}else{
				$this->db->where('id_seguimiento', $idSeguimiento);
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
		$seguimiento = $request['seguimiento'];

		$this->db->where('identificacion_seguimiento',
																				$seguimiento['identificacion_seguimiento']);
		$this->resultDb = $this->db->get($this->controllerSPA);
		if($this->resultDb->num_rows() != null && $request['accion'] == 'create'){
			$this->responseHTTP['appst'] =
															'Ya existe un pedido con el mismo identificador';
			$this->responseHTTP['data'] = $this->resultDb->result_array();
			$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
			$this->__responseHttp($this->responseHTTP, 400);
		}else{
		#comprobamos que el registro exista
			$status = $this->_validData($seguimiento);
			if ($status['status']){
				if ($request['accion'] == 'create'){
					$this->db->insert($this->controllerSPA, $seguimiento);
					$this->responseHTTP['appst'] = 'Registro agregado existosamente';
					$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
					$this->__responseHttp($this->responseHTTP, 201);
				}else{
					$seguimiento['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('id_seguimiento', $request['id_seguimiento']);
					$this->db->update($this->controllerSPA, $seguimiento);
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
	public function eliminar($idSeguimiento){
		$this->db->where('id_seguimiento' , $idSeguimiento);
		$this->resultDb = $this->db->get($this->controllerSPA);

		if  ($this->resultDb->num_rows() > 0){
			$this->db->where('id_seguimiento' , $idSeguimiento);
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
				'tabla' => 4,
				'accion' => 6,
				'datos' => 8,
				'id_user' => 1
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}
}
