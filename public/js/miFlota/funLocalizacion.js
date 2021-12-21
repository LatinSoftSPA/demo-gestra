var _estadoLocalizando;
var codigoMovil = null;

var varLocalizarMoviles = function(){
  var elMovil = localizarTrackers();
  elMovil.done(function(data, textStatus, jqXHR){
    if(eventosJSON_OK(data.Error))
    {
      agregarMarker();
      enfocarTrackers();
      agregarLabelMarker();
      
      //setInterval(localizarTrackers, 1000);
    }
  });
};

function eventosJSON_OK(mensaje){
  var elEstado = false;
  switch(mensaje){
    case 'Invalid authorization':
      console.log("USUARIO INVALIDO...!!!");
      break;
    case 'No devices specified (invalid group?)':
      console.log("GRUPO INVALIDO o NO HAY MOVILES...!!!");
      break;
    case 'Internal error (account)':
      console.log("PROBLEMAS EN EL SERVIDOR...!!!");
      break;
    default: 
      elEstado = true;
      break;
  }
  return elEstado;
}

//=====================================================================================================
$(document).ready(function(){
    
    $('#seccion_1').removeClass('in');
    $('#seccion_1 a').removeClass('collapsed');
    $('#seccion_2').addClass('in');
    $('#seccion_2 a').removeClass('collapsed');

});
$(document).ready(function(){
  $('#l104_antof').click(function(){
    iniciarProceso('linea104');
  });
});
//=====================================================================================================
function iniciarProceso(valor){
    codigoMovil = valor;
    _estadoLocalizando = clearTimeout();
    var mensajeCargando = $('#divCargando');
    mensajeCargando.modal('show');

    limpiarMarkers();
    limpiarLabelMarker();
    
    _estadoLocalizando = setTimeout(varLocalizarMoviles, 2345);    
}
function localizarTrackers(){
  var url = 'http://latinsoft.cl/api/trackers/tpublico/antofagasta/Linea104/localizarMovil?idde_devic=' +codigoMovil;
  var mensajeCargando = $('#divCargando');

  return $.ajax({
    url: url,
    type: 'POST',
    dataType:'json',
    beforeSend: function(){
      $('#capaLateralDerecha #detalleUltimoRegistro').addClass('hidden');
    },
    error: function(){
      console.log('Lamentablemente Hay un Error de Coneccion, Intentelo Mas Tarde!!!');
    }
  })
  .done(function(data, textStatus, jqXHR){
      mensajeCargando.modal('hide');
      if(eventosJSON_OK(data.Error))
      {
        var trackers = data['Moviles'];
        leerJSonGTS(trackers);
      }
  });
}
//=====================================================================================================

function leerJSonGTS(listado){
  $.each(listado, function(i, item){
    var eventos = item['Eventos'];
    var tracker = item['Movil'];
    var device = item['Codigo'];

    $.each(eventos, function(x, obj){
      if(parseInt(obj.StatusCode)  !== 'undefined'){
        //analizarGeocerca(parseInt(obj.StatusCode), parseInt(obj.CodigoGZ), device, obj.NombreGZ);
      }
      var elMarker;
      var pos = new google.maps.LatLng(obj.Latitud, obj.Longitud);
      var grd = _getGradoMarker(parseInt(obj.Heading));
      var spd = parseInt(obj.Velocidad);
      var clr = _getColorMarker(spd);
      var cnfMaker = configurarMarker(pos, grd, spd, clr, tracker);
      

      if(!lstMarkers[tracker]){
        elMarker = new google.maps.Marker(cnfMaker);      
        lstMarkers[tracker] = elMarker;
        crearBurbuja(elMarker, spd, tracker);
      } else {
        elMarker = lstMarkers[tracker];
        var cnfIcono = configurarIcono(grd, spd, clr);
        
        var lastPos = elMarker.getPosition();
        if(pos.equals(lastPos))
        {
          cnfIcono = configurarIcono(grd, 0, clr);
        }

        actualizarMarker(elMarker, pos, cnfIcono);
        actualizarBurbuja(tracker, spd);
        lstMarkers[tracker] = null;
        lstMarkers[tracker] = elMarker;
      }
      _moverLabel(tracker, elMarker);
      agregarPosiciones(pos);
      lstTrackers.push(tracker);
    });
  });
}

function actualizarMarker(elMarker, pos, cnfIcono){
  elMarker.setPosition(pos);
  elMarker.setIcon(cnfIcono); 
}

function actualizarBurbuja(tracker, spd){
  lstBurbujas[tracker].setContent(_textoBurbuja(spd));
}

function _moverLabel(tracker, elMarker){
  if(!lstLabels[tracker])
  {
    var label = definirLabelMarker(elMapa, elMarker);
    lstLabels[tracker] = label;
  } else {
    lstLabels[tracker].bindTo('position', elMarker);
  }
}

function enfocarTrackers(){
  if(lstPositions)
  {
    elMapa.fitBounds(lstPositions);
    elMapa.setZoom(parseInt(elMapa.getZoom() - 5));
  }
}
