/**
 * manejo de rutas del modulo de peduidos
 *
 * @package    cordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */

// Configuración de las rutas
cordovezApp.config(function($routeProvider, $locationProvider) {
	$locationProvider.hashPrefix('');
	$routeProvider
		
		.when('/nuevo-pedido', {
			templateUrl : host + '/js/app/views/forms/frm_pedido.html',
			controller 	: 'nuevoPedidoController',
			controllerAs : 'npedidoCtrl'
		})

		.when('/presentar-pedido/:idPedido', {
			templateUrl : host + '/js/app/views/tpl_pedido_presentacion.html',
			controller 	: 'presentarPedidoController',
			controllerAs : 'ppedidoCtrl'
		})
		
		.otherwise({
			redirectTo: '/'
		});
});