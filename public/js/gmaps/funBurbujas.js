var laBurbuja;
var lstBurbujas = [];
var tracking = false;

//######################################################################
function crearBurbuja(elMarker, spd, tracker){
    var laBurbuja = definirBurbuja(elMarker, spd);
    lstBurbujas[tracker] = laBurbuja;
    agregarBurbujas();
    cerrarBurbujas();
}

function agregarBurbujas(){
    var listado = lstBurbujas;
    $.each(lstTrackers, function(i, tracker){
      listado[tracker].setMap(elMapa);
    });
}

function limpiarBurbujas(){
    var listado = lstBurbujas;
    $.each(lstTrackers, function(i, tracker){
      listado[tracker].setMap(null);
    });
    lstBurbujas.length = 0;
    lstBurbujas = [];
}
//######################################################################
function definirBurbuja(marker, spd){
    var infoWindow = new google.maps.InfoWindow();
    infoWindow.setContent(_textoBurbuja(spd));
    
    google.maps.event.addListener(marker, 'click', function(){
        cerrarBurbujas();     
        infoWindow.open(elMapa, marker);
        cambiarZoom(16);
        centrarMapa(marker);
    });
    return infoWindow;
}

function cerrarBurbujas(){
    var listado = lstBurbujas;
    $.each(lstTrackers, function(i, tracker){
      listado[tracker].close();
    });
}

function _textoBurbuja(spd){
    var elTexto = '';
    if(spd === 0){
       elTexto = '<b style="color:#000;">DETENIDO</b>';
    } else {
       elTexto = '<b>Velocidad : <small style="color:#000;">('+ spd +' km/hrs)</small></b>';
    }
    return elTexto;
}