<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Clase de validacion de almacenra publica
 * 
 * @author eduardo
 * @param array  $order[
 *                  nro_order => ** 
 *                  ** => **
 *                      ]
 *                      
 * @param array $parcials = [
 *          0 => [
 *              'id_parcial' : 1,
 *              'expensesNationalization' => [
 *                  period => *,
 *                  periodEnd => *,
 *                  ** => **,
 *              ],
            n => [
                'id_parcial: N,
 *              'expensesNationalization' => [
 *                  period => *,
 *                  periodEnd => *,
 *                  ** => **,
 *              ]
 *          ]
 * ]
 * 
 */
class warenHouseParcial 
{
    private $order = [];
    private $parcial = [];
    private $all_parcials = [];
    
    
    /**
     * Inicia las variables de la clase
     * @param array $order
     * @param array $parcials
     */
    function __construct(array $order, array $parcial, $all_parcials){
        $this->order = $order;
        $this->parcial = $parcial;
        $this->all_parcials = $all_parcials;
    }
       
        
    /**
     * Retorna el rango de fechas del ultimo almacenamiento en los parciales
     * return array
     */
    public function getLastWarenhouseParcial(){
        $lastParcial = $this->getLastParcial();
        $warenHouses = [];        
        
        if($lastParcial['expenses']){
            foreach ( $lastParcial['expenses'] as $expensesNationalization => $v) {
                if($this->isWarenhouse($v['concepto'])){
                    array_push($warenHouses, $v);
                }
            }
        
            $keys = [];

            foreach ($warenHouses as $item => $expense){
                if($expense['tipo'] == 'NACIONALIZACION'){
                    array_push($keys, $expense['id_gastos_nacionalizacion']);
                }
            }
            
            #evita el warning para un solo elemento en la lista
            @$lastWarenHouseId = max($keys);
        
            foreach ($warenHouses as $item => $expense){
                if($expense['id_gastos_nacionalizacion'] == $lastWarenHouseId){
                    $date = date('Y-m-d' , strtotime('+1 day', strtotime($expense['fecha_fin'])));
                    $expense['fecha_fin'] = strval($date);
                    return $expense;
                }
            }
        }else{
            return false;
        }
     }
     
     
     
     /**
      * Obtiene le ultimo parcial del pedido, se concidera el ultimo parcial
      * al que tiene el identificador mas alto
      * @return int
      */
     private function getLastParcial()
     {          
         
         $x = count($this->all_parcials);
         
         if( $x > 1){
             #de los parciales retorna el penultimo
             $pos = $x-2;
             return $this->all_parcials[$pos];
         }
         
         return False;
     }
     
     
    
    /**
     * Analiza un gasto de nacionalizacion 
     * y retorna verdadero si es de almacenaje parcial
     * @param string $expenseConcept
     * @return bool
     */
    private function isWarenhouse(string $expenseConcept): bool 
    {
        $result = preg_match('/[a-zA-Z]-[0-9]/' , $expenseConcept );
        
        if($result){
            return true;
        }
        
        return false;
    }
    
}


