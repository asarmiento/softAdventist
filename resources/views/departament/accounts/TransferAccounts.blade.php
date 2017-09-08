@extends('layouts.system')
@section('content')
<div id="app">
    <transfer-account title="Transferencia de saldos" url="save-transferencias"  >

    </transfer-account>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
