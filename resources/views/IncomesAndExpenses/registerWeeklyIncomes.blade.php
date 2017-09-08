@extends('layouts.system')

@section('content')
    <div id="app">
        <create-weekly-incomes title="Registro de Sobres de Diezmos"
                               internalcontrol="{{json_encode($internalControl)}}"
                               members="{{json_encode($members)}}"
                               account_local_fields="{{json_encode($account_local_fields)}}"
                               account_incomes="{{json_encode($account_incomes)}}"
        ></create-weekly-incomes>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>

@endsection
