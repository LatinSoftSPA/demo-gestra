//var marker;
var lstMarkers = [];
var lstTrackers = [];

function _getColorMarker(spd){
  var color;
  switch(true){
    case (spd >= 1)  && (spd <= 20): 
      color = "#01DF01";
    break;
    case (spd >= 21) && (spd <= 40): 
      color = "#2EFEF7";
    break;
    case (spd >= 41) && (spd <= 60): 
      color = "#F7FE2E";
    break;
    case (spd >= 61) && (spd <= 80): 
      color = "#FF8000";
    break;
    case (spd >= 81) && (spd <= 100): 
      color = "#DF01A5";
    break;
    case (spd > 100): 
      color = "#FF0000";
    break;
    default:
      color = "#FF0000";
  }
  return color;
}

function _getGradoMarker(valor){
  var grd = 0;
  if(typeof(valor) !== 'undefined'){
    grd = valor;
  }
  return grd;
}

function limpiarMarkers(){
  var listado = lstMarkers;
  $.each(lstTrackers, function(i, tracker){
    listado[tracker].setMap(null);
  });
}

function agregarMarker(){
  var listado = lstMarkers;
  $.each(lstTrackers, function(i, tracker){
    listado[tracker].setMap(elMapa);
  });
}

function enfocarMarker(marker){
  centrarMapa(lstMarkers[marker]);
  cambiarZoom(16);
}
//######################################################################
function configurarMarker(pos, grd, spd, clr, tracker){
  return {
    position: pos,
    map: elMapa, 
    clickable: true,
    draggable: false,
    icon: _configurarIcono(grd, spd, clr),
    title : tracker
  };
}

function _configurarIcono(grd, spd, clr){
  var icono = "M 0.15819685,-1.7313924 C -0.20068547,-0.57366228 -0.77102389,0.64638983 -1.8776818,2.2570557 0.47577564,1.1195351 -0.17423351,1.1153647 2.1052267,2.2977377 1.0806048,0.75653464 0.54081929,-0.5637517 0.15819685,-1.7313924 Z";
  return {
    path: +spd > 0 ? icono:google.maps.SymbolPath.CIRCLE,
    rotation: grd,
    scale: +spd > 0 ? 3:5,
    strokeColor: '#000',
    strokeWeight: 1.2,
    fillColor: clr,//+ spd > 0 ? '#' +clr:'#FF0000',
    fillOpacity:2
  };
}