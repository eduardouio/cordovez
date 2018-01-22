<?php


class Parcial extends MY_Controller
{
    
    private $modelParcial;
    private $modelOrder;
    private $modelInfoInvoice;
    private $modelLog;
    private $modelProduct;
    
    
    /**
     * constructor de clase
     */
    function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    
    /**
     * Inicia los modelos de la clase
     * @return void
     */
    public function init()
    {
        $this->load->model('Modelparcial');
        $this->load->model('Modelorder');
        $this->load->model('Modelinfoinvoice');
        $this->load->model('Modellog');
        $this->load->model('Modelproduct');
        $this->modelParcial = new Modelparcial();
        $this->modelOrder = new Modelorder();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelLog = new Modellog();
        $this->modelProduct = new Modelproduct();
    }
    
    
    /**
     * metodo inicial de la clase
     */
    public function index()
    {
        print 'Bienvenido al Cambio ';
    }
    
    
    /**
     * Genera un nuevo parcial en la base de datos
     * luego redirecciona al formulario de factura informativa
     * @param string $nroOrder
     */
    public function nuevo(string $nroOrder)
    {
        $parcial = [
            'id_user' => $this->session->userdata('id_user'),
        ];
        
        if($this->modelParcial->create($parcial)){
            print $this->db->insert_id();
        }
        
        $this->modelLog->errorLog('No se pudo crear un nuevo parcial', $this->db->last_query());
        return(print 'No se puede continuar si el parcial no puede ser creado');
    }
    
    
    
    
}
