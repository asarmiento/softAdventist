@extends('layouts.system')

@section('content')
    <diV id="app">
        <lists-expense-accounts source="/softadventist/list-account-gastos"
                                title="Lista de Cuentas de Gastos de la Iglesia" urls="/softadventist/move-account-gastos"></lists-expense-accounts>
    </diV>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
