@extends('layouts.system')

@section('content')
<div id="app">
    <create-member></create-member>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
