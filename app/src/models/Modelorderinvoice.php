<?php
class Modelorderinvoice extends CI_Model
{   
    private $table = 'pedido_factura';
    private $modelBase;
    private $modelLog;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelbase');
        $this->load->model('modellog');
        $this->modelBase = new ModelBase();
        $this->modelLog = new Modellog();
        
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
        $this->modelLog->warningLog('La consulta ha retorna un valor vacio ' .
                                                                current_url() );     
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
        if(gettype( $invoicesOrder) == 'array' && count($invoicesOrder) > 0){
            return $invoicesOrder;
        }
        return false;
    }
    
    
    /**
     * Retorna los valores CIF de un pedido
     * 
     * @param string $nroOrder numero de la order
     * @return float valor del Fob
     */
    public function getFOBValue(string $nroOrder) : float
    {
        $orderInvoices = $this->modelBase->get_table([
            'select' => [
                'SUM(valor) as fob'
            ],
            'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder,
            ],
        ]);
        
        if(gettype($orderInvoices == 'array') && count($orderInvoices)> 0){
            return(floatval($orderInvoices[0]['fob']));
        }
        
        $this->modelLog->errorLog('Pedido sin Facturas');
        $this->modelLog->errorLog($this->db->last_query);
        return  false;
        
    }
    
    
    
    /**
     * Retorna el valor que suman las facturas, el fob actual se calcula
     * FOBinical = suma valor de Facturas * tipo de cambio factura pedido
     * CurrentFOB = suma valor de parciales * tipo de cambio factura pedido
     * Con esto se mantiene la relacion de lo nacionalizado y lo declarado
     * inicialemente, el tipo de cambio de la factura informativa solo
     * se usa para la declaracion de impuestos
     * 
     * @param string $nroPedido
     * @return float
     */
    public function getInitCIFOrder(string $nroOrder):array
    {

        $orderInvoices = $this->getbyOrder($nroOrder);
        
        $initFlete = $this->modelBase->get_table([
            'table' => 'gastos_nacionalizacion',
            'where' => [
                'nro_pedido' => $nroOrder,
                'concepto' => 'FLETE'
            ],
        ]);
        
        $initSeguro = $this->modelBase->get_table([
            'table' => 'gastos_nacionalizacion',
            'where' => [
                'nro_pedido' => $nroOrder,
                'concepto' => 'SEGURO'
            ],
        ]);
        
        
                
        $cifInitial = [
            'fob' => 0.0,
            'seguro' => floatval($initSeguro[0]),
            'flete' => floatval($initFlete[0]),
        ];

        if (is_array($orderInvoices)){
            foreach ($orderInvoices as $item => $invoice){
                
                $cifInitial['fob'] += ($invoice['valor'] * ($invoice['tipo_cambio']));
            }
            
            return $cifInitial;
        }
        
        $this->modelLog->errorLog(
                            'Pedido sin facturas, no procede, FOB inicial en cero',
                            $this->db->last_query()
                            );
        
        print 'El FOB Inicial no puede ser CERO, sin facturas de producto';
        return $cifInitial;
    }
    
    
    /**
     * Retorna el tipo de cambio para un pedido, si el pedido tiene varias 
     * facturas de producto se toma el tipo de cambio de la primera ya que aplica
     * para todas
     * @param string $nroOrder
     * @return float 
     */
    public function getTypeChange($nroOrder):float
    {
        $orderInvoice = $this->getbyOrder($nroOrder);
        
        foreach ($orderInvoice as $idx => $invoice){
            return floatval($invoice['tipo_cambio']); 
        }
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

