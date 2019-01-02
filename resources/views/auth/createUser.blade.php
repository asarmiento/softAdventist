@extends('layouts.system')

@section('content')
<div id="app">
    <create-user></create-user>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
