@extends('layouts.system')

@section('content')
<div id="app">
    <create-internal-control title="Registro de Control Interno" url="save-internal-control"  ></create-internal-control>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>

@endsection
