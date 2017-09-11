<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->library('twig');
		$data['title'] = "Producto";
		$data['iconTitle'] = "fa-dropbox";
		$data['titleContent'] = "Registro de Producto";
		$data['controller'] = "producto";
		$data['actionFrm'] =  "/validateForm";
		$this->twig->display('/pages/pageProducto.html', $data);

	}

	/**
	 * Lista todos los productos que existen en la base
	 * @return array JSON
	 */
	public function listar(){
			$this->resultDb = $this->db->get($this->controllerSPA);
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
		#comprobamos que el registro exista
			$status = $this->_validData($detalleFactura);
			if ($status['status']){
				if ($request['accion'] == 'create'){
					$this->db->insert($this->controllerSPA, $detalleFactura);
					$this->responseHTTP['appst'] = 'Factura ingredada existosamente';
					$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
					$this->__responseHttp($this->responseHTTP, 201);
				}else{
					$detalleFactura['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('detalle_pedido_factura', $request['detalle_pedido_factura']);
					$this->db->update($this->controllerSPA, $detalleFactura);
					$this->responseHTTP['appst'] = 'Item de factura actualizado';
					$this->responseHTTP['lastInfo'] = $this->mymodel->lastInfo();
					$this->__responseHttp($this->responseHTTP, 201);
				}
			}else{
				$this->responseHTTP['appst'] =
									'Uno de los datos ingresados es incorrecto, vuelva a intentar';
				$this->responseHTTP['data'] = $status;
				$this->__responseHttp($this->responseHTTP, 400);
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
			'id_pedido_factura' => 1,
			'cod_contable' =>  20,
			'nro_cajas' => 1,
			'costo_und' => 1,
			'id_user' => 1
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}



}
