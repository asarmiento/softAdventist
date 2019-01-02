@extends('layouts.system')

@section('content')
    <diV id="app">
        <lists-check-expenses  source="/softadventist/lists-check-expenses" title="Lista de Gastos de la Iglesia"></lists-check-expenses>
    </diV>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
