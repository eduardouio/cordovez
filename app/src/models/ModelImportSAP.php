<?php defined('BASEPATH') or exit('No direct script access allowed');
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
    private $modelLog;
    
    
    /**
     * Constructo de clase
     * @param string $enterprise [cordovez|imnac|vid|]
     * @param int $year
     */
    function __construct(){
        parent::__construct();
        $this->init();
    }
    
    /**
     * Inicia los modelos y clases para el conector
     */
    private function init(){
        $models = [
            'Modellog',            
        ];
        
        foreach ($models as $model){
            $this->load->model($model);
        }        
        $this->modelLog = new Modellog();                
        $this->modelLog->generalLog(
            'Inicio de Clase de migracion'
            );
    }
    
    
    /**creae
     * Obtiene una lista completa de los pedidos desde SAP
     * @param  int    $year anio de los pedidos
     * @return array lista de pedidos del año
     */
    public function getOrdersSAP(string $enterprise, int $year){
        $this->enterprise = $enterprise;
        $this->year = $year;
        $url = "http://192.168.0.198:8000/$this->enterprise/$this->year/";        
        $this->modelLog->generalLog(
            'Se inicia la transferencia con el server'
            );
        
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT , 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'APP-Importaciones');
        $data = json_decode(curl_exec($curl_handle),True);
        curl_close($curl_handle);
        
        $this->modelLog->generalLog(
            'Se termina la transferencia con el server'
            );
        
        if($data){
            return $data['data'];
        }
        
        $this->modelLog->generalLog(
            'El escaneo al server no ha entregado datos'
            );
        return [];
    }       
       
}