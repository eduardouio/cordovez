<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modulo base para las consultas en el sistema Mysql
 * Valida las consultas referentes a las facturas informativas
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modelinfoinvoice extends CI_Model
{
    private $table = 'factura_informativa';
    private $modelBase;
    private $modelSupplier;
    private $modelproducto;
 

    /**
     * Constructor de la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelbase');
        $this->load->model('modelsupplier');
        $this->load->model('modelproduct');
        
        $this->modelBase = new ModelBase();
        $this->modelSupplier = new Modelsupplier();
        $this->modelproducto = new Modelproduct();
    }


    /**
     * Obtiene el listado de facturas informativas de un pedido en regimen 70
     * @param (string) $nroOrder
     * @return array | boolean
     */
    public function get($nroOrder)
    {
        $invoices = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder
            ]
        ]);

        if((gettype($invoices) == 'array') && (count($invoices) > 0)){
            $result = [];

            foreach ($invoices as $key => $value) {
                $value['supplier'] = $this->modelSupplier->get(
                                            $value['identificacion_proveedor']);
                $value['detailInvoice'] = $this->getInvoiceDetail($value);
                $result[$key] = $value;
            }
            return $result;
        }
        return false;
    }


    /**
     * Obtiene el detalle de una factura informativa
     * @param $invoice factura informativa
     * @return array | boolean
     */
    public function getInvoiceDetail($invoice)
    {
        $detailInvoice = $this->modelBase->get_table([
            'table' => 'factura_informativa_detalle',
            'where' => [
                'id_factura_informativa' => $invoice['id_factura_informativa'],
            ],
        ]);
        if (empty($detailInvoice) || $detailInvoice == false) {
            return false;
        }

        $result = [];
        $valueItem = 0.00;
        $countBoxesProduct = 0.00;

        foreach ($detailInvoice as $key => $value) {
            $valueItem += floatval($value['costo_caja']) *
                floatval($value['nro_cajas']);

            $countBoxesProduct += floatval($value['nro_cajas']);
            $product = $this->modelproduct->get($valu['cod_contable']);

            $value['nombre'] = $product['nombre'];
            $value['cantidad_x_caja'] = $product['cantidad_x_caja'];

            $value['unidades'] = (intval($value['cantidad_x_caja']) *
                intval($value['nro_cajas']));

            $value['costo_unidad'] = (floatval($value['costo_caja']) /
                floatval($value['cantidad_x_caja']));

            $value['total_item'] = (floatval($value['costo_caja']) *
                floatval($value['nro_cajas']));
            $result[$key] = $value;
        }

        $result['sums'] = [
            'valueItems' => $valueItem,
            'money' => $invoice['moneda'],
            'tasa_change' => $invoice['tipo_cambio'],
            'countBoxesProduct' => $countBoxesProduct,
        ];
        return $result;
    }
}