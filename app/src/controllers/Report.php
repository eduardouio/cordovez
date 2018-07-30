<?php defined('BASEPATH') or exit('No direct script access allowed');

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
        $this->load->model('Modelreportexpenses');
        $this->load->model('Modeluser');
        $this->load->model('Modelorder');
        $this->modelUser = new Modeluser();
        $this->modelOrder = new Modelorder();
        $this->modelReportExpenses = new Modelreportexpenses();
        $this->empresa = selectCompany('cordovez');
    }
        
    
    /**
     * Obtiene los gastos iniciales de un pedido
     */
    public function gastosiniciales($nro_order){
        $data = $this->modelReportExpenses->getInitiExpenses($nro_order);
        $report_data = [
            'data' => $data,
            'title_report' => 'Gastos Iniciales',       
            'fecha' => date('d/m/Y H:m:s'),
            'user' => $this->modelUser->get($this->session->userdata('id_user')),
            'order' => $this->modelOrder->get($nro_order),
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
     * Genera la bade de un pdf 
     * @param string $author
     * @param string $title
     */
    private function basePDF(string $author, string $title, string $nro_pedido, string $html){   
        
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);       
        
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($author);
        $pdf->SetTitle($title);
        $pdf->SetSubject($author);
        $pdf->SetKeywords('Importaciones, PDF, pedidos');
        
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Reporte de Gastos Iniciales Pedido ' . $nro_pedido, $author );
        
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