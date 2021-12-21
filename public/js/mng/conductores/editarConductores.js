$(document).ready(function(){
  $('#listadoConductores').on('click', '.btnEditar', function(e) {
		e.preventDefault();
		var row = $(this).parents('tr');
		var codi_licen = row.data('codi_licen');
		var docu_perso = row.data('docu_perso');

		var busqueda = buscarConductor(codi_licen, docu_perso);
		busqueda.done(function(data, textStatus, jqXHR){
			$('#modal_editar').modal();
			_cargarCamposConductor(data);
		});
  });
});

function _cargarCamposConductor(data){
	var persona = data.objPersona[0];
	var domicilio = data.objDomicilio[0];
	var contacto = data.objContacto[0];
	var conductor = data.objConductor[0];
	var licencia = data.objLicencia[0];
	_cargarDatosPersona(persona);
	_cargarDatosDomicilio(domicilio);
	_cargarDatosContacto(contacto);
	_cargarDatosLicencia(licencia);
	_cargarDatosConductor(conductor);
}

function _cargarDatosLicencia(licencia){
	$('#frmEditar :input[id=codi_licen]').val(licencia.codi_licen);
	$('#frmEditar :input[id=fech_venci]').val(licencia.fech_venci);

	if(licencia.A1 === true){$('#btnA1').attr('checked', true);$('#btnA1').addClass('active');}
	if(licencia.A2 === true){$('#btnA2').attr('checked', true);$('#btnA2').addClass('active');}
	if(licencia.A3 === true){$('#btnA3').attr('checked', true);$('#btnA3').addClass('active');}
	if(licencia.A4 === true){$('#btnA4').attr('checked', true);$('#btnA4').addClass('active');}
	if(licencia.A5 === true){$('#btnA5').attr('checked', true);$('#btnA5').addClass('active');}
	if(licencia.B === true){$('#btnB').attr('checked', true);$('#btnB').addClass('active');}
	if(licencia.C === true){$('#btnC').attr('checked', true);$('#btnC').addClass('active');}
	if(licencia.D === true){$('#btnD').attr('checked', true);$('#btnD').addClass('active');}
	if(licencia.E === true){$('#btnE').attr('checked', true);$('#btnE').addClass('active');}
	if(licencia.F === true){$('#btnF').attr('checked', true);$('#btnF').addClass('active');}	
}

function _cargarDatosConductor(conductor){
	if(conductor.habilitado === 1){
		$('#btnHabilitado').button('toggle');
		$('#btnDesHabilitado').button('reset');
	} else {
		$('#btnDesHabilitado').button('toggle');
		$('#btnHabilitado').button('reset');
	}
}
/*ACTUALIZAR CONDUCTOR*/
$(document).ready(function(){
	$('#btnActualizar').click(function(e){
		var formulario = $('#frmEditar').serialize();
		var actualizacion = actualizarConductor(formulario);
		actualizacion.done(function(data, textStatus, jqXHR ){
			$('#modal_editar').modal('hide');
			listarConductores();
		});
	});
});

function actualizarConductor(formulario){
	var parametros = formulario;
	var token = document.getElementsByName("_token");
	var url = 'conductores/actualizar';
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