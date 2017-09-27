/**
 * Aplicacion clase encargada de listar los paises y ciudades
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

cordovezApp.factory('countriesFactory' , ['$http', '$rootScope', '$q' ,
                       function($http, $rootScope, $q){

    console.log('[Debug] countriesFactory');
    var serviceBase = host + 'js/app/resources/';
    
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

	var service = {};

  //app/index.php/detallepedido/listar
  service.listCountries = function( ){
    console.log('[Debug] service.listCountries');
    return httpGet('countries.json');
  };

  //app/index.php/detallepedido/validar => update y create
  service.listCities = function(countrie){
    console.log('[Debug] service.putItemOrder');
    return httpGet('cities.json');
  };

  return service;

}])