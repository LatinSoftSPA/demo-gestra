$(document).ready(function(){
	function listarServicios(){
	    var url = 'listar/96711420/18/actual';
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			beforeSend: function(){
			}
		})
		.done(function(data, textStatus, jqXHR){
			$('#listadoServicios').html('');
			var listaHTML = _lstHtmlServicios(data);
			$('#listadoServicios').html(listaHTML);
		})
		.always(function( a, textStatus, b ){})
		.fail(function( jqXHR, textStatus, errorThrown){
			if (jqXHR.status == 404) {
				console.log(jqXHR.responseText);
			}
		});
	}

	listarServicios();
	const segundos = 60;
    setInterval(function(){ listarServicios(); }, (1000 * segundos));
});

/*###################################################################################################*/
function _lstHtmlServicios(listado){
	var elHtml = '';
	var cont = 0;
	$.each(listado, function(i, obj){
		elHtml += '<tr class="success" data-codi_servi="' +obj.codi_servi+'" data-codi_circu="' +obj.codi_circu+'" data-nume_movil="' +obj.nume_movil+'" data-pate_movil="' +obj.pate_movil+'">';
			elHtml += '<td class="info text-center"><b>' +obj.nume_movil+ '</b></td>';
			elHtml += '<td class="info text-center">' +obj.pate_movil+ '</td>';
			elHtml += '<td class="text-center"><b>' + obj.INI + '</b></td>';
			elHtml += '<td class="text-center">' + obj.TER + '</td>';
			elHtml += '<td class="text-nowrap hidden-sm hidden-xs">' +obj.conductor+ '</td>';
		elHtml += '</tr>';
	});
	return elHtml;
}
