$(document).ready(function(){
  $('#listadoEquipos').on('click', '.btnEditar', function(e) {
		e.preventDefault();
		var row = $(this).parents('tr');
		var imeiNumber = row.data('imeinumber');
		var deviceID = row.data('deviceid');

		var busqueda = buscarEquipo(imeiNumber, deviceID);
		busqueda.done(function(data, textStatus, jqXHR){
			$('#modal_editar').modal();
			_cargarCamposEquipo(data);
		});
  });
});

function _cargarCamposEquipo(data){
	var equipo = data[0];
	_cargarDatosEquipo(equipo);
}

function _cargarDatosEquipo(equipo){
	console.dir(equipo);
	$('#frmEditar :input[id=deviceID]').val(equipo.deviceID);
	$('#frmEditar :input[id=imeiNumber]').val(equipo.imeiNumber);
	$('#frmEditar :input[id=simPhoneNumber]').val(equipo.simPhoneNumber);
	$('#frmEditar :input[id=serialNumber]').val(equipo.serialNumber);
	/*-----------------------------------------------------------------*/
	if(equipo.isActive === 1){
		$('#btnHabilitado').button('toggle');
		$('#btnDesHabilitado').button('reset');
	} else {
		$('#btnDesHabilitado').button('toggle');
		$('#btnHabilitado').button('reset');
	}
	/*-----------------------------------------------------------------*/
	$('#frmEditar :input[id=accountID]').val(equipo.accountID);
	$('#frmEditar :input[id=groupID]').val(equipo.groupID);
	$('#frmEditar :input[id=driverID]').val(equipo.driverID);
	/*-----------------------------------------------------------------*/
	$('#frmEditar :input[id=description]').val(equipo.description);
	$('#frmEditar :input[id=displayName]').val(equipo.displayName);
	$('#frmEditar :input[id=licensePlate]').val(equipo.licensePlate);
	$('#frmEditar :input[id=vehicleYear]').val(equipo.vehicleYear);
}
/*ACTUALIZAR MOVIL*/
$(document).ready(function(){
	$('#btnActualizar').click(function(e){
		var formulario = $('#frmEditar').serialize();
		var actualizacion = actualizarEquipo(formulario);
		actualizacion.done(function(data, textStatus, jqXHR ){
			$('#modal_editar').modal('hide');
			listarEquipos();
		});
	});
});

function actualizarEquipo(formulario){
	var parametros = formulario;
	var token = document.getElementsByName("_token");
	var url = 'equipos/actualizar';
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