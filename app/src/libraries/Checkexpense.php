<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Comprueba un gasto de nacionalizacion y sus pagos
 *
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @version 1.0
 * @copyright 2018 Representaciones Cordovez
 * @license Representaciones Cordovez
 * @package Controllers
 */
class Checkexpense
{
    private $espense;
    private $paids;

    /**
     * Inicia la clase con la provision y pagos
     * @param array $expense
     * @param array $paids
     */
    function __construct(array $expense, $paids){
        $this->expsense = $expense;
        $this->paids = $paids;
    }
    
    
    /**
     * Retorna el arreglo con la informacion de la provision
     */
    public function getData(){
        
        
        return ([
            'expense' => $this->espense,    
        ]);
    }
    
}