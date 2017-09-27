/**
 * Factoria de gastos nacionalizacion Corresponde al controller de 
 * http://base_url/app/index.php/gstnacionalizacion/
 *
 * @package    cordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
cordovezApp.factory('facgstnaciohnalizacionFactory' , ['$http', '$rootScope', '$q' ,
											 function($http, $rootScope, $q){

    console.log('[Debug] facgstnaciohnalizacionFactory');
    var serviceBase = host + 'index.php/gstnacionalizacion/';
    
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

    //app/index.php/gstnacionalizacion/listar/:idExpenseNationalization
    service.getExpenseNationalitation = function(idExpenseNationalitation){
        console.log('[Debug] service.getExpenseNationalitation');
        return httpGet('listar/' + idExpenseNationalitation)
    };

    //app/index.php/gstnacionalizacion/listar
    service.listExpenseNationalitation = function(){
        console.log('[Debug] service.listExpenseNationalitation');
        return httpGet('listar');
    };

    //app/index.php/gstnacionalizacion/validar
    service.putExpenseNationalization = function(expenseNationalitation){
        console.log('[Debug} service.putExpenseNationalization ');
        return httpPost('validar' , expenseNationalitation )
    };

    //app/index.php/gstnacionalizacion/eliminar/idExpenseNationalization
    service.delExpenseNationalization = function(idExpenseNationalization){
        console.log('[Debug] service.delExpenseNationalization');
        return httpGet('eliminar/' + idExpenseNationalization);
    };


    return service;

}]);