<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modulo encargado de manejar las sesiones
 *
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class MY_Controller extends CI_Controller
{
    private $modelBase;
    private $modelLog;
    protected  $sgi_url = 'http://localhost:5000/';
    
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    /**
     * inicia chequeos en el almacenaje y
     * sesiones de usuarios
     */
    private function init(){
        $this->_checkSession();
        $this->load->model('modelbase');
        $this->load->model('Modellog');
        $this->modelBase = new ModelBase();
        $this->modelLog = new Modellog();

    }
    
    /**
     * Verofica la sesion del usuario, si la sesion no existe
     * redirecciona al formulario de autenticacion
     */
    public function _checkSession()
    {         
        
        if (array_key_exists('id_user', $_SESSION) == False) {
            if (current_url() != base_url() . 'index.php') {
                return $this->redirectPage('loginForm');
            }
            
        } else {
            return true;
        }
    }
    
    
    /**
     * controla las columnas y la longitud de sus valores
     * @param (array) $paramsdata => Parametros minimos
     * @param (array) $data => info Formulario
     *
     * @return (array)
     *
     *    $validationResult = [
     *    'status' => true | false
     *    'columns' => (array) columnas que no existen
     *    'len' => (array) longitudes que no se cumplen,
     * ];
     */
    public function _checkColumnsData($paramsData, $data)
    {
        $validationResult = [
            'status' => true,
            'columns' => [],
            'len' => [],
        ];
        
        foreach ($paramsData as $param => $value) {
            if (isset($data[$param])) {
                if (strlen($data[$param]) < ($value - 1)) {
                    array_push($validationResult['len'], $param);
                    $validationResult['status'] = false;
                }
            } else {
                array_push($validationResult['columns'], $param);
                $validationResult['status'] = false;
            }
        }
        return $validationResult;
    }
    
    
    
    /**
     * Formatea los arreglos para presentar en los informes 
     * 
     * @param array $data
     * @return array
     */
    public function _formatData(array $data): array 
    {
        $formatted_data = [];
        $headder = [];
        $first = True;
        
        foreach ($data as $idx => $value){
            $row = [];
            foreach ($value as $k => $v){
                array_push($headder, $k);                    
                array_push($row, $v);
            }
            
            if ($first){
                array_push($formatted_data, $headder);
                $first = False;
            }
            
            array_push($formatted_data, $row);
        }
        
        return $formatted_data;    
    }
    
    
    /**
     * Redirecciona a cualquier pagina del sitio, se registra en el log 
     * los redireccionamientos
     * htttp://ip/index.php/controller/method/params/
     *
     * @param $page => pagename
     * @param $id => primer parametro de la funcion
     * @param $id2 => segundo parametro de la funcion
     *
     * @return void | bool
     */
    public function redirectPage(string $page, $id = false, $id2 = false)
    {      
        $target = [
            'loginForm' =>  'index.php/login/',
            'home' =>  'index.php/home',
            'ordersList' => 'index.php/pedido/listar',
            'insertWeigth' => 'index.php/detallepedido/ActualizarPeso',
            'orderInvoicePresent' => 'index.php/pedidofactura/presentar',
            'orderDetailAdd' => 'index.php/detallepedido/nuevo',
            'infoInvoiceShow' => 'index.php/facinformativa/presentar',
            'infoInvoiceNew' => 'index.php/facinformativa/nuevo',
            'newProductInfoInvoice' => 'index.php/facinfdetalle/nuevo',
            'nationalizationNew' => 'index.php/nacionalizacion/nuevo',
            'presentOrder' =>  'index.php/pedido/presentar',
            'paidsList' => 'index.php/facturapagos/listar/',
            'paidPresent' => 'index.php/facturapagos/presentar',
            'paidDetailNew' => 'index.php/detallefacpago/nuevo',
            'productsList' => 'index.php/producto/listar',
            'productPresent' => 'index.php/producto/presentar',
            'validargi' =>  'index.php/gstinicial/validargi',
            'presentInvoiceOrder' =>  'index.php/pedidofactura/presentar',
            'parcial' =>  'index.php/gstnacionalizacion/parcial',
            'newParcial' => 'index.php/parcial/nuevo',
            'supplierPresent' => 'index.php/proveedor/presentar',
            'supplierNew' => 'index.php/proveedor/nuevo',
            'suppliersList' => 'index.php/proveedor/listar',
            'showTaxesParcial' => 'index.php/impuestos/pc',            
            'showTaxesOrder' => 'index.php/impuestos/pd',
            'showTaxesParcialLiquidate' => 'index.php/reliquidacion/pc',
            'showTaxesOrderLiquidate' => 'index.php/reliquidacion/pd',
            'showParcial' => 'index.php/parcial/presentar',
            'import_wizard' => 'index.php/importar/',
        ];


        header('Status: 301 Moved Permanently', false, 301);
        if ($id) {
            if($id2){
                return(header(
                                'Location: ' . 
                                 base_url() . 
                                $target[$page] . 
                                '/' . 
                                $id  . 
                                '/' . 
                                $id2
                            ));
            }
            
            return( header(
                            'Location: ' . 
                            base_url() . 
                            $target[$page] . 
                            '/' . 
                            $id
                        ));
        }
        
        print '<h3 style="color:#565420"> Error sesion no iniciada :( </h3>';
        print '<br />';
        print '<a href="' . base_url(). '"><button><h3>Formulario Login</h3></button></a>';
        return ( header('Location: ' . base_url() . $target[$page]));      
        exit(0);
    }
}