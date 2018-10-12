<?php defined('BASEPATH') OR exit('No direct script access allowed');

$libraries_url = realpath(dirname(__FILE__));
$libraries_url = str_replace('controllers', 'libraries/', $libraries_url);
require_once ( $libraries_url . 'Rest.php' );

/**
 * Asistente de importacion de peduidos de SAP
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Importar extends MY_Controller
{
	private $controller = 'importar';
    private $template = '/pages/pageImport.html';
    private $modelImportSAP;
    private $modelLog;
    private $rest;
    private $modelUser;  
    private $enterprise = 'cordovez';
    #private $enterprise = 'vid';
    #private $enterprise = 'imnac';

    function __construct(){
        parent::__construct();
        $this->init();
    }
    
    
    /**
     * inicial los modelos
     */
    private function init(){
        $models = [
            'ModelImportSAP',
            'Modellog',
            'Modeluser',
        ];
        
        foreach ($models as $model){
            $this->load->model($model);
        }
        
        #instancia de modelos
        $this->modelUser = new Modeluser();
        $this->modelImportSAP = new ModelImportSAP();
        $this->modelLog = new Modellog();
        $this->rest = new Rest();
    }
    
    /**
     * mostramos en asistente de importacion de pedido
     */
    public function index(){
      $data = $this->modelImportSAP->getAll();
      $empty = False;
      
      if(count($data) == 0){
          $empty = true;
      }
      
      return $this->responseHttp([
        	'titleContent' => 'Asistente de importación de pedidos desde SAP desde 2018',
        	'assistent' => True,
            'data' => $data,
            'data_empty' => $empty,
            'vue_app' => True,
        ]);
    }
    
   /**
    * Escanea los pedidos del servidor scay los importa
    */
   public function scan(){
       $this->modelLog->generalLog(
           'Inicio de escaneo Servidor'
           );
       $this->modelImportSAP->getOrdersSAP($this->enterprise, date('Y'));
       $this->redirectPage('import_wizard');           
   }
   
   
   /**
    * Realiza una importacion de los pedidos basados en una lista
    * @param array post lista de pedidos
    * @return bool si aplica o no la migracion
    */
   public function  importList(){
       if($this->rest->_getRequestMethod() != 'POST'){
           $this->_responsRest([],204);
       }
       
       $data = json_decode(file_get_contents("php://input"),true);
       #recuperamos los pedido que nos llegan de la consulta
       foreach ($data['data'] as $k => $nro_order){           
           $this->modelImportSAP->migrate($nro_order);
       }
       
       return $this->_responsRest(['result' => 'success'], 201);
   }
   
   
   /**
    * Muestra la pantalla con los datos imporados
    * @param boolean $nro_orders lista de ordenes en comun
    */
   public function historico(){
       $data = $this->modelImportSAP->getAll(true);
       if($data){
           foreach ($data as $k => $order){
               $data[$k]['user'] = $this->modelUser->get($order['id_user']);
           }
       }
              
       return $this->responseHttp([
           'titleContent' => 'Listado hisotorico de imporacion de pedido',
           'list_orders' => True,
           'data' => $data,
       ]);
   }
   
   /**
    * Realiza la importacion de un pedido
    * @param string $nro_order
    * @return boolean si la migracion se aplica o no
    */
   public function importOrder($nro_order = False){
       if($nro_order == False){
           $this->_responsRest([],204);
       }
       
       if($this->modelImportSAP->migrate($nro_order)){
           return $this->_responsRest(['result' => 'success'] , 201);
       }
       
       $this->modelLog->errorLog(
           'La migracion del pedido ' . $nro_order . 'con fallo'
           );
       
       return $this->_responsRest(['result' => 'error'] , 201);
   }
      
   
    /*
     * Redenderiza la informacion y la envia al navegador
     * @param array $config informacion de la plantilla
     */
    private function responseHttp($config)
    {
        return(
            $this->twig->display($this->template, array_merge($config,[
                'base_url' => base_url(),
                'rute_url' => base_url() . 'index.php/',
                'controller' => $this->controller,
                'iconTitle' => 'fa-retweet',
                'content' => 'home']))
            );
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