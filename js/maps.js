/**
 * Created by koen on 9/5/14.
 */
var map;
var markers = [];
var infowindows = [];
function initialize() {
    var marker = 'init';

    var mapOptions = {
        center: new google.maps.LatLng(55.57 , 13.44),
        zoom:3
    };
    map = new google.maps.Map(document.getElementById("gmaps"),
        mapOptions);

    //Functions when clicked on the map
    google.maps.event.addListener(map,'click',function(event) {
        twitterSearch(self, 'twitterGeo.php', {lng: event.latLng.lng(), lat: event.latLng.lat(), app_id: $('#app_id').val() })
        if(marker != 'init')
            marker.setMap(null);
        var maplocation = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
        marker = new google.maps.Marker({
            position: maplocation,
            map:map,
            draggable:false,
            animation: google.maps.Animation.DROP
        });
    });

}

// Add a marker to the map and push to the array.
function addMarker(location, icon, title, infowindow) {
    var marker = new google.maps.Marker({
        position: location,
        icon: icon,
        title: title,
        map: map
    });

    google.maps.event.addListener(marker, 'click', function() {

        infowindows.forEach(function(entry) {
            entry.close()
        });

        infowindow.open(map,marker);
        infowindows.push(infowindow);
    });

    markers.push(marker);
}

// Sets the map on all markers in the array.
function setAllMap(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
    setAllMap(null);
}

// Shows any markers currently in the array.
function showMarkers() {
    setAllMap(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
    clearMarkers();
    markers = [];
}

google.maps.event.addDomListener(window, 'load', initialize);