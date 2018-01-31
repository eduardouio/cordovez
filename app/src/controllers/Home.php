<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Encargado del inicio de sesion
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Home extends MY_Controller {
	
	private $template = '/pages/pageHome.html';
	private $modelLog;


    /**
     * Constructor de la clase
     */
	function __construct(){
		parent::__construct();
		$this->init();		
	}

	/**
	 * incia los modelos de la clase
	 */
	private function init()
	{
	    $this->load->model('modellog');
	    $this->modelLog = new Modellog();
	    $this->modelLog->generalLog('Acceso al Home');
	}

	/**	
	* Muestra el formulario de inicio de sesion
	*/
	public function index(){
		$config['title'] = 'Inicio';
		$this->responseHttp($config);
	}


	/**
	* Obtiene toda la informacion que se muestra en la pantalla del resumen
	* información de cada uno de los módulos
	*/
	private function getAllInfo(){
		return ([
					'orders' => $this->db->count_all('pedido'),
					'suppliers' => $this->db->count_all('proveedor'),
					'products' => $this->db->count_all('producto'),
					'incoterms' => $this->db->count_all('tarifa_incoterm'),
		]);

		 

	}
	
	
	/* *
	 * Envia la respuestas html al navegador
	 * @param $config => arreglo con la informacion de la plantilla
	 * @return void
	 */
	private function responseHttp($config){
	    $config = [
	        'base_url' => base_url(),
	        'rute_url' => base_url() . 'index.php/',
	        'actionFrm' => base_url() . 'index.php/login/validar',
	        'controller' => 'inicio',
	        'iconTitle' => 'fa-ship',
	        'infoBase' => $this->getAllInfo(),
	        'content' => 'home',
	        'titleContent' => 'Sistema de Importaciones &nbsp;&nbsp;&nbsp;
												<small> Lista de Módulos Disponibles </small>',
	    ];
	    
	    return $this->twig->display($this->template, $config);
	}

}