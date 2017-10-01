/**
 * Factoria de factura informativa Corresponde al controller de 
 * http://base_url/app/index.php/factinformativa/
 *
 * @package    cordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
cordovezApp.factory('facInformativaFactory' , ['$http', '$rootScope', '$q' ,
											 function($http, $rootScope, $q){

    console.log('[Debug] facInformativaFactory');
    var serviceBase = host + 'index.php/factinformativa/';
    
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
    };

	var service = {};

    //app/index.php/factinformativa/presentar/:idInvoice
    service.getInvoice = function (idInvoice){
        console.log('[Debug] service.getInvoice');
        return httpGet('presentar/' + idInvoice);
    };

    //app/index.php/factinformativa/presentar/:idOrder
    service.getInvoicebyOrder = function(idOrder){
        console.log('[Debug] service.getInvoicebyOrder');
        httpGet('presentar/' + idOrder )
    };

    //app/index.php/factinformativa/presentar/0/:idSupplier
    service.getInvoicebySupplier = function(idSupplier){
        console.log('[Debug] service.getInvoicebySupplier');
        httpGet('presentar/' + '/0/' + idSupplier );
    };

    //app/index.php/factinformativa/validar -> crteate & update
    service.putInvoice = function(invoice){
        console.log('[Debug] service.putInvoice');
        return httpPost('validar/' , invoice);
    };

    //app/index.php/factinformativa/eliminar/:idInvoice
    service.delInvoice = function(idInvoice){
        console.log('[Debug] service.delInvoice');
        return httpGet('eliminar/' + idInvoice);
    };

    return service;

}]);