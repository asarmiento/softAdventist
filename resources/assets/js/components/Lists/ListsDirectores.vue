<template>
    <div class="row panel-body">
        <div class="bootstrap-table">
            <div class="fixed-table-toolbar">
                <div class="columns columns-right btn-group pull-right">
                    <button class="btn btn-default" type="button" @click.prevet="all(datos.path,datos.total)"
                            v-if="typeAll" name="paginationSwitch" title="Hide/Show pagination">
                        <i class="glyphicon demo-pli-arrow-down"></i></button>
                    <button class="btn btn-default" type="button" @click.prevet="all(datos.path,15)" v-else
                            name="paginationSwitch" title="Hide/Show pagination">
                        <i class="glyphicon demo-pli-arrow-down"></i></button>
                    <button class="btn btn-default" type="button" @click.prevet="styleType" name="toggle"
                            title="Toggle">
                        <i
                                class="glyphicon demo-pli-layout-grid"></i></button>
                </div>
                <div class="pull-right search">
                    <input class="form-control" @keyup="sarch(datos.path)"
                           v-model="txtSearch" type="text" placeholder="Buscar">
                </div>
            </div>
            <div class="fixed-table-container" style="padding-bottom: 0px;">
                <div class="fixed-table-header" style="display: none;">
                    <table></table>
                </div>
                <div v-if="typeStyle" class="fixed-table-body">
                    <table id="demo-editable" data-search="true" data-show-refresh="true" data-show-toggle="true"
                           data-show-columns="true" data-sort-name="id" data-page-list="counts" data-page-size="10"
                           data-pagination="true" data-show-pagination-switch="true" class="table table-hover">
                        <thead>
                        <tr>
                            <th style="" data-field="id" tabindex="0">
                                <div class="th-inner ">Cédula</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="" data-field="name" tabindex="0">
                                <div class="th-inner ">Nombre Compelto</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="" data-field="date" tabindex="0">
                                <div class="th-inner ">Fecha Nacimiento</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="" data-field="amount" tabindex="0">
                                <div class="th-inner ">Fecha Bautismo</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="text-align: center; " data-field="status" tabindex="0">
                                <div class="th-inner ">Movimientos</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="" data-field="track" tabindex="0">
                                <div class="th-inner ">Acción</div>
                                <div class="fht-cell"></div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(dato, index) in datos.data" :data-index="index">
                            <td style=""><a href="#" class="btn-link"> {{dato.charter}}</a></td>
                            <td style=""><a href="" data-name="name" data-pk="53431"
                                            data-value="Steve N. Horton" class="editable editable-click">{{dato.name}}
                                {{dato.last}}</a></td>
                            <td style="">{{dato.birthdate}}</td>
                            <td style="">{{dato.bautizmoDate}}</td>
                            <td style=""></td>
                            <td style="text-align: center; ">
                                <a :href="editMember(dato.id)"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else class="fixed-table-body">
                    <table data-search="true" data-show-refresh="true" data-show-toggle="true"
                           data-show-columns="true" data-sort-name="id"
                           data-pagination="true" data-show-pagination-switch="true" class="table table-hover"
                           style="margin-top: 0px;">
                        <thead style="display: none;"></thead>
                        <tbody>
                        <tr v-for="(dato,index) in datos.data" class="listStyle" :data-index="index">
                            <td>
                                <div class="card-view">
                                    <div class="tittle-2">Cédula</div>
                                    <div class="value">{{dato.charter}}</div>
                                </div>
                                <div class="card-view">
                                    <div class="tittle-2">Nombre Completo</div>
                                    <div class="value">{{dato.name}} {{dato.last}}</div>
                                </div>
                                <div class="card-view">
                                    <div class="tittle-2">Fecha Nacimiento</div>
                                    <div class="value">{{dato.birthdate}}</div>
                                </div>
                                <div class="card-view">
                                    <div class="tittle-2">Fecha Bautismo</div>
                                    <div class="value">{{dato.bautizmoDate}}</div>
                                </div>
                                <div class="card-view">
                                    <div class="tittle-2">Movimientos</div>
                                    <div class="value">Test</div>
                                </div>
                                <div class="card-view">
                                    <div class="tittle-2">Mat. Esc. Pendiente</div>
                                    <div class="value">Test</div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="fixed-table-pagination" style="">
                    <div class="pull-left pagination-detail">
                        <span class="pagination-info">Mirando {{datos.from}} al {{datos.to}} de {{datos.total}} rows</span>
                        <span class="page-list"><span
                                class="btn-group dropup">
                        <button type="button" class="btn btn-default  dropdown-toggle" data-toggle="dropdown">
                        <span class="page-size">{{datos.per_page}}</span>
                            <span class="caret"></span>
                        </button>
                    <ul class="dropdown-menu" role="menu">
                        <li v-for="count in counts" v-if="count === datos.per_page" class="active">
                            <a href="" @click.prevent="perPage(datos.path,count)">{{count}}</a>
                        </li>
                        <li v-else><a @click.prevent="perPage(datos.path,count)" href="">{{count}}</a></li>
                    </ul>
                    </span> Filas por páginas</span></div>
                    <div class="pull-right pagination">
                        <ul class="pagination">
                            <li v-show="datos.prev_page_url" class="page-pre">
                                <a href="" @click.prevent="pagePre(datos.prev_page_url)">‹</a>
                            </li>
                            <li v-for='number in my_pages' class='page-number'
                                :class="{'active': number == datos.current_page}">
                                <a class="page-number" href='' @click.prevent='page(datos.path,number)'>{{ number }}</a>
                            </li>
                            <li v-show="datos.next_page_url" class="page-next">
                                <a href="" @click.prevent="pageNext(datos.next_page_url)">›</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

</template>

<script>
    export default {
        props: ['source', 'title'],
        components: {},
        data() {
            return {
                txtSearch: '',
                counts: ['5', '10', '20', '50'],
                datos: [],
                my_pages: [],
                columns: [],
                typeAll: true,
                typeStyle: true,
            }
        },
        computed: {},
        created() {
            var self = this;
            this.$http.get("/softadventist/data-directores").then((response) => {
                self.datos = response.data.model;
                self.my_pages = response.data.my_pages;
                self.columns = response.data.columns;
            });
        },
        methods: {
            editMember(id){
                return "modificar-miembro/"+id;
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

