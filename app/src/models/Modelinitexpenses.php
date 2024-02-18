<?php defined('BASEPATH') OR exit('No direct script access allowed');

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

class Modelinitexpenses extends CI_Model
{
    private $modelLog;
    private $modelBase;
    private $table = 'gastos_nacionalizacion';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modelbase');
        $this->load->model('Modellog');
        $this->modelBase = new ModelBase();
        $this->modelLog = new Modellog();
    }
    
            
    /**
     * Recupera todos los gastos iniciales de un pedido
     * @param string $nroOrder
     * @return array | boolean
     */
    public function getAll($order)
    {
        
        $query = "SELECT * FROM  $this->table 
                 WHERE 
                        ( nro_pedido = '$order[nro_pedido]')";
        
        $initExpenses = $this->db->query($query);
        $initExpenses = $initExpenses->result_array();
        if(empty($initExpenses)){
            $this->modelLog->warningLog(
                'Pedido sin Gastos Ininiciales' , 
                $this->db->last_query()
                );
            return false;                        
        }
        
        return $initExpenses;
            
    } 
}

