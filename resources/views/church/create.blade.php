<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>SoftAdventist-IASD</title>
    <!-- Styles -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="{{asset('css/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 500px;
        }
        .controls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 300px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        .pac-container {
            font-family: Roboto;
        }

        #type-selector {
            color: #fff;
            background-color: #4d90fe;
            padding: 5px 11px 0px 11px;
        }

        #type-selector label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }
        #target {
            width: 345px;
        }
        /* Optional: Makes the sample page fill the window. */

    </style>
</head>
<body>
<div class="row center">
    <div class="panel-body">
        <div id="newMembers" class="panel panel-default">
            <div class="panel-heading">
                <div class="text-center ">
                    <h1>Formulario para Agregar tu Iglesia Adventistas del Septimo Dia</h1>
                </div>
            </div>
            <div class="panel-body col-lg-12 col-md-12" >
                <div class=" col-lg-5 col-md-5">
                    <div class="form-group  ">
                        <label for="localfield">Campo Local Al Cual pertenece Tu Iglesia</label>
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                            <select id="localfield" name="localfield"
                                    class="form-control js-example-basic-single js-states">
                                <option>Seleccione un Campo Local</option>
                                @foreach($unions AS $union)
                                    <optgroup class="bold content-box-green" label="{{$union->name}}">
                                        @foreach($union->localFields AS $localField)
                                            <option value="{{$localField->token}}">{{$localField->name}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                        <small class="help-block"></small>
                    </div>
                </div>
                <div class=" col-lg-5 col-md-5  ">
                    <div class="form-group">
                        <label for="name">Nombre de Tu Iglesia</label>
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="fa fa-desktop"></i></span>
                            <input id="name" type="text" placeholder="Iglesia Adventista de Quepos" class="form-control">
                        </div>
                        <small class="help-block"></small>
                    </div>
                </div>
                <div class=" col-lg-4 col-md-4  ">
                    <div class="form-group">
                        <label for="name">Altitud</label>
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="fa fa-desktop"></i></span>
                            <input id="name" type="text" placeholder="9.43632230" class="form-control">
                        </div>
                        <small class="help-block"></small>
                    </div>
                </div>
                <div class=" col-lg-4 col-md-4  ">
                    <div class="form-group">
                        <label for="name">Longitud</label>
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="fa fa-desktop"></i></span>
                            <input id="name" type="text" placeholder="-84.12949780" class="form-control">
                        </div>
                        <small class="help-block"></small>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12  text-center">
                    <div class="btn">
                        <button v-on:click="send" class="btn btn-success">Guardar</button>
                    </div>
                </div>

            </div>
            <div class="col-lg-12 col-md-12  text-center">
                <input id="pac-input" class="controls" type="text" placeholder="Search Box">

                <div id="map"></div>
            </div>
        </div>
    </div>
    <div id="map"></div>

</div>


<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script>

    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 9.43632230, lng: -84.12949780},
            zoom: 10,
            mapTypeId: 'roadmap'
        });
        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Location found.');
                map.setCenter(pos);
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }


    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
    }



</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBs0c3WR4uEkaK428rjNUQtqsqv_bP424o&callback=initMap">
</script>
</body>
</html>
