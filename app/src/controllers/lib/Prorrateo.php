<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Calcula los prorrateos de para cada uno de los parciales
 * 
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @version 1.0
 * @copyright 2018 Representaciones Cordovez
 * @license Representaciones Cordovez
 * @package Controllers
 */
class Prorrateo {    
      
    private $parcialParams;
    /**
     * Funcion costructora de la case 
     *  
     */
    public function __construct($parcialParams){
       $this->parcialParams = $parcialParams;
    }
    
    
    /**
     * Obtiene los valores de prorrateo para el calculo de impuestos
     * 
     * @return array
     */
    public function getValues() : array
    {   
        
        $fobsParcial = $this->getFobParcialAndFobOrder(
            $this->parcialParams['orderInvoices'],
            $this->parcialParams['infoInvoices']
            );
        
        $insuranceFreight = $this->getInsuranceAndFreight( 
                $this->parcialParams['order'],
                $fobsParcial['porcentaje_parcial']
            );
                
        $warenhoses = $this->getWarenhouses(
            $this->parcialParams['lastProrrateo'],
            $this->parcialParams['parcialExpenses'],
            $fobsParcial['porcentaje_parcial']
            );
                
        return([
            'id_parcial' => $this->parcialParams['parcial']['id_parcial'],
            'fob_parcial' => $fobsParcial['fob_parcial'],
            'porcentaje_parcial' => $fobsParcial['porcentaje_parcial'],
            
            'prorrateo_flete_aduana' => 
                                    $insuranceFreight['prorrateo_flete_aduana'],
            'prorrateo_seguro_aduana' => 
                                   $insuranceFreight['prorrateo_seguro_aduana'],
            
            'bodegaje_parcial' => $warenhoses['bodegaje_parcial'],
            'porcentaje_sumado' => $warenhoses['porcentaje_sumado'],
            'bodegaje_prorrateado' => $warenhoses['bodegaje_prorrateo'],
            
            'saldo_bodega_proximo_parcial' => 
                                    $warenhoses['saldo_bodega_proximo_parcial'],
            
            'details' => $this->getProrrateoDetail( 
                                    $this->parcialParams['initExpenses'],
                                    $this->parcialParams['parcialExpenses'],
                                    $fobsParcial['porcentaje_parcial']
                                                  ), 
        ]);
    }
    
    
    /**
     * Calcula los valores de 
     * 
     * @param array $initExpenses
     * @param array $parcialExpenses
     * @param float $parcialPercent
     * @return array
     */
    private function getProrrateoDetail(
                                        array $initExpenses,
                                        array $parcialExpenses,
                                        float $parcialPercent
        ): array
    {
        $parcialExpensesWithoutWarenhouse = [];
        
        foreach ($parcialExpenses as $item => $expenses)
        {
            array_push(
                $parcialExpensesWithoutWarenhouse,
                [
                    'id_gastos_nacionalizacion' => 
                                    $expenses['id_gastos_nacionalizacion'],
                    
                    'valor_prorrateado' => $expenses['valor_provisionado'],
                    'concepto' => $expenses['concepto'],
                    'tipo' => 'prorrateo',
                ]
                );
        }
        
        foreach ($initExpenses as $item => $expenses)
        {
            array_push(
                $parcialExpensesWithoutWarenhouse,
                [
                    'id_gastos_nacionalizacion' => 
                                         $expenses['id_gastos_nacionalizacion'],
                    'valor_prorrateado' => (
                                             $expenses['valor_provisionado'] *
                                             $parcialPercent
                                            ),
                    'concepto' => $expenses['concepto'],
                    'tipo' => 'gasto_inicial',
                ]
                );
        }
        
        return $parcialExpensesWithoutWarenhouse;
    }
    
    
    
    /**
     * Retorna el costo por bodegaje del parcial, y el saldo para el proximo 
     * parcial
     * 
     * @param array $lastProrrateo
     * @param array $parcialExpenses
     * @param float $parcialPercent
     * @return array
     */
    private function getWarenhouses(
                                    $lastProrrateo, 
                                    array $parcialExpenses, 
                                    float $parcialPercent
        ): array
    {
        
        $warenhoseParcial = 0.0;
        
        foreach ($parcialExpenses as $item => $expense)
        {
            if( preg_match('/[a-zA-Z]-[0-9]/' , $expense['concepto'] ) )
            {
             $warenhoseParcial += $expense['valor_provisionado'];   
            }
        }
        
        $last_warenhouse = 0.0;
        $sum_percent = $parcialPercent;
        
        if($lastProrrateo){
            $last_warenhouse = $lastProrrateo['saldo_bodega_proximo_parcial'];
            $sum_percent = (
                             $lastProrrateo['porcentaje_sumado'] 
                             + 
                             $parcialPercent
                            );
        }
        
        $curren_warenhouse = (
                                ($last_warenhouse + $warenhoseParcial) 
                                * $sum_percent
                               );
        
        $next_warenhose =   (
                                ($last_warenhouse + $warenhoseParcial)
                                - $curren_warenhouse
                             );
        
        return([
            'bodegaje_parcial' => $warenhoseParcial,
            'bodegaje_prorrateo' => $curren_warenhouse,
            'porcentaje_sumado' => $sum_percent,
            'saldo_bodega_proximo_parcial' => $next_warenhose,
        ]);
    }
    
    
    
    /**
     * Retorna lo os prorrateos del seguro y del flee
     *
     * @param array $order
     * @param array $lastParcial
     */
    private function getInsuranceAndFreight(
                                            array $order, 
                                            float $percentParcial
        ) : array
    {
        return [
            'prorrateo_seguro_aduana' => 
                                      $order['seguro_aduana'] * $percentParcial,
            
            'prorrateo_flete_aduana' => 
                                       $order['flete_aduana'] * $percentParcial,
        ];
    }
    
    
    /**
     * Obtiene el valor del parcial, del pedido y de la relacion que
     * eciste entre el parcial y el Fob total
     * 
     * @param array $orderInvoices
     * @param array $infoInvoices
     */
    private function getFobParcialAndFobOrder( 
        array $orderInvoices,
        array $infoInvoices
            )
    {
        $fobParcial = 0.0;
        $fobInitial = 0.0;
        
        foreach($orderInvoices as $item => $invoice)
        {
            $fobInitial += $invoice['valor'];
        }
        
        foreach ($infoInvoices as $item => $invoice)
        {
            $fobParcial += $invoice['valor'];
        }
        
        return [
            'porcentaje_parcial' => ( $fobParcial / $fobInitial ),
            'fob_parcial' => $fobParcial,
            
        ];
    }
}