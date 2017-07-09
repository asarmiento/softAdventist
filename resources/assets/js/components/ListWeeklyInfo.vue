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
                                    <tr :data-index="index" v-for="(list, index) in lists">
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
                                        <td style="text-align: center; "><div class=" "><span class="btn btn-danger btn-xs fa fa-file-pdf-o fa-2x"></span></div></td>

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
                                        <span class="pagination-info">Showing 1 to 5 of 25 rows</span>
                                        <span class="page-list"><span class="btn-group dropup">
                                            <button type="button" class="btn btn-default  dropdown-toggle" data-toggle="dropdown">
                                                <span class="page-size">5</span>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li class="active"><a href="javascript:void(0)">5</a></li>
                                                <li><a href="javascript:void(0)">10</a></li>
                                                <li><a href="javascript:void(0)">20</a></li>
                                            </ul>
                                        </span> records per page</span>
                                    </div>
                                    <div class="pull-right pagination">
                                        <ul class="pagination">
                                            <li class="page-pre"><a href="javascript:void(0)">‹</a></li>
                                            <li class="page-number active"><a href="javascript:void(0)">1</a></li>
                                            <li class="page-number"><a href="javascript:void(0)">2</a></li>
                                            <li class="page-number"><a href="javascript:void(0)">3</a></li>
                                            <li class="page-number"><a href="javascript:void(0)">4</a></li>
                                            <li class="page-number"><a href="javascript:void(0)">5</a></li>
                                            <li class="page-next"><a href="javascript:void(0)">›</a></li>
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
    import vSelect from "vue-select";
    import { Confirm } from '@lassehaslev/vue-confirm';
    import numeral from 'numeral';
    export default {
        props: [
            'title',
            'incomes_weeklys',
        ],
        components: {vSelect},
         data () {
             return   {
                 data: {

                 },
                 errors: {
                     member_id: '',
                     envelope_number: '',
                     tithes:'',
                     offering:'',
                 }
             }
         },
        created(){},
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
