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
	private $table = 'tarifa_incoterm';
	private $modelBase;
	private $modelLog;
	
	function __construct(){
		parent::__construct();
		$this->init();
	}

	/**
	 * Carga e inicia los modelos de la clase
	 */
	private function init()
	{
	    $this->load->model('modelbase');
	    $this->load->model('modellog');
	    $this->modelBase = new ModelBase();
	    $this->modelLog = new Modellog();
	}
	   
	
	/**
	 * crea un nuevo incoterm en la base de datos
	 * @param array $incoterm arreglo con la informacion de un incoterm
	 * @return bool | int last insert id
	 */
	public function create(array $incoterm)
	{
	    if($this->db->insert($this->table, $incoterm)){
	        $this->modelLog->queryInsrertLog($this->db->last_query());
	        return $this->db->insert_id();
	    }
	    return false;
	}
	
	/**
	 * Actualiza el registro de un incoterm
	 * @param array $incoterm arreglo con la informacion de incorterm
	 * @return bool
	 */
	public function update(array $incoterm):bool
	{
	    $this->db->where('id_incoterm', $incoterm['id_incoterm']);
	    if($this->db->update($this->table, $incoterm)){
	        $this->modelLog->queryUpdateLog($this->db->last_query());
	        return true;
	    }
	    return false;
	}
	
	/**
	 * Elimina un registro de la base de datos 
	 * @param int $idIncoterm identificador dek registro
	 * @return bool
	 */
	public function delete(int $idIncoterm):bool
	{
	    $this->db->where('id_incoterm', $idIncoterm);
	    if($this->db->delete($this->table)){
	        return true;
	    }
	    return false;
	}

}