<? php  if( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_orders') ){

	function get_orders(string $nroOrder):array{
		$result =  $this->db->get('pedido');
		print 'Me estoy ejecuntando desde el helper'
		return $result;
	}

}