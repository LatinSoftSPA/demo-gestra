$(document).ready(function(){
  $('#listadoPropietarios').on('click', '.btnEditar', function(e) {
		e.preventDefault();
		var row = $(this).parents('tr');
		var docu_perso = row.data('docu_perso');

		var busqueda = buscarPropietario(docu_perso);
		busqueda.done(function(data, textStatus, jqXHR){
			$('#modal_editar').modal();
			_cargarCamposPropietarios(data);
		});
  });
});

function _cargarCamposPropietarios(data){
	var persona = data.objPersona[0];
	var domicilio = data.objDomicilio[0];
	var contacto = data.objContacto[0];
	var propietario = data.objPropietario[0];
	var moviles = data.objMoviles;
	_cargarDatosPersona(persona);
	_cargarDatosDomicilio(domicilio);
	_cargarDatosContacto(contacto);
	_cargarDatosPropietario(propietario);
	_cargarDatosFlota(moviles);
}

function _cargarDatosPropietario(propietario){
	if(propietario.habilitado === 1){
		$('#btnHabilitado').button('toggle');
		$('#btnDesHabilitado').button('reset');
	} else {
		$('#btnDesHabilitado').button('toggle');
		$('#btnHabilitado').button('reset');
	}
}

function _cargarDatosFlota(moviles){
	$('#listadoFlota').html('');
	var elHtml = '';
	$.each(moviles, function(i, obj){
		elHtml += '<tr class="">';
		elHtml += '<td class="text-center info">' +obj.nume_movil+ '</td>';
		elHtml += '<td class="text-center"><b>' +obj.pate_movil+ '</b></td>';
		elHtml += '<td class="text-center">' +obj.fech_revis+ '</td>';
		elHtml += '<td class="text-center">' +obj.anio_movil+ '</td>';
		elHtml += '<tr class="info">';
	});
	$('#listadoFlota').html(elHtml);
}
/*ACTUALIZAR CONDUCTOR*/
$(document).ready(function(){
	$('#btnActualizar').click(function(e){
		var formulario = $('#frmEditar').serialize();
		var actualizacion = actualizarPropietario(formulario);
		actualizacion.done(function(data, textStatus, jqXHR ){
			$('#modal_editar').modal('hide');
			listarPropietarios();
		});
	});
});

function actualizarPropietario(formulario){
	var parametros = formulario;
	var token = document.getElementsByName("_token");
	var url = 'propietarios/actualizar';
	return $.ajax({
		url : url,
		headers : {'X-CSRF-TOKEN' : token[0].value},
		type : 'PUT',
		data: parametros,
		dataType : 'json',
		beforeSend: function(){},
	})
	.done(function(data, textStatus, jqXHR ){
		if (jqXHR.status == 200) {
			var title = 'Nota';
			toastr.info(data.msg, title);
		}
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
/*FIN: ACTUALIZAR CONDUCTOR*/


/*INICIALIZAR MODAL*/
$(document).ready(function(){
  $('#modal_editar').on('hidden.bs.modal', function(){
  	_limpiarCampos('#frmEditar');
  });
});
/*FIN: INICIALIZAR MODAL*/