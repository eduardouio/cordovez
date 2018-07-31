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
    
    private $init_data;
    private $type_change_invoice;
    
    /**
     * Funcion costructora de la case
     *
     */
    public function __construct($init_data){
        $this->init_data = $init_data;
        $this->setConfiguration();
        
    }
    
    
    /**
     * Obtiene los valores de prorrateo para el calculo de impuestos
     *
     * @return array
     */
    public function getValues() : array
    {
        $fobsParcial = $this->getFobParcialAndFobOrder();
        $warenhoses = $this->getWarenhouses($fobsParcial);
        $prorrateos = $this->getProrrateoDetail($fobsParcial, $warenhoses);
        
        return([
            'fobs_parcial' => $fobsParcial,
            'warenhouses' => $warenhoses,
            'prorrateos' => $prorrateos,
        ]);
    }
    
    
    /**
     * Calcula los prorrateos para el pedido, tanto iniciales como parciales 
     * 
     * @param array $fobs
     * @param array $warenhouses
     * @return array
     */
    private function getProrrateoDetail(array $fobs, array $warenhouses): array
        {
            $prorrateos = [
                'prorrateo_parcial' => [],
                'prorrateo_pedido' => [],
            ];
            
            foreach ($this->init_data['parcial_expenses'] as $idx => $expense){
                if(! preg_match('/[a-zA-Z]-[0-9]/' , $expense['concepto'] ) )
                {
                    array_push($prorrateos['prorrateo_parcial'], $expense);
                }
            }
            
            foreach ($this->init_data['init_expenses'] as $idx => $expense){

                $expense['valor_prorrateado'] =  (
                                            $expense['valor_provisionado']
                                            * $fobs['fob_parcial_razon_inicial']
                                                );
                
                if($expense['concepto'] == 'TASA DE CONTROL ADUANERO' && $expense['valor_provisionado'] > 40){
                    $expense['valor_prorrateado'] = $this->getTCAValue(
                        $expense['valor_provisionado']
                    );
                }

                array_push( $prorrateos['prorrateo_pedido'], $expense);        
            }
            
            return $prorrateos;
    }
    

    /**
     * Obtiene el valor de la tasa para el parcial
     * @param $global_value float valor inicial de la provision
     */
    private function getTCAValue($global_value){
        
        $tasa_sum = 0.0;        
        if($this->init_data['products']){
        foreach ($this->init_data['products'] as $key => $prod) {
            $prod['peso'] = 0;

            foreach ($this->init_data['order_invoice_detail'] as $idx => $oid) {
                if($oid['detalle_pedido_factura'] == $prod['detalle_pedido_factura']){
                    $prod['cod_contable'] = $oid['cod_contable'];
                    break;
                }
            }

            foreach ($this->init_data['products_base'] as $i => $pb){
                if($pb['cod_contable'] == $prod['cod_contable']){
                    $prod['peso'] = $pb['peso'];
                    break;
                }
            }

            $tasa = ($prod['peso']*1000/2000*.10);

            if($tasa > 700){
                $tasa_sum += 700;                
            }else{
                $tasa_sum += $tasa;
            }

        }
        }else{
            print 'La factura informativa no tiene productos';
        }

        #si el valor excede lo que ingresaron se envia el mismo de la provision
        if($tasa_sum  <= $global_value){
            return $tasa_sum;
        }else{
            return $global_value;
        }
    }
    
    /**
     * Retorna el costo por bodegaje del parcial, y el saldo para el proximo
     * parcial
     *
     *@params array 
     *
     * @return array
     */
    private function getWarenhouses( $fobs ): array
        {
            $warenhouse = [
                'almacenaje_parcial' => 0.0,
                'almacenaje_anterior' => 0.0,
                'almacenaje_total_parcial' => 0.0,
                'almacenaje_aplicado' => 0.0,
                'almacenaje_proximo_parcial' => 0.0,
                'detail' => [],
            ];            
            
            if ($this->init_data['parcial_expenses']){
                foreach ($this->init_data['parcial_expenses'] as $item => $expense)
                {
                    if( preg_match('/[a-zA-Z]-[0-9]/' , $expense['concepto'] ) )
                    {
                        $warenhouse['almacenaje_parcial'] += 
                                                $expense['valor_provisionado'];
                        array_push($warenhouse['detail'], $expense);
                    }
                }
            }
            
            if($this->init_data['last_prorrateo']){
                $last_prorrateo = end($this->init_data['last_prorrateo']);
                $warenhouse['almacenaje_anterior'] = 
                                $last_prorrateo['almacenaje_proximo_parcial'];    
            }
            
            $warenhouse['almacenaje_total_parcial'] = (
                    $warenhouse['almacenaje_parcial']
                    + $warenhouse['almacenaje_anterior']
                ); 
            
            $warenhouse['almacenaje_aplicado'] = (
                $fobs['fob_parcial_razon_saldo']
                * $warenhouse['almacenaje_total_parcial']
                );
            
            $warenhouse['almacenaje_proximo_parcial'] = (
                $warenhouse['almacenaje_total_parcial']
                - $warenhouse['almacenaje_aplicado']
                );
            
            return $warenhouse;
    }
    
    
    
    /**
     * Obtiene el valor del parcial, del pedido y de la relacion que
     * eciste entre el parcial y el Fob total
     *
     * @param array $orderInvoices
     * @param array $infoInvoices
     */
    private function getFobParcialAndFobOrder()
    {
        $fobs = [
            'fob_inicial' => 0.0,
            'fob_saldo' => 0.0,
            'fob_parcial' => 0.0,
            'fob_parcial_razon_inicial' => 0.0,
            'fob_parcial_razon_saldo' => 0.0,
            'fob_proximo_parcial' => 0.0,
            'prorrateo_seguro_aduana' => 0.0,
            'prorrateo_flete_aduana' => 0.0,
        ];
        
        if (
            $this->init_data['order_invoices'] == False
            ){
            return $fobs;
        }
        
        
        foreach ($this->init_data['order_invoices'] as $idx => $invoice){
            $fobs['fob_inicial'] += $invoice['valor'];
        }
        
        
        if ($this->init_data['last_prorrateo']){
            $last_prorrateo = end($this->init_data['last_prorrateo']); 
            $fobs['fob_saldo'] =  $last_prorrateo['fob_proximo_parcial']; 
        }else{
            $fobs['fob_saldo'] = $fobs['fob_inicial'];
            }
            
        foreach ($this->init_data['info_invoices'] as $idx => $invoice){
            $fobs['fob_parcial'] +=  $invoice['valor'];
            $fobs['prorrateo_flete_aduana'] += $invoice['flete_aduana'];
            $fobs['prorrateo_seguro_aduana'] += $invoice['seguro_aduana'];
        }
       
        $fobs['fob_proximo_parcial'] = (
            $fobs['fob_saldo'] - $fobs['fob_parcial']
            );
        
        $fobs['fob_parcial_razon_inicial'] = ( 
            $fobs['fob_parcial']  / $fobs['fob_inicial']
            );
        
        $fobs['fob_parcial_razon_saldo'] = (
               $fobs['fob_parcial']           
               /$fobs['fob_saldo'] 
            );
        
        return $fobs;
    }
    
    
    /**
     * Coloca el tipo de cambio que le corresponde al pedido
     */
    private function setConfiguration(){
        $order_invoices = $this->init_data['order_invoices'];

        if($order_invoices){
            foreach ($order_invoices as $idx => $invoice){
                $this->type_change_invoice = $invoice['tipo_cambio'];
                break;
            }
        }
        
        return False;
    }
}