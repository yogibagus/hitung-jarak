mapboxgl.accessToken = 'pk.eyJ1IjoieW9nc3RlciIsImEiOiJja2o3ank4d3I2aW5rMnFsYm5wZmE2OWw1In0.F179z2jXPmVBSRYxtrzzzA';
var map = new mapboxgl.Map({
	container: 'map',
	style: 'mapbox://styles/mapbox/streets-v11',
	center: [112.16809,-8.09774],
	zoom: 17,	
});

var directions = new MapboxDirections({
	accessToken: mapboxgl.accessToken,
	unit: 'metric',
	profile: 'mapbox/driving'
});

map.addControl(directions,'top-left');

map.on('load',  function() {
	directions.setOrigin("Blitar"); 
    // directions.setDestinaion([112.17211,-8.09581]); // can be address
})

// Add geolocate control to the map.
map.addControl(
	new mapboxgl.GeolocateControl({
		positionOptions: {
			enableHighAccuracy: true
		},
		trackUserLocation: true
	})
	);


