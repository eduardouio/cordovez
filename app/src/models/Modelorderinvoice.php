<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modelo de pedido factura
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modelorderinvoice extends CI_Model
{   
    private $table = 'pedido_factura';
    private $modelBase;
    private $modelLog;
    private $modelOrder;
    private $modelProduct;
    private $modelOrderInvoiceDetail;

    /**
     * contrctor de la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    
    /**
     * Carga los modelos de la clase
     */
    private function init(){
        $models = [
            'modelbase',
            'modellog',
            'modelorder',
            'Modelorderinvoicedetail',
            'Modelproduct',
          ];
        
        foreach ($models as $model){
            $this->load->model($model);
        }
        
        $this->modelOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelBase = new ModelBase();
        $this->modelLog = new Modellog();
        $this->modelOrder = new Modelorder();
        $this->modelProduct = new Modelproduct();
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
     * Retorna las facturas de pedido completas de un pedido
     * @param string $nro_order
     * @return array
     */
    public function getCompleteInvoice(int $id_info_invoice):array{
        $invoice = $this->get($id_info_invoice);
        
        if($invoice == False){
            $this->modelLog->errorLog(
                'La factura no se puede recuperar no existe'
                );
            
            return False;
        }
        
       $invoice['invoice_detail'] = $this->modelOrderInvoiceDetail->getByOrderInvoice($invoice['id_pedido_factura']);
        
       if($invoice['invoice_detail']){
           foreach ($invoice['invoice_detail'] as $k => $det){
                $product = $this->modelProduct->get($det['cod_contable']);
                $invoice['invoice_detail'][$k]['cod_ice'] = $product['cod_ice'];
            }
        }
        
        return $invoice;        
                
    }
    
    
    /**
     * Obtiene todas las facturas registradas en el sistema para un producto
     */
    public function getAll(string $cod_contable){
        $order_invoices;
        
        $query = "
                    SELECT 
                    o.nro_pedido,
                    pf.id_pedido_factura,
                    o.regimen,
                    o.fecha_arribo,
                    o.fecha_ingreso_almacenera,
                    o.fecha_salida_autorizada_puerto,
                    o.fecha_llegada_cliente,
                    o.fecha_cierre,
                    pf.tipo_cambio,
                    o.fecha_liquidacion,
                    dp.nro_cajas,
                    dp.costo_caja,
                    pr.cantidad_x_caja * dp.nro_cajas as 'unidades',
                    (dp.nro_cajas * dp.costo_caja * pf.tipo_cambio) as 'fob',
                    IFNULL(dp.flete_aduana,0) as 'flete_aduana',
                    IFNULL(dp.seguro_aduana,0) as 'seguro_aduana',
                    IFNULL(dp.costo_total,0) as 'costo_total',
                    IFNULL(dp.costo_caja_final,0) as 'costo_caja_final',
                    IFNULL(dp.costo_botella,0) as 'costo_botella',
                    o.nro_liquidacion,
                    o.bg_isclosed,
                    o.bg_isliquidated,
                    o.bg_HaveExpenses
                    from detalle_pedido_factura as dp
                    left join pedido_factura as pf on (dp.id_pedido_factura = pf.id_pedido_factura)
                    left join pedido as o on (pf.nro_pedido = o.nro_pedido)
                    left join producto as pr on (dp.cod_contable = pr.cod_contable)
                    where dp.cod_contable = '{cod_contable}'
                    order by o.regimen DESC, o.fecha_arribo DESC;
                  ";
        $query = str_replace('{cod_contable}', $cod_contable, $query);
        
        $order_invoices = $this->modelBase->runQuery($query);
        
        if($order_invoices){
            return $order_invoices;
        }
        
        $this->modelLog->warningLog(
            'No existen pedidos para el producto indicado'
            );
        return [];
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
     * Retorna las facturas de pedido completas de un pedido
     * @param string $nro_order
     * @return array
     */
    public function getCompleteInvoiceByOrder(string $nro_order):array{
        $invoices = $this->getbyOrder($nro_order);
        
        if($invoices){
            foreach ($invoices as $k => $inv){
                $invoices[$k]['detail'] = $this->modelOrderInvoiceDetail->getByOrderInvoice($inv['id_pedido_factura']);
                #adjuntamos toda la informacion del producto
                if($invoices[$k]['detail']){
                    foreach ($invoices[$k]['detail'] as $i => $det){
                        $product = $this->modelProduct->get($det['cod_contable']);
                        $invoices[$k]['detail'][$i]['cod_ice'] = $product['cod_ice'];                        
                        $invoices[$k]['detail'][$i]['product'] = $product['nombre'];                        
                        $invoices[$k]['detail'][$i]['capacidad_ml'] = $product['capacidad_ml'];                        
                        $invoices[$k]['detail'][$i]['cantidad_x_caja'] = $product['cantidad_x_caja'];                        
                    }
                }
            }           
            return $invoices[0];
        }
        
        $this->modelLog->warningLog(
            'Pedidos sin factura de producto'
            );
        return [];
    }
    

    
    /**
     * Registra una factura de proveedor en la base de datos
     * @param array $invoiceOrder
     * @return int | boolean
     */   
    public function create(array $invoiceOrder)
    {
        if($this->db->insert($this->table, $invoiceOrder)){
            $this->modelLog->queryInsrertLog($this->db->last_query());
            return $this->db->insert_id();
        }
        $this->modelLog->errorLog(
            'No se puede crear la factura de pedido',
            $this->db->last_query()
            );
        return false;
    }
    
    
    
    /**
     * Verifica si en las facturas de un pedido existe alguna con euros
     * @param string $nroOrder
     * @return bool
     */
    public function haveEuros(string $nroOrder):bool
    {
        $orderInvoices = $this->getbyOrder($nroOrder);
        
        if (is_array($orderInvoices)){
            foreach ($orderInvoices as $item => $invoice){
                if($invoice['moneda'] == 'EUROS'){
                    $this->modelLog->generalLog(
                        'Pedido en moneda Nacional'
                        );
                    return true;
                }
            }
        }
        $this->modelLog->generalLog(
                'Pedido sin Facturas en modeda extrangera',
                $nroOrder
                                    );
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
        $this->modelLog->errorLog(
            'No se puede actualizar el registro factura de producto',
            $this->db->last_query()
            );
        return false;
    }
    
    /**
     * Elimina una factura de un pedido
     * @param int $idOnvoiceOrder
     * @return bool
     */
    public function delete ($idInvoiceOrder):bool
    {
        $this->modelOrderInvoiceDetail->deleteFromOrderInvoice($idInvoiceOrder);
        
        $this->db->where('id_pedido_factura',$idInvoiceOrder);
        if($this->db->delete($this->table)){
            $this->modelLog->queryUpdateLog($this->db->last_query());
            return true;
        }
        $this->modelLog->errorLog(
            'No se puede eliminar el registro',
            $this->db->last_query()
            );
        return false;
    }
    
}

