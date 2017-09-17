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
class Facturapagos extends MY_Controller {
	private $resultDb;
	private $controllerSPA = "factura_pagos";
	private $responseHTTP = array("status" => "success");

	/**	
	* Presenta una factura pedido desde el id que lo indentifica
	*/
 	public function presentar($idFacPagos){
		if(!isset($idFacPagos)){
			$this->_notAuthorized();
		}

		$thi->db->where('id_factura_pagos', $idFacPagos);
		$this->resultDb = $this->db->get($this->controllerSPA);

		if( $this->resultDb->num_rows > 0 ){
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["appst"] = "El registro listado correctamente";
		}else{
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["appst"] = "El registro solicitado no existe";
		}


 	}


	/**
	 * Lista los registros de acuerdo a tres criterio
	 * Por proveedor $idPedido = 0
	 * Por pedido $idFacPagos = 0
	 * Todas los regostros $idProveedor = 0 & $idPedido = 0
	 * @return array JSON
	 */
	public function listar( $nroFactura = 0 , $idProveedor = 0 ){
		#Lista por uno de las tres opcuones
			if( $nroFactura != 0 && $idProveedor == 0 ) {
				$this->db->where('nro_factura', $nroFactura);
				$this->resultDb = $this->db->get($this->controllerSPA);
			}elseif($nroFactura == 0 && $idProveedor != 0){
				$this->db->where('identificacion_proveedor', $idProveedor);				
				$this->resultDb = $this->db->get($this->controllerSPA);
			}else{
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
		$facPgPedido = $request['factura_pagos'];
		#verificamos que el registro existe
		$this->db->where('nro_factura', $facPgPedido['nro_factura']);
		$this->db->where('identificacion_proveedor', 
																			$facPgPedido['identificacion_proveedor']);

		$this->resultDb = $this->db->get($this->controllerSPA);
		if($this->resultDb->num_rows() != null && $request['accion'] == 'create'){
			$this->responseHTTP['appst'] =
														'Ya existe un registro con el mismo identificador';
			$this->responseHTTP['data'] = $this->resultDb->result_array();
			$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
			$this->__responseHttp($this->responseHTTP, 400);
		}else{
		#validamos la informacion
			$status = $this->_validData( $facPgPedido );
			if ($status['status']){

				#anulamos las fechas en blanco se las pasa como null
				$facPgPedido['fecha_emision'] = (empty($facPgPedido['fecha_emision'])) ? 
																				null : 
																								$facPgPedido['fecha_emision'] ;

				print(var_dump($facPgPedido['fecha_emision']));

				if ($request['accion'] == 'create'){
					$this->db->insert($this->controllerSPA, $facPgPedido);
					$this->responseHTTP['appst'] = 'Registro agregado existosamente';
					$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
					$this->__responseHttp($this->responseHTTP, 201);
				}else{
					$facPgPedido['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('id_factura_pagos',
														 $request['id_factura_pagos']);
					$this->db->update($this->controllerSPA, $facPgPedido);
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
	public function eliminar($idFacPagos){
		if(!isset($idFacPagos)){
			$this->_notAuthorized();
		}
		
		#comprobamos que no tenga dependencias
		$this->db->where('id_factura_pagos', $idFacPagos);
		$this->resultDb = $this->db->get('factura_pagos_pedido');
		print(var_dump($this->resultDb->num_rows()));

		if  (!$this->resultDb->num_rows() > 0){

			$this->db->where('id_factura_pagos', $idFacPagos);
			$this->resultDb = $this->db->get($this->controllerSPA);

			if  ($this->resultDb->num_rows() > 0){
				$this->db->where('id_factura_pagos',  $idFacPagos);
				$this->db->delete($this->controllerSPA);
				$this->responseHTTP['appst'] = 'Regitro eliminado correctamente';
			}else{
				$this->responseHTTP['appst'] =
							'El registro que intenta eliminar no existe';
			}

		}else{
			$this->responseHTTP['appst'] =
																	'El registro no se puede eliminar ' . 
																	'tiene dependencias';
		}

		$this->__responseHttp($this->responseHTTP, 200);
	}

	/**
	 * Se validan las columnas que debe tener la consulta para que no falle
	 * @return [array] | [bolean]
	 */
	private function _validData($data){
		$columnsLen = array(
								'identificacion_proveedor' => 5,
								'nro_factura' => 1,
								'fecha_emision' => 0,
								'valor' => 1,
								'saldo' => 1,
								'comentarios' => 0,
								'id_user' => 1,
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}
}