<?php defined('BASEPATH') OR exit('No direct script access allowed');
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
class ModelMayor extends CI_Model
{
    private $modelLog;
    private $modelBase;
    private $table = 'mayor';
    
    function __construct(){
        parent::__construct();
        
        $models = [
            'Modellog',
            'ModelBase',
        ];
        
        foreach ($models as $model){
            $this->load->model($model);
        }
        
        $this->modelLog = new Modellog();
        $this->modelBase = new ModelBase();
    }  
    
    
    
    /**
     * Registra o actualiza un mayor en la base de datos
     * @param array $mayor
     * @param array $params => ['type' => '[order|parcial]' , id => '[nro_pedido | id_parcial ]'] 
     * @return bool
     */
    public function putMayor(array $mayor, array $params) : bool{
        
        $this->delete($params);
        
        if($params['type'] == 'order'){
            foreach ($mayor as $k => $det){                
                $this->create(array_merge(
                    [
                        'name' => $k,
                        'id_parcial' => 0,
                        'nro_pedido' => $params['id'],
                        'id_user' => $this->session->userdata('id_user'),
                        'date_create' => date('Y-m-d H:m:s'),
                    ] , $det)
                    );
            }
            return True;
        }
        
        foreach ($mayor as $k => $det){
            $this->create(array_merge(
                [
                    'name' => $k,
                    'id_parcial' => $params['id'],
                    'nro_pedido' => '000-00',
                    'id_user' => $this->session->userdata('id_user'),
                    'date_create' => date('Y-m-d H:m:s'),
                ] , $det)
                );
        }        
        
        return True;
    }
       
    
    /**
     * Obtiene el mayor de un pedido o parcial
     * 
     * @param array $params => ['type' => '[order|parcial]' , id => '[nro_pedido | id_parcial ]']
     */
    public function get(array $params){        
        $mayor = [];
        
        if($params['type'] == 'order'){
            $mayor = $this->modelBase->get_table([
                'table' => $this->table,
                'where' => ['nro_pedido'=> $params['id'] ,  'id_parcial' => 0 ],
            ]);
        }else{
            $mayor = $this->modelBase->get_table([
                'table' => $this->table,
                'where' => ['nro_pedido'=> '000-00', 'id_parcial' => $params['id'] ], 
            ]);            
        }
        
        
        if($mayor){
            return $mayor;
        }
        
        $this->modelLog->errorLog(
            'No se puede recuperar el mayor',
            $this->db->last_query()
            );
        
        return False;   
        
    }
    
    
    /**
     * Regitra un mayor en la base de datos 
     * 
     * @param array $mayor
     * @return |boolean
     */
    public function create(array $mayor){
        #elimna los guiones de donde no hay valores
        foreach ($mayor as $k => $v){
            if($v == '--'){
                $mayor[$k] = '0';
            }
        }        
        
        if($this->db->insert($this->table, $mayor)){
            $this->modelLog->susessLog(
                'El mayor ha sido registrao exitosamente'
                );
            return $this->db->insert_id();
        }
        
        $this->modelLog->errorLog(
            'No se puede insertar el mayor',
            $this->db->last_query()
            );
        
        return False;
    }
      
    
    /**
     * Elimna un registro de mayor de la base de datos
     * 
     * @param array $params => ['type' => '[order|parcial]' , id => '[nro_pedido | id_parcial ]']
     * @return bool
     */
    private function delete(array $params) :bool{        
        $mayor = $this->get($params);
        #significa que no se ha registrado ningun mayor
        if ($mayor == False){
            return True;
        }
        
        $status = True;
        
        foreach ($mayor as $k => $m){
            $this->db->where('id_mayor', $m['id_mayor']);
            if(!$this->db->delete($this->table)){
                $this->modelLog->errorLog(
                    'No se puede eliminar un mayor',
                    $this->db->last_query()
                    );
                
                $status = False;
            }
        }        
        
        if($status){
            $this->modelLog->susessLog('Mayor Eliminado correctamente');
        }
        
        $this->modelLog->errorLog('No se puede completar el borrado del mayor');
        return $status;
    }
}

