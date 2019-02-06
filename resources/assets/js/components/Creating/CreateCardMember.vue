<template>

    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div id="newMembers" class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-center ">
                        <h1>Registrar Clases Progresivas </h1>
                    </div>
                </div>
                <div class="panel-body">
                    <div class=" col-lg-6 col-md-6 col-xs-12">
                        <div class="panel-default ">
                            <label>Miembro </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <v-select v-model="data.member" :options="listMembers"></v-select>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-2 col-md-3 col-xs-12">
                        <div class="panel-default ">
                            <label>Tarjeta Amigo</label>
                            <div class="input-group">
                                <input type="checkbox" v-model="data.cardA">
                            </div>
                            <label>Fecha de Investidura</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input type="date" v-model="data.dateA" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-2 col-md-3 col-xs-12 ">
                        <div class="panel-default ">
                            <label>Tarjeta Compañero</label>
                            <div class="input-group">
                                <input type="checkbox" v-model="data.cardC">
                            </div>
                            <label>Fecha de Investidura</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input type="date" v-model="data.dateC" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-2 col-md-3 col-xs-12 ">
                        <div class="panel-default ">
                            <label>Tarjeta Explorador</label>
                            <div class="input-group">
                                <input type="checkbox" v-model="data.cardE">
                            </div>
                            <label>Fecha de Investidura</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input type="date" v-model="data.dateE" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-2 col-md-3 col-xs-12 ">
                        <div class="panel-default ">
                            <label>Tarjeta Orientador</label>
                            <div class="input-group">
                                <input type="checkbox" v-model="data.cardO">
                            </div>
                            <label>Fecha de Investidura</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input type="date" v-model="data.dateO" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-2 col-md-3 col-xs-12 ">
                        <div class="panel-default ">
                            <label>Tarjeta Viajero</label>
                            <div class="input-group">
                                <input type="checkbox" v-model="data.cardV">
                            </div>
                            <label>Fecha de Investidura</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input type="date" v-model="data.dateV" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-2 col-md-3 col-xs-12 ">
                        <div class="panel-default ">
                            <label>Tarjeta Guia</label>
                            <div class="input-group">
                                <input type="checkbox" v-model="data.cardG">
                            </div>
                            <label>Fecha de Investidura</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input type="date" v-model="data.dateG" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-xs-12 ">
                        <div class="panel-default ">
                            <label>Tarjeta Guia Mayor</label>
                            <div class="input-group">
                                <input type="checkbox" v-model="data.cardGm">
                            </div>
                            <label>Fecha de Investidura</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input type="date" v-model="data.dateGm" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-2 col-md-3 col-xs-12 ">
                        <div class="panel-default ">
                            <label>Tarjeta Lider Juvenir</label>
                            <div class="input-group">
                                <input type="checkbox" v-model="data.cardLj">
                            </div>
                            <label>Fecha de Investidura</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input type="date" v-model="data.dateLj" class="form-control">
                            </div>
                        </div>
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
                    member: '',
                    dateA: '',
                    cardA: false,
                    dateC: '',
                    cardC: false,
                    dateE: '',
                    cardE: false,
                    dateO: '',
                    cardO: false,
                    dateV: '',
                    cardV: false,
                    dateG: '',
                    cardG: false,
                    dateGm: '',
                    cardGm: false,
                    dateLj: '',
                    cardLj: false,
                },
                txtSearch: '',
                counts: ['5', '10', '20', '50'],
                datos: [],
                my_pages: [],
                columns: [],
                typeAll: true,
                typeStyle: true,
                listMembers: [],
                club_directors: "",
                cards: [],
                civil: [
                    {"label": 'Casado(a)', "value": 'Casado(a)'},
                    {"label": 'Soltero(a)', "value": 'Soltero(a)'},
                    {"label": 'Divorciado(a)', "value": 'Divorciado(a)'},
                    {"label": 'Viudo(a)', "value": 'Viudo(a)'},
                    {"label": 'Union Libre', "value": 'Union Libre'},

                ]
            }
        }, created() {
            this.$http.get('/softadventist/lista-miembros-select').then((response) => {
                this.listMembers = response.data;

            });
            this.$http.get('/softadventist/lista-director-select').then((response) => {
                this.club_directors = response.data;

            });
            this.$http.get('/softadventist/lista-tarjetas-select').then((response) => {
                this.cards = response.data;

            });
            var self = this;
            this.$http.get("/softadventist/data-member-tarjetas").then((response) => {
                self.datos = response.data.model;
                self.my_pages = response.data.my_pages;
                self.columns = response.data.columns;
            });

        },
        methods: {

            send: function (event) {

                axios.post('/softadventist/save-miembros-card-club', this.data)
                    .then(response => {
                        if (response.data.success = true) {
                            Swal('Se Guardo con Exito!!!', response.data.message, 'success');
                            this.data.charter = '';
                            this.data.name = '';
                            this.data.last = '';
                            this.data.bautizmoDate = '';
                            this.data.birthdate = '';
                            this.data.address = '';
                            this.data.civil_status = '';
                            this.data.phone = '';
                            this.data.cell = '';
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

    .mostrar {
        display: block;
    }

    .material {
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
