/**
 * Factoria de factura informativa detalle Corresponde al controller de Gastos
 * iniciales
 * http://base_url/app/index.php/facinfdetalle/
 *
 * @package    cordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */

var serviceBase = host + 'index.php/facinfdetalle/';

cordovezApp.factory('fcatinfoDetalleFactory' , ['$http', '$rootScope', '$q' ,
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

    //app/index.php/facinfdetalle/listar/:idInfoInvoice
    service.listInvoiceInfoDetail = function(){
        console.log('[Debug] service.listInvoiceInfoDetail');
        return httpGet('listar/' + idInfoInvoice);
    };

    //app/index.php/facinfdetalle/validar/ => update & create
    service.putInvoiceInfoDetail = function(){
        console.log('[Debug] service.putInvoiceInfoDetail');
        return httpGet('validar/' + idInfoInvoice);
    };

    //app/index.php/facinfdetalle/eliminar/:idInfoInvoice
    service.delInvoiceInfoDetail = function(){
        console.log('[Debug] service.delInvoiceInfoDetail');
        return httpGet('eliminar/' + idInfoInvoice);
    };

    return service;
}]);