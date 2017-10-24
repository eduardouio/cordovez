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
class Gstinicial extends MY_Controller {	
	private $controller = "gastos_iniciales_r70";
	private $template = '/pages/pageGasto-inicial.html';
	
	/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
	}


	/**
	* Elimina un pedido 
	*/
	public function eliminar($idInitExpense){
		$this->db->where('id_gastos_iniciales', $idInitExpense);
		$resultDb = $this->db->get($this->controller);
		$detail = $resultDb->result_array();

		$this->db->where('id_gastos_iniciales', $idInitExpense);
		if ($this->db->delete($this->controller)){
			$config['order'] = $detail[0]['nro_pedido'];
			$config['viewMessage'] = true;
			$config['deleted'] = true;
			$config['message'] = 'La factura fue eliminada Exitosamente!';
			$this->responseHttp($config);
			return true;
		}else{
			$config['orderDetail'] = $detail[0]['id_pedido_factura'];
			$config['viewMessage'] = true;
			$config['message'] = 'El pedido no puede ser Eliminado, 
																												 tiene dependencias!';
			$this->responseHttp($config);
			$this->db->where('id_gastos_iniciales', $idInitExpense);
		}
	}

	/**
	* Presenta un gasto inicial
	*/
	public function presentar($idInitExpense){
		$this->db->where('id_gastos_iniciales', $idInitExpense);
		$resultDb = $this->db->get($this->controller);
		$initExpense = $resultDb->result_array();

		$this->db->where('identificacion_proveedor', 
																	$initExpense[0]['identificacion_proveedor']);
		$resultDb = $this->db->get('proveedor');
		$supplier = $resultDb->result_array();

		$this->db->where('nro_pedido', $initExpense[0]['nro_pedido']);
		$resultDb = $this->db->get('pedido');
		$order = $resultDb->result_array();

		$config = array(
						'order' => $order[0],
						'initExpense' => $initExpense[0],
						'supplier' => $supplier[0],
						'createBy' => $this->session->userdata(),
						'titleContent' => 'Descripción De Gasto Incial Pedido:' . 
																					$order[0]['nro_pedido'] ,
						'show' => true,
		);

		$this->responseHttp($config);
	}

	/**
	* Presenta el formularion para un gasto iniial
	*/
	public function nuevo($nroOrder){
			$this->db->where('nro_pedido', $nroOrder);
			$resultDb = $this->db->get($this->controller);
			$order = $resultDb->result_array();
			$resultDb = $this->db->get('proveedor');
			$suppliers = $resultDb->result_array();

			$this->db->select('concepto');
			$this->db->where('nro_pedido', $order[0]['nro_pedido']);
			$resultDb = $this->db->get($this->controller);
		
			$config['used_expenses'] = json_encode($resultDb->result_array());
			$config['create'] = true;
			$config['order'] = $order;
			$config['suppliers'] = $suppliers;
			$config['titleContent'] = 'Registro De Gasto Inicial Provisión ' . 
																												'[ Pedido ' . $nroOrder . ']';
			$this->responseHttp($config);
	}


	/**
	* Edita un gasto inicial
	*/
	public function editar($idInitExpense){
		$this->db->where('id_gastos_iniciales', $idInitExpense);
		$resultDb = $this->db->get($this->controller);
		$initExpense = $resultDb->result_array();

		$this->db->where('identificacion_proveedor', 
																	$initExpense[0]['identificacion_proveedor']);
		$resultDb = $this->db->get('proveedor');
		$supplier = $resultDb->result_array();

		$resultDb = $this->db->get('proveedor');
		$suppliers = $resultDb->result_array();

		$this->db->where('nro_pedido', $initExpense[0]['nro_pedido']);
		$resultDb = $this->db->get('pedido');
		$order = $resultDb->result_array();

		
			
		$config = array(
						'order' => $order[0],
						'initExpense' => $initExpense[0],
						'supplier' => $supplier[0],
						'suppliers' => $suppliers,
						'createBy' => $this->session->userdata(),
						'titleContent' => 'Descripción De Gasto Incial Pedido:' . 
																					$order[0]['nro_pedido'] ,
						'edit' => true,
		);




		$this->responseHttp($config);
	}


	/**
	* Valida un registro que biene de desde
	*/
	public function validar(){
		$initExpense = $this->input->post();
		$initExpense['id_user'] = $this->session->userdata('id_user');
		$initExpense['fecha'] = date('Y-m-d' , strtotime($initExpense['fecha']));
		$initExpense['fecha_fin'] = date('Y-m-d' , strtotime($initExpense['fecha_fin']));

			if(!isset($initExpense['id_gastos_iniciales'])){
				$this->db->where('nro_pedido', $initExpense['nro_pedido']);
				$this->db->where('concepto', $initExpense['concepto']);
				
				$resultDb = $this->db->get($this->controller);

				if($resultDb->num_rows() == 1 ){		
					$config['orderInvoice'] = $resultDb->result_array();
					$config['viewMessage'] = true;
					$config['message'] = 'Este producto ya esta en la factura!';
					$this->responseHttp($config);
					return true;
				}	
		}

		$status = $this->_validData($initExpense);

			if ($status['status']){
				if (!isset($initExpense['id_gastos_iniciales'])){
					$this->db->insert($this->controller, $initExpense);
					$this->presentarPedido($initExpense['nro_pedido']);
					return true;
				}else{					
					$initExpense['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('id_gastos_iniciales', $initExpense['id_gastos_iniciales']);
					$this->db->update($this->controller, $initExpense);
					$this->presentarPedido($initExpense['nro_pedido']);
					return true;
				}
		}else{
			$config['viewMessage'] = true;
			$config['message'] = 'La información de uno de los campos es incorrecta!';
			$config['data'] = $status['columns'];
			$this->responseHttp($config);
			return true;
		}	

	}

	/**
	* Presenta el pedido completo
	*/
	public function presentarPedido($nroOrder){
		header('Location: ' . base_url() . 'index.php/pedido/presentar/' . 
																																		$nroOrder);
	}

	/**
	 * Se validan las columnas que debe tener la consulta para que no falle
	 * @return [array] | [bolean]
	 */
	private function _validData($data){
		$columnsLen = array(
        'nro_pedido' => 6,
        'concepto' => 1,
        'valor_provisionado' => 1,
        'id_user' => 1,
        'fecha' => 10,
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


	/**
	* Presenta una factura cos sus productos
	*/
	public function pesentarPedido(){
		header('Location: ' . base_url() . 'index.php/pedidofactura/presentar/' . 
																																	$idIvoice);
	}


}
