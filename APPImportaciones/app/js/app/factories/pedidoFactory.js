/**
 * Factoria de pedidos Corresponde al controller de 
 * http://base_url/app/index.php/pedido/
 *
 * @package    cordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
cordovezApp.factory('pedidoFactory' , ['$http', '$rootScope', '$q' ,
											 function($http, $rootScope, $q){

    console.log('[Debug] pedidoFactory');
    var serviceBase = host + 'index.php/pedido/';

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

    //app/index.php/pedido/listar/:idOrder
    service.getOrder = function(idOrder){
        console.log('[Debug] service.getOrder');
        return httpGet('listar/' + idOrder);
    };

    //app/index.php/pedido/listar/
    service.listOrders = function(){
        console.log('[Debug] service.listOrders');
        return httpGet('listar/');
    };

    //app/index.php/pedido/validar/ => update and create
    service.putOrder = function(order){
        console.log('Debug service.putOrder');
        return httpPost('validar/', order);
    };

    //app/index.php/pedido/eliminar
    service.delOrder = function(idOrder){
        console.log('[Debug] service.delOrder');
        return httpGet('eliminar/' + idOrder);
    };

    return service;

}]);