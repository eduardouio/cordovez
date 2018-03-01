<?php

class Modelorderinvoicedetail extends CI_Model
{

    private $table = 'detalle_pedido_factura';
    private $modelBase;
    private $modelLog;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelbase');
        $this->load->model('Modellog');
        $this->modelBase = new ModelBase();
        $this->modelLog = new Modellog();
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
     * retorna los detalles de una factura de pedido
     * @param int $idOrderInvoice indetificador de tabla padre
     * @return array | boolean
     */
    public function getByOrderInvoice(int $idOrderInvoice){
        $invoicesOrderDetails = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_pedido_factura' => $idOrderInvoice,
            ],
        ]);
        
        if (gettype($invoicesOrderDetails) == 'array' && count($invoicesOrderDetails) > 0){
            return $invoicesOrderDetails;
        }
        return false;
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
     * Comprueba si un item que se va a insertar ya esta registrado
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
    
    /**
     * Retorna el stock de productos en la aduana, para un pedido en especial
     * @param string $nroOrder identificado de pedido en la tabla
     * @return array items de los productos que estan disponibles Detalle_pedido_factura
     */
    public function getActiveStokProductsByOrder(string $nroOrder)
    {
        $activeStockOrder = $this->modelBase->get_table([
            'table' => 'stockActiveProductsInCustomsView',
            'where' =>[
                'nro_pedido' => $nroOrder,
            ],
        ]);
        
        if ($activeStockOrder == false){
            return false;
        }
        
        if(gettype($activeStockOrder == 'array') && count($activeStockOrder) > 0){
            $activeStockOrderTemp = [];
            foreach ($activeStockOrder as $index => $value){
                $value['nro_cajas_nacionalizadas'] = $this->nationalizedBoxesOrderInvoice($value['detalle_pedido_factura']);
                $value['stock'] = ($value['nro_cajas'] - $value['nro_cajas_nacionalizadas']);
                if( $value['stock'] > 0){
                    $activeStockOrderTemp[$index] = $value;
                }
            }
            return $activeStockOrderTemp;
        }
        
    }
    
    
    /**
     * Retorna el detalle completo de una factura 
     * inclutendo el costo por caja que se encuentra en la tabla de detalle
     * pedido factura
     *
     * @param int $idInfoInvoice
     * @return array arreglo de prodyucto
     *
     */
    public function getCompleteDetail($idInvoice)
    {
        $sql = "SELECT
        	a.*,
            c.*
        FROM
        	detalle_pedido_factura AS a
        JOIN
        	producto as c using(cod_contable)
        WHERE id_pedido_factura = $idInvoice;
            ";
        $result = $this->db->query($sql);
        
        if($result->num_rows() > 0){
            $this->modelLog->susessLog('Se realiza SQL exitoso');
            return $result->result_array();
        }
        $this->modelLog->errorLog(
            'Falla la consulta directa',
            $this->db->last_query()
            );
        return false;
    }
    
    
    /**
     * Retorna el listado de stock activo por regimen,
     * no se ha provado esta function
     * @param string $regimen 70 0 10
     * @return array
     */
    public function getAllActiveStokProductsRegimen(string $regimen )
    {
        $activeStockByRegimen = $this->modelBase->get_table([
            'table' => 'stockActiveProductsInCustomsView',
            'where' =>[
                'regimen' => $regimen,
            ],
        ]);
        if(gettype($activeStockByRegimen == 'array') && count($activeStockByRegimen) > 0){
            return $activeStockByRegimen;
        }
        return false;
    }
    
    
    /**
     * Retorna el numero de cajas nacionalizadas para un detalle de pedido factura
     * @param int $invoiceOrderDetail
     * @return int cantidad de cajas nacionalizadas
     */
    private function nationalizedBoxesOrderInvoice(int $invoiceOrderDetail):int
    {
        $sql = 'SELECT IFNULL(sum(nro_cajas),0) as nro_cajas_nacionalizadas 
                FROM factura_informativa_detalle WHERE 
                detalle_pedido_factura = ' . $invoiceOrderDetail;
        
        $result = $this->db->query($sql);
        $result = $result->result_array();
        return $result[0]['nro_cajas_nacionalizadas'];        
    }
    
}
