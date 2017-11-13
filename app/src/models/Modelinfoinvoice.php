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

class Modelinfoinvoice extends CI_Model {
	private $table = 'factura_informativa';

	/**
	* Constructor de la clase
	*/
	public function __construct(){
		parent::__construct();
	}	


	/**
	* Obtiene un listado de las facturas informativas de un pedido, sino hay
	* registros retorna falso
	* @param (string) $nroOrder
	* @return array | boolean
	*/
	public function get($nroOrder){
		$order = 	$this->modelorder->get($nroOrder);

	if($order == false){
		return false;
	}

	$order = $order[0];

	$order['invoicesOrder'] = $this->modelorder->getInvoices($nroOrder);

	print '<pre>'	;
	print_r($order);

	}
}