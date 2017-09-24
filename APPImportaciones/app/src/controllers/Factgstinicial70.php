<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modulo encargado de manejar las justificaiones de los gastos iniciales
 * cada uno de los gastos iniciales factura son la justificacion de las
 * provisiones gastos iniciales
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Factgstinicial70 extends MY_Controller {
	private $resultDb;
	private $controllerSPA = "factura_pagos_pedido_gasto_inicial_r70";
	private $responseHTTP = array("status" => "success");
	private $viewData;

	/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
	}

	
	/**
	* Presenta una factura del gasto inicial
	* @param  $idFactGastoInicial identificacion del registro
	* @return array response JSON
	*/
	public function presentar($idFactGastoInicial){
		$this->db->where('id_factura_pagos_pedido_gasto_inicial',
																													$idFactGastoInicial);
		$this->resultDb = $this->db->get($this->controllerSPA);

		if($this->resultDb->num_rows() > 0){
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["infoTable"] =
								$this->mymodel->getInfo($this->controllerSPA);
			$this->responseHTTP["message"] = "Se encontraron " .
								    $this->resultDb->num_rows() ." registros";
			$this->responseHTTP["appst"] = 1100;
		}else{
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["message"] = "No existen registros almacenados";
			$this->responseHTTP["appst"] = 2100;
		}

	}

	/**
	 * Lista las facturas informativas de acuerdo a tres criterio
	 * Por $idGastosIniciales = 0 (hace referencia la tabla de gastos iniciales)
	 * Por pedido $idProveedor = 0
	 * Todas las facturas $idProveedor = 0 & $idPedido = 0
	 * @return array JSON
	 */
	public function listar($idGastosIniciales = 0, $idFacPagos = 0){
		#listamos todos
			if($idGastosIniciales == 0 && $idFacPagos == 0){
				$this->resultDb = $this->db->get($this->controllerSPA);
			}elseif($idGastosIniciales != 0 && $idFacPagos == 0){
				$this->db->where('id_gastos_iniciales', $idGastosIniciales);
				$this->resultDb = $this->db->get($this->controllerSPA);
			}elseif($idGastosIniciales == 0 && $idFacPagos != 0) {
				$this->db->where('id_factura_pagos_pedido_gasto_inicial',
																 $idFacPagos);
				$this->resultDb = $this->db->get($this->controllerSPA);
			}

			if($this->resultDb->num_rows() > 0){
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["infoTable"] =
								$this->mymodel->getInfo($this->controllerSPA);
			$this->responseHTTP["message"] = "Se encontraron " .
								    $this->resultDb->num_rows() ." registros";
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
		$facpGstInicial = $request['factura_pagos_pedido_gasto_inicial_r70'];
		#verificamos que el registro existe
		$this->db->where('id_gastos_iniciales',
									  $facpGstInicial['id_gastos_iniciales']);
		$this->db->where('id_factura_pagos', 
										 $facpGstInicial['id_factura_pagos']);
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
			$status = $this->_validData($facpGstInicial);
			if ($status['status']){
				if ($request['accion'] == 'create'){
					$this->db->insert($this->controllerSPA, $facpGstInicial);
					$this->responseHTTP['message'] = 
											  'Registro creado existosamente';
					$this->responseHTTP["appst"] = 1200;
					$this->responseHTTP['lastInfo'] = 
												   $this->mymodel->lastInfo();
					$this->__responseHttp($this->responseHTTP, 201);
				}else{
					$facpGstInicial['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('id_factura_pagos_pedido_gasto_inicial',
						   $request['id_factura_pagos_pedido_gasto_inicial']);
					$this->db->update($this->controllerSPA, $facpGstInicial);
					$this->responseHTTP['message'] = 'Registro actualizado';
					$this->responseHTTP["appst"] = 1300;
					$this->__responseHttp($this->responseHTTP, 201);
				}
			}else{
				$this->responseHTTP['message'] = 	'Uno de los registros'.
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
	public function eliminar($idFactGastoInicial){
		if(!isset($idFactGastoInicial)){
			$this->_notAuthorized();
		}
		

		$this->db->where('id_factura_pagos_pedido_gasto_inicial',
											        	$idFactGastoInicial);
		$this->resultDb = $this->db->get($this->controllerSPA);
		if  ($this->resultDb->num_rows() > 0){
				$this->db->where('id_factura_pagos_pedido_gasto_inicial' ,
													 	$idFactGastoInicial);
				$this->db->delete($this->controllerSPA);
				$this->responseHTTP['message'] = 
											'Regitro eliminado correctamente';
				$this->responseHTTP["appst"] = 1500;	
		}else{
			$this->responseHTTP['appst'] = 'El registro que intenta'.
														' eliminar no existe';
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
			'id_gastos_iniciales' => 1,
			'id_factura_pagos' => 1,
			'valor' => 1,
			'id_user' => 1
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}
}
