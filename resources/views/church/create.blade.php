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
            height: 400px;
        }
        /* Optional: Makes the sample page fill the window. */

        .controls {
            background-color: #fff;
            border-radius: 2px;
            border: 1px solid transparent;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            box-sizing: border-box;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            height: 29px;
            margin-left: 17px;
            margin-top: 10px;
            outline: none;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
        }

        .controls:focus {
            border-color: #4d90fe;
        }
        .title {
            font-weight: bold;
        }
        #infowindow-content {
            display: none;
        }
        #map #infowindow-content {
            display: inline;
        }

    </style>
</head>
<body>
<div class="row center">
    <div class="panel-body">
        <form method="post" action="{{route('store-church')}}">
        <div id="newMembers" class="panel panel-default">
            <div class="panel-heading">
                <div class="text-center ">
                    <h1>Formulario para Agregar tu Iglesia Adventistas del Septimo Dia</h1>
                </div>
            </div>
            <div class="panel-body col-lg-12 col-md-12" >
                    {{csrf_field()}}
                <div class=" col-lg-5 col-md-5">
                    <div class="form-group  ">
                        <label for="localfield">Campo Local Al Cual pertenece Tu Iglesia</label>
                        <div class="input-group {{$errors->has('local_field_id')?'has-error':''}}">
                            <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                            <select id="localfield" name="local_field_id"
                                    class="form-control js-example-basic-single js-states">
                                <option value="">Seleccione un Campo Local</option>
                                @foreach($unions AS $union)
                                    <optgroup class="bold content-box-green" label="{{$union->name}}">
                                        @foreach($union->localFields AS $localField)
                                            <option value="{{$localField->token}}">{{$localField->name}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                        <small class="help-block {{$errors->has('local_field_id')?'alert alert-danger':''}} ">{{$errors->first('local_field_id',':message')}}</small>
                    </div>
                </div>
                <div class=" col-lg-5 col-md-5  ">
                    <div class="form-group">
                        <label for="name">Nombre de Tu Iglesia</label>
                        <div class="input-group  {{$errors->has('name')?'has-error':''}}">
                            <span class="input-group-addon"><i class="fa fa-desktop"></i></span>
                            <input id="name" name="name" value="{{old('name')}}" type="text" placeholder="Iglesia Adventista de Quepos" class="form-control">
                        </div>
                        <small class="help-block {{$errors->has('name')?'alert alert-danger':''}} ">{{$errors->first('name',':message')}}</small>
                    </div>
                </div>
                    <div class=" col-lg-3 col-md-3  "></div>
                <div class=" col-lg-4 col-md-4  ">
                    <div class="form-group {{$errors->has('latitud')?'has-error':''}}">
                        <label for="altitud">Altitud y Longitud</label>
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="fa fa-desktop"></i></span>
                            <input id="altitud"  value="{{old('localizacion')}}" name="localizacion" type="text"
                                   placeholder="(9.43632230, -84.099484343)" class="form-control">
                        </div>
                    <small class="help-block {{$errors->has('latitud')?'alert alert-danger':''}} ">{{$errors->first('latitud',':message').' '. $errors->first('longitud',':message')}}</small>
                </div>
                </div>
                <div class=" col-lg-4 col-md-4  ">
                    <div class="form-group {{$errors->has('address')?'has-error':''}}">
                        <label for="altitud">Dirección</label>
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="fa fa-desktop"></i></span>
                            <input id="address"  value="{{old('address')}}" name="address" type="text"
                                   placeholder="Provincia de Puntarenas, Quepos, Costa Rica" class="form-control">
                        </div>
                        <small class="help-block {{$errors->has('address')?'alert alert-danger':''}} ">{{$errors->first('address',':message')}}</small>
                    </div>
                </div>
               <div class="col-lg-12 col-md-12  text-center">
                    <div class="btn">
                        <input type="submit"  class="btn btn-success" value="Guardar"/>
                    </div>
                </div>

            </div>
            <div class="col-lg-12 col-md-12  text-center">
                <p class="alert alert-info">Nota: Solo debe elegir el campo local donde pertenece su iglesia, luego Buscar la iglesia que desea agregar en el campo que esta con el mapa
                    <strong>Digite el lugar que busca</strong> Los otros campos se agregaran una vez encuentre su iglesia.</p>
            </div>
            <div class="col-lg-12 col-md-12  text-center">
                <input id="pac-input" class="controls" type="text"
                       placeholder="Digite el lugar que busca">
                <div id="map"></div>
                <div id="infowindow-content">

                    <span id="place-name"  class="title"></span><br>
                    Geolocalizacion <span id="geo-id"></span><br>
                    Place ID <span id="place-id"></span><br>
                    <span id="place-address"></span>
                </div>
            </div>
        </div>
        </form>
    </div>

</div>


<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script>
    // This sample uses the Place Autocomplete widget to allow the user to search
    // for and select a place. The sample then displays an info window containing
    // the place ID and other information about the place that the user has
    // selected.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 12.43632230, lng: -84.12949780},
            zoom: 6
        });

        var input = document.getElementById('pac-input');

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map
        });
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            var place = autocomplete.getPlace();
             if (!place.geometry) {
                return;
            }

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            // Set the position of the marker using the place ID and location.
            marker.setPlace({
                placeId: place.place_id,
                location: place.geometry.location
            });
            marker.setVisible(true);

            document.getElementById('place-name').textContent = place.name;
            document.getElementById('place-id').textContent = place.place_id;
            document.getElementById('geo-id').textContent = place.geometry.location;
            document.getElementById('altitud').value = place.geometry.location;
            document.getElementById('name').value = place.name;
            document.getElementById('place-address').textContent =  place.formatted_address;
            document.getElementById('address').value =  input.value;
            infowindow.setContent(document.getElementById('infowindow-content'));
            infowindow.open(map, marker);
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBs0c3WR4uEkaK428rjNUQtqsqv_bP424o&libraries=places&callback=initMap"
        async defer></script>

</body>
</html>
