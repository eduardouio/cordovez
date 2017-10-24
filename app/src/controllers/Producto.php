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
	private $listPerPage = 13;

	/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
	}

	/**	
	* redirecciona a la lista de los prodcutos
	*/
	public function index(){
		$this->listar();
	}

	/**
	* Presenta lista de todos los productos Disponibles
	*/
	public function listar($offset = 0){
		$this->db->order_by('nombre', 'ASC');
		$this->db->limit($this->listPerPage, $offset);
		$resultDb = $this->db->get('productoView');
		$products = $resultDb->result_array();		
		$count = $this->db->count_all_results($this->controller);
		$pages_links =  ( $count / $this->listPerPage );

		if (gettype($pages_links) == 'double') {
			(int)$pages_links = (int)$pages_links + 1;
		};

		$config = array(
				'count' => $count,
				'titleContent' => 'Lista de Productos',
				'list' => true,
				'pagination' => true,
				'perPage' => $this->listPerPage,
				'products' => $products,
				'pagination_pages' => $pages_links,
				'current_page' => (int)(($offset)/$this->listPerPage) + 1,
				'last_page' => (int)(($pages_links - 1) * $this->listPerPage),
				'pagination_url' => base_url() . 'index.php/producto/listar/',
		);
		$this->responseHttp($config);
	}


	/**
	* Crea un nuevo profuto
	*/
	public function nuevo(){
		$this->db->like('categoria', 'licores');
		$resultDb = $this->db->get('proveedor');
		$config = array(
											'titleContent' => 'Ingresar Un Nuevo Producto', 
											'create' => true,
											'suppliers' => $resultDb->result_array(),
										);

		$this->responseHttp($config);
	}

	/**
	 * crea y/o modifica un producto
	 * @return JSON (response)
	 */
	public function validar(){
		if(empty($_POST)){
			$this->listar();
			return true;
		}
		$product = $this->input->post();
		$product['id_user'] = $this->session->userdata('id_user');

		if(!isset($product['id_producto'])){
				$this->db->where('cod_contable', 
																				$product['cod_contable']);
				$resultDb = $this->db->get($this->controller);				
				if($resultDb->num_rows() == 1 ){		
					$config['idProduct'] = $product['cod_contable'];
					$config['viewMessage'] = true;
					$config['message'] = 'El Producto Ya Está Registrado!';
					$this->responseHttp($config);
					return true;
				}	
		}

		$status = $this->_validData($product);
			if ($status['status']){
				if (!isset($product['id_producto'])){
					$this->db->insert($this->controller, $product);			
	    		header('Status: 301 Moved Permanently', false, 301);
  	      header('Location: ' . base_url() . 'index.php/producto/presentar/' . 
  	    																$product['cod_contable']);		
					return true;
				}else{
					$product['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('id_producto', $product['id_producto']);
					$this->db->update($this->controller, $product);
					header('Status: 301 Moved Permanently', false, 301);
  	      header('Location: ' . base_url() . 'index.php/producto/presentar/' . 
  	    															$product['cod_contable']);		
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
							'show' => true,
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
			'identificacion_proveedor' => 1,
			'cod_ice' => 39,
			'nombre' => 4,
			'capacidad_ml' => 1,
			'cantidad_x_caja' => 1,
			'grado_alcoholico' => 1,
			'costo_unidad' => 1,
			'estado' => 1,
			'custodia_doble' => 1,
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