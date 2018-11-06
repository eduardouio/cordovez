<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Obtiene informacion de los productos
 * de datos
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modelproduct extends CI_Model{
    private $table = 'producto';
    private $modelLog;
    private $modelBase;
    private $myModel;

    function __construct(){
        parent::__construct();
        $this->init();
    }
    
    
    /**
     * Inicializa los modelos para la clase
     */
    private function init(){
        $models = [
            'Modelbase',
            'Mymodel',
            'Modellog'
        ];
        foreach ($models as $model){
            $this->load->model($model);
        }        
        $this->modelLog = new Modellog();
        $this->modelBase = new  ModelBase();
        $this->myModel = new  Mymodel();
    }
    
    
    /**
     * Obtiene un producto de la tabla
     * @param string $codContable
     */
    public function get(string $codContable)
    {
        $product = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'cod_contable' => $codContable,
            ],
        ]);
        if((gettype($product) == 'array') && (count($product) > 0)){
            return $product[0];
        }
        return false;
    }


    /**
     * Obtiene toda la informacion de un prodcto
     */
    public function getAllProductInfo(string $cod_contable):array{
        $query = "
        select 
        pr.* ,
        s.nombre as 'proveedor'
        from producto as pr
        join proveedor as s on (s.identificacion_proveedor = pr.identificacion_proveedor)
        where pr.cod_contable = '{cod_contable}';
        ";
        $result = $this->modelBase->runQuery(str_replace('{cod_contable}', $cod_contable, $query));

        if($result){
            return $result[0];
        }
        return [];
    }
    
    /**
     * Obtiene la lista de todos los productos de la base
     * @return array | false
     */    
    public function getAll(){
        $products = $this->modelBase->get_table([
            'table' => $this->table,
            'orderby' => [
                'nombre' => 'DESC',
            ],
        ]);
        
        if((gettype($products) == 'array') && (count($products) > 0)){
            return $products;
        }
        return false;
    }
    
    
    /**
     * Obtiene un producto de la tabla
     * @param string $idProduct identificador tabla
     */
    public function getById(string $idProduct)
    {
        $product = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_producto' => $idProduct,
            ],
        ]);
        if((gettype($product) == 'array') && (count($product) > 0)){
            return $product[0];
        }
        return false;
    }
       
    
    /**
     * Obtiene la lista de productos de un proveedor
     * @param int $idSupplier ruc proveedor
     */
    public function getBySupplier($idSupplier){
        $products = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'identificacion_proveedor' => $idSupplier,
            ],
            'orderby' => [
                'nombre' => 'ASC',
            ],
        ]);
        if((gettype($products) == 'array') && (count($products) > 0)){
            return $products;
        }
        return false;
    }
    
    
    /**
     * Actualiza un producto en la base de datos
     * @param int $idProduct identificador del producto
     * @param array $product arreglo del producto
     * @return boolean
     */
    public  function update(array $product) : bool{
        $this->db->where('id_producto', $product['id_producto']);
        if($this->db->update($this->table, $product)){
            $this->modelLog->queryUpdateLog($this->db->last_query());
            return true;
        }
        $this->modelLog->errorLog('No se puede actualizar un producto', $this->db->last_query());
        return false;
    }
    
    
    /**
     * Registra un producto en la base de datos
     * @param array $product arreglo del produto
     * @return boolean
     */
    public function create( array $product ){
        if($this->db->insert($this->table, $product)){
            $this->modelLog->queryInsrertLog($this->db->last_query());
            return true;   
        }
        return false;
    }
    
    
    /**
     * elimina un producto de la base de datos
     * @param int $idProduct identicacion AI tabla
     * @return boolean
     */
    public function delete($idProduct){
        $this->db->where('id_producto', $idProduct);
        if($this->db->delete($this->table)){
            return true;
        }
        return false;
    }
    
    /**
     * Realiza una busqueda de producto de acuerdo a un criterio
     * NOMBRE
     * COD_CONTABLE
     * Grado Alcolico
     * @param string $searchCriteria
     * @return boolean | array
     */
    public function search($searchCriteria){
        $querySearchParams = [
            'columns' => [
                'nombre',
                'cod_contable',
                'grado_alcoholico',
            ],
            'searchCriteria' => $searchCriteria,
        ];
        return ($this->myModel->searchDb($this->table, $querySearchParams));
    }
    
}