<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Creacion de la clase de prorrateos de pedidos
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class Prorrateos
{
    public $tasa_parcial = [];
    public $have_tasa = False;
    public $tase_base_peso = False;
    private $init_data;
    private $type_change_invoice;
    private $stock_order;
    private $current_parcial_is_last = True;
    
    /**
     * Funcion costructora de la case
     *
     */
    function __construct($init_data, array $stock_order){
        $this->init_data = $init_data;
        $this->stock_order = $stock_order;
        $this->setConfiguration();
        $this->checkStockOrder();
        
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
        if($this->init_data['parcial_expenses']){
            foreach ($this->init_data['parcial_expenses'] as $idx => $expense){
                if(! preg_match('/[a-zA-Z]-[0-9]/' , $expense['concepto'] ) )
                {
                    array_push($prorrateos['prorrateo_parcial'], $expense);
                }
            }
        }
        
        if($this->init_data['init_expenses']){
            foreach ($this->init_data['init_expenses'] as $idx => $expense){
                $expense['valor_prorrateado'] =  (
                    $expense['valor_provisionado']
                    * $fobs['fob_parcial_razon_inicial']
                    );
                
                if($expense['concepto'] == 'TASA DE CONTROL ADUANERO'){
                    $expense['valor_prorrateado'] = $this->getTCAValue(
                        $expense['valor_provisionado'],
                        $fobs['fob_parcial_razon_inicial']
                        );
                    $this->have_tasa = True;                
                }
                array_push( $prorrateos['prorrateo_pedido'], $expense);
            }
        }
        return $prorrateos;
    }
    
    
    /**
     * * Obtiene el valor de la tasa para el parcial
     * @param $global_value float valor inicial de la provision
     *
     * @param float $tasa_provision
     * @param float $fob_parcial_razon_inicial
     * @param boolean $onlyvalue => si especifica solo retorna el valor
     * @return array|number
     */
    private function getTCAValue($tasa_provision, $fob_parcial_razon_inicial) {
        if(count($this->init_data['products']) == 0){
            print 'Factura Informativa sin productos';
            exit();
        }
        #comprobamos el valor de la tasa
        if(floatval($tasa_provision == 700.00) || floatval($tasa_provision == 40.00)){
            return ($tasa_provision * $fob_parcial_razon_inicial);
        }
       
        if(count($this->init_data['products']) == 0){
            print 'Factura Informativa sin productos';
            exit();
        }
        $tasa_general = [];
        $tasa_parcial = [];
        $total_tasa_parcial = 0.0;
        $tasa_base_peso = 0.0;
        
        foreach ($this->init_data['order_invoice_detail'] as $k => $prod){
            $tasa = $prod['peso'] * 0.05;
            if($tasa > 700){
                $tasa = 700;
            }
            $tasa_base_peso += $tasa;
            $unidad_caja = $this->getUnitiesProduct(
                $prod['detalle_pedido_factura']
                );            
            if($unidad_caja){
                $peso_unidad = $prod['peso'] /  ($unidad_caja * $prod['nro_cajas']);
                
                array_push($tasa_general, [
                    'detalle_pedido_factura' => $prod['detalle_pedido_factura'],
                    'cajas_item' => $prod['nro_cajas'],
                    'peso' => $prod['peso'],
                    'unidades_caja' => $unidad_caja,
                    'costo_caja' => $prod['costo_caja'],
                    'peso_unidad' => $peso_unidad,
                    'cod_contable' => $prod['cod_contable'],
                    'tasa_control' => $tasa,
                ]);        
            }
        }
        #si cinciden las tasa calculamo el prorrateo por item de la FI
        if(round($tasa_base_peso,1) == round($tasa_provision,1)){
            $this->tase_base_peso = True;
            foreach ($tasa_general as $item){
                foreach ($this->init_data['products'] as $i => $dt){
                    if($dt['detalle_pedido_factura'] == $item['detalle_pedido_factura']){
                        $item['cajas_parcial'] = $dt['nro_cajas'];
                        $item['peso_parcial'] = $dt['nro_cajas'] * $item['unidades_caja'] * $item['peso_unidad'];
                        $item['tasa_parcial'] = $item['peso_parcial'] * 0.05;
                        $total_tasa_parcial += $item['tasa_parcial'];
                        array_push($tasa_parcial, $item);
                        break;
                    }
                }
            }
            $this->tasa_parcial = $tasa_parcial;
            return $total_tasa_parcial;
        }
        #retorna en porcentaje al fob
        foreach ($tasa_general as $item){
            foreach ($this->init_data['products'] as $i => $dt){
                if($dt['detalle_pedido_factura'] == $item['detalle_pedido_factura']){
                    $item['costo_item'] = $item['costo_caja'] * $dt['nro_cajas'];
                    $item['tasa_parcial'] = $tasa_provision * $fob_parcial_razon_inicial;
                    array_push($tasa_parcial, $item);
                    break;
                }
            }
        }
        $this->tasa_parcial = $tasa_parcial;
        return ($tasa_provision * $fob_parcial_razon_inicial);
    }
    
    
    /**
     * Retorna la cantidad de unidades en la factura
     *
     * @param int $detalle_pedido_factura detalle de pedido factura
     * @param bool $info_invoice => Factura infomativa o de Pedido
     * @return int
     */
    private function getUnitiesProduct( int $detalle_pedido_factura):int{
        
        foreach ($this->init_data['order_invoice_detail'] as $k => $prod){
            if(intval($prod['detalle_pedido_factura']) == $detalle_pedido_factura){
                foreach ($this->init_data['products_base'] as $i => $pb){
                    if($prod['cod_contable'] == $pb['cod_contable']){
                        return ($pb['cantidad_x_caja']);
                    }
                }
            }
        }
        return 0;
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
            $last_prorrateo = $this->init_data['last_prorrateo'];
            $warenhouse['almacenaje_anterior'] = 
                ($last_prorrateo['almacenaje_proximo_parcial']) ? $last_prorrateo['almacenaje_proximo_parcial'] : 0;
        }
        
        $warenhouse['almacenaje_total_parcial'] = (
            $warenhouse['almacenaje_parcial']
            + $warenhouse['almacenaje_anterior']
            );
        
        $warenhouse['almacenaje_aplicado'] = (
            $fobs['fob_parcial_razon_saldo']
            * ($warenhouse['almacenaje_total_parcial'] )
            );
        
        $warenhouse['almacenaje_proximo_parcial'] = (
            $warenhouse['almacenaje_total_parcial']
            - $warenhouse['almacenaje_aplicado']
            );
        #comprobamos si es el ultimo parcial si lo es asignamos todo el valor
        if ($this->current_parcial_is_last){
            $warenhouse['almacenaje_aplicado'] += $warenhouse['almacenaje_proximo_parcial'];
            $warenhouse['almacenaje_proximo_parcial'] = 0;           
        }    
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
            $last_prorrateo = $this->init_data['last_prorrateo'];
            $fobs['fob_saldo'] =  ($last_prorrateo['fob_proximo_parcial']) ? $last_prorrateo['fob_proximo_parcial'] : 0;
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
           
        if($fobs['fob_saldo'] == 0){
            $fobs['fob_parcial_razon_saldo'] = 1;
        }else{
            $fobs['fob_parcial_razon_saldo'] = (
                $fobs['fob_parcial']
                /$fobs['fob_saldo']
                );
        }        
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
    
    
    /**
     * Comprueba si el parcial que esta procesando es el ultimo
     */
    private function checkStockOrder(){
        if($this->init_data['order']['nro_pedido'] == '191-17'){
            return $this->current_parcial_is_last = False;
        }
            
        $this->current_parcial_is_last = False;
        if($this->stock_order){
            foreach ($this->stock_order as $k => $item){
                if(intval($item['stock']) > 0 ){
                    return $this->current_parcial_is_last = False;
                }
            }
        }
    }   
}