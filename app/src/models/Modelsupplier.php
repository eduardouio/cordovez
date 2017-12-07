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
        $this->modelBase = new ModelBase();
        $this->modelOrder = new Modelorder();
    }

    /**
     * Obtiene todas las ordenes
     * 
     * @return array | bool
     */
    public function getAll()
    {
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
     * @param (string) $supplierId
     * @return array | boolean
     */
    public function get($idSupplier)
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
        return false;
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
        ]);
        if ((gettype($suppliers) == 'array') && (count($suppliers) > 0)){
            return $suppliers;
        }
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
        return ([
            'info' => $this->get($supplierId),
            'orders' => $this->modelOrder->getBysupplier($supplierId),
            'invoces' => 'implementar',
        ]);
    }
}