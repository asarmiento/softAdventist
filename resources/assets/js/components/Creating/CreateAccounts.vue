<template>
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div id="newMembers" class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-center ">
                        <h1> {{title}} </h1>
                    </div>
                </div>
                <div class="panel-body">
                    <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.name.length > 0}">
                        <div class="panel-default ">
                            <label>Nombre</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <input type="text" v-model="data.name" class="form-control">
                            </div>
                            <small class="help-block">{{errors.name}}</small>
                        </div>
                    </div>

                    <div class=" col-lg-3 col-md-3  "
                         :class="{'has-feedback has-error':errors.departament_id.length > 0}">
                        <div class="panel-default ">
                            <label>{{relation}}</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <v-select v-model="data.departament_id" :options="select"></v-select>
                            </div>
                            <small class="help-block">{{errors.departament_id}}</small>
                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12  text-center">
                        <div class="btn">
                            <button v-on:click="send" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8  text-center ">
                        <p class="box-info"><strong>Nota: </strong>
                        <ul class="box-list">
                            <li><i>Aqui puede crear las cuentas de ingreso necesarias para su iglesia. </i></li>
                            <li><i>Cada cuenta de ingreso se le creara automaticamente una cuenta de gastos con el mismo
                                nombre.
                            </i></li>
                            <li><i>Todas las cuentas de ingreso pueden tener mas de una cuenta de gasto si asi lo necesita la
                                iglesia.
                            </i></li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import vSelect from "vue-select"

    export default {
        props: ['title', 'url', 'contents', 'relation'],
        components: {vSelect},
        data() {
            return {
                data: {
                    name: '',
                    departament_id: null,
                    checkedNames: '',
                },
                errors: {
                    name: '',
                    departament_id: '',
                    type: '',
                }
            }
        },
        computed: {
            select() {
                return JSON.parse(this.contents)
            },
        },
        created() {
            var optionsSelect = [];
            console.log(JSON.parse(this.contents));
        },
        methods: {
            send: function (event) {
                console.log(this.data.selected);
                var self = this;
                axios.post('/softadventist/' + self.url, this.data)
                    .then(response => {
                        if (response.data.success = true) {
                            this.$alert({
                                title: 'Se Guardo con Exito!!!',
                                message: response.data.message
                            });
                            this.data.name = '';
                            this.data.departament_id = '';
                            this.errors.name = '';
                            this.errors.departament_id = '';
                        }
                    }).catch(function (error) {
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

    .box-info {
        font-size: 24px;
        margin: 0 auto;
        background-color: #00b3ca;
        border-color: #00bcd4;
        color: #fff;
        border-radius: 10px;

    }

    .box-list {
        list-style-type: circle;
        text-align: left;
        font-weight: bold;
        font-size: 14px;
    }
</style>
