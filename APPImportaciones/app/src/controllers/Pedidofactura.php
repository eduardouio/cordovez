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
	private $controller = "pedido_factura";
	private $template = '/pages/pagePedidoFactura.html';

		/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	* Presenta una factura pedido a detalle
	*/
	public function presentar($idInvoice){		
		$this->db->where('id_pedido_factura', $idInvoice);
		$resultDb = $this->db->get('pedido_factura');
		$invoice = $resultDb->result_array();
		$this->db->where('id_user', $invoice[0]['id_user']);
		$resultDb = $this->db->get('usuario');
		$userdata = $resultDb->result_array();
		$config['show_invoices'] = true;
		$config['user'] = $userdata[0];
		$config['invoice'] = $invoice;
		$config['supplier'] = $this->_getDb('identificacion_proveedor', 
																				$invoice[0]['identificacion_proveedor'], 
																																	'proveedor');		
		$config['invoiceDetail'] = $this->getDetailInvoice($idInvoice);
		$config['titleContent'] = 'Detalle Factura [ # ' . 
															$invoice[0]['id_factura_proveedor'] . 
															' ] Pedido [ ' . $invoice[0]['nro_pedido'] . ' ]';
		$this->responseHttp($config);
	}


	/**
	* Muestra el formulario para crear una factura
	*/
	public function nuevo($nroOrder){
		$this->db->where('nro_pedido', $nroOrder);
		$order = $this->db->get('pedido');
		$this->db->where('tipo_provedor', 'INTERNACIONAL');
		$supplier = $this->db->get('proveedor');
		$config['create_invoice'] = true;
		$config['order'] = $order->result_array();
		$config['suppliers'] = $supplier->result_array();
		$this->responseHttp($config);
	}


		/**
	* Muestra el formulario de edicion 
	*/
	public function editar($invoiceId){
		$this->db->where('id_pedido_factura', $invoiceId);
		$resultDb = $this->db->get($this->controller);
		$invoice = $resultDb->result_array();

		$this->db->where('identificacion_proveedor' , 
																			$invoice[0]['identificacion_proveedor']);
		$resultDb = $this->db->get('proveedor');
		$config['edit_invoice'] = true;
		$config['invoice'] = $invoice;
		$config['supplier'] = $resultDb->result_array();
		$this->responseHttp($config);
	}

	/**
	 * elimina un pedido de la tabla, solo lo elimina sino tiene parciales
	 */
	public function eliminar($invoiceId){
		$this->db->where('id_pedido_factura', $invoiceId);
		$resultDb = $this->db->get($this->controller);
		$order = $resultDb->result_array();
		$this->db->where('id_pedido_factura', $invoiceId);
		if ($this->db->delete($this->controller)){
			$config['order'] = $order[0]['nro_pedido'];
			$config['viewMessage'] = true;
			$config['deleted'] = true;
			$config['message'] = 'Factura Eliminada Exitosamente!';
			$this->responseHttp($config);
		}else{
			$config['order'] = $order[0]['nro_pedido'];
			$config['viewMessage'] = true;
			$config['message'] = 'El Pedido No Puede Ser Eliminado, 
																												 Tiene Dependencias!';
			$this->responseHttp($config);
		}
	}


	/**
	 * crea y/o modifica una factura pedido
	 * @return JSON (response)
	 */
	public function validar(){
		if($this->rest->_getRequestMethod()!= 'POST'){
			$this->_notAuthorized();
		}

		$orderInvoice = $this->input->post();
		$orderInvoice['id_user'] = $this->session->userdata('id_user');

		if(!isset($orderInvoice['id_pedido_factura'])){
			
				$this->db->where('id_factura_proveedor',
																			 $orderInvoice['id_factura_proveedor']);
				$this->db->where('identificacion_proveedor',
																		$orderInvoice['identificacion_proveedor']);
				$resultDb = $this->db->get($this->controller);
				$order = $resultDb->result_array();


				if($resultDb->num_rows() == 1 ){		
					$order = $order[0];
					$config['order'] = $order['nro_pedido'];
					$config['viewMessage'] = true;
					$config['message'] = 'Error: La factura ya se encuentra resgistrada!';
					$this->responseHttp($config);
					return true;
				}	
		}

		$orderInvoice['vencimiento_pago'] = date('Y-m-d' ,
																	strtotime($orderInvoice['vencimiento_pago']));
		$orderInvoice['fecha_emision'] = date('Y-m-d' ,
																	strtotime($orderInvoice['fecha_emision']));
		$status = $this->_validData($orderInvoice);

			if ($status['status']){
				if (!isset($orderInvoice['id_pedido_factura'])){
					$this->db->insert($this->controller, $orderInvoice);
					$this->presentarPedido($orderInvoice['nro_pedido']);
					return true;
				}else{
					$orderInvoice['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('id_pedido_factura', $orderInvoice['id_pedido_factura']);
					$this->db->update($this->controller, $orderInvoice);
					$this->presentarPedido($orderInvoice['nro_pedido']);
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
	* Presenta el pedido cuando se hacen los cambios
	*/
	private function presentarPedido($nroOrder){
		header('Location: ' . base_url() . 'index.php/pedido/presentar/' . $nroOrder);
	}


	/**
	* Obtiene los detalles de la factura de pedido
	*/
	private function getDetailInvoice($idInvoice){
		$this->db->where('id_pedido_factura', $idInvoice);
		$resultDb = $this->db->get('detalle_pedido_factura');
		$details = $resultDb->result_array();

		$products = array();
		
		foreach ($details as $key => $value) {
			$this->db->where('cod_contable', $value['cod_contable']);
			$resultDb = $this->db->get('producto');
			$product = $resultDb->result_array();

			$value['nombre'] = $product[0]['nombre'];
			$value['unidades'] = ((int)($product[0]['cantidad_x_caja']) * 
																										(int)($value['nro_cajas']));
			$value['costo_caja'] = ((float)($product[0]['cantidad_x_caja']) * 
																									(float)($value['costo_und']));
			$value['costo_total'] = ((float)($value['unidades']) * 
																									(float)($value['costo_und']));
			$value['cantidad_x_caja'] = $product[0]['cantidad_x_caja'];
			$products[$key] = $value;
		}

		return $products;
	}

	/**
	 * se validan los datos que deben estar para que la consulta no falle
	 * @return [array] | [bolean]
	 */
	private function _validData($data){
		$columnsLen = array(
			'nro_pedido' => 6,
			'id_factura_proveedor' => 0,
			'identificacion_proveedor' => 0,
			'fecha_emision' => 10,
			'valor' => 1,
			'moneda' => 1,
			'tipo_cambio' => 1,
			'vencimiento_pago' => 10,
			'id_user' => 1,
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
			return $this->twig->display($this->template, $config);
		}

}
