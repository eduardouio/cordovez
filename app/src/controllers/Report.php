<?php defined('BASEPATH') or exit('No direct script access allowed');
$libraries_url = realpath(dirname(__FILE__));
$libraries_url = str_replace('controllers', 'libraries/', $libraries_url);
/**
 * Controller encargado de manejar los parciales de los pedidos
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class Report extends MY_Controller{
    private $modelLog;
    private $empresa;
    private $modelReportExpenses;
    private $modelUser;
    private $modelOrder;
    private $modelParcial;
    private $modelInfoInvoice;
    private $modelOrderInvoice;
    private $modelSupplier;
    private $template = '/reports/report_init_expenses.html';
    function __construct(){
        parent::__construct();
        $this->init();
    }
    
    /**
     * Inicia los modelos de la clase
     */
    public function init(){
        if(! isset($this->session->userdata['id_user'])){
            exit(0);
        }
        $this->load->library('Pdf');
        
        $models = [
            'Modelreportexpenses',
            'Modeluser',
            'Modelorder',
            'Modelparcial',
            'Modelorderinvoice',
            'Modelinfoinvoice',
            'Modelsupplier',
        ];
        
        foreach ($models as $model){
            $this->load->model($model);
        }
        $this->modelSupplier = new Modelsupplier();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelParcial = new Modelparcial();
        $this->modelUser = new Modeluser();
        $this->modelOrder = new Modelorder();
        $this->modelReportExpenses = new Modelreportexpenses();
        $this->empresa = selectCompany($GLOBALS['selected_enterprise']['enterprise']);
    }
        
    
    /**
     * Obtiene los gastos iniciales de un pedido
     */
    public function gastosiniciales($nro_order){
        $data = $this->modelReportExpenses->getExpenses($nro_order);
        $order = $this->modelOrder->get($nro_order);
        $invoice = $this->getInvoice('order', $nro_order);
        
        #$invoice['tipo_cambio'] = ($order['tipo_cambio_impuestosR10']) ? 0 : 1;
        
        $report_data = [
            'data' => $data,
            'title_report' => 'Gastos Iniciales',       
            'fecha' => date('d/m/Y H:m:s'),
            'user' => $this->modelUser->get($this->session->userdata('id_user')),
            'order' => $order,
            'invoice' => $invoice,
            'taxes' => $this->modelReportExpenses->getTributes($nro_order),
            'regimen' => $order['regimen']
        ];
        
        $html = $this->twig->render($this->template, $report_data); 
        return (
            $this->basePDF(
                'Agencias y Representaciones Cordovez S.A.', 
                'Reporte Gastos Iniciales' , 
                $nro_order, $html)
            );
    }
    
    
    /**
     * Retorna los gastos del parcial
     * @param int $id_parcial
     */
    public function gastosnacionalizacion(int $id_parcial){
        $data = $this->modelReportExpenses->getExpenses('000-00',$id_parcial);
        $parcial = $this->modelParcial->get($id_parcial);
        $all_parcials = $this->modelParcial->getByOrder($parcial['nro_pedido']);
        $nro_parcial = ordinalNumberParcial($all_parcials, $id_parcial);
        $order = $this->modelOrder->get($parcial['nro_pedido']);        
        $invoice = $this->getInvoice('parcial', $id_parcial);       
        $order['nro_refrendo'] = $invoice['nro_refrendo'];
        $invoice['tipo_cambio'] = $parcial['tipo_cambio'];        
        
        $report_data = [
            'data' => $data,
            'fecha_vencimiento_ultimo_almacenaje' => $this->getDateEndWarenhouse($data),
            'title_report' => 'Gastos Parcial ' . $nro_parcial ,
            'fecha' => date('d/m/Y H:m:s'),
            'user' => $this->modelUser->get($this->session->userdata('id_user')),
            'nro_pedido' => $parcial['nro_pedido'],
            'taxes' => $this->modelReportExpenses->getTributes('000-00', $id_parcial),
            'order' => $order,
            'invoice' => $invoice,
            'nro_parcial' => $nro_parcial,
            'id_parcial' => $id_parcial,
            'enterprise' => $GLOBALS['selected_enterprise'],
        ];
        
        $html = $this->twig->render($this->template, $report_data);
        return (
            $this->basePDF(
                'Agencias y Representaciones Cordovez S.A.',
                'Reporte Gastos Parcial ' . $nro_parcial ,
                $parcial['nro_pedido'], $html)
            );
    }
    
    
    /**
     * Obtiene la fecha de fin del ultimo almacenje
     * @param  $parcial
     */
    private function getDateEndWarenhouse($data){
        if(is_null($data)){
            return Null;
        }
        
        foreach ($data as $k => $exp){
            if(preg_match('/[a-zA-Z]-[0-9]/', $exp['concepto'])){
                $x = count($data) -1 ;
                return $data[$x]['fecha_fin'];
            }
        }       
        return Null;
    }
    
    
    /**
     * Retorna la informacion de la factura de un pedido o parcial 
     * 
     * @param string $type [order|parcial]
     * @param string $id [nro_pedido, id_parcial]
     * 
     * @return array $invoice
     */
    private function getInvoice(string $type , string $id): array{
        $invoice = [
            'nro_factura' => '',
            'proveedor' => '',
        ];
        
        #obtenemos la factura del pedido
        if($type == 'order'){
            $order_invoice = $this->modelOrderInvoice->getbyOrder($id);
            $order_invoice = $order_invoice[0];            
            
            $supplier = $this->modelSupplier->get($order_invoice['identificacion_proveedor']);           
            $invoice['nro_factura']  = $order_invoice['id_factura_proveedor'];
            $invoice['proveedor'] = $supplier['nombre'];
            return (array_merge($invoice, $order_invoice));
        }
        
        $info_invoice = $this->modelInfoInvoice->getByParcial($id);
        $info_invoice = $info_invoice[0];
        $supplier = $this->modelSupplier->get($info_invoice['identificacion_proveedor']);
        $invoice['nro_factura'] = $info_invoice['nro_factura_informativa'];
        $invoice['proveedor'] = $supplier['nombre'];
        return(array_merge($invoice, $info_invoice)); 
    }
    
    
    /**
     * Genera la bade de un pdf 
     * @param string $author
     * @param string $title
     */
    private function basePDF(string $author, string $title, string $nro_pedido, string $html){   
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);       
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($author);
        $pdf->SetTitle($title . ' Pedido' . $nro_pedido);
        $pdf->SetSubject($author);
        $pdf->SetKeywords('Importaciones, PDF, pedidos');
        
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->empresa['name'], $this->empresa['ruc'], $this->empresa['address'] );
        
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        
        
        $pdf->SetFont('helvetica', '', 8);       
        $pdf->AddPage();                  
        $pdf->writeHTML($html, true, false, true, false, '');
            
        
        //Close and output PDF document
        $pdf->Output('report.pdf', 'I');
            }      
    
}