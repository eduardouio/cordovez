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
class Proveedor extends \MY_Controller
{
    private $listPerPage = 20;
    private $controller = "proveedor";
    private $template = '/pages/pageProveedor.html';
    private $modelUser;
    private $modelSupplier;
    private $modelProduct;

    /**
     * Constructor de la funcion, e inicia los modelos de la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function suma(){
        return 5;
    }
    
    /**
     * Inicia todos los modelos necesarios
     */
    public function init()
    {
        if(! isset($this->session->userdata['id_user'])){
            exit(0);
        }
        
        $this->load->model('Modelsupplier');
        $this->load->model('Modeluser');
        $this->load->model('Modelproduct');
        $this->modelUser = new Modeluser();
        $this->modelSupplier = new Modelsupplier();
        $this->modelProduct = new Modelproduct();
    }

    /**
     * Redirecciona a la lista de proveedores
     */
    public function index()
    {
        $this->redirectPage('suppliersList');
        return true;
    }
    
    
    /**
     * Realiza una busqueda de proveedores busca en  
     * nombre
     * RUC
     * CATEGORIA 
     */
    public function buscar(){
       if(!$_POST){
           $this->index();
           return true;
       }   
       $suppliers = $this->modelSupplier->search(
           $this->input->post('searchCriteria')
           );
       $this->responseHttp([
           'titleContent' => 'Lista de Proveedores Encontrados Para: <strong>' . 
                            $this->input->post('searchCriteria') . '</strong>',
           'list' => true,
           'count' => count($suppliers),
           'suppliers' => $suppliers,
       ]);
    }
    
        
    /**
     * Muestra la ficha de informacion de in proveedor
     * @param string $idSupplier indentificacion proveedor RUC
     */
    public function presentar($idSupplier)
    {
        $supplier = $this->modelSupplier->get($idSupplier);
        
        if ($supplier == false) {
            $this->index();
            return false;
        }
        $this->responseHttp([
            'titleContent' => 'Detalle De Proveedor: ' . $supplier['nombre'],
            'supplier' => $supplier,
            'show' => true,
            'user' => $this->modelUser->get($supplier['id_user']),
            'products' => $this->modelProduct->getBySupplier(
                $supplier['identificacion_proveedor']
                ),
        ]);
    }

    /**
     * Lista todos los proveedores de la base
     */
    public function listar($offset = 0)
    {
        $this->db->order_by('nombre', 'ASC');
        $this->db->limit($this->listPerPage, $offset);
        $resultDb = $this->db->get($this->controller);
        $suppliers = $resultDb->result_array();
        $count = $this->db->count_all_results($this->controller);
        $pages_links = ($count / $this->listPerPage);
        
        if (gettype($pages_links) == 'double') {
            (int) $pages_links = (int) $pages_links + 1;
        }
        $this->responseHttp([
            'count' => $count,
            'titleContent' => 'Lista de Proveedores',
            'list' => true,
            'pagination' => true,
            'suppliers' => $suppliers,
            'perPage' => $this->listPerPage,
            'pagination_pages' => $pages_links,
            'current_page' => (int) (($offset) / $this->listPerPage) + 1,
            'last_page' => (int) (($pages_links - 1) * $this->listPerPage),
            'pagination_url' => base_url() . 'index.php/proveedor/listar/',
        ]);
    }

    /**
     * Muestra el formulario para registrar un proveedor
     */
    public function nuevo()
    {
        $this->responseHttp([
            'titleContent' => 'Registro de Nuevo Proveedor',
            'create' => true
        ]);
    }

    /**
     * Presenta un formulario de edicion con la informacion del proveedor
     * @param int $idSupplier 
     */
    public function editar($idSupplier)
    {
        $supplier = $this->modelSupplier->getById($idSupplier);
        if ($supplier == false){
            $this->index();
            return false;
        }
        $this->responseHttp([
            'edit' => true,
            'supplier' => $supplier,
            'titleContent' => 'Editando Proveedor ' . $supplier['nombre']
        ]);
    }

    /**
     * crea y/o modifica un pedido
     * 
     * @return array (response) en formato JSON
     */
    public function validar()
    {
        if (!$_POST){
            $this->index();
            return false;
        }
        $supplier = $this->input->post();
        $supplier['categoria'] = '';
        
        foreach ($supplier as $key => $value) {
            if (preg_match('/categoria_/', $key)) {
                $supplier['categoria'] .= $value . ';';
                unset($supplier[$key]);
            }
        }
        
        $supplier['id_user'] = $this->session->userdata('id_user');
                    
        $status = $this->_validData($supplier);
        if ($status['status']) {
            if (isset($supplier['id_proveedor'])) {;
                $supplier['last_update'] = date('Y-m-d H:i:s');
                $this->modelSupplier->update(
                    $supplier['id_proveedor'], $supplier
                    );
                $this->redirectPage(
                                    'supplierPresent', 
                                    $supplier['id_proveedor']
                    );
                return true;
            } else {
                $supplierDB = $this->modelSupplier->get(
                    $supplier['identificacion_proveedor']
                    );
                if ($supplierDB){
                    $this->responseHttp([
                        'supplier' => $supplierDB,
                        'viewMessage' => true ,
                        'deleted' => false,
                        'message' => 'El Proveedor Ya Está Registrado!',
                    ]);
                    return false;
                }
                $lastId = $this->modelSupplier->create($supplier);
                if($lastId == false){
                    $this->errorDbNotify();
                    return false;
                }
                $this->redirectPage(
                    'supplierPresent' , 
                    $supplier['identificacion_proveedor']
                    );
                return true;
            }
        } else {
            $this->responseHttp([
                'viewMessage' => true,
                'errorForm' => true,
                'message' => 'La información de uno de los campos es incorrecta!',
                'dataValidate' => $status,
                'supplier' => $supplier,
            ]);
            return true;
        }
    }

    /**
     * Elimina un proveedor sin dependencias de la base
     */
    public function eliminar($idSupplier)
    {
        $supplier = $this->modelSupplier->getById($idSupplier);
        if ($supplier == false){
            return false;
        }
        
        if($this->modelSupplier->delete($idSupplier)){        
            $this->index();
        } else {
            $this->responseHttp([
                'id_supplier' => $idSupplier,
                'viewMessage' => true,
                'message' => 'El Proveedor No Puede Ser Eliminado, 
									                      Tiene Dependencias!',
						          ]);
        }
    }

    /**
     * se validan los datos que deben estar para que la consulta no falle
     * 
     * @return [array] | [bolean]
     */
    private function _validData($data)
    {
        $columnsLen = array(
            'nombre' => 4,
            'tipo_provedor' => 6,
            'categoria' => 2,
            'identificacion_proveedor' => 4,
            'id_user' => 1
        );
        return $this->_checkColumnsData($columnsLen, $data);
    }
    
    /**
     * Muestra en el navegador cuando ha ocurrido un error al acceder a la 
     * informacion de la  base de datos, generalmente errores SQL 
     */
    private function errorDbNotify()
    {
        $this->responseHttp([
            'viewMessage' => true,
            'message' => 'Ocurrio un problema al intentat registrar el proveedor',
            'errordb' => true,
        ]);
    }

    /*
     * Envia la respuestas html al navegador
     * @param array $config arreglo de configuracion
     * @return template 
     */
    private function responseHttp($config)
    {
        $config['title'] = 'Proveedores';
        $config['base_url'] = base_url();
        $config['rute_url'] = base_url() . 'index.php/';
        $config['controller'] = $this->controller;
        $config['iconTitle'] = 'fa-users';
        $config['content'] = 'home';
        $config['enterprise'] = $GLOBALS['selected_enterprise'];
        return $this->twig->display($this->template, $config);
    }
}

