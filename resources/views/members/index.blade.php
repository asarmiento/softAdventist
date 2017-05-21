@extends('layouts.system')

@section('content')
    <div class="container">
        <div class="">
            <div class="">
                <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-center left col-md-10 col-lg-10" >
                       <h3 style="font-size:38px; margin: 2px">Lista de Miembros</h3>
                    </div>
                    <div style="height: 40px">
                        <a href="{{route('new-member')}}" class="btn btn-success right col-md-2 col-lg-2 text-color">Nuevo Miembro</a>
                    </div>
                </div>
                <div class="panel-body">
                    <table id="members" class="table table-success">
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
                                    <td>{{$member->birthdate}}</td>
                                    <td>{{$member->due}}</td>
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
            $('#members').DataTable();
        });
    </script>
@endsection
