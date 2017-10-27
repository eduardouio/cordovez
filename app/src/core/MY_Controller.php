<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modulo encargado de manejar las sesiones
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */

class MY_Controller extends CI_Controller{

	public function __construct() {
       parent::__construct();
			 $this->load->library('session');
			 $this->_checkSession();
    }

		/**
		 * Valida la sesion al inicio de cada controller
		 */
		public function _checkSession(){
			if (!$this->session->has_userdata('username')){
				if(current_url() != base_url() . 'index.php'){
					$this->_redirectLoginPage();
				}
			}
		}

		/**
		 * controla las columnas y la longitud de sus valores
		 * @return (array)
		 */
    public function _checkColumnsData($paramsData, $data){    	
    	$validationResult = [
    		'status' => true,
    		'columns' => [],
    		'len' => [],
    	];

    foreach ($paramsData as $param => $value) {
    	if(isset($data[$param])){
    		if(strlen($data[$param]) < ($value - 1 ) ){
    		array_push($validationResult['len'], $param);
    		$validationResult['status'] = false;	
    		}
    	}else{
    		array_push($validationResult['columns'], $param);	
    		$validationResult['status'] = false;
    	}
    }
			return $validationResult;
    }


    /**
    * Redireccion a Login 
    */
    protected function _redirectLoginPage(){
        header('Status: 301 Moved Permanently', false, 301);
        header('Location: ' . base_url());
    }

    /**
    * Redirecciona a la pagina de inicio
    */
    public function _redirectOrdersPage(){
    	header('Status: 301 Moved Permanently', false, 301);
        header('Location: ' . base_url() . 'index.php/home/');
    }
		
		/**
		* Vista de entrada no autorizada
		*/
    public function _notAuthorized(){
        print('Entrada No autorizada');
        $this->_redirectLoginPage();
        exit();
    }   

    /**
    * Recibe un arreglo, calcula la diferencia entre dos fechas,
    * retorna el arreglo con una columna entera de dias
    * @param $array (array) arreglo de registros con fehas
    * @param $column (string) nombre de la columna calcular
    * @param $date (date) fecha de la que se quiere calcular la diferencia
    * @return (array)
    */
    public function dateDiff($array, $column, $now){
    	$result = array();
			foreach ($array as $key => $value) {
				$origin = strtotime($value[$column]);
				$begin = date_create(date('Y-m-d' ,$origin));
				$interval = date_diff($begin, $now, true);
				$value['dias'] =  $interval->days;
				$result[$key] = $value;
			}

			return $result;
		}

		/**
		* Obtiene informacion de un usuario
		* @param (int) userId
		* @return (array) userData
		*/
		public function getUserDataDb($userId){
			$this->db->where('id_user', $userId);
			$resultDb = $this->db->get('usuario');
			return $resultDb->result_array();

		}

			/**	
	* Obtiene registros a partir de condiciones
	* @param (str) $col nombre de la columna
	* @param  (str) $value valor para esa columna
	* @param  (str) $table nombre de la tabla a consultat
	* @return (array) result array
	*
	*/
	public function _getDb($col, $value, $table = 'pedido'){
		$this->db->where($col , $value);
		$resultDb = $this->db->get($table);
		if(!$resultDb->num_rows() > 0){return false;}
		return $resultDb->result_array();
	}

	

 	}