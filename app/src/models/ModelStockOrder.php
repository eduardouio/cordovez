<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo encargado de obtener la data para el stock de un pedido
 * 
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class ModelStockOrder extends CI_Model
{
    private $modelOrder;
    private $order;
    private $modelOrderInvoice;
    private $modelOrderInvoiceDetail;
    private $modelParcial;
    private $modelInfoInvoice;
    private $modelInfoInvoiceDerail;
    private $modelProduct;
    private $modelLog;
    
    function __construct() {
        parent::__construct();       
    }
    
    /**
     * Inicia las clases del modelo de datos
     */
    private function init(){
        $this->load->model('Modelorder');
        $this->load->model('Modelorderinvoice');
        $this->load->model('Modelorderinvoicedetail');
        $this->load->model('Modelparcial');
        $this->load->model('Modelinfoinvoice');
        $this->load->model('Modelinfoinvoicedetail');
        $this->load->model('Modelproduct');
        $this->load->model('Modellog');
        $this->modelOrder = new Modelorder();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelParcial = new Modelparcial();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelInfoInvoiceDerail = new Modelinfoinvoicedetail();
        $this->modelProduct = new Modelproduct();
        $this->modelLog = new Modellog();
    }
    
    
    /**
     * Retorna la lista de productos de un pedido
     * y la lista de productos de los parcuales
     * @param string $nro_pedido
     * @return array
     */
    public function getData(array $order) : array{
        
        $this->order = $order;
        
        return ([
            'detail_order_invoices' => $this->getInvoiceProducts(),
            'detail_info_invoices' => $this->getInfoInf,
        ]);
    }
    
    
    /**
     * Obtiene la lista de productos iniciales del pedido
     * @return array
     */
    private function getInvoiceProducts() :array{
        $init_products = [];
        
        $order_invoices = $this->modelOrderInvoice->getbyOrder(
                $this->order['nro_pedido']
            );
        
        if($order_invoices){
            foreach ($order_invoices as $k => $inv){
                $inv['product'] = $this->modelProduct->get($inv['cod_contable']);
                array_push($init_products, $inv);
            }
        }
        
        return $init_products;
    }
    
    
    
    /**
     * Obtiene la lista de los productos en los parciales
     * @return array
     */
    private function getParcialProducts() :array{
        $nationalized_products = [];
        
        $info_invoices = $this->modelInfoInvoice->getByOrder(
                $this->order['nro_pedido']
            );
        
        if($info_invoices){
            foreach ($info_invoices as $idx => $invoice){
                $details = $this->modelInfoInvoiceDetail->getByFacInformative(
                    $invoice['id_factura_informativa']
                    );
                
                if ($details){
                    foreach ($details as $k => $v){
                        array_push($nationalized_products, $v);
                    }
                }
            }
        }
        
        return $nationalized_products;
    }
}

