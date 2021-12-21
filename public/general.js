$(document).ready(function(){
	$('#alert').hide();
});

function mostrarMensaje(msg, clr){
	$('#alert').show();
	$('#alert').addClass(clr);
	$('#alert').html(msg);
	$("#alert").fadeTo(2000, 500).slideUp(500, function(){
		$("#alert").slideUp(500);
	});
}