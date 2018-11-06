<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Obtiene informacion de los productos en cada uno de los pasos del proceso
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class ModelProductReport extends CI_Model{
    private $modelProduct;
    private $modelOrder;
    private $modelParcial;
    private $modelOrderInvoice;
    private $modelInfoInvoice;
    private $modelLog;
    private $product;
    
    
    /**
     * Costructor de la clase
     */
    function __construct(){
        parent::__construct();
        $this->init();
    }
    
    
    /**
     * Iniciamos los modelos de la clase
     */
    private function init(){
        $models = [
            'Modelproduct',
            'Modelorder',
            'Modelparcial',
            'Modelorderinvoice',
            'Modelinfoinvoice',
            'Modellog',
        ];
        foreach ($models as $model){
            $this->load->model($model);
        }
        
        $this->modelProduct = new Modelproduct();
        $this->modelOrder = new Modelorder();
        $this->modelParcial =  new Modelparcial();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelLog = new Modellog();
        $this->modelLog->generalLog(
            'Iniciando clase modelo de reporte de producto'
            );
    }
    
    
    /**
     * Retorna toda la informaicon base de un producto
     * @param string $cod_contable
     */
    public function getData(string $cod_contable){
        $data = [];               
        $orders_have_product = $this->modelOrderInvoice->getAll($cod_contable);
        
        foreach ($orders_have_product as $k => $order){
            array_push($data, [ 
                    'order' => $order,
                    'parcials' => $this->modelParcial->getAllParcials($order['nro_pedido']),
                    'info_invoices' => $this->modelInfoInvoice->getCompleteInfoInvoiceByOrder($order['nro_pedido']),
                ]);
        }        
        $this->modelLog->generalLog(
            'Retorno de informacion para reporte de productos'
            );        
        return $data;
    }   
}

