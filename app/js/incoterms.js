/**
 * Modulo encargado del manejo de los incoterms en los campos del formulario
 * @author Eduardo Villota <eduardouio7@gmail.com>
 * @copyright Representaciones Cordovez 2017
 */

var countries = [];
var cities = [];
var incoterms = [];

getCountries();

$('#pais_origen').change(function() {
	$('#ciudad_origen option').remove();
	$('#incoterm option').remove();
	cities = [];
	incoterms = [];
	getCities($(this).val());
});

$('#ciudad_origen').change(function() {
	$('#incoterm option').remove();
	incoterms = [];
	getIncoterms($('#pais_origen').val(), $(this).val());
});

function getCountries() {
	$.each(incotermsDb, function(key, value) {
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
	$.each(incotermsDb, function(key, value) {
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
	$.each(incotermsDb, function(key, value) {

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

$('#comentarios').keyup(function() {
	this.value = this.value.toUpperCase();
});
