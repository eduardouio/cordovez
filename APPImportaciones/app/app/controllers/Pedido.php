<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modulo encargado de manejar los pedidos de acuerdo al archivo de especificaciones
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */

class Pedido extends CI_Controller {

	private $Result_;
	private $TableDb_;
	private $numRows ;
	private $data;
	private $controller = "pedido";

	/**
	 * Cargamos la informacion inicial de la tabla y los registis
	 */
	public function __construct(){
		parent::__construct();
		$this->_loadData();
	}

	/**
	 * Carga la informacion inicial de las vitas y variables del controlador
	 */
	private function _loadData(){
		$this->data = array(
				"title" => "SPA Pedidos",
				"actionFrm" => "/validateForm",
				"controller" => $this->controller,
				"iconTitle" => "fa-cubes",
				);
	}

	/**
	 * Carga la SPA inicial del modulo de pedidos
	 */
	public function index(){
		$this->load->library('twig');
		$this->twig->display('/pages/pagePedido.html', $this->data);
	}


	/**
	 * Presenta una lista de todos los pedidos
	 */
	public function listarPedidos(){
		$respose = array("status" => "Sucess" );

		$query = $this->app_model->getRows($this->TableDb_, "1=1", "1000");
		$newData = $this->app_model->getInfo($this->TableDb_);

	}


	/**
	 * Valida la informacion del formulario
	 */
	public function validarForm(){
		print ('Formulario recibido');

	}


}
