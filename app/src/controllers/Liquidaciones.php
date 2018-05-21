<?php
/**
 * Controlador encragado de liqudar el arancel advalorem del pedido
 * y registra el costo de los productos
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class Liquidaciones extends \MY_Controller
{
    private $modelProrrateo;
    private $modelLog;
    private $modelProrrateoDetail;
    private $modelOrder; 
    private $modelOrderInvoice;
    private $modelParcial;    
    
    function __construct(){
        parent::__construct();
        $this->init();
    }
    
    
    /**
     * inicia las librerias de la clase
     */
    private function init(){
        $this->load->model('Modelprorrateo');
        $this->load->model('Modelprorrateodetail');
        $this->load->model('Modellog');
        $this->load->model('Modelorder');
        $this->load->model('Modelorderinvoice');
        $this->load->model('Modelparcial');
        $this->modelProrrateo = new Modelprorrateo();
        $this->modelLog = new Modellog();
        $this->modelProrrateoDetail = new Modelprorrateodetail();
        $this->modelOrder = new Modelorder();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelParcial = new Modelparcial();
    }
    
    
    /**
     * redirecciona al home del proyecto
     */
    public function index()
    {
        $this->modelLog->redirectLog(
            'redireccionamiento por acceso directo',
            current_url()
        );
        
        $this->redirectPage('home');
    }
    
    
    /**
     * Esta funcion se encarga de guaradar los impuestos de un r10 
     * asi como la diferencia de arancel advalorem
     * @param string $nro_pedido
     */
    public function  pd($nro_pedido)
    {
        print('La funcionalidad del pededido esta pendiete');
        
    }
    
    
    /**
     * Se encarga de guardar los impuestos del parcial
     * y registra el ice advalorem que queda pendiente para la siguiente 
     * liquidacion
     * @param int $nro_parcial
     */
    public function pc($id_parcial){
        
        $parcial = $this->modelParcial->get($idParcial);
        
        if ($parcial == False){
            $this->index();
        }
        
        print('<pre>');
        print_r($parcial);
        print('</pre>');
    }
    
    
}

