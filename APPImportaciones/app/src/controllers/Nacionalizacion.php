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
class Nacionalizacion extends MY_Controller {
	private $resultDb;
	private $controllerSPA = "nacionalizacion";
	private $responseHTTP = array("status" => "success");
	private $viewData;

	/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
	}


	/**
		* PResenta la informacion de una nacionalizacion
		*/
	public function presentar($idNacionalizacion = 0){
		#listamos todos
		if($idNacionalizacion == 0){
			$this->responseHTTP["message"] =
								"Debe especificar un numero de nacionalizacion";
			$this->responseHTTP["appst"] = 2200;
		}else{
			$idNacionalizacion = (int) $idNacionalizacion;
			$this->db->where("id_nacionalizacion", $idNacionalizacion);
			$this->resultDb = $this->db->get($this->controllerSPA);

			if($this->resultDb->num_rows() > 0){
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["infoTable"] =
										$this->mymodel->getInfo($this->controllerSPA);
			$this->responseHTTP["message"] = "Se encontraron " .
										$this->resultDb->num_rows() . " registros";
			$this->responseHTTP["appst"] = 1100;
		}else{
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["message"] = "No existen registros almacenados";
			$this->responseHTTP["appst"] = 2100;
				}
		}
			$this->__responseHttp($this->responseHTTP, 200);
	}


	/**
		* Lista las nacionalizaciones de acuerdo a los siguiente
		* por pedido $idPedido
		* por id $idNacionalizacion
		* todos las nacionalizaciones sin parametros
		* @return array JSON
		*/
	public function listar($idPedido = 0, $factInformativa = 0){
		#listamos todos
			if($idPedido == 0 && $factInformativa == 0){
				$this->resultDb = $this->db->get($this->controllerSPA);
			}elseif($idPedido != 0 && $factInformativa == 0){
				$this->db->where('nro_pedido', $idPedido);
				$this->resultDb = $this->db->get($this->controllerSPA);
			}elseif($idPedido == 0 && $factInformativa != 0) {
				$this->db->where('nro_factura_informativa', $factInformativa);
				$this->resultDb = $this->db->get($this->controllerSPA);
			}

			if($this->resultDb->num_rows() > 0){
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["infoTable"] =
									$this->mymodel->getInfo($this->controllerSPA);
			$this->responseHTTP["message"] = "Se encontraron " .
								$this->resultDb->num_rows() . " registros";
			$this->responseHTTP["appst"] = 1100;
		}else{
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["message"] = "No existen registros almacenados";
			$this->responseHTTP["appst"] = 2100;
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
		$nacionalizacion = $request['nacionalizacion'];
		#verificamos que el registro existe
		$this->db->where('nro_pedido', $nacionalizacion['nro_pedido']);
		$this->db->where('nro_factura_informativa',
											$nacionalizacion['nro_factura_informativa']);
		$this->resultDb = $this->db->get($this->controllerSPA);

		if($this->resultDb->num_rows() != null && 
												$request['accion'] == 'create'){
			$this->responseHTTP['message'] =
										'Ya existe un pedido con el mismo identificador';
			$this->responseHTTP["appst"] = 2300;
			$this->responseHTTP['data'] = $this->resultDb->result_array();
			$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
			$this->__responseHttp($this->responseHTTP, 400);
		}else{
		#validamos la informacion
			$status = $this->_validData($nacionalizacion);
			if ($status['status']){
				if ($request['accion'] == 'create'){
					$this->db->insert($this->controllerSPA, $nacionalizacion);
					$this->responseHTTP['message'] = 
												'Registro creado existosamente';
					$this->responseHTTP["appst"] = 1200;
					$this->responseHTTP['lastInfo'] = 
														$this->mymodel->lastInfo();
					$this->__responseHttp($this->responseHTTP, 201);
				}else{
					$nacionalizacion['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('id_nacionalizacion',
												$request['id_nacionalizacion']);
					$this->db->update($this->controllerSPA, $nacionalizacion);
					$this->responseHTTP['message'] = 'Registro actualizado';
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
		* Elimina una nacionalizacion de la tabla de nacionalizacion
		* dependencias
		* @return array JSONPedidos
		*/
	public function eliminar($idNacionalizacion){
		$idNacionalizacion = (int) $idNacionalizacion;
		$this->db->where('id_nacionalizacion' , $idNacionalizacion);
		$this->resultDb = $this->db->get($this->controllerSPA);

		if  ($this->resultDb->num_rows() > 0){
			#comprobamos que no tenga dependencias
			$this->db->where('id_nacionalizacion', $idNacionalizacion);
			$this->resultDb = $this->db->get('gastos_nacionalizacion');

			if($this->resultDb->num_rows() == 0){
				$this->db->where('id_nacionalizacion' , $idNacionalizacion);
				$this->db->delete($this->controllerSPA);
				$this->responseHTTP['message'] = 	'Regitro eliminado correctamente';
				$this->responseHTTP["appst"] = 1500;
			}else{
				$this->responseHTTP['message'] = 'El Registro tiene dependencias no' .
																											'Puede ser eliminado';
				$this->responseHTTP["appst"] = 2400;
			}
		}else{
			$this->responseHTTP['message'] =
																	'El registro que intenta eliminar no existe';
			$this->responseHTTP["appst"] = 2500;
		}

		$this->__responseHttp($this->responseHTTP, 200);
	}

	/**
		* Se validan las columnas que debe tener la consulta para que no falle
		* @return [array] | [bolean]
		*/
	private function _validData($data){
		$columnsLen = array(
				'nro_pedido'=> 1,
				'nro_factura_informativa'=> 1,
				'moneda'=> 1,
				'tipo_cambio'=> 1,
				'id_user'=> 1,
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}
}
