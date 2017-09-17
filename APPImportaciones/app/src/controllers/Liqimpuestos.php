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
class Liqimpuestos extends MY_Controller {
	private $resultDb;
	private $controllerSPA = 'liquidacion_impuestos';
	private $responseHTTP = array('status' => 'success');


	/**
	 * Lista los impuestos para una nacionalizacion
	 * Si no se especifica lista todos los impuestos de nacionalizacion
	 * @return array JSON
	 */
	public function listar($idImpuestos = 0){
			if($idImpuestos != 0){
        $this->db->where('id_impuestos', $idImpuestos);
				$this->resultDb = $this->db->get($this->controllerSPA);

			}else{
        $this->resultDb = $this->db->get($this->controllerSPA);
      }

			if($this->resultDb->num_rows() > 0){
			$this->responseHTTP['data'] = $this->resultDb->result_array();
			$this->responseHTTP['appst'] = 'Se encontraron ' .
																			$this->resultDb->num_rows() .
																			' items';
																			
		}else{
			$this->responseHTTP['data'] = $this->resultDb->result_array();
			$this->responseHTTP['appst'] = 'No existen registros almacenados';
			$this->responseHTTP['getInfo'] = 
																	$this->mymodel->getInfo($this->controllerSPA);
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
		$liqImpuestos = $request['liquidacion_impuestos'];
		#verificamos que el registro existe
		$this->db->where('id_impuestos',$liqImpuestos['id_impuestos']);
		$this->db->where('nro_documento',$liqImpuestos['nro_documento']);
		$this->resultDb = $this->db->get($this->controllerSPA);
		if($this->resultDb->num_rows() != null && $request['accion'] == 'create'){
			$this->responseHTTP['appst'] =
															'Ya existe un pedido con el mismo identificador';
			$this->responseHTTP['data'] = $this->resultDb->result_array();
			$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
			$this->__responseHttp($this->responseHTTP, 400);
		}else{
		#validamos la informacion
			$status = $this->_validData($liqImpuestos);
			if ($status['status']){
				if ($request['accion'] == 'create'){
					$this->db->insert($this->controllerSPA, $liqImpuestos);
					$this->responseHTTP['appst'] = 'Registro agregado existosamente';
					$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
					$this->__responseHttp($this->responseHTTP, 201);
				}else{
					$liqImpuestos['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('id_liquidacion_impuestos', 
																						$request['id_liquidacion_impuestos']);
					$this->db->update($this->controllerSPA, $liqImpuestos);
					$this->responseHTTP['appst'] = 'Registro actualizado Correctamente';
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
	public function eliminar($idliqImpuestos){
		if(!isset($idliqImpuestos)){
			$this->_notAuthorized();
		}


		$this->db->where('id_liquidacion_impuestos' , $idliqImpuestos);
		$this->resultDb = $this->db->get($this->controllerSPA);

		if  ($this->resultDb->num_rows() > 0){
				$this->db->where('id_liquidacion_impuestos' , $idliqImpuestos);
				$this->db->delete($this->controllerSPA);
				$this->responseHTTP['appst'] = 'Regitro eliminado correctamente';

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
							'id_impuestos' => 1,
							'nro_documento' => 1,
							'valor' => 1,
							'id_user' => 1
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}
}
