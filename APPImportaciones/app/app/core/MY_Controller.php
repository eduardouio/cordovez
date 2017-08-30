<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
*	_ __ ___   ___  __| (_)_ __   ___ _ __| |__   __ _ _ __(_) __ _ 
* | '_ ` _ \ / _ \/ _` | | '_ \ / _ \ '__| '_ \ / _` | '__| |/ _` |
* | | | | | |  __/ (_| | | |_) |  __/ |  | |_) | (_| | |  | | (_| |
* |_| |_| |_|\___|\__,_|_| .__/ \___|_|  |_.__/ \__,_|_|  |_|\__,_|
*                        |_|                                       
*/
class MY_Controller extends CI_Controller{
	public $Pagina_;
	public function __construct() {
       parent::__construct();
       #$this->_checkSesion();
    }
	
//Muestra el estado de la sesion en pantalla
	public function _showSession(){
	}
	/**
     * Cheque la sesion cuando se carga un controlador 
     * @param (array) arreglo de session
     * @return (bool) existe la sesion 
     */
	public function _checkSession(){
        if($this->session->userdata('logueado')){
            //si existe retorna 1
            return 1;  
        } else{
            //redirecciona al login
            $this->session->sess_destroy();
            $this->_redirectLoginPage();
        }
	}
    /**
     * Valida los datos de los formularios contra una matriz
     * @param  (array) $params requisitos minimos
     * @param (array) $userData valores ingresados por user
     * @param (int) $items cantidad de items obligatorios
     * @return (int) codigo de estado
     */
    public function _validUserData($params,$userData,$items){
        #status 1 todo esta bien y contador para datos obligatorios
        $i = 0;
        $status = 1;
        //contamos el minimo de parametros
        foreach ($params as $key => $value) {
            if(($value != 0) && (array_key_exists($key, $userData))){
                        $i++;
            }
        }
        /**
        * sirve para depurar buscas un patron e imprimes,
        * si no filtras se detiene el script en la primera conincdencia
        *if(array_key_exists('antecedente', $userData)){
         *   print($i);
          *  print(var_dump($params));
           * print(var_dump($userData));
        *}
        */
        //verificamos la logitud de cada parametro
        if($i == $items){
            foreach ($params as $key => $limit) {
                if(array_key_exists($key, $userData)){
                    if($limit > strlen($userData[$key])){
                        $status = '2005';
                        break;
                    }                
                }                
            }                
        }else{
            $status = '2000';
        }
        
        return $status;
    }
    /**
     * Redirecciona Login
     */
    protected function _redirectLoginPage(){
        header('Status: 301 Moved Permanently', false, 301);
        header('Location: ' . base_url());
    }
    public function _notAuthorized(){
        $this->rest->_responseHttp('Entrada No autorizada favor vuelva a ' .
                    base_url(),405);
    }
	  /*************************************************************************
    * Carga los datos en las plantillas HTML y las Imprime  
    * @method _mostrarHTML()
    * @param (array) arreglo con el listado de vistas y datos
    * @param (str) nombre del modulo angular
    * @return (void)
    *************************************************************************/
     function _mostrarHTML($catalogo){
        $vistas;
        $this->Pagina_;
        foreach ($catalogo as $arreglos => $nombres) {
            $vistas[] = $arreglos;
            }
        foreach ($vistas as $nombre) {
            $this->Pagina_ = $this->Pagina_ . $this->load->view($nombre,
                                                    $catalogo[$nombre],true);
            }
        $this->Pagina_ = $this->Pagina_ . $this->load->view('pie');
        print $this->Pagina_;
        }
}
