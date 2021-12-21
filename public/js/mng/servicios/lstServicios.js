$(document).ready(function(){
	$('#btnConsultar').click(function(e){
		var fech_servi = $('#fech_servi').val();
		var codi_circu = $('#codi_circu').val();
		var servicios = listarServicios(fech_servi, codi_circu);
		servicios.done(function(data, textStatus, jqXHR ){

		});
	});
});

/*LISTAR SERVICIOS*/
function listarServicios(fech_servi, codi_circu){
	var parametros = {'fech_servi' : fech_servi, 'codi_circu' : codi_circu};
	//var token = document.getElementsByName("_token");
	var url = 'servicios/listar';

	return $.ajax({
		url: url,
		//headers : {'X-CSRF-TOKEN' : token[0].value},
		type : 'GET',
		data: parametros,
		dataType: 'json',
		beforeSend: function(){
			$('#listadoServicios').html('');
		},
		error: function(){
			console.log('Lamentablemente Hay un Error de Coneccion, Intentelo Mas Tarde!!!');
		}
	})
	.done(function(data, textStatus, jqXHR ){
		listado = data.listado;
		var listaHTML = _lstHtmlServicios(listado);
		//var listaHTML = _lstHtmlMoviles(listado);
		$('#listadoServicios').html(listaHTML);

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

function _lstHtmlServicios(listado){
	var elHtml = '';
	for(movil = 1; movil <= 66; movil++){
		var movil_anterior = movil;
		elHtml += '<tr>';
		//elHtml += '<tr data-nume_movil="'+movil+'" data-pate_movil="">';
		elHtml += '<td class="info text-center"><b>' +movil+ '</b></td>';
		$.each(listado, function(i, obj){
			if(movil_anterior === obj.MAQ){
				if(obj.procesar === 0){
					elHtml += '<td class="success text-center"><b>' +obj.INI+ '</b></td>';
				} else {					
					elHtml += '<td class="danger text-center"><b>' +obj.INI+ '</b></td>';
				}
			}
		});
		elHtml += '</tr>';
	}
	return elHtml;
}
/*FIN: LISTAR SERVICIOS*/
