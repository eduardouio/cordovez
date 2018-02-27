<?php
/**
 * Clase de validacion de almacenra publica
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
    private $parcials = [];
    
    
    /**
     * Inicia las variables de la clase
     * @param array $order
     * @param array $parcials
     */
    function __construct(array $order, array $parcials){
        $this->order = $order;
        $this->parcials = $parcials;
    }
    
    
        
    /**
     * Retorna el rango de fechas del ultimo almacenamiento en los parciales
     * return array
     */
    public function getLastWarenhouseParcial(){
        $lastParcial = $this->getLastParcial();
        $warenHouses = []; 

        foreach ( $lastParcial as $expensesNationalization => $v) {
            if($this->isWarenhouse($v['concepto'])){
                array_push($warenHouses, $v);
            }
        }
        
        $keys = [];
        foreach ($warenHouses as $item => $expense){
            if($expense['tipo'] == 'NACIONALIZACION'){
                array_push($keys, $expense['id_gasto_nacionalizacion']);
            }
        }
        
        $lastWarenHouseId = max($keys);
        
        foreach ($warenHouses as $item => $expense){
            if($expense['id_gasto_nacionalizacion'] == $lastWarenHouseId){
                return $expense;
            }
        }
        
     }
     
     
     
     /**
      * Obtiene le ultimo parcial del pedido, se concidera el ultimo parcial
      * al que tiene el identificador mas alto
      * @return int
      */
     private function getLastParcial()
     {
         $keys = [];
         
         foreach ($this->parcials as $parcial => $item){
             array_push($keys, $item.id_parcial);
         }
         
         $lastParcialId = max($keys);
         
         foreach ($this->parcials as $parcial => $item){
             if($item['id_parcial'] == $lastParcialId){
                 return $item;
             }
         }
         print 'El parcial no existe';
         
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


