$(document).ready(function() {
  listarGeozonas();
});

function buscarGeoZona(codi_geozo) {
  var parametros = { geozoneID: codi_geozo };
  var token = document.getElementsByName("_token");
  var url = "geozonas/buscar";
  return $.ajax({
    url: url,
    headers: { "X-CSRF-TOKEN": token[0].value },
    type: "POST",
    data: parametros,
    dataType: "json",
    beforeSend: function() {},
    error: function() {
      console.log(
        "Lamentablemente Hay un Error de Coneccion AJAX, Intentelo Mas Tarde!!!",
      );
    },
  })
    .done(function(data, textStatus, jqXHR) {})
    .always(function(a, textStatus, b) {
      //TODO
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
      if (jqXHR.status == 404) {
        alert(jqXHR.responseText);
      }
    });
}

$(document).ready(function() {
  $("#listadoGeoZonas").on("click", ".btnEditar", function(e) {
    e.preventDefault();
    var row = $(this).parents("tr");
    var codi_geozo = row.data("codi_geozo");

    var busqueda = buscarGeoZona(codi_geozo);
    busqueda.done(function(data, textStatus, jqXHR) {
      var obj = data.listado[0];
      $("#tituloModalGeozona").html(
        "Editar Zona de Control - (" + obj.description + ")",
      );

      var coordenadas = _coordenadas(obj);
      console.log(obj);
      var radius = obj.radius;
      //crearGeozona(coordenadas, true); //TODO
      crearGeozona(coordenadas, true, radius);
      _centrarGeoZona(coordenadas);
      cambiarZoom(18);
    });
  });
});

$(document).ready(function() {
  $("#listadoGeoZonas").on("click", ".btnVerMapa", function(e) {
    e.preventDefault();
    var row = $(this).parents("tr");
    var codi_geozo = row.data("codi_geozo");

    var busqueda = buscarGeoZona(codi_geozo);
    busqueda.done(function(data, textStatus, jqXHR) {
      var obj = data.listado[0];
      $("#tituloModalGeozona").html("Zona Control - (" + obj.description + ")");

      var coordenadas = _coordenadas(obj);
      var radius = obj.radius;
      crearGeozona(coordenadas, false, radius);
      _centrarGeoZona(coordenadas);
      cambiarZoom(18);
    });
  });
});

function _centrarGeoZona(coordenadas) {
  var bounds = new google.maps.LatLngBounds();
  $.each(coordenadas, function(i, obj) {
    bounds.extend(obj);
  });
  elMapa.fitBounds(bounds);
}

function _coordenadas(obj) {
  return [
    { lat: obj.latitude1, lng: obj.longitude1 },
    /*
		{lat: obj.latitude2, lng: obj.longitude2},
		{lat: obj.latitude3, lng: obj.longitude3},
		{lat: obj.latitude4, lng: obj.longitude4},
		{lat: obj.latitude5, lng: obj.longitude5},
		{lat: obj.latitude6, lng: obj.longitude6},
		{lat: obj.latitude7, lng: obj.longitude7},
		{lat: obj.latitude8, lng: obj.longitude8},
		{lat: obj.latitude9, lng: obj.longitude9},
		{lat: obj.latitude10, lng: obj.longitude10}
		*/
  ];
}
/*-----------------------------------------------------*/
$(document).ready(function() {
  $("#modal_editar").on("shown.bs.modal", function() {
    _resetModals();
  });
  $("#modal_mapa").on("shown.bs.modal", function() {
    _resetModals();
  });
});

function _resetModals() {
  if (lstRutas.length > 0) {
    eliminarRutas(lstRutas);
  }
  var centrado = elMapa.getCenter();
  google.maps.event.trigger(elMapa, "resize");
  elMapa.setCenter(centrado);
}
