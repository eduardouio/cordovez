<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Modelo encargado de migrar los pedidos a la base de datos local
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */

class ModelMigrate extends CI_Model
{
    private $modelLog;
    private $modelOrder;
    private $modelSupplier;
    private $modelProduct;
    private $modelOrderInvoice;
    private $modelOrderInvoiceDetail;
    private $table = 'migracion';
    private $child_table = 'migracion_detalle';
    private $modelBase;
    
    function __construct(){
        parent::__construct();
        $this->init();
    }
    
    
    /**
     * Inicia Clases para la migracion
     */
    private function init(){
        $models = [
            'Modellog',
            'Modelorder',
            'Modelsupplier',
            'Modelproduct',
            'ModelBase',
            'Modelorderinvoice',
            'Modelorderinvoicedetail',
        ];
        foreach ($models as $model){
            $this->load->model($model);
        }
        $this->modelLog = new Modellog();
        $this->modelOrder = new Modelorder();
        $this->modelSupplier = new Modelsupplier();
        $this->modelProduct = new Modelproduct();
        $this->modelBase = new ModelBase();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelLog->generalLog(
            'Iniciando Model Migrate'
            );
    }
    
    
    public function getAll($all_table = false):array{
        $all_migrations =[] ;
        if($all_table){
            $all_migrations = $this->modelBase->get_table([
                'table' => $this->table,
                'orderby' => [
                    'last_update' => 'DESC',
                    'date_create' => 'DESC',
                ],
                'where' => [
                    'bg_has_imported' => 1,
                    'bg_exist_in_local' => 0,
                ],
            ]);
        }else{
            $all_migrations = $this->modelBase->get_table([
                'table' => $this->table,
                'where' => [
                    'bg_has_imported' => 0,
                    'bg_exist_in_local' => 0,
                ],
            ]);
        }
        
        if($all_migrations == False){
            $this->modelLog->warningLog(
                'No esisten migraciones en la base de datos',
                $this->db->last_query()
                );
            return [];
        }
        
        $data = [];
        foreach ($all_migrations as $k => $m){
            $detail = $this->modelBase->get_table([
                'table' => $this->child_table,
                'where' => [
                    'nro_pedido' => $m['nro_pedido']
                ],
            ]);
            
            if(gettype($detail) == 'array' && count($detail) > 0) {
                $m['detail'] = $detail;
                $m['sums'] = [
                    'unities' => 0,
                    'boxes' => 0,
                    'valor' => 0.0,
                ];
                foreach ($detail as $k => $item){
                    $m['sums']['unities'] += ($item['nro_cajas'] * $item['cantidad_x_caja']);
                    $m['sums']['boxes'] += ($item['nro_cajas']);
                    $m['sums']['valor'] += ($item['costo_caja'] * $item['nro_cajas']);
                }
            }else{
                $this->modelLog->warningLog(
                    'La migracion no tiene iun detalle registrado',
                    $this->db->last_query()
                    );
                $m['detail'] = [];
                $m['sums'] = [
                    'unities' => 0,
                    'boxes' => 0,
                    'valor' => 0.0,
                ];
            }
            array_push($data, $m);
        }
        return $data;
    }
    
    
    /**
     * Importa un pedido a local
     * @param string $nro_pedido
     * @return bool
     */
    public function importOrder(string $nro_pedido):bool{
        $migration = $this->get($nro_pedido);
        $supplier = $this->modelSupplier->get($migration['identificacion_proveedor']);
        $tipo_cambio = ($supplier['moneda_transaccion'] == 'DOLARES') ? 1 : 1.25;
        
        $order = [
            'order' => [] , 
            'invoice' => [], 
            'order_items' => []
        ];
        
        $order['order'] = [
            'nro_pedido' => $migration['nro_pedido'],
            'seguro_aduana' => $migration['seguro_aduana'],
            'flete_aduana' => $migration['flete_aduana'],
            'regimen' => $migration['regimen'],
            'pais_origen' => $migration['pais_origen'],
            'ciudad_origen' => $migration['ciudad_origen'],
            'proveedor' => $supplier['nombre'],
            'incoterm' => $migration['incoterm'],
            'dias_libres' => 21,
            'gasto_origen' => ($migration['incoterm'] == 'CFR')? $migration['flete_aduana'] : 0,
            'observaciones' => $migration['observaciones_pedido'] ,
            'id_user' => $this->session->userdata('id_user'),
            'docentry' => $migration['docentry'],
        ];
                       
        $order['invoice'] = [
            'nro_pedido' => $migration['nro_pedido'],
            'identificacion_proveedor' => $migration['identificacion_proveedor'],
            'proveedor' => $migration['proveedor'],
            'id_factura_proveedor' =>  'SF-' . mb_substr($migration['proveedor'], 0,3) . (rand(100,100000)*rand(7,19) + rand(100,10000)),
            'fecha_emision' => date('Y-m-d'),
            'vencimiento_pago' => date('Y-m-d'),
            'valor' => ($migration['valor_factura'] / $tipo_cambio),
            'tipo_cambio' => $tipo_cambio,
            'moneda' => $supplier['moneda_transaccion'], 
            'id_user' => $this->session->userdata('id_user'),
        ];
        
        foreach ($migration['order_items'] as $k => $order_item){
            $product = $this->modelProduct->get($order_item['cod_contable']);
            array_push($order['order_items'], [
                'cod_contable' => $order_item['cod_contable'],
                'grado_alcoholico' => intval($product['grado_alcoholico']),
                'product' => $product['nombre'],
                'cantidad_x_caja' => intval($product['cantidad_x_caja']),
                'peso' => intval($product['peso']),
                'nro_cajas' => intval($order_item['nro_cajas']),
                'cajas_importadas' => intval($order_item['nro_cajas']),
                'capacidad_ml' => intval($order_item['capacidad_ml']),
                'costo_caja' => ($order_item['costo_caja'] / $tipo_cambio),
                'unidades' => ($order_item['nro_cajas'] * $product['cantidad_x_caja']),
                'fob' => (($order_item['nro_cajas'] * $order_item['costo_caja']) / $tipo_cambio),
                'id_user' => $this->session->userdata('id_user'),                
            ]);
        }        
        
        $order_id = $this->modelOrder->create($order['order']);
        $id_invoice = 0;
        $products = 1;
        
        if(boolval($order_id)){
            $id_invoice = $this->modelOrderInvoice->create($order['invoice']);    
        }
        
        if(boolval($id_invoice)){
            foreach ($order['order_items'] as $k => $item){
                $item['id_pedido_factura'] = $id_invoice;
                if($this->modelOrderInvoiceDetail->create($item) == False){
                    $products = 0;
                }
            }
        }
        
        if(boolval($order_id) && boolval($id_invoice) && boolval($products)){
            unset($migration['order_items']);
            $migration['bg_has_imported'] = 1;
            $migration['import_status'] = 'ok';
            $migration['last_update'] = date('Y-m-d H:m:s');
            $migration['fecha_importacion'] = date('Y-m-d H:m:s');
            $migration['bg_migrated_order_detail'] = 1;
            $migration['bg_migrated_order'] = 1;
            $migration['bg_migrated_order_invoice'] = 1;
            $migration['bg_have_order_items'] = 1;
            $migration['bg_have_invoice_items'] = 1;           
            $this->update($migration);
            return True;
        }
               
        
        $this->modelLog->errorLog(
            'La migracion no se pudo completar',
            $this->db->last_query()
            );
        return False;
    }
    
    
    
    /**
     * Recibe la data de miracion ejecuta las migraciones nuevas y notifica 
     * retorna la cantidad pe dedios nuevos encintrados
     *  
     * @param array $data
     * @return int
     */
    public function checkAndMakeMigrations(array $data):int{
        if(empty($data)) {
            $this->modelLog->generalLog(
                'La function de migracion no ha recibido datos'
                );
            return 0;
        }
        $this->deleteUnusedMigrations();
        $items_imported = 0;  
        
        foreach ($data as $k => $order_item){                  
            if($this->checkOrder($order_item)){
                $items_imported++;
            }
        }
        
        return $items_imported;
    }    
    

    private function checkOrder(array $order):bool{                  
        if($this->modelOrder->get(str_replace('/','-',$order['nro_pedido'])) != False){
            print "<br> update pedido set nro_pedido = '1" . str_replace('/','-',$order['nro_pedido']) . "' where nro_pedido = '" . str_replace('/','-',$order['nro_pedido']) . "'";
            return false;
        };
        
        $origen = explode('/', $order['ciudad_origen']);        
        
        if(count($origen) == 0){
            $origen = [ '' , ''];
        }
        
        if(count($origen) == 1){
            array_push($origen,'');
        }
        
        $supplier = $this->checkSupplier($order);
        $order_invoice = $this->chechOrderInvoice($order, $supplier);
        $new_migration = [
            'nro_pedido' => str_replace('/','-',$order['nro_pedido']),
            'import_status' => 'STANDBY',
            'seguro_aduana' => floatval($order['seguro_aduana']),
            'flete_aduana' => floatval($order['flete_aduana']),
            'pais_origen' => trim(strtoupper($origen[0])),
            'ciudad_origen' => trim(strtoupper($origen[1])),
            'moneda' => $supplier['moneda_transaccion'],
            'proveedor' => $order['nombre_proveedor'],
            'tipo_cambio' => ($supplier['moneda_transaccion'] == 'DOLARES') ? 1 : 1.25,
            'identificacion_proveedor' => $order['identificacion_proveedor'],
            'id_factura_proveedor' => $order_invoice['id_factura_proveedor'],
            'fecha_emision_factura' => $order_invoice['fecha_emision'],
            'fecha_vencimiento_factura' => $order_invoice['fecha_vencimiento_factura'],
            'valor_factura' => $order['total_pedido'],
            'observaciones_pedido' => $order['observaciones'],
            'observaciones_factura' => $order_invoice['observaciones_factura'],
            'regimen' => $this->auxiliarOrder($order),
            'incoterm' => $this->auxiliarOrder($order, True),
            'fecha_importacion' => date('Y-m-d'),
            'id_user' => $this->session->userdata('id_user'),
            'bg_have_invoice' => $order_invoice['have_invoice'],            
            'bg_have_supplier' => $supplier['have_supplier'],
            'bg_log' => json_encode($order),
            'gasto_origen' => 0,
            'docentry' => intval($order['doc_entry']),            
            ];                
        
        if($this->create($new_migration)){           
            if($order['order_items']){
                foreach ($order['order_items'] as $k => $product){
                    if($this->checkProducts($product, $supplier)){
                        $this->createMigrationDetail([
                            'nro_pedido' => $new_migration['nro_pedido'],
                            'cod_contable' => $product['cod_contable'],
                            'identificacion_proveedor' => $new_migration['identificacion_proveedor'],
                            'cod_ice' => $product['cod_ice'],
                            'nombre' => $product['producto'],
                            'nro_cajas' => intval($product['nro_cajas']),
                            'capacidad_ml' => intval($product['capacidad_ml']),
                            'cantidad_x_caja' => intval($product['cantidad_x_caja']),
                            'grado_alcoholico' => floatval($product['grado_alcoholico']),
                            'costo_caja' => floatval($product['costo_caja']),
                            'id_user' => $this->session->userdata('id_user'), 
                        ]);   
                    }else{
                        $this->modelLog->errorLog(
                            'No se puede crear el producto', 
                            $this->db->last_query()
                            );
                    }
                }               
                return True;
            }
        }
        $this->modelLog->errorLog(
            'El pedido no pudo ser creado'
            );
        
        return False;      
    }
    
    /**
     * Elimina todas las migraciones sin usar del siustema
     */
    private function deleteUnusedMigrations(){
        $this->db->where('import_status', 'STANDBY');
        $this->db->delete($this->table);
    }
    
    
    /**
     * Regitra una migracion en la base de datos
     * @param array $migration
     */
    private function create(array $migration){
        if($this->db->insert($this->table, $migration)){
            return True;
        }else{
            $this->modelLog->errorLog(
                'No se puede registrar la migracion',
                $this->db->last_query()
                );
            return False;
        }
        return False;
    }
    
    
    /**
     * Obtiene una migracion completa
     * @param string $nro_pedido
     * @return array
     */
    private function get(string $nro_pedido):array{
        $this->db->where('nro_pedido', $nro_pedido);
        $result= $this->db->get($this->table);
        $order = $result->result_array();
        $order = $order[0];
        
        $this->db->where('nro_pedido', $nro_pedido);
        $result = $result= $this->db->get($this->child_table);
        $order['order_items'] = $result->result_array();        
        return $order;
    }
    
    /**
     * Registra el detalle de la migracion
     */
    private function createMigrationDetail(array $migration_detail){
        if($this->db->insert('migracion_detalle', $migration_detail)){
            return True;
        }else{
            $this->modelLog->errorLog(
                'No se puede registrar la migracion',
                $this->db->last_query()
                );
            return False;
        }
        return False;
    }
    
    
    /**
     * Actualiza una migracion en el sistema
     * @param array $migration
     * @return bool
     */
    private function update(array $migration):bool{
        $this->db->where('nro_pedido', $migration['nro_pedido']);
        unset($migration['nro_pedido']);
        if($this->db->update($this->table, $migration)){
            return True;
        }
        return False;
    }
    
    
    /**
     * Comprueba que el proveedor exista si no existe lo crea
     * @param array $order
     * @return bool
     */
    private function checkSupplier(array $order):array{
        $local_supplier = $this->modelSupplier->get($order['identificacion_proveedor']);        
        if(boolval($local_supplier)){    
            $local_supplier['have_supplier'] = 1;
            return $local_supplier;
        }
        $new_supplier = [
            'identificacion_proveedor' => $order['identificacion_proveedor'],
            'tipo' => 'INTERNACIONAL',
            'nombre' => $order['nombre_proveedor'],
            'id_user' => $this->session->userdata('id_user'),
        ];
        
        $created_supplier = $this->modelSupplier->create($new_supplier);
        
        if($created_supplier == False){
            return [
                'nombre' => 'NO EXISTE',
                'tipo_provedor' => 'NO ESISTE',
                'moneda_transaccion' => '',
                'categoria' => '',
                'moneda_transaccion' => 'DOLARES',
                'identificacion_proveedor' => '',
                'comentarios' => 'NO EXISTE',
                'have_supplier' => 0,
            ];
        }
        $created_supplier['have_supplier'] = 1;
        return $created_supplier;
    }
        
    private function chechOrderInvoice(array $order, array $supplier):array{       
        if(isset($order['invoice']) || count($order['invoice']) == 0){
          return [
              'id_factura_proveedor' => '',
              'fecha_emision' => date('Y-m-d'),
              'fecha_vencimiento_factura' => date('Y-m-d'),
              'observaciones_factura' => 'Sin Factura',
              'have_invoice' => 0
          ];
        }
        return [
            'id_factura_proveedor' => $order['invoice']['id_factura_proveedor'],
            'fecha_emision_factura' => $order['invoice']['fecha_emision'],
            'fecha_vencimiento_factura' => $order['invoice']['vencimiento_pago'],
            'observaciones_factura' => $order['invoice']['observaciones'],
            'have_invoice' => 1,
        ];        
    }
        
    
    /**
     * Comprueba si existen los productos en la base de datos
     * @param array $product
     * @return bool
     */
    private function checkProducts(array $product, $supplier): bool{
        $local_product =  $this->modelProduct->get($product['cod_contable']);
        if($local_product != False){
            return True;
        }
        if($this->modelProduct->create([
            'cod_contable' => $product['cod_contable'],
            'identificacion_proveedor' => $supplier['identificacion_proveedor'],
            'cod_ice' => $product['cod_ice'],
            'nombre' => $product['producto'],
            'capacidad_ml' => intval($product['capacidad_ml']),
            'cantidad_x_caja' => intval($product['cantidad_x_caja']),
            'grado_alcoholico' => floatval($product['grado_alcoholico']),
            'costo_caja' => floatval($product['costo_caja']),
            'id_user' => $this->session->userdata('id_user'),
        ])){
            return True;
        }
        return False;
    }
    
   
    /**
     * Retorna el regimen o el incoterm del pedido
     * 
     * @param array $order
     * @param bool $incoterm False = Regimen " true Regimen
     * @return string
     */
    private function auxiliarOrder(array $order, bool $incoterm = False){
        if($incoterm){
            if(preg_match('/EX/', strtoupper($order['incoterm']) )){
                return 'EXW';
            }
            return strtoupper($order['incoterm']);
        }
        
        if(preg_match('/ALMAGRO/', strtoupper($order['observaciones']))){
            return '70';
        }
        
        return '10';
    }
    
}

