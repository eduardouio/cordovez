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
 *
 */
class Modelprorrateodetail extends CI_Model
{
    private $table = 'prorrateo_detalle';
    private $modelBase;
    private $modelLog;
    
    
    /**
     * Constructor de la clase
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('Modellog');
        $this->load->model('ModelBase');
        $this->modelLog = new Modellog();
        $this->modelBase = new ModelBase();
    }
    
    
    /**
     * Otbiene la informacion de un prorrateo
     * 
     * @param int $idProrrateo
     * @return array | false
     */
    public function getProrrateoDetail(int $idProrrateoDetail)
    {
        $prorateo = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_prorrateo_detalle' => $idProrrateoDetail,
            ]
        ]);
        
        if( is_array($prorateo) && !empty($prorateo) )
        {
            return $prorateo;
        }
        
        $this->modelLog->generalLog(
                'No se ha encontado nigun detalle para el prorrateo'
            );
        return false;
    }
    
    
    /**
     * Retorna el detalle de un prorrateo 
     * @param int $idProrrateo
     * @return array | bool
     */
    public function getAllDetailProrrateo(int $idProrrateo)
    {
        $prorrateoDetail = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_prorrateo' => $idProrrateo
            ],
        ]);
        
        if($prorrateoDetail){
            return $prorrateoDetail;
        }
            
        return false;
    }
    
    
    /**
     * obtiene el detalle de prorrateos en base a un paecual 
     * 
     * @param int $id_parcial
     */
    public function getProrrateoFromParcial(int $id_parcial){
        $prorrateo = $this->modelBase->get_table([
            'table' => 'prorrateo',
            'where' => [
                'id_parcial' => $id_parcial
            ]
        ]);
        
        if($prorrateo){
            $prorrateo = $prorrateo[0];
            $prorrateo['detalle_prorrateo'] = $this->getAllDetailProrrateo($prorrateo['id_prorrateo']);
            return $prorrateo;
        }
        
        $this->modelLog->errorLog(
            'No se puede encontrar el prrateo'
            , $this->db->last_query()
            );
        
        return False;
    }
    

        
    
    /***
     * Crea una registro
     * 
     * @param array $prorrateoDetail
     * @return int | false
     */
    public function createProrrateoDetail(array $prorrateoDetail)  
    {
        if($this->db->insert($this->table, $prorrateoDetail))
        {
            $this->modelLog->queryInsrertLog($this->db->last_query());
            return $this->db->insert_id();
        }
        
        $this->modelLog->errorLog(
            'No se puede crear el registro, error db',
            $this->db->last_query()
            );
        
        return false;
    }
    
    
    
    /**
     * Actualiza un registro
     * 
     * @param array $prorrateoDetail
     * @return bool
     */
    public function updateProrrateoDetail(array $prorrateoDetail) : bool
    {
        $this->db->where('id_prorrateo_detalle', 
                          $prorrateoDetail['id_prorrateo_detalle']
                        );
        
        if( $this->db->update($this->table, $prorrateoDetail))
        {   
            $this->modelLog->queryUpdateLog($this->db->last_query);
            return true;
        }
        
        $this->modelLog->errorLog(
            'No se actualizar el registro, error db',
            $this->db->last_query()
            );
        
        return false;
    }
    
    
    
    /**
     * Elimina un registro de prorrateo DEtalle
     * 
     * @param int $idProrrateoDetail
     * @return bool
     */
    public function deleteProrrateoDetail(int $idProrrateoDetail) : bool
    {
        $this->db->where('id_prorrateo_detalle',$idProrrateoDetail);
        if($this->db->delete($this->table))
        {
            return true;
        }
        
        $this->modelLog->errorLog(
            'No se peude elimiminar el detalle de prorrateo',
            $this->db->last_query()
            );
        
        return false;
    }
    
    
    /**
     * Elimina los detalles de un prorrateo completo
     * 
     * @param int $id_prorrateo
     * @return bool
     */
    public function deleteByProrrateo(int $id_prorrateo): bool
    {
        $this->db->where('id_prorrateo',$id_prorrateo);
        if($this->db->delete($this->table))
        {
            return true;
        }
        
        $this->modelLog->errorLog(
            'No se peude elimiminar el detalle completo del prorrateo',
            $this->db->last_query()
            );
        
        return false;
    }
    
    
    
    
}