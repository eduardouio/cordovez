<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modulo encargado de manejar los proveedores, CRUD y validaciones
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Gstinicial extends MY_Controller {	
	private $controller = "gastos_nacionalizacion";
	private $template = '/pages/pageGasto-inicial.html';
	private $securePercent = 0.0018;
	
	/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	* Elimina un pedido 
	*/
	public function eliminar($idInitExpense){
		$this->db->where('id_gastos_nacionalizacion', $idInitExpense);
		$resultDb = $this->db->get($this->controller);
		$detail = $resultDb->result_array();

		$this->db->where('id_gastos_nacionalizacion', $idInitExpense);
		if ($this->db->delete($this->controller)){
			$config['order'] = $detail[0]['nro_pedido'];
			$config['viewMessage'] = true;
			$config['deleted'] = true;
			$config['message'] = 'Gasto Inicial Eliminado Exitosamente!';
			$this->responseHttp($config);
			return true;
		}else{
			$config['orderDetail'] = $detail[0]['id_pedido_factura'];
			$config['viewMessage'] = true;
			$config['message'] = 'El registro no puede ser Eliminado, 
																												 tiene dependencias!';
			$this->responseHttp($config);
			$this->db->where('id_gastos_nacionalizacion', $idInitExpense);
		}
	}

	/**
	* Pesenta la informacion completa del rgistro de gasto inicial
	* @param (int) $idInitExpense
	* @return array
	*/
	public function presentar($idInitExpense){
		$initExpense = $this->modelbase->get_table([
								'table' => $this->controller,
								'where' => [
													'id_gastos_nacionalizacion' => $idInitExpense ,
														],
									]);
		$supplier = $this->modelbase->get_table([
																	'table' => 'proveedor',
																	'where' => [
																		'identificacion_proveedor' => 
																		$initExpense[0]['identificacion_proveedor'],
																						],
																		]);

		$order = $this->modelbase->get_table([
																			'table' => 'pedido',
																			'where' => [
																								'nro_pedido' => 
																								$initExpense[0]['nro_pedido'],
																									],
																			]);
		$config = [
						'order' => $order[0],
						'initExpense' => $initExpense[0],
						'supplier' => $supplier[0],
						'createBy' => $this->session->userdata(),
						'titleContent' => 'Descripción De Gasto Incial Pedido:' . 
																					$order[0]['nro_pedido'] ,
						'show' => true,
						];
		$this->responseHttp($config);
	}

	
	/**
	* Muestra el formulario para regostrar un nuevo gasto inicial
	* @param (string) $nroOrder
	* @return (array)
	*
	*/
	public function nuevo($nroOrder){
			if (!isset($nroOrder)) {
				$this->redirectPage('ordersList');
			}

			$this->db->where('nro_pedido', $nroOrder);
			$resultDb = $this->db->get('pedido');
			$order = $resultDb->result_array();
			$resultDb = $this->db->get('proveedor');
			$suppliers = $resultDb->result_array();
			$this->db->select('concepto');
			$this->db->where('nro_pedido', $order[0]['nro_pedido']);
			$resultDb = $this->db->get($this->controller);
		
			$config['used_expenses'] = json_encode($resultDb->result_array());
			$config['create'] = true;
			$config['order'] = $order;
			$config['suppliers'] = $suppliers;
			$config['titleContent'] = 'Registro De Gasto Inicial Provisión ' . 
																								'[ Pedido ' . $nroOrder . ']';
			$this->responseHttp($config);
	}


	/**
	* Edita un gasto inicial
	*/
	public function editar($idInitExpense){
		$this->db->where('id_gastos_nacionalizacion', $idInitExpense);
		$resultDb = $this->db->get($this->controller);
		$initExpense = $resultDb->result_array();
		$this->db->where('identificacion_proveedor', 
																	$initExpense[0]['identificacion_proveedor']);
		$resultDb = $this->db->get('proveedor');
		$supplier = $resultDb->result_array();

		$resultDb = $this->db->get('proveedor');
		$suppliers = $resultDb->result_array();
		$this->db->where('nro_pedido', $initExpense[0]['nro_pedido']);

		$resultDb = $this->db->get('pedido');
		$order = $resultDb->result_array();

		$config = array(
						'order' => $order[0],
						'initExpense' => $initExpense[0],
						'supplier' => $supplier[0],
						'suppliers' => $suppliers,
						'createBy' => $this->session->userdata(),
						'titleContent' => 'Descripción De Gasto Incial Pedido:' . 
																					$order[0]['nro_pedido'] ,
						'edit' => true,
		);
		$this->responseHttp($config);
	}


	/**
	* Elimina y Crea gastos iniciales, sin tomar en cuenta FLETE y GASTOS ORIGEN
	* @param array $_POST
	* @return void | boolean
	*/
	public function putInitialExpenses(){
		if(!$_POST){
			$this->redirectPage('ordersList');
			return true;
		}
		$initExpensesInput = $this->input->post();
		$initExpensesRates = [];

		foreach ($initExpensesInput as $key => $value) {
			if ($key != 'nro_pedido' ) {
					$rates = $this->modelbase->get_table([
																				'table' => 'tarifa_gastos',
																				'where' => [
																								'id_tarifa_gastos' => $value
																									],
																					]);
					array_push($initExpensesRates, $rates[0]);
			}
		}

		foreach ($initExpensesRates as $key => $value) {
			$insertExpense = [
									'nro_pedido' => $initExpensesInput['nro_pedido'],
									'id_nacionalizacion' => 0,
									'identificacion_proveedor' => 0,
									'concepto' => $value['concepto'],
									'valor_provisionado' => $value['valor'],
									'comentarios' => 'CREADO AUTOMATICAMENTE',
									'fecha' => date('Y-m-d'),
									'id_user' => $this->session->userdata('id_user'),
											];
			$this->db->insert($this->controller, $insertExpense);
		}

		$this->setIsdSecure($initExpensesInput['nro_pedido']);
		
		$this->redirectPage('presentOrder', $initExpensesInput['nro_pedido']);
	}


	/**
	* Coloca los gastos iniciales referentes a Seguro e ISD
	* @param (string) $nroOrder
	* @return boolean
	*/
	private function  setIsdSecure($nroOrder){
		$order = $this->modelorder->get($nroOrder);
		$order = $order[0];
		$order['invoicesOrder'] = $this->modelorder->getInvoices($nroOrder);
		$initExpenses = $this->modelexpenses->get($nroOrder);
		$incoterm = [
							'EXW' => '1',
							'FCA' => '1',
							'FOB' => '0',
							'CFR' => '-1',
								];

		$params = [
				'order' => $order['nro_pedido'],
				'fobVal' => 0.00,
				'invoicesVal' => 0.00,
				'gastos_origen' => 0.00,
				'flete' => 00.00,
				'incoterm' => $order['incoterm'],
							];

		if ($initExpenses == false) {
			return false;
		}

		foreach ($initExpenses as $key => $expense) {
			if ($expense['concepto'] == 'FLETE') {
				$params['flete'] = $expense['valor_provisionado'];	
			}elseif($expense['concepto'] == 'GASTO ORIGEN'){
				$params['gastos_origen'] = $expense['valor_provisionado'];
			}
		}

		if($order['invoicesOrder'] == false){
				return false;
			}

		foreach ($order['invoicesOrder'] as $key => $invoice) {
			$params['invoicesVal'] += $invoice['detailInvoice']['sums']['valueItems'];
		}

		if ($params['incoterm'] == 'CFR'){
			$params['fobVal'] = (( $params['invoicesVal']) + 
									($incoterm[$params['incoterm']] * $params['flete']));
			$isd = (($params['invoicesVal'] + $params['flete']) * 0.05);
		}else{
			$params['fobVal'] = (( $params['invoicesVal']) + 
									($incoterm[$params['incoterm']] * $params['gastos_origen']));
			$isd = ($params['invoicesVal'] * 0.05);
		}

		

		$data = [
				'SEGURO' => ( ( 
												( $params['fobVal']  + $params['flete'])
												 * 2.2) * $this->securePercent),
				'ISD' => $isd,
					];

		$this->db->where('nro_pedido',$nroOrder);
		$this->db->where('concepto','SEGURO');
		$this->db->delete($this->controller);
		$this->db->where('nro_pedido',$nroOrder);
		$this->db->where('concepto','ISD');
		$this->db->delete($this->controller);

		foreach ($data as $key => $value) {
			$data = [
						'nro_pedido' => $nroOrder,
						'id_nacionalizacion' => 0,
						'identificacion_proveedor' => 0,
						'concepto' => $key,
						'valor_provisionado' => $value,
						'comentarios' => 'CREADO AUTOMATICAMENTE',
						'id_user' => $this->session->userdata('id_user'),
						'fecha' => date('Y-m-d'),
							];
			$this->db->insert($this->controller, $data);
		}
		return true;
	}


	/**
	* Establece los gastos iniciales de acuedo a los parametros establecidos 
	* @param (string) $nroOrder
	* @return array | boolean
	*/
	public function putIncoterms($nroOrder){
		if (! isset($nroOrder)){
			$this->redirectPage('ordersList');
			return false;
		}
		$order = $this->modelorder->get($nroOrder);

		if ($order == false){
			$this->redirectPage('ordersList');
			return false;
		}
		$incoterms = $this->getIncoterms($order[0]);
		
		if ($incoterms == false) {
			$this->redirectPage('presentOrder', $nroOrder);
		}

		$id_user = $this->session->userdata('id_user');

		foreach ($incoterms as $key => $value) {
			$initExpense = [
										'nro_pedido' => $nroOrder, 
										'id_nacionalizacion' => 0,
										'identificacion_proveedor' => 0,
										'concepto' => $value['tipo'],
										'valor_provisionado' => $value['tarifa'],
										'comentarios' => 'CREADO AUTOMATICAMENTE',
										'id_user' =>  $id_user,
										'fecha' => date("Y-m-d"),
										];
			$this->db->insert($this->controller, $initExpense);
		}
		$this->redirectPage('presentOrder', $nroOrder);
	}


	/**
	* Reemplaza los incoterms cuando un pedido se edita
	* por el momento siempre los cambia
	*
	* @param string $nroOrder 
	* @return void
	*/
	public function replaceIncoterms($nroOrder){
		if(! isset($nroOrder)){
			$this->redirectPage('ordersList');
			return false;
		}

		$order = $this->modelorder->get($nroOrder);
		$initExpenses = $this->mymodel->getInitialExpenses($nroOrder);

		foreach ($initExpenses as $key => $expense) {

			if (($expense['concepto'] == 'GASTO ORIGEN') ||
						($expense['concepto'] == 'FLETE')
					){
					$this->db->where('id_gastos_nacionalizacion',$expense['id_gastos_nacionalizacion']);
					$this->db->delete($this->controller);
			}
		}
			$this->putIncoterms($nroOrder);
	}


	/**
	* Valida la informacion de registro de un gasto inicial 
	* 
	* @param (array) $_POST gasto_inicial
	* @return (void) | false
	*/
	public function validar(){
		if (!$_POST) {
			$this->redirectPage('ordersList');
		}

		$initExpense = $this->input->post();
		$initExpense['id_user'] = $this->session->userdata('id_user');
		$initExpense['fecha'] = date('Y-m-d' , strtotime($initExpense['fecha']));
		if(isset($initExpense['fecha_fin'])){
			$initExpense['fecha_fin'] = date('Y-m-d' , 
																				strtotime($initExpense['fecha_fin']));
		}

			if(!isset($initExpense['id_gastos_nacionalizacion'])){
				$this->db->where('nro_pedido', $initExpense['nro_pedido']);
				$this->db->where('concepto', $initExpense['concepto']);
				$resultDb = $this->db->get($this->controller);

				if($resultDb->num_rows() == 1 ){		
					$config['orderInvoice'] = $resultDb->result_array();
					$config['viewMessage'] = true;
					$config['message'] = 'Este Gasto Inicial Ya Está Registrado!';
					$this->responseHttp($config);
					return true;
				}	
		}

		$status = $this->validData($initExpense);
		
			if ($status['status']){
				if (!isset($initExpense['id_gastos_nacionalizacion'])){
					$this->db->insert($this->controller, $initExpense);
					$this->redirectPage('presentOrder', $initExpense['nro_pedido']);
					return true;
				}else{					
					$initExpense['last_update'] = date('Y-m-d H:i:s');
					$this->db->where('id_gastos_nacionalizacion', $initExpense['id_gastos_nacionalizacion']);
					$this->db->update($this->controller, $initExpense);
					$this->redirectPage('presentOrder', $initExpense['nro_pedido']);
					return true;
				}
		}else{
			$config['viewMessage'] = true;
			$config['message'] = 'La información de uno de los campos es incorrecta!';
			$config['data'] = $status['columns'];
			$this->responseHttp($config);
			return true;
		}	
	}

	/**
	 * Se validan las columnas que debe tener la consulta para que no falle
	 * @return [array] | [bolean]
	 */
	private function validData($data){
		$columnsLen = array(
        'nro_pedido' => 6,
        'concepto' => 1,
        'valor_provisionado' => 1,
        'id_user' => 1,
        'fecha' => 10,
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}

		/* *
	* Envia la respuestas html al navegador
	*/
	public function responseHttp($config){
		$config['title'] = 'Facturas Pedidos';
		$config['base_url'] = base_url();
		$config['rute_url'] = base_url() . 'index.php/';
		$config['controller'] = $this->controller;
		$config['iconTitle'] = 'fa-cubes';
		$config['content'] = 'home';
		return $this->twig->display($this->template, $config);
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

			//$this->redirectPage('presentOrder', $nroOrder);
		}

		/**
		* Valida y guarda los gastos iniicales de una tabla
		* @param array $_POST
		* return void
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
			$this->redirectPage('presentOrder', $initexpenses[0][0]);
		}


	/**
	* Verifica Los gastos iniciales de una Order, indica al isuario
	* Los parametros que un pedido debe cumplir para que se puedan
	* Generar los gastos iniciales
	* @param (string) $nroOrder
	* @return (array) 
	*/
	public function validOrder(string $nroOrder){			
		$order = $this->modelorder->get($nroOrder);

		if(empty($order) == true){
			$this->redirectPage('ordersList');
			return true;
		}

		$order = $order[0];

		$rateExpenses = $this->modelexpenses->getAllRates($order['regimen']);
		$incoterms = $this->getIncoterms($order);
		$invoicesOrder = $this->modelorder->getInvoices($nroOrder);
		$initExpenses = $this->mymodel->getInitialExpenses($nroOrder);
		$minimal = $this->validMinimalIE($initExpenses, $rateExpenses, $order);
		
		$sumInvoices = 0.00;
		$totalOrder = 0.00;

		if($invoicesOrder){
			foreach ($invoicesOrder as $key => $invoice) {
				$totalOrder += floatval($invoice['valor']);
				$sumInvoices += floatval($invoice['detailInvoice']['sums']['valueItems'])	;
			}
		}
		$statusInvoces = false;

		if ($totalOrder == $sumInvoices) {
			$statusInvoces = $sumInvoices;
		}

		$minimal['total_pedido'] = $statusInvoces;



		$config = [
						'validateExpenses' => true,
						'titleContent' => 'Generar Gastos Iniciales Pedido: [' . 
														$nroOrder . '] <small>Validar Información</small>',
						'rateExpenses' => $rateExpenses, 
						'incoterms' => $incoterms,
						'invoicesOrder' => $invoicesOrder,
						'initExpenses' => $initExpenses,
						'order' => $order,
						'minimal' => $minimal,
							];
		$this->responseHttp($config);
	}	



	/**
		* Valida los datos minimos que debe cumplir un pedido, Verifica los gastos
		* iniciales que ya tiene un pedido registrado y lo compara con los que
		* deben estar registrados en el pedido
		* 
		* @param (array) $minimal campos minimos requeridos
		* @param (array) $initExpenses Gastos iniciales regisrados
 		* @param (array) $orden
		* 
		*/
		private function validMinimalIE($initExpenses, $rateExpenses ,$order){

			$minimal = [
					'have_flete' => false,
					'have_gasto_origen' => false,
					'flete' => false,
					'gasto_origen' => false,
					'fecha_arribo' =>  $order['fecha_arribo'],
					'dias_libres' => $order['dias_libres'],
								];

			$incotermsParams = [
				'EXW' => [
								'flete' => true,
								'gasto_origen' => true,
									],
				'FCA' => [
								'flete' => true,
								'gasto_origen' => true,
									],
				'FOB' => [
								'flete' => true,
								'gasto_origen' => false,
								],
				'CFR' => [
								'flete' => false,
								'gasto_origen' => true,
									],
							];

			foreach ($incotermsParams as $key => $value) {
				if($key == $order['incoterm']){
					$minimal['have_flete'] = $value['flete'];
					$minimal['have_gasto_origen'] = $value['gasto_origen'];
				}
			}	

			if ($initExpenses == false) {
				return $minimal;
			}

			foreach ($rateExpenses as $key => $value) {
				$expense = str_replace(' ', '_', strtolower($value['concepto']));
				$pos = strpos($expense, '_');
				if ($pos > 0) {
					$pos = strpos($expense, '_', $pos + 1);
					if($pos == false){
					$minimal[$expense] = false;		
				}else{
					$expense = substr($expense, 0, $pos);
				}
				}
				$minimal[$expense] = false;					
			}

			foreach ($initExpenses as $key => $value) {
				$expense = str_replace(' ', '_', strtolower($value['concepto']));
				$pos = strpos($expense, '_');
				if ($pos > 0) {
					$pos = strpos($expense, '_', $pos + 1);
					if($pos == false){
					$minimal[$expense] = $value['valor_provisionado'];
				}else{
					$expense = substr($expense, 0, $pos);
				}
				}
				$minimal[$expense] = $value['valor_provisionado'];
			}

			unset($minimal['otros_gastos']);

			$minimal['complete'] = true;

			foreach ($minimal as $key => $value) {
				if ($value == false ){
					$minimal['complete'] = false;
					break;
				}
			}

			return $minimal;
		}
		/**
		* retorna los valores de FOB y Gastos en Origen para la provision en un 
		* pedido 
		*/
		public function getIncoterms($order){
			$intcotermsParams = [
										'pais_origen' => $order['pais_origen'],
										'ciudad_origen' => $order['ciudad_origen'],
										'incoterms' => $order['incoterm']
													];
			$incoterms = $this->modelexpenses->getIncotermsParams($intcotermsParams);

			return $incoterms;			
		}

}