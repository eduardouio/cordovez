/**
 * Aplicacion clase encargada de administrar los items de una factura de un pedido
 *
 * http://base_url/app/index.php/detallepedido/
 * @package    cordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
cordovezApp.factory('detallePedidoFactory' , ['$http', '$rootScope', '$q' ,
											 function($http, $rootScope, $q){

    console.log('[Debug] detallePedidoFactory');
    var serviceBase = host + 'index.php/detallepedido/';
    
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

  //app/index.php/detallepedido/listar
  service.getDetallePedidoFac = function( idOrderInvoice ){
    console.log('[Debug] service.getDetallePedidoFac');
    return httpGet('listar/' + idOrderInvoice);
  };

  //app/index.php/detallepedido/validar => update y create
  service.putItemOrder = function(item){
    console.log('[Debug] service.putItemOrder');
    return httpPost('validar/' , item);
  };

  service.delItemOrder = function(idItemOrder){
    console.log('[Debug] service.delItemOrder');
    return httpPost('eliminar/' + idItemOrder);
  };

  return service;

}])