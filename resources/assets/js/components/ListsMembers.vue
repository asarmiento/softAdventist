<template>
    <div class="row panel-body">
        <div class="bootstrap-table">
            <div class="fixed-table-toolbar">
                <div class="columns columns-right btn-group pull-right">
                    <button class="btn btn-default" type="button" name="paginationSwitch" title="Hide/Show pagination">
                        <i class="glyphicon demo-pli-arrow-down"></i></button>
                    <button class="btn btn-default" type="button" name="refresh" title="Refresh"><i
                            class="glyphicon demo-pli-repeat-2"></i></button>
                    <button class="btn btn-default" type="button" name="toggle" title="Toggle"><i
                            class="glyphicon demo-pli-layout-grid"></i></button>
                    <div class="keep-open btn-group" title="Columns">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false"><i class="glyphicon demo-pli-check"></i> <span
                                class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><label><input type="checkbox" data-field="id" value="0" checked="checked">
                                Invoice</label></li>
                            <li><label><input type="checkbox" data-field="name" value="1" checked="checked">
                                Name</label></li>
                            <li><label><input type="checkbox" data-field="date" value="2" checked="checked"> Order date</label>
                            </li>
                            <li><label><input type="checkbox" data-field="amount" value="3" checked="checked">
                                Amount</label></li>
                            <li><label><input type="checkbox" data-field="status" value="4" checked="checked">
                                Status</label></li>
                            <li><label><input type="checkbox" data-field="track" value="5" checked="checked"> Tracking
                                Number</label></li>
                        </ul>
                    </div>
                </div>
                <div class="pull-right search"><input class="form-control" type="text" placeholder="Search"></div>
            </div>
            <div class="fixed-table-container" style="padding-bottom: 0px;">
                <div class="fixed-table-header" style="display: none;">
                    <table></table>
                </div>
                <div class="fixed-table-body">
                    <div class="fixed-table-loading" style="top: 41px; display: none;">Loading, please wait...</div>
                    <table id="demo-editable" data-search="true" data-show-refresh="true" data-show-toggle="true"
                           data-show-columns="true" data-sort-name="id" data-page-list="[5, 10, 20]" data-page-size="10"
                           data-pagination="true" data-show-pagination-switch="true" class="table table-hover">
                        <thead>
                        <tr>
                            <th style="" data-field="id" tabindex="0">
                                <div class="th-inner ">Invoice</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="" data-field="name" tabindex="0">
                                <div class="th-inner ">Name</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="" data-field="date" tabindex="0">
                                <div class="th-inner ">Order date</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="" data-field="amount" tabindex="0">
                                <div class="th-inner ">Amount</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="text-align: center; " data-field="status" tabindex="0">
                                <div class="th-inner ">Status</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th style="" data-field="track" tabindex="0">
                                <div class="th-inner ">Tracking Number</div>
                                <div class="fht-cell"></div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr data-index="0">
                            <td style=""><a href="#" class="btn-link"> Order #53431</a></td>
                            <td style=""><a href="javascript:void(0)" data-name="name" data-pk="53431"
                                            data-value="Steve N. Horton" class="editable editable-click">Steve N.
                                Horton</a></td>
                            <td style="">Oct 22, 2014</td>
                            <td style=""><a href="javascript:void(0)" data-name="amount" data-pk="53431"
                                            data-value="$45.00" class="editable editable-click" data-original-title=""
                                            title="">$45.00</a></td>
                            <td style="text-align: center; ">
                                <div class="label label-table label-success"> Paid</div>
                            </td>
                            <td style=""><a href="javascript:void(0)" data-name="track" data-pk="53431"
                                            data-value="undefined" class="editable editable-click">undefined</a></td>
                        </tr>
                        <tr data-index="1">
                            <td style=""><a href="#" class="btn-link"> Order #53432</a></td>
                            <td style=""><a href="javascript:void(0)" data-name="name" data-pk="53432"
                                            data-value="Charles S Boyle" class="editable editable-click">Charles S
                                Boyle</a></td>
                            <td style="">Oct 24, 2014</td>
                            <td style=""><a href="javascript:void(0)" data-name="amount" data-pk="53432"
                                            data-value="$245.30" class="editable editable-click" data-original-title=""
                                            title="">$245.30</a></td>
                            <td style="text-align: center; ">
                                <div class="label label-table label-info"> Shipped</div>
                            </td>
                            <td style=""><a href="javascript:void(0)" data-name="track" data-pk="53432"
                                            data-value="CGX0089734531" class="editable editable-click">CGX0089734531</a>
                            </td>
                        </tr>
                        <tr data-index="2">
                            <td style=""><a href="#" class="btn-link"> Order #53433</a></td>
                            <td style=""><a href="javascript:void(0)" data-name="name" data-pk="53433"
                                            data-value="Lucy Doe" class="editable editable-click">Lucy Doe</a></td>
                            <td style="">Oct 24, 2014</td>
                            <td style=""><a href="javascript:void(0)" data-name="amount" data-pk="53433"
                                            data-value="$38.00" class="editable editable-click editable-open"
                                            data-original-title="" title="" aria-describedby="popover554181">$38.00</a>
                                <div class="popover fade top in editable-container editable-popup" role="tooltip"
                                     id="popover554181" style="top: 65px; left: 723.313px; display: block;">
                                    <div class="arrow" style="left: 50%;"></div>
                                    <h3 class="popover-title" style="display: none;"></h3>
                                    <div class="popover-content">
                                        <div>
                                            <div class="editableform-loading" style="display: none;"></div>
                                            <form class="form-inline editableform" style="">
                                                <div class="control-group form-group">
                                                    <div>
                                                        <div class="editable-input" style="position: relative;"><input
                                                                type="text" class="form-control input-sm"
                                                                style="padding-right: 24px;"><span
                                                                class="editable-clear-x"></span></div>
                                                        <div class="editable-buttons">
                                                            <button type="submit"
                                                                    class="btn btn-primary editable-submit"><i
                                                                    class="fa fa-fw fa-check"></i></button>
                                                            <button type="button"
                                                                    class="btn btn-default editable-cancel"><i
                                                                    class="fa fa-fw fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="editable-error-block help-block"
                                                         style="display: none;"></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align: center; ">
                                <div class="label label-table label-info"> Shipped</div>
                            </td>
                            <td style=""><a href="javascript:void(0)" data-name="track" data-pk="53433"
                                            data-value="CGX0089934571" class="editable editable-click">CGX0089934571</a>
                            </td>
                        </tr>
                        <tr data-index="3">
                            <td style=""><a href="#" class="btn-link"> Order #53434</a></td>
                            <td style=""><a href="javascript:void(0)" data-name="name" data-pk="53434"
                                            data-value="Teresa L. Doe" class="editable editable-click">Teresa L. Doe</a>
                            </td>
                            <td style="">Oct 15, 2014</td>
                            <td style=""><a href="javascript:void(0)" data-name="amount" data-pk="53434"
                                            data-value="$77.99" class="editable editable-click">$77.99</a></td>
                            <td style="text-align: center; ">
                                <div class="label label-table label-info"> Shipped</div>
                            </td>
                            <td style=""><a href="javascript:void(0)" data-name="track" data-pk="53434"
                                            data-value="CGX0089734574" class="editable editable-click">CGX0089734574</a>
                            </td>
                        </tr>
                        <tr data-index="4">
                            <td style=""><a href="#" class="btn-link"> Order #53435</a></td>
                            <td style=""><a href="javascript:void(0)" data-name="name" data-pk="53435"
                                            data-value="Teresa L. Doe" class="editable editable-click">Teresa L. Doe</a>
                            </td>
                            <td style="">Oct 12, 2014</td>
                            <td style=""><a href="javascript:void(0)" data-name="amount" data-pk="53435"
                                            data-value="$18.00" class="editable editable-click">$18.00</a></td>
                            <td style="text-align: center; ">
                                <div class="label label-table label-success"> Paid</div>
                            </td>
                            <td style=""><a href="javascript:void(0)" data-name="track" data-pk="53435"
                                            data-value="undefined" class="editable editable-click">undefined</a></td>
                        </tr>
                        <tr data-index="5">
                            <td style=""><a href="#" class="btn-link"> Order #53436</a></td>
                            <td style=""><a href="javascript:void(0)" data-name="name" data-pk="53436"
                                            data-value="Scott S. Calabrese" class="editable editable-click">Scott S.
                                Calabrese</a></td>
                            <td style="">Oct 12, 2014</td>
                            <td style=""><a href="javascript:void(0)" data-name="amount" data-pk="53436"
                                            data-value="$11.50" class="editable editable-click">$11.50</a></td>
                            <td style="text-align: center; ">
                                <div class="label label-table label-danger"> Refunded</div>
                            </td>
                            <td style=""><a href="javascript:void(0)" data-name="track" data-pk="53436"
                                            data-value="undefined" class="editable editable-click">undefined</a></td>
                        </tr>
                        <tr data-index="6">
                            <td style=""><a href="#" class="btn-link"> Order #53437</a></td>
                            <td style=""><a href="javascript:void(0)" data-name="name" data-pk="53437"
                                            data-value="Charles S Boyle" class="editable editable-click">Charles S
                                Boyle</a></td>
                            <td style="">Oct 15, 2014</td>
                            <td style=""><a href="javascript:void(0)" data-name="amount" data-pk="53437"
                                            data-value="$234.00" class="editable editable-click">$234.00</a></td>
                            <td style="text-align: center; ">
                                <div class="label label-table label-warning"> Unpaid</div>
                            </td>
                            <td style=""><a href="javascript:void(0)" data-name="track" data-pk="53437"
                                            data-value="undefined" class="editable editable-click">undefined</a></td>
                        </tr>
                        <tr data-index="7">
                            <td style=""><a href="#" class="btn-link"> Order #53438</a></td>
                            <td style=""><a href="javascript:void(0)" data-name="name" data-pk="53438"
                                            data-value="Steve N. Horton" class="editable editable-click">Steve N.
                                Horton</a></td>
                            <td style="">Oct 15, 2014</td>
                            <td style=""><a href="javascript:void(0)" data-name="amount" data-pk="53438"
                                            data-value="$56.99" class="editable editable-click">$56.99</a></td>
                            <td style="text-align: center; ">
                                <div class="label label-table label-info"> Shipped</div>
                            </td>
                            <td style=""><a href="javascript:void(0)" data-name="track" data-pk="53438"
                                            data-value="CGX0089674534" class="editable editable-click">CGX0089674534</a>
                            </td>
                        </tr>
                        <tr data-index="8">
                            <td style=""><a href="#" class="btn-link"> Order #53439</a></td>
                            <td style=""><a href="javascript:void(0)" data-name="name" data-pk="53439"
                                            data-value="Teresa L. Doe" class="editable editable-click">Teresa L. Doe</a>
                            </td>
                            <td style="">Oct 15, 2014</td>
                            <td style=""><a href="javascript:void(0)" data-name="amount" data-pk="53439"
                                            data-value="$77.99" class="editable editable-click">$77.99</a></td>
                            <td style="text-align: center; ">
                                <div class="label label-table label-info"> Shipped</div>
                            </td>
                            <td style=""><a href="javascript:void(0)" data-name="track" data-pk="53439"
                                            data-value="CGX0089734574" class="editable editable-click">CGX0089734574</a>
                            </td>
                        </tr>
                        <tr data-index="9">
                            <td style=""><a href="#" class="btn-link"> Order #53440</a></td>
                            <td style=""><a href="javascript:void(0)" data-name="name" data-pk="53440"
                                            data-value="Scott S. Calabrese" class="editable editable-click">Scott S.
                                Calabrese</a></td>
                            <td style="">Oct 17, 2014</td>
                            <td style=""><a href="javascript:void(0)" data-name="amount" data-pk="53440"
                                            data-value="$45.23" class="editable editable-click">$45.23</a></td>
                            <td style="text-align: center; ">
                                <div class="label label-table label-success"> Paid</div>
                            </td>
                            <td style=""><a href="javascript:void(0)" data-name="track" data-pk="53440"
                                            data-value="undefined" class="editable editable-click">undefined</a></td>
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
                    <div class="pull-left pagination-detail"><span
                            class="pagination-info">Showing 1 to 10 of 25 rows</span><span class="page-list"><span
                            class="btn-group dropup"><button type="button" class="btn btn-default  dropdown-toggle"
                                                             data-toggle="dropdown"><span
                            class="page-size">10</span> <span class="caret"></span></button><ul class="dropdown-menu"
                                                                                                role="menu"><li><a
                            href="javascript:void(0)">5</a></li><li class="active"><a
                            href="javascript:void(0)">10</a></li><li><a
                            href="javascript:void(0)">20</a></li></ul></span> records per page</span></div>
                    <div class="pull-right pagination">
                        <ul class="pagination">
                            <li class="page-pre"><a href="javascript:void(0)">‹</a></li>
                            <li class="page-number active"><a href="javascript:void(0)">1</a></li>
                            <li class="page-number"><a href="javascript:void(0)">2</a></li>
                            <li class="page-number"><a href="javascript:void(0)">3</a></li>
                            <li class="page-next"><a href="javascript:void(0)">›</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</template>

<script>
   // import VuePaginator from 'vuejs-paginator'

    export default {
        props: ['source', 'title'],
        components: {},
        data() {
            return {
                animals: [],
                members: [],

            }

        },
        // Here you define the url of your paginated API
        computed: {},
        created() {
            var self = this;
            this.$http.get('/tesoreria/lists-miembros').then((response) => {
                self.members = response;
            });
            console.log(self.members);
        },
        methods: {
            updateResource(data) {

                }
            },
        }
</script>

