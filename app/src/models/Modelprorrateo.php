<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Modelo encargado de manejar los prorrateos de cada parcia;
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource var $table => Nombre del la tabla de la BD
 *             var $modelBase => Nombre del modelo base de consultas
 *             var $modelExpenses => Modelo de gastos
 *             var $modelParcia; => modelo del parcial
 *
 */
class Modelprorrateo extends CI_Model
{
    
    private $table = 'prorrateo';
    private $modelBase;
    private $modelLog;
    private $modelExpesnes;
    private $modelParcial;
    private $prorrateoDetail;
    
    
    /**
     * constructor de la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    /**
     * Inicia los modelos de la clase
     */
    private function init()
    {
        $this->load->model('Modelbase');
        $this->load->model('Modellog');
        $this->load->model('Modelexpenses');
        $this->load->model('Modelparcial');
        $this->modelBase = new ModelBase();
        $this->modelLog = new Modellog();
        $this->modelExpesnes = new Modelexpenses();
        $this->modelParcial = new Modelparcial();
    }
    
    
    
    /** 
     * obtiene el el prorrateo para un parcial
     * 
     * @param (int) id_parcial
     * @return array| bool
     */
    public function getProrrateo(int $idProrrateo)
    {
        $prorrateo = $this->modelBase->get_table([
           'table' => $this->table,
           'where' => [
               'id_prorrateo' => $idProrrateo,
           ]
        ]);
               
        if(is_array($prorrateo) && !empty($prorrateo))
        {
            return $prorrateo[0];
        }
        
        $this->modelLog->warningLog(
                                'No existe el prorrato solicitado',
                                $this->db->last_query()
                                   );
        return false;
    }
    
    /**
     * retorna los prorrateos por parcial
     *
     * @param (int) id_parcial
     * @return array| bool
     */
    public function getProrrateoByParcial(int $id_parcial)
    {
        $prorrateo = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_parcial' => $id_parcial,
            ]
        ]);
        
        if(is_array($prorrateo) && !empty($prorrateo))
        {
            return $prorrateo[0];
        }
        
        $this->modelLog->warningLog(
            'No existe el prorrato solicitado',
            $this->db->last_query()
            );
        return false;
    }
    
    
    /**
     * Retorna el prorrateo de un parcial
     * 
     * @param string $nroOrder
     * @param int $idParcial si ultimo prorrateo no coincide id_parcial es el primero
     * @return array | empy array
     */
    public function getLastProrrateo(int $id_parcial)
    {
        $current_parcial = $this->modelParcial->get($id_parcial);
        
        if($current_parcial == False){
            return False;
        }
        
        
        $all_parcials = $this->modelParcial->getAllParcials(
            $current_parcial['nro_pedido']
            );
        
        $last_prorrateo = Null;
        $lasts_parcials = [];
        
        foreach ($all_parcials as $idx => $parcial){
            if($current_parcial['id_parcial'] > $parcial['id_parcial']){
                array_push($lasts_parcials, $parcial);
            }
        }
        
        if($lasts_parcials){
            $last_parcial = end($lasts_parcials);
            return $this->getProrrateoByParcial($last_parcial['id_parcial']);
        }else{
            $this->modelLog->warningLog(
                'La lista de parciales esta vacia'
                );
            return False;
        }
    }
    
    
    /**
     * Registra un prorrateo en la base de dato
     * 
     * @param array $prorrateo
     * @return bool | int last_id
     */ 
    public function createProrrateo(array $prorrateo)
    {
    
        if($this->db->insert($this->table, $prorrateo)){
            $this->modelLog->queryInsrertLog($this->db->last_query());
            return $this->db->insert_id();
        }
        
        $this->modelLog->errorLog(
                'No fue posible registrar el prorrateo en la base de datos',
                $this->db->last_query()
            );
        
        return false;
    }
    
    
    /**
     * Elmian un registro de prorrateo de la base y sus detalles de la tabla 
     * 
     * @param int $idProrrateo
     * @return bool
     */
    public function deleteProrrateo(int $idProrrateo) : bool
    {
        $this->load->model('Modelprorrateodetail');
        $prorateoDetail = new Modelprorrateodetail();
        
        if($prorateoDetail->deleteByProrrateo($idProrrateo)){
            
            $this->db->where('id_prorrateo', $idProrrateo);
            
            if($this->db->delete($this->table)){
                return true;
            }
        }
        
        $this->modelLog->errorLog(
                'Error de eliminacion de maestro detalle en prorrateos',
                $this->db->last_query()
            );
        
        return false;

    }
    
    
    /**
     * Elimina un prorrateo y sus detalles para un parcial, si e prorrateo
     * no existe retorna false
     * 
     * @param int $id_parcial
     * @return bool
     */
    public function deleteProrrateoByParcial(int $id_parcial):bool{
        
        $prorrateo = $this->getProrrateoByParcial($id_parcial);
        
        if($prorrateo){
            $prorrateo = $prorrateo[0];
            if($this->deleteProrrateo($prorrateo['id_prorrateo'])){
                return True;
            }
            
            $this->modelLog->errorLog(
                'No se puede eliminar el prorrateo',
                $this->db->last_query()
                );
            return False;
        }
        
        return True;
    }
    
    
    /**
     * Actualiza un prorrateo en la base de datos
     * 
     * @param array $prorrateo
     * @return bool
     */
    private function updateProrrateo(array $prorrateo) : bool
    {   $this->db->where('id_prorrateo', $prorrateo['id_prorrateo']);
    
        if( $this->db->update($this->table, $prorrateo))
        {
            $this->modelLog->queryUpdateLog($this->db->last_query());
            return true;
        }
        
        $this->modelLog->errorLog(
            'Error al actualizar un prorrateo',
            $this->db->last_query()  
            );
        return false;
    }
    
    
    
    
    
}

