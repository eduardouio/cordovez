<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modulo encargado de manejar los pedidos, CRUD y validaciones de las facturas
 * de los pedidos
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Pedidofactura extends MY_Controller {
	private $resultDb;
	private $controllerSPA = "pedido_factura";
	private $responseHTTP = array("status" => "success");

	/**
	 * Busca las facturas de pedido para un pedido en especial, sino se pasa
	 * el indentificador del pedido por url restorna la lista completa de
	 * facturas
	 * example facturas un pedido baseurl/pedidofactura/listar/2015/002
	 * example todas las facturas baseurl/pedidofactura/listar
	 *@param $idOrder string desde url
	 *@param $year strin desde url
	 * @return array JSON
	 */
  public function listar($idOrder = 0 , $year = 0){

				if($idOrder != 0){
					$this->db->where('nro_pedido', $idOrder.'-'.$year);
					$this->resultDb = $this->db->get($this->controllerSPA);
					$this->responseHTTP["data"] = $this->resultDb->result_array();
	        $this->responseHTTP["appst"] = "Se encontraron " .
																					$this->resultDb->num_rows() .
																		" facturas Para el pedido " . $idOrder.$year;
				}else{
					$this->resultDb = $this->db->get($this->controllerSPA);
					if($this->resultDb->num_rows() > 0){
						$this->responseHTTP["data"] = $this->resultDb->result_array();
		        $this->responseHTTP["appst"] = "Se encontraron " .
																						$this->resultDb->num_rows() .
																						" Facturas de Pedido ";
					}else{
		        $this->responseHTTP["data"] = $this->resultDb->result_array();
		        $this->responseHTTP["appst"] = "No existen registros almacenados";
		      }
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
		$pedidoFactura = $request['pedidoFactura'];
		$this->db->where('nro_pedido',$pedidoFactura['nro_pedido']);
		$this->db->where('id_factura_proveedor',$pedidoFactura['id_factura_proveedor']);
		$this->resultDb = $this->db->get($this->controllerSPA);

		#comprobamos que el registro exista
		if($this->resultDb->num_rows() != null && $request['accion'] == 'create'){
			$this->responseHTTP['appst'] = 'La factura que intenta ingresar ya existe';
			$this->responseHTTP['data'] = $this->resultDb->result_array();
			$this->__responseHttp($this->responseHTTP, 400);
		}else{
			$status = $this->_validData($pedidoFactura);
			if ($status['status']){
				if ($request['accion'] == 'create'){
					$this->db->insert($this->controllerSPA, $pedidoFactura);
					$this->responseHTTP['appst'] = 'Factura ingredada existosamente';
					$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
					$this->__responseHttp($this->responseHTTP, 201);
				}else{
					$pedido['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('id_pedido_factura', $request['id_pedido_factura']);
					$this->db->update($this->controllerSPA, $pedidoFactura);
					$this->responseHTTP['appst'] = 'Factura Actualizada';
					//print var_dump($this->mymodel->lastInfo());
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
   * Elimina un registro de la tabla, se verifica que exista y que no tenga
   * dependencias los datos son recibidos por GET
   * @return array JSON
   */
	public function eliminar($id_pedido_factura){
		$this->db->where('id_pedido_factura',$id_pedido_factura );
		$this->resultDb = $this->db->get('detalle_pedido_factura');
    if($this->resultDb->num_rows() != null){
			$this->responseHTTP['appst'] =
													"La factura no se puede eliminar tiene dependencias";
			$this->responseHTTP['data'] = $this->resultDb->result_array();
		}else{
			$this->db->where('id_pedido_factura',$id_pedido_factura );
			$this->db->delete($this->controllerSPA);
			$this->responseHTTP['appst'] =
												"La factura fue eliminada correctamente";
		}
		$this->__responseHttp($this->responseHTTP, 202);
	}

	/**
	 * se validan los datos que deben estar para que la consulta no falle
	 * @return [array] | [bolean]
	 */
	private function _validData($pedido){
		$columnsLen = array(
			'nro_pedido' => 6,
			'id_factura_proveedor' => 0,
			'identificacion_proveedor' => 0,
			'fecha_emision' => 19,
			'valor' => 1,
			'moneda' => 1,
			'tipo_cambio' => 1,
			'vencimiento_pago' => 19,
			'id_user' => 1,
		);
		return $this->_checkColumnsData($columnsLen, $pedido);
	}

}
