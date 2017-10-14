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
	private $resultDb;
	private $controllerSPA = "producto";
	private $responseHTTP = array("status" => "success");
	private $viewData;

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
		$resultDb = $this->db->get($this->controllerSPA);
		print(var_dump($resultDb->result_array()));
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


}
//http://www.xvideos.com/video30144333/cum0rsmooke_-_2017-09-10_22h33_06
