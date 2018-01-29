<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Encargado del inicio de sesion
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Login extends CI_Controller {
	private $controller = "usuario";
	private $template = '/pages/pageLogin.html';
	private $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
	private $modelBase ;

	function __construct(){
		parent::__construct();
		$this->checkSession();
		$this->load->model('modelbase');
		$this->modelBase = new ModelBase();
	}

	/**	
	* Muestra el formulario de inicio de sesion
	*/
	public function index(){
		$config['title'] = 'Inicio de Sesión';

		$this->responseHttp($config);
	}


	/**
	 * Verofica la sesion del usuario, si la sesion no existe 
   * redirecciona al formulario de autenticacion
	 */
	private function checkSession(){
		if($this->session->userdata('id_user') != NULL){
			$this->redirectPage('ordersList');
		}else{
			return false;
		}
		
   }


	/**
	* Comprueba la sesion de un us
	*
	*/

	/* *
	* Envia la respuestas html al navegador
	*/
	public function responseHttp($config){
		$init =[
			'base_url' => base_url(),
			'rute_url' => base_url() . 'index.php/',
			'actionFrm' => base_url() . 'index.php/login/validar',
			'controller' => $this->controller,
			'iconTitle' => 'fa-users',
			'content' => 'home',
		];
		return $this->twig->display($this->template, array_merge($config, $init));
	}


	/**
	 * Formulario de inicio de sesion
	 */
	public function validar(){
		if(!$_POST){ $this->redirectPage('loginForm');}

		$user = $_POST;
		$params = [
						'select' => ['*',],
						'table' => $this->controller,
						'where' => ['username' => $user['username'],],
						];

		$userDb = $this->modelBase->get_table($params);

		if($userDb == false){
			$config = [
				'message' => 'Usuario y/o Contraseña Incorrectos',
			];
			$this->responseHttp($config);
			return true;
		}

		$userDb = $userDb[0];

		if(($userDb['username'] == $user['username']) &&
			 ($userDb['password'] == $this->_encryptIt($user['password'])))
			 {
			
			$lastlogin = [
							'last_login' => date('Y-m-d H:i:s'),
									];			

			$this->db->where('username', $userDb['username']);
			$this->db->update($this->controller, $lastlogin);

			#creamos la cookie de session
			$userData = $userDb;
			$userData['logged_in'] = true;
			$userData['last_login'] = $lastlogin;
			unset($userData['password']);
			$this->session->set_userdata($userData);
			$this->redirectPage('home');
		}else{
			$config = [
				'message' => 'Usuario y/o Contraseña Incorrectos.',
						];
			$this->responseHttp($config);
			return true;
		}
	}

	/**
	*	Cierra la sesion del usuario en linea
	*/
	public function cerrarSesion(){
		$this->session->sess_destroy();
		$this->redirectPage('loginForm');
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
	 * @return string $qDecoded
	 */
	private function _decryptIt($q){
	    $qDecoded = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5(
	    						$this->cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5( 
	    																						md5($this->cryptKey))),"\0");
	    return( $qDecoded );
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
    public function redirectPage(string $page){
    	$target = [
    		'loginForm' => base_url(), 
    		'ordersList' => base_url() . 'index.php/pedido/listar/', 
    	];

    	header('Status: 301 Moved Permanently', false, 301);
    	if ($id){
    			header('Location: ' . $target[$page]  . '/' . $id);	
    		return true;
    	}    	
    	header('Location: ' . $target[$page]  );
    }
}