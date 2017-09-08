<template>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div id="newMembers" class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center " >
                            <h1 >Nuevo de Miembro </h1>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Cedula</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                    <input type="text" v-model="data.charter"  class="form-control" >
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
                                    <input type="text" v-model="data.last" class="form-control" >
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
                                <label>Fecha Nacimiento</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                    <input type="date" v-model="data.birthdate" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Telefono</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" v-model="data.phone" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Celular</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                                    <input type="text" v-model="data.cell" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Email</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-send"></i></span>
                                    <input type="text" v-model="data.email" class="form-control" >
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

    export default {
            data () {
                 return   {
                     data: {
                         charter: '',
                         name: '',
                         last: '',
                         bautizmoDate: '',
                         birthdate: '',
                         phone: '',
                         cell: '',
                         email: '',
                     }
                 }
            },
        methods: {
            send: function (event) {
                axios.post('/tesoreria/save-miembros', this.data)
                    .then(response => {
                        if(response.data.success = true){
                            this.$alert({title: 'Se Guardo con Exito!!!',
                            message: response.data.message});
                            this.data.charter= '';
                            this.data.name= '';
                            this.data.last= '';
                            this.data.bautizmoDate= '';
                            this.data.birthdate= '';
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

<style scoped>

    .mostrar {
        display: block;
    }
</style>
