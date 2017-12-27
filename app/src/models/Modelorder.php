<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Obtiene los regostros completos de las tablas, un select * para cada tabla
 * dependiendo de las necesidaes
 * de datos
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modelorder extends CI_Model
{
    private $table = 'pedido'; 
    private $modelBase;
    private $modelExpenses;
    private $modelProduct;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelbase');
        $this->load->model('modelexpenses');
        $this->load->model('modelproduct');
        $this->modelBase = new Modelbase();
        $this->modelExpenses = new Modelexpenses();
        $this->modelProduct = new Modelproduct(); 
        
    }


    /**
     * Obtiene todas las ordenes, solo mas ordenes 
     * @return array | bool
     */
    public function getAll()
    {
        return ($this->modelBase->get_table([
            'table' => 'pedido',
        ]));
    }


    /**
     * Obtiene un regsistro completo de la orden de una tabla
     * @param (string) $nroOrder identidicador de la tabla 000-00
     * @return array | false
     */
    public function get($nroOrder)
    {
        $order = $this->modelBase->get_table([
            'table' => 'pedido',
            'where' => [
                'nro_pedido' => $nroOrder,
            ],
        ]);
        if((gettype($order) == 'array') && (count($order) > 0)){
            return $order[0];
        }
        return false;
    }


    /**
     * Obtiene el detalle de las facturas y lo cruza contra el valor total de
     * la factura
     * @param (string) $idInvoiceOrder
     * @return array | false
     */
    public function getInvoices($nroOrder)
    {
        $invoices = $this->modelBase->get_table([
            'table' => 'pedido_factura',
            'where' => [
                'nro_pedido' => $nroOrder
            ]
        ]);
        if (empty($invoices)) {
            return false;
        }
        $result = [];

        foreach ($invoices as $key => $value) {
            $value['supplier'] = $this->modelsupplier->get(
                                            $value['identificacion_proveedor']);
            $value['detailInvoice'] = $this->getInvoiceDetail($value);
            $result[$key] = $value;
        }
        return $result;
    }

    /**
     * Busca los detalles de la factura y la suma de las mimsas
     * @param array $invoice objeto factura completo
     * @return array | bool
     */
    public function getInvoiceDetail($invoice)
    {
        $detailInvoice = $this->modelBase->get_table([
            'table' => 'detalle_pedido_factura',
            'where' => [
                'id_pedido_factura' => $invoice['id_pedido_factura'],
            ],
        ]);
        if (empty($detailInvoice)) {
            return false;
        }

        $result = [];
        $valueItem = 0.00;
        $countBoxesProduct = 0.00;

        foreach ($detailInvoice as $key => $value) {
            $valueItem += floatval($value['costo_caja']) *
                floatval($value['nro_cajas']);

            $countBoxesProduct += floatval($value['nro_cajas']);

            $product = $this->modelProduct->get($value['cod_contable']);

            $value['nombre'] = $product['nombre'];
            $value['cantidad_x_caja'] = $product['cantidad_x_caja'];
            $value['unidades'] = (intval($value['cantidad_x_caja']) *
                intval($value['nro_cajas']));
            $value['costo_unidad'] = (floatval($value['costo_caja']) /
                floatval($value['cantidad_x_caja']));
            $value['total_item'] = (floatval($value['costo_caja']) *
                floatval($value['nro_cajas']));

            $result[$key] = $value;
        }

        $result['sums'] = [
            'valueItems' => $valueItem,
            'money' => $invoice['moneda'],
            'tasa_change' => $invoice['tipo_cambio'],
            'countBoxesProduct' => $countBoxesProduct,
        ];
        return $result;
    }

    /**
     * Lista las facturas pedido por proveedor
     * @param (string) $suplierId
     * @return array | boolean
     */
    public function getBysupplier($supplierId)
    {
        $invoicesList = $this->modelBase->get_table([
            'table' => 'pedido_factura',
            'where' => [
                'identificacion_proveedor' =>
                    $supplierId,
            ],
        ]);
        if ((gettype($invoicesList) == 'array') && (count($invoicesList) > 0)) {
            return $invoicesList;
        }
        return false;
    }
    
    
    /**
     * busca todas las activas que aun tengas gastos por justificar
     * Retorna un arreglo con los numeros de orden unicamente
     * @return mixed
     */
    public function getActives(){
        $orders = $this->modelBase->get_table([
            'select' => ['nro_pedido',],
            'table' => 'gastos_nacionalizacion',
            'where' => [
                'bg_closed' => 0,
            ],
            'goup_by'
        ]);
       if((gettype($orders) == 'array') && (count($orders))){
           $tempArray = [];
           $i = 0;
           $keyArray = [];
           foreach ($orders as $val){
               if(! in_array($val['nro_pedido'], $keyArray)){
                   $keyArray[$i] = $val['nro_pedido'];
                   $tempArray[$i] = $val;
               }
               $i++;
           }   
           $result = [];
           foreach ($tempArray as $key => $value){
               $value['expenses'] = 
               $this->modelExpenses->getActiveExpenses($value['nro_pedido']);
               $result[$key] = $value;
           }
           return $result;
       }
       return false;
    }
    
    /**
     * Verifica si una pedido es un regimen 70 si lo es
     * retorna el pedido sino false
     * @param string $nroORder
     * @return boolean
     */
    public function isRegimen70($nroOrder)
    {
        $order = $this->get($nroOrder);
        if($order == false || $order['regimen'] == 10){
            return false;
        }       
        return $order;
    }
}