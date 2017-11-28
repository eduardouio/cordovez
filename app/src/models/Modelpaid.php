<?php
use PhpParser\Node\Expr\Cast\Bool_;

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
    
    function __construct(){
        parent::__construct();
        $this->load->model('modelbase');
        $this->load->model('modelsupplier');
        $this->modelBase = new Modelbase();
        $this->modelSupplier = new Modelsupplier();
    }

    /**
     * Obtiene el detalle de una factura completa
     * @param $nroDoument nro de factura
     * @return array | boolean
     */
    public function get($nroDoument)
    {
        $invoice = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_documento_pago' => $nroDoument,
            ],
        ]);

        if ((gettype($invoice) == 'array') && (count($invoice) > 0)){
            $invoice = $invoice[0];
            $invoice['supplier'] = $this->modelSupplier->get(
                                        $invoice['identificacion_proveedor']);
            $invoice['invoiceDetails'] = $this->getDetails(
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
     * Obtiene los detalles de las facturas y sus sumas
     * @param $nroDocument
     * @return array | boolean
     */
    public function getDetails($nroDocument)
    {
        $detailsInvoice = $this->modelBase->get_table([
            'table' => 'detalle_documento_pago',
            'where' => [
                'id_documento_pago' => $nroDocument,
            ],
        ]);
        if (gettype($detailsInvoice) == 'array' && count($detailsInvoice) > 0){
            $val = 0.0;
            foreach ($detailsInvoice as $item => $detail){
                $val += $detail['valor'];
            }
            $detailsInvoice['sums'] = $val;
            return $detailsInvoice;
        }
        return false;
    }

    /**
     * Se registra una factura en la base de datos
     * @param $document int
     * @return boolean;
     */
    private function create($document)
    {
        print 'registra una factura';
        return false;
    }

    /**
     * @param $document factura, se actualiza usando el id_documento_pago
     * @return boolean;
     */
    private function update($document)
    {
        print 'Actualiza un registro de factura';
        return true;
    }
}