<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
 
    
    /**
     * Funcion constructora de la clase
     */ 
    function __construct(){
        parent::__construct();
    }
    
    
    /**
     * Emite un mensaje de log normal por cualquier actividad
     * @param $message string mensaje a registrar en el log
     * @return void
     */
    public function susessLog(string $message)
    {
        error_log("\n[Success][" . date("D, d M Y H:i:s") . '] '. $message, 3 , $this->path);
    }
    
    
    /**
     * alamcena un log de error
     * @param string $message
     */
    public function generalLog(string $message,  $string = NULL)
    {
        error_log("\n[Log][" . date("D, d M Y H:i:s") . '] '. $message, 3 , $this->path);
        if($string){
            error_log("\n[aditional] " . $string, 3 , $this->path);
        }
    }
    
    
    /**
     * Alamacena un log de adventencia
     * @param string $message
     */
    public function warningLog(string $message, string $sql = NULL)
    {
        error_log("\n[warning][" . date("D, d M Y H:i:s") . '] ' . $message, 3 , $this->path);
        
        if($sql){
            error_log("\n[query] " . $sql , 3 , $this->path);            
        }
    }
    
    /**
     * Alamacena un log de adventencia
     * @param string $message
     */
    public function redirectLog(string $message, string $url = NULL)
    {
        error_log("\n[redirect][" . date("D, d M Y H:i:s") . '] ' . $message, 3 , $this->path);
        if($url){
            error_log("\n[url] " . $url , 3 , $this->path);
        }
    }
    
    
    /**
     * alamcena un log de error
     * @param string $message
     */
    public function errorLog(string $message, string $sql = NULL)
    {
        error_log("\n[error][" . date("D, d M Y H:i:s") . '] '. $message, 3 , $this->path);
        if($sql){
            error_log("\n[query] " . $sql , 3 , $this->path);
        }
    }
    
    
}
