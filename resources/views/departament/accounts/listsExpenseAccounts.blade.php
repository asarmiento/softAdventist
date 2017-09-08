@extends('layouts.system')

@section('content')
    <diV id="app">
        <lists-expense-accounts source="/tesoreria/list-account-gastos"
                                title="Lista de Cuentas de Gastos de la Iglesia" urls="/tesoreria/move-account-gastos"></lists-expense-accounts>
    </diV>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
