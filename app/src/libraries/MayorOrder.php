<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Realiza la comprobacion con el mayor de los gastos de nacionalizacion
 *
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @version 1.0
 * @copyright 2018 Representaciones Cordovez
 * @license Representaciones Cordovez
 * @package Controllers
 */
class MayorOrder {
    private $order;
    private $parcials;
    private $order_invoices;
    private $expenses;
    
    function __construct(
        array $order, 
        array $order_invoices,
        array $expenses, 
        array $parcials
        )
    {
        
        
    }
    
    
    /**
     * Retorna los datos del mayor
     */
    public function get() :array{
        
    }
        
}