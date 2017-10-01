cordovezApp.controller('presentarPedidoController', [ 
                                              '$scope', 
                                              '$location',
                                              '$routeParams',
                                              '$timeout',
                                              'factoryLogin',
                                              'pedidoFactory',
                                              'gastosinicialesFactory',
                                              'incotermsFactory',
                                      function(
                                              $scope, 
                                              $location,
                                              $routeParams,
                                              $timeout,
                                              factoryLogin,
                                              pedidoFactory,
                                              detallePedidoFactory, 
                                              gastosinicialesFactory,
                                              incotermsFactory,
                                        ) {

  console.log('[Debug] presentarPedidoController Loaded');

  //contenedor de datos
  $scope.viewData = {
                'pedido' : [],
                'helper' : [{
                            'userInfo' : {},
                              'helper' : {}
                            }
                            ],
                'show' : {}
                  };

  $scope.loadOrderData = function(){
    console.log('[Debug] $scope.loadOrderData');
    var httpResponse = pedidoFactory.getOrder($routeParams['idOrder']);
    httpResponse.then(function(response){
        $scope.viewData.pedido = response.data
        $scope.validError(response.appst , response.message);
        console.dir($scope.viewData);
    },function(error){
       var message = error.message.slice(1,40);
      $scope.validError(0, message);
    });
  };

  // Valida La session
  $scope.validSession = function(){
    var httpResponse = factoryLogin.checkSession();
    httpResponse.then(function(response){
      $scope.viewData.helper.userInfo = response.session;
      if(!response.appst === 1000){
        $setTimeout(function() {
          window.location = url
        }, 10);
      }
    }, function(error){
      var message = error.message.slice(1,40);
      $scope.validError(0, message);
    });
  };

 //Valida los errores y muestra los mensajes  
  $scope.validError = function(appst, message){
    console.log('[Debug] $scope.validError');
    $.toast({
      text: message,
      heading: 'Pedido', // Optional heading to be shown on the toast
      icon: 'info', // Type of toast icon
      showHideTransition: 'fade', // fade, slide or plain
      allowToastClose: true, // Boolean value true or false
      hideAfter: 10000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
      stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
      position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
      textAlign: 'left',  // Text alignment i.e. left, right or center
      loader: true,  // Whether to show loader or not. True by default
      loaderBg: '#018aa3',  //#9EC600 Background color of the toast loader
  });
  };

//carga informacion del pedido
$scope.init = function(){
  $scope.validSession();
  $scope.loadOrderData();
};

  $scope.init();

}]);