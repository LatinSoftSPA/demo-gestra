/*LIMPIAR FORMULARIOS*/
function _limpiarCampos(formulario){
    $(formulario).trigger('reset');
    var lstCheckboxs = $(formulario +' :input[type="checkbox"]');
    $.each(lstCheckboxs, function(i, checkbox) {
		$(checkbox).prop('checked', false).parent().removeClass('active');
	});

	var lstRadios = $(formulario +' :input[type="radio"]');
    $.each(lstRadios, function(i, radio) {
		$(radio).prop('checked', false).parent().removeClass('active');
	});
}
/*FIN: LIMPIAR FORMULARIOS*/

function _cargarDatosPersona(persona){
    $('#frmEditar :input[id=docu_perso]').val(persona.docu_perso);
    $('#frmEditar :input[id=prim_nombr]').val(persona.prim_nombr);$('#frmEditar :input[id=segu_nombr]').val(persona.segu_nombr);
    $('#frmEditar :input[id=apel_pater]').val(persona.apel_pater);$('#frmEditar :input[id=apel_mater]').val(persona.apel_mater);
    $('#frmEditar :input[id=fech_nacim]').val(persona.fech_nacim);$('#frmEditar :input[id=idde_nacio]').val(persona.idde_nacio);
    $('#frmEditar :input[id=idde_ecivi]').val(persona.idde_ecivi);

	if(persona.idde_gener === 1){
		$('#btnMasculino').button('toggle');
		$('#btnFemenino').button('reset');
	} else {
		$('#btnFemenino').button('toggle');
		$('#btnMasculino').button('reset');
	}
}

function _cargarDatosDomicilio(domicilio){
    $('#frmEditar :input[id=nomb_domic]').val(domicilio.nomb_domic);
	$('#frmEditar :input[id=nume_domic]').val(domicilio.nume_domic);
	$('#frmEditar :input[id=nomb_pobla]').val(domicilio.nomb_pobla);
	$('#frmEditar :input[id=nume_bloqu]').val(domicilio.nume_bloqu);
	$('#frmEditar :input[id=nume_depto]').val(domicilio.nume_depto);
	$('#frmEditar :input[id=idde_provi]').val(domicilio.idde_provi);
}

function _cargarDatosContacto(contacto){
	$('#frmEditar :input[id=tele_conta]').val(contacto.tele_conta);
	$('#frmEditar :input[id=movi_conta]').val(contacto.movi_conta);
	$('#frmEditar :input[id=mail_conta]').val(contacto.mail_conta);
}
