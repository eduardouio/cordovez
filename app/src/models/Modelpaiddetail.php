<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo encargado de gestionar los detalles de los Documentos de Pagos
 * de datos
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modelpaiddetail extends \CI_Model
{
    private $table = 'detalle_documento_pago';
    private $modelExpenses;
    private $modelBase;
    private $myModel;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelexpenses');
        $this->load->model('modelbase');
        $this->load->model('mymodel');
        $this->modelExpenses = new Modelexpenses();
        $this->modelBase = new ModelBase();
        $this->myModel = new Mymodel();
    }
    
    /**
     * Obtiene los detalles de las facturas y sus sumas, recupera la descripcion
     * de la provision a la que representa
     * @param $nroDocument int identificador del docuemnto de pago
     * @return array | boolean
     */
    public function get($nroDocument)
    {
        $detailsInvoice['details'] = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_documento_pago' => $nroDocument,
            ],
        ]);
        if (gettype($detailsInvoice) == 'array' && count($detailsInvoice) > 0){
            $val = 0.0;
            foreach ($detailsInvoice['details'] as $item => $detail){
                $detail['expense'] =
                $this->modelExpenses->getExpense($detail['id_gastos_nacionalizacion']);
                $val += $detail['valor'];
                $detailsInvoice['details'][$item] = $detail;
            }
            $detailsInvoice['sums'] = $val;
            return $detailsInvoice;
        }
        return false;
    }
    
    /**
     * Obtiene un detalle de una factura de pago 
     * @param int $idDetail
     * @ return array | boolean
     */
    public function  getDetail($idDetail){
        $detail = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_detalle_documento_pago' => $idDetail,
            ],
        ]);
        
        if(gettype($detail) == 'array' && count($detail) > 0){
            return $detail[0];
        }
        return false;
    }
    
    
    /**
     * Obtiene una justificacion en base a una provision
     * @param int $idExpense
     * @return array | false
     */
    public function getByExpense($idExpense){
        $details = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_gastos_nacionalizacion' => $idExpense,
            ],
        ]);
        if(gettype($details) == 'array' && count($details) > 0){
            $value = 0.0;
            foreach($details as $index => $detail){
                $value += $detail['valor'];
            }
            $details['sums'] = $value;
            return $details;
        }
        return false;
    }
}

