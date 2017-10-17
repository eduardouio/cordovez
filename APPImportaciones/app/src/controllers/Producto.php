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
	private $controller= "producto";
	private $template = '/pages/pageProducto.html';

	/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	* Presenta un prodycro
	*/
	public function presentar($idProduct){
		$this->db->where('cod_contable' , $idProduct);
		$resultDb = $this->db->get($this->controller);
		$product = $resultDb->result_array();
		$this->db->where('identificacion_proveedor', $product[0]['identificacion_proveedor']);
		$resultDb = $this->db->get('proveedor');
		$supplier = $resultDb->result_array();

		$this->db->where('id_user', $product[0]['id_user']);
		$resultDb = $this->db->get('usuario');
		$user = $resultDb->result_array();
		$config = array(
							'titleContent' => 'Detalle de Producto',
							'product' => $product[0],
							'supplier' => $supplier[0],
							'createBy' => $user[0],
							'title' => 'Productos',

								);
		
		$this->responseHttp($config);
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

