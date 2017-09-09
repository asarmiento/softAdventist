@extends('layouts.system')
@section('style')
    <style>
    </style>
@endsection
@section('content')
<div id="app">
    <create-incomes title="Nuevo Ingreso" url="save-incomes" contents="{{ json_encode($contents) }}" relation="Departamento"  >

    </create-incomes>

</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>

@endsection
