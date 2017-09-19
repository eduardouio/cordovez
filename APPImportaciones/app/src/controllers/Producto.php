<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modulo encargado de manejar los pedidos, CRUD y validaciones
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Producto extends MY_Controller {
	private $resultDb;
	private $controllerSPA = "producto";
	private $responseHTTP = array("status" => "success");
	private $viewData;

	/**
	 * Carga la configuracion inicial de la SPA
	 * @return array (config)
	 */
	private function _loadData(){
		$this->dataView = array(
				'title' => 'SPA Pedidos',
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
		$this->twig->display('/pages/proveedor.html', $this->dataView);
		log_message('Pedido', 'clase de pedido Iniciado');
	}
	/**
	 * Lista todos los productos que existen en la base, se puede obtener
	 * un producto a la vez
	 * @return array JSON
	 */
	public function listar($idProducto = 0, $idProveedor = 0){
			#listamos todos los productos
			if( $idProducto == 0 && $idProveedor == 0 ){
				$this->resultDb = $this->db->get($this->controllerSPA);
			}else{
				#obtiene una lista de los productos por producto o por proveedor
				if($idProducto != 0 && $idProveedor == 0){
					$this->db->where('id_producto', $idProducto);
					$this->resultDb = $this->db->get($this->controllerSPA);
				}elseif($idProducto == 0 && $idProveedor != 0){
					$this->db->where('identificacion_proveedor', $idProveedor);
					$this->resultDb = $this->db->get($this->controllerSPA);
				}

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
		$producto = $request['producto'];

		$this->db->where('cod_contable', $producto['cod_contable']);
		$this->resultDb = $this->db->get($this->controllerSPA);
		if($this->resultDb->num_rows() != null && $request['accion'] == 'create'){
			$this->responseHTTP['appst'] =
														'Ya existe un registro con el mismo identificador';
			$this->responseHTTP['data'] = $this->resultDb->result_array();
			$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
			$this->__responseHttp($this->responseHTTP, 400);
		}else{
		#comprobamos que el registro exista
			$status = $this->_validData($producto);
			if ($status['status']){
				if ($request['accion'] == 'create'){
					$this->db->insert($this->controllerSPA, $producto);
					$this->responseHTTP['appst'] = 'Registro ingresada exitosamente';
					$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
					$this->__responseHttp($this->responseHTTP, 201);
				}else{
					$producto['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('id_producto', $request['id_producto']);
					$this->db->update($this->controllerSPA, $producto);
					$this->responseHTTP['appst'] = 'Item de factura actualizado';
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
	 * @return array JSON
	 */
	public function eliminar($idProducto){
		$this->db->where('id_producto' , $idProducto);
		$this->resultDb = $this->db->get($this->controllerSPA);

		if  ($this->resultDb->num_rows() > 0){
			$this->db->where('id_producto' , $idProducto);
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
			'cod_contable' => 20,
			'identificacion_proveedor' => 5,
			'cod_ice' => 39,
			'nombre' => 4,
			'capacidad_ml' => 1,
			'cantidad_x_caja' => 1,
			'grado_alcoholico' => 1,
			'costo_unidad' => 1,
			'estado' => 1,
			'custodia_doble' => 1,
			'comentarios' => 0,
			'id_user' => 1
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}


}
//http://www.xvideos.com/video30144333/cum0rsmooke_-_2017-09-10_22h33_06
