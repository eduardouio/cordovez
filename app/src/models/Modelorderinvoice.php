<?php
class Modelorderinvoice extends CI_Model
{   
    private $table = 'pedido_factura';
    private $modelBase;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelbase');
        $this->modelBase = new ModelBase();
    }
    
    
 
    
    /**
     * Retorna el regstro para una factura por id
     * @param int $idInvoice
     * @return array | boolean
     */
    public function get($idInvoice){
        $invoice = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_pedido_factura' => $idInvoice,
            ],
        ]);
        if(gettype($invoice) == 'array' && count($invoice) > 0){
            return $invoice[0];
        }   
        return false;
    }
    
    /**
     * Retorna el las facturas de pedido para un pedido
     * @param int $idInvoice
     * @return array | boolean
     */
    public function getbyOrder($nroOrder){
        $invoicesOrder = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder,
            ],
        ]);
        if(gettype($invoicesOrder) == 'array' && count($invoicesOrder) > 0){
            return $invoicesOrder;
        }
        return false;
    }
    
    
    /**
     * Registra una factura de proveedor en la base de datos
     * @param array $invoiceOrder
     * @return int | boolean
     */   
    public function create(array $invoiceOrder)
    {
        if($this->db->insert($this->table, $invoiceOrder)){
            return $this->db->insert_id();
        }
        return false;
    }
    
    
    /**
     * Actualiza una factura de producto
     * @param array $invoiceOrder
     * @return bool
     */
    public function update (array $invoiceOrder) : bool
    {
        $this->db->where('id_pedido_factura',$invoiceOrder['id_pedido_factura']);
        if($this->db->update($this->table, $invoiceOrder)){
            return true;
        }
        return false;
    }
    
    /**
     * Elimina una factura de un pedido
     * @param int $idOnvoiceOrder
     * @return bool
     */
    public function delete ($idInvoiceOrder):bool
    {
        $this->db->where('id_pedido_factura',$idInvoiceOrder);
        if($this->db->delete($this->table)){
            return true;
        }
        return false;
    }    
}

