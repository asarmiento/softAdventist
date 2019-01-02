@extends('layouts.system')

@section('content')
    <diV id="app">
        <lists-visitor  source="/softadventist/list-visitor" title="Lista Visitas"></lists-visitor>
    </diV>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
