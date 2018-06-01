<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Modulo encargado de manejar los proveedores, CRUD y validaciones
 *
 * @package CordovezApp
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Copyright (c) 2014, Agencias y Representaciones Cordovez S.A.
 * @license Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link https://gitlab.com/eduardo/APPImportaciones
 * @since Version 1.0.0
 * @filesource
 */
class Facinformativa extends MY_Controller 
{
    private $controller = "factura_informativa";
    private $template = '/pages/pageFactutaInformativa.html';
    private $almaceneraId = '0990304262001';
    private $modelOrder;
    private $modelUser;
    private $modelSupplier;
    private $modelExpenses;
    private $modelOrderInvoice;
    private $modelOrderInvoiceDetail;
    private $modelInfoInvoice;
    private $modelInfoInvoiceDetail;
    private $modelNationalization;
    private $modelProduct;
    private $modelLog;
    private $myModel;
    private $modelParcial;
    
    /**
     * Constructor de la funcion
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    /**
     * Carga los modelos a usar en la clase
     *
     * @return void
     */
    private function init()
    {
        if(! isset($this->session->userdata['id_user'])){
            exit(0);
        }
        
        $this->load->model('modelorder');
        $this->load->model('modeluser');
        $this->load->model('modelsupplier');
        $this->load->model('modelexpenses');
        $this->load->model('modelorderinvoice');
        $this->load->model('modelorderinvoicedetail');
        $this->load->model('modelinfoinvoice');
        $this->load->model('modelinfoinvoicedetail');
        $this->load->model('modelproduct');
        $this->load->model('mymodel');
        $this->load->model('modellog');
        $this->load->model('Modelparcial');
        $this->modelParcial = new Modelparcial();
        $this->modelOrder = new Modelorder();
        $this->modelUser = new Modeluser();
        $this->modelSupplier = new Modelsupplier();
        $this->modelExpenses = new Modelexpenses();
        $this->modelOrderInvoice = new Modelorderinvoice();
        $this->modelOrderInvoiceDetail = new Modelorderinvoicedetail();
        $this->modelInfoInvoice = new Modelinfoinvoice();
        $this->modelInfoInvoiceDetail = new Modelinfoinvoicedetail();
        $this->modelProduct = new Modelproduct();
        $this->modelLog = new Modellog();
        $this->myModel = new Mymodel();
    }
    
    /**
     * Redirecciona a la lista de pedidos
     */
    public function index()
    {
        $this->modelLog->redirectLog(
            'Redireccionamiento por acceso directo a metodos',
            current_url()
            );        
        $this->redirectPage('ordersList');
        return true;
    }
    
    /**
     * Muestra a detalle una factura informativa
     *
     * @param integer $idFacInformative
     * @return bool | template
     */
    public function presentar($idFacInformative)
    {
        $infoInvoice = $this->modelInfoInvoice->get($idFacInformative);
        
        if ($infoInvoice == false) {
            return($this->index());
        }
        
        $parcial = $this->modelParcial->get($infoInvoice['id_parcial']);
        $order = $this->modelOrder->get($parcial['nro_pedido']);
        $supplier = $this->modelSupplier->get(
                $infoInvoice['identificacion_proveedor']
            );
        
        $orderInvoices = $this->modelOrderInvoice->getbyOrder(
                                $order['nro_pedido']
            );
        
        $infoInvoice['details'] = $this->modelInfoInvoiceDetail->
                                        getByFacInformative($idFacInformative);
        
        if (gettype($infoInvoice['details']) == 'array') {
            foreach ($infoInvoice['details'] as $item => $val) {
                $invoiceOrderDetail = $this->modelOrderInvoiceDetail->get(
                    $val['detalle_pedido_factura']
                    );
                $infoInvoice['details'][$item]['product'] = 
                                        $this->modelProduct->get(
                                            $invoiceOrderDetail['cod_contable']
                                                        );
                $infoInvoice['details'][$item]['oderDetail'] = 
                                                            $invoiceOrderDetail;
            }
        }
                
        $this->responseHttp([
            'show' => true,
            'titleContent' => 'Pedido [' . $order['nro_pedido'] . '] ' . 
                                ' Detalle Factura Informativa [ <small> ' . 
                                $infoInvoice['nro_factura_informativa'] . 
                                ' => ' . $supplier['nombre'] . '</small> ]',
            'order' => $order,
            'infoInvoice' => $infoInvoice,
            'parcial' => $parcial,
            'supplier' => $supplier,
            'user' => $this->modelUser->get($infoInvoice['id_user'])
        ]);
    }
    
    /**
     * Presenta el formulario para registrar una nueva factura informativa
     * las facturas informativas solo se usan con regimen 70
     *
     * @param (string) $nroOrder pedido al que 
     * @return void
     */
    public function nuevo(int $idParcial)
    {
        $parcial = $this->modelParcial->get($idParcial);

        if ($parcial == false) {
            $this->modelLog->redirectLog($this->controller . ',nuevo,' . current_url());
            $this->index();
            return false;
        }
        
        $order =  $this->modelOrder->get($parcial['nro_pedido']);
        $invoicesOrder = $this->modelOrderInvoice->getbyOrder($parcial['nro_pedido']);
        
        if ($invoicesOrder != false) {
            foreach ($invoicesOrder as $item => $invoiceOrder) {
                $invoiceOrder['details'] = 
                            $this->modelOrderInvoiceDetail->getByOrderInvoice(
                                $invoiceOrder['id_pedido_factura']
                    );
                $invoiceOrder['supplier'] = $this->modelSupplier->get(
                    $invoiceOrder['identificacion_proveedor']
                    );
                $invoiceOrder['user'] = $this->modelUser->get(
                    $invoiceOrder['id_user']
                    );
                $invoicesOrder[$item] = $invoiceOrder;
            }
        }
        
        $infoInvoices = $this->modelInfoInvoice->getByParcial($parcial['nro_pedido']);
        if ($infoInvoices != false) {
            foreach ($infoInvoices as $item => $infoInvoice) {
                $infoInvoice['supplier'] = $this->modelSupplier->get(
                    $infoInvoice['identificacion_proveedor']
                    );
                $infoInvoice['details'] = 
                            $this->modelInfoInvoiceDetail->getByFacInformative(
                                $infoInvoice['id_factura_informativa']
                                );
                $infoInvoice['user'] = $this->modelUser->get(
                    $infoInvoice['id_user']
                    );
                $infoInvoices[$item] = $infoInvoice;
            }
        }
        
        return $this->responseHttp([
            'create_invoice' => true,
            'order' => $order,
            'parcial' => $parcial,
            'invoicesOrder' => $invoicesOrder,
            'infoInvoices' => $infoInvoices,
            'supplier' => $this->modelsupplier->get($this->almaceneraId),
            'haveEuros' => $this->orderHaveEuros($order['nro_pedido']),
            'sumsValues' => $this->myModel->getValuesOrder($order),
            'warenHouseDays' => $this->getWarenHouseDaysInitial($order),
            'titleContent' => 'Ingreso de Factura Informativa Pedido: [' . 
                                $order['nro_pedido'] . ']',
            'user' => $this->modelUser->get($order['id_user'])
        ]);
    }
    
    /**
     * Prepara el formulario para editar una factura informativa
     *
     * @param integer $idFacInformative
     *            id_factura_informativa
     * @return string Template
     */
    public function editar($idFacInformative)
    {
        $infoInvoice = $this->modelInfoInvoice->get($idFacInformative);
        if ($infoInvoice == false) {
            $this->redirectPage('ordersList');
            $this->modelLog->redirectLog(
                                $this->controller . ',editar,' . current_url()
                );
            return false;
        }
        $parcial = $this->modelParcial->get($infoInvoice['id_parcial']);
        $order = $this->modelOrder->isRegimen70($parcial['nro_pedido']);
        $invoicesOrder = $this->modelOrderInvoice->getbyOrder(
            $parcial['nro_pedido']
            );
        $invoicesOrderTemp = [];
        if ($invoicesOrder != false) {
            foreach ($invoicesOrder as $item => $invoiceOrder) {
                $invoiceOrder['details'] = 
                            $this->modelOrderInvoiceDetail->getByOrderInvoice(
                                $invoiceOrder['id_pedido_factura']
                                );
                $invoiceOrder['supplier'] = $this->modelSupplier->get(
                    $invoiceOrder['identificacion_proveedor']
                    );
                $invoiceOrder['user'] = $this->modelUser->get(
                    $invoiceOrder['id_user']
                    );
                $invoicesOrderTemp[$item] = $invoiceOrder;
            }
        }
        $infoInvoices = $this->modelInfoInvoice->getByParcial(
            $parcial['id_parcial']
            );
        $olderPartials = 0;
        $infoInvoicesTemp = [];
        if ($infoInvoices != false) {
            foreach ($infoInvoices as $item => $infoInvoice) {
                $infoInvoice['supplier'] = $this->modelSupplier->get(
                    $infoInvoice['identificacion_proveedor']
                    );
                $infoInvoice['details'] = 
                            $this->modelInfoInvoiceDetail->getByFacInformative(
                                $infoInvoice['id_factura_informativa']
                                );
                $infoInvoice['user'] = $this->modelUser->get(
                    $infoInvoice['id_user']
                    );
                $infoInvoicesTemp[$item] = $infoInvoice;
                $olderPartials += 1;
            }
        }
        return $this->responseHttp([
            'edit_invoice' => true,
            'order' => $order,
            'invoicesOrder' => $invoicesOrderTemp,
            'infoInvoices' => $infoInvoicesTemp,
            'infoInvoice' => $this->modelInfoInvoice->get($idFacInformative),
            'supplier' => $this->modelsupplier->get($this->almaceneraId),
            'haveEuros' => $this->orderHaveEuros($parcial['nro_pedido']),
            'sumsValues' => $this->myModel->getValuesOrder($order),
            #            'warenHouseDays' => $this->getWarenHouseDaysPartials($order),
            'olderPartials' => $olderPartials,
            'titleContent' => 'Modificar Factura Informativa Pedido: [' . 
                                $parcial['nro_pedido'] . ']',
            'user' => $this->modelUser->get($order['id_user']),
        ]);
    }
    
    /**
     * Valida y gusrada una factura informativa si no existe redirecciona a pedidos
     *
     * @param (array) $inputdata
     * @return void
     */
    public function validar()
    {
        if (! $_POST) {
            $this->modelLog->redirectLog(
                    $this->controller . ',validar,' . current_url()
                );
            $this->redirectPage('ordersList');
            return true;
        }
        
        $infoInvoice = $this->input->post();
        $nroOrder = $infoInvoice['nro_pedido'];
        unset($infoInvoice['nro_pedido']);
        
        $infoInvoice['fecha_emision'] = str_replace(
                    '/', 
                    '-', 
                    $infoInvoice['fecha_emision']
            );
        
        $infoInvoice['fecha_emision'] = date(
                'Y-m-d', 
                strtotime($infoInvoice['fecha_emision'])
            );
        
        $infoInvoice['id_user'] = $this->session->userdata('id_user');
        
        if (
            ($this->modelInfoInvoice->existRow($infoInvoice) > 0) && 
            (! isset($infoInvoice['id_factura_informativa']))
            ){
            
            $this->modelLog->errorLog(
                'Registro Duplicado ' . 
                current_url()
                );
            
            return ($this->responseHttp([
                'titleContent' => 'La Factura Informativa [' . 
                                    $infoInvoice['nro_factura_informativa'] . 
                                   '] ya se ecuentra Registrada!.',
                'viewMessage' => true,
                'message' => 'EL Registro que intenta ingresar ya Existe.',
                'duplicateRow' => true,
                'idInfoInvoice' => $this->modelInfoInvoice->existRow(
                                                                $infoInvoice
                    ),
            ]));
        }
        
        $status = $this->validData($infoInvoice);
        if ($status['status']) {
            if (! isset($infoInvoice['id_factura_informativa'])) {
                if ($lastId = $this->modelInfoInvoice->create($infoInvoice)) {
                    return ($this->redirectPage(
                                            'newProductInfoInvoice', $lastId
                        ));
                }
            } else {
                $infoInvoice['last_update'] = date('Y-m-d H:m:s');
                if ($this->modelInfoInvoice->update($infoInvoice)) {
                    return ($this->redirectPage(
                            'infoInvoiceShow', 
                            $infoInvoice['id_factura_informativa'])
                        );
                }
                
            }
        } else {
            $order = $this->modelOrder->get($nroOrder);
            return ($this->responseHttp([
                'viewMessage' => 'true',
                'titleContent' => 'Verifique la información ingresada',
                'create_invoice' => true,
                'order' => $order,
                'supplier' => $this->modelsupplier->get($this->almaceneraId),
                'haveEuros' => $this->orderHaveEuros($order['nro_pedido']),
                'sumsValues' => $this->myModel->getValuesOrder($order),
                'message' => 'La información de uno de los campos es incorrecta!.',
                'user' => $this->modelUser->get($order['id_user']),
                'formError' => true,
                'data' => $status,
                'infoInvoice' => $infoInvoice
            ]));
        }
    }
    
    /**
     * Elimina una factura informativa de la base de datos, solo si esta
     * no tiene dependencias
     *
     * @param integer $idFacInformativa
     * @return bool | template
     */
    public function eliminar($idFacInformative)
    {
        $infoInvoice = $this->modelInfoInvoice->get($idFacInformative);
        if ($infoInvoice == false) {
            $this->redirectPage('ordersList');
            return false;
        }
        if ($this->modelInfoInvoice->delete($idFacInformative)) {
            $this->redirectPage('presentOrder', $infoInvoice['nro_pedido']);
        } else {
            $this->responseHttp([
                'titleContent' =>   'No se puede eliminar el registro <small>' .
                                    ' Factura Informativa [ ' . 
                                    $infoInvoice['nro_factura_informativa'] . 
                                    ' ] </small> ',
                'viewMessage' => true,
                'deleted' => true,
                'message' => 'No puede ser eliminado, tiene dependencias',
                'id_row' => $infoInvoice['id_factura_informativa'],
                'order' => $infoInvoice['nro_pedido']
            ]);
        }
    }
    
    
    /**
     * Verifica si el pedido tiene una factura en euros
     *
     * @param $nroOrder =>
     *            Numero de la orden
     * @return boolean
     */
    private function orderHaveEuros($nroOrder)
    {
        $order = $this->modelOrder->get($nroOrder);
        $haveEuros = $this->modelOrderInvoice->haveEuros($nroOrder);
        
        if($haveEuros){
            return ([
                'euros' => true,
                'tipo_cambio' => $order['tipo_cambio_almaceneraR70'],
            ]);
        }
        return false;
    }
    
    
    /**
     * Obtiene el tiempo en dias de un pedido en la almacenera publica
     * desde la fecha_ingreso_almacenera, si el pedido se encuentra cerrado
     * se calcula hasta fecha_salida_Almacenera
     *
     * @param array $order
     *            pedido a evaluar
     * @return int
     */
    private function getWarenHouseDays(array $order): int
    {           
        if (gettype($order['fecha_salida_almacenera']) == 'NULL') {
            return (
                dateDiffInDays($order['fecha_ingreso_almacenera'], 
                date('Y-m-d'))
                );
        }
        
        return (dateDiffInDays(
            $order['fecha_ingreso_almacenera'], 
            $order['fecha_salida_almacenera']
            )
            );
    }
    
    
    
    /**
     * Se validan las columnas que debe tener la consulta para que no falle
     *
     * @return [array] | [bolean]
     */
    private function validData($data)
    {
        $columnsLen = array(
            'nro_factura_informativa' => 2,
            'id_parcial' => 1,
            'identificacion_proveedor' => 13,
            'flete_aduana' => 1,
            'fecha_emision' => 10,
            'seguro_aduana' => 1,
            'id_user' => 1
        );
        return $this->_checkColumnsData($columnsLen, $data);
    }
    
    /*
     * Envia la respuestas html al navegador
     * @param array $config Arreglo con info de la plantilla
     * @return template
     */
    private function responseHttp($config)
    {
        $config['base_url'] = base_url();
        $config['title'] = 'Factura Informativa';
        $config['rute_url'] = base_url() . 'index.php/';
        $config['controller'] = $this->controller;
        $config['iconTitle'] = 'fa-file';
        $config['content'] = 'home';
        return $this->twig->display($this->template, $config);
    }
}
