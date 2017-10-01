/**
 * controlador para creacion de pedidos
 *
 * @package    CordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
cordovezApp.controller('nuevoPedidoController', [ 
                                              '$scope', 
                                              '$location',
                                              '$timeout',
                                              '$routeParams',
                                              'factoryLogin',
                                              'pedidoFactory',
                                              'detallePedidoFactory', 
                                              'gastosinicialesFactory',
                                              'incotermsFactory',
                                              'proveedoresFactory',
                                      function(
                                              $scope, 
                                              $location,
                                              $timeout,
                                              $routeParams,
                                              factoryLogin,
                                              pedidoFactory,
                                              detallePedidoFactory, 
                                              gastosinicialesFactory,
                                              incotermsFactory,
                                              proveedoresFactory,
                                        ) {

  console.log('[Debug] nuevoPedidoController');

  
  //Funcion para validar un pedido y guardalo
  $scope.validateOrder = function(order){
    console.log('$scope.validateOrder');
    //primero se registra el pedido
    var pedido = order.pedido;
    var helper = order.helper;
    var gastos_iniciales_r70 = order.gastos_iniciales_r70;
    //meotodo guarda gastos iniciales
    function saveExpenses(gastos_inicial){
      var myGasto = {
                    'accion' : 'create',
                    'gastos_iniciales_r70' : gastos_inicial
                    };
      var initExpensesPromise = gastosinicialesFactory.putInitExpenses(myGasto); 
      initExpensesPromise.then(function(response){
      $scope.responseInitExpenses = response;
      $scope.validError(0, response.message);
      },function(error){
         $scope.validError(0, message);
      });
    }

    //completamos y guardamos el pedido
    var fecha = document.getElementById('fecha_arribo').value;
    pedido['id_user'] = $scope.idUser;
    pedido['antes_fob'] = 0;
    pedido['estado_pedido'] = "ABIERTO";
    pedido['fecha_arribo'] = fecha.replace(/\//g,'-');
    var myPedido = {
                  'accion' : 'create',
                  'pedido' : pedido
                  };
    //completamos los gastos inicilaes
    angular.forEach(gastos_iniciales_r70, function(value, key){
       value['nro_pedido'] = pedido['nro_pedido'];
       value['id_user'] = $scope.idUser;
       if(value.concepto === 'GASTO ORIGEN'){
        value['valor_provisionado'] = helper['gasto_origen'];
       }else{
        value['valor_provisionado'] = helper['gasto_flete'];
       }

    });
    //guardamos el pedido
    var orderPromise = pedidoFactory.putOrder(myPedido);
    orderPromise.then(function(response){
        //guardamos los gastos inicilaes
        saveExpenses(gastos_iniciales_r70[0]);
        saveExpenses(gastos_iniciales_r70[1]);
        $location.path('/listar-pedido/' + pedido.nro_pedido);
        $scope.validError(response.appst, response.message);
    },function(error){
      var message = error.message.slice(1,40);
        $scope.validError(0, message);
    });
  };

  //Obtiene lista de incoterms
  $scope.getIncoterms = function(){
     //limpiamos las variables
      $scope.incoterms = {};
      $scope.showIncoterms = {
                              'countries' : false,
                              'cities' : false,
                              'params' : false,
                              'button' : false,
                            };
     
    var responseHttp = incotermsFactory.getIncoterms();
      responseHttp.then(
        function(response){
          $scope.incoterms['incoterm'] = response.data;
        }, function(error){
        var message = error.message.slice(1,40);
        $scope.validError(0, message);
        });  
  return responseHttp;
  };

  //Obtiene la lista de paises por incoterm
  $scope.getIncotermsCountries = function(incoterm){
     $scope.incoterms['countries'] = '';
     $scope.incoterms['cities'] = '';
     $scope.incoterms['param'] = '';
     $scope.showIncoterms['countries'] = false;
     $scope.showIncoterms['cities'] = false;
     $scope.showIncoterms['param'] = false;
     var responseHttp = incotermsFactory.getincotermsCountries(incoterm);

      responseHttp.then(
        function(response){
          $scope.incoterms['countries'] = response.data;
          $scope.showIncoterms['countries'] = true;
        }, function(error){
        var message = error.message.slice(1,40);
        $scope.validError(0, message);
        });  
  return responseHttp;
  };

  //Lista las ciudades del incoterm
  $scope.getIncotermsCities = function(incoterm, country){
     $scope.incoterms['cities'] = '';
     $scope.showIncoterms['cities'] = false;
     $scope.incoterms['param'] = '';
     $scope.showIncoterms['param'] = false;
     var responseHttp = incotermsFactory.getIincotermsCities(incoterm, 
                                                                      country);
      responseHttp.then(
        function(response){
          $scope.incoterms['cities'] = response.data;
          $scope.showIncoterms['cities'] = true;
        }, function(error){
        var message = error.message.slice(1,40);
        $scope.validError(0, message);
        });  
  return responseHttp;
  };

  //Obtiene la tabla de incoterms
  $scope.getIncotermParam = function (incoterm, country, city){
    $scope.incoterms['param'] = '';
    var responseHttp = incotermsFactory.getIncotermsParam(  incoterm,  
                                                            country , 
                                                            city);
      responseHttp.then(
        function(response){
          $scope.incoterms['param'] = response.data;
          $scope.showIncoterms['params'] = true;
          $scope.showIncoterms['button'] = true;
        }, function(error){
        var message = error.message.slice(1,40);
        $scope.validError(0, message);
        });  
    };

  //crea los incoterms
  $scope.putIncoterms = function(incoterm){
    console.log('$scope.putIncoterms');
    //vaciamos la variable
    $scope.formdata.gastos_iniciales_r70 = [];
    $scope.formdata.pedido['incoterm'] = incoterm.data[0]["incoterms"];
    $scope.formdata.pedido['pais_origen'] = incoterm.data[0]["pais"];
    $scope.formdata.pedido['ciudad_origen'] = incoterm.data[0]["ciudad"];
    $scope.formdata.helper['gasto_origen'] = incoterm.data[0]["tarifa"];
    $scope.formdata.helper['gasto_flete'] = incoterm.data[1]["tarifa"];
    $scope.formdata.pedido['antes_fob_provisionado'] = incoterm.data[0]["tarifa"];

    angular.forEach(incoterm.data, function(value, key){
      this.push({'concepto': value["tipo"],
            'valor_provisionado': value["tarifa"] }) ;
      
    }, $scope.formdata.gastos_iniciales_r70);
    
    };
  
  // Valida La session
  $scope.validSession = function(){
    var httpResponse = factoryLogin.checkSession();
    httpResponse.then(function(response){
      $scope.validError(response.appst , response.message);
      $scope.idUser = response.session['id_user'];
      $scope.nameUser = response.session['nombres'];
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
      hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
      stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
      position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
      textAlign: 'left',  // Text alignment i.e. left, right or center
      loader: true,  // Whether to show loader or not. True by default
      loaderBg: '#018aa3',  //#9EC600 Background color of the toast loader
  });
  };

  //regresa a la lista de los pedidos
  $scope.goBack = function(){
    $location.path('/');
   };

   
  //Inicia parametros Controller
  $scope.main = function(){
    console.log('[Debug] $scope.main()');
    $scope.validSession();
    //User Data
    $scope.idUser = '';
    $scope.nameUser = '';
    $scope.formdata = {
    'pedido' : {
      'flete_aduana':0,
      'seguro_aduana':0
    },
      'helper' : {},
      'gastos_iniciales_r70' : []
    };

    };

  $scope.main();
}]);
