<!--
 * Created by PhpStorm.
 * User: anwarsarmiento
 * Email: asarmiento@sistemasamigables.com
 * Date: 28/4/17
 * Time: 20:06
 -->
@extends('layouts.system')

@section('content')
    <div class="container">
        <div class="">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista de Jovenes de Inscriptos</div>
                        <div class="panel-body">
                        <table id="lists-youngBoys" class="table table-bordered">
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
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{strtoupper($user->nameComplete())}}</td>
                                    <td class="text-center">{{$user->youngBoy->age}} AÑOS</td>
                                    <td>{{strtoupper($user->youngBoy->church)}}</td>
                                    <td class="text-center">{{strtoupper($user->youngBoy->retirements[0]->shirt_size)}}</td>
                                    @if((38500-$user->youngBoy->retirements()->sum('amount'))==0)
                                    <td class="content-box-green">Pagado</td>
                                    @else
                                    <td>{{number_format(38500-$user->youngBoy->retirements()->sum('amount'),2)}}</td>
                                    @endif
                                </tr>
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
        $(document).ready(function () {
            $('#lists-youngBoys').DataTable();
        });
    </script>
    @endsection
