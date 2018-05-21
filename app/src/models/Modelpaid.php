<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo encargado de gestionar los Documentos de Pagos
 * de datos
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modelpaid extends CI_Model{
    private $table = 'documento_pago';
    private $modelBase;
    private $modelSupplier;
    private $modelExpenses;
    private $modelPaidDetail;
    private $modelLog;
    
    function __construct(){
        parent::__construct();
        $this->init();
    }
    
    /**
     * Inicia los modelos de la clase
     */
    public function init(){
        $this->load->model('modelbase');
        $this->load->model('modelsupplier');
        $this->load->model('modelexpenses');
        $this->load->model('modelpaiddetail');
        $this->load->model('modellog');
        $this->modelBase = new Modelbase();
        $this->modelSupplier = new Modelsupplier();
        $this->modelExpenses = new Modelexpenses();
        $this->modelPaidDetail = new Modelpaiddetail();
        $this->modelLog = new Modellog();
    }

    /**
     * Obtiene el detalle de una factura de pago completa
     * @param string $nroDoument  de factura
     * @return array | boolean
     */
    public function get($nroDocument)
    {
        $invoice = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_documento_pago' => $nroDocument,
            ],
        ]);
        if ((gettype($invoice) == 'array') && (count($invoice) > 0)){
            $invoice = $invoice[0];
            $invoice['supplier'] = $this->modelSupplier->get(
                                        $invoice['identificacion_proveedor']);
            $invoice['invoiceDetails'] = $this->modelPaidDetail->get(
                                                $invoice['id_documento_pago']);
            return $invoice;
        }
        return false;
    }

    /**
     * Obtiene la lista de todas las facturas con sus detalles
     * @return array | boolean
     */
    public function getAll()
    {
        $documents = $this->modelBase->get_table([
            'table' => $this->table,
            'orderby' => [
                'fecha_emision' => 'DESC',
            ],
        ]);
        if ((gettype($documents) == 'array') && (count($documents) > 0)){
            $invoicesData = [];
            foreach ($documents as $item => $invoice){
                $invoice['supplier'] = $this->modelSupplier->get(
                                        $invoice['identificacion_proveedor']);
                $invoice['invoiceDetails'] = $this->getDetails(
                                                $invoice['id_documento_pago']);
                $invoicesData[$item] = $invoice;
            }
            return $invoicesData;
        }
        return false;
    }

    
    /**
     * Retorna la informacion de tabla de un documento 
     * @param int $idDocument
     */
    public function getDocument($idDocument){
        $document = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_documento_pago' => $idDocument,
            ],
        ]);
        
        if ((gettype($document) == 'array') && (count($document) > 0)){
            return $document[0];
        }
        return false;
    }    
    
    
    
    /**
     * Obtiene una lista de todas las facturas que corresponden a un pedido
     * para hacer los calculos
     * @param string $nro_order
     */
    public function getAllPaidsFromOrder(string $nro_order){
        
        $documents = $this->modelBase->get_table([
            'nro_pedido'
        ]);
        
        if ($documents == False){
            #$this->model
            return False;
        }
        
        
    }
    
    
}