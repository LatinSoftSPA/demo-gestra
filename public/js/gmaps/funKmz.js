var listaKml = [];
var capaKml;


function definirKml(url){
  var confiKml = _confiKml(url);
  capaKml = new google.maps.KmlLayer(confiKml);
  listaKml.push(capaKml);
  agregarKml();
}

function _confiKml(url){
  return{
    map:elMapa,
    url: url,
    suppressInfoWindows: true
  };
}
function agregarKml(){
  console.dir(listaKml);
  limpiarKml();
  
  var listado = listaKml;
  $.each(listado, function(index, obj){
    obj.setMap(elMapa);
  });
}  

function limpiarKml(){ 
  google.maps.event.trigger(elMapa, 'resize');
  var listado = listaKml;
  $.each(listado, function(index, obj){
    obj.setMap(null);
  });
}

function cerrarBurbujas(){
  //null
}