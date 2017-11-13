<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modulo encargado de manejar las sesiones
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */

class MY_Controller extends CI_Controller{

	public function __construct() {
       parent::__construct();
			 $this->_checkSession();
    }
	/**
	 * Verofica la sesion del usuario, si la sesion no existe 
     * redirecciona al formulario de autenticacion
	 */
	public function _checkSession(){
        if(!($this->session->userdata('id_user'))){
            $this->session->sess_destroy();
            if(current_url() != base_url() . 'index.php'){
                    $this->redirectPage('loginForm');
                }
        }else{
            return true;
        }
    }

		/**
		 * controla las columnas y la longitud de sus valores
		 * @param (array) $paramsdata => Parametros minimos
		 * @param (array) $data => info Formulario
		 *
		 * @return (array)
		 *
		 * 	$validationResult = [
     *	'status' => true | false
     *	'columns' => (array) columnas que no existen
     *	'len' => (array) longitudes que no se cumplen,
     * ];
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
    * Redirecciona a cualquier pagina del sitio
    * htttp://ip/index.php/controller/method/params/
    * 
    * @param $page => pagename
    * @param $id => identificator Row
    *
    * @return void | bool
    */
    public function redirectPage(string $page, $id = false){
    	$target = [
    		'loginForm' => base_url() . 'index.php/login/', 
            'ordersList' => base_url() . 'index.php/pedido/listar', 
    		'suppliersList' => base_url() . 'index.php/proveedor/listar', 
            'presentOrder' => base_url() . 'index.php/pedido/presentar', 
    		'replaceIncoterms' => base_url() . 
                                    'index.php/gstinicial/replaceIncoterms', 
            'putIncoterms' => base_url() .
                                    'index.php/gstinicial/putIncoterms', 
            'presentInvoiceOrder' => base_url() . 
                                            'index.php/pedidofactura/presentar', 
    	];

    	header('Status: 301 Moved Permanently', false, 301);
    	if ($id){
    			header('Location: ' . $target[$page]  . '/' . $id);	
    		return true;
    	}    	
    	header('Location: ' . $target[$page]  );
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
}