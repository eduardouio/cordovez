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

class Modelorder extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    /**
    * Obtiene el registro completo de la orden
    *
    * @param (string) $nroOrder
    * @return array | false
    */
    public function get($nroOrder){
    	$order = $this->modelbase->get_table([
    						                      	'table' => 'pedido',
    						                      	'where' => [
    						                      						'nro_pedido' => $nroOrder,
    						                      						],
    						                      	]);
    	if (gettype($order) != 'array'){
            return false;
        }
        
        return $order;
    }


     /**
    * Obtiene el detalle de las facturas y lo cruza contra el valor total de
    * la factura
    * @param (string) $idInvoiceOrder 
    * @return array | false
    */
    public function getInvoices($nroOrder){
        $invoices = $this->modelbase->get_table([
                                        'table' => 'pedido_factura',
                                        'where' => [
                                                'nro_pedido' => $nroOrder
                                                    ]
                                            ]);
        if (empty($invoices)){
          return false;
        }

        $result =[];

        foreach ($invoices as $key => $value) {
          $supplier = $this->modelbase->get_table([
                                        'table' => 'proveedor',
                                        'where' => [
                                          'identificacion_proveedor' => 
                                          $value['identificacion_proveedor'],
                                                    ],
                                              ]);
          $value['supplier'] = $supplier[0];
          
          $value['detailInvoice'] = $this->getInvoiceDetail(
                                                  $value['id_pedido_factura']);
          $result[$key]  = $value;          
        }

        return $result;
    }

    /** 
    * Busca los detalles de la factura y la suma de las mimsas 
    * @param (int)$idInvoice => identificador de la factura
    * @return array | bool
    */
    public function getInvoiceDetail($idInvoice){
      $detailInvoice = $this->modelbase->get_table([
                                        'table' => 'detalle_pedido_factura',
                                        'where' => [
                                              'id_pedido_factura' => $idInvoice,
                                                   ],
                                                ]);
      if(empty($detailInvoice)){
        return false;
      }

      $result = [];
      $valueItem = 0.00;
      $countBoxesProduct = 0.00;

      foreach ($detailInvoice as $key => $value) {
        $valueItem += floatval($value['costo_caja']) * 
                                          floatval($value['nro_cajas']);
        $countBoxesProduct += floatval($value['nro_cajas']);
        $product = $this->modelbase->get_table([
                                    'table' => 'producto',
                                    'where' => [
                                       'cod_contable' => $value['cod_contable'],
                                                ],
                                              ]);

        $value['nombre'] = $product[0]['nombre'];
        $value['cantidad_x_caja'] = $product[0]['cantidad_x_caja'];

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
                          'countBoxesProduct' => $countBoxesProduct,
                              ];

      return $result;
    }
 }