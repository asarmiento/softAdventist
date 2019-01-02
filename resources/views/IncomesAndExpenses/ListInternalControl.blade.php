@extends('layouts.system')

@section('content')
<div id="app">
    <lists-internal-controls
            title="Registro de Control Interno"
            source="/softadventist/list-control-interno"
    ></lists-internal-controls>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>

@endsection
