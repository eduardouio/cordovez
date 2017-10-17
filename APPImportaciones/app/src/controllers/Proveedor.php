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
class Proveedor extends MY_Controller {
	private $controller = "proveedor";
	private $template = '/pages/pageProveedor.html';

		/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	* Muestra toda la informacion de un proveedor
	*/
	public function presentar($idSupplier){	
		$this->db->where('id_proveedor', $idSupplier);
		$resultDb = $this->db->get($this->controller);
		$supplier = $resultDb->result_array();

		$config = array(
									'titleContent' => 'Detalle De Proveedor: ' . $supplier[0]['nombre'] ,
									'supplier' => $supplier[0],
									'createBy' => $this->getUserDataDb($supplier[0]['id_user']),
									);
		$this->responseHttp($config);
	}

	/**
	 * se validan los datos que deben estar para que la consulta no falle
	 * @return [array] | [bolean]
	 */
	private function _validData($data){
		$columnsLen = array(
				'nombre' => 4,
				'tipo_provedor' => 6,
				'categoria' => 8,
				'identificacion_proveedor' => 6,
				'comentarios' => 0,
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
		return $this->twig->display($this->template, $config);
	}
}
