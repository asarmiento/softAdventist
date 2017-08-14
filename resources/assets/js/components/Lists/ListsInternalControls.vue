<template>
    <!--div class="row panel-body">
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
                                <div class="th-inner ">Mat. Esc. Pendiente</div>
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
                                <div class="label label-table label-success"></div>
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
    <div-- class="col-md-12 col-md-offset-0">

        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Lista de Controles Internos</h3>
            </div>
            <div class="panel-body">
                <div id="demo-dt-delete_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <table id="demo-dt-delete" class="table table-striped table-bordered dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="demo-dt-delete_info" style="width: 100%;">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 277px;">Eliminar</th>
                            <th class="sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 277px;">Sabado</th>
                            <th class="sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 408px;">Numero de Sobres</th>
                            <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 203px;">Total Ingresado</th>
                            <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-label="Extn.: activate to sort column ascending" style="width: 131px;">Estado</th>
                            <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-label="Extn.: activate to sort column ascending" style="width: 131px;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(control,index) in internalControls" role="row" class="odd">
                            <td class="sorting_1">
                                <a v-if="control.status === 'no aplicado'" @click="remove(control,index)" ><span class="btn btn-danger fa fa-remove"></span></a>
                            </td>
                            <td class="">{{control.saturday}}</td>
                            <td>{{control.number_of_envelopes}}</td>
                            <td>{{control.balance}}</td>
                            <td>{{control.status}}</td>
                            <td ><a :href="pdfInfo(control.saturday)"  target='_blank' class='btn btn-danger'>
                                <i class='fa fa-file-pdf-o'></i></a></td>
                        </tr>
                        </tbody>
                    </table><div class="dataTables_info" id="demo-dt-delete_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div><div class="dataTables_paginate paging_simple_numbers" id="demo-dt-delete_paginate"><ul class="pagination"><li class="paginate_button previous disabled" aria-controls="demo-dt-delete" tabindex="0" id="demo-dt-delete_previous"><a href="#"><i class="demo-psi-arrow-left"></i></a></li><li class="paginate_button active" aria-controls="demo-dt-delete" tabindex="0"><a href="#">1</a></li><li class="paginate_button " aria-controls="demo-dt-delete" tabindex="0"><a href="#">2</a></li><li class="paginate_button " aria-controls="demo-dt-delete" tabindex="0"><a href="#">3</a></li><li class="paginate_button disabled" aria-controls="demo-dt-delete" tabindex="0" id="demo-dt-delete_ellipsis"><a href="#">…</a></li><li class="paginate_button " aria-controls="demo-dt-delete" tabindex="0"><a href="#">6</a></li><li class="paginate_button next" aria-controls="demo-dt-delete" tabindex="0" id="demo-dt-delete_next"><a href="#"><i class="demo-psi-arrow-right"></i></a></li></ul></div></div>
                <!--div class="bootstrap-table">
                    <div class="fixed-table-toolbar">
                        <div class="columns columns-right btn-group pull-right">
                            <button class="btn btn-default" type="button" @click.prevet="all(datos.path,datos.total)"
                                    v-if="typeAll" name="paginationSwitch" title="Hide/Show pagination">
                                <i class="glyphicon demo-pli-arrow-down"></i></button>
                            <button class="btn btn-default" type="button" @click.prevet="all(datos.path,15)" v-else
                                    name="paginationSwitch" title="Hide/Show pagination">
                                <i class="glyphicon demo-pli-arrow-down"></i></button>
                            <button class="btn btn-default" type="button" @click.prevet="styleType" name="toggle" title="Toggle">
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
                        <div  v-if="typeStyle" class="fixed-table-body">
                            <table id="demo-editable" data-search="true" data-show-refresh="true" data-show-toggle="true"
                                   data-show-columns="true" data-sort-name="id" data-page-list="counts" data-page-size="10"
                                   data-pagination="true" data-show-pagination-switch="true" class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="" data-field="id" tabindex="0">
                                        <div class="th-inner "># Factura</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th style="" data-field="Fecha" tabindex="0">
                                        <div class="th-inner ">Fecha</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th style="" data-field="Detalle" tabindex="0">
                                        <div class="th-inner ">Detalle</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th style="" data-field="Monto" tabindex="0">
                                        <div class="th-inner ">Monto</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th style="" data-field="Cargado a la Cuenta" tabindex="0">
                                        <div class="th-inner ">Cargado a la Cuenta
                                        </div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th style="" data-field="Cheque" tabindex="0">
                                        <div class="th-inner ">Cheque</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th style="" data-field="amount" tabindex="0">
                                        <div class="th-inner ">Ver Factura</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr  v-for="(dato, index) in datos.data" :data-index="index">
                                    <td style=""><a href="#" class="btn-link"> {{dato.number}}</a></td>
                                    <td style="">
                                        <a href="" data-name="name" data-pk="53431"
                                           data-value="dato.budget" class="editable editable-click">{{dato.date}}
                                        </a></td>
                                    <td  style="">{{dato.detail}} </td>
                                    <td  style="">{{dato.balance}} </td>
                                    <td  style="">{{dato.expense_account.name}} </td>
                                    <td  style="">{{dato.check.number}} </td>
                                    <td style="text-align: center; ">
                                        <div class="label label-table label-success"></div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else class="fixed-table-body" >
                            <table  data-search="true" data-show-refresh="true" data-show-toggle="true"
                                    data-show-columns="true" data-sort-name="id"
                                    data-pagination="true" data-show-pagination-switch="true" class="table table-hover" style="margin-top: 0px;">
                                <thead style="display: none;"></thead>
                                <tbody>
                                <tr v-for="(dato,index) in datos.data"  class="listStyle"  :data-index="index">
                                    <td>
                                        <div class="card-view">
                                            <div class="tittle-2">Cédula</div>
                                            <div class="value">{{dato.charter}}</div>
                                        </div>
                                        <div class="card-view">
                                            <div class="tittle-2">Nombre Completo</div>
                                            <div class="value" >{{dato.name}} {{dato.last}}</div>
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
                <div class="clearfix"></div-->
            </div>
        <!--/div>
    </div-->
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
            this.$http.get(this.source).then((response) => {
                self.datos = response.data.model;
                self.my_pages = response.data.my_pages;
                self.columns = response.data.columns;
            });
        },
        methods: {
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

