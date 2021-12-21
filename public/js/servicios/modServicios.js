var fech_servicio = null;
var codi_circuito = null;
var hora_inicio = null;
var codi_servicio = null;


$(document).ready(function(){
  $('#modal_salidas').on('shown.bs.modal', function(){
    $('#nume_movil').focus();
  });
});
/*###################################################################################################*/
$(document).ready(function(){
  $('#fech_servi').change(function(){
    if($('#copi_numer').val() !== ''){
      listarServicios();
    }
    $('#codi_circu').focus();
  });
});
/*###################################################################################################*/
$(document).ready(function(){
  $('#codi_circu').change(function(){
    $('#copi_numer').val($('#codi_circu').val());
    listarServicios();
    $('#btnAgregar').prop('disabled', false);
  });
});
/*###################################################################################################*/
$(document).ready(function(){
  $('#hora_servi').keypress(function(e){
    if(e.which == 13){
      $('#btnGuardar').focus();
    }
  });
});
/*###################################################################################################*/
function limpiarCampos(){
  limpiarCamposMovil();
  limpiarCamposConductor();
  $('#nume_movil').focus();
}