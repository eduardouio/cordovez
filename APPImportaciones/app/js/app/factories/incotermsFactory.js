/**
 * Modulo encargado demanejar el controller
 * http://base_url/app/index.php/incoterm
 *
 * @package    CordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */

var serviceBase = host + 'index.php/incoterm';


cordovezApp.factory('incotermsFactory' , ['$http', '$rootScope', '$q' ,
											 function($http, $rootScope, $q){
	console.log('[Debug] load Factory incotermsFactory');

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

    //#Lista los incoterms por tipo
	service.getIncoterms = function(){
        console.log('[Debug] service.getIncoterms');
        return httpGet('incoterm/getIncoterms/');
    };

    //#Lista los incoterms por tipo
    service.getincotermsCountries = function(incoterm){
        console.log('[Debug] service.getincotermsCountries');
        return httpGet('incoterm/getIncoterms/' + incoterm); 
    };

    //#Lista los incoterms por tipo
    service.getIincotermsCities = function(incoterm , country){
        console.log('[Debug] service.getIincotermsCities');
        return httpGet('incoterm/getIncoterms/' + incoterm + '/' + country); 
    };

    //#Lista los incoterms por tipo
    service.getIncotermsParam = function(incoterm , country, city){
        console.log('[Debug] service.getIncotermsParam');
        return httpGet('incoterm/getIncoterms/' + incoterm + '/' + 
                                                        country + '/' + city);           
    };

    //#lista los proveedores
    service.getSuppliers = function(idSupplier){
        console.log('[Debug] service.getSuppliers');
        if(idSupplier === 0 ){
          return httpGet('listar');    
        }else{
          return httpGet('listar/' + idSupplier);
        }
    };

     return service;


}])
