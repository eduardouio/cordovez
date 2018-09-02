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
            'andnotwhere' => ['regimen' => 'R' . $regExclude],
            'orderby' => [
                'concepto' => 'ASC',
            ],
        ]);
        
        $this->modelLog->generalLog($this->db->last_query());
        if (empty($rateExpenses)) {
            $this->modelLog->errorLog(
                                'No se puede recuperar parametros de gastos',
                                $this->db->last_query()
                                     );
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
     * Retorna los gastos iniciales de uin pedido
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
        $this->modelLog->errorLog(
            'El concepto de Gasto no esta Registrado',
            $this->db->last_query()
            );
        
        return false;
    }
    
    
    /**
     * retorna el valor de un gasto incicial
     * @param string $nroOrder nro_pedido
     * @return float valor del gasto
     */
    public function getByName(string $nroOrder, string $detailName)
    {
        $expense = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder,
                'concepto' => $detailName,
            ],
        ]);
        
        if($expense &&(count($expense) > 0)){
            return ($expense[0]);
        }
        $this->modelLog->errorLog(
            'El concepto de Gasto no esta Registrado',
            $this->db->last_query()
            );
        
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
                #para que aparezcan los no provisionados
                #'tipo' => 'INICIAL',
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
            if($expense[0]['nro_pedido'] == '000-00'){
              $this->load->model('Modelparcial');
              $modelParcial = new Modelparcial();
              
              $parcial = $modelParcial->get($expense[0]['id_parcial']);
              $expense[0]['nro_pedido'] = $parcial['nro_pedido'];
            }
            
            return $expense[0]; 
        }
        return false;
    }
    
    
    /**
     * Retorna los gastos de nacionalizacion para un parcial
     * @param int $idInfoInvoice
     * @return array | boolean
     */
    public function getPartialExpenses(int $idParcial)
    {
        $partialExpenses = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_parcial' => $idParcial, 
            ],
            'orderby' => ['id_gastos_nacionalizacion' => 'ASC' , 'concepto' => 'DESC' ],
        ]);
                
        if(is_array($partialExpenses) && count($partialExpenses) > 0){
            return $partialExpenses;
        }
        
        $this->modelLog->generalLog(
            "Parcial $idParcial sin Gastos"
            );
        
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
        
        $expenses = $this->modelBase->get_table([
                'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder,
                'bg_closed' => 0,
            ],
        ]);
               
                
        $parcials = $this->modelBase->get_table([
            'table' => 'parcial',
            'where' => [
                'nro_pedido' => $nroOrder,
            ],
        ]);
        
        if($parcials){
        foreach ($parcials as $key => $value) {
            $nationalizationExpense = $this->modelBase->get_table([
                'table' => $this->table,
                'where' => [
                    'id_parcial' => $value['id_parcial'],
                    'bg_closed' => 0,
                ],
            ]);
            
            if (is_array($nationalizationExpense)){
                
            foreach ($nationalizationExpense as $idex => $val){
                $val['concepto'] = '[GP] ' . $val['concepto'];
                $val['tipo'] = 'Gasto Parcial';
                array_push($expenses, $val);
                }
                
            }
    }
        }
            
           return $expenses;
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
            $this->modelLog->queryUpdateLog($this->db->last_query());
            return true;
        }
        
        $this->modelLog->errorLog(
                'No se puede acceder a la base',
                $this->db->last_query()
            );
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
            $this->modelLog->queryInsrertLog($this->db->last_query());
            return($this->db->insert_id());
        }
        $this->modelLog->errorLog(
                'No se puede crear un gasto Nacionalizaicon',
                $this->db->last_query()
            );
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
            $this->modelLog->susessLog(
                'Gasto de nacionalizacion eliminado correctamente'
                );
            
            return true;
        }
        
        $this->modelLog->errorLog(
            'No se puede eliminar un gasto de nacionalizacion ', 
            $this->db->last_query()
            );
        
        return false;
    }
    
    
    /**
     * Obtiene el almacenaje del primer parcial
     * @param int $id_parcial
     */
    public function getFirstWarenhousesParcial(int $id_parcial){
        $sql = "
                SELECT * 
                FROM gastos_nacionalizacion 
                WHERE  concepto 
                LIKE 'DEPOSITO%'  
                AND  id_parcial = $id_parcial
                ORDER BY fecha ASC
                LIMIT 1
                ";

        $result  = $this->modelBase->runQuery($sql);
        
        if($result){
           return  $result[0];            
        }
        
        return False;
    }
    
    
    /**
     * Elimina todos los gastos iniciales de un pedido
     * @param string $nro_order
     * @return bool
     */
    public  function deleteInitExenses(string $nro_order):bool{
        $query = "
                DELETE FROM gastos_nacionalizacion 
                WHERE nro_pedido = '$nro_order';
                ";
        
        #validamos al usuario que hace la elimnacion        
        if($this->session->userdata('id_user') != 1){
            $this->modelLog->errorLog(
                'El usuario que accede a la funcion no puede realizar esta accion',
                $this->session->userdata('id_user')
                );
            return False;
        }
        
        if($this->modelBase->runQuery($query)){
            $this->modelLog->susessLog(
                'Se han eliminado todos los gastos iniciales del pedido'
                );
            return true;
        }
        
        $this->modelLog->errorLog(
            'No se pueden eliminar los gastos del pedido',
            $this->db->last_query()
            );
        
        return false;
}

}
