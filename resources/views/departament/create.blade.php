@extends('layouts.system')

@section('content')
<div id="app">
    <create-departament title="Nuevo Departamento" url="save-departament"  ></create-departament>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
