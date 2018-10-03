<?php defined('BASEPATH') OR exit('No direct script access allowed');

$libraries_url = realpath(dirname(__FILE__));
$libraries_url = str_replace('controllers', 'libraries/', $libraries_url);
require_once ( $libraries_url . 'Rest.php' );


/**
 * API de importacion de pedidos
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Apiimport extends MY_Controller{
    private $controller = 'importar';
    private $modelImportSAP;
    
    
    /**
     * Inicio de clase
     */
    function __construct(){
        parent::__construct();
        $this->load->model('ModelImportSAP');
        $this->modelImportSAP = new ModelImportSAP();
        $this->rest = new Rest();
    }
    
    
    /**
     * Obtiene la informacion completa de un peduido
     * @param string $nro_order
     */
    public function getCompleteOrder(string $nro_order){
        $order = $this->modelImportSAP->get($nro_order);
        if($order){
            return $this->_responsRest($order);
        }
        
        return $this->_responsRest('', 204);
    }
    
    
    /**
     * Aplica la migracion para un pedido
     * 
     * @param string $nro_order
     */
    public function migrateOrder(string $nro_order){
         
    }
    
    
    /**
     * Recibe por post un pedido y luego lo actualiza en la bd
     */
    public function updtaeMigration(){
        
    }
    
    
    /**
     * Metodo de respuesta Rest
     * @param array $config
     */
    private function _responsRest($data, $httpstatus = 0){
        $data['session'] = $this->session->userdata();
        return $this->rest->_responseHttp($data, $httpstatus);
    }
}

