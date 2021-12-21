var moviles = null;
var multas = null;
var cobros = null;
var totales = null;

$(document).ready(function(){
  $('#fech_desde').change(function(){
    $('#nomb_usuar').focus();
    _listarMultasDiarias();
  });
});

$(document).ready(function(){
  $('#nomb_usuar').change(function(){
    $('#docu_perso').val($('#nomb_usuar').val());
    _listarMultasDiarias();
  });
});

$(document).ready(function(){
  $('#btnConsultar').click(function(){
    _listarMultasDiarias();
  });
});

$(document).ready(function(){
  $('#btnImprimirRecaudacionMultas').click(function(){
    _imprimirInformeMultas();
  });
});

function _listarMultasDiarias(){
  var fd = $('#fech_desde').val();
  var fh = $('#fech_desde').val(); //TODO: DEFINIR UN CAMPO PARA LA FECHA FINAL???

  var user_modif = $('#docu_perso').val();
  var fech_desde = new Date(fd).toJSON().slice(0, 10);
  var fech_hasta = new Date(fh).toJSON().slice(0, 10);
  
	var parametros = {'fech_desde' : fech_desde, 'fech_hasta' : fech_hasta, 'user_modif' : user_modif};
  var url = 'estadisticas/multas';
  //var url = 'http://avl.kguard.org:81/laravel/public/api/recaudaciones/multas/diarias/2019-05-14/2019-05-14/11343736';
  $.ajax({
    url: url,
    type: 'GET',
		data: parametros,
    dataType:'json',
		beforeSend: function(){},
		error: function(){
			console.log('Lamentablemente Hay un Error de Coneccion AJAX y el Servidor, Intentelo Mas Tarde!!!');
		}
  })
  .done(function(data, textStatus, jqXHR ){
    $('#btnImprimirRecaudacionMultas').prop('disabled', false);
    _crearGraficoMultas(data);
    totales = data.totales;
  })
  .always(function( a, textStatus, b ) {
    //TODO
  })
  .fail(function( jqXHR, textStatus, errorThrown){
    if (jqXHR.status == 404) {
  		var title = 'Nota';
  		toastr.warning(jqXHR.responseText, title);
      $('#btnImprimirRecaudacionMultas').prop('disabled', true);
      $('#grafico_multas').highcharts().destroy();      
    }
  });
}


function _listarCuotasDiarias(user_modif, desde, hasta){
  var url = 'api/recaudaciones/cuotas/diarias/'+ user_modif;
  $.ajax({
    url: url,
    type: 'GET',
    dataType:'json'
  })
  .done(function(data, textStatus, jqXHR ){
    _crearGraficoMultas(data);
  })
  .always(function( a, textStatus, b ) {
        //TODO
  })
  .fail(function( jqXHR, textStatus, errorThrown){
    if (jqXHR.status == 404) {
		var title = 'Nota';
		toastr.warning(jqXHR.responseText, title);
    }
  });
}

function _imprimirInformeMultas(){
  var fd = $('#fech_desde').val();
  var fh = $('#fech_desde').val(); //TODO: DEFINIR UN CAMPO PARA LA FECHA FINAL???

  var user_modif = $('#docu_perso').val();
  var fech_desde = new Date(fd).toJSON().slice(0, 10);
  var fech_hasta = new Date(fh).toJSON().slice(0, 10);
  
	var parametros = {'fech_desde' : fech_desde, 'fech_hasta' : fech_hasta, 'user_modif' : user_modif};
  var url = 'informes/multas/imprimir';
  
  $.ajax({
    url: url,
    type: 'GET',
		data: parametros,
    dataType:'json',
		beforeSend: function(){},
		error: function(){
			console.log('Lamentablemente Hay un Error de Coneccion AJAX y el Servidor, Intentelo Mas Tarde!!!');
		}
  })
  .done(function(data, textStatus, jqXHR ){
    console.dir(data);
  })
  .always(function( a, textStatus, b ) {
        //TODO
  })
  .fail(function( jqXHR, textStatus, errorThrown){
    if (jqXHR.status == 404) {
      var title = 'Nota';
      toastr.warning(jqXHR.responseText, title);    
    }
  });
}