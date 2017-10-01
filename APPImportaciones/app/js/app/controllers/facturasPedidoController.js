cordovezApp.controller('facturasPedidoController', [ 
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

  console.log('[Debug] facturasPedidoController Loaded');

  //contenedor de datos
  $scope.viewData = {
                'pedido_factura' : {},
                'pedidos_factura' : [],
                'pedido' : {},
                'proveedores' : [],
                'helper' : {},
                'userInfo' : {},
                'show' : {}
                  };
  
    $scope.validateOrderInvoice = function(orderInvoice){
      var fecha_emision = document.getElementById('fecha_emision').value;
      var fecha_vencimiento = document.getElementById('vencimiento_pago').value;
      orderInvoice['id_user'] = $scope.viewData.userInfo['id_user'];
      orderInvoice['fecha_emision'] = fecha_emision.replace(/\//g,'-');
      orderInvoice['vencimiento_pago'] = fecha_vencimiento.replace(/\//g,'-');
      orderInvoice['valor'] = 0;
      //preparamos objeto de la base

      myOrderInvoice = {
        'accion' : 'create',
        'pedidoFactura' : orderInvoice
      }

      var httpResponse = pedidofacturaFactory.putOrderInvoice(myOrderInvoice);

      httpResponse.then(function(response){
        $scope.validError(response.appst, response.message);
        $('#myModal').close();
      },function(error){
        $scope.validError(0, error); 
      });
      
    };

    //carga la informacion inicial de los proveedores
    $scope.loadSuppliers = function(){
      var httpResponse = proveedoresFactory.listSupplier();

      httpResponse.then(function(response){
        $scope.viewData.proveedores = response.data
      },function(error){
        var message = error.message.slice(1,40);
        $scope.validError(0, message); 
      });
    };    

    
    //#/agregarProducto/:idOrderInvoice
    //#/verProductos/:idOrderInvoice
    //#/editarFacturaPedido/:idOrderInvoice
    //#/eliminarFacturaPedido/:idOrderInvoice
    $scope.invoiceFunctions = function(){


      function addProduct(idOrderInvoice){

      }


      function viewProducts(idOrderInvoice){

      }


      function editidOrderInvoice(idOrderInvoice){

      }

      function delidOrderInvoice(idOrderInvoice){

      }

    };


    $scope.loadOrderInvoice = function(){
      var httpResponse = pedidofacturaFactory.getOrderInvoices(
                                  $routeParams.idOrder);
      httpResponse.then(function(response){
        $scope.viewData.pedidos_factura = response.data;
      },function(error){
        $scope.validError(0, message);  
      });
      
    }

    //carga la informacion inicial del pedido
    $scope.loadOrderData = function(){
    console.log('[Debug] $scope.loadOrderData');
    var httpResponse = pedidoFactory.getOrder($routeParams.idOrder);
    httpResponse.then(function(response){
        $scope.viewData.pedido = response.data
        $scope.viewData.pedido_factura['nro_pedido'] = 
                                                response.data[0]['nro_pedido'];
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
  $scope.loadOrderData();
  $scope.loadSuppliers();
  $scope.loadOrderInvoice();
};

  $scope.init();
  
}]);