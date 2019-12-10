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
    private $modelLog;


    /**
     * contructor de la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }


    /**
     * Inicia los modelos de la clase
     */
    public function init()
    {
        $this->load->model('modelbase');
        $this->load->model('modelexpenses');
        $this->load->model('modelproduct');
        $this->load->model('modellog');
        $this->modelBase = new Modelbase();
        $this->modelExpenses = new Modelexpenses();
        $this->modelProduct = new Modelproduct();
        $this->modelLog = new Modellog();
    }


    /**
     * Obtiene todas las ordenes, solo las ordenes
     * @return array | bool
     */
    public function getAll()
    {
        $query = "SELECT *, SUBSTRING(nro_pedido, -2) AS anio
                FROM pedido
                WHERE nro_pedido != '000-00'
                AND bg_isclosed = 0
                ORDER BY anio DESC,
                nro_pedido DESC limit 15;";
        return ($this->modelBase->runQuery($query));
    }


    /**
     * Obtiene todas las ordenes, solo las ordenes
     * @return array | bool
     */
    public function search($input_query){
        $input_query = str_replace('/', '-',$input_query);
        #busca por pedido
        $query_order = "SELECT *, SUBSTRING(nro_pedido, -2) AS anio
                    FROM pedido
                    WHERE
                    nro_pedido = '" . $input_query  .  "'
                    OR nro_pedido LIKE '%" . $input_query  .  "'
                    OR nro_pedido LIKE '" . $input_query  .  "%'
                    OR nro_pedido LIKE '%" . $input_query  .  "%'
                    ORDER BY anio DESC, nro_pedido DESC;
                    ";
        #busca por refrendo
        $query_refrendo = "SELECT *, SUBSTRING(nro_pedido, -2) AS anio
                    FROM pedido
                    WHERE
                    nro_refrendo = '" . $input_query  .  "'
                    OR nro_refrendo LIKE '%" . $input_query  .  "'
                    OR nro_refrendo LIKE '" . $input_query  .  "%'
                    OR nro_refrendo LIKE '%" . $input_query  .  "%'
                    ORDER BY anio DESC, nro_pedido DESC;
                    ";
        #busca por matricula
        $query_matricula = "SELECT *, SUBSTRING(nro_pedido, -2) AS anio
                    FROM pedido
                    WHERE
                    nro_matricula = '" . $input_query  .  "'
                    OR nro_matricula LIKE '%" . $input_query  .  "'
                    OR nro_matricula LIKE '" . $input_query  .  "%'
                    OR nro_matricula LIKE '%" . $input_query  .  "%'
                    ORDER BY anio DESC, nro_pedido DESC;
                    ";

        #busca por proveedor
        $query_proveedor = "SELECT *, SUBSTRING(nro_pedido, -2) AS anio
                    FROM pedido
                    WHERE
                    proveedor = '" . $input_query  .  "'
                    OR proveedor LIKE '%" . $input_query  .  "'
                    OR proveedor LIKE '" . $input_query  .  "%'
                    OR proveedor LIKE '%" . $input_query  .  "%'
                    ORDER BY anio DESC, nro_pedido DESC limit 25;
                    ";

        #busca por producto

        $query_product = "SELECT o.*, SUBSTRING(o.nro_pedido, -2) AS anio FROM detalle_pedido_factura AS dpf
                  LEFT JOIN producto AS p ON (p.cod_contable = dpf.cod_contable)
                  LEFT JOIN pedido_factura AS pf ON (dpf.id_pedido_factura = pf.id_pedido_factura)
                  LEFT JOIN pedido AS o ON (pf.nro_pedido = o.nro_pedido)
                  WHERE
                  p.nombre = '" . $input_query  .  "'
                  OR p.nombre LIKE '%" . $input_query  .  "'
                  OR p.nombre LIKE '" . $input_query  .  "%'
                  OR p.nombre LIKE '%" . $input_query  .  "%'
                  ORDER BY anio DESC, nro_pedido DESC limit 25;
                  ";




        return array_merge(
          $this->modelBase->runQuery($query_order),
          $this->modelBase->runQuery($query_matricula),
          $this->modelBase->runQuery($query_refrendo),
          $this->modelBase->runQuery($query_proveedor),
          $this->modelBase->runQuery($query_product)
        );
    }


    /**
     * Obtiene un regsistro completo de la orden de una tabla
     * @param (string) $nroOrder identidicador de la tabla 000-00
     * @return array | false
     */
    public function get(string $nroOrder)
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

        $this->modelLog->errorLog(
            'El pedido no existe',
            $this->db->last_query()
            );

        return false;
    }



    /**
     * Obtiene un regsistro completo de la orden de una tabla
     * @param (string) $id_order iddentificador de la order
     * @return array | false
     */
    public function getById(int $id_order)
    {
        $order = $this->modelBase->get_table([
            'table' => 'pedido',
            'where' => [
                'id_pedido' => $id_order
            ],
        ]);

        if((gettype($order) == 'array') && (count($order) > 0)){
            return $order[0];
        }
        return false;
    }


    /**
     * Obtiene un listado de todos los pedidos abiertos R70
     */
    public function getOpenOrdersR70(){
        $query = "SELECT *, SUBSTRING(nro_pedido, -2) AS anio
                FROM pedido
                WHERE nro_pedido != '000-00'
                AND bg_isclosed = 0
                AND regimen = '70'
                ORDER BY anio DESC,
                nro_pedido DESC;";

        $result = $this->modelBase->runQuery($query);

        if($result) {
            $this->modelLog->susessLog(
                'Devolucion de lista completa de pedidos R70'
                );
            return $result;
        }

        $this->modelLog->warningLog(
            'La lista de pedidos esta vacia',
            $this->db->last_query()
            );

        return [];
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
            $this->modelLog->warningLog(
                'El pedido Solicitado no tiene Facturas registradas'
                );
            return false;
        }

        $result = [];
        foreach ($invoices as $key => $value) {
            $value['supplier'] = $this->modelsupplier->get(
                                            $value['identificacion_proveedor']);
            $value['detailInvoice'] = $this->getInvoiceDetail($value);
            $value['valor'] =  floatval($value['valor']);
            $result[$key] = $value;
        }

        $this->modelLog->susessLog(
            'Se recuperan todas las facturas del pedido'
            );
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
        $unities = 0;

        foreach ($detailInvoice as $key => $value) {
            $valueItem += floatval($value['costo_caja']) *
                floatval($value['nro_cajas']);

            $product = $this->modelProduct->get($value['cod_contable']);

            $countBoxesProduct += floatval($value['nro_cajas']);
            $unities += ($value['nro_cajas'] * $product['cantidad_x_caja']);

            $value['nombre'] = $product['nombre'];
            $value['cantidad_x_caja'] = $product['cantidad_x_caja'];
            $value['unidades'] = (intval($value['cantidad_x_caja']) *
                intval($value['nro_cajas']));
            $value['costo_unidad'] = (floatval($value['costo_caja']) /
                floatval($value['cantidad_x_caja']));
            $value['total_item'] = (floatval($value['costo_caja']) *
                floatval($value['nro_cajas']));
            //$value['peso'] = $product['peso'];
            $result[$key] = $value;
        }

        $result['sums'] = [
            'valueItems' =>  floatval(str_replace(',','',number_format($valueItem,2))),
            'money' => $invoice['moneda'],
            'tasa_change' => $invoice['tipo_cambio'],
            'countBoxesProduct' => $countBoxesProduct,
            'unities' => $unities,
        ];
        return $result;
    }



    /**
     * Obtiene una lista de pedidos que han llegado a la bodega
     * dentro de un mes solo R10
     *
     * @param int $year
     * @param int $month
     */
    public function getArrivedCellarByDate(int $year, int $month, bool $almagro = False) : array{

        $f_inicio = $year . '-' . $month . '-01';
        $f_fin = $year . '-' . $month . '-31';

        if($month < 10){
            $f_inicio = $year . '-0' . $month . '-01';
            $f_fin = $year . '-0' . $month . '-31';
        }

        $query = "  SELECT *
                    FROM pedido
                    WHERE {{column}} >= '{{f_inicio}}'
                    AND {{column}} <= '{{f_fin}}'
                    AND regimen = '{{regimen}}'";

        if($almagro){
            $query = str_replace('{{column}}', 'fecha_ingreso_almacenera', $query);
            $query = str_replace('{{f_inicio}}', $f_inicio, $query);
            $query = str_replace('{{f_fin}}', $f_fin, $query);
            $query = str_replace('{{regimen}}', '70', $query);
            $query = $query . ' ORDER BY fecha_ingreso_almacenera, nro_pedido';
        }else{
            $query = str_replace('{{column}}', 'fecha_llegada_cliente', $query);
            $query = str_replace('{{f_inicio}}', $f_inicio, $query);
            $query = str_replace('{{f_fin}}', $f_fin, $query);
            $query = str_replace('{{regimen}}', '10', $query);
            $query = $query . ' ORDER BY fecha_llegada_cliente, nro_pedido';
        }

        $result = $this->modelBase->runQuery($query);

        if($result){
            $this->modelLog->susessLog(
                'Pedidos con fecha de llegada bodega oficina listados'
                );
            return  $result;
        }

        $this->modelLog->warningLog(
            'No existen pedidos con fecha de llegada oficina para lisar'
            );

        return [];
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
     * Retorna los valores de sumatorias para
     * FOB -> para calcular el valor FOB se una el incoterm,
     * existe incoterms que restan o suman valor del
     * gastos en origen poara el obtener el FOB
     * FLETE
     * SEGURO
     * CIF
     * VALOR PRODUCTOS
     * Sumatoria FOB de las facturas de un Pedido
     * Lo Nacionalizado del Pedido
     *
     * @param $order ->
     *            registro del pedido
     */
    public function getValuesOrder(array $order)
    {
        $configIncoterm = [
            'EXW' => 1.0,
            'FCA' => 1.0,
            'FOB' => 1.0,
            'CFR' => - 1.0
        ];

        $paramsInvoices = [
            'select' => [
                'SUM(valor * tipo_cambio) AS valInvoices'
            ],
            'table' => 'pedido_factura',
            'where' => [
                'nro_pedido' => $order['nro_pedido']
            ]
        ];

        $paramsInvoicesEuros = [
            'select' => [
                'SUM(valor) AS valInvoicesEuros'
            ],
            'table' => 'pedido_factura',
            'where' => [
                'nro_pedido' => $order['nro_pedido'],
                'moneda' => 'EUROS',
            ]
        ];

        $paramsInvoicesDollars = [
            'select' => [
                'SUM(valor) AS valInvoicesDollars'
            ],
            'table' => 'pedido_factura',
            'where' => [
                'nro_pedido' => $order['nro_pedido'],
                'moneda' => 'DOLARES',
            ]
        ];

        $paramsOriginExpenses = [
            'select' => [
                'valor_provisionado AS valor_provisionado'
            ],
            'table' => 'gastos_nacionalizacion',
            'where' => [
                'nro_pedido' => $order['nro_pedido'],
                'concepto' => 'GASTO ORIGEN',
                'tipo' => 'INICIAL'
            ]
        ];

        $paramsSecureExpenses = [
            'select' => [
                'valor_provisionado'
            ],
            'table' => 'gastos_nacionalizacion',
            'where' => [
                'nro_pedido' => $order['nro_pedido'],
                'concepto' => 'SEGURO',
                'tipo' => 'INICIAL'
            ]
        ];

        $paramsShipExpenses = [
            'select' => [
                'valor_provisionado'
            ],
            'table' => 'gastos_nacionalizacion',
            'where' => [
                'nro_pedido' => $order['nro_pedido'],
                'concepto' => 'FLETE',
                'tipo' => 'INICIAL'
            ]
        ];

        $paramsInfoInvoices = [
            'select' => [
                'SUM( valor * tipo_cambio ) as infoinvoices'
            ],
            'table' => 'factura_informativa',
            'where' => [
                'nro_pedido' => $order['nro_pedido']
            ]
        ];

        $paramsInfoInvoicesEuros = [
            'select' => [
                'SUM(valor) as infoinvoicesEuros'
            ],
            'table' => 'factura_informativa',
            'where' => [
                'nro_pedido' => $order['nro_pedido'],
                'moneda' => 'EUROS',
            ]
        ];

        $paramsInfoInvoicesDollars = [
            'select' => [
                'SUM(valor) as infoinvoicesDollars'
            ],
            'table' => 'factura_informativa',
            'where' => [
                'nro_pedido' => $order['nro_pedido'],
                'moneda' => 'DOLARES',
            ]
        ];

        $paramsLocalExpenses = [
            'select' => [
                'SUM(valor_provisionado) as sumexpenses'
            ],
            'table' => 'gastos_nacionalizacion',
            'where' => [
                'nro_pedido' => $order['nro_pedido']
            ]
        ];

        $multiple = $configIncoterm[$order['incoterm']];
        $valInvoices = $this->modelBase->get_table($paramsInvoices);
        $valInvoicesEuros = $this->modelBase->get_table($paramsInvoicesEuros);
        $valInvoicesDollars = $this->modelBase->get_table($paramsInvoicesDollars);
        $originExpenses = $this->modelBase->get_table($paramsOriginExpenses);
        $valSecureExpense = $this->modelBase->get_table($paramsSecureExpenses);
        $valShipExpnese = $this->modelBase->get_table($paramsShipExpenses);
        $infoInvoices = $this->modelBase->get_table($paramsInfoInvoices);
        $infoInvoicesEuros = $this->modelBase->get_table($paramsInfoInvoicesEuros);
        $infoInvoicesDollars = $this->modelBase->get_table($paramsInfoInvoicesDollars);
        $localExpenses = $this->modelBase->get_table($paramsLocalExpenses);

        return ([
            'multiple' => $multiple,
            'valInvoices' => floatval($valInvoices[0]['valInvoices']),
            'valInvoicesEuros' => floatval($valInvoicesEuros[0]['valInvoicesEuros']),
            'valInvoicesDollars' => floatval($valInvoicesDollars[0]['valInvoicesDollars']),
            'originExpenses' => (empty($originExpenses)) ? 0 : floatval($originExpenses[0]['valor_provisionado']),
            'valSecureExpense' => (empty($valSecureExpense)) ? 0 : floatval($valSecureExpense[0]['valor_provisionado']),
            'valShipExpenses' => (empty($valShipExpnese)) ? 0 : floatval($valShipExpnese[0]['valor_provisionado']),
            'infoInvoices' => floatval($infoInvoices[0]['infoinvoices']),
            'infoInvoicesEuros' => floatval($infoInvoicesEuros[0]['infoinvoicesEuros']),
            'infoInvoicesDollars' => floatval($infoInvoicesDollars[0]['infoinvoicesDollars']),
            'localExpenses' => floatval($localExpenses[0]['sumexpenses']),
            'localPaidsExpenses' => $this->localPaids($order),
        ]);
    }




    /**
     * busca ordernes activas las activas que aun tengas gastos por justificar
     * Retorna un arreglo con los numeros de orden unicamente
     * @return mixed
     */
    public function getActives(){
        $orders = $this->modelBase->get_table([
            'select' => ['nro_pedido', 'id_parcial'],
            'table' => 'gastos_nacionalizacion',
            'where' => [
                'bg_closed' => 0,
            ],
        ]);

        if((gettype($orders) == 'array') && (count($orders))){
            $i = 0;
            $tempArray = [];
            $keyArray = [];

            foreach ($orders as $idx => $o) {
                if ($o['nro_pedido'] == '000-00'){
                        $query = '
                                    SELECT nro_pedido
                                    FROM parcial
                                    WHERE id_parcial = ' .
                                    $o['id_parcial'];
                   $result = $this->modelBase->runQuery($query);
                   if($result){
                    $orders[$idx]['nro_pedido'] = $result[0]['nro_pedido'];
                   }
                }

                unset($orders[$idx]['id_parcial']);
            }

            #unifica la lista de pedidos
            foreach ($orders as $idx => $val){
                if(! in_array($val['nro_pedido'], $keyArray)){
                    $keyArray[$i] = $val['nro_pedido'];
                    $tempArray[$i] = $val;
                }
                $i++;
            }

            $result = [];

            foreach ($tempArray as $key => $value){
                $value['expenses'] = $this->modelExpenses->getActiveExpenses(
                    $value['nro_pedido']
                    );
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


    /**
     * Obtiene la cantidad de cajas de tiene un pedido, en cuanto al stock
     * solo se usa para el regimen 70, el 10 no tiene parciales
     * Asi como tambien otiene la cantidad de cajas nacionalizadas
     *
     * @param string $nroOrder
     * @param string $regimen
     *            tipo de regimen a consultar
     * @return array
     */
    public function getBoxesOrder(string $nroOrder, string $regimen)
    {
        $result = [
            'boxesImported' => 0,
            'boxesNationalized' => 0
        ];
        $invoices = $this->modelBase->get_table([
            'select' => [
                'id_pedido_factura'
            ],
            'table' => 'pedido_factura',
            'where' => [
                'nro_pedido' => $nroOrder
            ]
        ]);

        foreach ($invoices as $key => $value) {
            $boxesInvoice = $this->modelBase->get_table([
                'select' => [
                    'nro_cajas'
                ],
                'table' => 'detalle_pedido_factura',
                'where' => [
                    'id_pedido_factura' => $value['id_pedido_factura']
                ]
            ]);
            if ($boxesInvoice) {
                foreach ($boxesInvoice as $key => $invoice) {
                    $result['boxesImported'] += intval($invoice['nro_cajas']);
                }
            }
        }

        if ($regimen == '70') {
            $infoInvoices = $this->modelBase->get_table([
                'select' => [
                    'id_factura_informativa'
                ],
                'table' => 'factura_informativa',
                'where' => [
                    'nro_pedido' => $nroOrder
                ]
            ]);

            foreach ($infoInvoices as $key => $invoice) {
                $boxesInfoInvoice = $this->modelBase->get_table([
                    'select' => [
                        'id_factura_informativa',
                        'nro_cajas'
                    ],
                    'table' => 'factura_informativa_detalle',
                    'where' => [
                        'id_factura_informativa' => $invoice['id_factura_informativa']
                    ]
                ]);
                if ($boxesInfoInvoice) {
                    foreach ($boxesInfoInvoice as $key => $infoinvoice) {
                        $result['boxesNationalized'] += intval($infoinvoice['nro_cajas']);
                    }
                }
            }
        }
        return $result;
    }


    /**
     * Registra un pedido en la base de datos
     * @param array $order
     */
    public function create(array $order)
    {
        if($this->db->insert($this->table, $order)){
            $this->modelLog->queryInsrertLog($this->db->last_query());
            return $this->db->insert_id();
        }else{
            $this->modelLog->errorLog(
                'No se puede registrar el pedido en la base',
                $this->db->last_query()
                );
            return False;
        }

        return False;
    }

    /**
     * Actualiza una orden en la base de datos
     * @param array $order arreglo con datos de la orden
     * @return bool
     */
    public function update(array $order):bool
    {
        $this->db->where('nro_pedido', $order['nro_pedido']);
        if($this->db->update($this->table, $order)){
            $this->modelLog->queryUpdateLog($this->db->last_query());
            return true;
        }
        $this->modelLog->errorLog(
               'No se puede actualizar Pedido ' . $order['nro_pedido'] . ' '. current_url(),
            $this->db->last_query()
            );
        return false;
    }


    /**
     * Intenta eliminar un pedido de la base de datos
     * @param string $nroOrder nro_pedido
     * @return bool si se elimina o no
     */
    public function delete(string $nroOrder):bool
    {
        $this->db->where('nro_pedido', $nroOrder);
        if($this->db->delete($this->table)){
            $this->modelLog->warningLog('Pedido Eliminado de la base de datos', $this->db->last_query());
            return true;
        }else{
            $this->modelLog->warningLog('Se intenta eliminar un pedido con dependencias');
            return false;
        }
    }


    /**
     * Comprueba si un pedido esta cerrado
     *
     * @param string $nro_pedido
     */
    public function idClosed(string $nro_pedido): bool{
       $order = $this->get($nro_pedido);

       if($order){
           return boolval($order['bg_isclosed']);
       }
    }


    /**
     * Cierra un pedido en el sistema
     *
     * @param string $nro_pedido
     * @return bool
     */
    public function close(string $nro_pedido): bool{
        $order = $this->get($nro_pedido);
        if($order){
            $order['bg_isclosed'] = 1;
            return $this->update($order);
        }

    }


}
