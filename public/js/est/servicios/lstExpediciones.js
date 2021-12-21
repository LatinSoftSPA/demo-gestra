$(document).ready(function(){
	$('#btnConsultar').click(function(e){
		var fech_consu = $('#fech_consu').val();
		var codi_circu = $('#codi_circu').val();
		var expediciones = listarExpediciones(fech_consu, codi_circu);
		expediciones.done(function(data, textStatus, jqXHR ){
			var listado_ida = data.expediciones.ida;
			var listado_reg = data.expediciones.reg;
			_crearGraficoEXP('EXPEDICIONES DE IDA', 'expediciones_ida', listado_ida, 'areaspline');
			_crearGraficoEXP('EXPEDICIONES DE REGRESO', 'expediciones_reg', listado_reg, 'areaspline');
		});
		var servicios = listarServicios(fech_consu, codi_circu);
		servicios.done(function(data, textStatus, jqXHR){
			var listado = data.servicios;
			_crearGraficoSER('SERVICIOS DEL DIA', 'servicios_diario', listado, 'column');

		});
		var multas = listarMultas(fech_consu, codi_circu);
		multas.done(function(data, textStatus, jqXHR){
			var listado = data.multas.diarias;
			_crearGraficoMULDIA('MULTAS DEL DIA', 'multas_diarias', listado, 'line');
			var listado = data.multas.moviles;
			_crearGraficoMULMOV('MULTAS X MOVILES', 'multas_moviles', listado, 'column');
		});
	});
});

/*LISTAR EXPEDICIONES*/
function listarExpediciones(fech_consu, codi_circu){
	var parametros = {'fech_consu' : fech_consu, 'codi_circu' : codi_circu};
	var url = 'estadisticas/expediciones';

	return $.ajax({
		url: url,
		type : 'GET',
		data: parametros,
		dataType: 'json',
		beforeSend: function(){},
		error: function(){
			console.log('Lamentablemente Hay un Error de Coneccion, Intentelo Mas Tarde!!!');
		}
	})
	.done(function(data, textStatus, jqXHR ){
	})
	.always(function( a, textStatus, b ) {
	//TODO
	})
	.fail(function( jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 404) {
		var title = 'Nota';
		toastr.error(jqXHR.responseText, title);

		console.log(jqXHR.responseText);
		}
	});
}
/*FIN: LISTAR EXPEDICIONES*/
