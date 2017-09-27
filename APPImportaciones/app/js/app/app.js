/**
 * aplicacion Angular del sistema
 *
 * @package    CordovezApp JS
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://github.com/eduardouio/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */

var cordovezApp = angular.module('cordovezApp', ['ngRoute']);


cordovezApp.directive('stringToNumber', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attrs, ngModel) {
      ngModel.$parsers.push(function(value) {
        return '' + value;
      });
      ngModel.$formatters.push(function(value) {
        e = parseFloat(value).toFixed(2);
        return parseFloat(e);
      });
    }
  };
});
	
	