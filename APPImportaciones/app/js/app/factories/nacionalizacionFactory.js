/**
 * Factoria de nacionalizacion Corresponde al controller de 
 * http://base_url/app/index.php/nacionalizacion/
 *
 * @package    cordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
cordovezApp.factory('nacionalizacionFactory' , ['$http', '$rootScope', '$q' ,
											 function($http, $rootScope, $q){

    console.log('[Debug] gastosinicialesFactory');
    var serviceBase = host + 'index.php/nacionalizacion/';

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

    //app/index.php/nacionalizacion/presentar/:idNationalization
    service.getNationalization = function(idNationalization){
        console.log('[Debug] service.getNationalization');
        return httpGet('presentar/' + idNationalization);
    };

    //app/index.php/nacionalizacion/listar/
    service.listNationalization = function (){
      console.log('[Debug] service.listNationalization');
      return httpGet('listar');
    };

    //app/index.php/nacionalizacion/listar/:idOrser
    service.getNationalizationByOrder = function(idOrder){
        console.log('[Debug] service.getNationalizationByOrder');
        return httpGet('listar/' + idOrder);
    };

    //app/index.php/nacionalizacion/listar/0/:idInfoInvoice
    service.getNationalizationByInvoice = function(idInfoInvoice){
        console.log('[Debug] service.getNationalizationByInvoice');
        return httpGet('listar/0/' + idInfoInvoice);
    };

    //app/index.php/nacionalizacion/validar => create & update
    service.putNationalization = function (nationalization){
      console.log('[Debug] service.putNationalization');
      return httpPost('validar', nationalization);
    };

    //app/index.php/nacionalizacion/eliminar
    service.delNationalization = function(idNationalization){
      console.log('[Debug] service.delNationalization');
      return httpGet('eliminar' + idNationalization);
    };

  return service;

}]);