/**
 * Factoria de proveedores Corresponde al controller de 
 * http://base_url/app/index.php/proveedor/
 *
 * @package    cordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */


var serviceBase = host + 'index.php/proveedor/';

/**-----------------------------------------------------------------------------
Factory Incoterms
-----------------------------------------------------------------------------**/
cordovezApp.factory('proveedoresFactory' , ['$http', '$rootScope', '$q' ,
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

    //#lista los productos de un prpoveedor
    service.getProductsSupplier = function(idSupplier){
      console.log('[Debug] service.getProductsSupplier');
      if(idSupplier === 0 ){
          return httpGet('listar');    
        }else{
          return httpGet('listar/0/' + idSupplier);
        }
    };  

	var service = {};

}]);