<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modulo encargado del inicio de sesion
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
	private $resultDb;
	private $controllerSPA = "usuario";
	private $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
	private $responseHTTP = array('status' => 'success');
	private $dataView;


	function __construct(){
		parent::__construct();
	}

	/**
	 * CARGA CONFIGURACION INICIAL DEL MODULO SPA Y DEL controller
	 * @return array (config)
	 */
	private function _loadData(){
		$this->dataView = array(
				'title' => 'SPA Login',
				'base_url' => base_url(),
				'actionFrm' => base_url() . 'index.php/login/validar',
				'controller' => $this->controllerSPA,
				'iconTitle' => 'fa-cubes',
				'active_pedidos' => 'active left-active',
				);
	}

	/**
	 * CARGA EL SPA DEL MODULO DE PEDIDOS
	 * @return string (template => pagePedido)
	 */
	public function index(){
		$this->_loadData();
		$this->twig->display('/pages/pageLogin.html', $this->dataView);
		log_message('Login', 'clase de Login iniciada');
	}

	/**
	 * Valida la informacion de inicio de sesion crea cookie de session
	 */
	public function validar(){
		if($this->rest->_getRequestMethod()!= 'POST'){
			$this->_notAuthorized();
		}
		//$request =  json_decode(file_get_contents('php://input',true));
		$user = $this->input->post();

		$this->db->where('username' , $user['username']);
		$this->resultDb = $this->db->get($this->controllerSPA);
		if($this->resultDb->num_rows() == 1){
			$userDb = $this->resultDb->result_array();
			$userDb = $userDb[0];
			if($user['username'] == $userDb['username']){
				#comparamos los passwod
				$encrypPasswd = $userDb['password'];
				$password = $user['password'];
				if ($encrypPasswd == $this->_encryptIt($user['password'])){
					#actualiza lastlogin
					$lastlogin = array(
						'last_login' => date('Y-m-d H:i:s')
					);
					$this->db->where('username', $userDb['username']);
					$this->db->update($this->controllerSPA, $lastlogin);

					#creamos la cookie de session
					$userData = array('username' => $userDb['username'],
														'id_user' => $userDb['id_user'],
														'nombres' => $userDb['nombres'],
														'usertype' => $userDb['usertype'],
														'logged_in' => true,
														'last_login' => date('Y-m-d H:i:s')
													);

					$this->session->set_userdata($userData);
					$this->responseHTTP['appst'] = 'Sesión iniciada correctamente';
					$this->responseHTTP['userData'] = $userData;
				}else{
					$this->_putData($user);
				}
			}else{
				$this->_putData($user);
			}
		}else{
			$this->_putData($user);
		}
		$this->__responseHttp($this->responseHTTP, 200);

	}

	/**
	 * Notifica de un  error de inicio de sesion
	 */
	private function _putData($user){
		$this->responseHTTP['appst'] =
														'El nombre de usuario o contraseña es incorrecto!';
		$this->responseHTTP['userdata'] = $user;
	}

	/**
	 * Encripta el passwod
	 * @param string $q
	 * @return string $qEncode
	 */
	private function _encryptIt( $q ) {
	    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $this->cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $this->cryptKey ) ) ) );
	    return( $qEncoded );
	}

	/**
	 * Desencripta el passwod
	 * @param string $q
	 * @return strinf $qDecoded
	 */
	private function _decryptIt( $q ) {
	    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $this->cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $this->cryptKey ) ) ), "\0");
	    return( $qDecoded );
	}

}
