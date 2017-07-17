<template>
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div id="newAccountExpense" class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-center ">
                        <h1> {{title}} </h1>
                    </div>
                </div>
                <div class="panel-body">
                    <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.number.length > 0}">
                        <div class="panel-default ">
                            <label>Numero de Factura</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                                <input type="text" v-model="data.number" class="form-control">
                            </div>
                            <small class="help-block">{{errors.number}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-4 col-md-4  "
                         :class="{'has-feedback has-error':errors.date.length > 0}">
                        <div class="panel-default ">
                            <label>Fecha</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input type="date" v-model="data.date" class="form-control">
                            </div>
                            <small class="help-block">{{errors.date}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3  "
                         :class="{'has-feedback has-error':errors.balance.length > 0}">
                        <div class="panel-default ">
                            <label>Monto a Registrar de la Factura</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <input type="text" v-model="data.balance" class="form-control">
                            </div>
                            <small class="help-block">{{errors.balance}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-6  "
                         :class="{'has-feedback has-error':errors.detail.length > 0}">
                        <div class="panel-default ">
                            <label>Detalle del Gasto</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" v-model="data.detail" class="form-control">
                            </div>
                            <small class="help-block">{{errors.detail}}</small>
                        </div>
                    </div>

                    <div class=" col-lg-4 col-md-4  "
                         :class="{'has-feedback has-error':errors.expense_account.length > 0}">
                        <div class="panel-default ">
                            <label for="data.income_account_id">Cuenta de Gasto</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <v-select v-model="data.expense_account" :options="select"></v-select>
                            </div>
                            <small class="help-block">{{errors.expense_account}}</small>
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
                    <h3 class="panel-title">Lista de gastos sin Cheques</h3>
                </div>

                <div class="panel-body">
                    <div id="demo-dt-delete_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <table id="demo-dt-delete" class="table table-striped table-bordered dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="demo-dt-delete_info" style="width: 100%;">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc"   ></th>
                                <th class="sorting"   >Numero de Factura</th>
                                <th class="sorting"   >Fecha de registro</th>
                                <th class="min-tablet sorting"  >Detalle</th>
                                <th class="min-tablet sorting"  >Cuenta</th>
                                <th class="min-tablet sorting"  >Monto</th>
                                <th class="min-tablet sorting"  ></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="expense in expenses" role="row" class="odd">
                                <td class="sorting_1"><span class="btn btn-danger fa fa-remove"></span></td>
                                <td class="">{{expense.number}}</td>
                                <td>{{expense.date}}</td>
                                <td>{{expense.detail}}</td>
                                <td>{{expense.balance}}</td>
                                <td>{{expense.balance}}</td>
                                <td ><a   target='_blank' class='btn btn-info'>
                                    <i class='fa fa-file-image-o'></i></a></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="col-lg-12 col-md-12  text-center">
                            <div class="btn">
                                <button v-on:click="aplic" class="btn btn-success">Finalizar Registro</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import vSelect from "vue-select"
    export default {
        props: ['title', 'url', 'accounts', 'checks'],
        components: {vSelect},
        data () {
            return {
                data: {
                    number: '',
                    date: '',
                    detail: '',
                    balance: '',
                    expense_account: '',
                },
                errors: {
                    number: '',
                    date: '',
                    detail: '',
                    balance: '',
                    expense_account: '',
                },
                expenses:''
            }
        },
        computed: {
            select(){
                return JSON.parse(this.accounts);
            },
        },
        created(){
            this.$http.get('/tesoreria/lista-de-gastos-not').then((response) => {
                this.expenses = response.data;
            });;
        },
        methods: {
            send: function (event) {
                console.log(this.data.selected);
                var self = this;
                axios.post('/tesoreria/' + self.url, this.data)
                    .then(response => {
                        if (response.data.success = true) {
                            this.$alert({
                                title: 'Se Guardo con Exito!!!',
                                message: response.data.message
                            });
                            this.expenses.push((response.data.result));
                            this.data.number = '';
                            this.data.date = '';
                            this.data.detail = '';
                            this.data.balance = '';
                            this.data.expense_account = '';
                            this.errors.number = '';
                            this.errors.date = '';
                            this.errors.detail = '';
                            this.errors.balance = '';
                            this.errors.expense_account = '';
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
            aplic: function (event) {
                console.log(this.data.selected);
                var self = this;
                axios.post('/tesoreria/', this.data)
                    .then(response => {
                        if (response.data.success = true) {
                            this.$alert({
                                title: 'Se Guardo con Exito!!!',
                                message: response.data.message
                            });
                            this.expenses.push((response.data.result));
                            this.data.number = '';
                            this.data.date = '';
                            this.data.detail = '';
                            this.data.balance = '';
                            this.data.expense_account = '';
                            this.errors.number = '';
                            this.errors.date = '';
                            this.errors.detail = '';
                            this.errors.balance = '';
                            this.errors.expense_account = '';
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

