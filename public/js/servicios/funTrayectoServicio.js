var objInformeServicio = null;
var lstEventos = [];
var lstRutas = [];
var lstMoviles = [];

var lstMarkers = [];
var lstBurbujas = [];

var viajeDetenido;

$(document).ready(function() {
  $(".btnIda").click(function() {
    var sent_exped = 0;
    var clr = "#FF0000";
    _crearRuta(sent_exped, clr);
  });
});

$(document).ready(function() {
  $(".btnRegreso").click(function() {
    var sent_exped = 1;
    var clr = "#0000FF";
    _crearRuta(sent_exped, clr);
  });
});

function _crearRuta(codi_senti, clr) {
  limpiarListados();

  var mi_servicio = objeto_servicio.mi_servicio;
  var servicio = mi_servicio.servicio;
  var expediciones = mi_servicio.expediciones;
  var codi_equip = servicio.codi_equip;

  $.each(expediciones, function(i, obj) {
    if (obj.codi_senti == codi_senti) {
      var desde = new Date(obj.inic_exped).getTime() / 1000;
      var hasta = new Date(obj.term_exped).getTime() / 1000;
      //var adicional = 20 * 60;
      //var url = definirUrl(codi_equip, desde, hasta + adicional);
      var url = definirUrl(codi_equip, desde, hasta);

      _listarEventos(url, clr, codi_equip);
      if (lstRutas.length > 0) {
        _agregarRutas();
      }
    }
  });
}

function _definirRutaTrayecto(listado, clr, codi_equip) {
  var confiRuta = _configurarRutaTrayecto(listado, clr);
  var laRuta = new google.maps.Polyline(confiRuta);

  //lstRutas[codi_equip] = laRuta;
  lstRutas.push(laRuta);
}

function _configurarRutaTrayecto(listado, clr) {
  return {
    map: elMapa,
    path: listado,
    clickable: false,
    draggable: false,
    editable: false,
    geodesic: true,
    strokeColor: clr,
    strokeOpacity: 7.9,
    strokeWeight: 5.8,
    //fillColor: '#000000',
    fillOpacity: 0.35,
    visible: true,
  };
}

function definirUrl(d, i, f) {
  return `http://latinsoft.cl/api/trackers/tpublico/curico/lineaDemo/trayectoTracker?idde_devic=${d}&inicio=${i}&fin=${f}`;
  // return `http://localhost/api/trackers/tpublico/antofagasta/linea104/trayectoTracker?idde_devic=${d}&inicio=${i}&fin=${f}`;
}

function _listarEventos(url, clr, codi_equip) {
  $.ajax({
    url: url,
    type: "GET",
    dataType: "json",
  })
    .done(function(data, textStatus, jqXHR) {
      if (eventosJSON_OK(data.Error)) {
        $("#btnRango").removeClass("hidden");
        lstEventos = data["Moviles"][0]["Eventos"];

        if (lstEventos.length > 0) {
          var lstCoordenadas = [];
          var bounds = new google.maps.LatLngBounds();
          $.each(lstEventos, function(i, evento) {
            var pos = new google.maps.LatLng(evento.Latitud, evento.Longitud);
            lstCoordenadas.push(pos);
            bounds.extend(pos);
          });

          $("#btnRango").attr("min", 0);
          $("#btnRango").attr("max", lstCoordenadas.length - 1);
          _definirRutaTrayecto(lstCoordenadas, clr, codi_equip);
          elMapa.fitBounds(bounds);
        }
      }
    })
    .always(function(a, textStatus, b) {
      //TODO
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
      if (jqXHR.status == 404) {
        alert(jqXHR.responseText);
      }
    });
}

function eventosJSON_OK(mensaje) {
  var elEstado = false;
  switch (mensaje) {
    case "Invalid authorization":
      console.log("USUARIO INVALIDO...!!!");
      break;
    case "No devices specified (invalid group?)":
      console.log("GRUPO INVALIDO o NO HAY MOVILES...!!!");
      break;
    case "Internal error (account)":
      console.log("PROBLEMAS EN EL SERVIDOR...!!!");
      break;
    default:
      elEstado = true;
      break;
  }
  return elEstado;
}

function _agregarRutas() {
  var listado = lstRutas;
  $.each(listado, function(i, obj) {
    obj.setMap(elMapa);
  });
}

function _agregarMarkers() {
  var listado = lstMarkers;
  $.each(listado, function(i, obj) {
    //ultimaPosicion = obj.getPosition();
    obj.setMap(elMapa);
  });
}

function _limpiarMarkers() {
  var listado = lstMarkers;
  $.each(listado, function(i, obj) {
    obj.setMap(null);
  });
  lstMarkers = [];
}

function _agregarBurbujas() {
  var listado = lstBurbujas;
  $.each(listado, function(i, obj) {
    //ultimaPosicion = obj.getPosition();
    obj.close();
    obj.setMap(elMapa);
  });
}

function _limpiarBurbujas() {
  var listado = lstBurbujas;
  $.each(listado, function(i, obj) {
    obj.setMap(null);
  });
  lstBurbujas = [];
}

function _cerrarBurbujas() {
  var listado = lstBurbujas;
  $.each(listado, function(i, obj) {
    obj.close();
  });
}

function _limpiarRutas() {
  var listado = lstRutas;
  $.each(listado, function(i, obj) {
    obj.setMap(null);
  });
  lstRutas = [];
}

function limpiarListados() {
  lstEventos.length = 0;
  lstEventos = [];
  _limpiarRutas();
  _limpiarMarkers();
  _limpiarBurbujas();
}

/*RECORRER LA RUTA CON UN MARKER*/
$(document).ready(function() {
  $(".btnPlay").on("click", function() {
    if (lstEventos.length > 0) {
      iniciarRecorrido(lstEventos);
      viajeDetenido = false;
    }
  });
});

$(document).ready(function() {
  $("#btnRango").on("change", function() {
    _limpiarMarkers();
    _cerrarBurbujas();
    _limpiarBurbujas();
    var elMarker = null;
    var laBurbuja = null;
    var valor = $("#btnRango").val();
    var pos = new google.maps.LatLng(
      lstEventos[valor].Latitud,
      lstEventos[valor].Longitud,
    );
    var hor = lstEventos[valor].Hora;
    var spd = parseInt(lstEventos[valor].Velocidad);
    var clr = _getColorMarker(spd);
    var cod = lstEventos[valor].STAT_CODE;
    var geo = null;

    var grd = null;
    if (lstEventos[valor].Heading !== undefined) {
      grd = parseInt(lstEventos[valor].Heading);
      _getGradoMarker(grd);
    }
    if (lstEventos[valor].NombreGZ) {
      geo = lstEventos[valor].NombreGZ;
    }

    var laConfig = configurarMarker(pos, grd, spd, clr, "movil");
    elMarker = new google.maps.Marker(laConfig);
    laBurbuja = new google.maps.InfoWindow();

    lstMarkers.push(elMarker);
    lstBurbujas.push(laBurbuja);
    cambiarZoom(16);
    centrarMapa(elMarker);

    var configuracionMarker = _configurarIcono(grd, spd, clr);
    actualizarMarker(elMarker, laBurbuja, pos, configuracionMarker);
    var infoBurbuja = _contenidoBurbuja(lstEventos[valor]);
    actualizarBurbuja(elMarker, laBurbuja, infoBurbuja);

    $("#tiempo").html("HORA: " + hor);
  });
});

function iniciarRecorrido(listado) {
  _limpiarMarkers();
  _cerrarBurbujas();
  _limpiarBurbujas();
  var elMarker = null;
  var laBurbuja = null;
  $.each(listado, function(i, obj) {
    var pos = new google.maps.LatLng(obj.Latitud, obj.Longitud);
    var grd = _getGradoMarker(parseInt(obj.Heading));
    var spd = parseInt(obj.Velocidad);
    var clr = _getColorMarker(spd);

    var ultimaPosicion = null;
    if (i == 0) {
      var laConfig = configurarMarker(pos, grd, spd, clr, "movil");
      elMarker = new google.maps.Marker(laConfig);
      laBurbuja = new google.maps.InfoWindow();

      //elMarker.setMap(elMapa);
      lstMarkers.push(elMarker);
      lstBurbujas.push(laBurbuja);

      _agregarMarkers();
      _agregarBurbujas();
      cambiarZoom(16);
    }

    ultimaPosicion = elMarker.getPosition();
    window.setTimeout(function() {
      //if(viajeDetenido == false){
      if (!pos.equals(ultimaPosicion)) {
        actualizarMarker(elMarker, laBurbuja, pos, grd, spd, clr);
      }
      //}
    }, 987 * i);
  });
}

function actualizarMarker(marker, laBurbuja, pos, configuracion) {
  marker.setIcon(configuracion);
  marker.setPosition(pos);
  elMapa.panTo(pos);
}

function actualizarBurbuja(marker, laBurbuja, infoBurbuja) {
  laBurbuja.close(elMapa, marker);
  laBurbuja.setContent(infoBurbuja);
  laBurbuja.open(elMapa, marker);
}

function _contenidoBurbuja(evento) {
  var grd = parseInt(evento.Heading);
  var spd = parseInt(evento.Velocidad);
  var cod = parseInt(evento.STAT_CODE);
  var geo = evento.NombreGZ;
  var fec = evento.Fecha;
  var hor = evento.Hora;
  var odo = parseInt(evento.Odometro);
  //_getGradoMarker(grd);
  var contenido = null;
  if (spd == 0) {
    contenido = '<small style="color:#000;">[DETENIDO]</small>';
  } else {
    if (cod == 61968) {
      contenido =
        "<div>" +
        '<table style="width:100%">' +
        '<tr style="background-color:#0f254e;color:#fff;color:#fff;letter-spacing:0.2em;text-align:center;">' +
        '<th style="padding:3px 35px;margin:1px;text-align:center;" colspan="2">' +
        geo +
        "</th>" +
        "</tr>" +
        "<tr><td><b>Hora</b></td><td>: " +
        hor +
        "</td></tr>" +
        "<tr><td><b>Velocidad</b></td><td>: " +
        spd +
        " km/hrs</td></tr>" +
        "<tr><td><b>Grados</b></td><td>: " +
        grd +
        "°</td></tr>" +
        "<tr><td><b>Fecha</b></td><td>: " +
        fec +
        "</td></tr>" +
        //'<tr><td><b>Odometro</b></td><td>: '+ odo +'</td></tr>'+
        "</table>" +
        "</div>";
    } else {
      contenido =
        '<b>Velocidad </b><small style="color:#000;">[' +
        spd +
        " km/hrs]</small>";
    }
  }
  return contenido;
}
