<template>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div id="newMembers" class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center " >
                            <h1 >Registrar Directores de Clubes </h1>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Seleccione un Miembro </label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                    <v-select v-model="data.member" :options="listMembers"></v-select>
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Clubes</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <v-select v-model="data.club" :options="listClubs"  ></v-select>
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Código de Lider Juvenil</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                                    <input type="text" v-model="data.code_lj" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Fecha Bautizmo</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="date" v-model="data.bautizmoDate" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Fecha de Investidura</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                    <input type="date" v-model="data.date" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12  text-center">
                            <div class="btn">
                                <button   v-on:click="send"  class="btn btn-success">Guardar</button>
                            </div>
                        </div>
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
                         code_gm: '',
                         member: '',
                         club: '',
                         date: '',
                         club_director: '',
                         address: '',
                         civil_status: '',
                         phone: '',
                         cell: '',
                         email: '',
                     },
                     listMembers:"",
                     listClubs:"",
                     civil:[
                         {"label":'Casado(a)',"value":'Casado(a)'},
                         {"label":'Soltero(a)',"value":'Soltero(a)'},
                         {"label":'Divorciado(a)',"value":'Divorciado(a)'},
                         {"label":'Viudo(a)',"value":'Viudo(a)'},
                         {"label":'Union Libre',"value":'Union Libre'},

                     ]
                 }
            }, created() {
            this.$http.get('/softadventist/lista-miembros-select').then((response) => {
                this.listMembers = response.data;

            });
            this.$http.get('/softadventist/lista-club-select').then((response) => {
                this.listClubs = response.data;

            });

        },
        methods: {

            send: function (event) {
                if(this.data.civil_status === ""){
                    Swal('Debe Elegir un Estado Civil', 'No se puede proceder','error');
                    return false;
                }
                axios.post('/softadventist/save-miembros', this.data)
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
