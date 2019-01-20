<template>

    <!---------------------------------->
    <div class="row">
    <div class="tab-base">
            <div><h1>Brenda Fuller</h1></div>
        <!--Nav Tabs-->
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#demo-lft-tab-1">Aventurero </a>
            </li>
            <li>
                <a data-toggle="tab" href="#demo-lft-tab-2">Conquistadores <span class="badge badge-purple">3</span></a>
            </li>
            <li>
                <a data-toggle="tab" href="#demo-lft-tab-3">Guias Mayores</a>
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
                <p class="text-main text-semibold">Conquistadores</p>
                <div class="panel">
                    <div class="panel-body demo-liquid-fixed">
                        <div class="fixed-fluid">
                            <div class="fixed-sm-250 pull-sm-left" style="text-align: center">
                                <strong class="text-uppercase"><img src="/img/especialidades/apicultura.gif" width="120" height="100"></strong><br>
                            </div>
                            <div class="fluid">
                                <ul>
                                <li><strong class="text-uppercase">Especialidad : </strong> Apicultura</li>
                                <li><strong class="text-uppercase">Fecha Finalización: </strong> 2001-09-25</li>
                                <li><strong class="text-uppercase">Instructor: </strong> Carlos Alvarado </li>
                                <li><strong class="text-uppercase">Iglesia: </strong> Central San Jose </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="fixed-fluid">
                            <div class="fixed-sm-250 pull-sm-left" style="text-align: center">
                                <strong class="text-uppercase"><img src="/img/especialidades/administración.png" width="120" height="100"></strong><br>
                            </div>
                            <div class="fluid">
                                <ul>
                                <li><strong class="text-uppercase">Especialidad : </strong> Administración</li>
                                <li><strong class="text-uppercase">Fecha Finalización: </strong> 1998-09-25</li>
                                <li><strong class="text-uppercase">Instructor: </strong> Glenn Mora </li>
                                <li><strong class="text-uppercase">Iglesia: </strong> Hatillo </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="fixed-fluid">
                            <div class="fixed-sm-250 pull-sm-left" style="text-align: center">
                                <strong class="text-uppercase"><img src="/img/especialidades/internet-ay-honor_orig.png" width="120" height="100"></strong><br>
                            </div>
                            <div class="fluid">
                                <ul>
                                <li><strong class="text-uppercase">Especialidad : </strong> Internet</li>
                                <li><strong class="text-uppercase">Fecha Finalización: </strong> 2009-10-25</li>
                                <li><strong class="text-uppercase">Instructor: </strong> Edy Echenique </li>
                                <li><strong class="text-uppercase">Iglesia: </strong> UNADECA </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div id="demo-lft-tab-3" class="tab-pane fade">
                <p class="text-main text-semibold">Guias Mayores</p>
                <p>No Tiene Registros</p>
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
    import myDatepicker  from "vue-datepicker";

    export default {
        components: {vSelect, myDatepicker,Swal},
        data () {
                 return   {
                     data: {
                         name: '',
                         last_name: '',
                         address: '',
                         phone: '',
                         email: '',
                     },

                 }
            },
        methods: {
            send: function (event) {
                axios.post('/softadventist/save-visitor', this.data)
                    .then(response => {
                        if(response.data.success = true){
                            Swal('Se Guardo con Exito!!!', response.data.message,'success');
                            this.data.charter= '';
                            this.data.name= '';
                            this.data.last= '';
                            this.data.bautizmoDate= '';
                            this.data.birthdate= '';
                            this.data.address= '';
                            this.data.civil_status= '';
                            this.data.phone= '';
                            this.data.cell= '';
                            this.data.email='';
                        }
                    })
                .catch(function (error) {
                    if (error.response) {
                        let data = error.response.data;
                        if(error.response.status === 422)
                        {
                            for(var index in data)
                            {
                                var messages = '';
                                data[index].forEach( function(item){ messages += item + ' '});
                                self.errors[index] = messages;
                            }
                        }else if(error.response.status === 401){
                            self.errors.response.invalid = true;
                            self.errors.response.msg = data.msg.message;
                        }else if(error.response.status === 500)
                        {
                            console.log(data);
                            for(var index in data)
                            {
                                var messages = '';
                                data[index].forEach( function(item){ messages += item + ' '});
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

<style >

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
