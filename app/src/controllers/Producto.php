<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modulo encargado de manejar los pedidos, CRUD y validaciones
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Producto extends MY_Controller {
	private $controller= "producto";
	private $template = '/pages/pageProducto.html';
	private $listPerPage = 15;
	private $modelSupplier;
	private $modelProduct;
	private $modelUser;
	
	/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
		$this->init();
	}
    
	/**
	 * Inicializa los modelos de la clase de producto
	 */
	private function init(){
	    $this->load->model('Modelproduct');
	    $this->load->model('Modelsupplier');
	    $this->load->model('Modeluser');
	    $this->modelProduct = new Modelproduct();
	    $this->modelSupplier = new Modelsupplier();
	    $this->modelUser = new Modeluser();
	}
	
	
	/**	
	* redirecciona a la lista de los prodcutos
	*/
	public function index(){
		$this->redirectPage('productsList');
		return true;
	}

	/**
	* Presenta lista de todos los productos Disponibles
	* @return string template
	*/
	public function listar($offset = 0){
		$this->db->order_by('nombre', 'ASC');
		$this->db->limit($this->listPerPage, $offset);
		$resultDb = $this->db->get($this->controller);		
		$count =  $this->db->count_all_results($this->controller);
		$pages_links = 0;
		if ($resultDb) {
			$products = $resultDb->result_array();
			$pages_links =  ( $count / $this->listPerPage );
			if (gettype($pages_links) == 'double') {
			    (int)$pages_links = (int)$pages_links + 1;
			};
		}
		$this->responseHttp([
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
		]);
	}


	/**
	* Presenta el formulario para regitro de un nuevo producto
	* @return template
	*/
	public function nuevo(){
	    $suppliers = $this->modelSupplier->getByCategory('licores');
	    if ($suppliers == false){
	        $this->redirectPage('supplierNew');
	        return false;
	    }
	    $this->responseHttp([
			'titleContent' => 'Ingresar Un Nuevo Producto', 
			'create' => true,
			'suppliers' => $suppliers,
    						]);
	}

	/**
	 * Actualiza o registra un nuevo producto en la tabla
	 * @param array $_POST arreglo del producto
	 * @return boolean
	 */
	public function validar(){
		if(empty($_POST)){
			$this->listar();
			return true;
		}
		$product = $this->input->post();
		$product['id_user'] = $this->session->userdata('id_user');

		$status = $this->_validData($product);
			if ($status['status']){
				if (isset($product['id_producto'])){
				    if($this->modelProduct->update($product['id_producto'], $product)){
				       $this->redirectPage('productPresent', $product['cod_contable']);
				       return true;
				    }else{
				       $this->redirectPage('productsList');
				    }
				}else{
					if($this->modelProduct->create($product)){
					    $this->redirectPage('productPresent', $product['cod_contable']);
					    return true;
					}else{
					    $this->responseHttp([
					        'viewMessage' => true,
					        'message' => 'Hubo un problema al registrar el producto,' .
					        ' el probable que el producto ya exista',
					        'idProduct' => $product['cod_contable'],
					    ]);				     
					}
				}
		  }else{
		      $this->responseHttp([
		          'viewMessage' => true,
		          'errorForm' => true,
		          'create' => true,
		          'product' => $product,
		          'supplierData' => $this->modelSupplier->get($product['identificacion_proveedor']),
		          'suppliers' => $this->modelSupplier->getByCategory('licores'),
		          'message' => 'La información de uno de los campos es incorrecta!',
		          'errorList' => $status,
		      ]);
		}
	}


	/**
	* Presenta un prodycro
	*/
	public function presentar($codContable){
	    $product = $this->modelProduct->get($codContable);
	    if ($product == false){
	        $this->index();
	        return false;
	    }
	    $this->responseHttp([
							'titleContent' => 'Detalle de Producto:  [<small>' . 
	                           $product['nombre'] . '</small>]',
							'show' => true,
							'product' => $product,
							'supplier' => $this->modelSupplier->get($product['identificacion_proveedor']),
							'createBy' => $this->modelUser->get($product['id_user']),
							]);	
	}
	
	
	/**
	 * Presenta el formulario para editar el produco
	 * @param integer $idProduct id de tabla
	 * @return string template
	 */
	public function editar($idProduct){
	    $product = $this->modelProduct->getById($idProduct);
	    if($product == false){
	        $this->index();
	        return false;
	    }
	    $this->responseHttp([
	        'edit' => true,
	        'supplierData' => $this->modelSupplier->get($product['identificacion_proveedor']),
	        'product' => $product,
	    ]);
	}
	
	/**
	 * Elimina un producto de la tabla, si el producto esta referenciado 
	 * retorna falso
	 * @param integer $idProducto id de tabla
	 * @return string template
	 */
	public function eliminar($idProduct){
	    $product = $this->modelProduct->getById($idProduct);
	    if($product == false){
	        $this->index();
	        return false;
	    }
	   
	    if($this->modelProduct->delete($idProduct)){
	        $this->index();
	        return  true;
	    }
	    
	    $this->responseHttp([
	            'idProduct' => $product['cod_contable'],
	            'viewMessage' => true,
	            'message' => 'El Producto No Puede Ser Eliminado,
										                      Tiene Dependencias!',
	    ]);
	}
	
	 /**
     * Realiza una busqueda de productos  
     * nombre
     * RUC
     * CATEGORIA 
     */
    public function buscar(){
       if(!$_POST){
           $this->index();
           return true;
       }   
       $products = $this->modelProduct->search($this->input->post('searchCriteria'));
       $this->responseHttp([
           'titleContent' => 'Lista de Productos Encontrados Para: [<strong>' . 
                            $this->input->post('searchCriteria') . '</strong>]',
           'list' => true,
           'count' => count($products),
           'products' => $products,
       ]);
    }
    
    
	/**
	 * se validan los datos que deben estar para que la consulta no falle
	 * @return [array] | [bolean]
	 */
	private function _validData($data){
		$columnsLen = array(
			'cod_contable' => 20,
			'identificacion_proveedor' => 1,
			'cod_ice' => 30,
			'nombre' => 4,
			'capacidad_ml' => 1,
			'cantidad_x_caja' => 1,
			'grado_alcoholico' => 1,
			'costo_caja' => 1,
			'estado' => 1,
			'custodia_doble' => 1,
			'id_user' => 1
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}

		/* *
		* Envia la respuestas html al navegador
		*/
		private function responseHttp($config){
			$config['title'] = 'Módulo Productos';
			$config['base_url'] = base_url();
			$config['rute_url'] = base_url() . 'index.php/';
			$config['controller'] = $this->controller;
			$config['iconTitle'] = 'fa-cube';
			$config['content'] = 'home';
			return $this->twig->display($this->template, $config);
		}
}