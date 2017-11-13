<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Arma los datos para los parametros de gastos iniciales
 * de datos
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modelexpenses extends CI_Model {
	private $table = 'gastos_nacionalizacion';

	function __construct(){
		parent::__construct();
	}


	/**
	* Obtiene todos los gastos iniciales que se pueden aplicar a un pedido
	*
	* @param (str) $regimen 
	* @return array | bool
	*/
	public function getAllRates($regimen){
		$regExclude = '';
		($regimen == '70') ? $regExclude = '10' : $regExclude = '70';
		$rateExpenses = $this->modelbase->get_table([
													'table' => 'tarifa_gastos',
													'where' => [ 
																			'tipo_gasto' => 'GASTO INICIAL',
																			
																			],
													'notwhere' => ['regimen' => 'R' . $regExclude],
													'orderby' => [
																			'concepto' => 'ASC',
																			],
																]);
		if(empty($rateExpenses)){
			return false;
		}
		
	$result = [];

	foreach ($rateExpenses as $key => $value) {
		$supplier = $this->modelbase->get_table([
																				'table' => 'proveedor',
																				'where' => [
																						'identificacion_proveedor' => 
																						$value['identificacion_proveedor'],
																									],
																						]);
		$value['nombre'] = $supplier[0]['nombre'];
		$result[$key] = $value;
	}

		return $result;
	}


	/**
	* Retorna los incoterms en de un pedido, en base a su registro
	* 
	* @param (array) $incoterm 
	* @return array | bool
	*/
	public function getIncotermsParams($incoterms){
			$incoterms = $this->modelbase->get_table([
																'table' => 'tarifa_incoterm',
																'where' => [
																	'incoterms' => $incoterms['incoterms'],
																	'pais'=> $incoterms['pais_origen'],
																	'ciudad'=> $incoterms['ciudad_origen'],
																							],
																]);
			return $incoterms;
	}

	/**
	* Retorna los gastos iniciales de un pedido
	* @param (string) $nroOrder
	* @return array | boolean
	*/
	public function get($nroOrder){
		$initExpenses = $this->modelbase->get_table([
																					'table'	=> $this->table,
																					'where' => [
																									'nro_pedido' => $nroOrder,
																										],
																								]);
		if ($initExpenses == false) {
			return false;
		}

		if( count($initExpenses) == 1){
			$initExpenses = $initExpenses[0];
		}

		return $initExpenses;
	}

}