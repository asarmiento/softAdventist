@extends('layouts.system')

@section('content')
    <diV id="app">
        <lists-members  source="/tesoreria/lists-miembros" title="Lista Miembro"></lists-members>
    </diV>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
