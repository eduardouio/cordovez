<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Valida los datos de las provisiones
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Facturapagos extends MY_Controller {
	private $resultDb;
	private $controller = "justificacion_gasto_nacionalizacion";
	private $template = "/pages/pageFacturas.html";

	/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	* Muestra la factura pagos pedido para un 
	*/
	public function index(){
		$invoiceParams = [
			'table' => $this->controller,
		];

		$config =	[
			'titleContent' => 'Listado de Facturas Por Pedidos',
			'list' => true,
			'invoices' => $this->getDb($invoiceParams),
			];

		$this->responseHttp($config);
	}

	/**
	* registra una nueva factura en el sistema
	*/
	public function nuevo(){
		$this->db->order_by('nombre');
		$resultDb = $this->db->get('proveedor');

		$config =	[
			'titleContent' => 'Registro de una Neva Factura',
			'suppliers' => $resultDb->result_array(),
			'create' => true,
			];

	$this->responseHttp($config);
	}


	public function validar() {
		if($this->rest->_getRequestMethod()!= 'POST'){
			$this->index();
			return true;
		}

		$invoice = $this->input->post();
		$invoice['fecha_emision'] = date('Y-m-d', 
																				strtotime($invoice['fecha_emision']));
		$invoice['id_user'] = $this->session->userdata('id_user');
		$validData = $this->_validData($invoice);

		if (!$validData['status']){
			$this->db->select('nombre');
			$this->db->where('identificacion_proveedor', 
																				$invoice['identificacion_proveedor']);
			$resultDb = $this->db->get('proveedor');
			$supplierName = $resultDb->result_array();
			$config = [
				'fail' => true,
				'message' => 'Uno de los valores ingresados no es correcto, revise los'.
																												' siguientes  campos',
				'fields_error' => $validData['len'],
				'invoice' => $this->input->post(),
				'update' => isset($invoice['id_factura_pagos']),
				'create' => !isset($invoice['id_factura_pagos']),
				'supplierName' => $supplierName[0]['nombre'],
			];
			$this->responseHttp($config);			
			return true;
		}
		isset($invoice['id_factura_pagos']) ? $this->update($invoice) : 
																											$this->create($invoice);

	}

	/**
	* Actualiza un registro en la base
	*/
	private function update(array $invoice) {
		$invoice['last_update'] = date('Y-m-d H:i:s');
		$this->db->where('id_factura_pagos', $invoice['id_factura_pagos']);
		if ($this->db->update($this->controller, $invoice)){
			$this->redirectShoInvoice($invoice['id_factura_pagos']);
			return true;
		}
		print 'Error al Actualizar el Registro ... ';
		return false;
	}


	/**
	* Crea un nuevo regisrtro en la base de datos
	*/
	private function create(array $invoice) {
		$this->db->where('identificacion_proveedor', 
																					$invoice['identificacion_proveedor']);
		$this->db->where('nro_factura', $invoice['nro_factura']);
		$resultDb = $this->db->get($this->controller);

		if ($resultDb->num_rows() == 1) {
			$invoice = $resultDb->result_array();
			$config = [
				'viewMessage' => true,
				'message' => 'El registro ya existe',
				'idRow' => $invoice[0]['id_factura_pagos'],
				'titleContent' => 'La Factura Ya Se Encuentra Registrada.',
			];
				$this->responseHttp($config);
				return false;
		}

		if($this->db->insert($this->controller, $invoice)){
			$lastInfo = $this->mymodel->lastInfo();
			$this->redirectShoInvoice($lastInfo['lastInsertId']);
			return true;
		}
			print 'Error al Guardar el Registro...';
			return false;
	}


	/**
	* Redirecciona a la factura luego de guardar 
	*/
	public function redirectShoInvoice($idInvoice){
		header('Status: 301 Moved Permanently', false, 301);
  	      header('Location: ' . base_url() . 
  	      									'index.php/facturapagos/presentar/' . $idInvoice);		
	}


	/**
	* Presenta una factura con todos su items
	*/
	public function presentar($idInvoice){
		if(!isset($idInvoice)){
			print 'Falta el parametro';
			return false;
		}

		$paramsInvoice = [
			'table' => $this->controller,
			'condition' => 'id_factura_pagos',
			'value' => $idInvoice
		];
		$invoice = $this->getDb($paramsInvoice);

		if(!$invoice) {
			print 'La factura no existe';
			return false;
		}


		$paramsSupplier = [
			'table' => 'proveedor',
			'condition' => 'identificacion_proveedor',
			'value' => $invoice[0]['identificacion_proveedor'],
		];
		$supplier = $this->getDb($paramsSupplier);

		$paramDetailInvoice = [
			'table' => 'factura_pagos_pedido',
			'condition' => 'id_factura_pagos',
			'value' => $invoice[0]['id_factura_pagos'],
		];
		$detailsInvoice = $this->getDb($paramDetailInvoice);

		$userParams = [
				'table' => 'usuario',
				'condition' => 'id_user',
				'value' => $invoice[0]['id_user'],
					];
		$userdata = $this->getDb($userParams);

		$config = [
			'titleContent' => 'Detalle de Factura # [ ' . $invoice[0]['nro_factura'] . ' ]',
			'invoice' => $invoice[0],
			'supplier' => $supplier[0],
			'userdata' => $userdata[0],
			'detailsInvoice' => $detailsInvoice,
			'show' => true,
		];	
		$this->responseHttp($config);			
	}


	private function getDb($params){
		if (isset($params['condition'])){
			$this->db->where($params['condition'],$params['value']);
		}

		$resultDb = $this->db->get($params['table']);
		if ($resultDb->num_rows() > 0) {
			return $resultDb->result_array();
		}
		return false;
	}

	/**
	 * Se validan las columnas que debe tener la consulta para que no falle
	 * @return [array] | [bolean]
	 */
	private function _validData($data){
		$paramsData = [
								'identificacion_proveedor' => 5,
								'nro_factura' => 1,
								'fecha_emision' => 10,
								'valor' => 2,
								'id_user' => 1,
									];
		return $this->_checkColumnsData($paramsData, $data);
	}


			/* *
		* Envia la respuestas html al navegador
		*/
		public function responseHttp($config){
			$config['title'] = 'Pedidos';
			$config['base_url'] = base_url();
			$config['rute_url'] = base_url() . 'index.php/';
			$config['controller'] = $this->controller;
			$config['iconTitle'] = 'fa-file-text';
			$config['content'] = 'home';
			return $this->twig->display($this->template, $config);
		}
}
