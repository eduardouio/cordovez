
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
	private $controller= "detalle_pedido_factura";
	private $template = '/pages/pagePedidoFacturaDetalle.html';

		/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	* Crea un nuevo producto en una factuar
	*/
	public function nuevo($idInvoice){
		$this->db->where('id_pedido_factura', $idInvoice);
		$invoicedb = $this->db->get('pedido_factura');
		$invoice = $invoicedb->result_array();
		$this->db->where('identificacion_proveedor', 
																		$invoice[0]['identificacion_proveedor']);
		$products = $this->db->get('producto');
		$config['create'] = true;		
		$config['products'] = $products->result_array();
		$config['productsarray'] = json_encode($products->result_array());
		$config['invoice'] = $invoice;
		$this->responseHttp($config);
	}


	/**
	* Prepara el formulario para la edicion
	*/
	public function editar($idDetail){
		$this->db->where('detalle_pedido_factura', $idDetail);
		$resultDb = $this->db->get($this->controller);
		$detail = $resultDb->result_array();
		$this->db->where('cod_contable', $detail[0]['cod_contable']);
		$resultDb = $this->db->get('producto');
		$product = $resultDb->result_array();
		$config['edit'] = true;
		$config['detail'] = $detail;
		$config['nombre'] = $product[0]['nombre'];
		$this->responseHttp($config);

	}

	
	/**	
	* Elimina un detalle de factura
	*/
	public function eliminar($idDetail){
		$this->db->where('detalle_pedido_factura', $idDetail);
		$resultDb = $this->db->get($this->controller);
		$detail = $resultDb->result_array();

		$this->db->where('detalle_pedido_factura', $idDetail);
		if ($this->db->delete($this->controller)){
			$config['orderDetail'] = $detail[0]['id_pedido_factura'];
			$config['viewMessage'] = true;
			$config['deleted'] = true;
			$config['message'] = 'La factura fue eliminada Exitosamente!';
			$this->responseHttp($config);
		}else{
			$config['orderDetail'] = $detail[0]['id_pedido_factura'];
			$config['viewMessage'] = true;
			$config['message'] = 'El pedido no puede ser Eliminado, 
																												 tiene dependencias!';
			$this->responseHttp($config);
		}
	}


	/**
	* Valida los datos antes de guardar en la base de datos
	*/
	public function validar(){
		if($this->rest->_getRequestMethod()!= 'POST'){
			$this->_notAuthorized();
		}

		$detail =  $this->input->post();
		$detail['id_user'] = $this->session->userdata('id_user');

		if(!isset($detail['detalle_pedido_factura'])){
				$this->db->where('cod_contable',
																			 $detail['cod_contable']);
				$this->db->where('id_pedido_factura',
																		$detail['id_pedido_factura']);
				$resultDb = $this->db->get($this->controller);

				if($resultDb->num_rows() == 1 ){		
					$config['orderInvoice'] = $resultDb->result_array();
					$config['viewMessage'] = true;
					$config['message'] = 'Este producto ya esta en la factura!';
					$this->responseHttp($config);
					return true;
				}	
		}

		$status = $this->_validData($detail);

			if ($status['status']){
				if (!isset($detail['detalle_pedido_factura'])){
					$this->db->insert($this->controller, $detail);
					$this->presentarFactura($detail['id_pedido_factura']);
					return true;
				}else{
					$detail['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('detalle_pedido_factura', $detail['detalle_pedido_factura']);
					$this->db->update($this->controller, $detail);
					$this->presentarFactura($detail['id_pedido_factura']);
					return true;
				}
		}else{
			$config['viewMessage'] = true;
			$config['message'] = 'La información de uno de los campos es incorrecta!';
			$config['data'] = $status['columns'];
			$this->responseHttp($config);
			print(var_dump($status['columns']));
			return true;
		}	
	}


	/**
	* Presenta una factura cos sus productos
	*/
	public function presentarFactura($idIvoice){
		header('Location: ' . base_url() . 'index.php/pedidofactura/presentar/' . 
																																	$idIvoice);
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


	/* *
	* Envia la respuestas html al navegador
	*/
	public function responseHttp($config){
		$config['title'] = 'Facturas Pedidos';
		$config['base_url'] = base_url();
		$config['rute_url'] = base_url() . 'index.php/';
		$config['controller'] = $this->controller;
		$config['iconTitle'] = 'fa-cubes';
		$config['content'] = 'home';
		$config['titleContent'] = 'Ingreso De Producto';
		return $this->twig->display($this->template, $config);
	}

}
