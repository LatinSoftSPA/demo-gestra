$(document).ready(function(){
	listarMoviles();
});

function buscarMovil(pate_movil, nume_movil){
	var parametros = {'pate_movil' : pate_movil, 'nume_movil' : nume_movil};
	var token = document.getElementsByName("_token");
	var url = 'moviles/buscar';
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