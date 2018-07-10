<?php
/**
 * Obtiene la informacion para hacer un reporte de un pedido completo
 * @author eduardo
 */
class ModelOrderReport extends CI_Model
{
    private $modelOrder;
    private $modelOrderInvoices;
    private $modelOrderInvoiceDetail;
    private $modelPaid;
    private $modelPaidDetail;
    private $modelProrrateo;
    private $modelProrrateoDetail;
    private $modelParcial;
    private $modelInfoInvoice;
    private $modelInfoInvoiceDetail;
    private $modelProduct;
    private $modelExpenses;
    private $modelSupplier;
    private $modelLog;
    
    
    /**
     * constructor de la clase
     */
    function __construct(){
        parent::__construct();
        $this->init();
    }
    
    /**
     * Carga de librerias necesarias
     */
    private function init(){
        $this->load->model('Modelorder');
        $this->load->model('Modelorderinvoice');
        $this->load->model('Modelorderinvoicedetail');
        $this->load->model('Modelpaid');
        $this->load->model('Modelpaiddetail');
        $this->load->model('Modelprorrateo');
        $this->load->model('Modelprorrateodetail');
        $this->load->model('Modelparcial');
        $this->load->model('Modelinfoinvoice');
        $this->load->model('Modelinfoinvoicedetail');
        $this->load->model('Modelproduct');
        $this->load->model('Modelexpenses');
        $this->load->model('Modelsupplier');
        $this->load->model('Modellog');
        $this->modelOrder = new Modelorder();
        $this->modelOrderInvoices = new Modelorderinvoice();
        $this->modelOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelPaid = new Modelpaid();
        $this->modelPaidDetail = new Modelpaiddetail();
        $this->modelProrrateo = new Modelprorrateo();
        $this->modelProrrateoDetail = new Modelprorrateodetail();
        $this->modelParcial = new Modelparcial();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelInfoInvoiceDetail = new Modelinfoinvoicedetail();
        $this->modelProduct = new Modelproduct();
        $this->modelExpenses = new Modelexpenses();
        $this->modelSupplier = new Modelsupplier();
        $this->modelLog = new Modellog();
    }
    
    
    /**
     * Retorna toda la informacion de in pedido, sirve como bypass
     * @param array $order
     * @return array
     */
    public function getOrderData(array $order){
        $order_temp = $this->modelOrder->get($order['nro_pedido']);
        
        if($order_temp['regimen'] == 10){
            return $this->getOrderDataR10($order_temp);
        }
        return $this->getOrderDataR70($order_temp);
    }
    
    
    /**
     * Retorna toda la uinformacion de un pedido R70
     * 
     * @param string $nro_order
     * @return array
     */
    private function getOrderDataR70( array $order):array 
    {           
        $common_data = $this->getCommonDataFromOrder($order);
        
        $init_expenses = $this->modelExpenses->get($order['nro_pedido']);        
        $paricials_temp = $this->modelParcial->getByOrder($order['nro_pedido']);
        $all_parcials = [];
        
        if ($paricials_temp){
            foreach ($paricials_temp as $idx => $parcial){
                $parcial['info_invoices'] = [];
                
                $info_invoices_temp  = $this->modelInfoInvoice->getByParcial(
                    $parcial['id_parcial']
                    );
                
                if($info_invoices_temp){
                    foreach ($info_invoices_temp as $idx => $invoice){
                        $invoice['detalle_factura'] = 
                            $this->modelInfoInvoiceDetail->getByFacInformative(
                                    $invoice['id_factura_informativa']
                                    );
                        array_push($parcial['info_invoices'], $invoice);
                    }
                    
                }
            
            $parcial['parcial_expenses'] = 
                        $this->modelExpenses->getPartialExpenses(
                            $parcial['id_parcial']
                            );
            $parcial['prorrateos'] = 
                            $this->modelProrrateo->getProrrateoByParcial(
                                $parcial['id_parcial']
                                );
            
            array_push($all_parcials, $parcial);
            }                        
        }
        
        return([
            'order' => $order,
            'order_invoices' => $common_data['order_invoices'],
            'products' => $common_data['products'],
            'init_expenses' => $common_data['init_expenses'],
            'paids_order' => $common_data['paids_order'],
            'partials' => $all_parcials,
        ]);
    }
    
    
    /**
     * Retorna tola la informacion de in pedido R10
     * 
     * @param array $order
     * @return array
     */
    private function getOrderDataR10(array $order):array
    {
        $common_data = $this->getCommonDataFromOrder($order);
        
        return([
            'order' => $order,
            'order_invoices' => $common_data['order_invoices'],
            'products' => $common_data['products'],
            'init_expenses' => $common_data['init_expenses'],
            'paids_order' => $common_data['paids_order'],
        ]);
        
    }
    
    /**
     * retorna los gastos comunes para un pedido
     * @param array $order
     * @return array
     */
    private function getCommonDataFromOrder(array $order):array
    {        
        $order_invoices_temp = $this->modelOrderInvoices->getbyOrder(
            $order['nro_pedido']
            );
        
        $order_invoices = [];
        $products = [];
        
        if ($order_invoices_temp){            
            foreach ($order_invoices_temp as $idx => $invoice){
                $invoice['detail'] = 
                            $this->modelOrderInvoiceDetail->getByOrderInvoice(
                                    $invoice['id_pedido_factura']
                                    );
            if($invoice['detail']){
                foreach ($invoice['detail'] as $i => $detail){
                    array_push(
                                $products, 
                            $this->modelProduct->get($detail['cod_contable'])
                        );    
                }
            }
                
                array_push($order_invoices, $invoice);
            }
        }
        
        $init_expenses =  $this->modelExpenses->get($order['nro_pedido']);
        $paids_order =[];
        $paids_order_temp = $this->modelPaid->getAllPaidsFromOrder($order['nro_pedido']);
        if ($paids_order_temp){
            
        foreach ($paids_order_temp  as $idx => $paid){
            $paid['detalle_pago'] = $this->modelPaidDetail->getDetail($paid['id_documento_pago']);
            array_push($paids_order, $paid);
        }
        }
        
        return ([
            'order_invoices' => $order_invoices,
            'products' => $products,
            'init_expenses' => $init_expenses,
            'paids_order' => $paids_order,
        ]);
    }
    
}

