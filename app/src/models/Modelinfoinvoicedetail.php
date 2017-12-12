<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * modelo que gestiona los detalles de las facturas informativas
 * @package    modelLayer
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modelinfoinvoicedetail extends \CI_Model
{
    private $table = 'factura_informativa_detalle';
    private $modelBase;
    private $modelProduct;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelbase');
        $this->load->model('modelproduct');
        $this->modelBase = new ModelBase();
        $this->modelProduct = new Modelproduct();        
    }
    
    /**
     * Obtiene el registro del detalle de un item de una factura informativa
     * @param int $idInfoInvDetail identificador Detalle
     * @return array | boolean
     */
    public function get($idInfoInvDetail)
    {
        $detail = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_factura_informativa_detalle' => $idInfoInvDetail,
            ],
        ]);
        
        if ((gettype($detail) == 'array') && (count($detail) > 0 )){
            return $detail[0];
        }
        return false;
    }
}

