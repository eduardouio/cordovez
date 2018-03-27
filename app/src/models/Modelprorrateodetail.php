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
    
    
}