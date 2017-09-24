/**
 * Factoria de pedido Factura Corresponde al controller de 
 * http://base_url/app/index.php/pedidofactura
 *
 * @package    cordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */


var serviceBase = host + 'index.php/pedidofactura/';

/**-----------------------------------------------------------------------------
Factory Incoterms
-----------------------------------------------------------------------------**/
cordovezApp.factory('pedidofacturaFactory' , ['$http', '$rootScope', '$q' ,
											 function($http, $rootScope, $q){

    //funciones comunes de login 
    function httpGet(url){
    	var deferred = $q.defer();
    	var promise = deferred.promise;

    	$http.get(serviceBase + url ).then(
    		function(response){
    			return deferred.resolve(response.data);
    		}, function(error){
    			return deferred.reject(error);
    		});
    	return promise;
    }

    //funcion estandar para Post
    function httpPost(url, data){
    	var deferred = $q.defer();
    	var promise = deferred.promise;

    	$http.post(serviceBase + url , data).then(
    		function (response){
    			return deferred.resolve(response.data);
    		}, function(error){
    			return deferred.reject(error);
    		});
    	return promise;
    }

	var service = {};

    //pedidofactura/listar/:year/:id/
    //obtiene las facturas de un pedido
    service.getOrderInvoices = function(year , idOrder){
        console.log('[Debug] service.getOrderInvoices');
        return httpGet('listar/ + year  + '-' + idOrder);
    }

    //pedidofactura/listar/
    service.getAllOrderInvoices = function(){
        console.log('[Debug] service.getAllOrderInvoices');
        return httpGet('listar/');
    }

    //pedidofactura/presentar/:id
    service.getOrderInvoice = function(idOrderInvoice){
        console.log('[Debug] service.getOrderInvoice');
        return httpGet('presentar/' + idOrderInvoice);
    }

    //app/index.php/pedidofactura/validar/ => update and create
    service.putOrderInvoice = function(ordeInvoice){
        console.log('[Debug] service.putOrderInvoice');
        return httpPost('validar/' , ordeInvoice);
    };

    //app/index.php/pedidofactura/eliminar/:id
    service.delOrderInvoice = function(idOrderInvoice){
        console.log('[Debug] service.delOrderInvoice');
        return httpGet('eliminar/' + idOrderInvoice);
    }

    return service;

}]);