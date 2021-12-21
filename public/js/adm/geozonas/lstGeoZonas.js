/*LISTAR GEOZONAS*/
function listarGeozonas(){
	var url = 'geozonas/listar';  
    
	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'json',
		beforeSend: function(){
			$('#listadoGeoZonas').html('');
		},
		error: function(){
			console.log('Lamentablemente Hay un Error de Coneccion, Intentelo Mas Tarde!!!');
		}
	})
	.done(function(data, textStatus, jqXHR ){
		listado = data.listado;
		var listaHTML = _lstHtmlGeoZonas(listado);
		$('#listadoGeoZonas').html(listaHTML);
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

function _lstHtmlGeoZonas(listado){
	var elHtml = '';
	var cont = 0;
	$.each(listado, function(i, obj){
		if (obj.isActive == 1)
		{
		  elHtml += '<tr class="success" data-codi_geozo="' +obj.geozoneID+'">';
		} else {
		  elHtml += '<tr class="danger" data-codi_geozo="' +obj.geozoneID+ '">';
		}
			elHtml += '<td class="text-center"><b>' +obj.geozoneID+ '</b></td>';
			elHtml += '<td class="text-nowrap text-center">';
			elHtml += '<a href="#!" class="btn btn-xs btn-warning btnEditar" data-toggle="modal" data-target="#modal_editar"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></<a>';
			elHtml += '<a href="#!" class="btn btn-xs btn-success btnVerMapa" data-toggle="modal" data-target="#modal_mapa" disabled><span class="glyphicon glyphicon-eye-open" aria hidden="true"></span></a>';
			elHtml += '<a href="#!" class="btn btn-xs btn-danger btnEliminar" disabled><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>';
			elHtml += '</td>';			
			elHtml += '<td class="">' +obj.description+ '</td>';
			elHtml += '<td class="text-center">' +obj.displayName+ '</td>';	

		elHtml += '</tr>';
	});
  return elHtml;
}
/*FIN: LISTAR GEOZONAS*/


/*FILTRAR GEOZONAS*/
function filtrarGeozona(nomb_geozo){
	var url = 'geozonas/filtrar';
	var parametros = {"nomb_geozo" : nomb_geozo};
  
    
  $.ajax({
    url: url,
    type: 'GET',
    dataType: 'json',
	data: parametros,
    beforeSend: function(){
      $('#listadoGeoZonas').html('');
    },
    success: function(response){
		listado = response.listado;
	  
      //mostrarMensaje(obj.msg, 'alert-success');
	  var listaHTML = _lstHtmlGeoZonas(listado);
      $('#listadoGeoZonas').html(listaHTML);
    },
    error: function(){
      console.log('Lamentablemente Hay un Error de Coneccion, Intentelo Mas Tarde!!!');
    }
  });
}

$(document).ready(function(){
	$('#nomb_geozo').keypress(function(e){
		if(e.which == 13){
			var nomb_geozo = $(this).val();
			if(nomb_geozo.length > 0){
				filtrarGeozona(nomb_geozo);
			} else {
				listarGeozonas();
			}
		}
	});
});
/*FIN: FILTRAR GEOZONAS*/