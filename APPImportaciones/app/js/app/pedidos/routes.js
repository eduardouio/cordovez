/**
 * manejo de rutas
 *
 * @package    CordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
(function(angular){
  app.config(['$routeProvider', function($routeProvider){
    $routeProvider

    .when(/,{
      templateUrl: 'http://localhost/app/app/views/forms/frm_pedido.html.twig',
      controller:'cordovezApp.PedidosController'
    });


  }]);
})(window.angular)
