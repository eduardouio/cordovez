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
    public function _checkColumnsData($columnsLen, $tableDb){
			$validation["status"] = true;

			foreach ($columnsLen as $key => $value) {
				if(!isset($tableDb[$key])){
					$validation["status"] = false;
					$validation["columns"][$key] = $key;
				}
			}

			if($validation["status"]){
				foreach ($columnsLen as $key => $value) {					
					if(!(strlen($tableDb[$key]) >= $value)){
						$validation["status"] = false;
						$validation["len"][$key] = $value;
					}
				}
			}
			return $validation;
    }

    /**
     * REDIRECCIONA AL FORM DE LOGI
     */
    protected function _redirectLoginPage(){
        header('Status: 301 Moved Permanently', false, 301);
        header('Location: ' . base_url());
    }

		public function __responseHttp($data, $httpstatus = 0){
			$data['session'] = $this->session->userdata();
			$this->rest->_responseHttp($data, $httpstatus);
		}

		/**
		 * VALIDACION DE ENTRADA NI AUTORIZADA PARA EL LOGIN
		 */
    public function _notAuthorized(){
        $this->rest->_responseHttp('Entrada No autorizada favor vuelva a ' .
                  base_url(),405);
    }
}
