<template>
    <div class="row">
        <div  class="col-md-12 col-md-offset-0">
            <div  id="editMembers" class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-center ">
                        <h1> Cambiar presupuestos de los Departamentos </h1>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12 col-md-8  text-center ">
                        <p class="box-info"><strong>Nota: </strong>
                        <ul class="box-list">
                            <li><i>Debe agregar a todos los departamentos que su Iglesia utiliza y el
                                presupuestó que le tienen asignado a cada departamento. </i></li>
                            <li><i>En caso que utilizan un fondo común
                                solo debe agregar el departamentos de fondo de iglesia y asignarle el 100% a este
                                departamento
                            </i></li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th style="" data-field="id" tabindex="0">
                                <div class="th-inner ">Departamento</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="" data-field="name" tabindex="0">
                                <div class="th-inner ">Presupuesto Disponible</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="" data-field="date" tabindex="0">
                                <div class="th-inner ">Porcentaje del 60%</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="" data-field="amount" tabindex="0">
                                <div class="th-inner ">Estado</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="" data-field="amount" tabindex="0">
                                <div class="th-inner "></div>
                                <div class="fht-cell"></div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(dato, index) in datos.data" :data-index="index">
                            <td style=""><a href="#" class="btn-link"> {{dato.list_departament.name}}</a></td>
                            <td style="">
                                <a href="" data-name="name" data-pk="53431"
                                   data-value="dato.balance" class="editable editable-click">{{dato.balance}}
                                </a></td>
                            <td v-if="dato.percent_of_budget > 0" style="">{{dato.percent_of_budget}} %</td>
                            <td v-else style=""></td>
                            <td style="text-align: center; ">
                                <div class="label label-table label-danger">Inactivo</div>
                            </td>
                            <td v-if="dato.income_accounts.length > 0"></td>
                            <td v-else style="text-align: center; ">
                                <a href="#" @click="removeLine(dato,index)" class="btn btn-danger"><i
                                        class="fa fa-remove"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Total:</td>
                            <td>{{total}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div v-if="mTotal" class="col-lg-12 col-md-12  text-center">
                        <div class="btn">
                            <button v-on:click="applied" class="btn btn-success">Finalizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</template>

<script>
    import dataTable from '../Lists/ListsDepartaments.vue';
    import vSelect from "vue-select";

    export default {
        props: ['title', 'url', 'block'],
        components: {dataTable, vSelect},
        data() {
            return {
                data: {
                    dep: '',
                    percent_of_budget: '',
                    balance: '',
                },
                errors: {
                    name: '',
                    percent_of_budget: '',
                    balance: '',
                },
                departaments: [],
                txtSearch: '',
                total: '',
                counts: ['5', '10', '20', '50'],
                datos: [],
                my_pages: [],
                columns: [],
                typeAll: true,
                typeStyle: true,
                status: ''
            }
        },
        created() {

            var self = this;
            this.$http.get('/softadventist/lista-de-departamentos').then((response) => {
                this.departaments = response.data;
            });
            this.$http.get('/softadventist/lists-departament-inactive').then((response) => {
                self.datos = response.data.model;
                self.my_pages = response.data.my_pages;
                self.columns = response.data.columns;
                self.total = response.data.count;
            });

        },
        computed: {
            mTotal() {
                if (this.total === '100.00') {
                    return true;
                }
                return false;
            },
        },
        methods: {

            applied: function () {
                var self = this;
                axios.post('/softadventist/applied-departament', event)
                    .then((response) => {
                        document.location = response.data.url;


                    }).catch(function (error) {
                    console.log(error.response);
                    if (error.response) {
                        let data = error.response.data;
                        if (error.response.status === 422) {
                            self.$alert({
                                title: 'Cuidado!!!',
                                message: error.response.data.errors
                            });
                        } else if (error.response.status === 401) {
                            self.errors.response.invalid = true;
                            self.errors.response.msg = data.msg.message;
                        } else {
                            console.log(error);
                            self.errors = data.message;
                            alert("Error generic");
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
            send: function (event) {
                var self = this;
                axios.post('/softadventist/' + self.url, this.data)
                    .then(response => {
                        if (response.data.success = true) {

                            self.datos = response.data.dep;
                            self.total = response.data.count;
                            this.$alert({
                                title: 'Se Guardo con Exito!!!',
                                message: response.data.message
                            });
                            this.data.name = '';
                            this.data.percent_of_budget = '';
                            this.data.balance = '';
                            this.errors.name = '';
                            this.errors.percent_of_budget = '';
                            this.errors.balance = '';
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
                        } else {
                            console.log(error);
                            alert("Error generic");
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
            removeLine: function (event, index) {
                var self = this;
                axios.post('/softadventist/delete-departament', event)
                    .then((response) => {
                        self.datos.data.splice(index, 1);
                        self.total = response.data.count;
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
                        } else {
                            console.log(error);
                            self.errors = data.message;
                            alert("Error generic");
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
            styleType() {
                var self = this;
                if (this.typeStyle) {
                    this.typeStyle = false;
                } else {
                    this.typeStyle = true;
                }
            },
            sarch: function (url) {
                var self = this;
                this.$http.get(url + '?search=' + this.txtSearch).then((response) => {
                    self.datos = response.data.model;
                    self.my_pages = response.data.my_pages;
                });
            },
            pagePre(url) {
                url += '&perPage=' + this.datos.per_page
                var self = this;
                this.$http.get(url).then((response) => {
                    self.datos = response.data.model;
                    self.my_pages = response.data.my_pages;
                });
            },
            pageNext(url) {
                url += '&perPage=' + this.datos.per_page
                var self = this;
                this.$http.get(url).then((response) => {
                    self.datos = response.data.model;
                    self.my_pages = response.data.my_pages;
                });
            },
            page(url, number) {
                if (!isNaN(number)) {
                    var self = this;
                    url += '?page=' + number
                    url += '&perPage=' + this.datos.per_page
                    this.$http.get(url).then((response) => {
                        self.datos = response.data.model;
                        self.my_pages = response.data.my_pages;
                    });
                }
            },
            perPage(url, number) {
                var self = this;
                this.$http.get(url + '?perPage=' + number).then((response) => {
                    self.datos = response.data.model;
                    self.my_pages = response.data.my_pages;
                });
            },
            all(url, total) {
                var self = this;
                if (this.typeAll) {
                    this.typeAll = false;
                } else {
                    this.typeAll = true;
                }
                this.$http.get(url + '?all=' + total).then((response) => {
                    self.datos = response.data.model;
                    self.my_pages = response.data.my_pages;
                });
            }
        },
    }
</script>

<style>
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

    .tittle-2 {
        text-align: left !important;
        font-weight: bold;
        float: left;
        min-width: 30%;
    }

    .value {
        text-align: left !important;
        float: right;
        min-width: 70%;
    }

</style>

