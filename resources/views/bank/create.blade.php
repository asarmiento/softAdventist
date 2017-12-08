@extends('layouts.system')

@section('content')
<div id="app">
    <create-bank title="Cuentas Bancaria" url="/save-bank" banks="{{json_encode($banks)}}" ></create-bank>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
