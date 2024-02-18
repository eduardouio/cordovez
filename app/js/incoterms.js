/**
 * Modulo encargado del manejo de los incoterms en los campos del formulario
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Representaciones Cordovez 2017
 */

var countries = [];
var cities = [];
var incoterms = [];

getCountries();

$('#pais_origen').change(function () {
	$('#ciudad_origen option').remove();
	$('#incoterm option').remove();
	cities = [];
	incoterms = [];
	getCities($(this).val());
});

$('#ciudad_origen').change(function () {
	$('#incoterm option').remove();
	incoterms = [];
	getIncoterms($('#pais_origen').val(), $(this).val());
});

function getCountries() {
	$.each(incotermsDb, function (key, value) {
		if ($.inArray(value.pais, countries) === -1) {
			countries.push(value.pais);
			$('#pais_origen').append(
				'<option value="' + value.pais + '">' + value.pais
				+ '</option>');
		}
	});
}

function getCities(countrie) {
	var x = 1;
	$.each(incotermsDb, function (key, value) {
		if ((value.pais === countrie)
			&& ($.inArray(value.ciudad, cities) === -1)) {
			cities.push(value.ciudad);
			if (x === 1) {
				$('#ciudad_origen').append(
					'<option disabled selected="">Seleccione...</option>');
				$('#incoterm').append(
					'<option disabled selected="">Seleccione...</option>');
				x++;
			}
			$('#ciudad_origen').append(
				'<option value="' + value.ciudad + '">' + value.ciudad
				+ '</option>');
		}
	});
}

/**
 * Filtra los incoterms por ciudad y pasis
 */
function getIncoterms(countrie, city) {
	var x = 1;
	$.each(incotermsDb, function (key, value) {

		if ((value.pais === countrie) && (value.ciudad === city)
			&& $.inArray(value.incoterms, incoterms) === -1) {
			incoterms.push(value.incoterms);
			if (x === 1) {
				$('#incoterm').append(
					'<option disabled selected="">Seleccione...</option>');
				x++;
			}
			$('#incoterm').append(
				'<option value="' + value.incoterms + '">'
				+ value.incoterms + '</option>');
		}
	});
}

$('#comentarios').keyup(function () {
	this.value = this.value.toUpperCase();
});

var alertaFOB = `
	<div class="alert alert-warning">
	<span class="fa fa-warning"></span>
	Es posible que este pedido tenga
	<strong>Gastos en Origen</strong> que afecten al Fob, este gasto consta como un valor adicional al producto, generalmente
	indicado al pie de la factura, no aplica a todos los pedidos 
	<strong>FOB</strong>, sin embargo es posible que los tengan
	<strong class="text-danger">El Gasto Origen se ingresa en la mimsa moneda del pedido y toma el mismo tipo de cambio de la factura del proveedor de ser el caso</strong>
	</div>
	`;
var alertaCFR = `
	<div class="alert alert-danger">
	<span class="fa fa-warning"></span>
	Este pedido tiene gastos en origen que se asignan al <strong>Flete </strong>, 
	estos <strong>Gastos en Origen</strong> constan como un valor adicional al producto, generalmente
	indicado al pie de la factura, no afecta el valor
	<strong>FOB</strong> del pedido,
	<strong class="text-danger">El Gasto Origen se ingresa en la mimsa moneda del pedido y toma el mismo tipo de cambio de la factura del proveedor de ser el caso</strong>
	`;

var alertaEXWFCA = `
	<div class="alert alert-danger">
	<span class="fa fa-warning"></span>
	Este pedido tiene gastos en origen,
	estos <strong>Gastos en Origen</strong> constan como un valor adicional al producto,
	este valor se usa para obtener el valor 	<strong>FOB</strong> del pedido,
	<strong class="text-danger">El Gasto Origen se ingresa en la mimsa moneda del pedido y toma el mismo tipo de cambio de la factura del proveedor de ser el caso</strong>
	`;

$('#incoterm').change(function () {
	$('#alert-message').empty();
	var alerta = '';
	var gasto = true;
	
	if (this.value === 'CFR') {
		alerta = alertaCFR;
	}

	if (this.value === 'EXW' || this.value === 'FCA') {
		alerta = alertaEXWFCA;
	}

	if (this.value === 'FOB') {
		alerta = alertaFOB;
		gasto = false;
	}

	$('#alert-message').append(alerta);
	$('#gasto_origen').prop('disabled', false);
	
	if (gasto === false && change_go_values === true) {
		$('#gasto_origen').val(0.000);
	} else {
		$('#gasto_origen').val('');
	}

});