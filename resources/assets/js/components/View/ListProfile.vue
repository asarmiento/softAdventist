<template>

    <!---------------------------------->
    <div class="row">
        <div class="col-md-12 ">
            <h1></h1>
        </div>
        <div class="col-sm-4 col-md-3" v-for="items in datos.data">


            <!-- Contact Widget -->
            <!---------------------------------->
            <div class="panel pos-rel">
                <div class="pad-all text-center">

                    <div class="widget-control">
                        <a href="#" class="add-tooltip btn btn-trans" data-original-title="Favorite">
                            <span class="favorite-color text-lg"><i class="demo-psi-star"></i></span>
                            Guia Mayor
                        </a>
                        <a href="#" class="add-tooltip btn btn-trans">
                            Código: C1MG1514
                        </a>
                        <div class="btn-group dropdown">
                            <a href="#" class="dropdown-toggle btn btn-trans" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="pci-ver-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-right" style="">
                                <li><a href="#"><i class="icon-lg icon-fw demo-psi-pen-5"></i> Edit</a></li>
                                <li><a href="#"><i class="icon-lg icon-fw demo-pli-recycling"></i> Remove</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="icon-lg icon-fw demo-pli-mail"></i> Send a Message</a></li>
                                <li><a href="#"><i class="icon-lg icon-fw demo-pli-calendar-4"></i> View Details</a>
                                </li>
                                <li><a href="#"><i class="icon-lg icon-fw demo-pli-lock-user"></i> Lock</a></li>
                            </ul>
                        </div>
                    </div>

                    <a href="#">
                        <img alt="Profile Picture" class="img-lg img-circle mar-ver" src="/img/profile-photos/2.png">
                        <p class="text-lg text-semibold mar-no text-main">{{(items.member)}}</p>
                        <p class="text-sm">Iglesia: {{items.church}}</p>
                        <p class="text-sm"><a href="/softadventist/perfile-clubes">Lista de Especialidades</a></p>
                    </a>
                    <div class="pad-top btn-groups" v-if="items.club">
                        <a href="#" v-for="card in items.club" class="btn btn-icon  icon-lg add-tooltip"
                           data-container="body">
                            <img :src="urlButton(card)" width="50" height="50">
                        </a>

                    </div>
                </div>
            </div>
            <!---------------------------------->


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
                },
                txtSearch: '',
                counts: ['5', '10', '20', '50'],
                datos: [],
                my_pages: [],
                columns: [],
                typeAll: true,
                typeStyle: true,

            }
        },
        created() {

            var self = this;
            this.$http.get("/softadventist/data-member-tarjetas").then((response) => {
                self.datos = response.data.model;

               // self.my_pages = response.data.my_pages;
               // self.columns = response.data.columns;
            });

        },
        methods: {
            urlButton(card) {
                return "/img/Botones/" + card.name + ".gif";
            },
            nameComplate(member) {
                return member;
            },
            send: function (event) {
                axios.post('/softadventist/save-visitor', this.data)
                    .then(response => {
                        if (response.data.success = true) {
                            Swal('Se Guardo con Exito!!!', response.data.message, 'success');

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
