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
      $sql = " SELECT 
                gn.id_gastos_nacionalizacion,
                pro.nombre,
                dp.nro_factura,
                dp.fecha_emision,
                dp.valor,
                gn.concepto,
                gn.bg_closed,
                gn.valor_provisionado,
                ddp.valor
            FROM gastos_nacionalizacion AS gn 
            LEFT JOIN detalle_documento_pago AS ddp ON (gn.id_gastos_nacionalizacion = ddp.id_gastos_nacionalizacion)
            LEFT JOIN documento_pago as dp ON(ddp.id_documento_pago = dp.id_documento_pago)
            LEFT JOIN proveedor as pro ON (pro.identificacion_proveedor = dp.identificacion_proveedor)
            WHERE nro_pedido = '$nro_order' 
            AND gn.tipo = 'INICIAL'
            ORDER BY gn.concepto;
          ";  
      $result = $this->modelBase->runQuery($sql);
      
      return $result;
    }
    
    
    
    /**
     * Retorna los gastos de un parcial 
     * 
     * @param int $id_parcial
     * @return array
     */
    public function getParcialExpenses(int $id_parcial):array
    {
        
    }
}

