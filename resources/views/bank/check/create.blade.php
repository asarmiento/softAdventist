@extends('layouts.system')

@section('content')
<div id="app">
    <create-check title="Registro y Lista de Cheques" url="save-check" banks="{{json_encode($banks)}}" ></create-check>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
