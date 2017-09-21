<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modulo encargado de manejar los pedidos, CRUD y de los detalles de
 *las facturas de los pedidos
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Detallepedido extends MY_Controller {
	private $resultDb;
	private $controllerSPA = "detalle_pedido_factura";
	private $responseHTTP = array("status" => "success");

  /**
   * Lista todos los detalles de los pedidos, sino se especifica una factura
   * retorna todos los registros de la tabla
   * @return array JSON
   */
  public function listar($idPedidoFactura = 0){
		#lista lis item de una factura de pedido
		if ($idPedidoFactura != 0 ){
			$this->db->where('id_pedido_factura', $idPedidoFactura);
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
			$this->__responseHttp($this->responseHTTP);
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

		$detalleFactura = $request['detallePedidoFactura'];

		$this->db->where('id_pedido_factura',
									 	 $detalleFactura['id_pedido_factura']);
		$this->db->where('cod_contable' , $detalleFactura['cod_contable']);
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
		#comprobamos que el registro exista
			$status = $this->_validData($detalleFactura);
			if ($status['status']){
				if ($request['accion'] == 'create'){
					$this->db->insert($this->controllerSPA, $detalleFactura);
					$this->responseHTTP['message'] = 
											  'Regitro ingresado exitosamente';
					$this->responseHTTP["appst"] = 1200;
					$this->responseHTTP['lastInfo'] = 
													$this->mymodel->lastInfo();
					$this->__responseHttp($this->responseHTTP, 201);
				}else{
					$detalleFactura['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('detalle_pedido_factura', 
										   $request['detalle_pedido_factura']);
					$this->db->update($this->controllerSPA, $detalleFactura);
					$this->responseHTTP['message'] = 'Registro actualizado';
					$this->responseHTTP["appst"] = 1300;
					$this->responseHTTP['lastInfo'] = 
													$this->mymodel->lastInfo();
					$this->__responseHttp($this->responseHTTP, 201);
				}
			}else{
				$this->responseHTTP['message'] =
						'Uno de los registro es incorrecto, vuelva a intentar';
				$this->responseHTTP["appst"] = 1400;
				$this->responseHTTP['data'] = $status;
				$this->__responseHttp($this->responseHTTP, 400);
			}
		}
	}

  /**
   * Elimina un registro de la tabla
   * dependencias
   * @return array JSON
   */
	public function eliminar($detallePedidoFactura){
    $this->db->where('detalle_pedido_factura' , $detallePedidoFactura);
		$this->resultDb = $this->db->get($this->controllerSPA);

		if  ($this->resultDb->num_rows() > 0){
			$this->db->where('detalle_pedido_factura' , $detallePedidoFactura);
			$this->db->delete($this->controllerSPA);
			$this->responseHTTP['message'] = 'Regitro eliminado correctamente';
		$this->responseHTTP["appst"] = 1500;
		}else{
			$this->responseHTTP['message'] =
								  'El registro que intenta eliminar no existe';
		$this->responseHTTP["appst"] = 2500;
		}

		$this->__responseHttp($this->responseHTTP, 200);
	}

	/**
	 * se validan los datos que deben estar para que la consulta no falle
	 * @return [array] | [bolean]
	 */
	private function _validData($data){
		$columnsLen = array(
			'id_pedido_factura' => 1,
			'cod_contable' =>  20,
			'nro_cajas' => 1,
			'costo_und' => 1,
			'id_user' => 1
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}

}
