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
	public $Pagina_;
	public function __construct() {
       parent::__construct();
       $this->_checkSesion();
    }
	

  /**
   * Check if the session exists else redirect de login page
   */
	public function _checkSession(){
        if($this->session->userdata('loged')){
            return true;  
        } else{
            $this->session->sess_destroy();
            $this->_redirectLoginPage();
        }
	}
  
    /**
     * 
     */
    public function _validUserData($params,$userData,$items){
        #status 1 todo esta bien y contador para datos obligatorios
        $i = 0;
        $status = 1;
        //contamos el minimo de parametros
        foreach ($params as $key => $value) {
            if(($value != 0) && (array_key_exists($key, $userData))){
                        $i++;
            }
        }
        /**
        * sirve para depurar buscas un patron e imprimes,
        * si no filtras se detiene el script en la primera conincdencia
        *if(array_key_exists('antecedente', $userData)){
         *   print($i);
          *  print(var_dump($params));
           * print(var_dump($userData));
        *}
        */
        //verificamos la logitud de cada parametro
        if($i == $items){
            foreach ($params as $key => $limit) {
                if(array_key_exists($key, $userData)){
                    if($limit > strlen($userData[$key])){
                        $status = '2005';
                        break;
                    }                
                }                
            }                
        }else{
            $status = '2000';
        }
        
        return $status;
    }
    /**
     * Redirecciona Login
     */
    protected function _redirectLoginPage(){
        header('Status: 301 Moved Permanently', false, 301);
        header('Location: ' . base_url());
    }
    
    public function _notAuthorized(){
        $this->rest->_responseHttp('Entrada No autorizada favor vuelva a ' .
                    base_url(),405);
    }
	  
}
