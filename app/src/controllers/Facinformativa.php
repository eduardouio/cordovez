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
class Facinformativa extends MY_Controller {
	private $controller = "factura_informativa";
	private $template = '/pages/pageFactutaInformativa.html';	
	private $almaceneraId = '0990304262001';
	private $modelOrder;
	private $modelUser;
	private $modelSupplier;
	private $modelInfoinvoice;

	/**
	 * Constructor de la funcion
	 */
	public function __construct()
	{
		parent::__construct();
		$this->init();
	}
	
	/**
     * Carga los modelos a usar en la clase
     * @return void 
	 */
	private function init()
	{
	    $this->load->model('modelorder');
	    $this->load->model('modeluser');
	    $this->load->model('modelsupplier');
	    $this->load->model('modelinfoinvoice');
	    $this->modelOrder = new Modelorder();
	    $this->modelUser = new Modeluser();
	    $this->modelSupplier = new Modelsupplier();
	    $this->modelInfoInvoice = new Modelinfoinvoice();
	}
	    

    /**
     * Redirecciona a la lista de pedidos
     */
	public function index(){
		$this->redirectPage('ordersList');
		return true;
	}

	/**
	* Presenta el formulario para registrar una nueva factura informativa
	* @param (string) $nroOrder 
	* @return viod 
	*/
	public function nuevo($nroOrder){
		$order = $this->modelOrder->get($nroOrder);
		if($order == false){
		    $this->redirectPage('ordersList');
		    return false;
		}
		
        $this->responseHttp([
            'create_invoice' => true,
            'order' => $order,
            'invoicesOrder' => $this->modelOrder->getInvoices($nroOrder),
            'infoInvoices' => $this->modelinfoinvoice->get($nroOrder),
            'supplier' =>  $this->modelsupplier->get($this->almaceneraId),
            'haveEuros' => $this->orderHaveEuros($nroOrder),
            'titleContent' => 'Ingreso de Factura Informativa Pedido: ['.
                                                                $nroOrder . ']',
            'user' => $this->modelUser->get($order['id_user']),
            'warehouseDays' => warehouseDays($order),
                        ]);
	}


	/**
	* Valida y gusrada una factura informativa si no existe redirecciona a pedidos
	* @param (array) $inputdata
	* @return void
	*/
	public function validar(){
		if(!$_POST){
			$this->redirectPage('ordersList');
		}

		$infoInvoice = $this->input->post();
		$infoInvoice['fecha_emision'] = date('Y-m-d', strtotime(
																								$infoInvoice['fecha_emision']));
		$infoInvoice['id_user'] = $this->session->userdata('id_user');
		$status = $this->validData($infoInvoice);
		if ($status['status']) {
			if(isset($infoInvoice['id_factura_informativa'])){
				$this->db->where('id_factura_informativa', 
																				$infoInvoice['id_factura_informativa']);
				$infoInvoice['last_update'] = date('Y-md');
				print 'actualizar';
			}else{
			if($this->db->insert($this->controller, $infoInvoice)){
				$this->redirectPage('presentOrder', $infoInvoice['nro_pedido']);
			}else{
				print 'algo salio mal';
				print_r($this->mymodel->lastInfo());
			}	
				
			}
		}else{
			$this->responseHttp(
				[
						'viewMessage' => 'true',
						'message' => 'La información de uno de los campos es incorrecta!.',
						'data' => $status['columns'],
						'invoice' => $infoInvoice,
								]
			);
		}
	}


	/**
	* Verifica si el pedido tiene una factura en euros
	* @param $nroOrder => Numero de la orden
	* @return boolean
	*/
	private function orderHaveEuros($nroOrder){
		$invoicesOrder = $this->modelOrder->getInvoices($nroOrder);
		foreach ($invoicesOrder as $key => $value) {
			if($value['moneda'] != 'DOLARES'){
				return ([
						'euros' => true,
						'tipo_cambio' => $value['tipo_cambio'],
							]);
			}
		}
		return false;
	}



	/**
	 * Se validan las columnas que debe tener la consulta para que no falle
	 * @return [array] | [bolean]
	 */
	private function validData($data){
		$columnsLen = array(
					'nro_factura_informativa' => 2,
					'nro_pedido' => 6,
					'identificacion_proveedor' => 13,
					'flete_aduana' => 1,
					'fecha_emision' => 10,
					'seguro_aduana' => 1,
					'id_user' => 1,
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}


		/* *
	* Envia la respuestas html al navegador
	*/
	public function responseHttp($config){
		$config['base_url'] = base_url();
		$config['title'] = 'Factura Informativa';
		$config['rute_url'] = base_url() . 'index.php/';
		$config['controller'] = $this->controller;
		$config['iconTitle'] = 'fa-file';
		$config['content'] = 'home';
		return $this->twig->display($this->template, $config);
	}
}
