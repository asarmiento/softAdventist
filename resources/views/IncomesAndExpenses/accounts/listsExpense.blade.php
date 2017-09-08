@extends('layouts.system')

@section('content')
<div id="app">
    <lists-expenses title="Lista de Factura de Gastos" ></lists-expenses>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
