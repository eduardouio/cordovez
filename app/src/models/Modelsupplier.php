<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Selecciones y busquedas para los proveedores
 * de datos
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modelsupplier extends CI_Model {

  public function __construct(){
      parent::__construct();
  }


  /**
  * Obtiene todas las ordenes 
  * @return array | bool
  */
  public function getAll() {
    return ($this->modelbase->get_table([
                                    'table' => 'proveedor',
                                    'orderby' => [
                                        'nombre' => 'ASC',
                                    ],
                                          ]));

  }



  /**
  * Obtiene un proveedor con la informacion basica, la registrada en la tabla
  * @param (string) $supplierId
  * @return array | boolean
  */
  public function get($supplierId){
    $supplier =  $this->modelbase->get_table([
                            'table' => 'proveedor',
                            'where' => [
                                    'identificacion_proveedor' => $supplierId,
                                        ],
                                ]);

    if((gettype($supplier) == 'array') && (count($supplier) > 0)){
      return $supplier[0];
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
  public function getAllInfo( string $supplierId){
    return([
      'info' => $this->get($supplierId),
      'orders' => $this->modelorder->getBysupplier($supplierId),
      'invoces' => $this->modelinvoices->getBysupplier($supplierId),
    ]);
  }
}