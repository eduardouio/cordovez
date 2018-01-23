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
    private $modelOrderInvoiceDetail;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    
    
    /**
     * Inicia los modelos de la clase
     */
    public function init()
    {
        $this->load->model('modelbase');
        $this->load->model('modelproduct');
        $this->load->model('modellog');
        $this->load->model('Modelorderinvoicedetail');
        $this->modelBase = new ModelBase();
        $this->modelProduct = new Modelproduct();
        $this->modelLog = new Modellog();
        $this->modelOrderInvoiceDetail = new Modelorderinvoicedetail();
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
        $this->modelLog->errorLog('No se puede agregar el detalle a la factura', $this->db->last_query());
        return false;
    }
  
       
    /**
     * Actualiza el detalle de una factura en la db
     * @param array $infoInvoiceDetail arreglo del detalle de la fac info
     * @return bool
     */
    public function update(array $infoInvoiceDetail):bool
    {
        $this->db->where('id_factura_informativa_detalle', $infoInvoiceDetail['id_factura_informativa_detalle']);
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
        $this->db->where('id_factura_informativa_detalle', $idinfoInvoiceDetail);
        if($this->db->delete($this->table)){
            $this->modelLog->susessLog('se elimina un registro de factura informativa' . current_url());
            return true;
        }
        return false;
    }
    
    
    /**
     * Comprueba si un item que se va a insertar ya esta registrado
     * @param array $newRowParams [
     *                      'detalle_pedido_factura',
     *                      'id_factura_informativa',
     *                      'grado_alcoholico',
     *                              ]
     * @return bool
     */
    public function isAlreadyExistItem(array $invoiceInfoDetail): bool{
        $existItem = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'detalle_pedido_factura' => $invoiceInfoDetail['detalle_pedido_factura'],
                'id_factura_informativa' => $invoiceInfoDetail['id_factura_informativa'],
                'grado_alcoholico' => $invoiceInfoDetail['grado_alcoholico'],
            ],
        ]);
        if ($existItem){
            return true;
        }
        return false;
    }
    
    
    
    /**
     * Retorna el numero de cajas que tiene una factura informativa
     * @param int $idInfoInvoice
     * @return array [boxes = , unitid]
     */
    public function countBoxesAnd(int $idInfoInvoice):array
    {
        $quantity = [
          'boxes' => 0,
          'unities' => 0,
        ];
        
        $details = $this->getByFacInformative($idInfoInvoice);
        if(is_array($details)){
            foreach ($details as $item => $itemInvoice)
            {   
                $quantity['boxes'] =+ $itemInvoice['nro_cajas'];
                $detailOrder = $this->modelOrderInvoiceDetail->get($itemInvoice['detalle_pedido_factura']);
                $product = $this->modelProduct->get($detailOrder['cod_contable']);
                $quantity['unities'] += ($product['cantidad_x_caja'] * $itemInvoice['nro_cajas']);
            }
        }
        return $quantity;        
    }
    
    
    
}