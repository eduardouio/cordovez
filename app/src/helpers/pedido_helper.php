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
 * calcula la diferencia entre la fecha de llegada y ahora y el demoraje
 * @param array $order Objeto orden completo
 * @return array
 */
if (! function_exists('warehouseDays')){
    function warehouseDays(array $order) : array
    {
        $dateArribed = date('Y-m-d', strtotime($order['fecha_arribo']));
        $now = date('Y-m-d');
        $diff = date_diff(date_create($dateArribed), date_create($now));
        $delay = 0;
        if ($order['bg_haveExpenses'] == 0){
            $delay = $diff->d;
        }
        return ([
            'days' => $diff->d,
            'mounts' => $diff->m,
            'years' => $diff->y,
            'delay' => $delay,
        ]);
    }
}