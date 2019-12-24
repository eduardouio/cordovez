<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modulo encargado de manejar los pedidos, CRUD y de los detalles de
 *las facturas de los pedidos
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones http://google.com
 * @since    Version 1.0.0
 * @filesource
 */
class Detallepedido extends MY_Controller 
{
	private $controller= "detalle_pedido_factura";
	private $template = '/pages/pagePedidoFacturaDetalle.html';
	private $modelSupplier;
	private $modelUser;
	private $modelProduct;
	private $modelOrderInvoiceDetail;
	private $modelOrderInvoice;
	private $modelOrder;
	private $modelLog;

	/**
	 * Constructor de la funcion
	 */
	public function __construct(){
		parent::__construct();
		$this->init();
	}
	
	
	/**
	 * Carga los modelos inciales para la clase
	 */
	private function init(){
	    if(! isset($this->session->userdata['id_user'])){
	        exit(0);
	    }
	    
	    $this->load->model('modelsupplier');
	    $this->load->model('modeluser');
	    $this->load->model('modelproduct');
	    $this->load->model('modelorderinvoicedetail');
	    $this->load->model('modelorderinvoice');
	    $this->load->model('modelorder');
	    $this->load->model('modellog');
	    $this->modelSupplier = new Modelsupplier();
	    $this->modelUser = new Modeluser();
	    $this->modelProduct = new Modelproduct();
	    $this->modelOrderInvoiceDetail = new Modelorderinvoicedetail();
	    $this->modelOrderInvoice = new Modelorderinvoice();
	    $this->modelOrder = new Modelorder();
	    $this->modelLog = new Modellog();
	}


	/**
	* Redirecciona a la lista de pedidos
	*/
	public function index(){
		$this->redirectPage('ordersList');
		return true;
	}

	/**
	* Muestra el formulario para registrar un nuevo producto en el 
	* Detalle de un pedido
	* @param int $idInvoice Identificador Factura AI
	* @return string template | boolean
	*/
	public function nuevo($idInvoiceOrder){
		$invoiceOrder = $this->modelOrderInvoice->get($idInvoiceOrder);
		if($invoiceOrder == false){
		    $this->index();
		    return false;
		}
		$products = $this->modelProduct->getBySupplier($invoiceOrder['identificacion_proveedor']);
		$supplier = $this->modelSupplier->get($invoiceOrder['identificacion_proveedor']);
		$this->responseHttp([
		    'title' => 'Registro de nuevo producto para Factura [ ' . $invoiceOrder['id_factura_proveedor'],
		    'titleContent' => 'Registro de nuevo producto para Factura [ ' . $invoiceOrder['id_factura_proveedor']  . 
		                      ' ] de [ ' . $supplier['nombre']  .' ] Pedido [ ' . $invoiceOrder['nro_pedido'] .
		                      ' ]',
            'create' => true,
            'products' => $products,
            'productsarray' => json_encode($products),
            'invoice' => $invoiceOrder,
			'supplier' => $supplier,
        ]);
	}
	
	
	/**
	 * Actualiza los pesos de los items de las facturas
	 *
	 * @param int $id_order_invoice
	 * @return bool redirect presentar 
	 */
	public function ActualizarPeso(int $id_order_invoice){
	    if(!$_POST){
	        $order_invoice = $this->modelOrderInvoice->get($id_order_invoice);
	        $order_invoice_details = $this->modelOrderInvoiceDetail->getByOrderInvoice($id_order_invoice);
	        $order = $this->modelOrder->get($order_invoice['nro_pedido']);
	        $supplier = $this->modelSupplier->get($order_invoice['identificacion_proveedor']);
	        
	        foreach ($order_invoice_details as $k => $item){
	            $product = $this->modelProduct->get($item['cod_contable']);
	            $order_invoice_details[$k]['product'] = $product['nombre'];
	            $order_invoice_details[$k]['cantidad_x_caja'] = $product['cantidad_x_caja'];
	            $order_invoice_details[$k]['unidades'] = $product['cantidad_x_caja'] * $item['nro_cajas'];            
	        }        
	        
	        return ($this->responseHttp([
	            'title' => 'Actualizar Pesos Items',
	            'titleContent' => 'Actualizando Pesos de Factura N '  . 
	                               $order_invoice['id_factura_proveedor'] . ' de ' .  
	                               $supplier['nombre']  . ' Pedido [' . 
	                               $order['nro_pedido']  . ']',
	            'edit_weigth' => true,
	            'order' => $order,
	            'order_details' => $order_invoice_details,
				'order_invoice' => $order_invoice,      
	        ])
	            );
	    
	    }else{
	        $order = $_POST['nro_pedido'];
	        unset($_POST['nro_pedido']);
	        foreach ($_POST as $idx => $w){
	            $this->modelOrderInvoiceDetail->update([
	                'detalle_pedido_factura' => $idx,
	                'peso' =>  $w,
	            ]);	            
	        }
	        $this->redirectPage('presentOrder', $order);        
	    }
	}


	/**
	* Prepara el formulario con la informacion del 
	* detalle de la factura para la edicion
	* @param int $idDetailOrderInvoice identificador factura
	* @return string | boolean
	*/
	public function editar($idDetailOrderInvoice){
	    $detailInvoiceOrder = $this->modelOrderInvoiceDetail->get($idDetailOrderInvoice);
	    if ($detailInvoiceOrder == false){
	        $this->index();
	        return true;
	    }
	    $invoiceOrer = $this->modelOrderInvoice->get($detailInvoiceOrder['id_pedido_factura']);
	    $product = $this->modelProduct->get($detailInvoiceOrder['cod_contable']);
	    
	    $this->responseHttp([
	        'title' => 'Modificar Producto [ ' . $product['nombre'] . ']',
	        'titleContent' => 'Modificar Producto [ ' . $product['nombre'] . ' ] de la Factura [ ' . 
	                           $invoiceOrer['id_factura_proveedor'] . '] Pedido ['. $invoiceOrer['nro_pedido'] .']',
	        'edit' => true,
	        'detailInvoiceOrder' => $detailInvoiceOrder,
	        'invoiceOrder' => $invoiceOrer ,
			'product' => $product,
	    ]);
	}

	
	/**	
	* Intenta eliminar el detalle de una factura
	* @param int $idDetailInvoiceOrder identificador del detalle
	* @return boolean | redirect
	*/
	public function eliminar($idorderInvoiceDetail){
	    $detailOrderInvoice = $this->modelOrderInvoiceDetail->get($idorderInvoiceDetail);
	    if ($detailOrderInvoice == false){
	        $this->index();
	        return false;
	    }
	    if($this->modelOrderInvoiceDetail->delete($idorderInvoiceDetail)){
	        return ($this->redirectPage('orderInvoicePresent', $detailOrderInvoice['id_pedido_factura']));
        }

        return($this->responseHttp([
            'title' => 'Error en validación de datos',
            'orderDetail' => $detailOrderInvoice,
            'viewMessage' => true,
			'message' => 'No se puede eliminar el registro',
        ]));
	}


	/**
	* Valida la informacion recibida por Post Actualiza o crea un registro
	* @param array $_POST
	* @return array template html
	*/
	public function validar(){
	    
	    if(!$_POST){
	       $this->index();
	       return false;
	    }
	    
		$invoiceOrderDetail =  $this->input->post();
		$invoiceOrderDetail['id_user'] = $this->session->userdata('id_user');
   
	    $status = $this->_validData($invoiceOrderDetail);
	    
	    if ($status['status']){
	        $this->updateProduct($invoiceOrderDetail);
	        
			if (!isset($invoiceOrderDetail['detalle_pedido_factura'])){
			    $lastId = $this->modelOrderInvoiceDetail->create(
                         $invoiceOrderDetail
                     );
			    
			    return($this->redirectPage(
			            'orderInvoicePresent', 
			            $invoiceOrderDetail['id_pedido_factura']
			           ));
			    
			}else{
				$invoiceOrderDetail['last_update'] = date('Y-m-d H:i:s');
				$this->modelOrderInvoiceDetail->update($invoiceOrderDetail);
				
				return($this->redirectPage(
    				    'orderInvoicePresent', 
    				    $invoiceOrderDetail['id_pedido_factura']
				    ));
				}
		}else{
			return($this->responseHttp([
			    'title' => 'Error en validación de datos',
			    'titleContent' => 'Error en uno de los campos',
			    'viewMessage' => true,
			    'message' => 'La información de uno de los campos es incorrecta!',
				'data' => $status['columns'],
			]));
		}	
	}

    
	
	/**
	 * Actualiza el costo del producto cuando este tiene un costo diferente 
	 * 
	 * @param array $invoideDetail
	 */
	private function  updateProduct(array $invoideDetail)
	{
	    $product = $this->modelProduct->get($invoideDetail['cod_contable']);
	    if( 
	        $product &&
	        $product['costo_caja'] != $invoideDetail['costo_caja']
	       )
	    {
	        $product['costo_caja'] = $invoideDetail['costo_caja'];
	        $this->modelProduct->update($product);
	    }
	}
	
	
	/**
	 * se validan los datos que deben estar para que la consulta no falle
	 * @return [array] | [bolean]
	 */
	private function _validData($data){
		$columnsLen = array(
			'id_pedido_factura' => 1,
			'cod_contable' =>  20,
			'nro_cajas' => 1,
			'costo_caja' => 1,
			'id_user' => 1
		);
		return $this->_checkColumnsData($columnsLen, $data);
	}


	/* *
	* Envia la respuestas html al navegador
	*/
	public function responseHttp($config){
		$config['base_url'] = base_url();
		$config['rute_url'] = base_url() . 'index.php/';
		$config['controller'] = $this->controller;
		$config['iconTitle'] = 'fa-cube';
		$config['content'] = 'home';
		$config['enterprise'] = $GLOBALS['selected_enterprise'];
		return $this->twig->display($this->template, $config);
	}

}
