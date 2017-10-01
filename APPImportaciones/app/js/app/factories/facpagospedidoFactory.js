/**
 * Factoria de Pagos pedidos Corresponde al controller de 
 * http://base_url/app/index.php/facpgpedido
 *
 * @package    cordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
cordovezApp.factory('facpagospedidoFactory' , ['$http', '$rootScope', '$q' ,
											 function($http, $rootScope, $q){
    
    console.log('[Debug] facpagospedidoFactory');
    var serviceBase = host + 'index.php/facpgpedido/';
    
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

    //app/index.php/facpgpedido/presentar/:id
    service.getPaidOrder = function(idPaidOrder){
        console.log('[Debug] service.getPaidOrder');
        return httpGet('presentar/' + idPaidOrder);
    };


    //app/index.php/facpgpedido/listar/:idOrder
    service.listPaidsbyOrder = function(idOrder){
        console.log('[Debug] service.listPaidsbyOrder');
        return httpGet('listar/' + idOrder);
    };

    //app/index.php/facpgpedido/listar/0/:idInvoice
    service.listPaidsbyInvoice = function(idInvoice){
        console.log('[Debug] service.listPaidsbyInvoice');
        return httpGet('listar/0/' + idInvoice);
    };

    //app/index.php/facpgpedido/validar => update & create
    service.putPaidOrder = function (paidOrder){
        console.log('[Debug] service.putPaidOrder');
        return httpPost('validar/' , paidOrder);
    };

    //app/index.php/facpgpedido/eliminar/:idPaidOrder
    service.delPaidOrder = function(idPaidOrder){
        console.log('[Debug] service.delPaidOrder');
        return httpGet('eliminar/' + idPaidOrder);
    };

    return service;

}]);