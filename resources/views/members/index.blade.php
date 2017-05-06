@extends('layouts.app')

@section('content')
    <div class="float-div">
        <div class="content-container">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                <div class="panel-heading">Lista de Miembros</div>
                <div class="panel-body">
                    <table class="table tab-content">
                        <thead>
                            <th>N°</th>
                            <th>Nombre Completo</th>
                            <th>Fecha Nacimiento</th>
                            <th>Saldo</th>
                        </thead>
                        <tbody>
                            @foreach($members AS $key => $member)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$member->nameComplete()}}</td>
                                    <td>{{$member-}}</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
