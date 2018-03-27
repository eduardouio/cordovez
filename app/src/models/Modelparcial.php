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
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelbase');
        $this->load->model('modellog');
        $this->load->model('Modelinfoinvoice');
        $this->load->model('Modelorderinvoice');
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
            $this->modelLog->susessLog('Se crea un nuevo parcual abierto ' . $this->db->insert_id());
            return $this->db->insert_id();
        }
        if($this->modelLog->errorLog('No se puede insertar un parcial' , $this->db->last_query()));
        return false;
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
     * Retorna el valor que suman las facturas, el fob actual se calcula
     * FOBinical = suma valor de Facturas * tipo de cambio factura pedido
     * CurrentFOB = suma valor de parciales * tipo de cambio factura pedido
     * Con esto se mantiene la relacion de lo nacionalizado y lo declarado
     * inicialemente, el tipo de cambio de la factura informativa solo
     * se usa para la declaracion de impuestos
     * 
     * @param string $nroPedido
     * @return float
     */
    public function getNationalicedCIF(string $nroOrder): array
    {
        $fobNationalized = [
            'fob' => 0.0,
            'seguro' => 0.0,
            'felete' => 0.0,
        ];
        
        $parcials = $this->getClosedParcials($nroOrder, true);
        $typeChange = $this->modelOrderInvoice->getTypeChange($nroOrder);
        
        if( is_array($parcials) ){
            foreach ($parcials as $item => $parcial){
                $infoinvoices = $this->modelInfoInvoice->getByParcial(
                                                        $parcial['id_parcial']
                                                                    );
                foreach ($infoinvoices as $index => $invoice){
                    $fobNationalized['fob'] += (
                                        $invoice['valor'] * $typeChange 
                                        );
                    $fobNationalized['seguro'] += $invoice['seguro'];
                    $fobNationalized['flete'] += $invoice['flete'];
                }
            }
        }
        
        $this->modelLog->susessLog('FOB Nacionalizado 0 pedido: ' . $nroOrder);
        return $fobNationalized;        
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
     * Actualiza un parcial, se usa para cambiar las fechas de salida 
     * de la almacenera y fecha de fin de facturacion del ultimo parcial
     * @param array $parcial
     * @return bool
     */
    public function update(array $parcial): bool {
        
        $parcial['last_update'] = date('Y-m-d H:i:s');
        
        $parcial['fecha_salida_almacenera'] = str_replace( 
                                            '/', 
                                            '-', 
                                            $parcial['fecha_salida_almacenera']
                                                        );
        
        $parcial['fecha_salida_almacenera'] = date(
                                 'Y-m-d',
                                 strtotime($parcial['fecha_salida_almacenera'])
                                                  );
                
        $parcial['proximo_almacenaje_desde'] = date(
            'Y-m-d',
            strtotime($parcial['proximo_almacenaje_desde'] . ' +1 day')
            );
       
        $this->db->where('id_parcial', $parcial['id_parcial']);
        
        if($this->db->update($this->table, $parcial)){
            $this->modelLog->susessLog('Parcial actualizado correnctamente');
            return true;
        }
        
        $this->modelLog->errorLog(
            'No se puede actualizar el parcial',
            $this->db->last_query()
            );
        
        return false;
    }
    
    /**
     * Actualiza el status de las etiquetas en el parcial
     * @param array $parcial
     * @return bool
     */
    public function updateLabelsParcial(array $parcial):bool
    {
        $this->db->where('id_parcial', $parcial['id_parcial']);
        if ($this->db->update($this->table, $parcial)){
            $this->modelLog->susessLog('Etiquetas actualizadas en parcaial');
            return true;
        }
        
        $this->modelLog->errorLog(
            'problema al actualizar registro', 
            $this->db->last_query()
            );
        return false;
    }
    
    
    /**
     * Elimina un parcial siempre y cuando este vacio
     * @param int $idParcial
     * @return bool
     */
    public function delete(int $idParcial):bool
    {
        $this->db->where('id_parcial', $idParcial);
        if($this->db->delete($this->table)){
            return true;
        }
        $this->modelLog->warningLog(
            'No se puede eliminar el parcial', 
            $this->db->last_query()
            );
        return false;
    }
            
    
}
