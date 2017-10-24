<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Encargado del inicio de sesion
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Login extends MY_Controller {
	private $controller = "usuario";
	private $template = '/pages/pageLogin.html';
	private $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';


	function __construct(){
		parent::__construct();
	}


	/**	
	* Muestra el formulario de inicio de sesion
	*/
	public function index(){
		$config['title'] = 'Inicio de Sesión';
		$this->responseHttp($config);
	}


		/* *
	* Envia la respuestas html al navegador
	*/
	public function responseHttp($config){
		$config['base_url'] = base_url();
		$config['rute_url'] = base_url() . 'index.php/';
		$config['actionFrm'] = base_url() . 'index.php/login/validar';
		$config['controller'] = $this->controller;
		$config['iconTitle'] = 'fa-users';
		$config['content'] = 'home';
		return $this->twig->display($this->template, $config);
	}


	/**
	 * Formulario de inicio de sesion
	 */
	public function validar(){
		if(!$_POST){$this->_notAuthorized();}

		$user = $_POST;
		$this->db->where('username' , $user['username']);
		$resultDb = $this->db->get($this->controller);
		$userDb = $resultDb->result_array();


		if(!$resultDb->num_rows() == 1 ){
			$config = array(
				'message' => 'Usuario y/o Contraseña Incorrectos.'
			);
			$this->responseHttp($config);
			return true;
		}
		
		$userDb = $userDb[0];	
		
		if($userDb['username'] == $user['username'] &&
			 						$userDb['password'] == $this->_encryptIt($user['password'])
			){
			
			#actualizamos el ultimo login
			$lastlogin = array('last_login' => date('Y-m-d H:i:s'));			
			$this->db->where('username', $userDb['username']);
			$this->db->update($this->controller, $lastlogin);

			#creamos la cookie de session
			$userData = $userDb;
			$userData['logged_in'] = true;
			$userData['last_login'] = $lastlogin;
			unset($userData['password']);
			$this->session->set_userdata($userData);
			$this->_redirectOrdersPage();
		}else{
			$config = array(
				'message' => 'Usuario y/o Contraseña Incorrectos.'
			);
			$this->responseHttp($config);
			return true;
		}

		$config = array(
				'message' => 'Usuario y/o Contraseña Incorrectos.'
			);
			$this->responseHttp($config);
			return true;
	}


	/**
	*	Cierra la sesion del usuario en linea
	*/
	public function cerrarSesion(){
		$this->session->sess_destroy();
		$this->index();
	}


	/**
	 * Encripta el passwod
	 * @param string $q
	 * @return string $qEncode
	 */
	private function _encryptIt($q){
	    $qEncoded = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, 
	    						md5($this->cryptKey), $q, MCRYPT_MODE_CBC, md5( 
	    																							md5($this->cryptKey))));
	    return( $qEncoded );
	}

	/**
	 * Desencripta el passwod
	 * @param string $q
	 * @return strinf $qDecoded
	 */
	private function _decryptIt($q){
	    $qDecoded = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5(
	    						$this->cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5( 
	    																						md5($this->cryptKey))),"\0");
	    return( $qDecoded );
	}
}