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
class Proveedor extends MY_Controller {
	private $listPerPage = 40;
	private $controller = "proveedor";
	private $template = '/pages/pageProveedor.html';
	private $modelUser;
	private $modelSupplier;
	
	

	/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
		$this->init();
	}
    
	/**
	 * Inicia todos los modelos necesarios
	 */
	public function init(){
	    $this->load->model('Modelsupplier');
	    $this->load->model('Modeluser');
	    $this->modelUser = new Modeluser();
	    $this->modelSupplier = new Modelsupplier();
	}
	   
	
	
	/**
	 * Redirecciona a la lista de proveedores
	 */   
	public function index(){
		$this->listar();
	}

	/**
	* Muestra toda la informacion de un proveedor
	*/
	public function presentar($idSupplier = false ){	
		
		if (!$idSupplier) {
			$this->redirectPage('suppliersList');
			return false;
		}
        		
		$supplier = $this->modelSupplier->get($idSupplier);
		$config = array(
									'titleContent' => 'Detalle De Proveedor: ' . $supplier[0]['nombre'] ,
									'supplier' => $supplier,
									'show' => true,
									'createBy' => $this->modelUser->get($supplier['id_user']),
									);
		$this->responseHttp($config);
	}

	/**
	* Lista todos los proveedores de la base
	*/ 
	public function listar($offset=0){
		$this->db->order_by('nombre', 'ASC');
		$this->db->limit($this->listPerPage, $offset);
		$resultDb = $this->db->get($this->controller);
		$suppliers = $resultDb->result_array();
		$count = $this->db->count_all_results($this->controller);
		$pages_links = ( $count / $this->listPerPage );

		if (gettype($pages_links) == 'double') {
			(int)$pages_links = (int)$pages_links + 1;
		};

		$config = array(
							'count' => $count,
							'titleContent' => 'Lista de Proveedores',
							'list' => true,
							'pagination' => true,
							'suppliers' => $suppliers,
							'perPage' => $this->listPerPage,
							'pagination_pages' => $pages_links,
							'current_page' => (int)(($offset)/ $this->listPerPage) + 1,
							'last_page' => (int)(($pages_links - 1) *  $this->listPerPage),
							'pagination_url' => base_url() . 'index.php/proveedor/listar/',
									);

		$this->responseHttp($config);
	}

/**
* Prepara el formulario del proveedor
*/
public function nuevo(){
	$userdata = $this->session->userdata();

	$config = array(
							'titleContent' => 'Registro de Nuevo Proveedor',
							'userdata' => $userdata,
							'create' => true,
								);
	$this->responseHttp($config);
	return true;
}
	

	/**
	* Presenta un formulario de edicion de proveedor
	*/
	public function editar($idSupplier){
		if (!isset($idSupplier)){
			$this->listar();
			return true;
		};

		$this->db->where('id_proveedor', $idSupplier);
		$resultDb = $this->db->get($this->controller);
		$supplier = $resultDb->result_array();
		$supplier = $supplier[0];
		$config = array(
								'edit' => true,
								'supplier' =>  $supplier,
								'titleContent' => 'Editando Proveedor ' . $supplier['nombre'],
									);
		$this->responseHttp($config);
	}
	
	/**
	 * crea y/o modifica un pedido
	 * @return JSON (response)
	 */
	public function validar(){
		if($this->rest->_getRequestMethod()!= 'POST'){
			$this->listar();
		}

		$proveedor = $this->input->post();
		$proveedor['categoria'] = '';

		foreach ($proveedor as $key => $value) {
			if (preg_match('/categoria_/', $key)){
				$proveedor['categoria'] .= $value . ';';
				unset($proveedor[$key]);
			}
		}

		$proveedor['id_user'] = $this->session->userdata('id_user');
		if(!isset($proveedor['id_proveedor'])){
				$this->db->where('identificacion_proveedor', 
																				$proveedor['identificacion_proveedor']);
				$resultDb = $this->db->get($this->controller);
				
				if($resultDb->num_rows() == 1 ){		
					$config['supplier'] = $proveedor['identificacion_proveedor'];
					$config['viewMessage'] = true;
					$config['message'] = 'El Proveedor Ya Está Registrado!';
					$this->responseHttp($config);
					return true;
				}	
		}

		$status = $this->_validData($proveedor);
			if ($status['status']){
				if (!isset($proveedor['id_proveedor'])){
					$this->db->insert($this->controller, $proveedor);			
					$id_proveedor = $this->mymodel->lastInfo();

					print var_dump($id_proveedor);
	    		header('Status: 301 Moved Permanently', false, 301);
  	      header('Location: ' . base_url() . 'index.php/proveedor/presentar/' . 
  	    																$id_proveedor['lastInsertId']);		
					return true;
				}else{
					$proveedor['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('id_proveedor', $proveedor['id_proveedor']);
					$this->db->update($this->controller, $proveedor);
					header('Status: 301 Moved Permanently', false, 301);
  	      header('Location: ' . base_url() . 'index.php/proveedor/presentar/' . 
  	    																$proveedor['id_proveedor']);		
					return true;
				}
		}else{
			$config['order'] = $proveedor['id_proveedor'];
			$config['viewMessage'] = true;
			$config['message'] = 'La información de uno de los campos es incorrecta!';
			$config['data'] = $status['columns'];
			$this->responseHttp($config);
			return true;
		}
	}


	/**
	* Elimina un proveedor sin dependencias de la base
	*/
	public function eliminar($idSupplier){

		$this->db->where('id_proveedor', $idSupplier);
		if ($this->db->delete($this->controller)){
			$config['viewMessage'] = true;
			$config['deleted'] = true;
			$config['message'] = 'El Proveedor Fue Eliminado Exitosamente!';
			$this->responseHttp($config);
		}else{
			$config['id_supplier'] = $idSupplier;
			$config['viewMessage'] = true;
			$config['message'] = 'El Proveedor No Puede Ser Eliminado, 
																												 Tiene Dependencias!';
			$this->responseHttp($config);
		}
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
				'identificacion_proveedor' => 4,
				'id_user' => 1
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

