<?php


class Checkeuro extends MY_Controller
{
    private $modelLog;
    
    function __construct(){
        parent::__construct();
        $this->load->model('Modellog');
        $this->modelLog = new Modellog();
    }
    
    
    /**
     * Comprueba el valor actual del EURO
     */
    public function index(){
        
        $url = 'https://contenido.bce.fin.ec/home1/economia/cotizaciones/PromMonedaRangoFechas.jsp';
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query(
                    array(
                        'fecInicio' =>  date('d-m-Y'),
                        'fecFin' => date('d-m-Y'),
                        'abrevMoneda' => 'EUR'
                    )
                    ),
                'timeout' => 60
            )
        ));
      
       $resp = file_get_contents($url, FALSE, $context);       
       $resp = str_replace('#000066', '#ffffff', $resp);
       print($resp);
      
    }
    
    
}

