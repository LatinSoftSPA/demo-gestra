$(document).ready(function(){
  //$('.btnVerMapa').click(function(e){
  $('#tablaListadoRutas').on('click', '.btnVerMapa', function(e) {

    e.preventDefault();
    var row = $(this).parents('tr');
    var codi_ruta = row.data('codi_ruta');


    var frm = $('#frmVer');
    var url = frm.attr('action').replace(':CODI_RUTA', codi_ruta);
    var data = frm.serialize();

      console.dir(url);
    $.get(url, data, function(obj){
      $('#tituloModalGeozona').html('Zona Control - (' +obj.ruta.nomb_ruta+ ')');
      var url = 'http://'+ obj.ruta.url_kmz;
      definirKml(url);
      console.log('CARGANDO MAPA');
    }).fail(function(){
      console.log('ALGO SALIO MAL');
    });
  });
});

