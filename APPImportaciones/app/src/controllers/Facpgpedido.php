<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Valida los datos de las provisiones
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Facpgpedido extends MY_Controller {
	private $resultDb;
	private $controllerSPA = "factura_pagos_pedido";
	private $responseHTTP = array("status" => "success");

	/**	
	* Presenta una factura pedido desde el id que lo indentifica
	*/
 	public function presentar($idFacturaPagosPedido){
		if(!isset($idFacturaPagosPedido)){
			$this->_notAuthorized();
		}

		$thi->db->where('id_factura_pagos_pedido', $idFacturaPagosPedido);
		$this->resultDb = $this->db->get($this->controllerSPA);

		if( $this->resultDb->num_rows > 0 ){
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["message"] =
										  "Registro encontrado correctamente";
			$this->responseHTTP["appst"] = 1100;
		}else{
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["message"] = "Registro no encontrado";
			$this->responseHTTP["appst"] = 2100;
		}


 	}


	/**
	 * Lista los registros de acuerdo a tres criterio
	 * Por proveedor $idPedido = 0
	 * Por pedido $idFacPagos = 0
	 * Todas los regostros $idProveedor = 0 & $idPedido = 0
	 * @return array JSON
	 */
	public function listar( $nroPedido = 0 , $idFacPagos = 0 ){
		#Lista por uno de las tres opcuones
			if( $nroPedido != 0 && $idFacPagos == 0 ) {
				$this->db->where('nro_pedido', $nroPedido);
				$this->resultDb = $this->db->get($this->controllerSPA);
			}elseif($nroPedido == 0 && $idFacPagos != 0){
				$this->db->where('id_factura_pagos', $idFacPagos);				
				$this->resultDb = $this->db->get($this->controllerSPA);
			}else{
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
		$facPgPedido = $request['factura_pagos_pedido'];
		#verificamos que el registro existe
		$this->db->where('nro_pedido', $facPgPedido['nro_pedido']);
		$this->db->where('id_factura_pagos', $facPgPedido['id_factura_pagos']);
		$this->db->where('concepto', $facPgPedido['concepto']);

		$this->resultDb = $this->db->get($this->controllerSPA);
		if($this->resultDb->num_rows() != null && 
												$request['accion'] == 'create'){
			$this->responseHTTP['message'] =
							 'Ya existe un registro con el mismo identificador';
			$this->responseHTTP["appst"] = 2300;
			$this->responseHTTP['data'] = $this->resultDb->result_array();
			$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
			$this->__responseHttp($this->responseHTTP, 400);
		}else{
		#validamos la informacion
			$status = $this->_validData( $facPgPedido );
			if ($status['status']){

				#anulamos las fechas en blanco
				$facPgPedido['fecha_inicio'] = 
				(empty($facPgPedido['fecha_inicio'])) ?	null : 																							  $facPgPedido['fecha_inicio'];

				$facPgPedido['fecha_fin'] = (empty($facPgPedido['fecha_fin'])) ? 
											null :  $facPgPedido['fecha_fin'];

				if ($request['accion'] == 'create'){
					$this->db->insert($this->controllerSPA, $facPgPedido);
					$this->responseHTTP['message'] = 
												'Registro creado existosamente';
					$this->responseHTTP["appst"] = 1200;
					$this->responseHTTP['lastInfo'] = 
													$this->mymodel->lastInfo();
					$this->__responseHttp($this->responseHTTP, 201);
				}else{
					$facPgPedido['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('id_factura_pagos_pedido',
										  $request['id_factura_pagos_pedido']);
					$this->db->update($this->controllerSPA, $facPgPedido);
					$this->responseHTTP['appst'] = 'Registro actualizado';
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
	public function eliminar($idFacPagos){
		if(!isset($idFacPagos)){
			$this->_notAuthorized();
		}
		

		$this->db->where('id_factura_pagos_pedido', $idFacPagos);
		$this->resultDb = $this->db->get($this->controllerSPA);

		if  ($this->resultDb->num_rows() > 0){
				$this->db->where('id_factura_pagos_pedido' , $idFacPagos);
				$this->db->delete($this->controllerSPA);
				$this->responseHTTP['message'] = 
											'Regitro eliminado correctamente';
				$this->responseHTTP["appst"] = 1500;
		}else{
			$this->responseHTTP['appst'] =
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
							'nro_pedido' => 6,
							'id_factura_pagos' => 1,
							'valor' => 1,
							'concepto' => 1,
							'fecha_inicio' => 0,
							'fecha_fin' => 0,
							'id_user' => 1
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}
}