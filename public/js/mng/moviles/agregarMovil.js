$(document).ready(function(){
	$('#btnAgregar').click(function(e){
		$('#modal_agregar').modal();
	});
});
/*AGREGAR CONDUCTOR*/
$(document).ready(function(){
	$('#btnGuardar').click(function(e){
		var formulario = $('#frmAgregar').serialize();
		var guardar = guardarMovil(formulario);
		guardar.done(function(data, textStatus, jqXHR ){
			_limpiarCampos('#frmAgregar');
			$('#modal_agregar').modal('hide');
			listarConductores();
		});
	});
});

function guardarMovil(formulario){
	var parametros = formulario;
	var token = document.getElementsByName("_token");
	var url = 'moviles/guardar';
	return $.ajax({
		url : url,
		headers : {'X-CSRF-TOKEN' : token[0].value},
		type : 'POST',
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
		if (jqXHR.status == 500) {
			var title = 'Nota';
			toastr.error(jqXHR.responseJSON.msg, title);
		}
	});
}
/*FIN: AGREGAR CONDUCTOR*/

/*INICIALIZAR MODAL*/
$(document).ready(function(){
	$('#modal_agregar').on('shown.bs.modal', function(){
    	$('#frmAgregar :input[id=docu_perso]').focus();
	});
});