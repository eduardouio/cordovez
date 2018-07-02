<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * genera el reporte base de la lista de todas los pagos en la base
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class ModelReportPagos extends CI_Model
{
    private $modelBase;
    
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
    
    
    /***
     * retorna los pagos por pedido
     * 
     * @param string $nro_pedido
     * @return array
     */
    public function getByOrder(string $nro_pedido) : array
    {
        $paids = [];
        $sql = "SELECT 
            dp.nro_factura as 'Nro Factura',
            dp.fecha_emision as 'Fecha Emision',
            pro.nombre as 'Proveedor',
            pro.identificacion_proveedor as 'RUC Proveedor',
            pro.categoria as 'Categoría Proveedor',
            dp.valor as 'Valor Factura',
            dp.bg_closed as 'Justifica Priovisión',
            gn.concepto as 'Concepto',
            gn.tipo as 'Tipo Provision',
            gn.fecha as 'Fecha Provisión',
            gn.nro_pedido as 'Nro Pedido',
            gn.id_parcial as 'ID Parcial' ,
            gn.valor_provisionado as 'Valor Provisionado',
            pr.nro_pedido as 'Nro Pedido Parcial',
            gn.bg_closed AS 'Provision Cerrada',
            usr.nombres as 'Usuario'
            FROM
            detalle_documento_pago AS dtp
            LEFT JOIN documento_pago as dp USING(id_documento_pago)
            LEFT JOIN usuario AS usr ON(dp.id_user = usr.id_user)
            LEFT JOIN gastos_nacionalizacion AS gn ON(dtp.id_gastos_nacionalizacion = gn.id_gastos_nacionalizacion)
            LEFT JOIN parcial AS pr ON (gn.id_parcial = pr.id_parcial)
            LEFT JOIN proveedor AS pro ON(dp.identificacion_proveedor = pro.identificacion_proveedor)
            WHERE gn.nro_pedido = '{{nro_order}}' or pr.nro_pedido = '{{nro_order}}'
            ORDER BY 
            gn.nro_pedido DESC,
            pr.nro_pedido DESC,
            gn.id_parcial ASC,
            gn.concepto ASC
            ;";
                
        $result = $this->modelBase->runQuery(str_replace(
            '{{nro_order}}', $nro_pedido, $sql)
            );
        
        if ($result != False){
            $paids = $result;
        }
        
        return $paids;
    }
    
    
    /***
     * Retorna los pagos por proveedor
     * 
     * @param string $identificacion_proveedor
     * @return array
     */
    public function getBySupplierRuc(string $identificacion_proveedor): array
    {
        $paids = [];
        $sql = "
                SELECT 
                dp.nro_factura as 'Nro Factura',
                dp.fecha_emision as 'Fecha Emision',
                pro.nombre as 'Proveedor',
                pro.identificacion_proveedor as 'RUC Proveedor',
                pro.categoria as 'Categoría Proveedor',
                dp.valor as 'Valor Factura',
                dp.bg_closed as 'Justifica Priovisión',
                gn.concepto as 'Concepto',
                gn.tipo as 'Tipo Provision',
                gn.fecha as 'Fecha Provisión',
                gn.nro_pedido as 'Nro Pedido',
                gn.id_parcial as 'ID Parcial' ,
                gn.valor_provisionado as 'Valor Provisionado',
                pr.nro_pedido as 'Nro Pedido Parcial',
                gn.bg_closed AS 'Provision Cerrada',
                usr.nombres as 'Usuario'
                FROM
                detalle_documento_pago AS dtp
                LEFT JOIN documento_pago as dp USING(id_documento_pago)
                LEFT JOIN usuario AS usr ON(dp.id_user = usr.id_user)
                LEFT JOIN gastos_nacionalizacion AS gn ON(dtp.id_gastos_nacionalizacion = gn.id_gastos_nacionalizacion)
                LEFT JOIN parcial AS pr ON (gn.id_parcial = pr.id_parcial)
                LEFT JOIN proveedor AS pro ON(dp.identificacion_proveedor = pro.identificacion_proveedor)
                WHERE 
                pro.identificacion_proveedor = '{{identificacion_proveedor}}' 
                ORDER BY 
                gn.nro_pedido DESC,
                pr.nro_pedido DESC,
                gn.id_parcial ASC,
                gn.concepto ASC
                ;
                ";
        
        $result = $this->modelBase->runQuery(
            str_replace(
                        '{{identificacion_proveedor}}', 
                        $identificacion_proveedor, 
                        $sql
                )
            );
        
        if ($result){
            $paids = $result;
        }
        
        return $result;
    }
    
    
    /**
     * Obtiene los pagos por el nombre de un proveedor
     * @param string $name
     * @return array
     */
    public function getBySupplierName(string $name): array
    {
        $paids = [];
        
        $sql = "
                SELECT 
                dp.nro_factura as 'Nro Factura',
                dp.fecha_emision as 'Fecha Emision',
                pro.nombre as 'Proveedor',
                pro.identificacion_proveedor as 'RUC Proveedor',
                pro.categoria as 'Categoría Proveedor',
                dp.valor as 'Valor Factura',
                dp.bg_closed as 'Justifica Priovisión',
                gn.concepto as 'Concepto',
                gn.tipo as 'Tipo Provision',
                gn.fecha as 'Fecha Provisión',
                gn.nro_pedido as 'Nro Pedido',
                gn.id_parcial as 'ID Parcial' ,
                gn.valor_provisionado as 'Valor Provisionado',
                pr.nro_pedido as 'Nro Pedido Parcial',
                gn.bg_closed AS 'Provision Cerrada',
                usr.nombres as 'Usuario'
                FROM
                detalle_documento_pago AS dtp
                LEFT JOIN documento_pago as dp USING(id_documento_pago)
                LEFT JOIN usuario AS usr ON(dp.id_user = usr.id_user)
                LEFT JOIN gastos_nacionalizacion AS gn ON(dtp.id_gastos_nacionalizacion = gn.id_gastos_nacionalizacion)
                LEFT JOIN parcial AS pr ON (gn.id_parcial = pr.id_parcial)
                LEFT JOIN proveedor AS pro ON(dp.identificacion_proveedor = pro.identificacion_proveedor)
                WHERE 
                pro.nombre LIKE '{{name}}%' 
                or pro.nombre LIKE '%{{name}}' 
                or pro.nombre Like '%{{name}}%' 
                or pro.nombre = '{{name}}'
                ORDER BY 
                gn.nro_pedido DESC,
                pr.nro_pedido DESC,
                gn.id_parcial ASC,
                gn.concepto ASC
                ;
                ";
        
        $result = $this->modelBase->runQuery(str_replace('{{name}}', $name, $sql));      
        
        if ($result){
            $paids = $result;
        }
        
        return $paids;
    }
    
    
    /***
     * Obtiene el detalle de pagos para un rango de fechas
     * 
     * @param string $start
     * @param string $end
     */
    public function getByDateRange(string $start, string $end)
    {
        $paids = [];
        $sql = "
                SELECT 
                dp.nro_factura as 'Nro Factura',
                dp.fecha_emision as 'Fecha Emision',
                pro.nombre as 'Proveedor',
                pro.identificacion_proveedor as 'RUC Proveedor',
                pro.categoria as 'Categoría Proveedor',
                dp.valor as 'Valor Factura',
                dp.bg_closed as 'Justifica Priovisión',
                gn.concepto as 'Concepto',
                gn.tipo as 'Tipo Provision',
                gn.fecha as 'Fecha Provisión',
                gn.nro_pedido as 'Nro Pedido',
                gn.id_parcial as 'ID Parcial' ,
                gn.valor_provisionado as 'Valor Provisionado',
                pr.nro_pedido as 'Nro Pedido Parcial',
                gn.bg_closed AS 'Provision Cerrada',
                usr.nombres as 'Usuario'
                FROM
                detalle_documento_pago AS dtp
                LEFT JOIN documento_pago as dp USING(id_documento_pago)
                LEFT JOIN usuario AS usr ON(dp.id_user = usr.id_user)
                LEFT JOIN gastos_nacionalizacion AS gn ON(dtp.id_gastos_nacionalizacion = gn.id_gastos_nacionalizacion)
                LEFT JOIN parcial AS pr ON (gn.id_parcial = pr.id_parcial)
                LEFT JOIN proveedor AS pro ON(dp.identificacion_proveedor = pro.identificacion_proveedor)
                WHERE 
                dp.fecha_emision >= '{{start}}' 
                and 
                dp.fecha_emision <= '{{end}}'
                ORDER BY 
                gn.nro_pedido DESC,
                pr.nro_pedido DESC,
                gn.id_parcial ASC,
                gn.concepto ASC
                ;
                ";
        $sql = str_replace('{{start}}', $start, $sql);
        $result = $this->modelBase->runQuery(
            str_replace('{{end}}', $end, $sql)
            );
        
        if ($result) {
            $paids = $result;
        }
        
        return $paids;
    }

}