<?php
/**
 * Modelo encargado de tomar los datos de los pedidos
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class ModelImportSAP extends CI_Model{
    private $path_model_python = '/var/www/html/cordovez/src/models/ModelImport.py';
    #private $path_model_python = '/var/www/html/imnac/src/models/ModelImport.py';
    #private $path_model_python = '/var/www/html/vid/src/models/ModelImport.py';
    
	function __construct(){
		parent::__construct();
	}

	/**
	 * Obtiene una lista completa de los pedidos
	 * @param  int    $year anio de los pedidos
	 * @return array lista de pedidos del año
	 */
	public function getAllOrders(int $year): array {
        $command = escapeshellcmd('python ' . $this->path_model_python . ' -y ' . $year);
        $output = shell_exec($command);              
        return $output;        
	}

}