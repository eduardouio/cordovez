<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Determina el stok de un producto a partir de las facturas de productos y detalles de nacionalizaciones
 *
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @version 1.0
 * @copyright 2018 Representaciones Cordovez
 * @license Representaciones Cordovez
 * @package lib
 */
class StockOrder
{          
    
    /**
     * Retorna el stock que tiene un prducto en la bodega
     * 
     * @param array $order
     * @param array $orderInvoiceDetail
     * @param array $infoInvoicesDetail
     * @return array => [
     *              'order' => '(string)',
     *              'product => '(string)',
     *              'buyed' => '(int)',
     *              'nazionalied' => (int),
     *              'stock' => int(),
     *             ]
     */
    public function getCurrentOrderStock(
                                    array $order, 
                                    array $orderInvoicesDetail,
                                    array $infoInvoicesDetail
        ) 
    {
        
        if(empty($orderInvoicesDetail)){
            Return False;
        }
        
        $initial_stock = $this->getInitStockProducts($orderInvoicesDetail);
        $nationalized_stock = $this->getNationalizedStock($infoInvoicesDetail);
        $current_stock = $this->getCurrentStock(
                                    $initial_stock, 
                                    $nationalized_stock
            );
               
        return($this->getCurrentStock(  
                            $initial_stock, 
                            $nationalized_stock
                    )
        );            

    }
    

    /**
     * Retorna el stock inicial de los productos 
     * 
     * @param array $orderInvoices
     * @return array
     */
    private function getInitStockProducts(array $orderInvoiceDetail): array
    {
        
        $init_stock = [];
        
        foreach ($orderInvoiceDetail as $item => $detail)
        {
            $product = $detail['product'];
            $product['detalle_pedido_factura'] = $detail['detalle_pedido_factura'];
            $product['nro_cajas'] = $detail['nro_cajas'];
            $product['costo_caja'] = $detail['costo_caja'];
            $product['total_item'] = $detail['nro_cajas'] * $detail['costo_caja'];
            $product['unities'] = $detail['nro_cajas'] * $product['cantidad_x_caja'];
            
            array_push($init_stock, $product);
        }
     
        return $init_stock;
    }
    
    
    /**
     * REtorna el producto que ha sido nacionalizado
     * @param array $infoInvoicesDetail
     * @return array
     */
    private function getNationalizedStock(array $infoInvoicesDetail):array
    {
        $nationalized_stock = [];
        
        foreach ($infoInvoicesDetail as $item => $detail)
        {
            $product = [
                'detalle_pedido_factura' => $detail['detalle_pedido_factura'],
                'nro_cajas' => $detail['nro_cajas'],
            ];
            
            array_push($nationalized_stock, $product);
        }
        
        return $nationalized_stock;
    }
    
    
    
    /**
     * Calcula el stock actual de los priductos
     * 
     * @param array $initial_stock
     * @param array $nationalized_stock
     * @return array
     */
    private function getCurrentStock( 
                                        array $initial_stock, 
                                        array $nationalized_stock
        ): array {
        
        $current_stock = [];
        
        foreach ($initial_stock as $item => $product)
        {
            $product['nationalized'] = $this->searchAndGetNationalizedValue(
                        $nationalized_stock,
                        $product['detalle_pedido_factura']
                ); 
            $product['stock'] = ($product['nro_cajas'] - $product['nationalized']);
            
            array_push($current_stock, $product);
        }
        
        return $current_stock;
        
    }
    
    
    
    /**
     * Busca en un arreglo de salida si existe el producto si no existe retorna
     * cero, significa qu el producto no ha sido nacionalizado 
     * 
     * @param array $stock_nazionalized
     * @param int $id_detail_invoice
     * @return int
     */
    private function searchAndGetNationalizedValue( 
                                    array $stock_nazionalized, 
                                    int $id_detail_invoice
        ): int
    {
        $nationalized = 0;
        foreach ($stock_nazionalized as $item => $detail){
            if ($id_detail_invoice == $detail['detalle_pedido_factura']){
                $nationalized += intval($detail['nro_cajas']);
            }
        }
        
        return $nationalized;
    }
    
}

