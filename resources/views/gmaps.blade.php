<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>SoftAdventist-IASD</title>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<div id="map"  ></div>
<script>

    function initMap() {

var prueba = JSON.parse('<?php echo json_encode($churchs); ?>');
var dataChurchs =[];
        for(var items in prueba) {
            dataChurchs.push({'lat' : parseFloat(prueba[items].lat),'lng':parseFloat(prueba[items].lng) })

        }
        console.log((dataChurchs));

        var locations = dataChurchs /*[
            {lat: 9.43632230, lng: -84.12949780},
            {lat: 9.325817, lng: -83.951656},
            {lat: 14.090338, lng: -87.191919},
            {lat: 14.081646, lng: -87.166146},
            {lat: 15.509761, lng: -88.017277},
            {lat: 15.505088, lng: -88.028203},
        ]*/


        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: {lat: 12.385024, lng: -85.313273}
        });

        // Create an array of alphabetical characters used to label the markers.
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        var markers = locations.map(function(location, i) {
            return new google.maps.Marker({
                position: location,
                label: labels[i % labels.length]
            });
        });

        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    }

</script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBs0c3WR4uEkaK428rjNUQtqsqv_bP424o&callback=initMap">
</script>
</body>
</html>