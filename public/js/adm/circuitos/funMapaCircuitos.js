$(document).ready(function(){
  //$('#btnVerMapa').click(function(e){
  $('#tablaListadoGeozonas').on('click', '.btnVerMapa', function(e) {
    e.preventDefault();
    var row = $(this).parents('tr');
    var codi_geozo = row.data('codi_geozo');

    var frm = $('#frmVer');
    var url = frm.attr('action').replace(':CODI_GEOZO', codi_geozo);
    var data = frm.serialize();

    $.get(url, data, function(obj){
      var coordenadas = [
          {lat: obj.latitude1, lng: obj.longitude1},
          {lat: obj.latitude2, lng: obj.longitude2},
          {lat: obj.latitude3, lng: obj.longitude3},
          {lat: obj.latitude4, lng: obj.longitude4},
          {lat: obj.latitude5, lng: obj.longitude5},
          {lat: obj.latitude6, lng: obj.longitude6},
          {lat: obj.latitude7, lng: obj.longitude7},
          {lat: obj.latitude8, lng: obj.longitude8},
          {lat: obj.latitude9, lng: obj.longitude9},
          {lat: obj.latitude10, lng: obj.longitude10}
      ];
      enfocarGeoZona(coordenadas);      

      $('#tituloModalGeozona').html('Zona Control - (' +obj.description+ ')');
      
      crearGeozona(coordenadas);
    }).fail(function(){
      console.log('ALGO SALIO MAL');
    });
  });
});

function enfocarGeoZona(coordenadas){
  var bounds = new google.maps.LatLngBounds();
  $.each(coordenadas, function(i, obj){
    bounds.extend(obj);
  });
  elMapa.fitBounds(bounds);
}