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
        $this->checkOpenOrders();
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
        ];

        header('Status: 301 Moved Permanently', false, 301);
        if ($id) {
            header('Location: ' . base_url() . $target[$page] . '/' . $id);
            return true;
        }
        header('Location: ' . base_url() . $target[$page]);
    }
    
    
    /**
     * comprueba si se ha generado un nuevo peiodo de bodegaje
     * si exite crea un nuevo gasto de nacionalizacion
     * return boolean
     */
    private function checkOpenOrders(){
        $openOrders = $this->modelBase->get_table([
            'select' => ['nro_pedido', 'fecha_ingreso_almacenera'],
            'table' => 'pedido',
            'where' => [
                'bg_haveExpenses' => 1,
                'bg_isclosed' => 0,
                'regimen' => 70,
            ],
            'orderby' => [
                'nro_pedido' => 'DESC',
            ],
        ]);
        
        if ($openOrders == false){
            error_log("\n[Error][" . date("D, d M Y H:i:s") . "] No se encontraron pedidos que coincidan con la busqueda ", 3 , "/var/www/html/app/src/logs/app.log");
            return false; 
        }
        foreach ($openOrders as $item => $order){
            if($order['fecha_ingreso_almacenera'] == null ){
                error_log("\n[Alerta][" . date("D, d M Y H:i:s") . "] Pedido mal cerrado [" . $order['nro_pedido'] .  "]", 3 , "/var/www/html/app/src/logs/app.log");
                return false;
            }
             $this->checkWarenhosePeriodOrder($order);
        }
        return true;
    }
    
    
    /**
     * Calcula la fecha y crea un regiostro de gasto gasto nacionalizacion
     * select * from gastos_nacionalizacion where nro_pedido = '000-00' and fecha_fin != null;
     * @param array $nroOrder [
     *                       nro_pedido,
     *                       fecha_ingreso_almacenera
     *                      ] 
     * @return boolean
     */
    private function checkWarenhosePeriodOrder($nroOrder){
        error_log("\n[Debug][" . date("D, d M Y H:i:s") . " Calculando Bodega Para Pedido ", 3 , "/var/www/html/app/src/logs/app.log");
        $oldRecods = $this->modelBase->get_table([
            'table' => 'gastos_nacionalizacion',
            'where' => [
                'nro_pedido' => $nroOrder['nro_pedido'],
            ],
        ]);       
        
        $expensesWarenhouse = $this->modelBase->getWarenhouseExpesnes($nroOrder['nro_pedido']);
        
        print '<pre>';
        print_r($nroOrder);
        print '</pre>';
        
        if($expensesWarenhouse == false){
            error_log("\n[Debug][" . date("D, d M Y H:i:s") . " No se encuentran registros anteriores para bodega del pedido" . $nroOrder['nro_pedido'] , 3 , "/var/www/html/app/src/logs/app.log");
            $newExpenseWarenhouse = [
                'nro_pedido' => $nroOrder['nro_pedido'],
                'id_nacionalizacion_fac_info' => 1,
                'identificacion_proveedor' => '0',
                'concepto' => $this->getConceptExpense($nroOrder['fecha_ingreso_almacenera']),
                'tipo' => 'NACIONALIZACION',
                'valor_provisionado' => $this->calcValueExpense($nroOrder['nro_pedido']),
            ];
            
            if($this->db->insert('gastos_nacionalizacion', $newExpenseWarenhouse)){
                error_log("\n[Error][" . date("D, d M Y H:i:s") . " Se registra un expense warenhouse pedido" . $nroOrder['nro_pedido']);
            }else{
                error_log("\n[Error][" . date("D, d M Y H:i:s") . " Problemas al registrar un expense warenhouse ");
            }
            return true;
        }
        error_log("\n[Debug][" . date("D, d M Y H:i:s") . " Se encuentran " . count($expensesWarenhouse) . " registros anteriores para bodega del pedido" . $nroOrder , 3 , "/var/www/html/app/src/logs/app.log");
        
        return true;
    }
    
    
    /**
     * retorna el concepto del bodegaje para un gasto inicial
     * @param string $dateOrigin
     * @return string
     */
    private function getConceptExpense( string $dateOrigin):string
    {
        return 'Implementar';    
    }
    
    private function calcValueExpense(string $nroOrder): float
    {
        return 'implementar';
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
            return (dateDiffInDays($order['fecha_arribo'], date('Y-m-d')));
        }
        return (dateDiffInDays($order['fecha_arribo'], $order['fecha_salida_bodega_puerto']));
    }
    
    /**
     * Retorna el tiempo de dias por el bodegaje de un pedido.
     *
     * @param array $order
     *            arreglo con los detalles de la orden
     * @return int tiempo en dias de almacenaje
     */
    protected function getWarenHouseDaysPartials($order): int
    {
        return true;
    }
    
    
    
}