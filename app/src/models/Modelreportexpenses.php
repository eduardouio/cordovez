<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Modelo encargado de gestionar los Documentos de Pagos
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
class Modelreportexpenses extends CI_Model
{
    private $modelBase;
    private $modelLog;
    private $modelOrder;
    private $modelParcial;
    private $order;

    /**
     * Costructor de la clase
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('ModelBase');
        $this->load->model('Modellog');
        $this->load->model('Modelorder');
        $this->load->model('Modelparcial');
        $this->modelOrder = new Modelorder();
        $this->modelParcial = new Modelparcial();
        $this->modelLog = new Modellog();
        $this->modelBase = new ModelBase();
    }

    /**
     * Retorna los gastos iniciales de un pedido, o de un parcial
     *
     * @param string $nro_order
     * @param int $id_parcial
     * @return array
     */
    public function getExpenses(string $nro_order, int $id_parcial = 0): array
    {
        $this->order = $this->modelOrder->get($nro_order);

        $order_expenses = [];
        $sql = "SELECT
            concepto,
            id_gastos_nacionalizacion,
            fecha,
            fecha_fin,
            nro_pedido,
            id_parcial,
            tipo,
            valor_provisionado,
            bg_closed
            FROM gastos_nacionalizacion";

        if ($id_parcial == 0) {
            $sql .= " WHERE nro_pedido = '$nro_order'";
        } else {
            $sql .= " WHERE id_parcial = '$id_parcial' ";
        }
        $sql .= ' ORDER BY fecha ASC';
        $result = $this->modelBase->runQuery($sql);

        $warenhose_expenses = [];
        $expenses = [];

        foreach ($result as $k => $exp) {
            if (preg_match('/[a-zA-Z]-[0-9]/', $exp['concepto'])) {
                array_push($warenhose_expenses, $exp);
            } else {
                array_push($expenses, $exp);
            }
        }

        asort($expenses, 0);

        $all_expenses = array_merge($expenses, $warenhose_expenses);

        if ($result) {
            foreach ($all_expenses as $idx => $exp) {
                array_push($order_expenses, $this->getPaidsDetail($exp));
            }
        }

        return $order_expenses;
    }

    /**
     * Retorna los tributos de un parcial o un pedido
     *
     * @param string $nro_order
     * @param int $id_parcial
     *
     * @return array Tributos
     */
    public function getTributes(string $nro_order, int $id_parcial = 0): array
    {
        $tributes = [
            'nro_liquidacion' => '',
            'fecha_pago' => '',
            'cif' => 0.0,
            'fodinfa' => 0.0,
            'arancel_advalorem' => 0.0,
            'arancel_especifico' => 0.0,
            'ice_advalorem' => 0.0,
            'ice_especifico' => 0.0,
            'iva' => 0.0,
            'total' => 0.0
        ];

        if ($id_parcial > 0) {
            $parcial = $this->modelParcial->get($id_parcial);
            $tributes['fecha_pago'] = $parcial['fecha_liquidacion'];
            $tributes['nro_liquidacion'] = $parcial['nro_liquidacion'];
            $tributes['fodinfa'] = $parcial['fodinfa'];
            $tributes['arancel_advalorem'] = $parcial['arancel_advalorem_pagar_pagado'];
            $tributes['arancel_especifico'] = $parcial['arancel_especifico_pagar_pagado'];
            $tributes['ice_advalorem'] = $parcial['ice_advalorem_pagado'];
            $tributes['ice_especifico'] = $parcial['ice_especifico_pagado'];
            $tributes['iva'] = $parcial['iva_pagado'];
        } elseif ($id_parcial == 0) {
            $pedido = $this->modelOrder->get($nro_order);

            $tributes['fecha_pago'] = $pedido['fecha_liquidacion'];
            $tributes['nro_liquidacion'] = $pedido['nro_liquidacion'];
            $tributes['fodinfa'] = $pedido['fodinfa_pagado'];
            $tributes['arancel_advalorem'] = $pedido['arancel_advalorem_pagar_pagado'];
            $tributes['arancel_especifico'] = $pedido['arancel_especifico_pagar_pagado'];
            $tributes['ice_advalorem'] = $pedido['ice_advalorem_pagado'];
            $tributes['ice_especifico'] = $pedido['ice_especifico_pagado'];
            $tributes['iva'] = $pedido['iva_pagado'];
        }

        $tributes['total'] = ($tributes['cif'] + $tributes['fodinfa'] + $tributes['arancel_advalorem'] + $tributes['arancel_especifico'] + $tributes['ice_advalorem'] + $tributes['ice_especifico'] + $tributes['iva']);

        return $tributes;
    }

    /**
     * Retorna los detalles de un pago
     *
     * @param array $id_init_expense
     * @return array
     */
    private function getPaidsDetail(array $init_expense): array
    {
        if (preg_match('/[a-zA-Z]-[0-9]/', $init_expense['concepto'])) {
            $start = substr($init_expense['fecha'], 5);
            $end = substr($init_expense['fecha_fin'], 5);

            $start = str_replace('-', '/', $start);
            $end = str_replace('-', '/', $end);

            $init_expense['concepto'] .= ' [' . $start . ' - ' . $end . ']';
        }

        $init_expense['num_invoices'] = [];
        $init_expense['fecha_emision'] = [];
        $init_expense['supplier'] = [];
        $init_expense['sums'] = 0.0;
        $init_expense['saldo'] = 0.0;

        $query = "SELECT
                    ddp.id_documento_pago,
                    dp.nro_factura,
                    CONCAT(SUBSTRING(pro.nombre, 1 , 12), '...') as nombre,
                    dp.fecha_emision,
                    ddp.id_gastos_nacionalizacion,
                    ddp.valor,
                    ddp.bg_isnotprovisioned
                    FROM
                    detalle_documento_pago as ddp
                    LEFT JOIN documento_pago as dp ON(ddp.id_documento_pago = dp.id_documento_pago)
                    LEFT JOIN proveedor as pro ON(pro.identificacion_proveedor = dp.identificacion_proveedor)
                    WHERE 
                    ddp.id_gastos_nacionalizacion = {{id_gasto_nacionalizacion}}
                    ";
              
        if($this->order['incoterm'] == 'CFR' && $init_expense['concepto'] == 'FLETE'){
            $query = "
                        SELECT
                        	pf.id_pedido_factura,
                        	pf.id_factura_proveedor as nro_factura,
                        	CONCAT(SUBSTRING(pro.nombre, 1 , 12), '...') as nombre,
                        	pf.fecha_emision,
                        	gn.id_gastos_nacionalizacion,
                            gn.nro_pedido,
                        	gn.valor_provisionado as valor
                        	FROM
                        	gastos_nacionalizacion as gn
                        	LEFT JOIN pedido_factura as pf ON(gn.nro_pedido = pf.nro_pedido)
                        	LEFT JOIN proveedor as pro ON(pro.identificacion_proveedor = pf.identificacion_proveedor)
                        	WHERE 
                        	gn.id_gastos_nacionalizacion = {{id_gasto_nacionalizacion}};
                        ";
        }
        
        
        $sql = str_replace('{{id_gasto_nacionalizacion}}', $init_expense['id_gastos_nacionalizacion'], $query);

        $detail_paid = $this->modelBase->runQuery($sql);

        if ($detail_paid) {
            foreach ($detail_paid as $idx => $dt_paid) {
                $init_expense['sums'] += $dt_paid['valor'];
                array_push($init_expense['fecha_emision'], $dt_paid['fecha_emision']);

                array_push($init_expense['num_invoices'], $dt_paid['nro_factura']);
                array_push($init_expense['supplier'], $dt_paid['nombre']);
            }
        }

        $init_expense['saldo'] = ($init_expense['valor_provisionado'] - $init_expense['sums']);

        return $init_expense;
    }
}
