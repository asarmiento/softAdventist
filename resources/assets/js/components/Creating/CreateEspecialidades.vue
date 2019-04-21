<template>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div id="newMembers" class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center " >
                            <h1 >Nuevo de Usuario </h1>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Cédula</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                    <input type="number" v-model="data.identification_card"  class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Nombres</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" v-model="data.name" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Apellidos</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                                    <input type="text" v-model="data.last_name" class="form-control" >
                                </div>
                            </div>
                        </div>
                       <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Email</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-send"></i></span>
                                    <input type="email" v-model="data.email" class="form-control" >
                                </div>
                            </div>
                        </div>
                       <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Tipo de Usuario</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-terminal"></i></span>
                                    <v-select  v-model="data.type_user" :options="types" class="form-control" ></v-select>
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
                         identification_card: '',
                         name: '',
                         last_name: '',
                         status: 'activo',
                         type_user: '',
                         email: '',
                     },
                     types:[
                         {"label":'Union',"value":'union'},
                         {"label":'Campo Local',"value":'campo'},
                         {"label":'Iglesia',"value":'church'},

                     ]
                 }
            },
        methods: {
            send: function (event) {
                axios.post('/softadventist/store-usuarios', this.data)
                    .then(response => {
                        if(response.data.success = true){
                            Swal('Se Guardo con Exito!!!', response.data.message,'success');
                            this.data.name= '';
                            this.data.last_name= '';
                            this.data.identification_card= '';
                            this.data.type_user= '';
                            this.data.status= 'activo';
                            this.data.email='';
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
                                Swal('!Ooop',error.response.data.message,'error');
                            } else if (error.response.status === 401) {
                                Swal('!Ooop',error.response.data.message,'error');
                            } else if (error.response.status === 500) {
                                Swal('!Ooop',error.response.data.message,'error');
                            }
                        } else if (error.request) {
                            Swal('!Ooop',error.response.data.message,'error');
                        } else {
                            Swal('!Ooop',error.response.data.message,'error');
                        }
                    });
            }
        },



    }
</script>

<style scoped>

    .mostrar {
        display: block;
    }
</style>
