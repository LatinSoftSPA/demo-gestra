function buscarPropietario(docu_perso){	
	var parametros = {'docu_perso' : docu_perso};
	var token = document.getElementsByName("_token");
	var url = 'propietarios/buscar';
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
/*LISTAR PROPIETARIOS*/
function listarPropietarios(){
	var token = document.getElementsByName("_token");
	var url = 'propietarios/listar';  
    
	$.ajax({
		url: url,
		type: 'GET',
		headers : {'X-CSRF-TOKEN' : token[0].value},
		dataType: 'json',
		beforeSend: function(){
			$('#listadoPropietarios').html('');
		},
		error: function(){
			console.log('Lamentablemente Hay un Error de Coneccion, Intentelo Mas Tarde!!!');
		}
	})
	.done(function(data, textStatus, jqXHR ){
    	listado = data.listado;
		//mostrarMensaje(obj.msg, 'alert-success');
		var listaHTML = _lstHtmlPropietarios(listado);
		$('#listadoPropietarios').html(listaHTML);
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

function _lstHtmlPropietarios(listado){
	var elHtml = '';
	var cont = 0;
	  $.each(listado, function(i, obj){

		if (obj.habilitado == 1)
		{
		  elHtml += '<tr class="success" data-docu_perso="' +obj.docu_perso+'">';
		} else {
		  elHtml += '<tr class="danger" data-docu_perso="' +obj.docu_perso+'">';
		}
		elHtml += '<td class="text-right"><b>' +obj.docu_perso+ '</b></td>';
		elHtml += '<td class="text-center">';
		elHtml += '<a href="#!" class="btn btn-xs btn-warning btnEditar"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></<a>';
		elHtml += '<a href="#!" class="btn btn-xs btn-danger btnEliminar"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>';
		elHtml += '</td>';
		elHtml += '<td class="text-nowrap">' +obj.prim_nombr+ ' ' +obj.segu_nombr+ '</td>';
		elHtml += '<td class="text-nowrap">' +obj.apel_pater+ ' ' +obj.apel_mater+ '</td>';
		elHtml += '<td class="text-nowrap">' +obj.nomb_domic+ ' #' +obj.nume_domic+ '</td>';
		elHtml += '<td class="text-center">' +obj.tele_conta+ '</td>';
		elHtml += '<td class="text-center">' +obj.movi_conta+ '</td>';
		elHtml += '<td class="text-right">' +obj.mail_conta+ '</td>';

		elHtml += '</tr>';
	  });
  return elHtml;
}
/*FIN: LISTAR PROPIETARIOS*/

/*FILTRAR CONDUCTOR*/
$(document).ready(function(){
	$('#apellido_buscar').keypress(function(e){
		if(e.which == 13){
			var apellido_buscar = $(this).val();
			if(apellido_buscar.length > 0){
				filtrarPropietarios(apellido_buscar);
			} else {
				listarPropietarios();
			}
		}
	});
});

function filtrarPropietarios(apellido_buscar){
	var parametros = {"apel_pater" : apellido_buscar};
	var url = 'propietarios/filtrar';

	$.ajax({
		url: url,
		type: 'GET',
		data: parametros,
		dataType: 'json',
		beforeSend: function(){
			$('#listadoPropietarios').html('');
		},
		error: function(){
			console.log('Lamentablemente Hay un Error de Coneccion, Intentelo Mas Tarde!!!');
		}
	})
	.done(function(data, textStatus, jqXHR ){
    	listado = data.listado;
		//mostrarMensaje(obj.msg, 'alert-success');
		var listaHTML = _lstHtmlPropietarios(listado);
		$('#listadoPropietarios').html(listaHTML);
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
/*FIN: FILTRAR CONDUCTOR*/

/*ELIMINAR EL CONDUCTOR*/
$(document).ready(function(){
	$('#listadoPropietarios').on('click', '.btnEliminar', function(e) {
		e.preventDefault();
		if( !confirm("¿Esta Seguro de Eliminar este Registro?") ){
	      return false;
	    }
		var row = $(this).parents('tr');
	    var docu_perso = row.data('docu_perso');

	    var borrado = eliminandoPropietario(docu_perso);
	    borrado.done(function(data, textStatus, jqXHR){
	    	var msg = data.msg;

			var title = 'Atencion';
			toastr.warning(data.msg, title);

			row.fadeOut();
	    });
	});
});

function eliminandoPropietario(docu_perso){	
	var parametros = {'docu_perso' : docu_perso};
	var token = document.getElementsByName("_token");
	var url = 'propietarios/eliminar';
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