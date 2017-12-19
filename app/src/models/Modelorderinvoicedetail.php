<?php

class Modelorderinvoicedetail extends CI_Model
{

    private $table = 'detalle_pedido_factura';
    private $modelBase;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelbase');
        $this->modelBase = new ModelBase();
    }
    
    
    /**
     * Retorna el registro para un detalle de pedido factura
     * @param int $idInvoiceOrderDetail
     * @return array | boolean
     */
    public function get($idInvoiceOrderDetail)
    {
        $invoiceOrderDetail = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'detalle_pedido_factura' => $idInvoiceOrderDetail,
            ],
        ]);
        if(gettype($invoiceOrderDetail) == 'array' && count($invoiceOrderDetail) > 0){   
           return $invoiceOrderDetail[0];
        }
        return false;
    }
    
    
    /**
     * recupera los productos de una factura de productos
     * @param int $idOrderInvoice identificador de la tabla
     * @return array | boolean
     */
    public function getProducts(int $idOrderInvoice)
    {
        $products = $this->modelBase->get_table([
            'table' => $this->table,
            'where' =>[
                'id_pedido_factura' => $idOrderInvoice,
            ],
        ]);
        
        if ($products == false){
            return false;
        }
        return $products;
    }
    
    /**
     * registra el detalle de una factura
     * @param array $orderInvoiceDetail
     * @return int | boolean
     */
    public function create(array $orderInvoiceDetail)
    {
        if($this->db->insert($this->table, $orderInvoiceDetail)){
            return $this->db->insert_id();
        }
        return false;
    }

    
    /**
     * actualiza el detalle de una factura
     * @param array $orderInvoiceDetail
     * @return bool
     */
    public function update(array $orderInvoiceDetail):bool
    {
        $this->db->where('detalle_pedido_factura', $orderInvoiceDetail['detalle_pedido_factura']);
        if($this->db->update($this->table, $orderInvoiceDetail)){
            return true;
        }
        return false;
    }
    
    /**
     * Elimina un detalle de una factura 
     * @param int $idorderInvoiceDetail
     * @return bool
     */
    public function delete(int $idorderInvoiceDetail): bool
    {
        $this->db->where('detalle_pedido_factura', $idorderInvoiceDetail);
        if($this->db->delete($this->table)){
            return true;
        }
        return false;
    }
    
    
    /**
     * 
     * @param array $newRowParams [
     *                      'id_pedido_factura',
     *                      'cod_contable',
     *                      'grado_alcoholico',
     *                              ]
     * @return bool
     */
    public function isAlreadyExistItem(array $invoiceOrderDetail): bool{
        $existItem = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'cod_contable' => $invoiceOrderDetail['cod_contable'],
                'id_pedido_factura' => $invoiceOrderDetail['id_pedido_factura'],
                'grado_alcoholico' => $invoiceOrderDetail['grado_alcoholico'],
                        ],
            ]); 
        if ($existItem){
            return true;
        }
        return false;
    }
    
}