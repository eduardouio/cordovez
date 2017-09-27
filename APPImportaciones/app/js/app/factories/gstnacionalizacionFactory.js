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
cordovezApp.factory('gastonacionalizacionFactory' , ['$http', '$rootScope', '$q' ,
											 function($http, $rootScope, $q){
    
    console.log('[Debug] gastonacionalizacionFactory');
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

    //app/index.php/gstnacionalizacion/listar
    service.listExpensesNationalization = function(){
        console.log('[Debug] service.listExpensesNationalization');
        return httpGet('listar');
    };

    //app/index.php/gstnacionalizacion/listar/:idNationalization/
    service.getExpenseNationalization = function(idNationalization){
        console.log('[Debug] service.getExpenseNationalization');
        return httpGet('listar/' + idNationalization);
    };

    //app/index.php/gstnacionalizacion/listar/0/:idExpensesNationalization/
    service.getExpenseNationalizationByExpenses = function
                                                    (idExpensesNationalization){
      console.log('[Debug] service.getExpenseNationalizationByExpenses');
      return httpGet('listar/0/' + idExpensesNationalization);
    };

    //app/index.php/gstnacionalizacion/validar
    service.putExpenseNationalization = function(expenseNationalitation){
        console.log('[Debug] service.putExpenseNationalization');
        return httpPost('validar' , expenseNationalitation);
    };

    //app/index.php/gstnacionalizacion/eliminar
    service.delExpenseNationalization = function(idExpensesNationalization){
        console.log('[Debug] service.delExpenseNationalization');
        return httpGet('eliminar/' + idExpensesNationalization);
    };

    return service;

}]);