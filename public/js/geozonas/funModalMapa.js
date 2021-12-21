$(document).ready(function(){
	$('#modal_geozona').on('shown.bs.modal', function(){
		var centrado = elMapa.getCenter();
		google.maps.event.trigger(elMapa, "resize");
		elMapa.setCenter(centrado);
    });
});