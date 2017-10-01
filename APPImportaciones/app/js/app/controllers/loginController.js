/**
 * App de inicio de sesion
 *
 * @package    cordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */

cordovezApp.controller('loginController',
 										function($scope , $location , $timeout, factoryLogin, $q) {

  var url = host + 'index.php/pedido';
  //muestra y oculta los mensajes en la pantalla
	$scope.showError = false;
	$scope.showSuccess = false;


  $scope.checkSession = function(){
  	var responseHttp = factoryLogin.checkSession();

  	responseHttp.then(function(response){
  		if(response.appst === 1000 ){
  			$scope.showSuccess = true;
  			$scope.redirectHome();
  		}
  	},function(error){
  		console.log(error);
  	});		
  }

  //Envia la informacion del formulario
  $scope.sendData = function (userData){
		console.log('[Debug] Inicio de Sesión');
		var responseHttp = factoryLogin.postFormData(userData);

		responseHttp.then(function(response){
			$scope.logged = true;
			$scope.userData = response;
			if(response.appst === 1000){
				$scope.showSuccess = true;
				$scope.showError = false;
				$scope.redirectHome(response);
			}else{	
				$scope.showError = true;
				$scope.showSuccess = false;
				$scope.userData = {};
			}
			$scope.message = response.message;
		},function(error){
			console.log(error);
		});
  };

  
  //redirecciona al home si la sesion esta iniciada
  $scope.redirectHome = function(response){		
		$timeout(function() {
			window.location = url;
		}, 1500);
  }	

  $scope.checkSession();


});