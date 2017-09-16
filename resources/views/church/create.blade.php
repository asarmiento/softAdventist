@extends('layouts.app')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div id="newMembers" class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-center ">
                        <h1>  </h1>
                    </div>
                </div>
                <div class="panel-body">
                <!--div-- class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.code.length > 0}">
                        <div class="panel-default ">
                            <label>Cual es tu Pais</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                <v-select v-model="data.country" :on-change="localField" :options="countrys"></v-select>
                            </div>
                            <small class="help-block"></small>
                        </div>
                    </div-->
                    <div class=" col-lg-5 col-md-5  " >
                        <div class="form-group panel-default ">
                            <label for="localfield"  >Campo Local Al Cual pertenece Tu Iglesia</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                                <select id="localfield" name="localfield" class="form-control js-example-basic-single js-states"  >
                                    <option>Seleccione un Campo Local</option>
                                    <optgroup label="Alaskan/Hawaiian Time Zone">
                                        <option value="AK">Alaska</option>
                                        <option value="HI">Hawaii</option>
                                    </optgroup>
                                </select>
                            </div>
                            <small class="help-block"></small>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3  "
                         :class="{'has-feedback has-error':errors.name.length > 0}">
                        <div class="panel-default ">
                            <label for="name">Nombre de Tu Iglesia</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-desktop"></i></span>
                                <input id="name" type="text" v-model="data.name" class="form-control">
                            </div>
                            <small class="help-block"></small>
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
        <div id="map"></div>

        <!--div-- class="col-md-12 col-md-offset-0">

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Lista de Cuentas Bancarias</h3>
                </div>

                <div class="panel-body">
                    <div id="demo-dt-delete_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div id="demo-dt-delete_filter" class="dataTables_filter">
                            <label>Buscar: <input type="search" class="form-control input-sm" placeholder=""
                                                  aria-controls="demo-dt-delete"></label>
                        </div>
                        <table id="demo-dt-delete"
                               class="table table-striped table-bordered dataTable no-footer dtr-inline" cellspacing="0"
                               width="100%" role="grid" aria-describedby="demo-dt-delete_info" style="width: 100%;">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1" aria-sort="ascending"
                                    aria-label="Name: activate to sort column descending" style="width: 277px;"></th>
                                <th class="sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1"
                                    aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                    style="width: 277px;">Numero de Cuenta
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1"
                                    aria-label="Position: activate to sort column ascending" style="width: 408px;">
                                    Nombre de la cuenta
                                </th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1" aria-label="Office: activate to sort column ascending"
                                    style="width: 203px;">Saldo Incial
                                </th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1" aria-label="Extn.: activate to sort column ascending"
                                    style="width: 131px;">Debitos
                                </th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1" aria-label="Extn.: activate to sort column ascending"
                                    style="width: 131px;">Creditos
                                </th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1" aria-label="Extn.: activate to sort column ascending"
                                    style="width: 131px;">Balance
                                </th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1"
                                    colspan="1" aria-label="Extn.: activate to sort column ascending"
                                    style="width: 131px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr role="row" class="odd">
                                <td class="sorting_1"><span class="btn btn-info fa fa-pencil"></span></td>

                                <td><a target='_blank' class='btn btn-danger'>
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
        </div-->
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('select').select2();
    </script>
@endsection
