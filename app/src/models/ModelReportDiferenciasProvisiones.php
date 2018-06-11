<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Genera un reporte de las justificaciones de valores no provisionados
 * y de valores provisionados en menos
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */

class ModelReportDiferenciasProvisiones extends CI_Model
{
    private $modelBase;
    
    /**
     * constructor de clase
     */
    function __construct(){
        parent::__construct();
        $this->init();
    }
    
    /**
     * Carga los modelos base para trabajar en la clase
     */
    private function init(){
        $this->load->model('ModelBase');
        $this->modelBase = new ModelBase();
    }
    
    
}

