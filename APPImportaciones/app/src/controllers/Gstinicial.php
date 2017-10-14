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
	* Presenta el formularion para un gasto iniial
	*/
	public function nuevo($nroOrder){
			$this->db->where('nro_pedido', $nroOrder);
			$resultDb = $this->db->get($this->controller);
			$order = $resultDb->result_array();
			$resultDb = $this->db->get('proveedor');
			$suppliers = $resultDb->result_array();

			$config['create'] = true;
			$config['order'] = $order;
			$config['suppliers'] = $suppliers;
			$this->responseHttp($config);
	}


	/**
	* Valida un registro que biene de desde
	*/
	public function validar(){

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
		$config['titleContent'] = 'Gasto Inicial';
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
