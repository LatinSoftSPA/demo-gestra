//var mensajeCargando = $('#divCargando');

$(document).ready(function(){
	function localizarMoviles(){
		const laEmpresa = 'linea104';
		var url = 'http://latinsoft.cl/api/trackers/tpublico/antofagasta/' +laEmpresa;
		var mensajeCargando = $('#divCargando');

		$.ajax({
			url: url,
			type: 'POST',
			dataType:'json',
			beforeSend: function(){
			    //mensajeCargando.modal('show');
			},
			error: function(){
				console.log('Lamentablemente Hay un Error de Coneccion, Intentelo Mas Tarde!!!');
			}
		})
		.done(function(data, textStatus, jqXHR){			
			if(eventosJSON_OK(data.Error))
			{
				var trackers = data['Moviles'];
				leerJSonGTS(trackers);
			}
		});
	}

	localizarMoviles();
	const segundos = 10;
  setInterval(function(){ localizarMoviles(); }, (1000 * segundos));
});

function leerJSonGTS(listado){
  $.each(listado, function(i, item){
    var eventos = item.Eventos;
    var movil = item.Movil;
    var codigo = item.Codigo;

    $.each(eventos, function(x, obj){
      if(parseInt(obj.StatusCode)  !== 'undefined'){
        //analizarGeocerca(parseInt(obj.StatusCode), parseInt(obj.CodigoGZ), codigo, obj.NombreGZ);
      }
      var elMarker;
      var pos = new google.maps.LatLng(obj.Latitud, obj.Longitud);
      var grd = _getGradoMarker(parseInt(obj.Heading));
      var spd = parseInt(obj.Velocidad);
      var clr = _getColorMarker(spd);
      var cnfMaker = configurarMarker(pos, grd, spd, clr, movil);
      

      if(!lstMarkers[codigo]){
        elMarker = new google.maps.Marker(cnfMaker);      
        lstMarkers[codigo] = elMarker;
        crearBurbuja(elMarker, spd, movil);
      } else {
        elMarker = lstMarkers[codigo];
        var cnfIcono = _configurarIcono(grd, spd, clr);
        
        var lastPos = elMarker.getPosition();
        if(pos.equals(lastPos))
        {
          cnfIcono = _configurarIcono(grd, 0, clr);
        }

        actualizarMarker(elMarker, pos, cnfIcono);
        actualizarBurbuja(movil, spd);
        lstMarkers[codigo] = null;
        lstMarkers[codigo] = elMarker;
      }
      _moverLabel(codigo, elMarker);
      //agregarPosiciones(pos);
      lstTrackers.push(movil);
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

function _moverLabel(movil, elMarker){
  if(!lstLabels[movil])
  {
    var label = definirLabelMarker(elMapa, elMarker);
    lstLabels[movil] = label;

  } else {
    lstLabels[movil].bindTo('position', elMarker);
  }
}

function enfocarTrackers(){
  if(lstPositions)
  {
    elMapa.fitBounds(lstPositions);
    elMapa.setZoom(parseInt(elMapa.getZoom() + 1));
  }
}

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


$(document).ready(function(){
    var listado = [
      'http://latinsoft.cl/archivos/circuitos/antofagasta/linea104/RUTA_104_IDA.kml', 
      'http://latinsoft.cl/archivos/circuitos/antofagasta/linea104/RUTA_104_REG.kml'
    ];
    $.each(listado, function(x, url){
      definirKml(url);
    });
});