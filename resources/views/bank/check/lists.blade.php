@extends('layouts.system')

@section('content')
<div id="app">
    <lists-checks title="Registro y Lista de Cheques" url="save-check" banks="{{json_encode($banks)}}" ></lists-checks>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
