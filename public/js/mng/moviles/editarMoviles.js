$(document).ready(function(){
  $('#listadoMoviles').on('click', '.btnEditar', function(e) {
		e.preventDefault();
		var row = $(this).parents('tr');
		var pate_movil = row.data('pate_movil');
		var nume_movil = row.data('nume_movil');

		var busqueda = buscarMovil(pate_movil, nume_movil);
		busqueda.done(function(data, textStatus, jqXHR){
			$('#modal_editar').modal();
			_cargarCamposMovil(data);
		});
  });
});

function _cargarCamposMovil(data){
	var movil = data.objMoviles[0];
	_cargarDatosMovil(movil);
}

function _cargarDatosMovil(movil){
	$('#frmEditar :input[id=nume_movil]').val(movil.nume_movil);
	$('#frmEditar :input[id=pate_movil]').val(movil.pate_movil);
	$('#frmEditar :input[id=fech_revis]').val(movil.fech_revis);
	$('#frmEditar :input[id=anio_movil]').val(movil.anio_movil);
	$('#frmEditar :input[id=docu_perso]').val(movil.docu_perso);
	if(movil.habilitado === 1){
		$('#btnHabilitado').button('toggle');
		$('#btnDesHabilitado').button('reset');
	} else {
		$('#btnDesHabilitado').button('toggle');
		$('#btnHabilitado').button('reset');
	}
}
/*ACTUALIZAR MOVIL*/
$(document).ready(function(){
	$('#btnActualizar').click(function(e){
		var formulario = $('#frmEditar').serialize();
		var actualizacion = actualizarMovil(formulario);
		actualizacion.done(function(data, textStatus, jqXHR ){
			$('#modal_editar').modal('hide');
			listarMoviles();
		});
	});
});

function actualizarMovil(formulario){
	var parametros = formulario;
	var token = document.getElementsByName("_token");
	var url = 'moviles/actualizar';
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
/*FIN: ACTUALIZAR MOVIL*/


/*INICIALIZAR MODAL*/
$(document).ready(function(){
  $('#modal_editar').on('hidden.bs.modal', function(){
  	_limpiarCampos('#frmEditar');
  });
});
/*FIN: INICIALIZAR MODAL*/