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

  $scope.getIncotermsData = function(){
    var responseHttp = serviceIncoterms.getIncoterms();
  responseHttp.then(
    function(response){
      $scope.incoterms =  response.data;
      console.dir($scope.incoterms);
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
