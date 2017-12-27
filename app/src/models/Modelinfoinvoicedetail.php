<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * modelo que gestiona los detalles de las facturas informativas
 * @package    modelLayer
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modelinfoinvoicedetail extends CI_Model
{
    private $table = 'factura_informativa_detalle';
    private $modelBase;
    private $modelProduct;
    private $modelLog;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelbase');
        $this->load->model('modelproduct');
        $this->load->model('modellog');
        $this->modelBase = new ModelBase();
        $this->modelProduct = new Modelproduct();
        $this->modelLog = new Modellog();
    }
    
    /**
     * Obtiene el registro del detalle de un item de una factura informativa
     * @param int $idInfoInvDetail identificador Detalle
     * @return array | boolean
     */
    public function get($idInfoInvDetail)
    {
        $detail = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_factura_informativa_detalle' => $idInfoInvDetail,
            ],
        ]);
        
        if ((gettype($detail) == 'array') && (count($detail) > 0 )){
            return $detail[0];
        }
        return false;
    }
    
    /**
     * Lista los productos de las facturas informativas
     * @param int $idInfoDetail
     * @return array | boolean
     */
    public function  getByFacInformative($idInfoDetail)
    {
        $detailInfoInvoice = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_factura_informativa' => $idInfoDetail,
            ],
        ]);
        
        if (gettype($detailInfoInvoice) == 'array' && count($detailInfoInvoice) > 0){
            return $detailInfoInvoice;
        }
        return false;
    }
    
    /**
     * Registra el item de una factura infromativa en la base de datos
     * @param array $infoInvoiceDetail arreglo del detalle Fac Info
     * @return boolean | int -> last_insert id
     */
    public function create(array $infoInvoiceDetail){
        if($this->db->insert($this->table, $infoInvoiceDetail)){
            return $this->db->insert_id();
        }
        return false;
    }
  
       
    /**
     * Actualiza el detalle de una factura en la db
     * @param array $infoInvoiceDetail arreglo del detalle de la fac info
     * @return bool
     */
    public function update(array $infoInvoiceDetail):bool
    {
        $this->db->where('id_factura_informativa', $infoInvoiceDetail['id_factura_informativa']);
        if($this->db->update($this->table, $infoInvoiceDetail)){
            return true;
        }
        return false;
    }
       
    /**
     * Elimina una factura informativa de la db 
     * @param int $idinfoInvoiceDetail identificador registro db
     * @return bool
     */
    public  function delete(int $idinfoInvoiceDetail):bool
    {
        $this->db->where('id_factura_informativa', $infoInvoiceDetail['id_factura_informativa']);
        if($this->db->delete($this->table)){
            return true;
        }
        return false;
    }
    
    
}