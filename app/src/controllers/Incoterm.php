	<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modulo encargado de manejar los proveedores, CRUD y validaciones si el inco
 * erm no existe se coloca un registro cero significa que no hay valores por 
 * por defecto para los gastos iniciales 
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Incoterm extends MY_Controller {
	private $controller= "incoterm_provision";
	private $template = '/pages/pageIncoterms.html';

	/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	* muestra una lista de 
	*/
	public function index(){
		$this->listar();	
	}

	/**
	* Lista de incoterms provisiones
	*/
	public function listar(){
		$incoterms = $this->_getDb($params); 

		$config = array(
							'titleContent' => 'Incoterms',
									);
	}


	/**
	* Retorna el resultado de una consulta
	*/
	private function _getDb($config){
		print var_dump($config);
	}

	/* *
		* Envia la respuestas html al navegador
		*/
		public function responseHttp($config){
			$config['title'] = 'Pedidos';
			$config['base_url'] = base_url();
			$config['rute_url'] = base_url() . 'index.php/';
			$config['controller'] = $this->controller;
			$config['iconTitle'] = 'fa-cubes';
			$config['content'] = 'home';
			return $this->twig->display($this->template, $config);
		}

}
