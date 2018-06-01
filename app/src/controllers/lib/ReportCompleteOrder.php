<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Indica el estado de un pedido R70, para saber si se puede hacer una nuevo
 * paricial
 *
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @version 1.0
 * @copyright 2018 Representaciones Cordovez
 * @license Representaciones Cordovez
 * @package Controllers
 */    
class ReportCompleteOrder{
    private $order;
    private $order_invoices;
    private $products;
    private $paids_order;
    private $parcials;
    private $init_expenses;
    
    /**
     * Constructor de la clase
     * @param array $order
     * @param array|bool $order_invoices
     * @param array|bool $info_invoices
     */
    function __construct(
        array $params
        )
    {
        $this->order =  $params['order'];
        $this->order_invoices =  $params['order_invoices'];
        $this->products =  $params['products'];
        $this->init_expenses =  $params['init_expenses'];
        $this->paids_order =  $params['paids_order'];
        if ($this->order['regimen'] != 10){
            $this->parcials =  $params['partials'];            
        }
    }
    
    
    /**
     * Rertorna el estado del pedido
     */
    public function getStatusData(){
        
        return([
            'have_open_parcial' => $this->checkPartials(),
        ]);
    }
    
    /**
     * Comprueba si existe un parcial Abierto
     * @return bool
     */
    private function checkPartials():bool
    {   
        
        if ($this->order['regimen'] == 10){
            return False;
        }
        
        foreach ($this->parcials as $idx => $parcial){
            if (
                $parcial['bg_isliquidated'] == 0
                )
            {
                return True;       
            }
        }
        return False;
    }
}
    