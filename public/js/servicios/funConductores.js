var diasVencimientoLicConducir = 5;

/*###################################################################################################*/
$(document).ready(function(){
  $('#codi_licen').keypress(function(e){
    if(e.which == 13){
      var codi_licen = $('#codi_licen').val();
      _busquedaConductor(codi_licen);
   }
  });
});

function _busquedaConductor(codi_licen)
{
  var busqueda = buscarConductor(codi_licen);
  busqueda.done(function(data, textStatus, jqXHR){
    var conductor = data.conductor;

    var fech_vencimiento = new Date(conductor.fech_venci);
    fech_vencimiento = fech_vencimiento.toISOString().slice(0,10);
    verificarLicencia(conductor, data.dias, fech_vencimiento);
  });

}
/*###################################################################################################*/

function buscarConductor(codi_licen){
  var parametros = {'codi_licen' : codi_licen};

  var token = document.getElementsByName("_token");
  var url = 'servicios/buscar/conductor';
  return $.ajax({
    url: url,
    type: 'POST',
    headers : {'X-CSRF-TOKEN' : token[0].value},
    data: parametros,
    dataType: 'json'
  })
  .done(function(data, textStatus, jqXHR){

  })
  .always(function( a, textStatus, b ) {
  //TODO
  })
  .fail(function( jqXHR, textStatus, errorThrown){
    if (jqXHR.status == 404) {
      var title = 'Atencion';
      toastr.warning(jqXHR.responseText, title);
      
      $('#btnGuardar').prop('disabled', true);
      $('#codi_licen').focus();
      $('#codi_licen').select();
    }
  });
}

function verificarLicencia(conductor, dias, fech_venci)
{
  if(dias <= 0){
    alert('NOTA: \nCONDUCTOR CON LIC. CONDUCIR VENCIDA \n\n(FECHA: ' +fech_venci+ ')');
    $('#btnGuardar').prop('disabled', true);
    $('#codi_licen').focus();
    $('#codi_licen').select();
  } else {
    if(dias <= diasVencimientoLicConducir){
      alert('NOTA: \nLA LIC. CONDUCIR VENCERA EL "' +fech_venci+ '" \n\n(' +dias+ ' dias restantes)');
    }
    $('#docu_condu').val(conductor.docu_perso);
    $('#prim_nombr').val(conductor.prim_nombr);
    $('#segu_nombr').val(conductor.segu_nombr);
    $('#apel_pater').val(conductor.apel_pater);
    $('#apel_mater').val(conductor.apel_mater);
    $('#fech_venci').val(conductor.fech_venci);

    $('#hora_servi').focus();
    $('#btnGuardar').prop('disabled', false);
  }
}

function limpiarCamposConductor(){
  $('#codi_licen').val('');
  $('#docu_perso').val('');
  $('#prim_nombr').val('');
  $('#segu_nombr').val('');
  $('#apel_pater').val('');
  $('#apel_mater').val('');
  $('#fech_venci').val('');
}