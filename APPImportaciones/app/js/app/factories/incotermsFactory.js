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
cordovezApp.factory('incotermsFactory' , ['$http', '$rootScope', '$q' ,
											 function($http, $rootScope, $q){
	
    console.log('[Debug] load Factory incotermsFactory');
    
    var serviceBase = host + 'index.php/incoterm/';

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

    var query = {
        'incoterm' : '',
        'country':'',
        'city':''
    };

    //#Lista los incoterms por tipo
	service.getIncoterms = function(){
        console.log('[Debug] service.getIncoterms');
             
        return httpPost('getIncoterms/',   {
                                        'incoterm' : '',
                                        'country':'',
                                        'city':''   
                                            });
    };

    //#Lista los incoterms por tipo
    service.getincotermsCountries = function(incoterm){
        console.log('[Debug] service.getincotermsCountries');
        query['incoterm'] = incoterm;
        return httpPost('getIncoterms/',   {
                                        'incoterm' : incoterm,
                                        'country':'',
                                        'city':''   
                                            });
    };

    //#Lista los incoterms por tipo
    service.getIincotermsCities = function(incoterm , country){
        console.log('[Debug] service.getIincotermsCities');
        query['incoterm'] = incoterm;
        query['country'] = country;
        return httpPost('getIncoterms/',   {
                                        'incoterm' : incoterm,
                                        'country':country,
                                        'city':''   
                                            });
    };

    //#Lista los incoterms por tipo
    service.getIncotermsParam = function(incoterm , country, city){
        console.log('[Debug] service.getIncotermsParam');
        //solucionar problema con la ñ
        return httpPost('getIncoterms/',   {
                                        'incoterm' : incoterm,
                                        'country': country,
                                        'city': city   
                                            });
    };

     return service;


}]);