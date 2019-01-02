<template>
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="form-group pad-ver">
                        <label class="col-md-3 control-label">Debe Elegir el Tipo de Transferencia</label>
                        <div class="col-md-9">
                            <div class="radio">
                                <!-- Inline radio buttons -->
                                <input id="demo-inline-form-radio" class="magic-radio" type="radio"
                                       name="inline-form-radio" @click="typeRadio('info')">
                                <label for="demo-inline-form-radio">Por Error En el Informe Semanal</label>

                                <input id="demo-inline-form-radio-2"  @click="typeRadio('vote')"
                                       class="magic-radio" type="radio"
                                       name="inline-form-radio">
                                <label for="demo-inline-form-radio-2">Por voto de Junta hacia un departamento</label>
                            </div>
                        </div>
                        <label class="col-md-3 control-label">
                            <p><strong>Informe semanal: </strong>al hacer una transferencia de un informe cambiara el
                                mismo.
                                tener en cuenta que si el informe ya fue reportado al campo local se debe adjuntar el
                                deposito en caso que sea a favor del
                                campo, de lo contrario el sistema lo rebajara en el proximo deposito de informes.</p>
                        </label>
                        <label class="col-md-3 control-label">
                            <p><strong>Voto de Junta: </strong>para que una transferencia se haga efectiva debe
                                aprobarla el
                                pastor de la iglesia y la secretario(a). Ellos deben ingresar con sus datos y veran que
                                tienen una notificación en la
                                campanita una vez que el pastor y el secretario(a) hayan aprobado el sistema ejecutara
                                la transferencia.</p>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div  class="col-md-12 col-md-offset-0">
            <div v-if="type" class="panel panel-default">
                <div class="panel-heading">
                    <div class="form-group pad-ver">
                        <label class="col-md-3 control-label">Debe Elegir el Tipo de Transferencia</label>
                        <div class="col-md-9">
                            <div class="radio">
                                <!-- Inline radio buttons -->
                                <input id="inline-form-radio-info-2" class="magic-radio" type="radio"
                                       name="inline-form-radio-info" @click="typeRadio('active')">
                                <label for="inline-form-radio-info-2">Informe Semanal ya Reportado al Campo
                                    local</label>

                                <input id="inline-form-radio-info-3" @click="typeRadio('desactive')" class="magic-radio"
                                       type="radio"
                                       name="inline-form-radio-info">
                                <label for="inline-form-radio-info-3">Informe Semanal si reportar al campo local</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-md-offset-0">
                <div id="newAccountExpense" class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center ">
                            <h1> {{title}} </h1>
                        </div>
                    </div>
                    <div  class="panel-body">
                        <div v-if="report === 'active'" class=" col-lg-3 col-md-3  "
                             :class="{'has-feedback has-error':errors.income_account.length > 0}">
                            <div class="panel-default ">
                                <label :for="data.income_account">Informe Semanal Reportados </label>
                                <div class="input-group ">
                                    <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                    <v-select v-model="data.income_account" :on-change="onChange" :options="infosReport"></v-select>
                                </div>
                                <small class="help-block">{{errors.income_account}}</small>
                            </div>
                        </div>
                        <div v-if="report === 'desactive'" class=" col-lg-3 col-md-3  "
                             :class="{'has-feedback has-error':errors.income_account.length > 0}">
                            <div class="panel-default ">
                                <label :for="data.income_account">Informe Semanal sin Reportar</label>
                                <div class="input-group ">
                                    <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                    <v-select v-model="data.income_account" :on-change="onChange" :options="infosSinReport"></v-select>
                                </div>
                                <small class="help-block">{{errors.income_account}}</small>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <!--div  class="col-md-12 col-md-offset-0">
            <div id="newAccountExpense" class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-center ">
                        <h1> {{title}} </h1>
                    </div>
                </div>
                <div class="panel-body">
                    <div class=" col-lg-3 col-md-3  "
                         :class="{'has-feedback has-error':errors.income_account.length > 0}">
                        <div class="panel-default ">
                            <label :for="data.income_account">Informe Semanal</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <v-select v-model="data.income_account" :options="infos"></v-select>
                            </div>
                            <small class="help-block">{{errors.income_account}}</small>
                        </div>
                    </div>
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


                    <div class="col-lg-12 col-md-12  text-center">
                        <div class="btn">
                            <button v-on:click="send" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div-->
    </div>

</template>

<script>
    import vSelect from "vue-select"

    export default {
        props: ['title', 'url'],
        components: {vSelect},
        data() {
            return {
                data: {
                    name: '',
                    income_account: '',
                },
                errors: {
                    name: '',
                    income_account: '',
                },
                infosReport: [],
                infosSinReport: [],
                info: '',
                report: null,
                type: '',
            }
        },
        computed: {
            select() {
                // return  JSON.parse(this.accounts)
            },
        },
        created() {
            this.$http.get('/softadventist/lista-informes-reportados')
                .then((response) => {
                    this.infosReport = response.data;
            });
            this.$http.get('/softadventist/lista-informes-sin-reportados')
                .then((response) => {
                    this.infosSinReport = response.data;
                });
        },
        methods: {
            typeRadio: function (data) {
                console.log(data)
                if (data === 'info') {
                    this.type = true;
                } else if (data === 'vote') {
                    this.type = false;
                } else if (data === 'active') {
                    this.report = 'active';
                    this.data.income_account = '';
                } else if (data === 'desactive') {
                    this.report = 'desactive';
                    this.data.income_account = '';
                }
            },
            onChange: function () {
                console.log('hola')
            },
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
                            this.data.income_account_id = '';
                            this.errors.name = '';
                            this.errors.income_account_id = '';
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

