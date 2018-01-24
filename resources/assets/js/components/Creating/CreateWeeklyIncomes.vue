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
                    <div class=" col-lg-3 col-md-3  ">
                        <h3>Control Interno # <strong class="blue">{{rows.number}}</strong></h3>
                    </div>
                    <div class=" col-lg-3 col-md-3  ">
                        <h3>Total Registrado <strong> {{rows.balance | moneyFormat }}</strong> Colones</h3>
                    </div>
                    <div class=" col-lg-3 col-md-3  ">
                        <h3>En <strong>{{rows.number_of_envelopes }} </strong> sobres de Diezmos y ofrendas</h3>
                    </div>
                    <div class=" col-lg-3 col-md-3  ">
                        <h3>El sabado <strong>{{rows.saturday}}</strong></h3>
                    </div>
                    <div class=" col-lg-6 col-md-6 ">
                        <div style="height: 30px; width:300px;" class="progress progress-striped active">
                            <div style="width:100%;  font-size:24px" class="progress-bar progress-bar-warning">A
                                Registrado {{totalRows }} Sobres
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-6 ">
                        <div style="height: 30px; width:300px;" class="progress progress-striped active">
                            <div style="width:100%;  font-size:24px" class="progress-bar progress-bar-success">Con un
                                total de {{totalBalance | moneyFormat }}
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-12 col-md-12  ">
                        <hr>
                        </hr>
                        <hr>
                        </hr>
                    </div>
                    <div class=" col-lg-3 col-md-3 " :class="{'has-feedback has-error':errors.member_id.length > 0}">
                        <div class="panel-default ">
                            <label>Nombre del Sobre de Diezmos</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <v-select v-model="data.member_id" :options="dataMembers"
                                          placeholder="Seleccione un miembro"></v-select>
                            </div>
                            <small class="help-block">{{errors.member_id}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-2 col-md-2  "
                         :class="{'has-feedback has-error':errors.envelope_number.length > 0}">
                        <div class="panel-default ">
                            <label>Numero de Sobre</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-cog"></i></span>
                                <input type="number" v-model="data.envelope_number" class="form-control">
                                
                            </div>
                            <small class="help-block">{{errors.envelope_number}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-2 col-md-2  " :class="{'has-feedback has-error':errors.tithes.length > 0}">
                        <div class="panel-default ">
                            <label>Diezmos</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-cog"></i></span>
                                <input type="number" v-model="data.tithes" class="form-control">
                            </div>
                            <small class="help-block">{{errors.tithes}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-2 col-md-2  " :class="{'has-feedback has-error':errors.offering.length > 0}">
                        <div class="panel-default ">
                            <label>Ofrendas</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-cog"></i></span>
                                <input type="number" v-model="data.offering" class="form-control">
                            </div>
                            <small class="help-block">{{errors.offering}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-2 col-md-2  "
                         :class="{'has-feedback has-error':errors.background_inversion.length > 0}">
                        <div class="panel-default ">
                            <label>Fondo de Inversion</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-cog"></i></span>
                                <input type="number" v-model="data.background_inversion" class="form-control">
                            </div>
                            <small class="help-block">{{errors.background_inversion}}</small>
                        </div>
                    </div>
                    <div class="rows">
                        <div class="col-md-6 col-lg-4 eq-box-lg">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Ingresos para el Campo Local </h3>
                                </div>
                                <div class="panel-body">
                                    <!--Large-->
                                    <!--===================================================-->
                                    <div class="list-group">
                                        <div class="list-group-item list-item-lg">
                                            <input type="number" id="demo-vs-definput" v-model="campo.balance"
                                                   placeholder="0.00" class="form-control border">
                                            <v-select v-model="campo.church_l_f_income_account_id"
                                                      :options="data_account_local_fields"
                                                      placeholder="Seleccione una Cuenta"></v-select>
                                            <a class="demo-icon btn btn-success" v-on:click="sendCampo"><i
                                                    class="fa fa-plus"></i> <span> </span> Agregar</a>
                                        </div>
                                        <div v-for="(listAccountCampo,index) in temp_local_field_incomes"
                                             class="list-group-item list-item-lg">
                                            <label class="left " style="width: 60%">{{listAccountCampo.church_l_f_income_account.local_field_income_account.name}}</label>
                                            <label style="width: 20%" class="right">{{listAccountCampo.balance}}</label>
                                            <a style="width: 10%" @click="removeCampo(listAccountCampo,index)"
                                               class="btn btn-danger"><span class="fa fa-remove"></span></a>
                                        </div>

                                    </div>
                                    <!--===================================================-->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 eq-box-lg">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Otros Ingresos para la Iglesia</h3>
                                </div>
                                <div class="panel-body">
                                    <!--Large-->
                                    <!--===================================================-->
                                    <div class="list-group">
                                        <div class="list-group-item list-item-lg">
                                            <input type="text" v-model="church.balance" placeholder="0.00"
                                                   class="form-control border">
                                            <v-select :options="dataAccount_incomes" v-model="church.income_account_id"
                                                      placeholder="Seleccione una Cuenta"></v-select>
                                            <a class="demo-icon btn btn-success" v-on:click="sendIglesia"><i
                                                    class="fa fa-plus"></i> <span> </span> Agregar</a>
                                        </div>

                                        <div v-for="(temp_income,index) in temp_incomes"
                                             class="list-group-item list-item-lg">

                                            <label class="left "
                                                   style="width: 60%">{{temp_income.income_account.name}}</label>
                                            <label style="width: 20%" class="right">{{temp_income.balance}}</label>
                                            <a style="width: 10%" @click="removeChurch(temp_incomes,index)"
                                               class="btn btn-danger"><span class="fa fa-remove"></span></a>
                                        </div>
                                    </div>
                                    <!--===================================================-->

                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="result"></div>
                    <div v-else class="col-lg-12 col-md-12  text-center">
                        <div class="btn">
                            <button v-on:click="send" class="btn btn-success">Agregar Sobre</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-heading">
                <div class="panel-body">
                    <div class="bootstrap-table">

                        <div class="fixed-table-container" style="padding-bottom: 0px;">

                            <div class="fixed-table-body">

                                <table id="demo-custom-toolbar" class="demo-add-niftycheck table table-hover"
                                       data-toggle="table" data-url="data/bs-table.json" data-toolbar="#demo-delete-row"
                                       data-search="true" data-show-refresh="true" data-show-toggle="true"
                                       data-show-columns="true" data-sort-name="id" data-page-list="[5, 10, 20]"
                                       data-page-size="5" data-pagination="true" data-show-pagination-switch="true"
                                       style="margin-top: 0px;">
                                    <thead style="">
                                    <tr>
                                        <th>Eliminar</th>
                                        <th v-for="(title, titleM) in titleMembers" style="" :data-field="titleM"
                                            tabindex="0">
                                            <div class="th-inner sortable both asc">{{title}}</div>
                                            <div class="fht-cell"></div>
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(member, indexM) in listMembers" :data-index="indexM">
                                        <td class="bs-checkbox ">
                                            <a @click="removeline(member,indexM)" class="btn btn-danger"><span
                                                    class="fa fa-remove"></span></a>
                                        </td>
                                        <td v-for="dmember in member.datos">
                                            <div>{{dmember}}</div>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div><div class="clearfix"></div>
                    <div  class="row col-lg-12 col-md-12  text-center">
                        <div class="btn">
                            <button v-on:click="finish(rows.saturday)" class="btn btn-success">Finalizar Informe</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</template>

<script>
    import vSelect from "vue-select";
    import {Confirm} from '@lassehaslev/vue-confirm';
    import numeral from 'numeral';

    export default {
        props: [
            'title',
            'internalcontrol',
            'members',
            'account_incomes',
            'account_local_fields',
        ],
        components: {vSelect},
        data() {
            return {
                data: {
                    member_id: null,
                    envelope_number: '',
                    tithes: '',
                    offering: '',
                    background_inversion: '',
                    internal_control_id: '',
                },
                campo: {
                    balance: '',
                    church_l_f_income_account_id: '',
                },
                church: {
                    balance: '',
                    income_account_id: '',
                },
                listsCampo: [{}],
                listsChurch: [{}],
                listMembers: [],
                titleMembers: [],
                titlenew: [],
                temp_local_field_incomes: [],
                temp_incomes: [],
                totalRows: '',
                totalBalance: '',
                totalRowsW: '',
                totalBalanceW: '',
                btSelectAll: [],
                rowsTotal: '',
                result: '',
                errors: {
                    member_id: '',
                    envelope_number: '',
                    tithes: '',
                    offering: '',
                    background_inversion: '',
                    church_l_f_income_account_id: '',
                }
            }
        },
        created() {
           this.$http.get('/tesoreria/list-member-weekly/'+this.rows.saturday)
                .then((response) => {
                    this.listMembers = response.data.infoWeeklys;
                    this.totalBalance = response.data.totalBalance;
                    this.data.internal_control_id = response.data.id;
                    this.totalRows = response.data.totalRows;
                    this.temp_local_field_incomes = response.data.tempLocalFieldIncomes;
                    this.temp_incomes = response.data.tempIncomes;
                    this.titleMembers = response.data.title;
                });
            this.$http.get('/tesoreria/check-finish-info/'+this.rows.token)
                .then((response) => {
                    this.result = response.data.success;
                });

        },
        computed: {
            rows() {
                return JSON.parse(this.internalcontrol);
            },
            internal() {
                var dato = JSON.parse(this.internalcontrol);
                return this.data.internal_control_id = dato.id;
            },
            dataMembers() {
                return JSON.parse(this.members);
            },
            dataAccount_incomes() {
                return JSON.parse(this.account_incomes);
            },
            data_account_local_fields() {
                return JSON.parse(this.account_local_fields);
            },
            statusRows() {
                return rows.number_of_envelopes - this.totalRows;
            },
        },

        methods: {
            send: function (event) {
                var self = this;
                axios.post('/tesoreria/save-weekly-incomes', this.data)
                    .then(response => {
                        if (response.data.success = true) {
                            self.listMembers.push(response.data.newMember[0]);
                            self.titleMembers = response.data.title
                            self.totalBalance = response.data.totalBalance;
                            self.totalRows = response.data.totalRows;
                            if (response.data.result.success) {
                                self.result = response.data.result
                            }
                            this.temp_local_field_incomes = [];
                            this.temp_incomes = [];

                            this.data.member_id = '';
                            this.data.envelope_number = '';
                            this.data.tithes = '';
                            this.data.offering = '';
                            this.data.background_inversion = '';
                            this.errors.member_id = '';
                            this.errors.background_inversion = '';
                            this.errors.envelope_number = '';
                            this.errors.tithes = '';
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
            },
            sendCampo: function (event) {
                event.preventDefault();
                var self = this;
                axios.post('/tesoreria/save-campo-temp-income', this.campo)
                    .then(response => {
                        console.log(response.data.account)
                        this.temp_local_field_incomes.push(response.data.account);
                        this.campo.balance = '';
                        this.campo.church_l_f_income_account_id = '';
                        this.errors.balance = '';
                        this.errors.church_l_f_income_account_id = '';

                    }).catch(function (error) {
                    if (error.response) {
                        let data = error.response.campo;
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
            },
            removeCampo: function (Campo, index, event) {
                var self = this;
                axios.post('/tesoreria/remove-campo-temp-income', Campo)
                    .then(response => {
                        this.temp_local_field_incomes.splice(index, 1);
                    }).catch(function (error) {
                    if (error.response) {
                        let data = error.response.campo;
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
            },
            sendIglesia: function (event) {
                event.preventDefault();
                var self = this;
                axios.post('/tesoreria/save-iglesia-temp-income', this.church)
                    .then(response => {
                        self.temp_incomes.push(response.data.account);
                        this.church.balance = '';
                        this.church.income_account_id = '';
                        this.errors.balance = '';
                        this.errors.income_account_id = '';

                    }).catch(function (error) {
                    if (error.response) {
                        let data = error.response.campo;
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
            },
            removeChurch: function (Church, index, event) {
                var self = this;
                axios.post('/tesoreria/remove-iglesia-temp-income', Church)
                    .then(response => {
                        self.temp_incomes.splice(index, 1);
                    }).catch(function (error) {
                    if (error.response) {
                        let data = error.response.campo;
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
            },
            removeline: function (line, index, event) {
                var self = this;
                axios.post('/tesoreria/remove-line-income', line)
                    .then(response => {
                        self.result = response.data.message.success
                        self.listMembers.splice(index, 1);

                    }).catch(function (error) {
                    if (error.response) {
                        let data = error.response.campo;
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
            },
            finish: function (saturday, event) {

                var self = this;
                axios.post('/tesoreria/finish-info-income', {'saturday':saturday})
                    .then(response => {
                        if (response.data.success) {
                            ///this.$route.route.go('tesoreria/registro-control-interno');
                            document.location = '/tesoreria/registro-control-interno';
                        }
                    }).catch(function (error) {
                    if (error.response) {
                        let data = error.response.campo;
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
            },
        },
        filters: {
            moneyFormat: function (value) {
                return numeral(value).format(' 0,0.00');
            },
            totalRow: function (value) {
                return totalRow;
            }
        }

    }
</script>

<style scoped>


</style>
