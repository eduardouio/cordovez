<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Modelo encargado de tomar los datos de los pedidos
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class ModelImportSAP extends CI_Model{
    private $path_api_sap = '/var/www/html/sap/home.py';
    private $table = 'migracion';
    private $child_table = 'migracion_detalle';
    private $tipo_cambio_trimestral = 1.25;
    private $modelLog;
    private $modelBase;
    private $modelSupplier;
    private $modelProduct;
    private $modelDeleteOrder;
    private $modelOrder;
    private $modelOrderInvoice;
    private $modelOrderInvoiceDetail;    
    private $year;
    private $enterprise;
    
    
    /**
     * Constructo de clase
     * @param string $enterprise [cordovez|imnac|vid|]
     * @param int $year
     */
	function __construct(){
		parent::__construct();		
		$this->init();
	}
	
	/**
	 * Inicia los modelos y clases para el conector
	 */
	private function init(){
	    $models = [
	        'Modellog',
	        'ModelBase',
	        'Modelsupplier',
	        'Modelproduct',
	        'Modelorder',
	        'Modelorderinvoice',
	        'Modelorderinvoicedetail',
	        'Modeldeleteallorder',
	    ];
	    
	    foreach ($models as $model){
	        $this->load->model($model);
	    }
	    $this->modelDeleteOrder = new Modeldeleteallorder();
	    $this->modelLog = new Modellog();
	    $this->modelBase = new ModelBase();
	    $this->modelSupplier = new Modelsupplier();
	    $this->modelProduct = new Modelproduct();
	    $this->modelOrder = new Modelorder();
	    $this->modelOrderInvoice = new Modelorderinvoice();
	    $this->modelOrderInvoiceDetail = new Modelorderinvoicedetail();
	    $this->modelLog->generalLog('Inicio de Clase de migracion');
	}
	
	
	/**
	 * Obtiene una lista completa de los pedidos desde SAP
	 * @param  int    $year anio de los pedidos
	 * @return array lista de pedidos del año
	 */
	public function getOrdersSAP(string $enterprise, int $year){
	    $this->enterprise = $enterprise;
	    $this->year = $year;
        $data = (
            json_decode(
                file_get_contents("/var/www/html/cordovezapp/app/src/test/mocks/data_sap.json"),
                #file_get_contents("http://192.168.0.198:8000/$this->enterprise/$this->year/"),
                True
                )  
            );
        if($data){
            foreach ($data['data'] as $k => $migration){
                $this->create($migration);
            }
        } 
	}
	
	
	/**
	 * Obtiene todas las migraciones activas del sistema
	 * @return array
	 */
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
	 * registra una migracion 
	 * @param array $order
	 */
	private function create(array $migration) : bool{    
	    $formatted_migration = $this->formattMigration($migration);
	    
	    if($formatted_migration['nro_pedido'] == null || $formatted_migration['nro_pedido'] == ''){
	        $this->modelLog->errorLog(
	            'El pedido no tiene numero, no se puede migrar'
	        );
	       return False;
	    }	       
	    
	    $this->checkOrderParamsSupplierAndProducts($formatted_migration);
	    $detail_migration = $formatted_migration['detalle_pedido'];
	    unset($formatted_migration['detalle_pedido']);	 	    
	    $local_migration = $this->get($formatted_migration['nro_pedido']);
	    
	    #registramos la migracion
	    if($local_migration == False && $formatted_migration['bg_exist_in_local'] == False){        
	        if($this->db->insert($this->table, $formatted_migration)){
	            foreach ($detail_migration as $k => $det){
	                $det['nro_pedido'] = $formatted_migration['nro_pedido']; 
	                if($this->db->insert($this->child_table, $det)){
	                 $this->modelLog->susessLog('Detalle de Pedido migrado');   
	                }else{
	                    $this->modelLog->errorLog(
	                        'Error al migrar producto', 
	                        $this->db->last_query()
	                        );
	                }
	            }
	            
	            $this->modelLog->susessLog(
	                'Migracion ingresada correctamente'
	                );
	        }
	        
	        return True;
	    }
	   
	    #actualizamos la migracion
	    if(boolval($local_migration['bg_has_imported']) == False){
	        #borramos el detalle de pedido
	        $this->db->where('nro_pedido', $local_migration['nro_pedido']);
	        if($this->db->delete($this->child_table)){
	            $this->modelLog->susessLog(
	                'Detalle de pedido eliminado'
	                );
	        }else{
	            $this->modelLog->errorLog(
	                'No se puede Eliminar el detalle', 
	                $this->db->last_query()
	                );
	        }	        
	        #borramos el pedido
	        $this->db->where('nro_pedido', $local_migration['nro_pedido']);
	        if($this->db->delete($this->table)){
	            $this->modelLog->susessLog(
	                'Pedido migracion eliminado'
	                );
	        }else{
	            $this->modelLog->errorLog(
	                'No se puede Eliminar el pedido migracion',
	                $this->db->last_query()
	                );
	        }
	        	        
	        if($this->db->insert($this->table, $formatted_migration)){
	            foreach ($detail_migration as $k => $det){
	                $det['nro_pedido'] = $formatted_migration['nro_pedido'];
	                if($this->db->insert($this->child_table, $det)){
	                    $this->modelLog->susessLog('Detalle de Pedido migrado');
	                }else{
	                    $this->modelLog->errorLog(
	                        'Error al migrar producto',
	                        $this->db->last_query()
	                        );
	                }
	            }
	            
	            $this->modelLog->susessLog(
	                'Migracion ingresada correctamente'
	                );
    	         return true;
	        }
	        
	    }
	    
	    $this->modelLog->errorLog(
	        'Problemas para migrar el pedido', 
	        $this->db->last_query()
	        );
	    
	    return false;
	}
	
	
	/**
	 * Obtiene una migracion de la base de datos
	 * @param $nro_order string del pedido si no existe retoran Falso
	 */
	public function get(string $nro_order){
	    $result = $this->modelBase->get_table([
	        'table' => $this->table,
	        'where' => [
	            'nro_pedido' => $nro_order
	        ],
	    ]);
	    
	    if($result == False){
    	    return False;
	    }
	    
	    $migration = $result[0];
	    
	    $migration['detail'] = $this->modelBase->get_table([
	        'table' => $this->child_table,
	        'where' => [
	            'nro_pedido' => $migration['nro_pedido']
	        ],
	    ]);
	    
	    return $migration;
	}
	
	
	/**
	 * Realiza una migracion de un pedido;
	 * @param string $nro_order
	 * @return bool
	 */
	public function migrate(string $nro_order):bool{
	    $this->modelLog->generalLog(
	        'Inicio de migracion pedido ' . $nro_order
	        );
	    
	    $db_keys_tables = [
	        'pedido' => $nro_order,
	        'pedido_factura' => '',	        
	    ];
	    
	    $migration = $this->get($nro_order);
	    if(boolval($migration['bg_has_imported']) == True){
	        $this->modelLog->warningLog(
	            'El pedido no se puede importar ya fue importado'
	            );
	        return false;
	    }
	    	    
	    $order = [	        
	        'nro_pedido' => $migration['nro_pedido'],
	        'regimen' => $migration['regimen'],
	        'flete_aduana' => $migration['flete_aduana'],
	        'seguro_aduana' => $migration['seguro_aduana'],
	        'otros' => 0,
	        'gasto_origen' => 0,
	        'incoterm' => $migration['incoterm'],
	        'pais_origen' => $migration['pais_origen'],
	        'ciudad_origen' => $migration['ciudad_origen'],
	        'dias_libres' => 21,
	        'comentarios' => $migration['observaciones_pedido'],
	        'observaciones' => $migration['observaciones_pedido'],
	        'id_user' => $this->session->userdata('id_user'),
	    ];
	    
	    if($this->modelOrder->create($order)){
	        $migration['bg_migrated_order'] = True;
	    }
	    	    
	    if($migration['bg_have_invoice'] || $migration['bg_have_order_items']){
	        
	        
	        
	        $invoice = [
	            'nro_pedido' => $migration['nro_pedido'],
	            'id_factura_proveedor' => 'SF-' . (rand(100,100000)*rand(7,19) + rand(100,10000)),
	            'identificacion_proveedor' => $migration['identificacion_proveedor'],
	            'fecha_emision' => null,
	            'valor' => 0.00,
	            'moneda' => 'DOLARES',
	            'tipo_cambio' => 1,
	            'vencimiento_pago' => null,
	            'gasto_origen' => 0.00,
	            'id_user' => $this->session->userdata('id_user'),
	        ];
	        
	        #si la factura existe tomamos los datos de la factura del proveedor
	        if($migration['bg_have_invoice']){
	            $invoice = [
	                'id_factura_proveedor' => $migration['id_factura_proveedor'],
	                'identificacion_proveedor' => $migration['identificacion_proveedor_factura'],
	                'fecha_emision' => $migration['fecha_emision_factura'],
	                'valor' => $migration['valor_factura'],
	                'moneda' => $migration['moneda'],
	                'tipo_cambio' => $migration['tipo_cambio'],
	                'vencimiento_pago' => $migration['fecha_vencimiento_factura'],
	                'gasto_origen' => 0.00,
	                'id_user' => $this->session->userdata('id_user'),
	            ];
    	        $migration['bg_migrated_order_invoice'] = True;
	        }
	        
	        if($migration['bg_migrated_order_invoice'] == False && $migration['bg_have_order_items']){
	            $migration['bg_migrated_order'] = True;
	        }
	        
	        $db_keys_tables['pedido_factura'] = $this->modelOrderInvoice->create($invoice);
	    }	    	    
	    
	    #registrar los detalles de la factura
	    if($migration['bg_have_invoice_items']){     
	        foreach ($migration['detail'] as $k => $det){
	            $this->modelOrderInvoiceDetail->create([
	                                               'id_pedido_factura' => $db_keys_tables['pedido_factura'], 
	                                               'cod_contable' => $det['cod_contable'],
                        	                       'grado_alcoholico' => $det['grado_alcoholico'],
                        	                       'nro_cajas' => $det['nro_cajas'],
                        	                       'costo_caja'=> $det['costo_caja'],
                        	                       'id_user' => $this->session->userdata('id_user'),
                                                ]);	        
	        }
	        
	        $migration['bg_migrated_order_invoice_detail'] = True;
	    }else{
	        foreach ($migration['detail'] as $k => $det){
	        $this->modelOrderInvoiceDetail->create([
        	            'id_pedido_factura' => $db_keys_tables['pedido_factura'],
        	            'cod_contable' => $det['cod_contable'],
        	            'grado_alcoholico' => $det['grado_alcoholico'],
        	            'nro_cajas' => $det['nro_cajas'],
        	            'costo_caja'=> $det['costo_caja'],
        	            'id_user' => $this->session->userdata('id_user'),
	        ]);
	        
	        $migration['bg_migrated_order_detail'] = True;
	        
    	    }
	    }
	    	    
	    
	    if( $migration['bg_migrated_order_invoice_detail'] 
	        && $migration['bg_migrated_order_invoice'] 
	        && $migration['bg_migrated_order']){
	        $migration['bg_has_imported'] = True;
	        $migration['import_status'] = 'OK';
	        $this->update($migration);
	        return True;
	    }
        
	    $migration['bg_has_imported'] = True;
	    $migration['import_status'] = 'INCOMPLETO';
	    $this->update($migration);
	    return False;
	    
	}
	
	/**
	 * Actualiza las cabeceras de una migracion
	 * @param array $migration
	 */
	public function update(array $migration){
	   unset($migration['detail']);
	   $migration['last_update'] = date('Y-m-d h-m-s');
	   $this->db->where('nro_pedido', $migration['nro_pedido']);
	   unset($migration['nro_pedido']);
	   
	   if($this->db->update($this->table, $migration)){
	       $this->modelLog->susessLog(
	           'Migracion actualizada correctanente, luego de la importacion'
	           );
	       return true;
	   }
	   
	   $this->modelLog->errorLog(
	       'No se puede actualizar la migracion',
	       $this->db->last_query()
	       );
	   
	   return False;
	}
	

	/**
	 * Comprueba que los producto y los proveedores existan si no existen
	 * los crea para que la migracion no falle
	 * 
	 * @param array $formated_migration
	 */
	private function checkOrderParamsSupplierAndProducts($formated_migration){
	    if(gettype($formated_migration) != 'array'){
	        return False;
	    }
	    
	    if($formated_migration['bg_supplier_exist_in_local'] == False){
	        $this->modelSupplier->create([
	            'nombre' => $formated_migration['proveedor'],
	            'tipo_provedor' => 'INTERNACIONAL',
	            'categoria' => 'LICORES',
	            'identificacion_proveedor'=> $formated_migration['identificacion_proveedor'],
	            'id_user' => $this->session->userdata('id_user'),
	        ]);
	    }
	    
	    foreach ($formated_migration['detalle_pedido'] as $k => $product){
	        if($product['bg_product_exist_in_local'] == False){
	            $this->modelProduct->create([
	                'identificacion_proveedor' => $formated_migration['identificacion_proveedor'],
	                'cod_contable' => $product['cod_contable'],
	                'cod_ice' => $product['cod_ice'],
	                'nombre' => $product['nombre'],
	                'capacidad_ml' => $product['capacidad_ml'],
	                'cantidad_x_caja' => $product['cantidad_x_caja'],
	                'grado_alcoholico' => floatval($product['grado_alcoholico']),
	                'nro_cajas' => intval($product['nro_cajas']),
	                'costo_caja' => $product['costo_caja'],
	                'estado' => 1,
	                'custodia_doble' => 0,
	                'id_user' => $this->session->userdata('id_user'),
	                'pais_origen' => $formated_migration['pais_origen'],
	                'peso' => 0,
	            ]);
	        }
	    }
	}
	
	
	/**
	 * Da formato al pedido, coloca cada columna para insertar
	 * @param array $migration
	 * @return array
	 */
	private function formattMigration(array $migration){
	      
	    $supplier = $this->checkSupplier($migration['supplier']);
	    $invoice = $this->checkInvoice($migration['invoice']);
	    $invoice_items = $this->cehckInvoiceItems($migration['invoice_detail']);
	    $order_items = $this->cehckInvoiceItems($migration['order_items']);
	    	    
	    $formatted_migration = [
	        'nro_pedido' => '',
	        'import_status' => 'STANDBY',
	        'seguro_aduana' => floatval($migration['seguro_aduana']),
	        'flete_aduana' => floatval($migration['flete_aduana']),
	        'pais_origen' => $this->getOrigin($migration['ciudad_origen'], 'country'),
	        'ciudad_origen' => $this->getOrigin($migration['ciudad_origen'], 'port'),
	        'moneda' => $this->checkSupplierCurrency($migration['supplier'],'money'),
	        'tipo_cambio' => $this->checkSupplierCurrency($migration['supplier'],'type_change'),
	        'proveedor' => '',
	        'identificacion_proveedor' => '',
	        'id_factura_proveedor' => '',
	        'identificacion_proveedor_factura' => '',
	        'fecha_emision_factura' => '',
	        'fecha_vencimiento_factura' => '',
	        'valor_factura' => '',
	        'observaciones_pedido' => '',
	        'observaciones_proveedor' => '',
	        'observaciones_factura' => '',
	        'regimen' => $this->getRegimenOrder($migration),
	        'incoterm' => $this->getIncoterm(strtoupper($migration['incoterm'])),
	        'date_create' => $migration['date_create'],
	        'id_user' => $this->session->userdata('id_user'),
	        'bg_have_invoice' => False,
	        'bg_have_order_items' => $this->cehckInvoiceItems($migration['order_items'], True),
	        'bg_have_supplier' => False,
	        'bg_have_invoice_items' => False,
	        'bg_exist_in_local' => False,
	        'bg_supplier_exist_in_local' => False,
	        'bg_log' => json_encode($migration),
	        'detalle_pedido' => [],
	    ]; 
	    
	    $nro_order = $this->checkNroOrder(str_replace('/','-', trim($migration['nro_pedido'])));
	    
	    if($nro_order == False){
	        $this->modelLog->errorLog(
	            'El numero de pedido no es valido',
	            str_replace('/','-', trim($migration['nro_pedido']))
	            );
	        return False;
	    }
	    
	    $formatted_migration['nro_pedido'] = $nro_order;    
	    if($this->modelOrder->get($nro_order) != False){
	        $formatted_migration['bg_exist_in_local'] = True;
	    }
	    	    	    
	    if(gettype($supplier) == 'array'){
	        $formatted_migration['proveedor'] = $supplier['nombre'];
	        $formatted_migration['identificacion_proveedor'] = $supplier['identificacion_proveedor'];
	        if($supplier['comentarios'] != null){
    	        $formatted_migration['observaciones_proveedor'] = $supplier['comentarios'];	            
	        }
	        $formatted_migration['bg_have_supplier'] = True;
	        
	        $supplier_local = $this->modelSupplier->get($formatted_migration['identificacion_proveedor']);
	        
	        if(is_array($supplier_local)){
	            $formatted_migration['bg_supplier_exist_in_local'] = True;
	        }
	    }
	    
	    if(gettype($invoice) == 'array'){
	        $formatted_migration['identificacion_proveedor_factura'] = $invoice['identificacion_proveedor'];
	        $formatted_migration['id_factura_proveedor'] =  $invoice['id_factura_proveedor'];
	        $formatted_migration['fecha_emision_factura'] = $invoice['fecha_emision'];
	        $formatted_migration['fecha_vencimiento_factura'] = $invoice['venciemiento_pago'];
	        $formatted_migration['valor_factura'] = floatval($invoice['valor']);
	        if($invoice['observacioes'] != null){
	            $formatted_migration['observaciones_factura'] = $invoice['observacioes'];
	        }        	        
	        $formatted_migration['bg_have_invoice'] = True;        
	    }    	   
	    
	    if(gettype($invoice_items) == 'array'){
	        $formatted_migration['bg_have_invoice_items'] = True;        
	    }
	    
	    if(gettype($order_items) == 'array'){
	        $formatted_migration['bg_have_order_items'] = True;
	    }
	    
	    #comprobamos que la factura tenga detalles sino tomamos los del pedido
	    $order_items_validated = [];
	    
	    if(boolval($formatted_migration['bg_have_invoice_items']) || boolval($formatted_migration['bg_have_order_items'])){
	        $order_items_validated = $this->checkProduct($migration, $formatted_migration);    
	    }  
	    
	    $formatted_migration['detalle_pedido'] = $order_items_validated;    	   
	    
	    return $formatted_migration;
	}
	
	
	/**
	 * Obtiene el incoterm de un pedido
	 * @param string $incoterm
	 */
	private function getIncoterm($incoterm):string{
	    $incoterm_list = [
	        'FCA',
	        'EXW',
	        'FOB',
	        'CFR',
	    ];	        
	    
	    if($incoterm == null || $incoterm == ''){
	        $this->modelLog->errorLog(
	            'El pedido no tiene incoterm'
	            );
	        return '---';
	    }	    
	    
	    if($incoterm == 'EX WORK' || $incoterm == 'EX WORKS'){
	        return 'EXW';
	    }
	        	    
	   foreach ($incoterm_list as $i){
	       if($i == $incoterm){
	           return $i;
	       }
	    }
	   
	    $this->modelLog->errorLog(
	        'El pedido no tiene incoterm'
	        );
	    
	    return '---';
	    
	}
	
	/**
	 * Comprueba la informacion del producto y la completa usando el detalle
	 * del pedido o el detalle de la factura
	 * @param array $migration
	 * @param bool $have_invoice
	 * @return array
	 */
	private function checkProduct(array $migration, array $formatted_migration){	    
	    $products = [];
	    
	    if(boolval($formatted_migration['bg_have_invoice_items'])){
	        foreach ($migration['product'] as $k => $product){
	            if($product['cod_contable'] != Null || $product['cod_contable'] != ''){
	                $product_valid = [
	                    'cod_contable' => $product['cod_contable'],
	                    'cod_ice' => $product['cod_ice'],
	                    'nombre' => $product['nombre'],
	                    'capacidad_ml' => intval($product['capacidad']),
	                    'cantidad_x_caja' => intval($product['cantidad_x_caja']),
	                    'grado_alcoholico' => $product['grado_alcoholico'],
	                    'costo_caja' => '',
	                    'bg_product_exist_in_local' => True,
	                    'nro_cajas' => 0,
	                    'id_user' => $this->session->userdata('id_user'),
	                    'comentarios' => 'Data importada por assisten App Importaciones'
	                ];
	                
	                $product_base = $this->modelProduct->get($product['cod_contable']);
	                
	                if($product_base == False){
	                    $product_valid['bg_product_exist_in_local'] = False;
	                }
	                
	                if($formatted_migration['bg_have_invoice_items']){
	                    foreach ($migration['invoice_detail'] as $k => $det ){
	                        if($det['cod_contable'] == $product['cod_contable']){
	                            $product_valid['nro_cajas'] = intval($det['nro_cajas']);
	                            if($formatted_migration['moneda'] == 'DOLARES'){
	                                $product_valid['costo_caja'] = floatval($det['costo_caja']);
	                            }else{
	                                $product_valid['costo_caja'] = floatval($det['costo_caja']) / 1.25;
	                            }
	                        }
	                    }
	                }
	                
	                array_push($products, $product_valid);
	                
	            }
	        }
	    }  
	    
	    #sino buscamos en orders items
	    foreach ($migration['product'] as $k => $product){
	        if($product['cod_contable'] != Null || $product['cod_contable'] != ''){
	            $product_valid = [
	                'cod_contable' => $product['cod_contable'],
	                'cod_ice' => $product['cod_ice'],
	                'nombre' => $product['nombre'],
	                'capacidad_ml' => intval($product['capacidad']),
	                'cantidad_x_caja' => intval($product['cantidad_x_caja']),
	                'grado_alcoholico' => $product['grado_alcoholico'],
	                'costo_caja' => '',
	                'bg_product_exist_in_local' => True,
	                'nro_cajas' => 0,
	                'id_user' => $this->session->userdata('id_user'),
	                'comentarios' => 'Data importada por assisten App Importaciones'
	            ];
	            
	            $product_base = $this->modelProduct->get($product['cod_contable']);
	            
	            if($product_base == False){
	                $product_valid['bg_product_exist_in_local'] = False;
	            }
	            
	            if($formatted_migration['bg_have_order_items']){
	                foreach ($migration['order_items'] as $k => $det ){
	                    if($det['cod_contable'] == $product['cod_contable']){
	                        $product_valid['nro_cajas'] = intval($det['nro_cajas']);
	                        if($formatted_migration['moneda'] == 'DOLARES'){
	                            $product_valid['costo_caja'] = floatval($det['costo_caja']);
	                        }else{
	                            $product_valid['costo_caja'] = floatval($det['costo_caja']) / 1.25;
	                        }
	                    }
	                }
	            }
	            
	            array_push($products, $product_valid);
	        }
	    }
	    	    
	    return $products;
	}
	
	
	/**
	 * Retorna el pais y el puerto de ebanque de un pedido
	 * 
	 * @param string $input frase del pedido
	 * @param string $type [country|port] 
	 * @return string [country|port] 
	 */
	private function getOrigin($input, $type):string{
        #eliminamos los eqpaciuo
        $input =  strtoupper(trim($input));               
        
        if (preg_match('/[A-Z] \/ [A-Z]/',$input) || preg_match('/[A-Z]\/[A-Z]/',$input)){
            $indexOfCountry = strpos($input,'/');
            $country = substr($input,0,$indexOfCountry);
            $puerto = substr($input, $indexOfCountry+1, strlen($input));
            
            if($type == 'country'){
                return trim($country);
            }
            
            return trim($puerto);
            
        }elseif(preg_match('/[A-Z]/', $input)){
            return str_replace('/', '' , $input);
        }       
        
        $this->modelLog->errorLog(
            'El pais de origen no tiene el formato correcto'
            );
        return 'SIN DATOS';
	}
	
	/**
	 * Comprueba el numero del pedido [000-00]
	 *
	 * @param string $nro_order
	 * @return string | false
	 */
	private function checkNroOrder(string $nro_order){
	    if(strlen($nro_order) == 0){
	        $this->modelLog->errorLog(
	            'La longitud de cadena del nro de pedido es cero'
	            );
	        return False;
	    }	   
	    
	    $pattern = '/[0-9][0-9][0-9]-[0-9][0-9]/';
	    
	    if(preg_match($pattern, $nro_order)){
	        return $nro_order;
	    }
	    
	    #patron minimo para formatear
	    $pattern = '/[0-9]-[0-9][0-9]/';
	    if(preg_match($pattern, $nro_order)){
	        $end = strpos($nro_order, '-');
	        $number = substr($nro_order, 0 , $end);
	        $zeros = 3 - strlen($number);	        
	        if($zeros == 2){
	            return '00' . $number . substr($nro_order, $end , strlen($nro_order));
	        }
	        
	        return '0' . $number . substr($nro_order, $end , strlen($nro_order));
	    }
	    
	    $this->modelLog->errorLog(
	        'El numero de pedido no cumple con el requisito minimo, 
             para ser migrado',
	        $nro_order
	        );
	    
	    return False;	    
	}
	
	/**
	 * Comprueba si el pedido esta en la lista de pedidos
	 * @param string $nro_order
	 * @return bool
	 */
	private function getOrderFromMigrations($nro_order):bool{
	    $result = $this->modelBase->get_table([
	        'table' => $this->table,
	        'where' => [
	            'nro_pedido' => $nro_order
	        ],
	    ]);
	    
	    if($result){
	        return $result[0];
	    }
	    
	    $this->modelLog->generalLog(
	        'El pedido no esta registrado en la tabla de migraciones ' . $nro_order 
	        );
	    return [];
	    
	}
	
	
	/**
	 * Comprruba la informacion del proveedor
	 * 
	 * @param array|boolean $supplier
	 */
	private function checkSupplier($supplier, $option = False){
	    
	    #determina que el proveedor no existe
	    if(gettype($supplier) != 'array' || count($supplier) == 0){
	        $this->modelLog->errorLog(
	            'El proveedor no existe en el arreglo de datos'
	            );
	        return False;
	    }
	    
	    if(
	        $supplier['nombre'] == '' 
	        || $supplier['nombre'] == null 
	        || $supplier['identificacion_proveedor'] == ''
	        || $supplier['identificacion_proveedor'] == null
	        ){
	            $this->modelLog->errorLog(
	                'El proveedor no cumple con las condiciones minimas'
	                );	            
	            return False;
	    }
	    
	    if($option){
	        return True;
	    }
	    
	    return $supplier;	    
	}
	
	
	/**
	 * Comprueba la factura del proveedor y sus detalles 
	 * 
	 * @param string $invoice
	 * @param string$invoice_detail
	 * @param string $type [invoice | invoiuce_detail]
	 * @param bool $option  usa para retornar booleano
	 * @return array|bool 
	 */
	private function checkInvoice($invoice, $option = False){
	    if(gettype($invoice) != 'array' || count($invoice) == 0){
	        $this->modelLog->errorLog(
	            'La cabecera de factura no existe'
	            );
	        return False;
	    }
	    
	    if(
	        $invoice['id_factura_proveedor'] == '' 
	        || $invoice['identificacion_proveedor'] == '' 
	        || $invoice['fecha_emision']  == ''
	        || $invoice['venciemiento_pago']  == ''
	        || $invoice['id_factura_proveedor'] == null
	        || $invoice['identificacion_proveedor'] == null
	        || $invoice['fecha_emision']  == null
	        || $invoice['venciemiento_pago']  == null
	        || floatval($invoice['valor'] < 0)){ 
	        
            $this->modelLog->errorLog(
                'La cabecera de la factura no cumple con los requerimientos minimos'
                );
            return False;
       
	    }
	    
	    if($option){
	        return True;
	    }
	    return $invoice;
	  
	}
	
	
	/**
	 * Comprueba los items de las facturas
	 * 
	 * @param array $invoiceItems
	 */
	private function cehckInvoiceItems($invoiceItems){
	    if(gettype($invoiceItems) != 'array' || count($invoiceItems) == 0){
	        return False;
	    }
	    
	    foreach ($invoiceItems as $k => $item){
	        if(
	            $item['costo_caja'] < 1 
	            || $item['cod_contable'] == '' 
	            || $item['nro_cajas'] < 1
	            ){
	            $this->modelLog->errorLog(
	                'Los detalles de factura no cumple con los requerimientos minimos'
	                );
	            return False;
	        }
	    }    
	    return $invoiceItems;	    
	}
	
	
	/**
	 * retorna el regimen de un pedido
	 * 
	 * @param string $coments
	 * @return string
	 */
	private function getRegimenOrder($migration): string{    
	    $coments_invoice = '';
	    $comments_order = '';
	    
	    
	    if(isset($migration['invoice']['observacioes'])){
	        $coments_invoice =  $migration['invoice']['observacioes'];
	    }
	    
	    if(isset($migration['observaciones'])){
	        $comments_order =  $migration['observaciones'];
	    }
	    
        $coments = strtoupper($coments_invoice . ' ' . $comments_order);
        $coments = trim(preg_replace('/\s\s+/','', $coments));
	    
	    if($coments != '' || $coments != ' '){
	        if(preg_match('/ALMAGRO/', $coments)){
	            return '70';
	        }else{	            
	            return '10';
	        }
	    }	    
	    
	    $this->modelLog->errorLog(
	        'El pedido no cumpple con el requisito minimo para determiat su numero',
	        $coments
	        );
	    
	    return '00';
	}
	
	
	/**
	 * Retorna el tipo de moneda que usa el proveedor
	 */
	private function checkSupplierCurrency($supplier, string $type){
	    if (gettype($supplier) != 'array'){
	       return 0;    
	    }
	    
	    $supplier_euro = $this->modelSupplier->getSuplliersByMoney('EUROS');
	    
	    	    
	    foreach ($supplier_euro as $k){
	        if($k == $supplier['identificacion_proveedor']){
	            if($type == 'type_change'){
	                return $this->tipo_cambio_trimestral;
	            }
	            return 'EUROS';
	        }
	    }
	    
	    if($type == 'type_change'){
	        return 1;
	    }
	    return 'DOLARES';
	}
	
}