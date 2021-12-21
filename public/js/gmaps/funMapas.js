var elMapa;
var lstPositions = new google.maps.LatLngBounds();

$(document).ready(function() {
  crearMapa();
});
//######################################################################
function crearMapa() {
  var zoom = 2;

  var centrado = { lat: 11.651566, lng: 6.5486543 };
  var laConfiguracion = _confiMapa(zoom, centrado);
  elMapa = new google.maps.Map(
    document.getElementById("divGMap"),
    laConfiguracion,
  );
  elMapa.mapTypes.set(MY_STYLE, miEstilo);

  //var capaEnMapa = document.getElementById('detalleUltimoRegistro');
  //elMapa.controls[google.maps.ControlPosition.LEFT_TOP].push(capaEnMapa);

  //var capaTrafico = new google.maps.TrafficLayer();
  //capaTrafico.setOptions({autoRefresh:true, map: elMapa});
  //capaTrafico.setMap(elMapa);

  elMapa.addListener("click", function() {
    cerrarBurbujas();
    //enfocarMarker();
  });
}
//######################################################################
function _confiMapa(zoom, centrado) {
  return {
    zoom: zoom,
    center: centrado,
    //mapTypeId: google.maps.MapTypeId.HYBRID,
    mapTypeId: MY_STYLE,
    styles: [{ featureType: "poi", stylers: [{ visibility: "off" }] }],
    mapTypeControl: false,
    mapTypeControlOptions: _confiTypeControl(),
    zoomControlOptions: _confiZoomControl(),
    streetViewControlOptions: _confiViewControl(),
    zoomControl: true,
    scrollwheel: true,
    streetViewControl: false,
    scaleControl: false,
    disableDoubleClickZoom: false,
    disableDefaultUI: false,
    rotateControl: false,
    signInControl: false,
    showTraffic: true,
    fullscreenControl: true,
  };
}

function _confiTypeControl() {
  var losEstilos = [];
  losEstilos.push(google.maps.MapTypeId.ROADMAP);
  //losEstilos.push(google.maps.MapTypeId.TERRAIN);
  losEstilos.push(google.maps.MapTypeId.HYBRID);
  losEstilos.push(MY_STYLE);
  return {
    style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
    position: google.maps.ControlPosition.LEFT_TOP,
    mapTypeIds: losEstilos,
  };
}

function _confiZoomControl() {
  return {
    style: google.maps.ZoomControlStyle.SMALL,
    position: google.maps.ControlPosition.RIGHT_BOTTOM,
  };
}

function _confiViewControl() {
  return {
    position: google.maps.ControlPosition.RIGHT_TOP,
  };
}

//######################################################################
function cambiarZoom(valor) {
  if (elMapa.getZoom() !== valor)
    // if (elMapa.getZoom() !== valor && elMapa.getZoom() > valor)
    elMapa.setZoom(valor);
}

function centrarMapa(elMarker) {
  //elMapa.setCenter(elMarker.getPosition());
  elMapa.panTo(elMarker.getPosition());
}

function agregarPosiciones(pos) {
  lstPositions.extend(pos);
}
