<!--
 * Created by PhpStorm.
 * User: anwarsarmiento
 * Email: asarmiento@sistemasamigables.com
 * Date: 28/4/17
 * Time: 20:06
 -->
@extends('layouts.system')
@section('style')
    <link href="{{asset('plugins/datatables/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endsection
@section('content')
    <div class="container">
        <div class="">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading "><h1 class="text-left">Lista de Jovenes de Inscritos</h1>
                    </div>
                    <div class="col-lg-1 col-md-1">
                        <h1 class="text-right"><a href="{{route('pdf')}}" class="btn btn-danger"><span class="fa fa-file-pdf-o fa-3x"></span></a></h1>
                        <h1 class="text-right"><a href="{{route('excelList')}}" class="btn btn-success"><span class="fa fa-file-excel-o fa-3x"></span></a></h1>
                    </div>
                        <div class="panel-body">

                        <table id="lista-inscritos" class="table toggle-arrow-tiny" data-page-size="5">
                            <thead>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Iglesia</th>
                                <th>Talla</th>
                                <th>Saldo</th>
                            </thead>
                            <tbody>
                            @foreach($users AS $key=>$user)
                                @if($user->youngBoy->status == 'activo')
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td><a href="{{route('status-change',$user->youngBoy->id)}}">{{strtoupper($user->nameComplete())}}</a></td>
                                    <td class="text-center">{{$user->youngBoy->age}} AÑOS</td>
                                    <td>{{strtoupper($user->youngBoy->church)}}</td>
                                    <td class="text-center">{{strtoupper($user->youngBoy->retirements[0]->shirt_size)}}</td>
                                    @if((38500-$user->youngBoy->retirements()->sum('amount'))==0)
                                    <td class="content-box-green">Pagado</td>
                                    @else
                                    <td>{{number_format(38500-$user->youngBoy->retirements()->sum('amount'),2)}}</td>
                                    @endif
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                            <tr>
                                <td colspan="6"><h1>Lista de Jovenes Eliminados</h1></td>
                            </tr>
                            <thead>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Edad</th>
                            <th>Iglesia</th>
                            <th>Talla</th>
                            <th>Saldo</th>
                            </thead>
                            <tbody>

                            @foreach($users AS $key=>$user)
                                @if($user->youngBoy->status != 'activo')
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><a href="{{route('status-change',$user->youngBoy->id)}}">{{strtoupper($user->nameComplete())}}</a></td>
                                        <td class="text-center">{{$user->youngBoy->age}} AÑOS</td>
                                        <td>{{strtoupper($user->youngBoy->church)}}</td>
                                        <td class="text-center">{{strtoupper($user->youngBoy->retirements[0]->shirt_size)}}</td>
                                        @if((38500-$user->youngBoy->retirements()->sum('amount'))==0)
                                            <td class="content-box-green">Pagado</td>
                                        @else
                                            <td>{{number_format(38500-$user->youngBoy->retirements()->sum('amount'),2)}}</td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')


    <script>
        $("#lista-inscritos").dataTable();
    </script>
    @endsection
