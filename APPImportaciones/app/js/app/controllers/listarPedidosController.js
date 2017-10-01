cordovezApp.controller('listarPedidosController', [ 
                                              '$scope', 
                                              '$location',
                                              '$routeParams',
                                              '$timeout',
                                              'factoryLogin',
                                              'pedidoFactory',
                                              'gastosinicialesFactory',
                                              'pedidofacturaFactory',
                                              'incotermsFactory',
                                              'proveedoresFactory',
                                              'detallePedidoFactory',
                                      function(
                                              $scope, 
                                              $location,
                                              $routeParams,
                                              $timeout,
                                              factoryLogin,
                                              pedidoFactory,
                                              gastosinicialesFactory,
                                              pedidofacturaFactory,
                                              incotermsFactory,
                                              proveedoresFactory,
                                              detallePedidoFactory,
                                        ) {

  console.log('[Debug] listarPedidosController');

  //contenedor de datos
  $scope.viewData = {
                'pedidos' : [],
                'proveedores' : [],
                'helper' : {},
                'userInfo' : {},
                'show' : {}
                  };



  //redirecciona al fomurlario de nueva orden
  $scope.newOrder = function(){
    $location.path('/nuevo-pedido');
   };

  
    //carga la informacion inicial del pedido
    $scope.loadOrdersData = function(){
    console.log('[Debug] $scope.loadOrdersData');
    var httpResponse = pedidoFactory.listOrders();
    httpResponse.then(function(response){
      $scope.viewData.pedidos = response.data
      $scope.validError(response.appst, response.message);
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
      $scope.viewData.userInfo = response.session;
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
      heading: 'Pedido', 
      icon: 'info', 
      showHideTransition: 'fade', 
      allowToastClose: true, 
      hideAfter: 10000, 
      stack: 5, 
      position: 'top-right', 
      textAlign: 'left',  
      loader: true,  
      loaderBg: '#018aa3',  
  });
  };

  //carga informacion del pedido
$scope.init = function(){
  $scope.validSession();
  $scope.loadOrdersData();
};

  $scope.init();
  
}]);