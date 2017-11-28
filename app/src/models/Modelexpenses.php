<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Arma los datos para los parametros de gastos iniciales
 * de datos
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modelexpenses extends CI_Model
{
    private $table = 'gastos_nacionalizacion';
    private  $modelBase ;

    function __construct()
    {
        parent::__construct();
        $this->load->model('modelbase');
        $this->modelBase = new ModelBase();
    }


    /**
     * Obtiene todos los gastos iniciales que se pueden aplicar a un pedido
     *
     * @param (str) $regimen
     * @return array | bool
     */
    public function getAllRates($regimen)
    {
        $regExclude = '';
        ($regimen == '70') ? $regExclude = '10' : $regExclude = '70';
        $rateExpenses = $this->modelBase->get_table([
            'table' => 'tarifa_gastos',
            'where' => [
                'tipo_gasto' => 'GASTO INICIAL',

            ],
            'notwhere' => ['regimen' => 'R' . $regExclude],
            'orderby' => [
                'concepto' => 'ASC',
            ],
        ]);
        if (empty($rateExpenses)) {
            return false;
        }

        $result = [];

        foreach ($rateExpenses as $key => $value) {
            $supplier = $this->modelBase->get_table([
                'table' => 'proveedor',
                'where' => [
                    'identificacion_proveedor' =>
                        $value['identificacion_proveedor'],
                ],
            ]);
            $value['nombre'] = $supplier[0]['nombre'];
            $result[$key] = $value;
        }

        return $result;
    }
    


    /**
     * Retorna los incoterms en de un pedido, en base a su registro
     *
     * @param (array) $incoterm
     * @return array | bool
     */
    public function getIncotermsParams($incoterms)
    {
        $incoterms = $this->modelBase->get_table([
            'table' => 'tarifa_incoterm',
            'where' => [
                'incoterms' => $incoterms['incoterms'],
                'pais' => $incoterms['pais_origen'],
                'ciudad' => $incoterms['ciudad_origen'],
            ],
        ]);
        return $incoterms;
    }

    /**
     * Retorna todos los gastos de un pedido
     * @param (string) $nroOrder
     * @return array | boolean
     */
    public function get($nroOrder)
    {
        $expenses = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder,
            ],
        ]);
        if ($expenses == false) {
            return false;
        }

        if (count($expenses) == 1) {
            $expenses = $expenses[0];
        }
        return $expenses;
    }
    
  
    /**
     * Obtiene todos los gastos iniciales activos, sin justificar
     * De un pedido
     * @param $nroOrder strin numero de Ordern
     * @return array | bool
     */
    public function getActiveExpenses($nroOrder)
    {
        $expenses = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder,
                'bg_closed' => 0,
            ],
        ]);
        
        if(gettype($expenses) == 'array' && count($expenses) > 0){
            return $expenses;
        }
        return false;
    }
}