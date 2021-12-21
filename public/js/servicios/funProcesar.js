var lstIniciados = [];
var lstServiciosProcesar = [];

$(document).ready(function(){
	setInterval(function(){
		analizarServicios()
	}, 236000);
});

$(document).ready(function(){
	$('#btnAnalizar').click(function(e){
    	e.preventDefault();
		var listado = analizarServicios();
		listado.done(function(data, textStatus, jqXHR){
			if(data.total > 0){
				$('#btnProcesar').prop('disabled', false);
				$('#total_tareas').html(data.total);
				var listaHTML = _lstHtmlServiciosProcesar(data.servicios);
				$('#tareasProcesar').html(listaHTML);
			}
		});
	});
});

$(document).ready(function(){
	$('#btnProcesar').click(function(e){
    	e.preventDefault();
    	$('#tareasProcesar a').each(function(i, element){
    		var codi_servi = $(this).data('codi_servi')
		    var codi_circu = $(this).data('codi_circu');
		    var nume_movil = $(this).data('nume_movil');
		    var pate_movil = $(this).data('pate_movil');
		    var codi_equip = $(this).data('codi_equip');
		    
	    	setTimeout(function(){
	    		var procesado = procesarServicio(codi_circu, nume_movil, pate_movil, codi_equip, codi_servi);
	    		procesado.done(function(data, textStatus, jqXHR){
	    			$(this).fadeOut();
					$('#btnProcesar').prop('disabled', true);
	    		});
	    	}, 7000 * i);
    	});
	});
});

function procesarServicio(codi_circu, nume_movil, pate_movil, codi_equip, codi_servi)
{
	var url = 'servicios/procesar';

	var parametros = {'codi_circu' : codi_circu, 'nume_movil' : nume_movil, 'pate_movil' : pate_movil, 'codi_equip' : codi_equip, 'codi_servi' : codi_servi};
	var token = document.getElementsByName('_token');
	return $.ajax({
      url: url,
      headers : {'X-CSRF-TOKEN' : token[0].value},
      type: 'POST',
      data: parametros,
      dataType: 'json',
      beforeSend: function(){		  
		$('#tareasProcesar').html('');
		$('#total_tareas').html('');
	  }
    })
	.done(function(data, textStatus, jqXHR){
		listarServicios();
	})
	.always(function(a, textStatus, b) {
		//TODO
	})
	.fail(function(jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 404) {			
			console.log(jqXHR.responseText);
		}
	});
}

function analizarServicios()
{
	var fech_servi = $('#fech_servi').val();
	var codi_circu = parseInt($('#codi_circu').val());

	var url = 'servicios/analizar';
	var token = document.getElementsByName('_token');

	var parametros = {'fech_servi' : fech_servi, 'codi_circu' : codi_circu};
	return $.ajax({
		url: url,
		headers : {'X-CSRF-TOKEN' : token[0].value},
		type: 'POST',
		data: parametros,
		dataType: 'json',
		beforeSend: function(){
			$('#tareasProcesar').html('');
			$('#total_tareas').html('');
		}
	})
	.done(function(data, textStatus, jqXHR){
		var title = 'Nota';
		toastr.success(data.msg, title);
		
		if(data.total > 0){
			$('#btnProcesar').prop('disabled', false);
			$('#total_tareas').html(data.total);
			var listaHTML = _lstHtmlServiciosProcesar(data.servicios);
			$('#tareasProcesar').html(listaHTML);
		}
	})
	.always(function(a, textStatus, b) {
		//TODO
	})
	.fail(function(jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 404) {
			var title = 'Felicidades';
			toastr.info(jqXHR.responseText, title);
		}
	});
}


/*
function finalizarServicio(nume_movil)
{
	var url = 'servicios/finalizar2';
	var token = document.getElementsByName('_token');

	var parametros = {'fech_servi' : fech_servicio, 'codi_circu' : codi_circuito, 'nume_movil' : nume_movil};
	return $.ajax({
		url: url,
		headers : {'X-CSRF-TOKEN' : token[0].value},
		type: 'POST',
		data: parametros,
		dataType: 'json',
		beforeSend: function(){}
	})
	.done(function(data, textStatus, jqXHR){
		var title = 'Nota';
		toastr.success(data.msg, title);
	})
	.always(function(a, textStatus, b) {
		//TODO
	})
	.fail(function(jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 404) {
			var title = 'Felicidades';
			toastr.info(jqXHR.responseText, title);
		}
	});
}

function finalizarServicios(){
	var url = 'servicios/finalizar';
	var token = document.getElementsByName('_token');

	var parametros = {'fech_servi' : fech_servicio, 'codi_circu' : codi_circuito};
	return $.ajax({
		url: url,
		headers : {'X-CSRF-TOKEN' : token[0].value},
		type: 'POST',
		data: parametros,
		dataType: 'json',
		beforeSend: function(){}
	})
	.done(function(data, textStatus, jqXHR){
		//console.log(data.msg);
		var title = 'Nota';
		toastr.info(data.msg, title);
	})
	.always(function(a, textStatus, b) {
		//TODO
	})
	.fail(function(jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 404) {
			var title = 'Felicidades';
			toastr.success(jqXHR.responseText, title);
		}
	});
}

function procesarServicio(nume_movil){
	var url = 'procesar/servicio';
	var token = document.getElementsByName('_token');

	var parametros = {'fech_servi' : fech_servicio, 'codi_circu' : codi_circuito, 'nume_movil' : nume_movil};
	return $.ajax({
		url: url,
		headers : {'X-CSRF-TOKEN' : token[0].value},
		type: 'POST',
		data: parametros,
		dataType: 'json',
		beforeSend: function(){
			$('#listadoProcesar').html('');
			$('#total_finalizados').html('');
		}
	})
	.done(function(data, textStatus, jqXHR){
		console.log(data.msg);
		var listaHTML = _lstHtmlServiciosProcesar(data.listado);
		$('#listadoProcesar').html(listaHTML);
		$('#total_finalizados').html(data.total);
	})
	.always(function(a, textStatus, b) {
		//TODO
	})
	.fail(function(jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 404) {
			console.log(jqXHR.responseText, title);
		}
	});
}

function procesarServicios(){
	var url = 'servicios/procesar';
	var token = document.getElementsByName('_token');

	var nume_movil = $('#movi_busca').val();
	var parametros = {'fech_servi' : fech_servicio, 'codi_circu' : codi_circuito, 'nume_movil' : nume_movil};

	return $.ajax({
		url: url,
		headers : {'X-CSRF-TOKEN' : token[0].value},
		type: 'POST',
		data: parametros,
		dataType: 'json',
		beforeSend: function(){
			$('#listadoProcesar').html('');
			$('#total_finalizados').html('');
		}
	})
	.done(function(data, textStatus, jqXHR){
		console.log(data.msg);
		var listaHTML = _lstHtmlServiciosProcesar(data.listado);
		$('#listadoProcesar').html(listaHTML);
		$('#total_finalizados').html(data.total);
	})
	.always(function(a, textStatus, b) {
		//TODO
	})
	.fail(function(jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 404) {
			console.log(jqXHR.responseText, title);
		}
	});
}

function listarExpediciones2(servicio){
	var url = 'listar/expediciones';
	var token = document.getElementsByName('_token');


	var parametros = {'servicio' : servicio};
	return $.ajax({
      url: url,
      headers : {'X-CSRF-TOKEN' : token[0].value},
      type: 'POST',
      data: parametros,
      dataType: 'json',
      beforeSend: function(){}
    })
	.done(function(data, textStatus, jqXHR){
		console.log(data.msg);
	})
	.always(function(a, textStatus, b) {
		//TODO
	})
	.fail(function(jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 404) {			
			console.log(jqXHR.responseText);
		}
	});
}

function listarArribos(expedicion){
	var url = 'listar/arribos';
	var token = document.getElementsByName('_token');
	
	var parametros = {'expedicion' : expedicion};
	
	return $.ajax({
		url: url,
		headers : {'X-CSRF-TOKEN' : token[0].value},
		type: 'POST',
		data: parametros,
		dataType: 'json',
		beforeSend: function(){}
	})
	.done(function(data, textStatus, jqXHR){
		$('#totalServicios').html(data.sentido);
		$('#procesandoServicio').html(data.codi_servi);
		$('#totalMarcadas').html(data.total);
	})
	.always(function(a, textStatus, b) {
		//TODO
	})
	.fail(function(jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 404) {
			var title = 'Lamentablemente';
			toastr.error(jqXHR.responseText, title);
		}
	});
}

function actualizarProgramadas(data){
	var url = 'actualizar/programadas';
  	var token = document.getElementsByName('_token');  

	var parametros = {
		'marcadas' 		: data.listado, 
		'codi_servi' 	: data.codi_servi, 
		'codi_circu' 	: data.codi_circu, 
		'codi_senti' 	: data.codi_senti, 
		'nume_movil' 	: data.nume_movil, 
		'pate_movil' 	: data.pate_movil
	};
	return $.ajax({
		url: url,
		headers : {'X-CSRF-TOKEN' : token[0].value},
		type: 'PUT',
		data: parametros,
		dataType: 'json',
		beforeSend: function(){
			$('#modal_procesar').modal('show');			
		}
	})
	.done(function(data, textStatus, jqXHR){
		console.log(data.msg);
	})
	.always(function(a, textStatus, b) {
		//TODO
	})
	.fail(function(jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 404) {
			console.log(jqXHR.responseText);
		}
	});
}
*/
/*###################################################################################################*/
function animarBarraProgreso(porcentaje, movil){
	$('#barraProsesandoServicios').css({'width': porcentaje +'%'});

	$('#elPorcentaje1').html(parseInt(porcentaje) +'% Completado');
	$('#nume_movilXXX').html(movil);
	$('#barraProsesandoServicios').html(porcentaje +'%');
}

function _lstHtmlServiciosProcesar(listado){
	var elHtml = '';
	$.each(listado, function(i, obj){
		elHtml += '<a href="#" ';
				elHtml += 'data-codi_circu="' +obj.codi_circu+ '" ';
				elHtml += 'data-codi_servi="' +obj.codi_servi+ '" ';
				elHtml += 'data-nume_movil="' +obj.nume_movil+ '" ';
				elHtml += 'data-pate_movil="' +obj.pate_movil+ '" ';
				elHtml += 'data-codi_equip="' +obj.codi_equip+ '">';
			elHtml += '<b>Maq ' +obj.nume_movil+ '</b>';
			elHtml += '<small class="pull-right">' +obj.nume_movil+ '%</small>';
			elHtml += '<div class="progress lg">';
				//elHtml += '<div class="progress-bar progress-bar-aqua" style="width: ' +obj.nume_movil+ '%" aria-valuenow="' +obj.nume_movil+ '" role="progressbar">';
				elHtml += '<div class="progress-bar progress-bar-aqua" style="width: 0%" aria-valuenow="0" role="progressbar">';
				elHtml += '</div>';
			elHtml += '</div>';
		elHtml += '</a>';
	});
	return elHtml;
}