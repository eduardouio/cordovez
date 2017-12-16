<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modulo encargado de manejar las facturas de los productos
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modelproductinvoice extends CI_Model
{
    private $table = 'pedido_factura';
    private $modelBase;
    private $myModel;
    
    /**
     * inicia los modelos de la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelbase');
        $this->load->model('mymodel');
        $this->modelBase = new ModelBase();
        $this->myModel = new Mymodel();
    }
    
    
    /**
     * Obtiene una factura de la base de datos si no existe
     * retotna false
     * @param integer $idInvoiceOrder Idetificador de la factura 
     * @return array | boolean
     */
    public function get(int $idInvoiceOrder){
        $invoiceOrder = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_pedido_factura' => $idInvoiceOrder,
            ]
        ]);
        if ((gettype($invoiceOrder) == 'array') && (count($invoiceOrder) > 0)) {
            return $invoiceOrder[0];
        }
        return false;
    }
    
    /**
     * Crea una la factura de un pedido en la bd
     * @param array $invoiceOrder arreglo con ifo de la factura pedido
     * @return int | bool
     */
    public function create(array $invoiceOrder)
    {
        if($this->db->insert($this->table, $invoiceOrder)){
            return ($this->db->insert_id());
        }
        return false;
    }
    
    
    /**
     * Elimina un registro
     * @param int $idInvoiceOrder identificador de la tabla
     * @return bool
     */
    public function delete(int $idInvoiceOrder):bool
    {
        $this->db->where('id_pedido_factuta', $idInvoiceOrder);
        if($this->db->delete($this->table)){
            return true;
        }
        return false;
    }
    
    
    public function updade(int $idInvoiceOrder, array $invoiceOrder): bool
    {
        $this->db->where('id_pedido_factuta', $idInvoiceOrder);
        if($this->db->update($this->table, $invoiceOrder)){
            return true;
        }
        return false;
    }
    
    /**
     * Retorna las facturas de productos para un pedido
     * @param string $nroOrder
     * @return array | boolean
     */
    public  function getByOrder($nroOrder)
    {
        $productInvoices = $this->modelBase->get_table([
           'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder,
            ],
        ]);
        
        if($productInvoices == false){
            return false;
        }
        return $productInvoices;
    }
}

