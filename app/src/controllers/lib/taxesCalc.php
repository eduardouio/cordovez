<?php 
/**
 * Clase encargada de generar los impuestos totales y por
 * unidades los valores son devueltos en forma de array, el calculo
 * se lo hace por tipo de producto
 * 
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @version 1.0
 * @copyright 2018 Representaciones Cordovez
 * @license Representaciones Cordovez
 * @package Controllers
 */
class productTaxes {
    private $fodinfaValue;
    private $percentItem; 
    private $iceEspecificoValue;
    private $nroCajas;
    private $costoCaja;
    private $iceValue;
    private $fleteValue;
    private $fobValue;
    private $cifValue;
    private $seguroValue;
    private $prodcutoParam;
    private $capacidadValue;
    private $etiquetasFiscalesValue;
    private $advaloremValue;
    private $ivaValue;
    private $otrosValue;
    private $exoneracionArancel;
    private $unidadesParam;
    private $etiquetasParam;
    private $gradoAlcoholicoParam;
    private $fodinfaParam;
    private $iceEspecificoParam;
    private $baseIceAdvaloremParam;
    private $ivaParam;
    private $exaduana;
    private $tasaControl;

    
    
    /**
     * Constructor de la clase de imuestos
     * inicializa las variables
     */
    function __construct(array $params ){       
        $this->unidadesParam = floatval( $params['unidades'] );
        $this->etiquetasParam = floatval( $params['etiquetas'] );
        $this->gradoAlcoholicoParam = floatval( $params['grado_alcolico'] );
        $this->fodinfaParam = floatval( $params['fondinfa'] );
        $this->iceEspecificoParam = floatval( $params['ice_especifico'] );
        $this->baseIceAdvaloremParam = floatval( $params['base_ice_advalorem'] );
        $this->ivaParam = floatval( $params['iva_param'] );
        $this->percentItem = floatval( $params['percent_item'] );
        $this->fobValue = floatval( $params['fob_value'] );
        $this->seguroValue = floatval( $params['seguro_value'] );
        $this->prodcutoParam = $params['producto'];
        $this->fleteValue = floatval( $params['flete_value'] );
        $this->otrosValue = floatval( $params['otros_value'] );
        $this->exoneracionArancel = floatval( $params['exoneracion_value'] );
        $this->capacidadValue = intval( $params['capacidad_ml'] );
        $this->nroCajas = intval( $params['nro_cajas'] );
        $this->costoCaja = floatval( $params['costo_caja'] );
        $this->tasaControl = floatval($params['tasa_control']);
    }
    

    /** 
    * Retorna el valor del CIF
    * sum(fob + seguro + flete)
    * @return float $cifValue
    */
    private function getCIF() : float
    {
        $this->cifValue = (
            $this->fobValue + 
            $this->fleteValue + 
            $this->seguroValue
        );

        return($this->cifValue);
    }


    /**
    * Calcula el fodinfa del CIF
    * 0,50% DEL CIF (FOB+SEG+FLETE ADUANA)
    * @return float fodinfa
    */
    private function getFodinfa() : float
    {
        $this->fodinfaValue = (
            $this->getCIF() * $this->fodinfaParam
        );
        
        return $this->fodinfaValue;
    }

    
    /**
     * Retorna el valor del ICE
     * 7,24*CAPACIDAD/1000*GRADO ALCOHOLICO/100*No. Botellas
     * @return float iceEspecifico
     */
    private function getICEEspecifico() : float
    {
        $this->iceEspecificoValue = 
            (
                (
                    ($this->iceEspecificoParam * $this->capacidadValue) / 1000
                 ) * ($this->gradoAlcoholicoParam / 100)
            ) * $this->unidadesParam;
        
        return $this->iceEspecificoValue;
    }
    
    
    /**
     * Retorna el valor de las etiquetas fiscales
     * @return float
     */
    private function getEtiquetasFiscales(): float 
    {   
            $this->etiquetasFiscalesValue = (
                $this->unidadesParam * $this->etiquetasParam
                );
            
        return $this->etiquetasFiscalesValue;
    }
    
    
    /**
     * Realiza el calculo del Exaduana
     * (FOB+SEGURO ADUANA+TRANSPORTE ADUANA+FODINFA+ARANCEL ADVALOREN+
     * ARANCEL ESDPECIFICO+OTROS+ETIQUETAS FISCALES)/No. Botellas
     * @return float 
     */
    private function getExaduana()
    {
        $array = [
            'cif' =>  $this->getCIF(), 
            'fodinfa' =>  $this->getFodinfa(), 
            'otros' =>  $this->otrosValue ,
            'ef' =>  $this->getEtiquetasFiscales(),
            'tasa_control' => $this->tasaControl,
        ];
        
        $this->exaduana = (
            $this->getCIF() + 
            $this->getFodinfa() +
            $this->otrosValue + 
            $this->getEtiquetasFiscales() +
            $this->tasaControl - 
            $this->exoneracionArancel
            );
    }
    
    
    /**
     * Retorna la base del Advalorem
     * 4,33*CAPACIDAD/1000
     * @return float
     */
    private function getAdvaloremBase() : float {
        $this->advaloremValue = (
            ($this->baseIceAdvaloremParam * $this->capacidadValue) / 1000
            );
        
        return $this->advaloremValue;
    }
    
    
    /**
     * Retorna el ice advalorem 
     * SI EX ADUANA ANTES ETIQUETAS FISCALES ES MAYOR QUE CAPACIDAD*4,33/1000 
     * GRAVA EL ICE ADVALOREN TARIFA ES 0,75 DEL EXADUANA POR NUMERO DE BOTELLAS
     * @return float
     */
    private function getIceAdvalorem() : float 
    {
        if(
            ($this->exaduana / $this->unidadesParam) >
            $this->getAdvaloremBase()
            ){
            return (
                    ($this->exaduana * $this->baseIceAdvaloremParam) * 
                    $this->unidadesParam
                );
        }
        return 0;
    }
    
    
    /**
     * Calcula el iva para el producto
     * (FOB+SEGURO ADUANA+TRANSPORTE ADUANA+FODINFA+ARANCEL ADVALOREN+ARANCEL 
     * ESDPECIFICO+OTROS+ICE ESPECIFICO+ICE ADVALOREN)*12%
     * @return float
     */
    private function getIVA() : float
    {
     $this->ivaValue = (
         $this->getCIF() + 
         $this->getFodinfa() + 
         $this->getIceAdvalorem() + 
         $this->getICEEspecifico()
         ) * $this->ivaParam;

         return $this->ivaValue;
    }
    
    /**
     * Retorna un arreglo con el detalle de los impuestos
     * para un producto
     * @return array
     */
    public function getTaxes(){
        $this->getExaduana();
        
        return([
            'seguro_aduana' => $this->seguroValue,
            'flete_aduana' => $this->fleteValue,
            'fob' => $this->fobValue,
            'cif' =>  $this->getCIF(),
            'unidades' => $this->unidadesParam,
            'nro_cajas' => $this->nroCajas,
            'costo_caja' => $this->costoCaja,
            'producto' => $this->prodcutoParam,
            'fodinfa' => $this->getFodinfa(),
            'fodinfa_unitario' => ($this->getFodinfa() / $this->unidadesParam),
            'etiquetas_fiscales' => $this->getEtiquetasFiscales(),
            'base_advalorem' => $this->getAdvaloremBase(),
            'exaduana' => $this->exaduana,
            'presentacion' => $this->capacidadValue,
            'grado_alcoholico' => $this->gradoAlcoholicoParam,
            'ice_especifico' => $this->getICEEspecifico(),
            'ice_advalorem' => $this->getIceAdvalorem(),
            'tasa_control' => $this->tasaControl,
            'otros_value' => $this->otrosValue,
            'exoneracion_value' => $this->exoneracionArancel,
        ]);
    }
}