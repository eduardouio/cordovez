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
	private $controllerSPA = "incoterm_provision";
	private $responseHTTP = array("status" => "success");
	private $viewData;


	/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
	}


	/**
	* Obtiene la lista de incoterms de acuerdo al los siguientes criterios, 
	* progresivamente si se da el parametro $city se debe tener valores para los
	* dos anteriores y de la misma forma en caso de $country
	*
	* (Nada) => Lista incoterms por tipo
	* Si $iconterm => Lista Los incoterms por pais
	* Si $incoterm & $country => lista las ciudades donde coincidan los dos param
	* Si $incoterm & $country & $city Lista las tipos de incoterms disponibles
	* es el origen especificado ejemplo
	* 
	* $incoterm = 'FOB'; 
	* $country =  'ESPANA'; 
	* $city = 'MADRID'
	*
	* Retorna 
	* +-------------+---------------------+---------+-----------+--------+------
	* | id_incoterm | tipo                | pais    | incoterms | ciudad | tarifa 
	* +-------------+---------------------+---------+-----------+--------+--------
	* |           5 | GASTO INTERNACIONAL | ESPAÑA  | FOB       | BILVAO |      0 
	* |          16 | FLETE               | ESPAÑA  | FOB       | BILVAO |      0 
	* +-------------+---------------------+---------+-----------+--------+--------
	*
	* @param $incoterm tipo de incoterm
	* @param $country  nombre del pais
	* @param $incoterm  nombre de la ciudad
	*
	* @return array JSON
	* 
	**/
	public function getIncoterms($incoterm = "", $country = "" , $city = ""){
			
		#base_url/getIncoterms/
		if($incoterm == "" && $country == ""  && $city == ""){
			$this->db->select('incoterms');
			$this->db->group_by('incoterms');
			$this->resultDb = $this->db->get($this->controllerSPA);	
		}

		#base_url/getIncoterms/exw/
		if($incoterm != "" && $country == ""  && $city == ""){
			$this->db->select('pais');
			$this->db->where('incoterms' , $incoterm);
    	$this->db->group_by('pais');
    	$this->resultDb = $this->db->get($this->controllerSPA);
		}

		#base_url/getIncoterms/exw/argentina
		if($incoterm != "" && $country != ""  && $city == ""){
			$this->db->select('ciudad');
			$this->db->where('incoterms' , $incoterm);
			$this->db->where('pais' , $country);
    	$this->db->group_by('ciudad');
    	$this->resultDb = $this->db->get($this->controllerSPA);
		}

		#base_url/getIncotrems/exw/argentina/mendoza
		if($incoterm != "" && $country != ""  && $city != ""){
			$columns = array (
												'id_incoterm',
												'incoterms',
												'tipo',
												'pais',
												'ciudad',
												'tarifa',
												'comentarios'
												);
			$this->db->select($columns);
			$this->db->where('incoterms' , $incoterm);
			$this->db->where('pais' , $country);
			$this->db->where('ciudad' , $city);
    	$this->resultDb = $this->db->get($this->controllerSPA);
		}
		

    if($this->resultDb->num_rows() > 0){
			$this->responseHTTP["data"] = $this->resultDb->result_array();
			$this->responseHTTP["message"] = "Se encontraron " .
									$this->resultDb->num_rows() . " registros";
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
