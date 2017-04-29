<!--
 * Created by PhpStorm.
 * User: anwarsarmiento
 * Email: asarmiento@sistemasamigables.com
 * Date: 22/4/17
 * Time: 07:17
 -->

<!DOCTYPE html>
<html>
<head>
    <title>HTML5 Geolocation Demo</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script>
        $(function() {
            $('#btn').click(function(e){
                e.preventDefault();
                if(navigator && navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(geo_success, geo_error);
                } else {
                    error('Geolocation is not supported.');
                }
            });
        });
        function geo_success(position) {
            printLatLong(position.coords.latitude, position.coords.longitude);
        }
        function geo_error(err) {
            if(err.code == 1) {
                error('The user denied the request for location information.')
            } else if (err.code == 2) {
                error('Your location information is unavailable.')
            } else if (err.code == 3) {
                error('The request to get your location timed out.')
            } else {
                error('An unknown error occurred while requesting your location.')
            }
        }
        function printLatLong(lat, long) {
            $('body').append('<p>Lat: ' + lat + '</p>');
            $('body').append('<p>Long: ' + long + '</p>');
        }
        function error(msg) {
            alert(msg);
        }
    </script>
</head>
</html>
<body>
<input type="button" value="Guess my location" id="btn">

</body>
</html>