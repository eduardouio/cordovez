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

class Modelnationalization extends CI_Model {
    private $table = 'nacionalizacion';
    private $modelBase;
    private $myModel;
        
    public function __construct(){
        parent::__construct();
        $this->load->model('Modelbase');
        $this->load->model('Mymodel');
        $this->modelBase = new ModelBase();
        $this->myModel = new Mymodel();
    }
    
    
    /**
     * Obtiene el valor nacionalizado de un pedido
     * @param string $nroOrder indentifocador del pedido
     * @return float
     */
    public function getNationalizedVal($order): float
    {
        if ($order['regimen'] == '10') {
            $nationalization = $this->modelBase->get_table([
                'table' => $this->table,
                'where' => [
                    'nro_pedido' => $order['nro_pedido'],
                ],
            ]);
            if ($nationalization == false || empty($nationalization) ){
                return 0.0;
            }
            
            return ($order['invoices']['sums']['valueItems'] *
                $order['invoices']['sums']['tasa_change'] );
        } else {
            $valueSum = 0.0;
            $infoInvoices = $this->modelinfoinvoice->get($order['nro_pedido']);
            if ($infoInvoices == false || empty($nationalization)){
                return 0.0;
            }
            foreach ($infoInvoices as $item => $myInvoice){
                if($myInvoice['detailInvoice'] == false){
                    return false;
                }
                $valueSum += ($myInvoice['valor'] * $myInvoice['tipo_cambio']);
            }
            return $valueSum;
        }
    }
    
    /**
     * Retorna una nacionalizacion por nro de pedido, solo sirve
     * para un R10
     * @param string $nroOrder
     * @return array | boolean
     */
    public function getbyOrder($nroOrder)
    {
        $nationalization = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder,
            ],
        ]);
        if ((gettype($nationalization) == 'array') && (count($nationalization) > 0)) {
            return $nationalization[0];
        }
        return false;
    }
    
    /**
     * Crea un registro en la tabla de nacionalizacion
     * @param array $nationalization arreglo de nacionalizacionm
     * @return bool | int last_insert_id
     */
    public function create(array $nationalization)
    {
        if($this->db->insert($this->table, $nationalization)){
            return $this->db->insert_id();
        }
        return false;
    }
    
    
    /**
     * actualiza un registro de nacionalizacion
     * @param array $nationalization arreglo de nacionalizacion
     * @return bool
     */
    public function update(array $nationalization):bool
    {
        $this->db->where('id_nacionalizacion', $nationalization['id_nacionalizacion']);
        if($this->db->update($this->table, $nationalization)){
            return true;
        }
        return false;
    }
    
    
    /**
     * Elimina un nacionalizacion de la tabla
     * @param int $idNationalitation identificador de la tabla
     * @return boolean
     */
    public function delete(int $idNationalitation):bool
    {
        $this->db->where('id_nacionalizacion', $nationalization['id_nacionalizacion']);
        if($this->db->delete($this->table)){
            return true;
        }
        return false;
    }
}
