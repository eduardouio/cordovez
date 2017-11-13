<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modulo de mapeo de la base de datos, escaneo de tabla y preparado de
 *consultas, se reciben arreglos y se arma la consulta de entrada a la base
 * de datos
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */

class Mymodel extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

  /**
  * Obtiene el detalle de las facturas de un pedido asi como los items de cada 
  * uno de las facturas
  * @param (str) $orderId
  * @return (array) result array
  */
  public function getOrderInvProducts($orderId){
    $orders = $this->modelbase->get_table([
                                          'table' => 'pedidoFacturaView',
                                          'where' => ['nro_pedido' => $orderId],
                                        ]);
    if(!$orders) { return false;}
    
    $ordersDetail = array();
    foreach ($orders as $key => $value) {
      $ordersDetail[$key] = $value;
      $ordersDetail[$key]['orderDetail'] = $this->modelbase->get_table([
                                    'table' => 'detallePedidosView',
                                    'where' => [
                                      'id_pedido_factura' => 
                                                    $value['id_pedido_factura'],
                                              ],
                                                                    ]);
    }
    return $ordersDetail;
  }
  


  /**
  * Obtiene los gastos iniciales del pedido
  * @param (str) $orderId
  * @return (array) initial Expenses
  */
  public function getInitialExpenses($orderId){

    $initialExpenses = $this->modelbase->get_table([
                                      'table' => 'gastos_nacionalizacion',
                                      'where' => ['nro_pedido' => $orderId],
                                                ]);
    if(!$initialExpenses) { return false;}
    $expensesDetail = [];

    foreach ($initialExpenses as $key => $val) {
      $paramsQuery = [
        'select' => [
                      'nombre',
                      'identificacion_proveedor',
                      'id_proveedor',
                ],

        'table' => 'proveedor',

        'where' => [
                  'identificacion_proveedor' => $val['identificacion_proveedor'],
                ],

        'orderby' => [
                  'identificacion_proveedor' => 'ASC',
                  'nombre' => 'ASC',
                ],
      ];

      $supplier = $this->modelbase->get_table($paramsQuery);

      $expensesDetail[$key] = $val;
      $expensesDetail[$key]['nombre'] = $supplier[0]['nombre'];
      $expensesDetail[$key]['id_proveedor'] = $supplier[0]['id_proveedor'];

    }
    return $expensesDetail;
  }


    /**
    * Obtiene la lista de paises y ciudades de la tabla
    */
    public function getCountries(){
        $this->db->select('pais');
        $this->db->group_by('pais');
        $resultDb = $this->db->get('tarifa_incoterm');
        $countries = $resultDb->result_array();

        foreach ($countries as $key => $value){
            $this->db->select('ciudad');
            $this->db->where('pais' , $value['pais']);
            $this->db->group_by('ciudad');
            $resultDb = $this->db->get('tarifa_incoterm');
            $countries[$key]['cities'] = $resultDb->result_array();
        }
        return $countries;
    } 



    /**
    * Obtiene las nacionalizaciones de un pedido
    * @param (str) $orderId
    * @return (array) resul array() | false
    */
    public function getNationalizations($orderId){

        $nationalizations = $this->modelbase->get_table([
                                      'table' => 'nacionalizacion',
                                       'where' => ['nro_pedido' => $orderId]
                                                    ]);
        if(!$nationalizations){return false;}

        return $nationalizations;
    }


    /**
    * Obtiene una lista de facturas informativas
    * @param (str) $orderId
    * @return (array) resul array() | false
    */
    public function getInvoiceInformative($orderId){
        $infoInvoices = $this->modelbase->get_table([
                                         'table' => 'factura_informativa',
                                         'where' => ['nro_pedido' => $orderId]
                                                 ]);
        if(!$infoInvoices){return false;}
        return $infoInvoices;
    }

    /**
     * Get last importan from database
     * @return (array)
     */
   public function lastInfo(){
        $lastData["lastQuery"] = $this->db->last_query();
        $lastData["lastInsertId"] = $this->db->insert_id();
        return $lastData;
   }


    /**
  * Obtiene la cantidad de cajas de tiene un pedido, en cuanto al stock
  * solo se usa para el regimen 70, el 10 no tiene parciales
  * Asi como tambien otiene la cantidad de cajas nacionalizadas
  *
  * @param $nroOrder
  * @param $regimen tipo de regimen a consultar
  * @return array
  */
  public function getBoxesOrder(string $nroOrder, string $regimen){
    $result = [
              'boxesImported' => 0,
              'boxesNationalized' => 0,
              ];
    $invoices = $this->modelbase->get_table([
                                  'select'  => ['id_pedido_factura',],
                                  'table'   => 'pedido_factura',
                                  'where'   => ['nro_pedido' => $nroOrder],
                                          ]); 

    foreach ($invoices as $key => $value) {
      $boxesInvoice = $this->modelbase->get_table([
                                'select'  => ['nro_cajas'],
                                'table'   => 'detalle_pedido_factura',
                                'where'   => [
                                'id_pedido_factura' => 
                                                    $value['id_pedido_factura'],
                                  ],]);
      if ($boxesInvoice){
        foreach ($boxesInvoice as $key => $invoice) {
          $result['boxesImported'] += intval($invoice['nro_cajas']);
        }
      }
    }

      if ($regimen == '70'){
        $infoInvoices = $this->modelbase->get_table([
                                  'select'  => ['id_factura_informativa'],
                                  'table'   => 'factura_informativa',
                                  'where'   => ['nro_pedido' => $nroOrder],
                                                  ]);

        foreach ($infoInvoices as $key => $invoice) {
          $boxesInfoInvoice = $this->modelbase->get_table([
                                  'select' => [
                                              'id_factura_informativa', 
                                              'nro_cajas'
                                              ],
                                  'table' => 'factura_informativa_detalle',
                                  'where' => [
                                              'id_factura_informativa' => 
                                              $invoice['id_factura_informativa']
                                            ],
                                                      ]);
          if ($boxesInfoInvoice){
            foreach ($boxesInfoInvoice as $key => $infoinvoice) {
              $result['boxesNationalized'] += intval($infoinvoice['nro_cajas']);
            }   
          }
        }
      }
      return $result;
  }

    /**
  * Retorna los valores de 
  * Sumatoria FOB de las facturas de un Pedido
  * Lo Nacionalizado del Pedido
  * @param $order -> registro del pedido
  */
  public function getValues(array $order){
    $configIncoterm = [
                  'EXW' =>  1.0,
                  'FCA' =>  1.0,
                  'FOB' =>  1.0,
                  'CFR' => -1.0,
      ];

    $paramsInvoices = [
            'select' => ['SUM(valor * tipo_cambio) AS invoices'],
            'table' => 'pedido_factura',
            'where' => [
                      'nro_pedido' => $order['nro_pedido'],
                        ],
    ];
    
    $paramsInitExpenses = [
      'select' => ['valor_provisionado as initexpenses'],
      'table' => 'gastos_nacionalizacion',
      'where' => [
              'nro_pedido' => $order['nro_pedido'],
              'concepto' => 'GASTO ORIGEN',
                  ],
    ];

    $paramsNationalizaions = [
      'select' => ['nro_pedido'],
      'table' => 'nacionalizacion',
      'where' => [
                'nro_pedido' => $order['nro_pedido'],
                'id_factura_informativa' => 0,
                  ],
    ];

    $paramsInfoInvoices = [
      'select' => ['SUM( valor ) as infoinvoices'],
      'table' => 'factura_informativa',
      'where' => [
                'nro_pedido' => $order['nro_pedido'],
                ],
    ];

    $valInvoices = $this->modelbase->get_table($paramsInvoices);
    $valInitExpenses = $this->modelbase->get_table($paramsInitExpenses);
    $nationalizationR10 = $this->modelbase->get_table($paramsNationalizaions);
    $valInfoInvoices = $this->modelbase->get_table($paramsInfoInvoices);

     $valInvoices = ($valInvoices == false) ? 0.00 : 
                                          $valInvoices[0]['invoices'];
     $valInitExpenses = ($valInitExpenses == false) ? 0.00 : 
                                          $valInitExpenses[0]['initexpenses'];
     $nationalizationR10 = ($nationalizationR10 == false) ? 0.00 : 
                                          $nationalizationR10[0]['nro_pedido'];
     $valInfoInvoices= ($valInfoInvoices == false) ? 0.00 : 
                                          $valInfoInvoices[0]['infoinvoices'];
    $multiple =  $configIncoterm[$order['incoterm']];
  
    $result = [
      'valInvoices' => floatval($valInvoices),
      'multiple' => floatval($multiple),
      'regimen10' => ($nationalizationR10) ? true : false,
      'infoInvoices' => $valInfoInvoices,
      'initExpenses' => $valInitExpenses,
      ];
    return $result;
  }
} 