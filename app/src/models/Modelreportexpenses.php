<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo encargado de gestionar los Documentos de Pagos
 * de datos
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modelreportexpenses extends CI_Model
{
    private $modelBase;   

    /**
     * Costructor de la clase
     */
    function __construct(){
        parent::__construct();
        $this->load->model('ModelBase');
        $this->modelBase = new ModelBase();
    }
    
    
    /**
     * Retorna los gastos iniciales de un pedido 
     * 
     * @param string $nro_order
     * @return array
     */
    public function getInitiExpenses(string $nro_order):array
    {
        $order_expenses = [];
        
        $sql = "SELECT 
            id_gastos_nacionalizacion, 
            concepto, 
            nro_pedido, 
            id_parcial, 
            tipo, 
            valor_provisionado, 
            bg_closed
            FROM gastos_nacionalizacion 
            WHERE nro_pedido = '$nro_order'
            ";
        #AND concepto != 'ISD'
        
        $result = $this->modelBase->runQuery($sql);
        
        if($result){
            foreach ($result as $idx => $exp){
                array_push(
                    $order_expenses,
                    $this->getPaidsDetail($exp)
                    );
            }
        }
      
        return $order_expenses;
    }
    
    
    
    /**
     * Retorna los gastos de un parcial 
     * 
     * @param int $id_parcial
     * @return array
     */
    public function getParcialExpenses(int $id_parcial):array
    {
       return [];
    }
    
    
    /**
     * retorna los gastos de nacionalizacion de un periodo
     * @param string $date_start
     * @param string $data_end
     * 
     * @return array lista de pagos de la fecha
     */
    public function getDateRangeExpenses(string $date_start, string $data_end):array{
        
    }
    
    /**
     * Retorna los detalles de un pago
     * 
     * @param array $id_init_expense
     * @return array
     */
    private function getPaidsDetail(array $init_expense): array{
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
                    AND ;
                    ";
        
        $query = str_replace(
                    '{{id_gasto_nacionalizacion}}', 
                    $init_expense['id_gastos_nacionalizacion'] , 
                    $query
                    );
        
        $detail_paid = $this->modelBase->runQuery($query);
        
        if($detail_paid){
            foreach ($detail_paid as $idx => $dt_paid){
                $init_expense['sums'] += $dt_paid['valor'];
                array_push(
                            $init_expense['fecha_emision'], 
                            $dt_paid['fecha_emision']
                    );
                
                array_push(
                            $init_expense['num_invoices'], 
                            $dt_paid['nro_factura']
                    );
                array_push($init_expense['supplier'], $dt_paid['nombre']);
            }
        }
        
        $init_expense['saldo'] = (
                $init_expense['valor_provisionado'] 
                - $init_expense['sums']
            );
        
        return $init_expense;
    }
}