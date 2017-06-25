@extends('layouts.system')

@section('content')
    <div id="app">
        <create-weekly-incomes title="Registro de Sobres de Diezmos" url="save-register-incomes" internalcontrol="{{json_encode($internalControl)}}"  members="{{json_encode($members)}}" ></create-weekly-incomes>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>

@endsection
