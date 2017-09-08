@extends('layouts.system')

@section('content')
<div id="app">
    @if($block)
    <editors-departament title="Nuevo Departamento" url="save-departament" block="{{json_encode($block)}}" ></editors-departament>
    @else
    <create-departament title="Nuevo Departamento" url="save-departament" block="{{json_encode($block)}}" ></create-departament>
    @endif
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
