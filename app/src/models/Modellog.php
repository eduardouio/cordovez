<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo que gestiona la escritura del fichero del log
 * @package    modelLayer
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modellog extends CI_Model{
    private $path = '/var/www/html/cordovezapp/app/src/logs/app.log';
    private $modelUser;
    private $user;


    /**
     * Funcion constructora de la clase
     */
    function __construct(){
        parent::__construct();
        $this->load->model('modeluser');
        $this->modelUser = new Modeluser();
        $this->getUser();
    }


    /**
     * obtiene la informacion del usuario, tomandolo de la session
     */
    public function getUser()
    {
      $this->user = $this->modelUser->get($this->session->userdata('id_user'));
      if($this->user == false){
          $this->user['nombres'] = 'GUEST';
      }
    }


    /**
     * Emite un mensaje de log normal por cualquier actividad
     * @param $message string mensaje a registrar en el log
     * @return void
     */
    public function susessLog(string $message)
    {
        error_log("\n[Success][" . $this->input->ip_address() .  "][" .
                    date("d m Y H:i:s") . '] '.
                    $message .' [' .
                    $this->user['nombres'] . ']' ,
                    3 ,
                    $this->path
                 );
    }


    /**
     * alamcena un log de error
     * @param string $message
     */
    public function generalLog(string $message,  $string = false)
    {
        error_log( "\n[Log][" . $this->input->ip_address() ."][" .
                    date("d m Y H:i:s") . '] '. $message . ' [' .
                    $this->user['nombres'] . ']' ,
                    3 ,
                    $this->path
                  );

        if($string){
            error_log("[aditional] " . $string, 3 , $this->path);
        }
    }


    /**
     * Alamacena un log de adventencia
     * @param string $message
     */
    public function warningLog(string $message, string $sql = NULL)
    {
        error_log("\n[warning][". $this->input->ip_address() ."][" .
                   date("d m Y H:i:s") . '] ' .
                    $message . ' [' .
                    $this->user['nombres'] . ']' ,
                    3 ,
                    $this->path
                 );

        if($sql){
            error_log("[query] " . $sql , 3 , $this->path);
        }
    }

    /**
     * Alamacena un log de adventencia
     * @param string $message
     */
    public function redirectLog(string $message, string $url = NULL)
    {
        error_log("\n[redirect][" . $this->input->ip_address() ."][" .
                     date("d m Y H:i:s") . ']' .
                    $message . ' [' .
                    $this->user['nombres'] . ']' ,
                    3,
                    $this->path
                );
        if($url){
            error_log("[url] " . $url , 3 , $this->path);
        }
    }


    /**
     * alamcena un log de error
     * @param string $message
     */
    public function errorLog(string $message, string $sql = NULL)
    {
        error_log("\n[error][" . $this->input->ip_address() ."][" .
                    date("d m Y H:i:s") . '] '.
                    $message . ' [' .
                    $this->user['nombres'] . ']' ,
                    3 ,
                    $this->path
                );
        if($sql){
            error_log(" [query] " . $sql , 3 , $this->path);
        }
    }
    
    
}
