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
cordovezApp.factory('proveedoresFactory' , ['$http', '$rootScope', '$q' ,
											 function($http, $rootScope, $q){

    console.log('[Debug] proveedoresFactory');
    var serviceBase = host + 'index.php/proveedor/';

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

    //app/index.php/proveedor/listar
    service.listSupplier = function(){
        console.log('[Debug] service.listSupplier');
        return httpGet('listar');
    };//app/index.php/proveedor/listar

    //app/index.php/proveedor/listarProveedorTipo/:internacional
    service.listSupplierByType = function(type){
        console.log('[Debug] listSupplierByType');
        return httpGet('listarproveedortipo/' + type);
    };

    //app/index.php/proveedor/listar/:idSupplier
    service.getSupplier = function(idSupplier){
        console.log('[Debug] service.getSupplier');
        return httpGet('listar/' + idSupplier);
    };

    //app/index.php/proveedor/validar => create & update
    service.putSupplier = function(supplier){
        console.log('[Debug] service.putSupplier');
        return httpPost('validar' , supplier);
    };

    //app/index.php/proveedor/eliminar:idSupplier
    service.delSupplier = function(idSupplier){
        console.log('[Debug] service.delSupplier');
        return httpGet('eliminar/' + idSupplier);
    };

    return service;

}]);