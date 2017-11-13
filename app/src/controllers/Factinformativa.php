<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modulo encargado de manejar los proveedores, CRUD y validaciones
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Factinformativa extends MY_Controller {
	private $controller = "factura_informativa";
	private $template = '/pages/pageFactutaInformativa.html';	

	/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	* Redirecciona a la lista de las facturas informativas
	*/
	public function index(){
		$this->listar();
	}

	/**
	* nueva factura informativa
	*/
	public function listar(){
		$infoinvoices = 	$this->modelinfoinvoice->get('031-17');
		print '<pre>';
		print_r($infoinvoices);
	}


	/**
	* Presenta el formulario para registrar una nueva factura informativa
	* @param (string) $nroOrder 
	* @return viod 
	*/
	public function nuevo($nroOrder){
		$order = $this->modelorder->get($nroOrder);
		$config = [
					'create_invoice' => true,
					'order' => $order[0],
					'titleContent' => 'Ingreso de Factura Informativa Pedido: [' . $nroOrder . ']',
							];
		$this->responseHttp($config);
	}


	/**
	 * Se validan las columnas que debe tener la consulta para que no falle
	 * @return [array] | [bolean]
	 */
	private function _validData($data){
		$columnsLen = array(
					'nro_factura_informativa' => 2,
					'nro_pedido' => 6,
					'identificacion_proveedor' => 5,
					'fele_aduana' => 1,
					'seguro_aduana' => 1,
					'moneda' => 3,
					'tipo_cambio' => 1,
					'id_user' => 1,
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}


		/* *
	* Envia la respuestas html al navegador
	*/
	public function responseHttp($config){
		$config['title'] = 'Proveedores';
		$config['base_url'] = base_url();
		$config['rute_url'] = base_url() . 'index.php/';
		$config['controller'] = $this->controller;
		$config['iconTitle'] = 'fa-users';
		$config['content'] = 'home';
		return $this->twig->display($this->template, $config);
	}
}
