<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Rest{

    private $CodeHTTP = 200;
    private $ContentType = 'application/json';

    /**
     * Coloca las cabeceras http en las repuestas
     */
     function _setHeaders(){
        header("HTTP/1.1 " . $this->CodeHTTP . " " . $this->_getStatusMessage());
        header("Content-Type: $this->ContentType");
    }   

    /**
     * Verifica el Status Http con el que se reponde las consultas 
     */
     function _getStatusMessage(){
        $status = array(
            200 => 'Ok' , 
            201 => 'Created' , 
            204 => 'No Content' , 
            404 => 'Not Found' , 
            405 => 'Not Allowed' , 
            406 => 'Not Acceptable' , 
            );
        return ($status[$this->CodeHTTP] ? $status[$this->CodeHTTP] : $status[500]);
    }

        /**
     * Verifica el tipo de peticion que hace el nacvegador
     * http://es.wikipedia.org/wiki/Anexo:C%C3%B3digos_de_estado_HTTP
     */
     function _getRequestMethod(){
        return  $_SERVER['REQUEST_METHOD'];
    }


       /**
     * Envia las respuestas http mal navegador
     */
        function _responseHttp($data,$status){
        $this->CodeHTTP = ($status) ? $status : 200;
        $this->_setHeaders();
        echo json_encode($data);
        exit;
    }
}