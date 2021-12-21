$(document).ready(function(){
	listarPropietarios();
});

$(document).ready(function(){
	$('#apel_pater').keypress(function(e){
		if(e.which == 13){
			var apel_pater = $(this).val();
			if(apel_pater.length > 0){
				filtrarPropietarios(apel_pater);
			} else {
				listarPropietarios();
			}
		}
	});
});

function listarPropietarios(){
  var url = 'listar/propietarios';
  
    
  $.ajax({
    url: url,
    type: 'GET',
    dataType: 'json',
    beforeSend: function(){
      $('#tablaListadoPersonas').html('');
    },
    success: function(listado){	  
      //mostrarMensaje(obj.msg, 'alert-success');
	  var listaHTML = _lstHtmlPropietarios(listado);
      $('#tablaListadoPersonas').html(listaHTML);
    },
    error: function(){
      console.log('Lamentablemente Hay un Error de Coneccion, Intentelo Mas Tarde!!!');
    }
  });
}

function filtrarPropietarios(apel_pater){
	var url = 'filtrar/propietario';
	var parametros = {"apel_pater" : apel_pater};
  
    
  $.ajax({
    url: url,
    type: 'GET',
    dataType: 'json',
	data: parametros,
    beforeSend: function(){
      $('#tablaListadoPersonas').html('');
    },
    success: function(response){
		listado = response.listado;
	  
      //mostrarMensaje(obj.msg, 'alert-success');
	  var listaHTML = _lstHtmlPropietarios(listado);
      $('#tablaListadoPersonas').html(listaHTML);
    },
    error: function(){
      console.log('Lamentablemente Hay un Error de Coneccion, Intentelo Mas Tarde!!!');
    }
  });
}

function _lstHtmlPropietarios(listado){
	var elHtml = '';
	var cont = 0;
	  $.each(listado, function(i, obj){

		if (obj.habilitado == 1)
		{
		  elHtml += '<tr class="success" data-idde_objeto="' +obj.docu_perso+'">';
		} else {
		  elHtml += '<tr class="danger" data-idde_objeto="' +obj.docu_perso+ '">';
		}
		elHtml += '<td class="text-right"><b>' +obj.docu_perso+ '</b></td>';
		elHtml += '<td class="text-center">';
			elHtml += '<a href="propietarios/' +obj.docu_perso+'/edit" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></<a>';
			elHtml += '<a href="#!" class="btn btn-xs btn-danger btnEliminar"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>';
		elHtml += '</td>';
		elHtml += '<td class="text-nowrap">' +obj.prim_nombr+ ' ' +obj.segu_nombr+ '</td>';
		elHtml += '<td class="text-nowrap">' +obj.apel_pater+ ' ' +obj.apel_mater+ '</td>';
		elHtml += '<td class="text-nowrap">' +obj.nomb_domic+ ' #' +obj.nume_domic+ '</td>';
		elHtml += '<td class="text-center">' +obj.tele_conta+ '</td>';
		elHtml += '<td class="text-center">' +obj.movi_conta+ '</td>';
		elHtml += '<td class="text-right">' +obj.mail_conta+ '</td>';

		elHtml += '</tr>';
	  });
  return elHtml;
}