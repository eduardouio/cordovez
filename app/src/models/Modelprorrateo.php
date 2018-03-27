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
     * Retorna una lista de prorrateos para un parcial 
     * 
     * @param int $idParcial
     * @return array| bool
     */
    public function getProrrateoByParcial(int $idParcial)
    {
        $prorrateos = $this->modelBase->get_table([
           'table' => $this->table,
           'where' => [
                'id_parcial' => $idParcial,
            ],
        ]);
        
        
        if (is_array($prorrateos) && !empty($prorrateos))
        {
            return $prorrateos;
        }
        
        $this->modelLog->warningLog(
            'El parcial ' . $idParcial . ' No tiene valores de prorrateo',
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
    public function getLastProrrateo(string $nroOrder, int $id_parcial)
    {
        $parcials = $this->modelParcial->getAllParcials($nroOrder);
        
        if($parcials){
            
            $lastParcial = end($parcials);
            $prorrateo = $this->getProrrateoByParcial(
                                                    $lastParcial['id_parcial']
                                                       );
            if (is_array($prorrateo) && !empty($prorrateo)){
                
                $prorrateo = $prorrateo[0];
                if( $prorrateo['id_parcial'] == $id_parcial  ){
                    return false;
                }
                
                return $prorrateo;
                
            }else{
                    $this->modelLog->warningLog(
                        'Este es el primero prorratep del parcial para la orden' 
                        . $nroOrder
                        );
                    
                    return [];
                }
        }
        $this->modelLog->warningLog(
                    'El pedido aun no tiene parciales, este es el primero '
            );
        
        return [];        
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
            return $this->db->insert_id();
        }
        
        $this->modelLog->errorLog(
                'No fue posible registrar el prorrateo en la base de datos',
                $this->db->last_query()
            );
        
        return false;
    }
    
    
    /**
     * Elmian un registro de prorrateo de la base 
     * 
     * @param int $idProrrateo
     * @return bool
     */
    public function deleteProrrateo(int $idProrrateo) : bool
    {
        $this->db->where('id_prorrateo', $idProrrateo);
        
        if($this->db->delete($this->table)){
            return true;
        }
        
        $this->modelLog->errorLog(
                'No fue posible eliminar el registro de prorrateo',
                $this->db->last_query()
            );
        
        return false;

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
            return true;
        }
        
        $this->modelLog->errorLog(
            'Error al actualizar un prorrateo',
            $this->db->last_query()  
            );
        return false;
    }
    
    
    
    
    
}

