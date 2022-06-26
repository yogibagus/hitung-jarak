// get location
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.watchPosition(showPosition);
  } else {
	alert("browser not supported");
    console.error("browser not supported");
  }
}

// get he location of device
getLocation();

// show the position and run the mapbox
function showPosition(position) {
	var latitude = position.coords.latitude;
	var longitude = position.coords.longitude;

	// set destination
	var url_string = window.location.href; //window.location.href
	var url = new URL(url_string);
	var longitudeDestination = url.searchParams.get("longitude");
	var latitudeDestination = url.searchParams.get("latitude");
	if(longitudeDestination && latitudeDestination){
		
	}else{
		longitudeDestination = null;
		latitudeDestination = null;
	}
	

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
		directions.setOrigin([longitude,latitude]); 
		
		if(latitudeDestination != null && longitudeDestination != null || latitudeDestination != undefined && longitudeDestination != undefined){
			console.log(longitudeDestination +","+ latitudeDestination);
			directions.setDestination([longitudeDestination, latitudeDestination]); // can be address
		}
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
}


