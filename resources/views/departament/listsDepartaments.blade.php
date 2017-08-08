@extends('layouts.system')

@section('content')
    <diV id="app">
        <lists-departaments  source="/tesoreria/lists-departament" title="Lista Departamentos de la Iglesia"></lists-departaments>
    </diV>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
