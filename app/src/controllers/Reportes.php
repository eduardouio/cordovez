<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * muestra en panatalla los reportes obtenidos por el sistema 
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Reportes extends MY_Controller
{
    private $modelReportProvisiones;
    private $modelReportPagos;
    private $modelOrder;
    private $controller = "reportes";
    private $template = '/pages/pageReport.html';
    
    function __construct(){
        parent::__construct();
        $this->init();
    }
        
    /**
     * Inicializa las librerias de la clase
     */
    private function init(){
        if(! isset($this->session->userdata['id_user'])){
            exit(0);
        }
        
        $this->load->model('ModelReportProvisiones');
        $this->load->model('ModelReportPagos');
        $this->load->model('Modelorder');
        $this->modelReportProvisiones = new ModelReportProvisiones();
        $this->modelReportPagos = new ModelReportPagos();
        $this->modelOrder = new Modelorder();
    }
    
    /**
     * metodo pricipal
     */
    public function index(){       
        return $this->responseHttp([
            'titleContent' => 'Reportes Sistema',
            'dashboard' => true,
        ]);
    }
    
    
    /**
     * Retorna las provisiones para un pedidp
     */
    public function pagos(){
        $data = [];
        $title_report = 'Sleccione el tipo de reporte' ;

        if($_POST){
            if(isset($_POST['por_fechas'])){
                $fecha_desde = str_replace('/', '-', $_POST['fecha_desde']);
                $fecha_hasta = str_replace('/', '-', $_POST['fecha_hasta']);
                $fecha_desde = date('Y-m-d', strtotime($fecha_desde));
                $fecha_hasta = date('Y-m-d', strtotime($fecha_hasta));
                $data = $this->modelReportPagos->getByDateRange(
                    $fecha_desde, 
                    $fecha_hasta
                );
                $title_report = (
                        'Reporte por fechas desde <strong>' 
                        . $fecha_desde 
                        . '</strong> hasta <strong>' 
                        . $fecha_hasta . '</strong>'
                    );

            }else{
                $order = $this->modelOrder->get($_POST['nro_pedido']);
                $data = $this->modelReportPagos->getbyOrder(
                    $_POST['nro_pedido']
                );
                
                $title_report = (
                    'Reporte por Pedido <strong>' 
                    . $_POST['nro_pedido']
                    . '</strong> regimen ' . $order['regimen']
                );
            }
        }
        
        return $this->responseHttp([
            'titleContent' => 'Reporte de Provisiones',
            'data' => json_encode($this->_formatData($data)),
            'orders_list' => $this->modelOrder->getAll(),
            'title_report' => $title_report,
            'provisiones' => true,
        ]);
    }


    /**
     *  Muestra el reporte de las provisiones 
     */
    public function provisiones(){
        $data = [];
        $title_report = 'Sleccione el tipo de reporte' ;

        if($_POST){
            if(isset($_POST['por_fechas'])){
                $fecha_desde = str_replace('/', '-', $_POST['fecha_desde']);
                $fecha_hasta = str_replace('/', '-', $_POST['fecha_hasta']);
                $fecha_desde = date('Y-m-d', strtotime($fecha_desde));
                $fecha_hasta = date('Y-m-d', strtotime($fecha_hasta));
                $data = $this->modelReportProvisiones->getByDateRage(
                    $fecha_desde, 
                    $fecha_hasta
                );
                $title_report = (
                        'Reporte por fechas desde <strong>' 
                        . $fecha_desde 
                        . '</strong> hasta <strong>' 
                        . $fecha_hasta . '</strong>'
                    );

            }else{
                $data = $this->modelReportProvisiones->getbyOrder(
                    $_POST['nro_pedido']
                );                
                $title_report = (
                    'Reporte por Pedido <strong>' 
                    . $_POST['nro_pedido']
                    . '</strong>'
                );
            }
        }

        return $this->responseHttp([
            'titleContent' => 'Reporte de Provisiones',
            'data' => json_encode($this->_formatData($data)),
            'orders_list' => $this->modelOrder->getAll(),
            'title_report' => $title_report,
            'provisiones' => true,
        ]);
    }

    
    /*
     * Redenderiza la informacion y la envia al navegador
     * @param array $config informacion de la plantilla
     */
    private function responseHttp($config)
    {
        return ($this->twig->display($this->template, array_merge($config, [
            'title' => 'Reportes',
            'base_url' => base_url(),
            'rute_url' => base_url() . 'index.php/',
            'controller' => $this->controller,
            'iconTitle' => 'fa-table',
            'content' => 'home'
        ])));
    }
}

