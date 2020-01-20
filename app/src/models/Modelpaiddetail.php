<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo encargado de gestionar los detalles de los Documentos de Pagos
 * de datos
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modelpaiddetail extends \CI_Model
{
    private $table = 'detalle_documento_pago';
    private $modelBase;
    private $modelExpenses;
    private $modelLog;
    private $myModel;


    /**
     * constructor de la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    /**
     * Inicia los modelos de la clase
     */
    public function init()
    {
        $this->load->model('modelexpenses');
        $this->load->model('modelbase');
        $this->load->model('mymodel');
        $this->load->model('modellog');
        $this->modelExpenses = new Modelexpenses();
        $this->myModel = new Mymodel();
        $this->modelLog = new Modellog();
        $this->modelBase = new ModelBase();
    }

    /**
     * Obtiene los detalles de las facturas y sus sumas, recupera la descripcion
     * de la provision a la que representa
     * @param $nroDocument int identificador del docuemnto de pago
     * @return array | boolean
     */
    public function get($nroDocument)
    {
        $detailsInvoice['details'] = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_documento_pago' => $nroDocument,
            ],
            'orderby' => ['id_detalle_documento_pago' => 'ASC'],
        ]);
        if (gettype($detailsInvoice) == 'array' && count($detailsInvoice) > 0){
            $val = 0.0;
            foreach ($detailsInvoice['details'] as $item => $detail){
                $detail['expense'] = $this->modelExpenses->getExpense($detail['id_gastos_nacionalizacion']);
                $val += $detail['valor'];
                $detailsInvoice['details'][$item] = $detail;
            }
            $detailsInvoice['sums'] = $val;
            return $detailsInvoice;
        }
        return false;
    }

    /**
     * Obtiene un detalle de una factura de pago
     * @param int $idDetail
     * @ return array | boolean
     */
    public function  getDetail($idDetail){
        $detail = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_detalle_documento_pago' => $idDetail,
            ],
        ]);

        if(gettype($detail) == 'array' && count($detail) > 0){
            return $detail[0];
        }
        return false;
    }


    /**
     * Obtiene una justificacion en base a una provision
     * @param int $idExpense
     * @return array | false
     */
    public function getByExpense($idExpense){
        $details = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_gastos_nacionalizacion' => $idExpense,
            ],
        ]);
        if(gettype($details) == 'array' && count($details) > 0){
            $value = 0.0;
            foreach($details as $index => $detail){
                $value += $detail['valor'];
            }
            $details['sums'] = $value;
            return $details;
        }
        return false;
    }


    /**
     * Retorna las justificaciones para una orden, ya que aqui se almacenan
     * las justificaciones a las provisiones
     * @param string $nroOrder
     * @return array | boolean
     */
    public function getByOrder($nroOrder)
    {
        $query = "SELECT
                        a.*,
                        b.nro_pedido,
                        c.nro_factura,
                        c.identificacion_proveedor,
                        c.fecha_emision,
                        b.concepto
                    FROM detalle_documento_pago AS a
                    JOIN gastos_nacionalizacion AS b
                    USING(id_gastos_nacionalizacion)
                    JOIN documento_pago as c
                    USING(id_documento_pago)
                    WHERE nro_pedido =  '" . $nroOrder ."' ORDER BY b.concepto DESC";

        $paidsDetails = $this->db->query($query);
        $paidsDetails = $paidsDetails->result_array();
        if(gettype($paidsDetails) == 'array' && count($paidsDetails) > 0){
            return $paidsDetails;
        }
        return false;
    }


    /**
     * Retorna las justificaciones para un parcial
     *
     * @param string $nroOrder
     * @return array | boolean
     */
    public function getByParcial($idParcial)
    {
        $query = "  SELECT
                            a.*,
                            b.nro_pedido,
                            c.nro_factura,
                            c.identificacion_proveedor,
                            c.fecha_emision,
                            b.concepto
                    FROM detalle_documento_pago AS a
                    JOIN gastos_nacionalizacion AS b
                    USING(id_gastos_nacionalizacion)
                    JOIN documento_pago as c
                    USING(id_documento_pago)
                    WHERE id_parcial=  '" . $idParcial ."' ORDER BY b.concepto DESC";

        $paidsDetails = $this->db->query($query);
        $this->modelLog->warningLog('Se ejecuta sentencia SQL directa', $query);
        $paidsDetails = $paidsDetails->result_array();

        if(gettype($paidsDetails) == 'array' && count($paidsDetails) > 0){
            return $paidsDetails;
        }

        $this->modelLog->warningLog(
            'la sentencia directa a retornado un valor vacio',
            $query
            );
        return false;
    }


    /**
     * Crea un nuevo detalle de factura
     * @param array $paidDetail
     * @return int
     */
    public function create(array $paidDetail)
    {
        if($this->db->insert($this->table, $paidDetail)){
            $this->modelLog->queryInsrertLog($this->db->last_query());
            return $this->db->insert_id();
        }
        $this->modelLog->errorLog(
                            'No se puede registrar el detalle documento',
                            $this->db->last_query()
                            );
        return false;
    }



    /**
     * Elimina un pago detalle del sustema
     * @param int $idPaidDetail
     * @return bool
     */
    public function deletePaidDetail(int $idPaidDetail):bool
    {
        $this->db->where('id_detalle_documento_pago', $idPaidDetail);
        if($this->db->delete($this->table)){
            return True;
        }

        $this->modelLog->errorLog(
            'No se puede eliminar el documento pago',
            $this->db->last_query()
            );

       return false;
    }


    /**
     * Elimina un pago detalle del sustema
     * @param int $idPaidDetail
     * @return bool
     */
    public function deletePaidDetailFromExpense(int $id_expense):bool
    {
        $this->db->where('id_gastos_nacionalizacion', $id_expense);
        if($this->db->delete($this->table)){
            return True;
        }

        $this->modelLog->errorLog(
            'No se puede eliminar el detalle documento pago',
            $this->db->last_query()
            );

        return false;
    }



    /**
     * Actualiza del detalle de un pago
     * @param array $ipaidDetail
     * @return bool
     */
    public function updatePaidDetail(array $paidDetail) : bool
    {
        $this->db->where(
                'id_detalle_documento_pago',
                $paidDetail['id_detalle_documento_pago']
            );
        if($this->db->update($this->table, $paidDetail)){
            $this->modelLog->queryUpdateLog($this->db->last_query());
            return True;
        }
        $this->modelLog->errorLog(
            'No es posible actualizar el detalle documento pago',
            $this->db->last_query());

        return false;
    }



    /**
     * Obtiene los pagos de una provisio desde los pagos
     * @param int $id_init_expense id de gasto inicial
     * @return array | bool
     */
    public function getPaidsDetailsFromInitExpense(int $id_init_expense)
    {
        $sql = "SELECT
                ddp.id_gastos_nacionalizacion,
                ddp.valor as justificacion,
                ddp.date_create ,
                pro.nombre as proveedor,
                dp.*,
                usr.nombres
                FROM
                detalle_documento_pago AS ddp
                left join documento_pago as dp on (ddp.id_documento_pago = dp.id_documento_pago)
                left join proveedor as pro on(dp.identificacion_proveedor = pro.identificacion_proveedor)
                left join usuario as usr on(ddp.id_user = usr.id_user)
                where
                id_gastos_nacionalizacion = $id_init_expense;
                ";

        $details = $this->modelBase->runQuery($sql);

        if ($details == False){
            $this->modelLog->warningLog(
                'El gasto inicial no tiene facturas',
                $this->db->last_query()
                );
            return False;
        }

        return $details;

    }

}
