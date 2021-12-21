$(document).ready(function(){
	$('#btnAgregar').click(function (e){
		e.preventDefault();
		var frm = $('#frmAgregar');
		var url = frm.attr('action');
		var data = frm.serialize();
		
		$.post(url, data, function(result){
			var msg = result.msg;
			var clr = result.clr;
			mostrarMensaje(msg, clr);
		}).fail(function(result){
			console.dir(result.responseJSON);
			mostrarMensaje('ALGO SALIO MAL', 'alert-danger');
		});

	});
});