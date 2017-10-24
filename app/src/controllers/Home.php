<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Encargado del inicio de sesion
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Home extends MY_Controller {
	
	private $template = '/pages/pageHome.html';




	function __construct(){
		parent::__construct();
	}


	/**	
	* Muestra el formulario de inicio de sesion
	*/
	public function index(){
		$config['title'] = 'Inicio';
		$this->responseHttp($config);
	}


		/* *
	* Envia la respuestas html al navegador
	*/
	public function responseHttp($config){
		$config['base_url'] = base_url();
		$config['rute_url'] = base_url() . 'index.php/';
		$config['actionFrm'] = base_url() . 'index.php/login/validar';
		$config['controller'] = 'inicio';
		$config['iconTitle'] = 'fa-ship';
		$config['content'] = 'home';
		$config['titleContent'] = 'Sistema de Importaciones &nbsp;&nbsp;&nbsp;'.
															' <small> Lista de Módulos Disponibles </small>';
		return $this->twig->display($this->template, $config);
	}



}