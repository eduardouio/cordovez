<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Modulo de manejar los parciales de los pedidos
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource var $controller => Nombre del la tabla de la BD
 *             var $listPerPage => Nro de registros por pagina
 *             var $seguroVal => Valor por el que se multiplica FOB + FLETE
 *             var $template => ubicacion de la plantilla
 *
 */

class Modelparcial extends CI_Model
{
    private $table = 'parcial';
    private $modelBase;
    private $modelLog;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelbase');
        $this->load->model('modellog');
        $this->modelBase = new ModelBase();
        $this->modelLog = new Modellog();
    }
    
    
    /**
     * Retorna el registro de un parcial
     * @param int $idParcial
     * @return array | boolean
     */
    public function get(int $idParcial)
    {
        $parcial = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_parcial' => $idParcial,
            ],
        ]);
        
        if( (is_array($parcial)) && (!empty($parcial)) ){
            return $parcial[0];
        }
        $this->modelLog->warningLog('El parcial no existe', $this->db->last_query());
        return false;
    }
    
    
    
    /**
     * Obtiene la lista de parciales para un numero de pedido
     * @param string $nroOrder
     * @return array | boolean
     */
    public function getByOrder(string $nroOrder)
    {
        $parcials = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder,
            ],
        ]);
        
        if( is_array($parcials) && count($parcials) > 0){
            return $parcials;
        }
        return false;
    }
    
    
    /**
     * Registra un parcial abierto en la base de datos 
     * @param array $parcial arreglo con informacion del parcial
     * @return int | boolean
     */
    public function create(array $parcial)
    {
               
        if($this->db->insert($this->table, $parcial)){
            $this->modelLog->susessLog('Se crea un nuevo parcual abierto ' . $this->db->insert_id());
            return $this->db->insert_id();
        }
        if($this->modelLog->errorLog('No se puede insertar un parcial' , $this->db->last_query()));
        return false;
    }
    
    
    /**
     * Retorna el ultimo parcial de un pedido, 
     * se usa para saber la fecha de salida del ultimo parical,
     * si no existe un parcial se toma la fecha de entrada a la almacenera
     * @param string $nroOrder identificador del parical
     * @return array | boolean
     */
    public function getLastParcial(string $nroOrder)
    {
        
        
    }
    
    
    /**
     * Elimina un parcial siempre y cuando este vacio
     * @param int $idParcial
     * @return bool
     */
    public function delete(int $idParcial):bool
    {
        $this->db->where('id_parcial', $idParcial);
        if($this->db->delete($this->table)){
            return true;
        }
        $this->modelLog->warningLog('No se puede eliminar el parcial', $this->db->last_query());
        return false;
    }
    
    
    
    
}
