<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modulo encargado de manejar los proveedores, CRUD y validaciones
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
	private $resultDb;
	private $controllerSPA = "incoterm_provicion";
	private $responseHTTP = array("status" => "success");
	private $viewData;


	/**
	 * Obtiene una lista de los incoterms de acuerdo con los tipos y aplica filtro
	 * $name = nombre de la columna incoterm
	 * Ejemplo:
	 * Listar Tipo de incoterms => $type = FOB FCR EXW etc
	 * Lostar por Pais 
	 * @return array JSON
	 */
	public function getType(){
		#obtiene un listado de todos los incoterms rependiento el tipo
			
      $this->db->select('incoterms');
      $this->db->group_by('incoterms');
      $this->resultDb = $this->db->get($this->controllerSPA);
      
			if($this->resultDb->num_rows() > 0){
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["message"] = "Se encontraron " .
																			$this->resultDb->num_rows() .
																			" items";
			$this->responseHTTP["count"] = $this->resultDb->num_rows();
			$this->responseHTTP["appst"] = "1100";

		}else{
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["message"] = "No existen registros almacenados";
			$this->responseHTTP["getInfo"] = 
																	$this->mymodel->getInfo($this->controllerSPA);
			$this->responseHTTP["appst"] = "2100" ;
		}	
			$this->__responseHttp($this->responseHTTP, 200);
	}
}
