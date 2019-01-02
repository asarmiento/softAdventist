<template>

    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div id="newMembers" class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-center ">
                        <h1>Asignar nuevo Cargo </h1>
                    </div>
                </div>
                <div class="panel-body">
                    <div class=" col-lg-4 col-md-4 ">
                        <div class="panel-default ">
                            <label>Usuario: </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <v-select v-model="data.user" :options="users" ></v-select>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-4 col-md-4 ">
                        <div class="panel-default ">
                            <label>Cargo</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <v-select v-model="data.cargo" :options="cargos" ></v-select>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-4 col-md-4 ">
                        <div class="panel-default ">
                            <label>Uniones</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                                <v-select v-model="data.union" :options="unions" ></v-select>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-6 ">
                        <div class="panel-default ">
                            <label>Iglesias</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <v-select v-model="data.church" :options="churchs" ></v-select>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-6 ">
                        <div class="panel-default ">
                            <label>Campo Local</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <v-select v-model="data.local" :options="locals" ></v-select>
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
    </div>

</template>

<script>
    import vSelect from "vue-select";
    import Swal from 'sweetalert2'
    import myDatepicker  from "vue-datepicker";

    export default {
        components: {vSelect, myDatepicker,Swal},
        data() {
            return {
                data: {
                    union: '',
                    local: '',
                    cargo: '',
                    church: '',
                    user: '',
                },
                users:"",
                churchs:"",
                unions:"",
                locals:"",
                cargos:[
                    {"label":"presidente","value":"Presidente"},
                    {"label":"tesorero","value":"tesorero"},
                    {"label":"secretario","value":"secretario"},
                    {"label":"departamental","value":"departamental"},
                    {"label":"pastor","value":"pastor"},
                    {"label":"director","value":"director"},
                    {"label":"digitador","value":"digitador"},
                    {"label":"miembro","value":"miembro"},
                ],
            }
        }, created() {
            this.$http.get('/softadventist/lista-user-select')
                .then((response) => {
                    this.users = response.data;
                });

            this.$http.get('/softadventist/lista-churchs-select')
                .then((response) => {
                    this.churchs = response.data;
                });
            this.$http.get('/softadventist/lista-unions-select')
                .then((response) => {
                    this.unions = response.data;
                });
            this.$http.get('/softadventist/lista-local-select')
                .then((response) => {
                    this.locals = response.data;
                });
        },
        methods: {
            send: function (event) {
                axios.post('/softadventist/nuevo-cargo-usuario', this.data)
                    .then(response => {
                        if (response.data.success = true) {
                           Swal('Se Guardo Con Exito!!','Buen Trabajo','success');
                            this.data.church = '';
                            this.data.union = '';
                            this.data.cargo = '';
                            this.data.local = '';
                            this.data.user = '';
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

<style scoped>

    .mostrar {
        display: block;
    }
</style>
