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

class App_model extends CI_Model {
    public $Result_;
    private $Query_;
        
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * get records from any table, example
     * SELECT [col1, col2, coln] from [mytable] where [a=b] limit [1,3];
     *
     * @param $columns (array) list name columns
     * @param $table (string) name of table target
     * @param $condition (string)condition after where
     * @param $limit (intenger) limit rows used for pagination
     * @param $offset (intenger) [optional] aplitud
     * @return (array)
     */
    public function getRows($table, $condition, $limit, $columns = "*", $offset = 0 ) {
        
        $sql = 'SELECT';
        $i   = 0;
        
        if ($columns != "*") {
            
            foreach ($columns as $nameCol) {
            if ($i == 0) {
                $sql = $sql . ' ' . $nameCol;
            } else {
                 $sql = $sql . ',' . $nameCol;
                }
                $i++;
            }
        }else{
            $sql = "SELECT * ";
        }
        
        $sql = $sql . ' FROM ' . $table;
        $sql = $sql . ' WHERE ' . $condition;
        
        if ($limit == 0) {
            $sql          = $sql . ' LIMIT ' . $limit . ',' . $offset;
            $this->Query_ = $this->db->query($sql);
        } else {
            $sql          = $sql . ' LIMIT ' . $limit . ',' . $offset;
            $this->Query_ = $this->db->query($sql);
        }
        
        return $this->Query_;
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
        
}