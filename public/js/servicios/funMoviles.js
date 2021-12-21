var diasVencimientoRevTecnica = 5;

/*###################################################################################################*/
$(document).ready(function(){
  $('#nume_movil').keypress(function(e){
    if(e.which == 13){
      var nume_movil = $('#nume_movil').val();
      _busquedaMovil(nume_movil);

    }
  });
});
/*###################################################################################################*/
function _busquedaMovil(nume_movil){
  var busqueda = buscarMovil(nume_movil);
  busqueda.done(function(data, textStatus, jqXHR ){
    var movil = data.movil;
    var fech_vencimiento = new Date(movil.fech_revis);
    fech_vencimiento = fech_vencimiento.toISOString().slice(0,10);
    verificarRTecnica(movil, data.dias, fech_vencimiento);
  })
  .fail(function( jqXHR, textStatus, errorThrown){
    if (jqXHR.status == 404) {
      var title = 'Nota';
      toastr.error(jqXHR.responseText, title);
      limpiarCamposMovil();
      $('#btnGuardar').prop('disabled', true);
      $('#nume_movil').focus();
    }
  });
}

function buscarMovil(nume_movil){
  var parametros = {'nume_movil' : nume_movil};

  var url = 'servicios/buscar/movil';
  var token = document.getElementsByName('_token');
  return $.ajax({
    url : url,
    headers : {'X-CSRF-TOKEN' : token[0].value},
    type : 'POST',
    data: parametros,
    dataType : 'json',
  })
  .done(function(data, textStatus, jqXHR ){
  })
  .always(function( a, textStatus, b ) {
  //TODO
  })
  .fail(function( jqXHR, textStatus, errorThrown){
  });
}

function verificarRTecnica(movil, dias, fech_vencimiento)
{
  if(dias <= 0){
    alert('NOTA: \nMOVIL CON REV. TECNICA VENCIDA \n\n(FECHA: ' +fech_vencimiento+ ')');
    $('#btnGuardar').prop('disabled', true);
    $('#nume_movil').focus();
    $('#nume_movil').select();
  } else {
    if(dias <= diasVencimientoRevTecnica){
      alert('NOTA: \nLA REV. TECNICA VENCERA EL "' +fech_vencimiento+ '" \n\n(' +dias+ ' dias restantes)');
    }
    $('#nume_movil').val(movil.nume_movil);
    $('#codi_equip').val(movil.codi_equip);
    $('#fech_revis').val(movil.fech_revis);
    $('#pate_movil').val(movil.pate_movil);
    $('#codi_licen').val(movil.codi_licen);

    $('#codi_licen').focus();
    $('#codi_licen').select();
    $('#btnGuardar').prop('disabled', false);
  }
}

function limpiarCamposMovil(){
  $('#nume_movil').val('');
  $('#codi_equip').val('');
  $('#fech_revis').val('');
  $('#pate_movil').val('');
}