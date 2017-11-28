<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Arma los datos para los parametros de gastos iniciales
 * de datos
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modelincoterms extends CI_Model {
	private $table = 'gastos_nacionalizacion';
	private $modelBase;
	private $modelExpenses;

	function __construct(){
		parent::__construct();
		$this->init();
	}

	/**
	 * Carga e inicia los modelos de la clase
	 */
	private function init(){
	    $this->load->model('modelbase');
	    $this->load->model('modelexpenses');
	    $this->modelBase = new ModelBase();
	    $this->modelExpenses = new Modelexpenses();
	}
	/**
		* retorna los valores de FOB y Gastos en Origen para la provision en un 
		* pedido 
		*/
		public function get($order){
			$intcotermsParams = [
										'pais_origen' => $order['pais_origen'],
										'ciudad_origen' => $order['ciudad_origen'],
										'incoterms' => $order['incoterm']
													];
			$incoterms = $this->modelExpenses->getIncotermsParams($intcotermsParams);

			return $incoterms;			
		}

}