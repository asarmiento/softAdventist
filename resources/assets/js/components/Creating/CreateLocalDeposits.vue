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
                    <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.number.length > 0}">
                        <div class="panel-default ">
                            <label>Numero del Deposito</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                <input type="text" v-model="data.number" class="form-control">
                            </div>
                            <small class="help-block">{{errors.number}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.date.length > 0}">
                        <div class="panel-default ">
                            <label>Fecha del Deposito</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" v-model="data.date" class="form-control">
                            </div>
                            <small class="help-block">{{errors.date}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.balance.length > 0}">
                        <div class="panel-default ">
                            <label>Monto del Deposito</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="number" v-model="data.balance" class="form-control">
                            </div>
                            <small class="help-block">{{errors.balance}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.bank_id.length > 0}">
                        <div class="panel-default ">
                            <label for="bank_id">Cuenta Bancaria</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                                <v-select id="bank_id" v-model="data.bank_id" :options="all_banks"></v-select>
                            </div>
                            <small class="help-block">{{errors.bank_id}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-8 col-md-8  "
                         :class="{'has-feedback has-error':errors.internal_control_id.length > 0}">
                        <div class="panel-default ">
                            <label>Informes Semanales</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <v-select placeholder="Seleccione los Informes Reportados en este deposito" multiple
                                          class="chosen-container chosen-container-multi chosen-with-drop chosen-container-active"
                                          v-model="data.internal_control_id" :options="internals"
                                          :on-change="balance_info"></v-select>
                            </div>
                            <small class="help-block">{{errors.internal_control_id}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.total.length > 0}">
                        <div class="panel-default ">
                            <label>Total de los Informes Semanales</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <input type="text" readonly v-model="data.total" value="inform" class="form-control">
                            </div>
                            <small class="help-block">{{errors.total}}</small>
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
        <div class="col-md-12 col-md-offset-0">

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Lista de Depositos Cuentas del Campo Local</h3>
                </div>

                <div class="panel-body">
                    <div id="demo-dt-delete_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div id="demo-dt-delete_filter" class="dataTables_filter">
                            <label>Buscar: <input type="search" class="form-control input-sm" placeholder=""
                                                  aria-controls="demo-dt-delete"></label>
                        </div>
                        <table class="table table-striped table-bordered dataTable no-footer dtr-inline" cellspacing="0"
                               width="100%" role="grid" style="width: 100%;">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1" aria-sort="ascending"></th>
                                <th class="sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1"
                                    aria-sort="ascending" style="width: 7%;">Numero de Deposito
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1">
                                    Fecha
                                </th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1">Monto
                                </th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1">Numero de Cuenta
                                </th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1">Nombre de Cuenta
                                </th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1">Ver
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(deposit, index) in all_depositos" role="row" class="odd">
                                <td class="sorting_1"><a @click="remove_deposits(deposit, index)" target='_blank'
                                                         class='btn btn-danger'>
                                    <i class='fa fa-remove'></i></a></td>
                                <td>{{deposit.number}}</td>
                                <td>{{deposit.date}}</td>
                                <td>{{deposit.balance}}</td>
                                <td>{{deposit.bank.code}}</td>
                                <td>{{deposit.bank.name}}</td>
                                <td><a :href="infos(deposit.token)" target='_blank' class='btn btn-danger'>
                                    <i class='fa fa-file-pdf-o'></i></a></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="dataTables_info" id="demo-dt-delete_info" role="status" aria-live="polite">Showing 1
                            to 10 of 57 entries
                        </div>
                        <div class="dataTables_paginate paging_simple_numbers" id="demo-dt-delete_paginate">
                            <ul class="pagination">
                                <li class="paginate_button previous disabled" aria-controls="demo-dt-delete"
                                    tabindex="0" id="demo-dt-delete_previous"><a href="#"><i
                                        class="demo-psi-arrow-left"></i></a></li>
                                <li class="paginate_button active" aria-controls="demo-dt-delete" tabindex="0"><a
                                        href="#">1</a></li>
                                <li class="paginate_button " aria-controls="demo-dt-delete" tabindex="0"><a
                                        href="#">2</a></li>
                                <li class="paginate_button " aria-controls="demo-dt-delete" tabindex="0"><a
                                        href="#">3</a></li>
                                <li class="paginate_button disabled" aria-controls="demo-dt-delete" tabindex="0"
                                    id="demo-dt-delete_ellipsis"><a href="#">…</a></li>
                                <li class="paginate_button " aria-controls="demo-dt-delete" tabindex="0"><a
                                        href="#">6</a></li>
                                <li class="paginate_button next" aria-controls="demo-dt-delete" tabindex="0"
                                    id="demo-dt-delete_next"><a href="#"><i class="demo-psi-arrow-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import vSelect from "vue-select";
    import myDatepicker  from "vue-datepicker";
    import {Confirm} from '@lassehaslev/vue-confirm';
    import Swal from 'sweetalert2'

    export default {
        props: ['title', 'url', 'banks'],
        components: {vSelect, myDatepicker,Swal},
        data () {
            return {
                data: {
                    number: '',
                    date: '',
                    balance: '',
                    internal_control_id: [],
                    bank_id: '',
                    total: '',

                },
                errors: {
                    number: '',
                    date: '',
                    balance: '',
                    internal_control_id: [],
                    bank_id: '',
                    total: '',
                },
                state: {
                    highlighted: {
                        days: [6], // Highlight Saturday's and Sunday's
                    },
                    disabled: {
                        days: [0, 1, 2, 3, 4, 5],
                    },
                    format: 'yyyy-MM-dd',
                    date: 'yyyy-MM-dd',
                    bootstrapStyling: 'form-control',
                },
                internals: [],
                all_depositos: [],
            }
        },
        computed: {
            all_banks(){
                return JSON.parse(this.banks);
            },
        },
        created(){
            this.$http.get('/softadventist/lista-info-sin-deposito')
                .then((response) => {
                    this.internals = response.data;
                });

            this.$http.get('/softadventist/lista-depositos')
                .then((response) => {
                    this.all_depositos = response.data;
                });
        },
        methods: {
            infos: function (token, event) {

            },
            remove_deposits: function (token, index, event) {
                var self = this;
                axios.post('/softadventist/remove-deposit', token)
                    .then(response => {
                        this.all_depositos.splice(index, 1);
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
            },
            balance_info(val) {
                var self = this;
                if (val) {
                    axios.post('/softadventist/balance-internal-control', val)
                        .then(response => {
                            this.data.total = response.data.balance;
                        }).catch(function (error) {
                    });
                }
            },
            send: function (event) {

                var self = this;
                axios.post('/softadventist/' + self.url, this.data)
                    .then(response => {
                        if (response.data.success = true) {
                            this.internals = response.data.result;
                            this.all_depositos = response.data.deposits;
                            this.data.number = '';
                            this.data.date = '';
                            this.data.balance = '';
                            this.data.internal_control_id = '';
                            this.data.bank_id = '';
                            this.data.total = '';
                            this.errors.number = '';
                            this.errors.date = '';
                            this.errors.balance = '';
                            this.errors.internal_control_id = '';
                            this.errors.bank_id = '';
                            this.errors.total = '';
                            this.$alert({
                                title: 'Se Guardo con Exito!!!',
                                message: response.data.message
                            });
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
