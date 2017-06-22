@extends('layouts.system')

@section('content')
<div id="app">
    <create-incomes title="Nuevo Ingreso" url="save-incomes" contents="{{$departaments}}" relation="Departamento"  ></create-incomes>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>

@endsection
