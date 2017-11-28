<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modulo base para las consultas en el sistema Mysql 
 * Valida las consultas
 * de datos
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */

class Modelnationalized extends CI_Model {

    public function __construct(){
        parent::__construct();
    }
    
    
    /**
     * Obtiene el valor nacionalizado de un pedido
     * @param $nroOrder indentifocador del pedido
     * @return decimal
     */
    public function getNationalizedVal($order): float
    {
        if ($order['regimen'] == '10') {
            $nationalization = $this->modelbase->get_table([
                'table' => 'nacionalizacion',
                'where' => [
                    'nro_pedido' => $order['nro_pedido'],
                ],
            ]);
            if ($nationalization == false){return 0.0;}
            return ($order['invoices']['sums']['valueItems'] *
                $order['invoices']['sums']['tasa_change'] );
        } else {
            $valueSum = 0.0;
            $infoInvoices = $this->modelinfoinvoice->get($order['nro_pedido']);
            if ($infoInvoices == false){
                return 0.0;
            }
            foreach ($infoInvoices as $item => $myInvoice){
                if($myInvoice['detailInvoice'] == false){
                    return false;
                }
                $valueSum += ($myInvoice['valor'] * $myInvoice['tipo_ambio']);
            }
            return $valueSum;
        }
    }
}
