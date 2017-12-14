<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Busca valores ceros o negativos en el arreglo, si existe retorna false
 * @params $dataArray Valores asociados de un
 * @return boolean
 */
if (!function_exists('searchOrderCeroValues')) {
    function searchOrderCeroValues(array $dataArray) : bool 
    {   
        if (gettype($dataArray) == 'boolean'){
            return false;
        }
        unset($dataArray['statusOrder']['have_gasto_origen']);
        foreach ($dataArray as $key) {
            if ($key == false){
                return false;
            }
            foreach ($key as $item) {
                if (gettype($item) == 'array') {
                    if ($item['valor_provisionado'] == 0.0) {
                        return false;
                    };
                } else {
                    if (($item == false) || ($item == 0) && (gettype($item) != 'string')) {
                        return false;
                    }
                }
            }
        }
        return true;
    }
}

/**
 * Calcula la diferencia en dias entre dos fechas
 * El valor que retorna es redondeado al mas bajo por eso se le suma
 * un punto para calcular el valos a la fecha indicada 
 * @param array $order Objeto orden completo
 * @return int numero de dias entre las fechas
 */
if (! function_exists('dateDiffInDays')){
    function dateDiffInDays(string $dateBegin, string $dateEndUp  ) : int
    {   
        if($dateBegin == $dateEndUp){
            return 1;
        }
        
        $dateBegin = strtotime($dateBegin);
        $dateEndUp = strtotime($dateEndUp);
        $dateDiffInSeconds = ($dateEndUp - $dateBegin);
        return (floor($dateDiffInSeconds/(60 * 60 * 24)) + 1);
    }
}