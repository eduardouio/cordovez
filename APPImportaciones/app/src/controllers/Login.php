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
	private $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
	private $dataView;


	function __construct(){
		parent::__construct();
	}


	private function _loadData(){
		$this->dataView = array(
				'title' => 'Inicio de Sesión',
				'base_url' => base_url(),
				'actionFrm' => base_url() . 'index.php/login/validar',
				'controller' => $this->controller,
				'iconTitle' => 'fa-cubes',
				);
	}

	/**
	 * Pagina de inicio controller
	 * @return string (template => pagePedido)
	 */
	public function index(){
		$this->_loadData();
		$this->twig->display('/pages/pageLogin.html', $this->dataView);
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
		$userDb = $userDb[0];
		if(
			 !$userDb['username'] == $user['username'] || 
			 !$userDb['password'] == $this->_encryptIt($user['password'])
			){
			print('usuario o contraseña incorrectos!.');
		}else{
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
		}
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