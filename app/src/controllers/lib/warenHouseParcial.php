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
    
    
    /**
     * Inicia las variables de la clase
     * @param array $order
     * @param array $parcials
     */
    function __construct(array $order, array $parcial){
        
        $this->order = $order;
        $this->parcial = $parcial;
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
            
            #evita el warning para un solo elemento
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
         return $this->parcial;
         
         $keys = [];
         
         foreach ($this->parcials as $parcial => $item){
             array_push($keys, $item['id_parcial']);
         }
         
         $lastParcialId = max($keys);
         
         foreach ($this->parcials as $parcial => $item){
             if($item['id_parcial'] == $lastParcialId){
                 return $item;
             }
         }
         
         return 0;
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


