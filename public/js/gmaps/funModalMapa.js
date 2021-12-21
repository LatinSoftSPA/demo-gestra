$(document).ready(function(){
	$('#modal_mapa').on('shown.bs.modal', function(){
		if(lstRutas.length > 0){
			eliminarRutas(lstRutas);
		}
		var centrado = elMapa.getCenter();
		google.maps.event.trigger(elMapa, "resize");
		elMapa.setCenter(centrado);
    });
});