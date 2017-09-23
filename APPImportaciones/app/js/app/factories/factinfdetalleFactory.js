/**
 * Factoria de factura informativa detalle Corresponde al controller de Gastos
 * iniciales
 * http://base_url/app/index.php/gstinicial70/
 *
 * @package    cordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */

var serviceBase = host + 'index.php/gstinicial70/';

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

   


    return service;
}]);