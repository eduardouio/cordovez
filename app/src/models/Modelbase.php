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

class ModelBase extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    
 /**
    * Recupera los registros de una tabla si no existen 
    * retorna un boleano falso
    *
    * @param (array) [table, condition => [n condition], orderby, ]
    * $paramsQuery = [
    *               'select' => [
    *                                       'col1 [AS alias]',
    *                                       'col2 [AS alias]',
    *                                       'coln [AS alias]',
    *                           ],
    *
    *           'table' => 'tableName',
    *
    *           'where' => [
    *                               'col' => 'condition1',
    *                               'col' => 'condition1',
    *                               'coln' => 'conditionn',
    *                           ],
    *           'notwhere' => [
    *                               'col' => 'condition1',
    *                               'col' => 'condition1',
    *                               'coln' => 'conditionn',
    *                           ],
    *
    *           'orderby' => [
    *                               'col1' => 'ASC | DESC',
    *                               'col2' => 'ASC | DESC',
    *                               'coln' => 'ASC | DESC',
    *                           ],
    *           'limit' => [ int ],
    *       ];
    *
    * @return (array) | (boolean)
    */
    public function get_table(array $paramsQuery){
        $sql = 'SELECT ';

        if (isset($paramsQuery['select'])) {
            if (count($paramsQuery['select']) == 1){
                $sql .= implode('', $paramsQuery['select']);
            }else{
                $sql .= implode(', ', $paramsQuery['select']);
            }
        }else{
            $sql .= ' * ';
        }


        $sql .= ' FROM ' . $paramsQuery['table'] . ' ';

        if (isset($paramsQuery['where'])) {
            $sql .= 'WHERE ' ;
            $position = 0;
            $count = (count($paramsQuery['where']))-1;
            
            foreach ($paramsQuery['where'] as $key => $val) {
            $sql .= $key . " = '" . $val  . "' ";
            if (($position > -1) && ( $position < $count )){
                $sql .= ' AND ';
            }
                $position ++;
            }    
        }        

        if(isset($paramsQuery['notwhere'])){
            $sql .= 'WHERE ' ;
            $position = 0 ;
            $count = (count($paramsQuery['notwhere'])) -1;

            foreach ($paramsQuery['notwhere'] as $key => $val) {
                $sql .= $key . " != '" . $val . "' ";
                if (($position > -1) && ( $position < $count )){
                    $sql .= ' AND ';
               }
                $position ++;
            }
        }

        if (isset($paramsQuery['orderby'])){
            $sql .= ' ORDER BY ';
            $position = 0;
            $count = (@count($paramsQuery['orderby'])) -1;
            foreach ($paramsQuery['orderby'] as $key => $val) {
                $sql .= $key . ' ' . $val . ' ';
                if (($position > -1) && ( $position < $count )){
                    $sql .= ' , ';
                }   
                $position ++;
            }
        }
        
        if(isset($paramsQuery['limit'])){
            $sql .= ' limit ' . $paramsQuery['limit'];
        }

        $resultDb = $this->db->query($sql);
        
        if (gettype($resultDb) ==  'boolean'){
            return false;
        }

        if (empty($resultDb)) {
            return false;
        }
        
      return $resultDb = $resultDb->result_array();
    }
    
    
    /**
     * Retorna los registros de bodega par aun pedido en R70
     * @param string $nroOder
     * @return array | boolean
     */
    public function getWarenhouseExpesnes(string $nroOder){
        $sql = "select * from gastos_nacionalizacion where nro_pedido = '" . 
                $nroOder . "' and fecha_fin != null";
        $resultDb = $this->db->query($sql);
        
        if (gettype($resultDb) ==  'boolean'){
            return false;
        }
        
        if (empty($resultDb)) {
            return false;
        }
        
        return $resultDb = $resultDb->result_array();
    }
}