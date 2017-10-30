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
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */

class Mymodel extends CI_Model {
    public $Result_;
    private $Query_;

    public function __construct(){
        parent::__construct();
    }


    /**
    * Guarda en la base de dato un registro si lo hace retorna 
    * @param (array) $data 
    *   
    * @return true | false
    */
    public function saveDb(string $table, array $data){
        if( $this->db->insert($table, $data) ){
            return true;
        }

        return false;
    }


    /**
     * get records from any table, example
     * SELECT [col1, col2, coln] from [mytable] where [a=b] limit [1,3];
     *
     * @param $columns (array) list name columns
     * @param $table (string) name of table target
     * @param $limit (intenger) limit rows used for pagination
     * @param $offset (intenger) [optional] aplitud
     * @return (array)
     */
    public function getRows($table, $limit, $offset=0) {
      if($offset != 0){
        $sql = "SELECT * FROM " . $table . ' LIMIT ' . $limit . ',' . $offset ;
      }else{
        $sql = "SELECT * FROM " . $table . ' LIMIT ' . $limit ;
      }
        $this->Query_ = $this->db->query($sql);
        if($this->Query_->result_array > 0)
        {
            return $this->Query_;
        }else{
            return 0;
        }
    }

    /**
     * Get basic info from table name and num rows
     * @param $table (string) table name
     * @return (array)
     */
    public function getInfo($table){
        $this->Result_["nameCols"] = $this->db->list_fields($table);
        $this->Result_["numRows"] = $this->db->count_all_results($table);
        return $this->Result_;
    }


    /**
     * Delete rows in any table
     * @param $table (string) table name
     * @param $condition (string) condition for where statment
     * @param $limit (intenger) number of records to delete
     */
    public function Del($table, $condition, $limit){
        $sql = "DELETE FROM " . $table;
        $sql = $sql . ' WHERE ' . $condition;

        if ($limit == 0) {
            $this->Query_ = $this->db->query($sql);
        } else {
            $sql          = $sql . ' LIMIT ' . $limit;
            $this->Query_ = $this->db->query($sql);
        }

        return true;
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
    *
    *           'orderby' => [
    *                               'col1' => 'ASC | DESC',
    *                               'col2' => 'ASC | DESC',
    *                               'coln' => 'ASC | DESC',
    *                           ],
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

        $resultDb = $this->db->query($sql);
        if (gettype($resultDb) ==  'boolean'){
            return false;
        }

        return $resultDb->result_array();  
    }
}