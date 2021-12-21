function buscarEquipo(imeiNumber, deviceID){	
	var parametros = {'imeiNumber' : imeiNumber, 'deviceID' : deviceID};
	var token = document.getElementsByName("_token");
	var url = 'equipos/buscar';
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
/*LISTAR MOVILES*/

function listarEquipos(){
	var url = 'equipos/listar';

	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'json',
		beforeSend: function(){
		$('#listadoEquipos').html('');
		},
		success: function(data){
		},
		error: function(){
		console.log('Lamentablemente Hay un Error de Coneccion, Intentelo Mas Tarde!!!');
		}
	})
	.done(function(data, textStatus, jqXHR ){
		listado = data.listado;

		//mostrarMensaje(obj.msg, 'alert-success');
		var listaHTML = _lstHtmlEquipos(listado);
		$('#listadoEquipos').html(listaHTML);
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

function _lstHtmlEquipos(listado){
	var elHtml = '';
	$.each(listado, function(i, obj){
		if (obj.isActive === 1)
		{
		  elHtml += '<tr class="success" data-imeiNumber="' +obj.imeiNumber+'" data-deviceID="' +obj.deviceID+'">';
		} else {
		  elHtml += '<tr class="danger" data-imeiNumber="' +obj.imeiNumber+ '" data-deviceID="' +obj.deviceID+'">';
		}
			elHtml += '<td class="text-center"><b>' +obj.deviceID+ '</b></td>';
			elHtml += '<td class="text-nowrap text-center">';
				elHtml += '<a href="#!" class="btn btn-xs btn-warning btnEditar"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></<a>';
				elHtml += '<a href="#!" class="btn btn-xs btn-danger btnEliminar"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>';
			elHtml += '</td>';			
			elHtml += '<td class="text-center"><b>' +obj.imeiNumber+ '</b></td>';
			elHtml += '<td class="text-center">' +obj.simPhoneNumber+ '</td>';
			elHtml += '<td class="text-center">' +obj.licensePlate+ '</td>';
			elHtml += '<td class="text-center hidden-sm hidden-xs">' +obj.serialNumber+ '</td>';

			var fech_revis = new Date(obj.lastGPSTimestamp * 1000);
			var fecha = fech_revis.toLocaleDateString();
			elHtml += '<td class="text-nowrap text-center hidden-sm hidden-xs">' +fecha+ '</td>';
			

		elHtml += '</tr>';
	});
	return elHtml;
}
/*FIN: LISTAR EQUIPOS*/

/*FILTRAR MOVIL*/
$(document).ready(function(){
	$('#nume_imei').keypress(function(e){
		if(e.which == 13){
			var nume_imei = $(this).val();
			if(nume_imei.length > 0){
				filtarEquipos(nume_imei);
			} else {
				listarEquipos();
			}
		}
	});
});

function filtarEquipos(nume_imei){
	var url = 'equipos/filtrar';
	var parametros = {"nume_imei" : nume_imei};

	$.ajax({
		url: url,
		type: 'GET',
		data: parametros,
		dataType: 'json',
		beforeSend: function(){
			$('#listadoConductores').html('');
		},
		error: function(){
			console.log('Lamentablemente Hay un Error de Coneccion, Intentelo Mas Tarde!!!');
		}
	})
	.done(function(data, textStatus, jqXHR ){
		listado = data.listado;

		//mostrarMensaje(obj.msg, 'alert-success');
		var listaHTML = _lstHtmlEquipos(listado);
		$('#listadoEquipos').html(listaHTML);
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
/*FIN: FILTRAR MOVIL*/

/*ELIMINAR EL MOVIL*/
$(document).ready(function(){
	$('#listadoMoviles').on('click', '.btnEliminar', function(e) {
		e.preventDefault();
		if( !confirm("¿Esta Seguro de Eliminar este Registro?") ){
	      return false;
	    }
		var row = $(this).parents('tr');
	    var imeiNumber = row.data('imeiNumber');

	    var borrado = eliminandoMovil(imeiNumber);
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