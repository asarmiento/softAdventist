<template>
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div id="newMembers" class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-center ">
                        <h1> {{title}} </h1>
                    </div>
                </div>
                <div class="panel-body">
                    <!--div-- class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.code.length > 0}">
                        <div class="panel-default ">
                            <label>Cual es tu Pais</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                <v-select v-model="data.country" :on-change="localField" :options="countrys"></v-select>
                            </div>
                            <small class="help-block">{{errors.code}}</small>
                        </div>
                    </div-->
                    <div class=" col-lg-5 col-md-5  " :class="{'has-feedback has-error':errors.localfield.length > 0}">
                        <div class="panel-default ">
                            <label>Campo Local Al Cual pertenece Tu Iglesia</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                                <v-select v-model="data.localfield" :options="localfields"></v-select>
                            </div>
                            <small class="help-block">{{errors.localfield}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3  "
                         :class="{'has-feedback has-error':errors.name.length > 0}">
                        <div class="panel-default ">
                            <label for="name">Nombre de Tu Iglesia</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-desktop"></i></span>
                                <input id="name" type="text" v-model="data.name" class="form-control">
                            </div>
                            <small class="help-block">{{errors.name}}</small>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12  text-center">
                        <div class="btn">
                            <button v-on:click="send" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="map">{{initMap}}</div>

        <!--div-- class="col-md-12 col-md-offset-0">

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Lista de Cuentas Bancarias</h3>
                </div>

                <div class="panel-body">
                    <div id="demo-dt-delete_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div id="demo-dt-delete_filter" class="dataTables_filter">
                            <label>Buscar: <input type="search" class="form-control input-sm" placeholder=""
                                                  aria-controls="demo-dt-delete"></label>
                        </div>
                        <table id="demo-dt-delete"
                               class="table table-striped table-bordered dataTable no-footer dtr-inline" cellspacing="0"
                               width="100%" role="grid" aria-describedby="demo-dt-delete_info" style="width: 100%;">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1" aria-sort="ascending"
                                    aria-label="Name: activate to sort column descending" style="width: 277px;"></th>
                                <th class="sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1"
                                    aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                    style="width: 277px;">Numero de Cuenta
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1"
                                    aria-label="Position: activate to sort column ascending" style="width: 408px;">
                                    Nombre de la cuenta
                                </th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1" aria-label="Office: activate to sort column ascending"
                                    style="width: 203px;">Saldo Incial
                                </th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1" aria-label="Extn.: activate to sort column ascending"
                                    style="width: 131px;">Debitos
                                </th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1" aria-label="Extn.: activate to sort column ascending"
                                    style="width: 131px;">Creditos
                                </th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1" aria-label="Extn.: activate to sort column ascending"
                                    style="width: 131px;">Balance
                                </th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1" aria-label="Extn.: activate to sort column ascending"
                                    style="width: 131px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr role="row" class="odd">
                                <td class="sorting_1"><span class="btn btn-info fa fa-pencil"></span></td>

                                <td><a target='_blank' class='btn btn-danger'>
                                    <i class='fa fa-file-pdf-o'></i></a></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="dataTables_info" id="demo-dt-delete_info" role="status" aria-live="polite">Showing 1
                            to 10 of 57 entries
                        </div>
                        <div class="dataTables_paginate paging_simple_numbers" id="demo-dt-delete_paginate">
                            <ul class="pagination">
                                <li class="paginate_button previous disabled" aria-controls="demo-dt-delete"
                                    tabindex="0" id="demo-dt-delete_previous"><a href="#"><i
                                        class="demo-psi-arrow-left"></i></a></li>
                                <li class="paginate_button active" aria-controls="demo-dt-delete" tabindex="0"><a
                                        href="#">1</a></li>
                                <li class="paginate_button " aria-controls="demo-dt-delete" tabindex="0"><a
                                        href="#">2</a></li>
                                <li class="paginate_button " aria-controls="demo-dt-delete" tabindex="0"><a
                                        href="#">3</a></li>
                                <li class="paginate_button disabled" aria-controls="demo-dt-delete" tabindex="0"
                                    id="demo-dt-delete_ellipsis"><a href="#">…</a></li>
                                <li class="paginate_button " aria-controls="demo-dt-delete" tabindex="0"><a
                                        href="#">6</a></li>
                                <li class="paginate_button next" aria-controls="demo-dt-delete" tabindex="0"
                                    id="demo-dt-delete_next"><a href="#"><i class="demo-psi-arrow-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div-->
    </div>

</template>

<script>
    import vSelect from "vue-select";
   // import google from "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"
    export default {
        props: ['title', 'url'],
        components: {vSelect},
        data () {
            return {
                data: {
                    name: '',
                    localfield: '',
                    country: '',

                },
                errors: {
                    name: '',
                    localfield: '',
                },
                countrys: [],
                localfields: [],
                locations: [
                    {lat: 9.43632230, lng: -84.12949780},
                    {lat: 9.325817, lng: -83.951656},
                ]
            }
        },
        computed: {
//             initMap: function() {
//
//        var map = new google.maps.Map(document.getElementById('map'), {
//            zoom: 3,
//            center: {lat: 12.385024, lng: -85.509573}
//        });
//
//        // Create an array of alphabetical characters used to label the markers.
//        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
//
//        // Add some markers to the map.
//        // Note: The code uses the JavaScript Array.prototype.map() method to
//        // create an array of markers based on a given "locations" array.
//        // The map() method here has nothing to do with the Google Maps API.
//        var markers = this.locations.map(function(location, i) {
//            return new google.maps.Marker({
//                position: location,
//                label: labels[i % labels.length]
//            });
//        });
//
//        // Add a marker clusterer to manage the markers.
//        var markerCluster = new MarkerClusterer(map, markers,
//            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
//    }
        },
        created() {

            this.$http.get('/paises')
                .then((response) => {
                this.countrys = response.data;
        })
            ; this.$http.get('/list-localfields-all')
                .then((response) => {
                this.localfields = response.data;
        })
            ;

        },
        methods: {
            localField: function (event) {
                console.log(this.data)
                if (this.data.country) {

                   /* axios.post('/softadventist/list-unions-country', this.data.country)
                        .then((response) => {

                    this.countrys = response.data;
                });*/
                }
            },
            pdfInfo: function (token) {
                return "/softadventist/reporte-estado-de-cuenta-actual/" + token;
            },
            send: function (event) {
                var self = this;
                axios.post('/softadventist/' + self.url, this.data)
                    .then(response => {
                    if(response.data.success = true
                )
                {
                    this.$alert({
                        title: 'Se Guardo con Exito!!!',
                        message: response.data.message
                    });
                    this.data.code = '';
                    this.data.name = '';
                    this.data.initial_balance = '';
                    this.errors.code = '';
                    this.errors.name = '';
                    this.errors.initial_balance = '';
                }
            }).
                catch(function (error) {
                    if (error.response) {
                        let data = error.response.data;
                        if (error.response.status === 422) {
                            for (var index in data) {
                                var messages = '';
                                data[index].forEach(function (item) {
                                    messages += item + ' '
                                });
                                self.errors[index] = messages;
                            }
                        } else if (error.response.status === 401) {
                            self.errors.response.invalid = true;
                            self.errors.response.msg = data.msg.message;
                        } else {
                            console.log(error);
                            alert("Error generic");
                        }
                    } else if (error.request) {
                        console.log(error.request);
                        alert("Error empty");
                    } else {
                        console.log('Error', error.message);
                        alert("Error");
                    }
                });
            }
        },
    }
</script>

<style scoped>
    #map {
        height: 300px;
        width: 700px;
    }
    .mostrar {
        display: block;
    }
</style>
