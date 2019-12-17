<?php
if (! function_exists('ordinalNumberParcial')){
    /**
     * Retorna el ordinal del parcial con referencia al pedido
     *
     * @param array $parcials
     * @param int $id_parcial
     * @return int
     */
    function ordinalNumberParcial(array $parcials, int $id_parcial) : int
    {
        foreach ($parcials as $k => $par){
            if($par['id_parcial'] == $id_parcial){
                return ($k +1 );
            }
        }
    }
}
