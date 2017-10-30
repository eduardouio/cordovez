<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modulo encargado de manejar los pedidos, CRUD y validaciones
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 *
 *
 * var $controller => Nombre del la tabla de la BD
 * var $listPerPage => Nro de registros por pagina
 * var $seguroVal =>  Valor por el que se multiplica FOB + FLETE
 * var $template => ubicacion de la plantilla
 *
 */
class Pedido extends MY_Controller {
	private $controller = 'pedido';
	private $listPerPage = 12;
	private $seguroVal = 2.2;
	private $template = '/pages/pagePedido.html';

	public function __construct(){
		parent::__construct();
	}

	/**
	 * Se redicrecciona a la lista de los pedidos
	 */
	public function index(){
		$this->listar();
	}

	/**
	 * Presenta una lista de todos los pedidos
	 */
	public function listar(int $offset = 0){
		$this->db->where('nro_pedido !=', '000-00');
		$this->db->order_by('date_create', 'DESC');
		$this->db->order_by('nro_pedido', 'DESC');
		$this->db->limit($this->listPerPage, $offset);
		$resultDb = $this->db->get($this->controller);

		$pages_links = ($this->db->count_all_results($this->controller) /
																								$this->listPerPage);
		if (gettype($pages_links) == 'double') {
			(int)$pages_links = (int)$pages_links + 1;
		};
		$data = $this->dateDiff($resultDb->result_array(), 
														'fecha_arribo' , 
														date_create(date('Y-m-d'))
													);
		$resumData = [];
		foreach ($data as $item => $order) {
		 $order['resumValues'] =  $this->getValues($order);
		 $resumData[$item] = $order;
		}
		$config = [
									'list_orders' => true,
									'list_active' => 'class="active"',
									'orders' => $resumData,
									'titleContent' => 'Lista de Pedidos',
									'userData' => $this->session->userdata(),
									'pagination' => true,
									'perPage' => $this->listPerPage,
									'pagination_pages' => $pages_links,
									'current_page' => (int)(($offset)/10) + 1,
									'last_page' => (int)(($pages_links - 1) * 10),
									'pagination_url' => base_url() . 'index.php/pedido/listar/',
									];
		$this->responseHttp($config);
	}

	/**
	* Mestra un pedido completo
	*/
	public function presentar($nroOrder){
		if(!isset($nroOrder)){
			$this->redirectPage('ordersList');
		}
		
		$myOrder = $this->mymodel->get_table([
															'table' => $this->controller,
															'where' => ['nro_pedido' => $nroOrder]
																				]);
		$orderData = $this->dateDiff($myOrder, 'fecha_arribo', 
																										date_create(date('Y-m-d')));

		$valuesSums = $this->getValues($orderData[0]);
		$provisions = $this->mymodel->get_table([
																				'select' => [
																							'sum(\'*\') as provisions',
																						],
																				'table' => 'gastos_nacionalizacion',
																				'where' => [
																						'nro_pedido' => $nroOrder,
																									],
																				]);

		$resultDbAux = $this->db->query('call sp_calcConsolidated(' . 
																													$nroOrder .')');	
		$consolided = $resultDbAux->result_array();
		$this->db->close();
		$data = [
			'order' => $orderData[0],
			'valuesSums' => $valuesSums,
			'userData' => $this->session->userdata(),
			'orderInvoices' => $this->getOrderInvProducts($nroOrder),
			'initialExpenses' => $this->getInitialExpenses($nroOrder),
			'nationalizations' => $this->getNationalizations($nroOrder),
			'invoicesInfo' => $this->getInvoiceInformative($nroOrder),
			'boxesOrder' => $this->getBoxesOrder($nroOrder, $orderData[0]['regimen']),
			'provisions' => count($provisions),
			'consolided' => count($consolided),
						];

		if($data['order'] == false){
			$this->redirectPage('ordersList');
			return true;
		}

		$config['show_order'] = true;
		$config['viewData'] = $data;
		$config['list_active'] = 'class="active"';
		$config['createBy'] = $this->getUserDataDb($data['order']['id_user']);
		$config['titleContent'] = 'Detalle De Pedido [ ' . 
																								$data['order']['nro_pedido'] . 
																								']' ;
		$this->responseHttp($config);
	}
	
	/**
	* Muestra el formulario para crear un pedido
	*/
	public function nuevo(){
		$config['incoterms'] = json_encode($this->mymodel->get_table([
																									'table' => 'tarifa_incoterm',
																																]));
		$config['new_active'] = 'class="active"';
		$config['create_order'] = true;
		$config['countries'] = $this->getCountries();
		$config['titleContent'] = 'Registro de nuevo Pedido';
		$this->responseHttp($config);
	}

	/**
	* Muestra el formulario de edicion 
	*/
	public function editar($nroOrder){
		$order = $this->mymodel->get_table([
																'table' => $this->controller,
																'where' => ['nro_pedido' => $nroOrder,],
																			]);
		if ($order == false) {
			$this->redirectPage('ordersList');
			return false;
		}

		$config = [
				'edit_order' => true,
				'order' => $order[0],
				'incoterms' => json_encode($this->mymodel->get_table([
																							'table' => 'tarifa_incoterm'
																														])),
				'titleContent' => 'Se Encuentra Editando El Pedido &nbsp &nbsp <b>'. 
																														$nroOrder . '</b>',
							];
		$this->responseHttp($config);
	}

	/**
	 * elimina un pedido de la tabla, solo lo elimina sino tiene parciales
	 */
	public function eliminar($nroOrder){
		$this->db->where('nro_pedido', $nroOrder);
		if ($this->db->delete($this->controller)){
			$config['order'] = $nroOrder;
			$config['viewMessage'] = true;
			$config['deleted'] = true;
			$config['message'] = 'El Pedido fue eliminado Exitosamente!';
			$this->responseHttp($config);
		}else{
			$config['order'] = $nroOrder;
			$config['viewMessage'] = true;
			$config['message'] = 'El pedido no puede ser Eliminado, 
																												 tiene dependencias!';
			$this->responseHttp($config);
		}
	}

   /**
	 * crea y/o modifica un pedido
	 * @return JSON (response)
	 */
	public function validar(){
		if(!$_POST){$this->redirectPage('ordersList');}

		$pedido = $this->input->post();
		$pedido['id_user'] = $this->session->userdata('id_user');		
		if($pedido['fecha_arribo'] == ''){
			unset($pedido['fecha_arribo']);
		}else{
		$pedido['fecha_arribo'] = date('Y-m-d' ,
																						strtotime($pedido['fecha_arribo']));
		}
		if(!isset($pedido['id_pedido'])){
			if((int)$pedido['n_pedido'] < 100 && intval($pedido['n_pedido']) > 9 ){
					$pedido['n_pedido'] = '0' . intval($pedido['n_pedido']);
				}elseif((int)$pedido['n_pedido'] < 9 ){
					$pedido['n_pedido'] = '00' . intval($pedido['n_pedido']);
				}
		 
				$pedido['nro_pedido'] =  $pedido['n_pedido']. '-'. $pedido['y_pedido'];
				unset($pedido['n_pedido']);
				unset($pedido['y_pedido']);
				
				$this->db->where('nro_pedido',$pedido['nro_pedido']);
				$resultDb = $this->db->get($this->controller);

				if($resultDb->num_rows() == 1 ){		
					$config['order'] = $pedido['nro_pedido'];
					$config['viewMessage'] = true;
					$config['message'] = 'El pedido ya existe!';
					$this->responseHttp($config);
					return true;
				}	
		}

		$status = $this->validData($pedido);
			if ($status['status']){
				if (!isset($pedido['id_pedido'])){
					$this->db->insert($this->controller, $pedido);
					$this->setInitialExpenses($pedido, true);
					$this->redirectPage('presetOrder', $pedido['nro_pedido']);
					return true;
				}else{
					$pedido['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('nro_pedido', $pedido['nro_pedido']);
					$this->db->update($this->controller, $pedido);
					$this->redirectPage( 'presetOrder', $pedido['nro_pedido']);
					return true;
				}
		}else{
			$config = [
				'fail' => true,
				'fields_error' => $status['len'],			
				'order' => $pedido['nro_pedido'],
				'viewMessage' => true,
				'fail' => true,
				'message' => 'La información de uno de los campos es incorrecta!',
				'data' => $status,
			];
			
			$this->responseHttp($config);
			return true;
		}
	}


	/**
	* Retorna los valores de 
	* Sumatoria FOB de las facturas de un Pedido
	* Lo Nacionalizado del Pedido
	* @param $order -> registro del pedido
	*/
	private function getValues(array $order){
		$configIncoterm = [
									'EXW' =>  1.0,
									'FCA' => 	1.0,
									'FOB' =>  1.0,
									'CFR' => -1.0,
			];

		$paramsInvoices = [
						'select' => ['SUM(valor * tipo_cambio) AS invoices'],
						'table' => 'pedido_factura',
						'where' => [
											'nro_pedido' => $order['nro_pedido'],
												],
		];
		
		$paramsInitExpenses = [
			'select' => ['valor_provisionado as initexpenses'],
			'table' => 'gastos_nacionalizacion',
			'where' => [
							'nro_pedido' => $order['nro_pedido'],
							'concepto' => 'GASTO ORIGEN',
									],
		];

		$paramsNationalizaions = [
			'select' => ['nro_pedido'],
			'table' => 'nacionalizacion',
			'where' => [
								'nro_pedido' => $order['nro_pedido'],
								'id_factura_informativa' => 0,
									],
		];

		$paramsInfoInvoices = [
			'select' => ['SUM( valor ) as infoinvoices'],
			'table' => 'factura_informativa',
			'where' => [
								'nro_pedido' => $order['nro_pedido'],
								],
		];

		$valInvoices = $this->mymodel->get_table($paramsInvoices);
		$valInitExpenses = $this->mymodel->get_table($paramsInitExpenses);
		$nationalizationR10 = $this->mymodel->get_table($paramsNationalizaions);
		$valInfoInvoices = $this->mymodel->get_table($paramsInfoInvoices);

		 $valInvoices = ($valInvoices == false) ? 0.00 : 
		 																			$valInvoices[0]['invoices'];
		 $valInitExpenses = ($valInitExpenses == false) ? 0.00 : 
		 																			$valInitExpenses[0]['initexpenses'];
		 $nationalizationR10 = ($nationalizationR10 == false) ? 0.00 : 
																					$nationalizationR10[0]['nro_pedido'];
		 $valInfoInvoices= ($valInfoInvoices == false) ? 0.00 : 
		 																			$valInfoInvoices[0]['infoinvoices'];
		$multiple =  $configIncoterm[$order['incoterm']];
	
		$result = [
			'valInvoices' => floatval($valInvoices),
			'multiple' => floatval($multiple),
			'regimen10' => ($nationalizationR10) ? true : false,
			'infoInvoices' => $valInfoInvoices,
			'initExpenses' => $valInitExpenses,
			];

		return $result;
	}


	/**
	* Obtiene la cantidad de cajas de tiene un pedido, en cuanto al stock
	* solo se usa para el regimen 70, el 10 no tiene parciales
	* Asi como tambien otiene la cantidad de cajas nacionalizadas
	*
	* @param $nroOrder
	* @param $regimen tipo de regimen a consultar
	* @return array
	*/
	private function getBoxesOrder(string $nroOrder, string $regimen){
		$result = [
							'boxesImported' => 0,
							'boxesNationalized' => 0,
							];
		$invoices = $this->mymodel->get_table([
																	'select' 	=> ['id_pedido_factura',],
																	'table' 	=> 'pedido_factura',
																	'where' 	=> ['nro_pedido' => $nroOrder],
																					]);	

		foreach ($invoices as $key => $value) {
			$boxesInvoice = $this->mymodel->get_table([
																'select'	=> ['nro_cajas'],
																'table'		=> 'detalle_pedido_factura',
																'where'		=> [
																'id_pedido_factura' => 
																										$value['id_pedido_factura'],
																	],]);
			if ($boxesInvoice){
				foreach ($boxesInvoice as $key => $invoice) {
					$result['boxesImported'] += intval($invoice['nro_cajas']);
				}
			}
		}

			if ($regimen == '70'){
				$infoInvoices = $this->mymodel->get_table([
																	'select'	=> ['id_factura_informativa'],
																	'table' 	=> 'factura_informativa',
																	'where' 	=> ['nro_pedido' => $nroOrder],
																									]);

				foreach ($infoInvoices as $key => $invoice) {
					$boxesInfoInvoice = $this->mymodel->get_table([
																	'select' => [
																							'id_factura_informativa', 
																							'nro_cajas'
																							],
																	'table' => 'factura_informativa_detalle',
																	'where' => [
																							'id_factura_informativa' => 
																							$invoice['id_factura_informativa']
																						],
																											]);
					if ($boxesInfoInvoice){
						foreach ($boxesInfoInvoice as $key => $infoinvoice) {
							$result['boxesNationalized'] += intval($infoinvoice['nro_cajas']);
						}		
					}
				}
			}
			return $result;
	}
		/**
		 * se validan los datos que deben estar para que la consulta no falle
		 * @return [array] | [bolean]
		 */
		private function validData($pedido){
			$columnsLen = array(
				'nro_pedido' => 6,
				'regimen' => 2,
				'incoterm' => 1,
				'pais_origen' => 1,
				'ciudad_origen' => 1,			
				'flete_aduana' => 1,
				'nro_refrendo' => 1,
				'seguro_aduana' => 1,
				'id_user' => 1,
			);
			return $this->_checkColumnsData($columnsLen, $pedido);
		}

	/**
	* Obtiene el detalle de facturas y sus items de un pedido
	* @param (str) $orderId
	* @return (array) result array
	*/
	private function getOrderInvProducts($orderId){
		$orders = $this->mymodel->get_table([
																					'table' => 'pedidoFacturaView',
																					'where' => ['nro_pedido' => $orderId],
																				]);
		if(!$orders) { return false;}
		
		$ordersDetail = array();
		foreach ($orders as $key => $value) {
			$ordersDetail[$key] = $value;
			$ordersDetail[$key]['orderDetail'] = $this->mymodel->get_table([
																		'table' => 'detallePedidosView',
																		'where' => [
																			'id_pedido_factura' => 
																										$value['id_pedido_factura'],
																							],
																																		]);
		}
		return $ordersDetail;
	}
	

	/**
	* Obtiene los gastos iniciales del pedido
	* @param (str) $orderId
	* @return (array) initial Expenses
	*/
	private function getInitialExpenses($orderId){

		$initialExpenses = $this->mymodel->get_table([
																			'table' => 'gastos_nacionalizacion',
																			'where' => ['nro_pedido' => $orderId],
																								]);
		if(!$initialExpenses) { return false;}
		$expensesDetail = [];

		foreach ($initialExpenses as $key => $val) {
			$paramsQuery = [
				'select' => [
											'nombre',
											'identificacion_proveedor',
											'id_proveedor',
								],

				'table' => 'proveedor',

				'where' => [
									'identificacion_proveedor' => $val['identificacion_proveedor'],
								],

				'orderby' => [
									'identificacion_proveedor' => 'ASC',
									'nombre' => 'ASC',
								],
			];

			$supplier = $this->mymodel->get_table($paramsQuery);

			$expensesDetail[$key] = $val;
			$expensesDetail[$key]['nombre'] = $supplier[0]['nombre'];
			$expensesDetail[$key]['id_proveedor'] = $supplier[0]['id_proveedor'];

		}
		return $expensesDetail;
	}


	/**
	* Obtiene las nacionalizaciones de un pedido
	* @param (str) $orderId
	* @return (array) resul array() | false
	*/
	private function getNationalizations($orderId){

		$nationalizations = $this->mymodel->get_table([
																					'table' => 'nacionalizacion',
																					'where' => ['nro_pedido' => $orderId]
																									]);
		if(!$nationalizations){return false;}

		return $nationalizations;
	}


	/**
	* Obtiene una lista de facturas informativas
	* @param (str) $orderId
	* @return (array) resul array() | false
	*/
	private function getInvoiceInformative($orderId){
		$infoInvoices = $this->mymodel->get_table([
																					'table' => 'factura_informativa',
																					'where' => ['nro_pedido' => $orderId]
																							]);
		if(!$infoInvoices){return false;}
		return $infoInvoices;
	}

	/**
	* Obtiene la lista de paises y ciudades de la tabla
	*/
	private function getCountries(){
		$this->db->select('pais');
		$this->db->group_by('pais');
		$resultDb = $this->db->get('tarifa_incoterm');
		$countries = $resultDb->result_array();

		foreach ($countries as $key => $value){
			$this->db->select('ciudad');
			$this->db->where('pais' , $value['pais']);
			$this->db->group_by('ciudad');
			$resultDb = $this->db->get('tarifa_incoterm');
			$countries[$key]['cities'] = $resultDb->result_array();
		}
		return $countries;
	}

		/**
		* Setea los gastos iniciales para un pedido si auro es true 
		* crea los gastos iniciales del pedido, sino crea los gastos
		* que se especifican en los requerimientos
		*	
		*	[R10 y R70]
		* FLETE 
		* SEGURO
		* GASTOS EN ORIGEN
		* 
		* [Adicional R70]
		* THC
		* ISD
		* ESTIBAJE
		* CANDADO SATELITAL
		* DEMORAJE
		* CUSTODIA
		* ALMACENAJE INICIAL
		* TRANSPORTE
		* GASTOS LOCALES
		* 
		* @param (array) $order 
		* @param (bool) $auto
		* @return (bool)
		*/
		private function setInitialExpenses($order, $auto = true){
			if ($auto) {
				$this->db->where('pais', $order['pais_origen']);
				$this->db->where('ciudad', $order['ciudad_origen']);
				$this->db->where('incoterms', $order['incoterm']);
				$resultDb = $this->db->get('tarifa_incoterm');
				$startExpenses = $resultDb->result_array();

				foreach ($startExpenses as $key => $value) {
					$initGst = [
												'nro_pedido' => $order['nro_pedido'],
												'identificacion_proveedor' =>  '0',
												'concepto' => $value['tipo'],
												'valor_provisionado' => $value['tarifa'],
												'comentarios' => 'CREADO AUTOMATICAMENTE',
												'id_user' => $this->session->userdata('id_user'),
											];

					$this->db->insert('gastos_nacionalizacion', $initGst);
				}		
				return true;
			}

			$initialExpenses = $this->mymodel->get_table([
																								'select' => [
																										'concepto',
																										'valor',
																										'porcentaje',
																										'identificacion_proveedor',
																										'regimen',
																										'pais_origen',
																														],
																								'table' => 'tarifa_gastos',
																								'where' => [
																													'tipo_provision' =>
																													'GASTO INICIAL',
																													'estado' => '1',
																													],
																									]);
			$valuesOrder = $this->getValues($order);
			$fob = floatval($valuesOrder['valInvoices']);
			$fleteParams = $this->mymodel->get_table([
																				'select'=>['valor_provisionado',],
																				'table' => 'gastos_nacionalizacion',
																				'where' => [
																					'concepto' => 'FLETE',
																					'nro_pedido' => $order['nro_pedido'],
																									]
																							]);
			$flete = 0.000;
			($fleteParams == false) ? $flete = 0.000 : $flete = 
																					$fleteParams[0]['valor_provisionado'];

			foreach ($initialExpenses as $key => $value) {
				if($value['pais_origen'] != $order['pais_origen'] && 
					$value['pais_origen'] != 'ECUADOR'){
					unset($initialExpenses[$key]);
				}else if(floatval($value['valor']) == 0.000 ){
						$percent = floatval($value['porcentaje']);
						if ($value['concepto'] == 'SEGURO'){
							$value['valor'] = (($fob + $flete) * $this->seguroVal) * $percent;
						}else{
							$value['valor'] = ($fob * $percent);
						}
				$initialExpenses[$key] = $value;
				}
			}

			foreach ($initialExpenses as $key => $value) {
				$value['nro_pedido'] = $order['nro_pedido'];
				$value['id_nacionalizacion'] = '0';
				$value['valor_provisionado'] = $value['valor'];
				$value['comentarios'] = 'CREADO AUTOMATICAMENTE';
				$value['id_user'] = $this->session->userdata('id_user');
				$value['fecha'] = date('Y-m-d');
				$value['supplier'] = $this->getSupplierInfo(
																						$value['identificacion_proveedor']);
				unset($value['valor']);
				unset($value['porcentaje']);
				unset($value['regimen']);
				unset($value['pais_origen']);
				$initialExpenses[$key] = $value;
			}

			$counts = array_count_values(array_column($initialExpenses, 'concepto'));
			$delitems = [];
			foreach ($initialExpenses as $key => $value) {

				if (($counts[$value['concepto']] == 1) && ( substr(
															$value['concepto'], 0,10) != 'TRANSPORTE')){
						
						unset($value['supplier']);
						if ($order['regimen'] == '70'){
							$this->db->insert('gastos_nacionalizacion', $value);
							unset($initialExpenses[$key]);
						}elseif (($order['regimen'] == '10' ) && 
											($value['concepto'] == 'SEGURO')){							
							$this->db->insert('gastos_nacionalizacion', $value);
							$this->redirectPage('presetOrder', $order['nro_pedido']);
							return true;						
				}
			}
			$config = [
						'titleContent' => 
									'Seleccione Los Gastos Iniciales Pedido : ' . 
																								$order['nro_pedido'],
						'initialExpenses' => $initialExpenses,
						'selected_expenses' => true
							];
			$this->responseHttp($config);
		}
	}

		/**
		* Retorna la informacion basica de un proveedor
		* @param (string) identificacion Proveedor
		*/
		private function getSupplierInfo($idSupplier){
			$supplier = $this->mymodel->get_table([
																		'select' => [
																								'identificacion_proveedor', 
																								'nombre', 
																								'tipo_provedor',
																								'categoria',
																							],
																		'table' => 'proveedor',
																		'where' => [
																			'identificacion_proveedor' => $idSupplier,
																			],
																			]);
			if ($supplier){
				return $supplier[0];
			}
			return false;
		}

		/**
		* Metodo pulico encargado de generar los gastos inicialaes, ya sea por post
		* o directamente el formulario de gastos iniciales
		* 
		*/
		public function calcularGI($nroOrder){

			$order = $this->mymodel->get_table([
																				'table' => $this->controller,
																				'where' => ['nro_pedido'=> $nroOrder]
																			]);
			if($order){
				$this->setInitialExpenses($order[0], false);
				return true;
			}

			//$this->redirectPage('presetOrder', $nroOrder);
		}


		/**
		* Valida y guarda los gastos iniicales de una tabla
		*
		*/
		public function validExpenses(){
			if(!$_POST){
				$this->redirectPage('ordersList');
				return false;
			}
			$initexpenses = [];
			$items = $this->input->post();
			foreach ($items as $item) {
					$data = explode(',', $item);
					array_push($initexpenses, $data);
			}

			foreach ($initexpenses as $key => $value) {
					$insertExpense = [
												'nro_pedido' => $value[0],
												'id_nacionalizacion' => $value[1],
												'identificacion_proveedor' => $value[2],
												'concepto' => $value[3],
												'valor_provisionado' => $value[4],
												'comentarios' => $value[5],
												'id_user' => $value[6],
												'fecha' => $value[7],
													];				
					$this->db->insert('gastos_nacionalizacion', $insertExpense);
			}
			$this->redirectPage('presetOrder', $initexpenses[0][0]);
		}

		/* *
		* Envia la respuestas html al navegador
		*/
		private function responseHttp($config){
			$params = [
					'title' => 'Pedidos',
					'base_url' => base_url(),
					'rute_url' => base_url() . 'index.php/',
					'controller' => $this->controller,
					'iconTitle' => 'fa-cubes',
					'content' => 'home',
			];
			return $this->twig->display($this->template, array_merge($config, $params));
		}
}