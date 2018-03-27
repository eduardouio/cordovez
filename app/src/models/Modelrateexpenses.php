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
    private $modelLog;

	function __construct(){
		parent::__construct();
		$this->init();
	}
	
	/**
	 * inicia los modelos de la clase
	 */
	public function init(){
	    $this->load->model('Modelbase');
	    $this->load->model('Modellog');
	    $this->modelBase = new ModelBase();
	    $this->modelLog = new Modellog();
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
        
        $this->modelLog->errorLog(
            'La base de datos no tiene tarifas de gastos',
            $this->db->last_query()
            );
        
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
     
     $this->modelLog->errorLog(
        'La base de datos no tiene tarifas de gastos',
        $this->db->last_query()
         );
     
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
        
        $this->modelLog->errorLog(
            'No se puede crear la tarifa gasto',
            $this->db->last_query()
            );

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
        $this->modelLog->errorLog('No se puede actualizar la tarifa gastos',
            $this->db->last_query()
            );
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

        $this->modelLog->errorLog(
            'no se puede eliminar tarifas de gastos',
            $this->db->last_query()
            );

        return false;
    }
    

    /**
     * retorna las taifas de gastos para los gastos de nacionalizacion 
     * de un parcial solo aplica para regimen 70
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
        
        $this->modelLog->errorLog(
            'La base de datos no tiene tarifas de gastos',
            $this->db->last_query()
            );
        
        return false;
    }
    
    
    /**
     * Retorna el listado de los impuestos que se aplican a una liquidacion
     * 
     * @return array
     */
    public  function getTaxesParams():array
    {
        $rates = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'tipo_gasto' => 'IMPUESTO',
                'estado' => 1,
            ],
        ]);
        
        
        return $rates;
    }
    
    /**
     * recupera el costo de la etiquetas, registrado en la base de datos
     */
    public function getParcialRates()
    {   
        $etiquetasFiscales = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'concepto' => 'ETIQUETAS FISCALES',
            ],
        ]);
        
        $rates = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'tipo_gasto' => 'IMPUESTO',
                'estado' => 1,
            ],
        ]);
        

        if(is_array($rates) && count($rates) > 0){
            return ( array_merge($rates, $etiquetasFiscales));
        }
        
        $this->modelLog->errorLog(
            'La base de datos no tiene tarifas de gastos',
            $this->db->last_query()
            );

        return false;
    }
    
}