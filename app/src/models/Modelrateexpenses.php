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
class Modelrateexpenses extends CI_Model {  
    
    private $table = 'tarifa_gastos';
    private $modelBase;

	function __construct(){
		parent::__construct();
		$this->load->model('Modelbase');
		$this->modelBase = new ModelBase();
	}
    
	/**
	 * Obtiene la lista completa de las tarifas disponibles
	 * @return array | boolean
	 */
	public function getAll()
	{
        $rateExpenses =	$this->modelBase->get_table([
	        'table' => $this->table,
            'orderby' => [
                'concepto' => 'DESC',
            ],
	    ]);
        
        if(gettype($rateExpenses) == 'array' && count($rateExpenses) > 0){
            return $rateExpenses;
        }
        return false;
	}
	
	/**
	 * ontiene el regitro de uin gasto incial
	 * @param int $idRateExpense identificador tabla
	 * @return array | false
	 */
    public function get(int $idRateExpense)
    {
     $rateExpense = $this->modelBase->get_table([
         'table' => $this->table,
         'where'=> [
             'id_tarifa_gastos' => $idRateExpense,
         ],
     ]);
     
     if(gettype($rateExpense) == 'array' && count($rateExpense) > 0){
         return $rateExpense[0];
     }
     return false;     
    }
    
    
    /**
     * Crea un nuevo registro de tarifa
     * @param array $rateExpense arreglo de tarifa
     * @return bool | int 
     */
    public function create(array $rateExpense)
    {
        if($this->db->insert($this->table, $rateExpense)){
            return $this->db->insert_id();
        }
        return false;
    }
    
    /**
     * Actualiza una tarifa
     * @param array $rateExpense arreglo de tarigfa
     * @return bool
     */
    public function update(array $rateExpense):bool{
        $this->db->where('id_tarifa_gastos', $rateExpense['id_tarifa_gastos']);
        if($this->db->update($this->table, $rateExpense)){
            return true;
        }
        return false;
    }
    
    /**
     * Elimna una tarifa del sistema
     * @param int $idRateExpense identificador de la tarifa
     * @return bool
     */
    public function delete(int $idRateExpense):bool{
        $this->db->where('id_tarifa_gastos', $idRateExpense);
        if($this->db->delete($this->table)){
            return true;
        }
        return false;
    }
    
    /**
     * retorna las taifas de gastos para los gastos de nacionalizacion de un parcial
     * solo aplica para regimen 70
     * @return array | boolean
     */
    public function getPartialRates()
    {
        $rateExpenses = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'tipo_gasto' => 'GASTO NACIONALIZACION',
            ],
            'orderby' => ['concepto' => 'DESC',],
        ]);    
        
        if(gettype($rateExpenses) == 'array' && count($rateExpenses) > 0){
            return $rateExpenses;
        }
        return false;
    }
}
