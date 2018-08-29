<?php
/**
 * Muestra una vista completa del pedido que se desea eliminar
 * Solo es accesible para el administrador del sistema
 */
class Deleteorder extends MY_Controller{

    private $modelLog;
    private $modelDeleteAllOrder;
    private $controller = "deteleorder";
    private $template = '/pages/pageDeleteAllOrder.html';


    function __construct(){
        parent::__construct();
        $this->init();
    }

    /**
     * Inicia las clases auxiliares
     */
    private function init(){
        $this->load->model('Modellog');
        $this->modelLog = new Modellog();
    }

    public function index(){
        
        if($this->session->userdata('id_user') == 1){
            $this->modelLog->errorLog(
                'Acceso no autorizado a elimnacion de un pedido completo'
            );
        }

        return($this->responseHttp([
            'title' => 'Eliminar Pedido',
            'titleContent' => 'Use esta página con resposabilidad, las acciones realizadas no se pueden deshacer',
            'id_user' => $this->session->userdata('id_user'),
        ]));
    }

     /*
     * Redenderiza la informacion y la envia al navegador
     * @param array $config informacion de la plantilla
     */
    private function responseHttp($config)
    {
        return ($this->twig->display($this->template, array_merge($config, [
            'base_url' => base_url(),
            'rute_url' => base_url() . 'index.php/',
            'controller' => $this->controller,
            'iconTitle' => 'fa-warning',
            'content' => 'home'
        ])));
    }
}