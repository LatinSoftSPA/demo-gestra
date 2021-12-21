var lstServicios = null;

function limpiarListadoServicios(){
  $('#listadoServicios').html('');
}
/*FILTRAR SERVICIOS*/
$(document).ready(function(){
	$('#movi_busca').keypress(function(e){
		if(e.which == 13){
			var nume_movil = $(this).val();
			if(nume_movil.length > 0){
				filtrarServicios();
			} else {
				listarServicios();
			}
		}
	});
});
/*FIN*/
/*MULTA DEL SERVICIOS*/
$(document).ready(function(){
  $('#listadoServicios').on('click', '.btnMulta', function(e) {
		e.preventDefault();
		var row = $(this).parents('tr');
		var codi_circu = row.data('codi_circu');
		var nume_movil = row.data('nume_movil');
		var pate_movil = row.data('pate_movil');
		var codi_servi = row.data('codi_servi');

		var busqueda = buscarServicio(codi_circu, nume_movil, pate_movil, codi_servi);
		busqueda.done(function(data, textStatus, jqXHR){
			$('#modal_multa').modal();
			objMulta = data;
		});
  });
});
/*FIN*/
/*INFORME DEL SERVICIO*/
$(document).ready(function(){
	$('#listadoServicios').on('click', '.btnDetalle', function(e) {
		e.preventDefault();
		var row = $(this).parents('tr');
		var codi_circu = row.data('codi_circu');
		var nume_movil = row.data('nume_movil');
		var pate_movil = row.data('pate_movil');
		var codi_servi = row.data('codi_servi');

		var busqueda = buscarServicio(codi_circu, nume_movil, pate_movil, codi_servi);
		busqueda.done(function(data, textStatus, jqXHR){    	
			$("#modal_informe").modal();
			objInformeServicio = data;
			var mi_servicio = data.mi_servicio;
			var servicio = mi_servicio['servicio'];
			var controladas = mi_servicio['controladas'];
			
			var fech_servi = new Date(servicio.inic_servi);
			var hora_servi = fech_servi.toTimeString().slice(0,5);          //LINUX
			//var hora_servi = fech_servi.toLocaleTimeString().slice(0,5);    //WINDOWS

			$('#tituloModalInforme').html('Informe del Servicio (MAQ: ' +servicio.nume_movil+ ' - SERVICIO: ' +hora_servi+')');
			var listaHTML = _lstHtmlInforme(controladas);
			$('#listadoControles').html(listaHTML); 
		});
	});
});
/*FIN*/
/*TRAYECTO DEL SERVICIO*/
$(document).ready(function(){
	$('#listadoServicios').on('click', '.btnMapa', function(e) {
	    $('#btnRango').addClass('hidden');

	    e.preventDefault();
	    var row = $(this).parents('tr');
	    var codi_circu = row.data('codi_circu');
	    var nume_movil = row.data('nume_movil');
	    var pate_movil = row.data('pate_movil');
	    var codi_servi = row.data('codi_servi');

		var busqueda = buscarServicio(codi_circu, nume_movil, pate_movil, codi_servi);
	    busqueda.done(function(data, textStatus, jqXHR){
	    	$('#modal_mapa').modal();
			objInformeServicio = data;
			var mi_servicio = data.mi_servicio;
			var servicio = mi_servicio['servicio'];
			
			var fech_servi = new Date(servicio.inic_servi);
			var hora_servi = fech_servi.toTimeString().slice(0,5);          //LINUX
			//var hora_servi = fech_servi.toLocaleTimeString().slice(0,5);    //WINDOWS

			$('#tituloModalGeozona').html('Trazado del Recorrido (MAQ: ' +servicio.nume_movil+ ' - SERVICIO: ' +hora_servi+')');
	    });
	});
});
/*FIN*/
/*REIMPRIMIR EL SERVICIO*/
$(document).ready(function(){
	$('#listadoServicios').on('click', '.btnReImprimir', function(e) {
		e.preventDefault();
		var row = $(this).parents('tr');
	    var codi_circu = row.data('codi_circu');
	    var nume_movil = row.data('nume_movil');
	    var pate_movil = row.data('pate_movil');
	    var codi_servi = row.data('codi_servi');

		imprimirServicio(codi_circu, nume_movil, pate_movil, codi_servi);
	});
});

function imprimirServicio(codi_circu, nume_movil, pate_movil, codi_servi){
	var url = 'servicios/imprimir';
	
	var parametros = {'codi_circu' : codi_circu, 'nume_movil' : nume_movil, 'pate_movil' : pate_movil, 'codi_servi' : codi_servi};
	var token = document.getElementsByName("_token");
	$.ajax({
		url: url,
		headers : {'X-CSRF-TOKEN' : token[0].value},
		type: 'POST',
		data: parametros,
		beforeSend: function(){},
		success: function(){},
		error: function(){
			mostrarMensaje('ALGO SALIO MAL AL IMPRIMIR', 'alert-danger');
		}
	});	
}
/*FIN*/
/*ELIMINAR EL SERVICIO*/
$(document).ready(function(){
  $('#listadoServicios').on('click', '.btnEliminar', function(e) {
    e.preventDefault();
    if( !confirm("¿Esta Seguro de Eliminar este Registro?") ){
      return false;
    }
    var row = $(this).parents('tr');
    var codi_circu = row.data('codi_circu');
    var nume_movil = row.data('nume_movil');
    var pate_movil = row.data('pate_movil');
    var codi_servi = row.data('codi_servi');

    var borrado = eliminandoServicio(codi_circu, nume_movil, pate_movil, codi_servi);
    borrado.done(function(data, textStatus, jqXHR){
    	var msg = data.msg;

		var title = 'Atencion';
		toastr.warning(data.msg, title);

		row.fadeOut();
    });
  });
});
/*FIN*/
/*###################################################################################################*/
function listarServicios(){
	var fech_servi = $('#fech_servi').val();
	var codi_circu = $('#codi_circu').val();
  
	var parametros = {'fech_servi' : fech_servi, 'codi_circu' : codi_circu};
	var token = document.getElementsByName("_token");
    var url = 'servicios/listar';
	$.ajax({
		url: url,
		type: 'POST',
    	headers : {'X-CSRF-TOKEN' : token[0].value},
		data: parametros,
		dataType: 'json',
		beforeSend: function(){
			$('#listadoServicios').html('');
		}
	})
	.done(function(data, textStatus, jqXHR){
		//var title = 'Felicidades';
		//toastr.info(data.msg, title);

		var listaHTML = _lstHtmlServicios(data.listado);
		$('#listadoServicios').html(listaHTML);
	})
	.always(function( a, textStatus, b ){})
	.fail(function( jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 404) {
			var title = 'Nota';
			toastr.error(jqXHR.responseText, title);

			console.log(jqXHR.responseText);
		}
	});
}

function filtrarServicios(){
	var nume_movil = $('#movi_busca').val();
	var fech_servi = $('#fech_servi').val();
	var codi_circu = $('#codi_circu').val();
  
	var parametros = {'fech_servi' : fech_servi, 'codi_circu' : codi_circu, 'nume_movil' : nume_movil};
	var token = document.getElementsByName("_token");
	var url = 'servicios/filtrar';
	$.ajax({
		url: url,
		type: 'POST',
		headers : {'X-CSRF-TOKEN' : token[0].value},
		data: parametros,
		dataType: 'json',
		beforeSend: function(){
			$('#listadoServicios').html('');
		}
	})
	.done(function(data, textStatus, jqXHR ){
		lstServicios = data.listado;

		var title = 'Felicidades';
		toastr.info(data.msg, title);

		var listaHTML = _lstHtmlServicios(data.listado);
		$('#listadoServicios').html(listaHTML);
	})
	.always(function( a, textStatus, b ) {
		$('#btnProcesar').show();
	})
	.fail(function( jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 404) {
			var title = 'Nota';
			toastr.error(jqXHR.responseText, title);
		}
	});
}
/*###################################################################################################*/
function _lstHtmlServicios(listado){
	var elHtml = '';
	var cont = 0;
	$.each(listado, function(i, obj){
		////////var timestamp = obj.inic_servi;
		//var fech_inici = new Date(obj.inic_servi * 1000);
		//var fech_termi = new Date(obj.term_servi * 1000);
		////////var fech_inici = new Date(obj.inic_servi);
		////////var fech_termi = new Date(obj.term_servi);

		////////var date_inici = fech_inici.toISOString().slice(0,10);
		////////var hhmm_inici = fech_inici.toTimeString().slice(0,5);				//<-----FORMATO WINDOWS
		//var hhmm_inici = fech_inici.toLocaleTimeString().slice(0,5);		//<-----FORMATO UNIX

		////////var date_termi = fech_termi.toISOString().slice(0,10);
		////////var hhmm_termi = fech_termi.toTimeString().slice(0,5);				//<-----FORMATO WINDOWS
		//var hhmm_termi = fech_termi.toLocaleTimeString().slice(0,5);		//<-----FORMATO UNIX

		if(obj.multado)
		{
			elHtml += '<tr class="danger" data-codi_servi="' +obj.codi_servi+ '" data-codi_circu="' +obj.codi_circu+'" data-nume_movil="' +obj.nume_movil+'" data-pate_movil="' +obj.pate_movil+'">';
		} else {
			elHtml += '<tr class="success" data-codi_servi="' +obj.codi_servi+'" data-codi_circu="' +obj.codi_circu+'" data-nume_movil="' +obj.nume_movil+'" data-pate_movil="' +obj.pate_movil+'">';
		}
			cont++;
			elHtml += '<td class="info text-center hidden-sm hidden-xs"><b>' +cont+ '</b></td>';
			elHtml += '<td class="info text-center">' +obj.pate_movil+ '</td>';
			elHtml += '<td class="info text-center"><b>' +obj.nume_movil+ '</b></td>';
			elHtml += '<td class="text-center"><b>' + obj.INI + '</b></td>';
			elHtml += '<td class="text-center">' + obj.TER + '</td>';
			//elHtml += '<td class="text-center"><b>' + hhmm_inici + '</b></td>';
			//elHtml += '<td class="text-center">' + hhmm_termi + '</td>';
			elHtml += '<td class="text-nowrap hidden-sm hidden-xs">' +obj.conductor+ '</td>';
			//elHtml += '<td class="text-center">' +obj.porcentaje+ ' %</td>';

			elHtml += '<td class="text-center">';
				if (obj.multado)
				{
					elHtml += '<a href="#!" class="btn btn-xs btn-warning btnMulta"><i class="fa fa-money fa-fw"></i></a>';
				} else {
					elHtml += '<a href="#!" class="btn btn-xs btn-default" disabled><i class="fa fa-money fa-fw"></i></a>';
				}
				if (obj.finalizado)
				{
					elHtml += '<a href="#!" class="btn btn-xs btn-info btnDetalle"><i class="fa fa-file-text fa-fw"></i></a>';
					elHtml += '<a href="#!" class="btn btn-xs btn-success btnMapa"><i class="fa fa-map fa-fw"></i></a>';
				} else {
					elHtml += '<a href="#!" class="btn btn-xs btn-default" disabled><i class="fa fa-file-text fa-fw"></i></a>';
					elHtml += '<a href="#!" class="btn btn-xs btn-default" disabled><i class="fa fa-map fa-fw"></i></a>';
				}
					elHtml += '<a href="#" class="btn btn-xs btn-primary btnReImprimir"><i class="fa fa-print fa-fw"></i></a>';
				if (obj.habilitado)
				{
					elHtml += '<a href="#!" class="btn btn-xs btn-danger btnEliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
				} else {
					elHtml += '<a href="#!" class="btn btn-xs btn-default btnEliminar" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
				}
			elHtml += '</td>';

		elHtml += '</tr>';
	});
	return elHtml;
}
