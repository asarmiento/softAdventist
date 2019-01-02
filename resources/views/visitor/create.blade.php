@extends('layouts.system')

@section('content')
<div id="app">
    <create-visitor></create-visitor>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
