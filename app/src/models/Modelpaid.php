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
    private $modelParcial;

    /**
     * Constructo de clase
     */
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
        $this->load->model('Modelparcial');
        $this->modelParcial = new Modelparcial();
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
            $invoice['saldo'] = round($invoice['valor'], 2) - round($invoice['invoiceDetails']['sums'],2);
            $invoice['valor'] = floatval($invoice['valor']);
            return $invoice;
        }
        $this->modelLog->errorLog(
            'El documento que busca no existe'
            );
        return false;
    }

    /**
     * Obtiene la lista de las ultimas 1000 facturas
     * @return array | boolean
     */
    public function getAll()
    {
        $query = 'SELECT
                    dc.id_documento_pago,
                    dc.identificacion_proveedor,
                    pr.nombre,
                    dc.nro_factura,
                    dc.fecha_emision,
                    dc.bg_closed,
                    dc.date_create,
                    dc.tipo,
                    dc.valor
                    FROM
                    documento_pago AS dc
                    LEFT JOIN proveedor as pr ON (
                                        dc.identificacion_proveedor =
                                        pr.identificacion_proveedor
                                                    )
                    where dc.bg_closed != 1
                    ORDER BY
                    dc.bg_closed ASC,
                    pr.nombre ASC,
                    dc.fecha_emision DESC limit 16';

        $result = $this->db->query($query);
        $result = $result->result_array();

        if ($result){
            $this->modelLog->susessLog(
                'Listado de documento pago recuperado correctamente'
                );
            return $result;
        }
        $this->modelLog->errorLog(
            'La tabla de documentos de pago se encuentra vacia',
            $this->db->last_query()
            );

        return False;
    }

    /**
     * REaliza un busqueda en la lista de facturas no tiene limite
     * en los resultados
     *
     * @param string $param => criterio
     */
    public function search(string $param){
        $query = "
            SELECT
            dc.id_documento_pago,
            dc.identificacion_proveedor,
            pr.nombre,
            dc.nro_factura,
            dc.fecha_emision,
            dc.bg_closed,
            dc.date_create,
            dc.tipo,
            dc.valor
            FROM
            documento_pago AS dc
            LEFT JOIN proveedor as pr ON (
                                dc.identificacion_proveedor =
                                pr.identificacion_proveedor
                                          )
            WHERE
            nro_factura = '{{param}}'
            OR  dc.nro_factura like '%{{param}}'
            OR  dc.nro_factura like '{{param}}%'
            OR  dc.nro_factura like '%{{param}}%'
            OR  dc.identificacion_proveedor = '{{param}}'
            OR  dc.identificacion_proveedor LIKE '%{{param}}'
            OR  dc.identificacion_proveedor LIKE '{{param}}%'
            OR  dc.identificacion_proveedor LIKE '%{{param}}%'
            OR  pr.nombre = '{{param}}'
            OR  pr.nombre like '%{{param}}'
            OR  pr.nombre like '{{param}}%'
            OR  pr.nombre like '%{{param}}%'
            OR  dc.fecha_emision = '{{param}}'
            ORDER BY
            dc.bg_closed ASC,
            pr.nombre ASC,
            dc.fecha_emision DESC;";

        $query = str_replace('{{param}}', $param, $query);

        $result = $this->db->query($query);
        $result = $result->result_array();

        if ($result){
            $this->modelLog->susessLog(
                'Listado de documento pago recuperado correctamente'
                );
            return $result;
        }
        $this->modelLog->errorLog(
            'La consulta no ha retornado ningun resultado',
            $this->db->last_query()
            );

        return False;
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
     * Recupera el documento pago de una justificacion, recupera un arreglo de documentos o nada
     *
     * @param int $paid_detail
     */
    public function getDocumentFromDetail(int $id_init_expense){
        $documents = [];

        $paid_details = $this->modelPaidDetail->getByExpense($id_init_expense);

        if($paid_details){
            foreach ($paid_details as $k => $paid_detail){
                $document = $this->get($paid_detail['id_documento_pago']);
                array_push($documents, $document);
            }

            $this->modelLog->susessLog(
                'Se recuperan los documentos de la justificacion'
                );

            return $documents;
        }

        return False;
    }






    /**
     * Obtiene una lista de todas las facturas que corresponden a un pedido
     * para hacer los calculos
     * @param string $nro_order
     */
    public function getAllPaidsFromOrder(string $nro_order){

        $expenses = [];
        $invoices_paids = [];

        $order_expenses  = $this->modelExpenses->get($nro_order);
        $paricals = $this->modelParcial->getAllParcials($nro_order);


        if ($order_expenses){
            foreach ($order_expenses as $idx => $exp){
                array_push($expenses, $exp);
            }
        }

        if ($paricals) {
            foreach ($paricals as $idx => $parcial){
                $parcial_expenses = $this->modelExpenses->getPartialExpenses(
                    $parcial['id_parcial']
                    );

                if ($parcial_expenses) {
                    foreach ($parcial_expenses as $idx => $exp){
                        array_push($expenses, $exp);
                    }
                }
            }
        }

        if ($expenses) {
            $paids_detail = [];
            $invoices = [];

            foreach ($expenses as $idx => $exp) {
                $detail = $this->modelPaidDetail->getByExpense(
                    $exp['id_gastos_nacionalizacion']
                    );
                if ($detail) {
                    array_push($paids_detail, $detail);
                }
            }

            if ($paids_detail) {
                foreach ( $paids_detail as $idx => $det){
                    $document = $this->get($det[0]['id_documento_pago']);
                    if ($document) {
                        array_push($invoices, $document);
                    }
                }

                return $invoices;
            }
        }

        return False;
    }

    /**
     * Actualiza un comprobante de pago
     */
    public function update(array $document):bool{
       $this->db->where('id_documento_pago', $document['id_documento_pago']);
       unset($document['id_documento_pago']);
       unset($document['supplier']);
       unset($document['invoiceDetails']);
       unset($document['nombre']);

       if($this->db->update($this->table, $document)){
           $this->modelLog->susessLog(
               'Documento pago actualizado correctamente'
               );
           return True;
       }
       $this->modelLog->errorLog(
           'No fue posible acualizar el documento de pago',
           $this->db->last_query()
           );
        return False;
    }


    /**
     * Elimina un documento pago
     * @param int $id_documento_pago
     */
    public function delete(int $id_documento_pago){
        $this->db->where('id_documento_pago', $id_documento_pago);
        if($this->db->delete($this->table)){
            $this->modelLog->susessLog(
                'Documento Pago eliminado Correctamente'
                );

            return True;
        }
        $this->modelLog->errorLog(
            'No se puede elimar el documento de la base de datos tiene dependencias'
            );

        return False;
    }

};
