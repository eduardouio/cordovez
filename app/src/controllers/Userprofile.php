<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Muestra el perfil de usuario
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class Userprofile extends MY_Controller
{
    private $controller = "perfil";
    private $template = '/pages/pageUser.html';
    private $modelUser;
    private $modelLog;
    private $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';    
    
    function __construct(){
        parent::__construct();
        
        if(! isset($this->session->userdata['id_user'])){
            exit(0);
        }
        
        $this->load->model('Modeluser');
        $this->load->model('Modellog');
        $this->modelUser = new Modeluser();
        $this->modelLog = new Modellog();
        
    }
    
    /**
     * Muestra el perfil de usuario
     */
    public function index(){
        $user = $this->modelUser->get($this->session->userdata('id_user'));
        return ($this->responseHttp([
            'titleContent' => 'Perfil de Usuario',
            'user' => $user
        ]));
    }
    
    /*
     * Redenderiza la informacion y la envia al navegador
     * @param array $config informacion de la plantilla
     */
    private function responseHttp($config)
    {
        return ($this->twig->display($this->template, array_merge($config, [
            'title' => 'Perfil de Usuario',
            'base_url' => base_url(),
            'rute_url' => base_url() . 'index.php/',
            'controller' => $this->controller,
            'iconTitle' => 'fa-user',
            'content' => 'home'
        ])));
    }
    
    /**
     * Actualiza la informacion de un perfil
     */
    public function actualizar(){
        if(!$_POST){
            return $this->index();
        }
        $user = $this->input->post();
        unset($user['password2']);
        $user['password'] = $this->_encryptIt($user['password']);
        $message = '';
        if($this->modelUser->update($user)){
            $this->modelLog->warningLog('Se cambia la contrasena de un usuario');
            $message = 'Información Actualizada!.';
        }else{
            $this->modelLog->errorLog(
                'No se puede cambiar una contrasena de usuario', 
                $this->db->last_query()
                );
            $message = 'No se ha podido Actualizar';
        }
        
        $user = $this->modelUser->get($this->session->userdata('id_user'));
        
        return ($this->responseHttp([
            'titleContent' => 'Perfil de Usuario',
            'user' => $user,
            'message' => $message,
        ]));
    }
    
    /**
     * Encripta el passwod
     *
     * @param string $q
     * @return string $qEncode
     */
    private function _encryptIt($q)
    {
        $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($this->cryptKey))));
        return ($qEncoded);
    }
    
    /**
     * Desencripta el passwod
     *
     * @param string $q
     * @return string $qDecoded
     */
    private function _decryptIt($q)
    {
        $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($this->cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($this->cryptKey))), "\0");
        return ($qDecoded);
    }
    
}

