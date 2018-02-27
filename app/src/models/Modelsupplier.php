<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Selecciones y busquedas para los proveedores
 * de datos
 * 
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class Modelsupplier extends CI_Model
{

    private $modelBase;
    private $table = 'proveedor';
    private $modelInvoice;
    private $modelOrder;
    private $myModel;
    private $modelLog;

    function __construct()
    {
        parent::__construct();
        $this->init();
    }

    /**
     * Inicia los modelos necesarios para la clase
     */
    public function init()
    {
        $this->load->model('Modelbase');
        $this->load->model('Modelorder');
        $this->load->model('Mymodel');
        $this->load->model('Modellog');
        $this->modelBase = new ModelBase();
        $this->modelOrder = new Modelorder();
        $this->myModel = new Mymodel();
        $this->modelLog = new Modellog();
    }

    /**
     * Obtiene todas las ordenes
     * 
     * @return array | bool
     */
    public function getAll()
    {
        $this->modelLog->susessLog('Se listan los proveedores');
        return ($this->modelBase->get_table([
            'table' => $this->table,
            'orderby' => [
                'nombre' => 'ASC'
            ]
        ]));
    }

    /**
     * Obtiene un proveedor con la informacion basica, la registrada en la tabla
     * 
     * @param (string) $supplierId ruc del proveedor
     * @return array | boolean
     */
    public function get(string $idSupplier)
    {
        $supplier = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'identificacion_proveedor' => $idSupplier
            ]
        ]);
        
        if ((gettype($supplier) == 'array') && (count($supplier) > 0)) {
            return $supplier[0];
        }
        
        $this->modelLog->errorLog(
            'El proveedor Solicitado no existe' ,
             $this->db->last_query()
            );
        return false;
    }
    
    
    /**
     * Obtiene un proveedor por el identifiador de la tabla
     * @param int $idSupplier
     * @return array | boolean
     */
    public function getById($idSupplier){
        $supplier = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_proveedor' => $idSupplier
            ]
        ]);
        
        if ((gettype($supplier) == 'array') && (count($supplier) > 0)) {
            return $supplier[0];
        }
        
        $this->modelLog->errorLog(
            'El proveedor Solicitado no existe' ,
            $this->db->last_query()
            );
        
        return false;
    }
    
    /**
     * Obtiene un proveedot por categoria
     * @param string $category nombre de la categoria licores, aduana, etc
     * @return array | boolean
     */
    public function getByCategory(string $category)
    {
        $querySearchParams = [
            'searchCriteria' => $category,
            'columns' => ['categoria'],
            'orderby' => [
                'nombre' => 'ASC', 
            ],
        ];
        $this->modelLog->susessLog(
                    'Listado de proveedores por categoria ' . 
                    $category
                    );
        return ($this->myModel->searchDb($this->table, $querySearchParams));
    }
    
    
    /**
     * Realiza una busqueda de proveedor de acuerdo a un criterio
     * NOMBRE
     * RUC
     * CATEGORIA
     * @param string $searchCriteria
     * @return boolean | array
     */
    public function search($searchCriteria){
      $querySearchParams = [
          'columns' => [
              'nombre', 
              'identificacion_proveedor', 
              'categoria',
          ],
          'searchCriteria' => $searchCriteria,
      ];
      $this->modelLog->susessLog('realiza busqueda de proveedores');
      return ($this->myModel->searchDb($this->table, $querySearchParams));
    }
    
    /**
     * Retorna una lista de proveedores locales
     * @param string $location 'NACIONAL' | 'INTERNACIONAL'   
     * @return array | boolean
     */
    public function getByLocation(string $location)
    {
        if(gettype($location) != 'string'){
            return false;
        }
        $suppliers = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'tipo_provedor' => $location,
            ],
            'orderby' => [
                'nombre' => 
            'ASC'
            ],
        ]);
        if ((gettype($suppliers) == 'array') && (count($suppliers) > 0)){
            return $suppliers;
        }
        $this->modelLog->errorLog(
            'El grupo de registros solicitados no existen' ,
            $this->db->last_query()
            );
        return false;
    }
    
    
    /**
     * Actualiza la informacion de un proveedor
     * @param integer $idSupplier id autoincremental
     * @param array $supplier arreglo asociativo con info del proveedor
     * @return boolean | lastInsertid
     */
    public function update($idSupplier, $supplier){
        $this->db->where('id_proveedor', $idSupplier);
        if($this->db->update($this->table, $supplier)){
            $this->modelLog->warningLog('proveedor actualizado');      
            return true;
        }
        
        $this->modelLog->errorLog(
            'No es posible actualizar un proveedor',
            $this->db->last_query()
            );
        
        return false;
    }
    
    
    /**
     * Registra un proveedor en la base 
     * @param array $supplier datos asociados del proveedor
     * @return boolean | integer (last insert id) 
     */
    public function create($supplier){
        if($this->db->insert($this->table, $supplier)){
            $this->modelLog->susessLog('Nuevo Proveedor registrado');
            return ($this->db->insert_id());
        }
        
        $this->modelLog->errorLog(
            'No es posible registrar un proveedor',
            $this->db->last_query()
            );
        return false;
    }
    
    
    /**
     * Elimna un proveedor
     * @param int $idSupplier
     * @retutn boolean
     */
    public function delete($idSupplier)
    {
        $this->db->where('id_proveedor', $idSupplier);
        if ($this->db->delete($this->table)){
            $this->modelLog->warningLog('Provedor Eliminado' . $idSupplier );
            return true;
        }
        $this->modelLog->errorLog(
            'No es posible eliminar un proveedor',
            $this->db->last_query()
            );
        return false;
    }

    
    /**
     * Obtiene toda la informacion de un proveedor
     * Productos
     * Pedidos
     * Facturas
     *
     * @param (string) $supplierId
     * @return array | boolean
     */
    public function getAllInfo(string $supplierId)
    {
        $this->modelLog->susessLog(
            'Se solicita Toda la informacion de un proveedor ' . $supplierId 
            );
        
        return ([
            'info' => $this->get($supplierId),
            'orders' => $this->modelOrder->getBysupplier($supplierId),
            'invoces' => 'implementar',
        ]);
    }
}