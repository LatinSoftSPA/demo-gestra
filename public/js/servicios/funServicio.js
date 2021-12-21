var objeto_servicio = null;

function buscarServicio(codi_circu, nume_movil, pate_movil, codi_servi){
	var parametros = {'codi_servi' : codi_servi, 'codi_circu' : codi_circu, 'nume_movil' : nume_movil, 'pate_movil' : pate_movil};

	var url = 'servicios/buscar';
	var token = document.getElementsByName("_token"); 
	return $.ajax({
		url: url,
		type: 'POST',
    	headers : {'X-CSRF-TOKEN' : token[0].value},
		data: parametros,
		dataType: 'json'
	})
	.done(function(data, textStatus, jqXHR ){
		objeto_servicio = data;
	})
	.always(function( a, textStatus, b ) {
	//TODO
	})
	.fail(function( jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 404) {
			var title = 'Felicidades';
			toastr.error(jqXHR.responseText, title);
		}
	});
}

function eliminandoServicio(codi_circu, nume_movil, pate_movil, codi_servi){
	var parametros = {'codi_servi' : codi_servi, 'codi_circu' : codi_circu, 'nume_movil' : nume_movil, 'pate_movil' : pate_movil};

	var url = 'servicios/eliminar';
	var token = document.getElementsByName("_token"); 
	return $.ajax({
		url : url,
		headers : {'X-CSRF-TOKEN' : token[0].value},
		type : 'POST',
		data: parametros,
		dataType : 'json',
		beforeSend: function(){},
		error: function(){
		console.log('Lamentablemente Hay un Error de Coneccion AJAX, Intentelo Mas Tarde!!!');
		}
	})
	.done(function(data, textStatus, jqXHR ){
	})
	.always(function( a, textStatus, b ) {
	//TODO
	})
	.fail(function( jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 404) {
		alert(jqXHR.responseText);
		}
	});
}