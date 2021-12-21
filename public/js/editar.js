$(document).ready(function(){
	$('#btnEditar').click(function (e){
		e.preventDefault();
		var frm = $('#frmEditar');
		var url = frm.attr('action');
		var data = frm.serialize();

		$.post(url, data, function(result){
			var msg = result.msg;
			var clr = result.clr;
			mostrarMensaje(msg, clr);
		}).fail(function(){
			mostrarMensaje('ALGO SALIO MAL', 'alert-danger');
		});

	});
});