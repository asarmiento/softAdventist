@extends('layouts.system')

@section('content')
    <diV id="app">
        <lists-income-account  source="/tesoreria/lists-income-account" title="Lista de Cuentas de Ingresos de la Iglesia"></lists-income-account>
    </diV>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
