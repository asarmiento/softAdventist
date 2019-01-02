@extends('layouts.system')

@section('content')
    <diV id="app">
        <lists-expenses  source="/softadventist/lists-expenses" title="Lista de Gastos de la Iglesia"></lists-expenses>
    </diV>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
