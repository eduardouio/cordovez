<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Controla al usuarios
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class User extends MY_Controller
{
    private $template = "/pages/pageUser.html";
    private $controller = 'user';
    private $modelUser;
    
    /**
     * Contructor de la clase
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    
    /**
     * Carga las librerias de la clase 
     */
    public function init()
    {
        
        if(! isset($this->session->userdata['id_user'])){
            exit(0);
        }
        
        $this->modelUser = new Modeluser();
    }
    
    
    /**
     * Muestra la informacion de un usuario en la pantalla
     * 
     * @param int $idUser
     */
    public function presentar(int $idUser){
        
    }
}

