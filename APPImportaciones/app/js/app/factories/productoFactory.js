/**
 * Factoria de gastos iniciales Corresponde al controller de 
 * http://base_url/app/index.php/producto/
 *
 * @package    cordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
cordovezApp.factory('productoFactory' , ['$http', '$rootScope', '$q' ,
                                             function($http, $rootScope, $q){

    console.log('[Debug] productoFactory');
    var serviceBase = host + 'index.php/producto/';


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

    //app/index.php/producto/listar/:idProduct/:idSupplier/
    service.listProducts = function(){
        console.log('[Debug] service.listProducts');
        return httpGet('listar/');
    };

    //app/index.php/producto/listar/:idProduct/
    service.getProduct = function(idProduct){
        console.log('[Debug] service.getProduct');
        return httpGet('listar/' + idProduct);
    };

    //app/index.php/producto/listar/0/:idSupplier/
    service.listProductBySupplier = function(idSupplier){
        console.log('[Debug] service.listProductBySupplier');
        return httpGet('listar/0/' + idSupplier);
    };

    //app/index.php/producto/listar/validar
    service.putProduct = function(product){
      console.log('[Debug] service.putProduct');
      return httpPost('validar/', product);
    };

    //app/index.php/producto/eliminar
    service.delProduct = function(idProduct){
      console.log('[Debug] service.delProduct');
      return httpGet('eliminar/' + idProduct);
    };

    return  service;

}]);