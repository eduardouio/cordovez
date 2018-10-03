<?php defined('BASEPATH') OR exit('No direct script access allowed');
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
        ];
        
        foreach ($models as $model){
            $this->load->model($model);
        }
        
        #instancia de modelos
        $this->modelImportSAP = new ModelImportSAP();
        $this->modelLog = new Modellog();
    }
    
    /**
     * mostramos en asistente de importacion de pedido
     */
    public function index(){
      $data = $this->modelImportSAP->getAll();       
      
      return $this->responseHttp([
        	'titleContent' => 'Asistente de importación de pedidos desde SAP desde 2018',
        	'assistent' => True,
            'data' => $data,
            'vue_app' => True,
        ]);
    }
    
   /**
    * Escanea los pedidos del servidor y los importa
    */
   public function scan(){
       $this->modelLog->generalLog(
           'Inicio de escaneo Servidor'
           );
       $this->modelImportSAP->getOrdersSAP($this->enterprise, date('Y'));
       $this->redirectPage('import_wizard');           
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

}