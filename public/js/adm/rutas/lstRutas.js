/*LISTAR RUTAS*/
function listarRutas(){
	var url = 'rutas/listar';
    
	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'json',
		beforeSend: function(){
			$('#listadoRutas').html('');
		},
		error: function(){
			console.log('Lamentablemente Hay un Error de Coneccion, Intentelo Mas Tarde!!!');
		}
	})
	.done(function(data, textStatus, jqXHR ){
		var listado = data.listado;
		var listaHTML = _lstHtmlRutas(listado);
		$('#listadoRutas').html(listaHTML);
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

function _lstHtmlRutas(listado){
	var elHtml = '';
	var cont = 0;
	$.each(listado, function(i, obj){
		if (obj.habilitado == 1)
		{
		  elHtml += '<tr class="success" data-codi_ruta="' +obj.codi_ruta+'">';
		} else {
		  elHtml += '<tr class="danger" data-codi_ruta="' +obj.codi_ruta+ '">';
		}
		elHtml += '<td class="text-center"><b>' +obj.codi_ruta+ '</b></td>';
		elHtml += '<td class="">' +obj.nomb_ruta+ '</td>';
		if (obj.codi_senti == 1)
		{
		  elHtml += '<td class="text-center">REG</td>';		
		} else {
		  elHtml += '<td class="text-center">IDA</td>';
		}
		elHtml += '<td class="">' +obj.nomb_circu+ '</td>';
		elHtml += '<td class="text-center">' +obj.abre_ruta+ '</td>';
		elHtml += '<td class="text-nowrap text-center">';
		elHtml += '<a href="rutas/' +obj.codi_ruta+'/edit" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></<a>';
		elHtml += '<a href="#!" class="btn btn-xs btn-success btnVerMapa" data-toggle="modal" data-target="#modal_mapa"><span class="glyphicon glyphicon-eye-open" aria hidden="true"></span></a>';
		elHtml += '<a href="#!" class="btn btn-xs btn-danger btnEliminar" disabled><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>';
		elHtml += '</td>';

		elHtml += '</tr>';
	});
  return elHtml;
}
/*FIN: LISTAR RUTAS*/

/*FILTRAR RUTAS*/
$(document).ready(function(){
	$('#nomb_ruta').keypress(function(e){
		if(e.which == 13){
			var nomb_ruta = $(this).val();
			if(nomb_ruta.length > 0){
				filtrarRutas(nomb_ruta);
			} else {
				listarRutas();
			}
		}
	});
});


function filtrarRutas(nomb_ruta){
	var url = 'rutas/filtrar';
	var parametros = {"nomb_ruta" : nomb_ruta};
  
    
	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'json',
		data: parametros,
		beforeSend: function(){
			$('#listadoRutas').html('');
		},
		error: function(){
			console.log('Lamentablemente Hay un Error de Coneccion Ajax, Intentelo Nuevamente!!!');
		}
	})
	.done(function( data, textStatus, jqXHR ){
		listado = data.listado;
		var listaHTML = _lstHtmlRutas(listado);
		$('#listadoRutas').html(listaHTML);
	})
	.always(function( a, textStatus, b ) {
        //TODO
    })
    .fail(function( jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 404) {
			alert(jqXHR.statusText);
    		//console.dir(jqXHR.responseText);
		}
	});
}
/*FIN: FILTRAR RUTAS*/