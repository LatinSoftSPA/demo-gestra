/*LISTAR MOVILES*/
function listarMoviles(){
	var url = 'moviles/listar';  
    
	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'json',
		beforeSend: function(){
			$('#listadoMoviles').html('');
		},
		error: function(){
			console.log('Lamentablemente Hay un Error de Coneccion, Intentelo Mas Tarde!!!');
		}
	})
	.done(function(data, textStatus, jqXHR ){
		listado = data.listado;
		var listaHTML = _lstHtmlMoviles(listado);
		$('#listadoMoviles').html(listaHTML);
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

function _lstHtmlMoviles(listado){
	var elHtml = '';
	var cont = 0;
	$.each(listado, function(i, obj){
		if (obj.habilitado == 1)
		{
		  elHtml += '<tr class="success" data-nume_movil="'+obj.nume_movil+'" data-pate_movil="'+obj.pate_movil+'">';
		} else {
		  elHtml += '<tr class="danger" data-nume_movil="'+obj.nume_movil+ '" data-pate_movil="'+obj.pate_movil+'">';
		}			
			elHtml += '<td class="text-center"><b>' +obj.pate_movil+ '</b></td>';

			elHtml += '<td class="text-nowrap">';
			elHtml += '<a href="#!" class="btn btn-xs btn-warning btnEditar"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></<a>';
			elHtml += '<a href="#!" class="btn btn-xs btn-danger btnEliminar"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>';
			elHtml += '</td>';

			elHtml += '<td class="text-center"><b>' +obj.nume_movil+ '</b></td>';
			elHtml += '<td class="text-center">' +obj.codi_equip+ '</td>';

			elHtml += '<td class="text-nowrap text-center">' +obj.fech_revis+ '</td>';
			elHtml += '<td class="text-center hidden-sm hidden-xs">' +obj.anio_movil+ '</td>';
			elHtml += '<td class="text-nowrap hidden-sm hidden-xs">' +obj.propietario+ '</td>';
			elHtml += '<td class="text-center">' +obj.imei_equip+ '</td>';
			elHtml += '<td class="text-center">' +obj.nume_telef+ '</td>';
			

		elHtml += '</tr>';
	});
  return elHtml;
}
/*FIN: LISTAR MOVILES*/

/*FILTRAR MOVIL*/
$(document).ready(function(){
	$('#pate_movil').keypress(function(e){
		if(e.which == 13){
			var pate_movil = $(this).val();
			if(pate_movil.length > 0){
				filtrarMovil(pate_movil);
			} else {
				listarMoviles();
			}
		}
	});
});

function filtrarMovil(pate_movil){
	var url = 'moviles/filtrar';
	var parametros = {"pate_movil" : pate_movil};
      
	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'json',
		data: parametros,
		beforeSend: function(){
		$('#listadoMoviles').html('');
		},
		error: function(){
		console.log('Lamentablemente Hay un Error de Coneccion, Intentelo Mas Tarde!!!');
		}
	})
	.done(function(data, textStatus, jqXHR ){
		listado = data.listado;

		//mostrarMensaje(obj.msg, 'alert-success');
		var listaHTML = _lstHtmlMoviles(listado);
		$('#listadoMoviles').html(listaHTML);
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
	});;
}
/*FIN: FILTRAR MOVIL*/

/*ELIMINAR EL MOVIL*/
$(document).ready(function(){
	$('#listadoMoviles').on('click', '.btnEliminar', function(e) {
		e.preventDefault();
		if( !confirm("¿Esta Seguro de Eliminar este Registro?") ){
	      return false;
	    }
		var row = $(this).parents('tr');
	    var pate_movil = row.data('pate_movil');
	    var nume_movil = row.data('nume_movil');

	    var borrado = eliminandoMovil(pate_movil, nume_movil);
	    borrado.done(function(data, textStatus, jqXHR){
	    	var msg = data.msg;

			var title = 'Atencion';
			toastr.warning(data.msg, title);

			row.fadeOut();
	    });
	});
});

function eliminandoMovil(pate_movil, nume_movil){	
	var parametros = {'pate_movil' : pate_movil, 'nume_movil' : nume_movil};
	var token = document.getElementsByName("_token");
	var url = 'moviles/eliminar';
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
/*FIN: ELIMINAR EL CONDUCTOR*/