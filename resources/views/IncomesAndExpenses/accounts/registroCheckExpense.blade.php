@extends('layouts.system')

@section('content')
    <div id="app">
        <registro-expenses title="Nueva Factura de Gasto" url="save-expense-invoice"
                           accounts="{{json_encode($accounts)}}"
                           checks="{{json_encode($check)}}"
                           expense="{{json_encode($expense)}}"
                           balances="{{json_encode($balance)}}"
        ></registro-expenses>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
