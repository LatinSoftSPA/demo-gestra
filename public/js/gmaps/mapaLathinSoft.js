var MY_STYLE = 'Lathinsoft';
var confiEstiloMapa = [
	{"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#0f254e"}]},
	{"featureType": "road",  "elementType": "geometry.fill", "stylers": [{"color": "#FFFFFF"}]},
	{"featureType": "road",  "elementType": "geometry.stroke","stylers": [{"color": "#A4A4A4"}]},
	{"featureType": "landscape.natural", "stylers": [{"color": "#aedec8"}]},
	{"featureType": "landscape.natural.terrain", "elementType": "geometry.fill", "stylers": [{"color": "#64788d"}]},
	{"featureType": "landscape.natural.landcover", "stylers": [{"color": "#aedec8"}]},

	{"featureType": "administrative.country", "elementType": "labels.text", "stylers": [{"color": "#dbdfe4"}, {"visibility": "off"}]},

	{"featureType": "poi.government", "stylers": [{"visibility": "off"}]},
	{"featureType": "poi.business", "stylers": [{"visibility": "off"}]},
	{"featureType": "poi.attraction", "stylers": [{"visibility": "off"}]},
	{"featureType": "poi.medical", "stylers": [{"visibility": "off"}]},
	{"featureType": "poi.place_of_worship", "stylers": [{"visibility": "off"}]}

	//{"featureType": "poi", "stylers": [{"visibility": "off"}]}
];
var nombreMapa = {name: 'Lathinsoft'};
var miEstilo = new google.maps.StyledMapType(confiEstiloMapa, nombreMapa);