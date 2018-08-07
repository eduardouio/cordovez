<?php 
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Obtiene toda la informacion de un pedido
 * Como el saldo y los parciales de ser el caso
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2017, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource Source
 */
class resumeOrder
{
    
    private $order;
    private $parcials;
    private $order_invoices;
    private $init_expenses;
    private $paids_init_expenses;
    private $paids_partial_expenses;
    private $tipo_cambio = 0.0;
    private $moneda;
    
    /**
     * Constructor de la clase
     * 
     * @param array $resumeOrder
     */
    function __construct(
                        array $resumeOrder
        )
    {
        $this->order = $resumeOrder['order'];
        $this->order_invoices = $resumeOrder['order_invoices'];
        $this->parcials = $resumeOrder['parcials'];
        $this->init_expenses = $resumeOrder['init_expenses'];
        $this->paids_init_expenses = $resumeOrder['paids'];
    }
    
    
    /**
     * Retorna los valores del pedido, valore de facturas y saldos
     * Valores Cif
     * 
     *  @return array | bool
     */
    public function getValuesOrder(){
        
        $cif_inicial = $this->getInitialValues();
        $cif_gastado = $this->getNationalizedValues();
        
        return ([
           'cif_inicial' => $cif_inicial,
           'cif_gastado' => $cif_gastado,
           'cif_actual' => $this->getcurrentValues($cif_inicial, $cif_gastado)
        ]);
    }
    
    
    
    
    /**
     * Calcula el cif actual de un pedido
     * 
     * @param array $cif_inicial
     * @param array $cif_gastado
     */
    private function getcurrentValues(array $cif_inicial, array $cif_gastado){
        if($this->order['regimen'] == 10  ){
            return False;
        }
        
        return ([
            'seguro_aduana' => (
                $cif_inicial['seguro_aduana_inicial'] -
                $cif_gastado['seguro_aduana_gastado']
                ),
            'flete_aduana' =>  (
                $cif_inicial['flete_aduana_incial'] -
                $cif_gastado['flete_aduana_gastado']
                ),
            'fob' => (
                $cif_inicial['fob_inicial'] - 
                $cif_gastado['fob_gastado']
                ),
            'tipo_cambio' => $this->tipo_cambio,
            'moneda' => $this->moneda,
            'cif' => (
                $cif_inicial['cif_inicial'] -
                $cif_gastado['cif_gastado']
                ),
        ]);
        
    }
    
    
    
    /**
     * Obtiene los valores del Cif que han sido nacionalizados, en caso de moneda
     * ectrangera multiplica por el tipo de cambio inicial para que 
     * no descuadren los valores
     *
     * @return array
     */
    private function getNationalizedValues(){
        if($this->order['regimen'] == 10  ){
            return False;
        }
        
        $fob_gastado = 0.0;
        $seguro_gastado = 0.0;
        $flete_gastado = 0.0;
                
        foreach ($this->parcials['parcials'] as $idx => $parcial){
            if ($parcial['bg_isliquidated'] == 1){
                foreach ($parcial['detail'] as $id => $invoice){
                    $fob_gastado += $invoice['valor'];
                    $seguro_gastado += $invoice['seguro_aduana'];
                    $flete_gastado += $invoice['flete_aduana'];
                }                
            }
        }
        
        $cif_gastado = (
            ($fob_gastado * $this->tipo_cambio)
            +
            ($flete_gastado + $seguro_gastado)
            );
        
        return ([
            'seguro_aduana_gastado' => $seguro_gastado,
            'flete_aduana_gastado' =>  $flete_gastado,
            'fob_gastado' => $fob_gastado,
            'tipo_cambio' => $this->tipo_cambio,
            'moneda' => $this->moneda,
            'cif_gastado' => $cif_gastado,
        ]);
        
        
    }
    
    
    /**
     * Retorna el stock inicial del pedido
     * 
     * @return array
     */
    private function getInitialValues():array {
        if($this->order_invoices == False){
            return False;
        }
        
        $fob_inicial = 0.0;
        
        foreach ($this->order_invoices as $idx => $invoice){
           $sums = $invoice['detailInvoice']['sums'];
           $fob_inicial += $sums['valueItems'];
           
           if($this->tipo_cambio == 0.0){
               $this->tipo_cambio = $sums['tasa_change'];
               $this->moneda = $sums['money'];
           }
        }
        
        $cif_inicial =  (
            ($this->tipo_cambio * $fob_inicial) 
            +
            ($this->order['flete_aduana'] + $this->order['seguro_aduana'])
            );
        
        return ([
            'seguro_aduana_inicial' => $this->order['seguro_aduana'],
            'flete_aduana_incial' =>  $this->order['flete_aduana'],
            'fob_inicial' => $fob_inicial,
            'tipo_cambio' => $this->tipo_cambio,
            'moneda' => $this->moneda,
            'cif_inicial' => $cif_inicial,
        ]);
    }
   
}

