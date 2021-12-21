var objServicio = null;

$(document).ready(function(){
  $('#btnGuardar').click(function(e){
	 $('#modal_salidas').modal('hide');
    e.preventDefault();
    //TODO: CERRAR FORMULARIO MODAL AGREGAR SERVICIOS
    guardarServicio();
  });
});

function guardarServicio(){
  var fecha = $('#fech_servi').val();
  var hora = $('#hora_servi').val();
  var fech_servi = new Date(fecha +' '+ hora).toLocaleString();
  
  var nume_movil = parseInt($('#nume_movil').val());
  var pate_movil = $('#pate_movil').val();
  var codi_equip = parseInt($('#codi_equip').val());
  var codi_circu = parseInt($('#codi_circu').val());
  var codi_licen = parseInt($('#codi_licen').val());
  var docu_condu = parseInt($('#docu_condu').val());
  var impr_servi = $("#impr_servi").prop("checked");

  var parametros = {
    'fecha' : fecha, 'hora' : hora, 'codi_circu' : codi_circu, 
    'nume_movil' : nume_movil, 'pate_movil' : pate_movil, 'codi_equip' : codi_equip, 
    'codi_licen' : codi_licen, 'docu_condu' : docu_condu, 
    'imprimir' : impr_servi
  };

  var token = document.getElementsByName("_token");
  var url = 'servicios/registrar';
  $.ajax({
    url: url,
    type: 'POST',
      headers : {'X-CSRF-TOKEN' : token[0].value},
    data: parametros,
    dataType: 'json',
    beforeSend: function(){}
  })
  .done(function(data, textStatus, jqXHR){
    limpiarCampos();
    listarServicios();


    var title = 'Felicidades';
    toastr.success(data.msg, title);
  })
  .always(function( a, textStatus, b ){})
  .fail(function( jqXHR, textStatus, errorThrown){
    if (jqXHR.status == 500) {
      var title = 'Nota';
      toastr.error(jqXHR.responseJSON.msg, title);

      $('#hora_servi').focus();
    }
    if (jqXHR.status == 501) {
      var title = 'Nota';
      toastr.warning(jqXHR.responseJSON.msg, title);

      $('#hora_servi').focus();
    }
  });

}
/*###################################################################################################*/
