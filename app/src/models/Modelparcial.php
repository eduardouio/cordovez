<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Modulo de manejar los parciales de los pedidos
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource var $controller => Nombre del la tabla de la BD
 *             var $listPerPage => Nro de registros por pagina
 *             var $seguroVal => Valor por el que se multiplica FOB + FLETE
 *             var $template => ubicacion de la plantilla
 *
 */

class Modelparcial extends CI_Model
{
    private $table = 'parcial';
    private $modelBase;
    private $modelLog;
    private $modelOrderInvoice;
    private $modelInfoInvoice;
    private $modelProduct;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelbase');
        $this->load->model('modellog');
        $this->load->model('Modelinfoinvoice');
        $this->load->model('Modelorderinvoice');
        $this->load->model('Modelproduct');
        $this->modelProduct = new Modelproduct();
        $this->modelBase = new ModelBase();
        $this->modelLog = new Modellog();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelOrderInvoice = new Modelorderinvoice();
    }
    
    
    /**
     * Retorna el registro de un parcial
     * @param int $idParcial
     * @return array | boolean
     */
    public function get(int $idParcial)
    {
        $parcial = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'id_parcial' => $idParcial,
            ],
        ]);
        
        if( (is_array($parcial)) && (!empty($parcial)) )
        {        
            return $parcial[0];
        }
        
        $this->modelLog->warningLog(
                                        'El parcial no existe', 
                                        $this->db->last_query()
                                    );
        return false;
    }
    
    /**
     * Verifica que un pedido tenga un parcial cerrado
     * @param array $nro_order
     * @return bool
     */
    public function orderHaveCloseParcial(string $nro_order):bool{
        $parcials = $this->getByOrder($nro_order);
        
        if ($parcials == False){
            return False;
        }
        
        foreach ($parcials as $k => $parc){
            if($parc['bg_isclosed'] == 1){
                return True;
            }
        }
        
        return False;
    }
    
    
    /**
     * Obtiene la lista de parciales para un numero de pedido
     * @param string $nroOrder
     * @return array | boolean
     */
    public function getByOrder(string $nroOrder)
    {
        $parcials = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder,
            ],
        ]);
        
        if( is_array($parcials) && count($parcials) > 0){
            return $parcials;
        }
        return false;
    }
    
    
    /**
     * Registra un parcial abierto en la base de datos 
     * @param array $parcial arreglo con informacion del parcial
     * @return int | boolean
     */
    public function create(array $parcial)
    {
               
        if($this->db->insert($this->table, $parcial)){
            $this->modelLog->queryInsrertLog($this->db->last_query());
            return $this->db->insert_id();
        }
        if($this->modelLog->errorLog(
                'No se puede insertar un parcial' , 
                $this->db->last_query())
            );
        return false;
    }
    
    
    /**
     * Actualiza la informacion de un parcial
     * 
     * @param array $parcial
     * @return bool
     */
    public function update(array $parcial):bool
    {
        
        $this->db->where('id_parcial', $parcial['id_parcial']);
        unset($parcial['id_parcial']);
        if($this->db->update($this->table, $parcial)){
            return True;
        }
        $this->modelLog->errorLog(
            'Ni fue posible actualizar el parcial',
            $this->db->last_query()
            );
        return False;
    }
    
    /**
     * Retorna el ultimo parcial de un pedido, 
     * se usa para saber la fecha de salida del ultimo parical,
     * si no existe un parcial se toma la fecha de entrada a la almacenera
     * @param string $nroOrder identificador del parical
     * @return array | boolean
     */
    public function getLastParcial(string $nroOrder)
    {
        $lastParcias = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder,
            ],
            'orderby' => [
                'proximo_almacenaje_desde' => 'DESC'
            ],
        ]);
        
        if(is_array($lastParcias) && count($lastParcias) > 1){
            $this->modelLog->warningLog(
                                'Revisar que el primero sea el ultimo parcial', 
                                $this->db->last_query());
            return $lastParcias[1];
        }
        return false;        
    }
    
    
    /**
     * Obtiene la lista de los parciales cerrados para un pedido
     * 
     * @param int $idParcial
     * @param $all boolean true-> retorna todos 
     * @return array | boolean
     */
    public function getClosedParcials(string $nroOrder, bool $all = false)
    {
        $limit = ($all) ? 1 : 1000;
        
        $oldParcial = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [ 
                'nro_pedido' => $nroOrder,
                'bg_isclosed' => '1',
            ],
            'orderby' => [
                'decha' => 'DESC',
            ],
            'limit' => $limit,
        ]);
        
        $this->modelLog->warningLog('Consulta a los parciales de un pedido', 
                                     $this->db->last_query()
                                    );
        
        if(is_array($oldParcial) && count($oldParcial) > 0){
            return $oldParcial;
        }
        
        return false;
    }
    
    
    /**
     * Obtiene el detalle de las facturas y lo cruza contra el valor total de
     * la factura
     * @param (string) $idInvoiceOrder
     * @return array | false
     */
    public function getInvoices($id_parcial)
    {
        $invoices = $this->modelBase->get_table([
            'table' => 'factura_informativa',
            'where' => [
                'id_parcial' => $id_parcial
            ]
        ]);
        
        if (empty($invoices)) {
            $this->modelLog->warningLog(
                'El el parcial Solicitado no tiene Facturas registradas'
                );
            return false;
        }
        
        $result = [];
        foreach ($invoices as $key => $value) {
            $value['detailInvoice'] = $this->getInvoiceDetail($value);
            $value['valor'] =  floatval($value['valor']);
            $result[$key] = $value;
        }
        
        $this->modelLog->susessLog(
            'Se recuperan todas las facturas del pedido'
            );
        return $result;
    }
    
    /**
     * Busca los detalles de la factura y la suma de las mimsas
     * @param array $invoice objeto factura completo
     * @return array | bool
     */
    public function getInvoiceDetail($invoice)
    {
        $detailInvoice = $this->modelBase->get_table([
            'table' => 'factura_informativa_detalle',
            'where' => [
                'id_factura_informativa' => $invoice['id_factura_informativa'],
            ],
        ]);
        
        if (empty($detailInvoice)) {
            return false;
        }
        
        $result = [];
        (float)$valueItem = 0.00;
        $countBoxesProduct = 0.00;
        $unities = 0;
        
        foreach ($detailInvoice as $key => $value) {
            $detail_order_invoice =  $this->modelBase->get_table([
                'table' => 'detalle_pedido_factura',
                'where' => [
                    'detalle_pedido_factura' => $value['detalle_pedido_factura'],
                ],                
            ]);
            
            $detail_order_invoice = $detail_order_invoice[0];            
            $valueItem += floatval($detail_order_invoice['costo_caja']) *
            floatval($value['nro_cajas']);
            
            $product = $this->modelProduct->get($detail_order_invoice['cod_contable']);
            
            $countBoxesProduct += floatval($value['nro_cajas']);
            $unities += ($value['nro_cajas'] * $product['cantidad_x_caja']);
            $value['nombre'] = $product['nombre'];
            $value['cantidad_x_caja'] = $product['cantidad_x_caja'];
            $value['unidades'] = (intval($value['cantidad_x_caja']) *
                intval($value['nro_cajas']));
            $value['costo_unidad'] = (floatval($detail_order_invoice['costo_caja']) /
                floatval($value['cantidad_x_caja']));
            $value['total_item'] = (floatval($detail_order_invoice['costo_caja']) *
                floatval($value['nro_cajas']));
            $value['peso'] = $product['peso'];
            $result[$key] = $value;
        }
        
        $result['sums'] = [
            'valueItems' =>  floatval(str_replace(',','',number_format($valueItem,2))),
            'money' => $invoice['moneda'],
            'tasa_change' => $invoice['tipo_cambio'],
            'countBoxesProduct' => $countBoxesProduct,
            'unities' => $unities,
        ];
        return $result;
    }
    
    
    
    /**
     * Onbtiene
     *
     * @param string $nroOrder
     * @return array | false
     */
    public function getOrdinalsNumbersParcials($nroOrder){
        
        $ordinalsInities = [
            0 => '', 1 => 'primero', 2 => 'segundo', 3 => 'tercero',
            4 => 'cuarto', 5 => 'quito', 6 => 'sexto',
            7 => 'séptimo', 8 => 'octavo', 9 => 'noveno',
        ];
        
        $ordinalTens = [
            10 => 'Décimo', 20 => 'Veigésimo', 30 =>'Trigésimo',
            40 => 'Cuadragésimo', 50 => 'Quincuagésimo', 60 => 'Sexagésimo',
        ];
        
        $parcials = $this->getAllParcials($nroOrder);
        
        if(is_array($parcials)){
            $ordinal = 1;
            foreach ($parcials as $item => $parcial){
                if($ordinal < 10){
                    $parcial['ordinalNumber'] = $ordinalsInities[$ordinal];
                }else{
                    $decena = floor($parcial/10);
                    $unity = ($ordinal - $decena);
                    
                    $parcial['ordinalNumber'] = $ordinalTens[$decena] .
                    $ordinalsInities[$unity];
                }
                
                $ordinal++;
                $parcials[$item] = $parcial;
            }
            return $parcials;
        }
        
        return false;
        
    }
    
    /**
     * Retorna todos los parciales de un pedido, no toma en cuenta
     * el bg_isclosed
     *
     * @param string $nroOrder
     * @return array | boolean
     */
    public function getAllParcials(string $nroOrder)
    {
        $parcials = $this->modelBase->get_table([
            'table' => $this->table,
            'where' => [
                'nro_pedido' => $nroOrder,
            ],
            'orderby' => ['id_parcial' => 'ASC']
        ]);
        
        if(is_array($parcials) && count($parcials) > 0){
            return $parcials;
        }
        
        return false;
    }
    
    
    
    /**
     * Retorna el numero de orden a partir del id de un parcial
     * @param int $idParcial identificacion del parcial
     * @return string nro del parcial
     */
    public function getNroOrderByParcial(int $idParcial) : string
    {
        $parcial = $this->get($idParcial);
        
        if($parcial == false){
            $this->modelLog->errorLog(
                'El parcial que busca no existe',
                $this->db->last_query()
                );
            return false;
        }
        
        return ($parcial['nro_pedido']);
    }
       

    
    /**
     * Elimina un parcial vacio de la base de datos
     * @param array $parcial
     * @return bool 
     */
    public function delete(array $parcial):bool
    {
        $this->db->where('id_parcial', $parcial['id_parcial']);
        if ($this->db->delete($this->table)){
            $this->modelLog->susessLog('Parcial Eliminado correctamente');
            return True;
        }
        
        $this->modelLog->errorLog(
            'No se pudo eliminar un parcial',
            $this->db->last_query()
            );
        return False;
    }
    
    
    /**
     * Comprueba si un pedido esta cerrado
     *
     * @param int $id_parcial
     */
    public function idClosed(int $id_parcial): bool{
         $parcial = $this->get($nro_pedido);
        
        if($parcial){
            return boolval($parcial['bg_isclosed']);
        }
        
        return False;
    }
    
    
    
    /**
     * Obtiene una lista de pedidos que han llegado a la bodega
     * dentro de un mes solo R10
     *
     * @param int $year
     * @param int $month
     */
    public function getArrivedCellarByDate(int $year, int $month) : array{
        
        $f_inicio = $year . '-' . $month . '-01';
        $f_fin = $year . '-' . $month . '-31';
        
        if($month < 10){
            $f_inicio = $year . '-0' . $month . '-01';
            $f_fin = $year . '-0' . $month . '-31';
        }
        
        $query = "  SELECT p.*, pd.pais_origen
                    FROM parcial as p
                    LEFT JOIN pedido as pd on (p.nro_pedido = pd.nro_pedido)
                    WHERE p.fecha_llegada_cliente >= '$f_inicio'
                    AND p.fecha_llegada_cliente <= '$f_fin'
                 ";
        $result = $this->modelBase->runQuery($query);
        
        if($result){
            $this->modelLog->susessLog(
                'Parciales con fecha de llegada bodega oficina listados'
                );            
            return  $result;
        }
        
        $this->modelLog->warningLog(
            'No existen parciales con fecha de llegada oficina para lisar'
            );
        
        return [];
    }
    
    
    
    /**
     * Obtiene el almacenaje del primer parcial
     * @param int $id_parcial
     */
    public function getFirstParcial(string $nro_order){
        $sql = "
                SELECT *
                FROM parcial
                WHERE  nro_pedido = '$nro_order'
                ORDER BY id_parcial ASC
                LIMIT 10
                ";
        
        $result  = $this->modelBase->runQuery($sql);
        
        if($result){
            return  $result[0];
        }
        
        return False;
    }
    
    /**
     * Cierra un pedido en el sistema
     *
     * @param int $id_parcial
     * @return bool
     */
    public function close(int $id_parcial): bool{
        $parcial = $this->get($nro_pedido);
        if($parcial){
            $parcial['bg_isclosed'] = 1;
            return $this->update($parcial);
        }
        
        return False;
        }
}