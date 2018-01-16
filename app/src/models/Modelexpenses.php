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
    private $modelLog;

    function __construct()
    {
        parent::__construct();
        $this->init();
    }

    /**
     * Inicia modelos adicionales para la clase
     */
    public function init(){
        $this->load->model('modelbase');
        $this->load->model('modellog');
        $this->modelBase = new ModelBase();
        $this->modelLog = new Modellog();
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
                'incoterms' => $incoterms['incoterm'],
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
           'orderby' => [
             'tipo' => 'DESC',
           ],
        ]);
        if ($expenses == false) {
            return false;
        }
        return $expenses;
    }
    
    
    
    /**
     * retorna el valor de un gasto incicial 
     * @param string $nroOrder nro_pedido
     * @return float valor del gasto
     */
    public function getValueByName(string $nroOrder, string $detailName): float
    {
        $expense = $this->modelBase->get_table([
            'select' => [
                'valor_provisionado',
            ],
            'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder,
                'concepto' => $detailName,
            ],
        ]);
        
        if((gettype($expense))&&(count($expense) > 0)){
            return (floatval($expense[0]['valor_provisionado']));
        }
        $this->modelLog->warningLog('El concepto de Gasto no esta Registrado');
        $this->modelLog->warningLog($this->db->last_query());
        return false;
    }
    
    
    /**
     * Retorna el valor inicial de CIF para una orden  
     * @param string $nroORder
     * @return array arreglo SEFGURO, FLETE
     */
    public function initialCIFValue(string $nroOrder):array
    {
        $sql = "SELECT 
                    concepto, valor_provisionado  
                FROM 
                    gastos_nacionalizacion 
                WHERE 
                (concepto = 'FLETE' OR concepto = 'SEGURO') 
                AND
                nro_pedido = '$nroOrder'";
        $resultDb = $this->db->query($sql);
        return ($resultDb->result_array());
    }
    
    
    /**
     * Retorna todos los gastos inicales de un pedido
     * @param (string) $nroOrder
     * @return array | boolean
     */
    public function getInitialExpenses($nroOrder)
    {
        $expenses = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder,
                'tipo' => 'INICIAL'
            ],
            'orderby' => [
                'tipo' => 'DESC',
            ],
        ]);
        if ($expenses == false) {
            return false;
        }
        return $expenses;
    }
    
    /**
     * Obtiene una Provision completa
     * @param int $idExpense
     * @return array | boolean
     */
    public function getExpense($idExpense){
        $expense = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_gastos_nacionalizacion' => $idExpense,
            ],
        ]);
        if(gettype($expense) == 'array' && count($expense) > 0){
             return $expense[0]; 
        }
        return false;
    }
    
    
    /**
     * Retorna los gastos de nacionalizacion para una factura infromativa
     * @param int $idInfoInvoice
     * @return array | boolean
     */
    public function getPartialExpenses(int $idInfoInvoice)
    {
        $partialExpenses = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_factura_informativa' => $idInfoInvoice, 
            ],
        ]);
        
        if(gettype($partialExpenses) == 'array' && count($partialExpenses) > 0){
            return $partialExpenses;
        }
        
        return false;
    }
    
    
  
    /**
     * Obtiene todos los gastos iniciales activos, sin justificar
     * De un pedido
     * @param string $nroOrder numero de Ordern
     * @return array | bool
     */
    public function getActiveExpenses($nroOrder)
    {
            
        $nroOrder = '100-17' ;
        $expenses = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder,
                'bg_closed' => 0,
            ],
        ]);

        $infoInvoices = $this->modelBase->get_table([
            'table' => 'factura_informativa',
            'where' => [
                'nro_pedido' => $nroOrder,
            ],
        ]);
        
        if(gettype($expenses) == 'array' && !empty($expenses)){
            if( gettype($infoInvoices) == 'array' && !empty($infoInvoices)){
                foreach ($infoInvoices as $key => $value) {
                    $nationalizationExpense = $this->modelBase->get_table([
                        'table' => $this->table,
                        'where' => [
                            'id_factura_informativa' => $value['id_factura_informativa'],
                        ],
                    ]);
                    if (is_array($nationalizationExpense)){
                    foreach ($nationalizationExpense as $idex => $val){
                        array_push($expenses, $val);
                    }                        
                    }
                }
            }
            
            return $expenses;
        }
        return false;
    }
    
    
    /**
     * Retorna los gastos de nacionalizacionde la ultima factura informativa
     * @param int $idInfoInvoice
     * @return array
     */
    public function getByInfoInvoice(int $idInfoInvoice)
    {
        $expenses = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_factura_informativa' => $idInfoInvoice,
            ],
        ]);
        if(count($expenses) > 0){
            return $expenses;
        }
        $this->modelLog->errorLog('Existe un pedido sin gastos de nacionalizacion' .  current_url());
        return false;
    }
    
    
    
    /**
     * Actualiza el registro para un gasto nacionalizacion
     * @param array $expense arregli de gasto nacionalizacion
     * @return bool
     */
    public function update(array $expense):bool
    {
        $this->db->where('id_gastos_nacionalizacion', $expense['id_gastos_nacionalizacion']);
        if($this->db->update($this->table, $expense)){
            return true;
        }
        $this->modelLog->errorLog('No se puede acceder a la base');
        $this->modelLog->errorLog($this->db->last_query());
        return false;
    }
        
    /**
     * Crea un gasto de nacionalizacion en la tabla
     * @param array $expense arreglo de gasto nacionalizacion
     * @return bool | int last_insert
     */
    public function create(array $expense)
    {
        if($this->db->insert($this->table, $expense)){
            return($this->db->insert_id());
        }
        $this->modelLog->errorLog('No se puede crear un gasto Nacionalizaicon ' . current_url());
        $this->modelLog->errorLog($this->db->last_query());
        return false;
    }
    
    
    /**
     * Elimina un gasto de nacionalizacion
     * @param int $idExpense
     * @return boolean
     */
    public function delete(int $idExpense): bool{
        $this->db->where('id_gastos_nacionalizacion', $idExpense);
        if($this->db->delete($this->table)){
            return true;
        }
        $this->modelLog->errorLog('No se puede eliminar un gasto de nacionalizacion ' . current_url());
        $this->modelLog->errorLog($this->db->last_query());
        return false;
    }
}

