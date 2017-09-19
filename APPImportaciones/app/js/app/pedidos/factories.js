/**
 * MODULO ENCARGADO DE MANEJAR LAS PETICIONES GET Y POST EN EL SERVIDOR
 *
 * @package    CordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */

var serviceBase = host + 'index.php/';

/**-----------------------------------------------------------------------------
Factory Incoterms
-----------------------------------------------------------------------------**/
cordovezApp.factory('serviceIncoterms' , ['$http', '$rootScope', '$q' ,
																function($http, $rootScope, $q){
	console.log('[Debug] load Factory serviceIncoterms');

	//funcion estandar para GET
         function httpGet(url){
         var deferred = $q.defer();
         var promise = deferred.promise;
         $http.get(serviceBase + url).then
                 (function(response){
                     return deferred.resolve(response.data);
                 },
                 function(error){
                     return deferred.reject(error);
                 });
             return promise;
         }

         //funcion estandar para POST
         function httpPost(url,data){
         var deferred = $q.defer();
         var promise = deferred.promise;
         $http.post(serviceBase + url,data).then
                 (function(response){
                     return deferred.resolve(response);
                 },(function(response){
                     return deferred.reject(response);
                 }));
             return promise;
         }

	var service = {};

    //#Lista los incoterms por tipo ejemplo FOB EXW etc
	service.getIncotermsTypes = function(incoterms){
   	console.log['[Debug] service.getIncotermsTypes'];
   	return httpGet('incoterm/getType/' + incoterms);
   };

	 return service;

}])
