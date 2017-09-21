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
class Impnacionalizacion extends MY_Controller {
	private $resultDb;
	private $controllerSPA = "impuestos_nacionalizacion";
	private $responseHTTP = array("status" => "success");
	private $viewData;


	/**
	 * Lista los impuestos para una nacionalizacion
	 * Si no se especifica lista todos los impuestos de nacionalizacion
	 * @return array JSON
	 */
	public function listar($idNacionalizacion = 0){
		#Listamos los gastos_iniciales_r70 de un pedido
			if($idNacionalizacion != 0){
        $this->db->where('id_nacionalizacion', $idNacionalizacion);
				$this->resultDb = $this->db->get($this->controllerSPA);

			}else{
        $this->resultDb = $this->db->get($this->controllerSPA);
      }

			if($this->resultDb->num_rows() > 0){
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["message"] = "Se encontraron " .
							        $this->resultDb->num_rows() . " registros";
			$this->responseHTTP["appst"] = 1100;																
		}else{
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["message"] = "No existen registros almacenados";
			$this->responseHTTP["appst"] = 2100;
			$this->responseHTTP["getInfo"] = 
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
		$impNacionalizacion = $request['impuestos_nacionalizacion'];
		#verificamos que el registro existe
		$this->db->where('id_nacionalizacion',
									$impNacionalizacion['id_nacionalizacion']);
		$this->db->where('concepto',$impNacionalizacion['concepto']);
		$this->resultDb = $this->db->get($this->controllerSPA);
		if($this->resultDb->num_rows() != null && 
												$request['accion'] == 'create'){
			$this->responseHTTP['message'] =
							 'Ya existe un Registro con el mismo identificador';
			$this->responseHTTP["appst"] = 2300;
			$this->responseHTTP['data'] = $this->resultDb->result_array();
			$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
			$this->__responseHttp($this->responseHTTP, 400);
		}else{
		#validamos la informacion
			$status = $this->_validData($impNacionalizacion);
			if ($status['status']){
				if ($request['accion'] == 'create'){
					$this->db->insert($this->controllerSPA, $impNacionalizacion);
					$this->responseHTTP['message'] = 
												'Registro creado existosamente';
					$this->responseHTTP["appst"] = 1200;
					$this->responseHTTP['lastInfo'] = 
													 $this->mymodel->lastInfo();
					$this->__responseHttp($this->responseHTTP, 201);
				}else{
					$impNacionalizacion['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('id_impuestos', $request['id_impuestos']);
					$this->db->update($this->controllerSPA, $impNacionalizacion);
					$this->responseHTTP['message'] = 
										   'Registro actualizado Correctamente';
					$this->responseHTTP["appst"] = 1300;
					$this->__responseHttp($this->responseHTTP, 201);
				}
			}else{
				$this->responseHTTP['message'] = 'Uno de los registros'.
								 'ingresados es incorrecto, vuelva a intentar';
				$this->responseHTTP["appst"] = 1400;
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
	public function eliminar($idImpuestos){
		$this->db->where('id_impuestos' , $idImpuestos);
		$this->resultDb = $this->db->get($this->controllerSPA);

		if  ($this->resultDb->num_rows() > 0){
			#comprobamos que no tenga dependencias
			$this->db->where('id_impuestos' , $idImpuestos);
			$this->resultDb = $this->db->get('liquidacion_impuestos');

			if(!$this->resultDb->num_rows() > 0){
				$this->db->where('id_impuestos' , $idImpuestos);
				$this->db->delete($this->controllerSPA);
				$this->responseHTTP['message'] = 
											 'Regitro eliminado correctamente';
				$this->responseHTTP["appst"] = 1500;
			}else{
				$this->responseHTTP['message'] = 'El Registro tiene'.
							 			  'dependencias no Puede ser eliminado';
				$this->responseHTTP["appst"] = 2400;
			}
		}else{
			$this->responseHTTP['message'] = 'El registro que intenta'.
														  'eliminar no existe';
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
          'id_nacionalizacion' => 1,
          'concepto' => 4,
          'valor_provisionado' => 1,
          'comentarios' => 0,
          'id_user' => 1,
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}
}
