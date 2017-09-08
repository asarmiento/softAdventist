@extends('layouts.app')

@section('content')
    <div id="app">
        <create-church-public title="Registra tu Iglesia" url="save-church-public"></create-church-public>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
