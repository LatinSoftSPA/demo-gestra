/*LISTAR SERVICIOS*/
function listarServicios(fech_consu, codi_circu){
	var parametros = {'fech_consu' : fech_consu, 'codi_circu' : codi_circu};
	var url = 'estadisticas/servicios';

	return $.ajax({
		url: url,
		type : 'GET',
		data: parametros,
		dataType: 'json',
		beforeSend: function(){
			//$('#listadoServicios').html('');
		},
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
/*FIN: LISTAR SERVICIOS*/
