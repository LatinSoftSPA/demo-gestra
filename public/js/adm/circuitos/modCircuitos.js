$(document).ready(function(){
	listarCircuitos();
});

$(document).ready(function(){
	$('#nomb_circu').keypress(function(e){
		if(e.which == 13){
			var nomb_circu = $(this).val();
			if(nomb_circu.length > 0){
				filtrarCircuitos(nomb_circu);
			} else {
				listarCircuitos();
			}
		}
	});
});

function listarCircuitos(){
	var url = 'circuitos/listar';
    
	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'json',
		beforeSend: function(){
			$('#listadoCircuitos').html('');
		},
		error: function(){
			console.log('Lamentablemente Hay un Error de Coneccion Ajax, Intentelo Nuevamente!!!');
		}
	})
	.done(function(data, textStatus, jqXHR ){
		var listado = data.listado;
		var listaHTML = _lstHtmlMoviles(listado);
		$('#listadoCircuitos').html(listaHTML);
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

function filtrarCircuitos(nomb_circu){
	var url = 'circuitos/filtrar';
	var parametros = {"nomb_circu" : nomb_circu};
  
    
	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'json',
		data: parametros,
		beforeSend: function(){
			$('#listadoCircuitos').html('');
		},
		error: function(){
			console.log('Lamentablemente Hay un Error de Coneccion Ajax, Intentelo Nuevamente!!!');
		}
	})
	.done(function( data, textStatus, jqXHR ){
		listado = data.listado;
		var listaHTML = _lstHtmlMoviles(listado);
		$('#listadoCircuitos').html(listaHTML);
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

function _lstHtmlMoviles(listado){
	var elHtml = '';
	var cont = 0;
	$.each(listado, function(i, obj){
		if (obj.habilitado == 1)
		{
		  elHtml += '<tr class="success" data-codi_circu="' +obj.codi_circu+'">';
		} else {
		  elHtml += '<tr class="danger" data-codi_circu="' +obj.codi_circu+ '">';
		}
		elHtml += '<td class="text-center"><b>' +obj.codi_circu+ '</b></td>';
		elHtml += '<td class="text-nowrap text-center">';
		elHtml += '<a href="circuitos/' +obj.codi_circu+'/edit" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></<a>';
		elHtml += '<a href="#!" class="btn btn-xs btn-danger btnEliminar" disabled><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>';
		elHtml += '</td>';
		elHtml += '<td class="">' +obj.nomb_circu+ '</td>';
		elHtml += '<td class="text-center">' +obj.abre_circu+ '</td>';

		elHtml += '</tr>';
	});
  return elHtml;
}
