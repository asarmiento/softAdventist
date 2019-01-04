<template>

    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div id="newMembers" class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-center header ">
                        <h1>Registro de Asistencia a Cultos</h1>
                    </div>
                </div>
                <div class="panel-body">
                    <div class=" col-lg-3 col-md-3 ">
                        <div class="panel-default ">
                            <div class="input-group material">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <v-select v-model="visit.assists" :options="listMembers"
                                          placeholder="Seleccione un Miembro" class="form-control "></v-select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <textarea v-model="pray_request" cols="100" rows="3" placeholder="Escríba aquí la petición de Oranción"></textarea>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-12  text-center">
                        <div class="btn">
                            <button v-on:click="sendupdate" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                    <div class="col-md-12 linea-divisoria"></div>

                </div>
                <div class="panel-heading">
                    <div class="text-center ">
                        <h1>Registro de Visitas</h1>
                    </div>
                </div>
                <div class="panel-body">
                    <div class=" col-lg-3 col-md-3 ">
                        <div class="panel-default ">
                            <label>Nombres</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" v-model="data.name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3 ">
                        <div class="panel-default ">
                            <label>Apellidos</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                                <input type="text" v-model="data.last_name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3 ">
                        <div class="panel-default ">
                            <label>Telefono</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" v-model="data.phone" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3 ">
                        <div class="panel-default ">
                            <label>Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-send"></i></span>
                                <input type="text" v-model="data.email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3 ">
                        <div class="panel-default ">
                            <label>Dirección</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-send"></i></span>
                                <input type="text" v-model="data.address" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin: 5px">
                        <div class="input-group">
                        <textarea v-model="pray_request_visit" cols="100" rows="3" class="form-control"
                                  placeholder="Escríba aquí la petición de Oranción"></textarea>
                    </div>
                    </div>
                    <div class="col-lg-12 col-md-12  text-center">
                        <div class="btn">
                            <button v-on:click="send" class="btn btn-success">Registrar</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-12">
            <h1>Lista de Asistencia al Culto</h1>
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Nombre del Miembro</th>
                    <th>Tipo</th>
                    <th>Hora</th>
                    <th>Petición de Oración</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="assitance in assits" v-if="assitance.member">

                    <td>{{assitance.member.name}} {{assitance.member.last}}</td>
                    <td><label class="label label-default">Miembro</label></td>
                    <td v-if="assitance.liturgia == 1" class="label label-success">Culto de Adoración</td>
                    <td v-else class="label-primary label">Escuela Sabática</td>
                    <td v-if="assitance.pray_request"><label class="label-primary label">{{assitance.pray_request}}</label></td>
                </tr>
                <tr v-for="assitance in assits" v-if="assitance.visitor">

                    <td>{{assitance.visitor.name}} {{assitance.visitor.last_name}}</td>
                    <td><label class="label label-danger">Visita</label></td>
                    <td v-if="assitance.liturgia == 1" class="label label-success">Culto de Adoración</td>
                    <td v-else class="label-primary label">Escuela Sabática</td>
                    <td v-if="assitance.pray_request"><label class="label-primary label">{{assitance.pray_request}}</label></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
    import vSelect from "vue-select";
    import Swal from 'sweetalert2'
    import myDatepicker from "vue-datepicker";

    export default {
        components: {vSelect, myDatepicker, Swal},
        data() {
            return {
                data: {
                    name: '',
                    last_name: '',
                    address: '',
                    phone: '',
                    email: '',
                    pray_request: '',
                },
                visit: {
                    assists: "",
                    pray_request: "",
                },
                listMembers: [],
                assits: "",
                pray_request_visit: "",
                pray_request: "",
            }


        },
        created() {
            this.$http.get('/softadventist/lista-miembros-select')
                .then((response) => {
                    this.listMembers = response.data;
                });
            this.$http.get('/softadventist/lista-asistencia')
                .then((response) => {
                    this.assits = response.data;
                });
        },
        methods: {
            sendupdate: function () {
                this.visit.pray_request = this.pray_request;
                console.log(this.pray_request_visit)
                axios.post('/softadventist/save-assists', this.visit)
                    .then(response => {
                        if (response.data.success = true) {
                            Swal('Se Guardo con Exito!!!', response.data.message, 'success');
                           this.assists= "";
                                this.pray_request= "";
                        }
                    })
                    .catch(function (error) {
                        Swal('Se genero un Error!!!', response.data.message, 'error');
                    });
            },
            send: function (event) {
                this.data.pray_request = this.pray_request_visit;
                axios.post('/softadventist/save-visitor', this.data)
                    .then(response => {
                         if (response.data.success = true) {
                            this.assits = response.data.datos;
                            Swal('Se Guardo con Exito!!!', response.data.message, 'success');
                            this.data.name = '';
                            this.data.last_name = '';
                            this.data.address = '';
                            this.data.phone = '';
                            this.data.email = '';
                        }
                    })
                    .catch(function (error) {
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
                            } else if (error.response.status === 500) {
                                console.log(data);
                                for (var index in data) {
                                    var messages = '';
                                    data[index].forEach(function (item) {
                                        messages += item + ' '
                                    });
                                    self.errors[index] = messages;
                                }
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

<style>

    .linea-divisoria {
        height: 1px;
        background-color: #336731;
        margin: 10px;
    }

    .material{
        z-index: 5;
    }
    @media only screen and (min-width: 320px) {
        #sale-otro-table {
            display: none;
        }

        #sale-pc-table {
            display: block;
        }

        h1, h2 {
            font-size: 18px;
        }

    }

    /* Small devices (landscape phones, 576px and up)*/
    @media (min-width: 576px) {
        #sale-otro-table {
            display: none;
        }

        #sale-pc-table {
            display: block;
        }
    }

    /* Medium devices (tablets, 768px and up)*/
    @media (min-width: 768px) {
        #sale-otro-table {
            display: block;
        }

        #sale-pc-table {
            display: none;
        }
    }

    /* Large devices (desktops, 992px and up)*/
    @media (min-width: 992px) {
        #sale-otro-table {
            display: block;
        }

        #sale-pc-table {
            display: none;
        }
    }

    /* Extra large devices (large desktops, 1200px and up)*/
    @media (min-width: 1200px) {
        #sale-otro-table {
            display: block;
        }

        h1, h2 {
            font-size: 28px;
            text-align: center;
        }

        #sale-pc-table {
            display: none;
        }
    }
</style>
