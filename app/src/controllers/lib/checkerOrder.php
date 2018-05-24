<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Define los parametros minimos de un pedido
 *
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @version 1.0
 * @copyright 2018 Representaciones Cordovez
 * @license Representaciones Cordovez
 * @package Controllers
 */
class checkerOrder
{

    private $order;
    private $order_invoices;
    private $paids_init_expenses;
    private $rate_expenses;
    private $unused_expenses;

    /**
     * Constructo de clase
     *
     * @param array $order
     *            => Detalle del pedido
     * @param array $order_invoices
     *            => Facturas del pedido
     * @param array $paids_init_expenses
     *            => Gastos iniciales con sus pagos
     */
    function __construct(
                        array $order, 
                        $order_invoices, 
                        $paids_init_expenses, 
                        array $rate_expenses, 
        array $unused_expenses
        ){
        $this->order = $order;
        $this->order_invoices = $order_invoices;
        $this->paids_init_expenses = $paids_init_expenses;
        $this->rate_expenses = $rate_expenses;
        $this->unused_expenses = $unused_expenses;
    }

    /**
     * Revisa la informacion de una order
     * Fob Total,
     * Tiempo en Bodega
     *
     * @param array $order
     * @return array
     */
    public function checkOrder(): array
    {
        if (
            $this->order['fecha_arribo'] == Null 
            || 
            $this->order['fecha_arribo'] == '') {
            return [];
        }
        
        $datetime1 = new DateTime("now");
        $datetime2 = new DateTime($this->order['fecha_arribo']);
        
        $interval = $datetime1->diff($datetime2);
        
        return ([
            'mounths' => $interval->m,
            'days' => $interval->d,
            'all_days' => $interval->days
        ]);
    }

    /**
     * Comprueba los gastos iniciales del pedido, los gastos inciales
     * tienen los pagos registrados
     *
     * @param array $init_expenses
     * @return array
     */
    public function checkInitExpenses()
    {
        if ($this->paids_init_expenses == False) {
            return False;
        }
        $all_ok = True;
        $have_initial_warenhouse = False;
        
        $expenses_order = [];
        foreach ($this->paids_init_expenses as $item => $expense) {
            $expense['invoices'] = [];
            if ($expense['paids']) {
                foreach ($expense['paids'] as $idx => $paid) {
                    array_push(
                        $expense['invoices'], 
                        $paid['id_documento_pago']
                        );
                }
            }
            
            if ($expense['valor_provisionado'] == 0) {
                $all_ok = False;
            }
            
            if ($expense['concepto'] == 'ALMACENAJE INICIAL') {
                $have_initial_warenhouse = True;
            }
            
            array_push($expenses_order, $expense);
        }
        return ([
            'expenses_order' => $expenses_order,
            'have_initial_warenhouse' => $have_initial_warenhouse,
            'all_ok' => $all_ok
        ]);
    }

    /**
     * Comprueba las facturas de productos de un pedido
     * Condiciones comprobadas
     * - debeb tener un un tipo de cambio
     * - El detalle de la factura debe estar completo
     *
     * @param array $orderInvoices
     * @return array
     */
    public function checkOrderInvoices()
    {
        if ($this->order_invoices == False) {
            return False;
        }
        
        $invoices = [];
        $fob_total = 0.0;
        $origen_expenses = 0.0;
        $values_isok = True;
        $tipy_change = 0.0;
        
        foreach ($this->order_invoices as $item => $invoice) {
            $fob_total += $invoice['valor'];
            $origen_expenses += floatval($invoice['gasto_origen']);
            $invoice['is_complete'] = False;
            $invoice['check_money'] = True;
            $tipy_change = $invoice['tipo_cambio'];
            if ($invoice['valor'] == $invoice['detailInvoice']['sums']['valueItems']) 
            {
                $invoice['is_complete'] = True;
            }
            
            if (
                $invoice['tipo_cambio'] == 1.0 
                && 
                $invoice['moneda'] != 'DOLARES'
                ) {
                $invoice['check_money'] = False;
            }
            
            if ($invoice['is_complete'] == False) {
                $values_isok = False;
            }
            
            array_push($invoices, $invoice);
        }
        
        return ([
            'invoices' => $invoices,
            'fob_total' => $fob_total,
            'tipo_cambio' => $tipy_change,
            'values_isok' => $values_isok,
            'origin_expenses' => $origen_expenses
        ]);
    }

    /**
     * Obtiene el valor de la tasa aduanera
     *
     * @param array $order_invoices
     * @return float
     */
    public function getInitialTributes()
    {
        if ($this->order_invoices == False) {
            return False;
        }
        
        $order_invoices = $this->checkOrderInvoices();
        
        if ($order_invoices['fob_total'] == 0) {
            return ([
                'isd' => 0,
                'poliza_seguro' => 0
            ]);
        }
        
        $base_isd = (
            ($order_invoices['fob_total'] * $order_invoices['tipo_cambio']) 
            + 
            $order_invoices['origin_expenses']
            );
        
        $isd_percent = $this->searchTaxesPercent('ISD', True);
        $poliza_percent = $this->searchTaxesPercent('POLIZA SEGURO', True);
        $flete_value = $this->seacthInitExpense('FLETE', True);
        
        $base_poliza_seguro = (
            (
                $flete_value + 
                ($order_invoices['fob_total'] * $order_invoices['tipo_cambio'])
             ) * 2.2
            );
        
        $seguro = ($poliza_percent * $base_poliza_seguro);
        $sb = $seguro * 0.035;
        $tax2 = $seguro * 0.005;
        $emision = 0.45;
        
        $unidades = 0;
        $boxes = 0;
        
        $labeled_value_unity = $this->searchTaxesPercent(
            'MANO DE OBRA ETIQUETADO'
            );
        
        $label_unity = $this->searchTaxesPercent(
            'ETIQUETAS FISCALES'
            );
        
        foreach ($this->order_invoices as $idx => $invoice) {
            unset($invoice['detailInvoice']['sums']);
            foreach ($invoice['detailInvoice'] as $item => $detail) {
                $unidades += (
                        $detail['nro_cajas'] * $detail['cantidad_x_caja']
                    );
                $boxes += $detail['nro_cajas'];
            }
        }
        
        $rates = [
            'ISD' => ($isd_percent * $base_isd),
            'POLIZA SEGURO' => ($seguro + $sb + $tax2 + $emision),
            'MANO DE OBRA ETIQUETADO' => (
                $unidades * $labeled_value_unity['valor']
                ),
            'TASA DE SERVICIO ADUANERO' => $this->getTSA(),
            'ETIQUETAS FISCALES' => $label_unity['valor'] * $unidades ,
        ];
                
        $unused_expenses = [];
        
        foreach ($this->unused_expenses as $idx => $expense) {            
            if (array_key_exists($expense['concepto'], $rates)) {
                $expense['valor'] = $rates[$expense['concepto']];
            }
            
            if(
                $this->order['regimen'] == '70' &&
                $expense['concepto'] == 'ETIQUETAS FISCALES'
                ){
                null;
            }else{
                array_push($unused_expenses, $expense);
            }
        }
        
        return ([
            'unused_expenses' => $unused_expenses,
            'unidades' => $unidades,
            'boxes' => $boxes
        ]);
    }
     
    
    /**
     * Calcula el valor de la tasa Aduanera
     * @return float
     */
    private function getTSA():float
    {
        
        if($this->order_invoices == False){
            return 0;
        }
            
        $tsa_base = $this->searchTaxesPercent(
            'TASA DE SERVICIO ADUANERO'
            );
        
        $tsa = 0.0;
        
        foreach ($this->order_invoices as $idx => $invoice){
            unset($invoice['detailInvoice']['sums']);
            foreach ($invoice['detailInvoice'] as $itm => $product){
                
                $tasa = (
                    ((floatval($product['peso'])/1000) * floatval($tsa_base['valor'])) 
                    * $product['unidades']
                    );
                
                if ($tasa < 700 ){
                    $tsa += $tasa;
                }else{
                    $tsa += 7000;
                }
            }            
        }
        
        return $tsa;
    }
    
    
    /**
     * Retorna el parametro de un impuesto de la lista de impuestos,
     * Se puede solicitar solo el porcentaje o todo el tax
     *
     * @param string $name
     * @param bool $percent
     * @return float | array
     */
    private function searchTaxesPercent(string $name, bool $percent = False)
    {
        foreach ($this->rate_expenses as $idx => $tax) {
            if ($tax['concepto'] == $name) {
                if ($percent) {
                    return $tax['porcentaje'];
                }
                return $tax;
            }
        }
        
        return 0;
    }

    
    /**
     *
     * @param string $name
     * @param bool $value
     * @return float | array
     */
    private function seacthInitExpense(string $name, bool $value = False)
    {
        
        if($this->paids_init_expenses == False){
            return 0;
        }
        
        foreach ($this->paids_init_expenses as $idx => $expense) {
            if ($expense['concepto'] == $name) {
                if ($value) {
                    return $expense['valor_provisionado'];
                }
                
                return $expense;
            }
        }
        
        return 0;
    }
}


