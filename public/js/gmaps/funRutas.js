var lstRuta = [];
//=====================================================================================================
$(document).ready(function(){
  listarRuta('IDA', '#0000FF');
  listarRuta('REG', '#FF0000');
});
//=====================================================================================================
function listarRuta(trayecto, clr){
  var url = baseUrl + 'json/recorridos/cargarRecorrido/';
  parametros = {"var001" : trayecto};

  $.ajax({
    url: url,
    type: 'POST',
    data: parametros,
    dataType: 'json',
    beforeSend: function(){
    },
    success: function(objetoRespuesta){
      var lstCoordenadas = [];
      var datos = objetoRespuesta['DeviceList'][0]['EventData'];
      $.each(datos, function(index, obj){
        var pos = new google.maps.LatLng(obj.GPSPoint_lat, obj.GPSPoint_lon);
        lstCoordenadas.push(pos);
      });
      dibujarRuta(lstCoordenadas, clr);
    },
    error: function(){
      console.log('Lamentablemente Hay un Error de Coneccion, Intentelo Mas Tarde!!!');
    }
  });
}
function dibujarRuta(listado, clr){
  var confiRuta = configurarRuta(listado, clr);
  var laRuta = new google.maps.Polyline(confiRuta);
  laRuta.setMap(elMapa);
}
function configurarRuta(listado, clr){
  return {
    path: listado,
    geodesic: true,
    strokeColor: clr,
    strokeOpacity: 8.0,
    strokeWeight: 3
  };
}