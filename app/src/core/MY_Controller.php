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
        $this->modelBase = new ModelBase();
    }

    /**
     * Verofica la sesion del usuario, si la sesion no existe
     * redirecciona al formulario de autenticacion
     */
    public function _checkSession()
    {
        if (!($this->session->userdata('id_user'))) {
            $this->session->sess_destroy();
            if (current_url() != base_url() . 'index.php') {
                $this->redirectPage('loginForm');
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
     * Redirecciona a cualquier pagina del sitio
     * htttp://ip/index.php/controller/method/params/
     *
     * @param $page => pagename
     * @param $id => identificator Row
     *
     * @return void | bool
     */
    public function redirectPage(string $page, $id = false)
    {
        $target = [
            'loginForm' =>  'index.php/login/',
            'home' =>  'index.php/home',
            'ordersList' => 'index.php/pedido/listar',
            'orderInvoicePresent' => 'index.php/pedidofactura/presentar',
            'infoInvoiceShow' => 'index.php/facinformativa/presentar',
            'infoInvoiceNew' => 'index.php/facinformativa/nuevo',
            'newProductInfoInvoice' => 'index.php/facinfdetalle/nuevo',
            'nationalizationNew' => 'index.php/nacionalizacion/nuevo',
            'presentOrder' =>  'index.php/pedido/presentar',
            'paidsList' => 'index.php/facturapagos/listar/',
            'paidPresent' => 'index.php/facturapagos/presentar',
            'paidDetailNew' => 'index.php/detallefacpago/nuevo/',
            'supplierPresent' => 'index.php/proveedor/presentar',
            'supplierNew' => 'index.php/proveedor/nuevo',
            'suppliersList' => 'index.php/proveedor/listar',
            'productsList' => 'index.php/producto/listar',
            'productPresent' => 'index.php/producto/presentar',
            'validargi' =>  'index.php/gstinicial/validargi',
            'replaceIncoterms' =>   'index.php/gstinicial/replaceIncoterms',
            'putIncoterms' => 'index.php/gstinicial/putIncoterms',
            'presentInvoiceOrder' =>  'index.php/pedidofactura/presentar',
            'closeInitExpenses' =>  'index.php/gstinicial/cerrarGastosIniciales',
            'validar70' =>  'index.php/gstnacionalizacion/validar70',
        ];
        header('Status: 301 Moved Permanently', false, 301);
        if ($id) {
            header('Location: ' . base_url() . $target[$page] . '/' . $id);
            return true;
        }
        header('Location: ' . base_url() . $target[$page]);
    }
    
    
        
    /**
     * Obtiene el tiempo en dias de un pedido en la bodega inicial
     * si el pedido se encuentra nacionalizado o tiene una factura
     * informativa retorna el tiempo que estubo en la bodega inicial
     *
     * @param array $order
     *            pedido a evaluar
     * @return int
     */
    protected function getWarenHouseDaysInitial(array $order): int
    {
        if (gettype($order['fecha_salida_bodega_puerto']) == 'NULL') {
            return (dateDiffInDays(strtotime($order['fecha_arribo']), date('Y-m-d')));
        }
        return (dateDiffInDays($order['fecha_arribo'], $order['fecha_salida_bodega_puerto']));
    }
    
    
}