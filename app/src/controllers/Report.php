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
    private $modelReportProvisiones;
    private $empresa;
    
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
        $this->load->model('ModelReportProvisiones');
        $this->modelReportProvisiones = new ModelReportProvisiones();
        $this->empresa = selectCompany('cordovez');
    }
        
    
    public function gastosiniciales(string $nro_pedido){
        $data = $this->modelReportProvisiones->getbyOrder($nro_pedido);       
        
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($this->empresa['name']);
        $pdf->SetTitle('Reporte General De Gastos Iniciales');
        $pdf->SetSubject('Reporte de Proviciones Iniciales');
        $pdf->SetKeywords('Importaciones, PDF, pedidos');
        
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Reporte de Gastos Iniciales Pedido ' . $nro_pedido, $this->empresa['name'] );
        
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
        
        // ---------------------------------------------------------
        
        // set font
        $pdf->SetFont('helvetica', '', 10);
        
        // add a page
        $pdf->AddPage();
        
        #$pdf->Write(0, 'Detalle de proviciones iniciales pedido ' . $nro_pedido , '', 0, 'L', true, 0, false, false, 0);
        #$pdf->Write(1, '', '', 0, 'L', true, 0, false, false, 0);
        
        
        $pdf->SetFont('helvetica', '', 9);
        
        // -----------------------------------------------------------------------------
        
     
        // Table with rowspans and THEAD
        $tbl = '
            <strong>Detalle de los pedidos de la casa</strong>
            <br/>
            <img src="http://179.49.60.158:8888/img/logo_imnac.jpg" >
            <br/>
            <table border="1" cellpadding="1" class="table">
            <thead>
             <tr style="background-color:#333333;color:#FFFFFF;">
              <td width="170" align="center"><b>Detalle Provisión</b></td>
              <td width="150" align="center"><b>Proveedor</b></td>
              <td width="80" align="center"> <b>Factura</b></td>
              <td width="80" align="center"><b>Fecha</b></td>
              <td width="60" align="center"><b>Provisión</b></td>
              <td width="60" align="center"><b>Justif</b></td>
              <td width="60" align="center"><b>Saldo</b></td>
             </tr>
            </thead>
                {{items}}
            </table>';
        
        $items = '';
        
        foreach ($data as $k => $exp){
            $items .= '<tr>';
            $items .= '<td width="170" align="left">' . $exp['Concepto'] .  '</td>';
            $items .= '<td width="150" align="left">sds' . '</td>';
            $items .= '<td width="80" align="rigth">asas' . '</td>';
            $items .= '<td width="80" align="rigth">' . $exp['Fecha Provisión'] . '</td>';
            $items .= '<td width="60" align="rigth">' . $exp['Valor Provisionado'] . '</td>';
            $items .= '<td width="60" align="rigth">asas' . '</td>';
            $items .= '<td width="60" align="rigth">asas' . '</td>';
            $items .= '</tr>';
        }
        
       $tbl2 = str_replace('{{items}}', $items, $tbl);      
       
       $tbl2 .= '<br/><br/><br/><br/><br/><br/><br/> strong Firma: __________________';
       
       $pdf->writeHTML($tbl2, true, false, false, false, '');
       
      
       
    
        // -----------------------------------------------------------------------------
        
        //Close and output PDF document
        $pdf->Output('reporteGastosIniciales.pdf', 'I');
        
        //============================================================+
        // END OF FILE
        //============================================================+
    }
    
}
