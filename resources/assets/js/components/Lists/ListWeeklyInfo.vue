<template>
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div id="newMembers" class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center " >
                            <h1> {{title}} </h1>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-body">
                            <div class="bootstrap-table">
                                <div class="fixed-table-toolbar">
                                    <div class="columns columns-right btn-group pull-right">
                                        <button class="btn btn-default" type="button" name="paginationSwitch" title="Hide/Show pagination"><i class="glyphicon demo-pli-arrow-down"></i></button></div></div><div class="fixed-table-container" style="padding-bottom: 0px;"><div class="fixed-table-header" style="display: none;"><table></table></div><div class="fixed-table-body"><div class="fixed-table-loading" style="top: 41px; display: none;">Loading, please wait...</div><table data-toggle="table" data-url="data/bs-table.json" data-sort-name="id" data-page-list="[5, 10, 20]" data-page-size="5" data-pagination="true" data-show-pagination-switch="true" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="" data-field="id" tabindex="0">
                                            <div class="th-inner sortable both asc">#</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="" data-field="name" tabindex="0">
                                            <div class="th-inner sortable both">Sabado</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="" data-field="date" tabindex="0">
                                            <div class="th-inner sortable both"><i class="fa fa-money"></i> Total General</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="text-align: center; " data-field="amount" tabindex="0">
                                            <div class="th-inner sortable both"><i class="fa fa-money"></i> Diezmo</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="text-align: center; " data-field="status" tabindex="0">
                                            <div class="th-inner sortable both"><i class="fa fa-money"></i> Ofrenda 40%</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="text-align: center; " data-field="status" tabindex="0">
                                            <div class="th-inner sortable both"><i class="fa fa-money"></i> Otros Pagos u Ofrendas</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="" data-field="date" tabindex="0">
                                            <div class="th-inner sortable both"><i class="fa fa-money"></i> Total Campo Local</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="text-align: center; " data-field="track" tabindex="0">
                                            <div class="th-inner sortable both"><i class="fa fa-money"></i> Ofrenda 60%</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="text-align: center; " data-field="track" tabindex="0">
                                            <div class="th-inner sortable both"><i class="fa fa-money"></i> Otras Ofrendas</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="" data-field="date" tabindex="0">
                                            <div class="th-inner sortable both"><i class="fa fa-money"></i> Total Iglesia</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="" data-field="date" tabindex="0">
                                            <div class="th-inner sortable both">Opciones</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr :data-index="index" v-for="(list, index) in datos">
                                        <td style="">
                                            <a href="#" class="btn-link">{{list.id}}</a>
                                        </td>
                                        <td style=""><i class="fa fa-clock-o"></i>{{list.internal_control.saturday}}</td>
                                        <td style="">
                                            <span class="text-muted">₡ {{list.internal_control.balance}}</span>
                                        </td>
                                        <td style="text-align: center; ">₡ {{list.tithes}}</td>
                                        <td style="text-align: center; ">₡ {{list.forty}}</td>
                                        <td style="text-align: center; ">₡ {{list.other}}</td>
                                        <td style="text-align: center; ">
                                            <div class="label label-table label-danger">₡ {{totalField(list)}}</div>
                                        </td>
                                        <td style="text-align: center; ">₡ {{list.sixty}}</td>
                                        <td style="text-align: center; ">₡ {{list.other_church}}</td>
                                        <td style="text-align: center; ">₡ {{totalChurch(list)}}</td>
                                        <td style="text-align: center; ">
                                            <a :href="pdfInfo(list.internal_control.saturday)"  target='_blank' class=''>
                                            <i class='btn btn-danger fa fa-file-pdf-o'></i></a>
                                        </td>

                                    </tr>

                                </tbody>
                            </table>
                            </div>
                                <div class="fixed-table-footer" style="display: none;">
                                    <table>
                                        <tbody>
                                        <tr></tr>
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
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    import { Confirm } from '@lassehaslev/vue-confirm';
    import numeral from 'numeral';
    export default {
        props: [
            'title',
            'source',
        ],
        components: {},
         data () {
             return   {
                 txtSearch: '',
                 counts: ['5', '10', '20', '50'],
                 datos: [],
                 my_pages: [],
                 columns: [],
                 typeAll: true,
                 typeStyle: true,
             }
         },
        created(){
            var self = this;
            this.$http.get(this.source).then((response) => {
                self.datos = response.data.model;
                self.my_pages = response.data.my_pages;
                self.columns = response.data.columns;
            });
        },
       computed:{
            lists(){
               return JSON.parse(this.incomes_weeklys);
    },
        },
       methods: {
           totalField: function (list){
               return Number(parseFloat(list.tithes)+parseFloat(list.forty)+parseFloat(list.other)).toFixed(2);
           },
           totalChurch: function (list){
               return Number(parseFloat(list.sixty)+parseFloat(list.other_church)).toFixed(2);
           },
           pdfInfo: function (saturday) {
               return "/softadventist/reporte-semanal/"+saturday;
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
        filters:{
            moneyFormat: function(value){
                return  numeral(value).format(' 0,0.00');
            },
            totalRow: function (value) {
                return totalRow ;
            }
        }

    }
</script>

<style scoped>


</style>
