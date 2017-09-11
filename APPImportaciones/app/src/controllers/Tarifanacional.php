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
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Detallepedido extends MY_Controller {
	private $resultDb;
	private $controllerSPA = "detalle_pedido_factura";
	private $responseHTTP = array("status" => "success");

  /**
   * retorna una lista completa de los $controllerSPA sino existe registros
   * retorna status 200 y una lista vacia
   * @return array JSON
   */
  public function listar(){

  }

  /**
   *  Valida los datos recibidos por post antes de crear o actualizar el
   * registro, solo aceptan datos por post
   * @return array JSON
   */
	public function validar(){
    if($this->rest->_getRequestMethod()!= 'POST'){
      $this->_notAuthorized();
    }

	}

  /**
   * Elimina un registro de la tabla, se verifica que exista y que no tenga
   * dependencias
   * @return array JSON
   */
	public function eliminar(){
    if($this->rest->_getRequestMethod()!= 'POST'){
			$this->_notAuthorized();
		}

	}

	/**
	 * se validan los datos que deben estar para que la consulta no falle
	 * @return [array] | [bolean]
	 */
	private function _validData($pedido){
		$columnsLen = array(
			'id_user' => 1,
		);
		return $this->_checkColumnsData($columnsLen, $pedido);
	}

}
