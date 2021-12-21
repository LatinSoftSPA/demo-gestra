var lstGeozonas = [];
var lstCoordenadas = [];

function crearGeozona(coordenadas, editable, radius = 50) {
  //var laConfiguracion = _confiGeozona(coordenadas, editable);
  //var laGeozona = new google.maps.Polygon(laConfiguracion);

  var laConfiguracion = _confiGeozonaCircular(coordenadas, editable, radius);
  var laGeozona = new google.maps.Circle(laConfiguracion);
  if (lstGeozonas.length > 0) {
    eliminarGeozonas(lstGeozonas);
    lstGeozonas = [];
    lstGeozonas.lenght = 0;
  }
  lstGeozonas.push(laGeozona);
  cargarGeozonas(lstGeozonas);
}

function _confiGeozona(coordenadas, editable) {
  return {
    paths: coordenadas,
    strokeColor: "#FF0000",
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: "#FF0000",
    fillOpacity: 0.35,
    editable: editable,
  };
}

function _confiGeozonaCircular(coordenadas, editable, radio) {
  return {
    strokeColor: "#FF0000",
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: "#FF0000",
    fillOpacity: 0.35,
    center: coordenadas[0],
    editable: editable,
    radius: radio,
  };
}

function cargarGeozonas(listado) {
  $.each(listado, function(i, obj) {
    //listado[i].setMap(elMapa);
    obj.setMap(elMapa);
  });
}

function eliminarGeozonas(listado) {
  $.each(listado, function(i, obj) {
    obj.setMap(null);
  });
}
