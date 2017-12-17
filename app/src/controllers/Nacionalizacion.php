<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
class Nacionalizacion extends MY_Controller
{

    private $controller = "nacionalizacion";

    private $listPerPage = 12;

    private $template = '/pages/pageNacionalizacion.html.twig';

    /**
     * Constructor de la funcion
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Presenta una lista con las nacionalizaciones realizadas
     * 
     * @return array
     */
    public function listar()
    {
        $config = [
            'titleContent' => 'Lista De Nacionalizaciones',
            'list' => true
        ];
    }
    
    
    /**
     * Comprueba si una nacionalizacion puede efecturase
     * Caso contrario se muestra los problemas que tiene
     * @param string $nroOrder
     * @return string template | redirect
     */
    public function validar($nroOrder)
    {
        return true;
    }

    /*
     * Envia la respuestas html al navegador
     */
    private function responseHttp(array $config)
    {
        $params = [
            'title' => 'Pedidos',
            'base_url' => base_url(),
            'rute_url' => base_url() . 'index.php/',
            'controller' => $this->controller,
            'iconTitle' => 'fa-cubes',
            'content' => 'home'
        ];
        return $this->twig->display($this->template, array_merge($config, $params));
    }

    /**
     * Se validan las columnas que debe tener la consulta para que no falle
     * 
     * @return [array] | [bolean]
     */
    private function _validData($data)
    {
        $columnsLen = array(
            'nro_pedido' => 1,
            'nro_factura_informativa' => 1,
            'moneda' => 1,
            'tipo_cambio' => 1,
            'id_user' => 1
        );
        return $this->_checkColumnsData($columnsLen, $data);
    }
}
