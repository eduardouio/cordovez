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
    private $modelOrderInvoice;
    private $modelLog;
    private $modelOrder;
    
    
    
    /**
     * Constructor de la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    
    /**
     * carga los modelos y librerias necesarias para la
     * clase
     */
    private function init()
    {
        $this->load->model('modelbase');
        $this->load->model('modelsupplier');
        $this->load->model('modelproduct');
        $this->load->model('modelorderinvoice');
        $this->load->model('modellog');
        $this->load->model('Modelorder');
        $this->modelBase = new ModelBase();
        $this->modelSupplier = new Modelsupplier();
        $this->modelproducto = new Modelproduct();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelLog = new Modellog();
        $this->modelOrder = new Modelorder();
        
    }
    
    
    /**
     * Obtiene el listado de facturas informativas de un pedido en regimen 70
     * @param (string) $nroOrder
     * @return array | boolean
     */
    public function getByParcial($idParcial)
    {
        $invoices = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_parcial' => $idParcial
            ],
            'orderby' => [
                'fecha_emision' => 'DESC',
            ],
        ]);
        
        if((gettype($invoices) == 'array') && (count($invoices) > 0)){
            return $invoices;
        }
        $this->modelLog->warningLog(
                                    'Parcial Sin facturas informativas', 
                                    $this->db->last_query()
                                 );
        return false;
    }
    
    
    
    /**
     * Obtiene todas los parciales cerradas del pedido
     * @param string $nroOrder
     * @return array | bool
     */
    public  function getClosedByPartial(int $idParcial)
    {
        $closedParcials = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'bg_isclosed' => 1,
            ],
        ]);
        if((is_array($closedParcials)) && (count($closedParcials) > 0)){
            return $closedParcials;
        }
        return false;
    }
    
    /**
     * Obtiene el registro de una factura informativa
     * @param int $idFacInformativemodel
     * @return array | boolean
     */
    public function get($idFacInformative){
        $infoInvoice = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_factura_informativa' => $idFacInformative,
            ],
        ]);
        
        if((gettype($infoInvoice) == 'array') && (count($infoInvoice) > 0)){
            return $infoInvoice[0];
        }
        
        return false;
    }
    
    
    /**
     * Eliminar una factura infotmativa de la base de datos si no puede retorna false
     * @param integer $idFactInformative identificador de regitro
     * @return boolean
     */
    public function delete($idFactInformative){
        $this->db->where('id_factura_informativa', $idFactInformative);
        if($this->db->delete($this->table)){
            return true;
        }else{
            $this->modelLog->errorLog('Modelinfoinvoice,delete,No se puede eliminar');
            return false;
        }
    }
    
    /**
     * crea una factura informativa en la base de datos
     * @param array $infoiInvoice informacion factura informativa
     * @return boolean | int last_insert
     */
    public function create(array $infoInvoice){
        if($this->db->insert($this->table, $infoInvoice)){
            $this->modelLog->queryInsrertLog($this->db->last_query());
            return $this->db->insert_id();
        }
        $this->modelLog->errorLog('Modelinfoinvoice,create,No se puede crear', $this->db->last_query());
        return false;
    }
    
    
    /**
     * Actualiza el registro de una
     * @param array $infoInvoice
     * @return bool
     */
    public function update(array $infoInvoice):bool{
        $this->db->where('id_factura_informativa', $infoInvoice['id_factura_informativa']);
        if($this->db->update($this->table, $infoInvoice)){
            $this->modelLog->queryUpdateLog($this->db->last_query());
            return true;
        }
        $this->modelLog->errorLog(
                        'No es posible actualizar la factura informativa',
                        $this->db->last_query()
                        );
        return false;
    }
    
    
    /**
     * Actualiza el tipo_cambio en todas las facturas del parcial
     * @param array $paramsUpdate => [tipo_cambio, id_parcial]
     * @return bool
     */
    public function updateMoney($paramsUpdate):bool
    {
        $this->db->where('id_parcial', $paramsUpdate['id_parcial']);
        if($this->db->update($this->table, $paramsUpdate)){
            $this->modelLog->susessLog('Se actualiza el registro!');
            return true;
        }
        $this->modelLog->errorLog(
            'No se puede actualizar las facturas informativas',
            $this->db->last_query()
            );
        return false;
    }
    
    
    /**
     * Obtiene la cantidad de parciales para un pedido
     * @param string $nroOrder nro de pedido
     * @return int numero de parciales
     */
    public function getPartials(string $nroOrder):int
    {
        $result = $this->modelBase->get_table([
            'select' => ['SUM(*) as parciales'],
            'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder,
            ],
        ]);
        if( gettype($result) == 'array' && count($result) > 0 ){
            return ($infoInvoice[0]['parciales']);
        }
        return 0;
    }
    
    
    
    /**
     * Verifica si un registro ya existe en la base de datos
     * @param array $informativeInvoice
     * @return int cero si no existe
     */
    public function existRow(array $informativeInvoice):int
    {
        $infoInvoice = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'nro_factura_informativa' => $informativeInvoice['nro_factura_informativa'],
                'id_parcial' => $informativeInvoice['id_parcial'],
            ],
        ]);
        if( gettype($infoInvoice) == 'array' && count($infoInvoice) > 0 ){
            return ($infoInvoice[0]['id_factura_informativa']);
        }
        return 0;
    }
    
}