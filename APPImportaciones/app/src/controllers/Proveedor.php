<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Modulo encargado de manejar a los proveedores
*
* @package	CordovezApp
* @author	Eduardo Villota <eduardouio7@gmail.com>
* @copyright	Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
* @license	Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
* @link	https://github.com/eduardouio/APPImportaciones
* @since	Version 1.0.0
* @filesource
*/
class Proveedor extends CI_Controller {

	public function index()
	{
		$this->load->library('twig');
		$data['title'] = "Proveedor";
		$data['iconTitle'] = "fa-group";
		$data['titleContent'] = "Registro de Proveedor";
		$data['controller'] = "proveedor";
		$data['actionFrm'] =  "/validateForm";
		$this->twig->display('/pages/pageProveedor.html', $data);

	}
}
