<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * genera el reporte base de la lista de todas las provisiones en la base
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */

class ModelReportProvisiones extends CI_Model{ 
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
    
    
    /**
     * Obtiene el informe para un pedido
     * 
     * @param string $nro_order
     */
    public function getbyOrder(string $nro_order)
    {
        $proviciones = [];
        
        $sql = "
          SELECT 
            gn.id_gastos_nacionalizacion AS 'Id Gasto',
            gn.nro_pedido AS 'Nro Pedido',
            par.nro_pedido AS 'Nro Pedido Parcial',
            gn.id_parcial AS 'ID Parcial',
            gn.identificacion_proveedor AS 'RUC Proveedor',
            pr.nombre AS 'Nombre Proveedor',
            dp.fecha_emision AS 'Fecha Emision',
            dp.valor AS 'Valor Factura',
            dtp.valor AS 'Valor Justificación',
            dp.nro_factura AS  'Nro Factura',
            gn.concepto AS 'Concepto',
            gn.tipo AS 'Tipo',
            gn.valor_provisionado AS 'Valor Provisionado',
            gn.fecha AS 'Fecha Provisión',
            gn.bg_closed AS 'Gasto Justificado',
            usr.nombres AS 'Nombre Usuario',
            gn.comentarios AS 'Comentarios Provisión'
            FROM
            gastos_nacionalizacion AS gn
            LEFT JOIN parcial as par ON (gn.id_parcial = par.id_parcial)
            LEFT JOIN detalle_documento_pago as dtp on (dtp.id_gastos_nacionalizacion = gn.id_gastos_nacionalizacion)
            LEFT JOIN documento_pago AS dp on (dtp.id_documento_pago = dp.id_documento_pago)
            LEFT JOIN proveedor AS pr ON (dp.identificacion_proveedor = pr.identificacion_proveedor)
            LEFT JOIN usuario as usr ON (gn.id_user = usr.id_user)
            WHERE gn.nro_pedido = '{{nro_orden}}' or par.nro_pedido = '{{nro_orden}}'  
            ORDER BY
            gn.nro_pedido DESC,
            gn.tipo DESC,
            gn.concepto ASC;
            ";
        
        $result = $this->modelBase->runQuery(
                                str_replace('{{nro_orden}}', $nro_order, $sql)
            );
        if($result){
            $proviciones = $result;
        }
        return $proviciones;
    }
    
    
    
    /**
     * Obtiene las provisiones por fecha de proviciobamientox
     * @param string $start
     * @param string $end
     */
    public function getByDateRage(string $start, string $end){
        $proviciones = [];
        
        $sql = "
             SELECT 
            gn.id_gastos_nacionalizacion AS 'Id Gasto',
            gn.nro_pedido AS 'Nro Pedido',
            par.nro_pedido AS 'Nro Pedido Parcial',
            gn.id_parcial AS 'ID Parcial',
            gn.identificacion_proveedor AS 'RUC Proveedor',
            pr.nombre AS 'Nombre Proveedor',
            dp.fecha_emision AS 'Fecha Emision',
            dp.valor AS 'Valor Factura',
            dtp.valor AS 'Valor Justificación',
            dp.nro_factura AS  'Nro Factura',
            gn.concepto AS 'Concepto',
            gn.tipo AS 'Tipo',
            gn.valor_provisionado AS 'Valor Provisionado',
            gn.fecha AS 'Fecha Provisión',
            gn.bg_closed AS 'Gasto Justificado',
            usr.nombres AS 'Nombre Usuario',
            gn.comentarios AS 'Comentarios Provisión'
            FROM
            gastos_nacionalizacion AS gn
            LEFT JOIN parcial as par ON (gn.id_parcial = par.id_parcial)
            LEFT JOIN detalle_documento_pago as dtp on (dtp.id_gastos_nacionalizacion = gn.id_gastos_nacionalizacion)
            LEFT JOIN documento_pago AS dp on (dtp.id_documento_pago = dp.id_documento_pago)
            LEFT JOIN proveedor AS pr ON (dp.identificacion_proveedor = pr.identificacion_proveedor)
            LEFT JOIN usuario as usr ON (gn.id_user = usr.id_user)
            WHERE gn.fecha >= '{{start}}' AND gn.fecha <= '{{end}}'  
            ORDER BY
            gn.nro_pedido DESC,
            gn.tipo DESC,
            gn.concepto ASC;
                ";
        
        $query = str_replace('{{start}}', $start,$sql);
        $query = str_replace('{{end}}', $end, $query);
        
        $result = $this->modelBase->runQuery($query);
        
        if($result){
            $proviciones = $result;
        }
        
        return $proviciones;
    }   
    
}

