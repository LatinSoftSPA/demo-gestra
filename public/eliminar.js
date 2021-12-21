$(document).ready(function(){
	$('.btnEliminar').click(function (e){
		e.preventDefault();
		if( !confirm("¿Esta Seguro de Eliminar este Registro?") ){
			return false;
		}

		var row = $(this).parents('tr');
		var docu_perso = row.data('idde_objeto');
		var frm = $('#frmEliminar');
		var url = frm.attr('action').replace(':IDDE_OBJET', docu_perso);
		var data = frm.serialize();

		$.post(url, data, function(result){
			var msg = result.msg;
			var clr = result.clr;
			row.fadeOut();
			mostrarMensaje(msg, clr);
		}).fail(function(){
			mostrarMensaje('ALGO SALIO MAL', 'alert-danger');
		});
	});
});