<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Trabaja con los datos del usuario
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modeluser extends CI_Model {
    private $table = 'usuario';
    private $modelBase;
    private $modelLog;
    
    
    function __construct(){
        parent::__construct();
        $this->load->model('Modelbase');
        $this->modelBase = new ModelBase();
    }

    /**
     * Retorna la informacion de un usuario, si no existe retorna false
     * @param int $idUser
     * @return array | boolean
     */
    public function get($idUser) 
    {
        $user = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_user' => $idUser,
            ],
        ]);
        if((gettype($user) == 'array') && (count($user) > 0)){
            return $user[0];
        }
        return false;
    }
    
    
    /**
     * Crea un usuario en la base de
     * @param array $user informacion del usuario
     * @return bool | int last insert id
     */
    public function create(array $user):bool
    {   
        $this->load->model('modellog');
        $this->modelLog = new Modellog();
        
        if($this->db->insert($this->table, $user)){
            $this->modelLog->queryInsrertLog($this->db->last_query());
            return $this->db->insert_id();
        }   
        return false;
    }
    
    
    /**
     * Actualiza un ususario en la base de datos
     * @param array $user informacion del usuario
     * @return bool
     */
    public function update(array $user):bool
    {
        $this->load->model('modellog');
        $this->modelLog = new Modellog();
        
        $this->db->where('id_user', $user['id_user']);
        if($this->db->update($this->table, $user)){
            
            $this->modelLog->queryUpdateLog($this->db->last_query());
            
            return true;
        }
        return false;
    }
    
    
    /**
     * Elimina un usuario de la base de datos
     * @param int $idUser
     * @return bool
     */
    public function delete(int $idUser):bool
    {
        $this->db->where('id_user', $idUser);
        if($this->db->delete($this->table)){
            return true;
        }
        return false;
    }
    
    
    
}