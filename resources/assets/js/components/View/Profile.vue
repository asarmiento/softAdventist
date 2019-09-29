<template>

    <!---------------------------------->
    <div class="row">
        <div class="tab-base">
            <div><h1>{{member_data.name}} {{member_data.last}}</h1></div>
            <!--Nav Tabs-->
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#demo-lft-tab-1">Aventurero </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#demo-lft-tab-2">Conquistadores <span class="badge badge-purple">{{speciality.length}}</span></a>
                </li>
                <li>
                    <a data-toggle="tab" href="#demo-lft-tab-4">Lider Juvenil</a>
                </li>
            </ul>

            <!--Tabs Content-->
            <div class="tab-content">
                <div id="demo-lft-tab-1" class="tab-pane fade active in">
                    <p class="text-main text-semibold">Aventurero</p>
                    <p>No tiene Registros</p>
                </div>
                <div id="demo-lft-tab-2" class="tab-pane fade">
                    <p class="text-main text-semibold">Especialidades Obtenidas</p>
                    <div class="panel" v-if="speciality.length > 0">
                        <div class="panel-body demo-liquid-fixed">
                            <div class="fixed-fluid" v-for="special in speciality">
                                <div class="fixed-sm-250 pull-sm-left" style="text-align: center">
                                    <strong class="text-uppercase"><img :src="urlImg(special.speciality_data)"
                                                                        width="120" height="120"></strong><br>
                                </div>
                                <div class="fluid">
                                    <ul>
                                        <li><strong class="text-uppercase">Especialidad : </strong>
                                            {{special.speciality_data.name}}
                                        </li>
                                        <li><strong class="text-uppercase">Fecha Finalización: </strong> {{special.date
                                            }}
                                        </li>
                                        <li v-if="special.instructor"><strong
                                            class="text-uppercase">Instructor: </strong> {{special.instructor.name }}
                                            {{special.instructor.last }}
                                        </li>
                                        <li v-else><strong class="text-uppercase">Instructor: </strong>
                                            {{special.other_instructor }}
                                        </li>
                                        <li><strong class="text-uppercase">Iglesia: </strong> {{special.church.name}}
                                        </li>
                                    </ul>
                                </div>
                                <hr>
                            </div>


                        </div>
                    </div>
                </div>
                <div id="demo-lft-tab-4" class="tab-pane fade">
                    <p class="text-main text-semibold">Lider Juvenil</p>
                    <p>No Tiene Registros</p>
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
        props: ['specialities', 'member'],
        components: {vSelect, myDatepicker, Swal},
        data() {
            return {
                data: {
                    name: '',
                    last_name: '',
                    address: '',
                    phone: '',
                    email: '',
                },
                user: '',

            }
        },
        created() {

            var self = this;
            // this.specialty = JSON.parse(this.specialities);
            console.log('prueba' + this.specialities);
            this.$http.get("/softadventist/datos-user-connet").then((response) => {
                self.user = response.data;


            });
        },
        computed: {
            speciality() {
                return JSON.parse(this.specialities);
            },
            member_data() {
                return JSON.parse(this.member);
            },
        },
        methods: {
            urlImg: function (Sp) {
                return "/img/especialidades/Conquistadores/" + Sp.url_img;
            },
            send: function (event) {
                axios.post('/softadventist/save-visitor', this.data)
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
