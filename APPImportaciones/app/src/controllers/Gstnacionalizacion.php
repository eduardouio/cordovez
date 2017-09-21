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
class Gstnacionalizacion extends MY_Controller {
	private $resultDb;
	private $controllerSPA = "gastos_nacionalizacion";
	private $responseHTTP = array("status" => "success");
	private $viewData;

	/**
	 * Lista las facturas informativas de acuerdo a tres criterio
	 * Por proveedor $idPedido = 0
	 * Por pedido $idProveedor = 0
	 * Todas las facturas $idProveedor = 0 & $idPedido = 0
	 * @return array JSON
	 */
	public function listar($idNacionalizacion = 0, $idGastosNacionalizacion = 0){
		#listamos todos
			if($idNacionalizacion == 0 && $idGastosNacionalizacion == 0){
				$this->resultDb = $this->db->get($this->controllerSPA);
			}elseif($idNacionalizacion != 0 && $idGastosNacionalizacion == 0){
				$this->db->where('id_nacionalizacion', $idNacionalizacion);
				$this->resultDb = $this->db->get($this->controllerSPA);
			}elseif($idNacionalizacion == 0 && $idGastosNacionalizacion != 0) {
				$this->db->where('id_gastos_nacionalizacion',
																										$idGastosNacionalizacion);
				$this->resultDb = $this->db->get($this->controllerSPA);
			}

			if($this->resultDb->num_rows() > 0){
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["infoTable"] =
																	$this->mymodel->getInfo($this->controllerSPA);
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
		$gastoNacionalizacion = $request['gastos_nacionalizacion'];
		#verificamos que el registro existe
		$this->db->where('id_nacionalizacion',
																	$gastoNacionalizacion['id_nacionalizacion']);
		$this->db->where('concepto', $gastoNacionalizacion['concepto']);
		$this->resultDb = $this->db->get($this->controllerSPA);
		if($this->resultDb->num_rows() != null && $request['accion'] == 'create'){
			$this->responseHTTP['appst'] =
															'Ya existe un pedido con el mismo identificador';
			$this->responseHTTP['data'] = $this->resultDb->result_array();
			$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
			$this->__responseHttp($this->responseHTTP, 400);
		}else{
		#validamos la informacion
			$status = $this->_validData($gastoNacionalizacion);
			if ($status['status']){
				if ($request['accion'] == 'create'){
					$this->db->insert($this->controllerSPA, $gastoNacionalizacion);
					$this->responseHTTP['appst'] = 'Registro agregado existosamente';
					$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
					$this->__responseHttp($this->responseHTTP, 201);
				}else{
					$gastoNacionalizacion['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('id_gastos_nacionalizacion',
														 $request['id_gastos_nacionalizacion']);
					$this->db->update($this->controllerSPA, $gastoNacionalizacion);
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
	public function eliminar($idGastosNacionalizacion){
		$this->db->where('id_gastos_nacionalizacion' , $idGastosNacionalizacion);
		$this->resultDb = $this->db->get($this->controllerSPA);

		#verificamos que el registro exista
		if($this->resultDb->num_rows() > 0){
			$this->db->where('id_gastos_nacionalizacion' , $idGastosNacionalizacion);
			$this->resultDb = $this->db->get('factura_gastos_nacionalizacion');

			if(!$this->resultDb->num_rows() > 0){
				$this->db->where('id_gastos_nacionalizacion' , $idGastosNacionalizacion);
				$this->db->delete($this->controllerSPA);
				$this->responseHTTP['appst'] = 'Regitro eliminado correctamente';
			}else{
				$this->responseHTTP['appst'] =
																	'El registro que intenta eliminar tiene' . 
																	' dependencias';	
			}
		}else{
			$this->responseHTTP['appst'] =
																	'El registro que intenta eliminar no existe';
		}

		$this->__responseHttp($this->responseHTTP, 200);
	}

	/**
	 * Se validan las columnas que debe tener la consulta para que no falle
	 * @return [array] | [bolean]
	 */
	private function _validData($data){
		$columnsLen = array(
						'id_nacionalizacion' => 1,
						'concepto' => 4,
						'valor_provisionado' => 1,
						'comentarios' => 0,
						'id_user' => 1,
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}
}
