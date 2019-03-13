@extends('layouts.system')

@section('content')
<div id="app">
    <edit-clave-user></edit-clave-user>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
