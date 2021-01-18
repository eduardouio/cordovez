<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Realiza un analisis completo de los parciales
 *
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @version 1.0
 * @copyright 2018 Representaciones Cordovez
 * @license Representaciones Cordovez
 * @package Controllers
 */

class checkerPartial
{
    private $order;
    private $parcial;
    private $info_invoices;
    private $paids_partial_expenses;
    private $unused_expenses;
    
    /**
     * Inicia la clase 
     * 
     * @param array $parcial
     * @param array| bool $info_invoices
     * @param array| bool  $paids_partial_expenses
     * @param array| bool  $unused_expenses
     */
    function __construct(
                        array $order,
                        array $parcial,
                        $info_invoices,
                        $paids_partial_expenses,
                        $unused_expenses
        )
    {
        $this->order = $order;
        $this->parcial = $parcial;
        $this->info_invoices = $info_invoices;
        $this->paids_partial_expenses = $paids_partial_expenses;
        $this->unused_expenses= $unused_expenses;
    }
    
    /**
     * Revisa la informacion de una order
     * Fob Total,
     * Tiempo en Bodega
     *
     * @param array $order
     * @return array
     */
    public function checkPartial(): array
    {
        if (
            $this->order['fecha_ingreso_almacenera'] == Null
            ||
            $this->order['fecha_ingreso_almacenera'] == '') {
                return [];
            }
            
            $datetime1 = new DateTime("now");
            $datetime2 = new DateTime($this->order['fecha_ingreso_almacenera']);
            
            $interval = $datetime1->diff($datetime2);
            
            return ([
                'mounths' => $interval->m,
                'days' => $interval->d,
                'all_days' => $interval->days
            ]);
    }
    
    /**
     * Comprueba los pagos registrados de los gastos del parcial
     *
     * @return array
     */
    public function checkPartialExpenses()
    {
        if ($this->paids_partial_expenses == False) {
            return False;
        }
        
        $all_ok = True;
        $expenses_parcial = [];
        
        foreach ($this->paids_partial_expenses as $item => $expense) {
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
            
            array_push($expenses_parcial, $expense);
        }
        
        return ([
            'partial_expenses' => $expenses_parcial,
            'all_ok' => $all_ok,
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
    public function checkInfoInvoices()
    {
        if ($this->info_invoices == False) {
            return False;
        }
        
        $invoices = [];
        $fob_total = 0.0;
        $values_isok = True;
        $tipy_change = 0.0;
        $seguro_parcial = 0.0;
        $flete_parcial = 0.0;
        
        foreach ($this->info_invoices as $item => $invoice) {
            $fob_total += $invoice['valor'];
            $seguro_parcial += $invoice['seguro_aduana'];
            $flete_parcial += $invoice['flete_aduana'];
            
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
                
                array_push($invoices, $invoice);
        }
        
        return ([
            'invoices' => $invoices,
            'fob_total' => $fob_total,
            'flete_aduana' => $flete_parcial,
            'seguro_aduana' => $seguro_parcial,
            'cif_parcial' =>($flete_parcial + $seguro_parcial + $fob_total),
            'tipo_cambio' => $tipy_change,
            'values_isok' => $values_isok,
        ]);
    }
    
    
    /**
     * Obtiene el valor de la tasa aduanera
     *
     * @param array $order_invoices
     * @return float
     */
    public function getPartialTributes()
    {
        if ($this->info_invoices == False) {
            return False;
        }
        
        $order_invoices = $this->checkInfoInvoices();
        
        if ($order_invoices['fob_total'] == 0) {
            return ([
                'isd' => 0,
                'poliza_seguro' => 0
            ]);
        }
        
        $unidades = 0;
        $boxes = 0;
                
        $labeled_value_unity = $this->searchTaxesPercent(
            'MANO DE OBRA ETIQUETADO'
            );
        
        $label_unity = $this->searchTaxesPercent(
            'ETIQUETAS FISCALES'
            );
        
        foreach ($this->info_invoices as $idx => $invoice) {
            unset($invoice['detailInvoice']['sums']);
            if($invoice['detailInvoice']){
            foreach ($invoice['detailInvoice'] as $item => $detail) {
                $unidades += (
                    $detail['nro_cajas'] * $detail['cantidad_x_caja']
                    );
                $boxes += $detail['nro_cajas'];
            }
            }
        }
        
        $rates = [
            'MANO DE OBRA ETIQUETADO' => (
                $unidades * .03
                ),
            'ETIQUETAS FISCALES' => .13 * $unidades ,
        ];
        
        $unused_expenses = [];
        
        foreach ($this->unused_expenses as $idx => $expense) {
            if (array_key_exists($expense['concepto'], $rates)) {
                $expense['valor'] = $rates[$expense['concepto']];
            }
                array_push($unused_expenses, $expense);
        }
        
        return ([
            'unused_expenses' => $unused_expenses,
            'unidades' => $unidades,
            'boxes' => $boxes
        ]);
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
        foreach ($this->unused_expenses as $idx => $tax) {
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