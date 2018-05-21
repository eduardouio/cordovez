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
     * Obtiene todas las ordenes, solo mas ordenes 
     * @return array | bool
     */
    public function getAll()
    {
        return ($this->modelBase->get_table([
            'table' => 'pedido',
            'notwhere' => [
                        'nro_pedido' => '000-00', 
                        ],
            'orderby' => ['nro_pedido' => 'DESC']
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
            $value['valor'] =  floatval($value['valor']);
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
        (float)$valueItem = 0.00;
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
            'valueItems' =>  floatval(str_replace(',','',number_format($valueItem,2))),
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
            'select' => ['nro_pedido',],
            'table' => 'gastos_nacionalizacion',
            'where' => [
                'bg_closed' => 0,
            ],
        ]);
        
       if((gettype($orders) == 'array') && (count($orders))){
           $tempArray = [];
           $i = 0;
           $keyArray = [];
           foreach ($orders as $val){
               if(! in_array($val['nro_pedido'], $keyArray) && ($val['nro_pedido'] != '000-00')){
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
        }
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
    
    
}
