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

    /**
     * Obtiene un producto de la tabla
     * @param string $codContable
     */
    public function get(string $codContable)
    {
        $product = $this->modelbase->get_table([
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
}