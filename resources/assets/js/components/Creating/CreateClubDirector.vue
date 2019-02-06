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
                        <!--div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Código de Guia Mayor</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                                    <input type="text" v-model="data.code_gm" class="form-control" >
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
                        </div-->
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Iglesia a la que Pertenece</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <v-select v-model="data.church" :options="listChurches"  ></v-select>
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
                         member: '',
                         club: '',
                         church: '',
                     },
                     listMembers:"",
                     listChurches:"",
                     listClubs:"",
                     director:""
                 }
            }, created() {
            this.$http.get('/softadventist/lista-miembros-select-campo').then((response) => {
                this.listMembers = response.data;

            });
            this.$http.get('/softadventist/lista-club-select').then((response) => {
                this.listClubs = response.data;

            });
            this.$http.get('/softadventist/lista-churchs-select-campos').then((response) => {
                this.listChurches = response.data;

            });

        },
        methods: {

            send: function (event) {

                axios.post('/softadventist/store-directores-de-clubes', this.data)
                    .then(response => {
                        if(response.data.success = true){
                            Swal('Se Guardo con Exito!!!', response.data.message,'success');
                            this.director = response.data.directors
                            this.member= '';
                                this.club= '';
                                this.church= '';
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
