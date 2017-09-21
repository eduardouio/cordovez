/**
 * CONTROLLER DE PEDIDOS
 *
 * @package    CordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
cordovezApp.controller('pedidosController',
 										function($scope , $location , $timeout, serviceIncoterms) {



  //Alamcena todos los datos de los incoterms
  $scope.incoterms = {};
  $scope.viewIncoterms = {
    'countries' : false,
    'cities' : false,
    'params' : false
  }

  //Listado de incoterms para obtener la lista de incoterms
  $scope.getIncoterms = function(){
     
    var responseHttp = serviceIncoterms.getIncoterms();

      responseHttp.then(
        function(response){
          $scope.incoterms['incoterm'] = response.data;
          $scope.viewIncoterms['countries'] = true;
          console.dir($scope.incoterms['incoterm']);
        }, function(error){
        return error
        });  
  return responseHttp;
  
  };

  //Obtiene la lista de paises por incoterm
  $scope.getIncotermsCountries = function(incoterm){
     var responseHttp = serviceIncoterms.getincotermsCountries(incoterm);

      responseHttp.then(
        function(response){
          $scope.incoterms['countries'] = response.data;
          $scope.viewIncoterms['cities'] = true;
          console.dir($scope.incoterms['countries']);
        }, function(error){
        return error
        });  
  return responseHttp;
  };

  //Lista las ciudades del incoterm
  $scope.getIncotermsCities = function(incoterm, country){
    if(typeof country !== 'undefined'){
      country = country.replace('Ñ' , 'N');      
    }

     var responseHttp = serviceIncoterms.getIincotermsCities(incoterm, 
                                                                      country);

      responseHttp.then(
        function(response){
          $scope.incoterms['cities'] = response.data;
          $scope.viewIncoterms['params'] = true;
          console.dir($scope.incoterms['cities']);
        }, function(error){
        return error
        });  
  return responseHttp;
  };

  $scope.getIncotermParam = function (incoterm, country, city){
    
     if(typeof country !== 'undefined'){
      country = country.replace('Ñ' , 'N');      
    }

    var responseHttp = serviceIncoterms.getIncotermsParam(incoterm,  country , city);
      responseHttp.then(
        function(response){
          $scope.incoterms['param'] = response.data;
          console.dir($scope.incoterms['param']);
        }, function(error){
        return error
        });  
  return responseHttp;
  };

   
   $scope.init = function(){
    //identificamos de donde viene la llamada a la funcion
    var mypath = location.path();
    var callNuevoPedido = /\/nuevo-pedido/;


   };
	

/**
* Funcion encargada de manejar los errores de la aplicacion
*/
$scope.errorMsg = function(error){
  console.log('[ErrorHttp]' + error);
  alert('ErrorHttp');
};



});
