<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Genera un reporte de todos los almacenaje parciales y del pedido
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class ModelReportWarenhouses extends CI_Model
{
    private $modelBase;
    
    /**
     * constructor de clase
     */
    function __construct(){
        parent::__construct();
        $this->init();
    }
    
    /**
     * Carga los modelos base para trabajar en la clase
     */
    private function init(){
        $this->load->model('ModelBase');
        $this->modelBase = new ModelBase();
    }
    
    
    /**
     * Obtiene los almacenajes para un pedido
     * 
     * @param string $nro_pedido
     */
    public function getWarenhouses(string $nro_pedido)
    {
     $warenhouses = [];
     $sql = "
            SELECT 
            gn.id_gastos_nacionalizacion,
            pr.nro_pedido,
            gn.id_parcial,
            gn.identificacion_proveedor,
            dp.fecha_emision,
            dp.nro_factura,
            dp.valor as 'valor_factura',
            dtp.valor,
            dtp.id_documento_pago,
            pro.nombre,
            gn.concepto,
            gn.id_user,
            gn.date_create,
            gn.valor_provisionado,
            gn.fecha,
            gn.fecha_fin,
            gn.bg_closed,
            usr.nombres
            from gastos_nacionalizacion as gn
            LEFT JOIN proveedor as pro on (gn.identificacion_proveedor = pro.identificacion_proveedor)
            LEFT JOIN detalle_documento_pago as dtp on(gn.id_gastos_nacionalizacion = dtp.id_gastos_nacionalizacion)
            LEFT JOIN documento_pago as dp on (dtp.id_documento_pago = dp.id_documento_pago)
            LEFT JOIN parcial as pr on (gn.id_parcial = pr.id_parcial)
            LEFT JOIN usuario as usr on (gn.id_user = usr.id_user)
            WHERE gn.concepto LIKE 'DEPOSITO %'
            and 
            pr.nro_pedido = '{{nro_order}}'
            ORDER BY
            pr.nro_pedido DESC,
            pr.id_parcial ASC,
            gn.concepto DESC
            ;
                        ";
     $result = $this->modelBase->runQuery(
         str_replace('{{nro_order}}', $nro_pedido, $sql)
         );
     
     if ($result){
      $warenhouses = $result;   
     }
     
     return $warenhouses;
    }
    
    /**
     * Obtiene los almacenajes en un rango de fechas 
     * 
     * @param string $start
     * @param string $end
     */
    public function getWarenhousesByDateRange(string $start, string $end)
    {
        $warenhouses = [];
        
        $sql = "
                SELECT 
                gn.id_gastos_nacionalizacion,
                pr.nro_pedido,
                gn.id_parcial,
                gn.identificacion_proveedor,
                dp.fecha_emision,
                dp.nro_factura,
                dp.valor as 'valor_factura',
                dtp.valor,
                dtp.id_documento_pago,
                pro.nombre,
                gn.concepto,
                gn.id_user,
                gn.date_create,
                gn.valor_provisionado,
                gn.fecha,
                gn.fecha_fin,
                gn.bg_closed,
                usr.nombres
                from gastos_nacionalizacion as gn
                LEFT JOIN proveedor as pro on (gn.identificacion_proveedor = pro.identificacion_proveedor)
                LEFT JOIN detalle_documento_pago as dtp on(gn.id_gastos_nacionalizacion = dtp.id_gastos_nacionalizacion)
                LEFT JOIN documento_pago as dp on (dtp.id_documento_pago = dp.id_documento_pago)
                LEFT JOIN parcial as pr on (gn.id_parcial = pr.id_parcial)
                LEFT JOIN usuario as usr on (gn.id_user = usr.id_user)
                WHERE gn.concepto LIKE 'DEPOSITO %'
                and
                ( gn.fecha >= '{{start}}' and gn.fecha <= '{{end}}' )
                ORDER BY
                pr.nro_pedido DESC,
                pr.id_parcial ASC,
                gn.concepto DESC
                ;
            ";
        
        $sql = str_replace('{{strat}}', $start, $sql);
        
        $result = $this->modelBase->runQuery(
            str_replace('{{end}}', $end, $sql)
            );
        
        if ($result){
            $warenhouses = $result;
        }
        
        return $warenhouses;
    }
    
}

