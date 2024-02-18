<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Modulo de mapeo de la base de datos, escaneo de tabla y preparado de
 * consultas, se reciben arreglos y se arma la consulta de entrada a la base
 * de datos
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Todos los derechos Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class Mymodel extends CI_Model
{
    
    private $modelBase;
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
     * Inicia los modelos para la clase
     */
    private function init(){
        $this->load->model('modelbase');
        $this->load->model('modellog');
        $this->modelBase = new ModelBase();
        $this->modelLog = new Modellog();
        
    }
    
    /**
     * Obtiene la lista de paises y ciudades de la tabla
     */
    public function getCountries()
    {
        $this->db->select('pais');
        $this->db->group_by('pais');
        $resultDb = $this->db->get('tarifa_incoterm');
        $countries = $resultDb->result_array();
        
        foreach ($countries as $key => $value) {
            $this->db->select('ciudad');
            $this->db->where('pais', $value['pais']);
            $this->db->group_by('ciudad');
            $resultDb = $this->db->get('tarifa_incoterm');
            $countries[$key]['cities'] = $resultDb->result_array();
        }
        return $countries;
    }
    
    /**
     * Obtiene las nacionalizaciones de un pedido
     *
     * @param (str) $orderId
     * @return (array) resul array() | false
     */
    public function getNationalizations($orderId)
    {
        $nationalizations = $this->modelBase->get_table([
            'table' => 'nacionalizacion',
            'where' => [
                'nro_pedido' => $orderId
            ]
        ]);
        if (! $nationalizations) {
            return false;
        }
        return $nationalizations;
    }
    
    /**
     * Get last importan from database
     *
     * @return (array)
     */
    public function lastInfo()
    {
        $lastData["lastQuery"] = $this->db->last_query();
        $lastData["lastInsertId"] = $this->db->insert_id();
        return $lastData;
    }
    
    /**
     * Realiza una busqueda en la base de datos de aeurdo a las soguientes condiciones
     *
     * @param string $tableDb
     *            nombre de la tabla a buscar
     * @param array $searchValues
     *            arreglo clave valor
     *            $searchValues = [
     *            string searchCriteria criterio de busqueda,
     *            array columns columnas en las que se desea buscar,
     *            array orderby columna por la que ordena la orientacion (opcional)
     *            ]
     */
    public function searchDb(string $tableDb, array $querySearchParams)
    {
        $searchCritera = $querySearchParams['searchCriteria'];
        $query = 'select * from ' . $tableDb . ' where ';
        $index = 0;
        foreach ($querySearchParams['columns'] as $paramQuery) {
            if ($index > 0) {
                $query .= " OR ";
            }
            $query .= $paramQuery . " = '" . $searchCritera . "' ";
            $query .= " OR " . $paramQuery . " LIKE " . " '%" . $searchCritera . "' ";
            $query .= " OR " . $paramQuery . " LIKE " . " '" . $searchCritera . "%' ";
            $query .= " OR " . $paramQuery . " LIKE " . " '%" . $searchCritera . "%' ";
            $index ++;
        }
        
        if (isset($querySearchParams['orderby'])) {
            $query .= ' ORDER BY ';
            foreach ($querySearchParams['orderby'] as $key => $val) {
                $query .= $key . ' ' . $val . '';
            }
        }
        $result = $this->db->query($query);
        if ($result->num_rows() == 0) {
            return false;
        }
        return ($result->result_array());
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
        ]);
    }
    
}
