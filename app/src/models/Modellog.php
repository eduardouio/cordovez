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
    private $path = '/var/www/html/app/src/logs/app.log';
    
    
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
     * Alamacena un log de adventencia
     * @param string $message
     */
    public function warningLog(string $message)
    {
        error_log("\n[Warning][" . date("D, d M Y H:i:s") . '] ' . $message, 3 , $this->path);
    }
    
    /**
     * Alamacena un log de adventencia
     * @param string $message
     */
    public function redirectLog(string $message)
    {
        error_log("\n[Redirect][" . date("D, d M Y H:i:s") . '] ' . $message, 3 , $this->path);
    }
    
    
    /**
     * alamcena un log de error
     * @param string $message
     */
    public function errorLog(string $message)
    {
        error_log("\n[Error][" . date("D, d M Y H:i:s") . '] '. $message, 3 , $this->path);
    }
}
