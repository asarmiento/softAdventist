@extends('layouts.system')

@section('content')
<div id="app">
<deposit-local-field title="Envio de Informes al Campo Local" url="save-deposit-local-field"></deposit-local-field>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
