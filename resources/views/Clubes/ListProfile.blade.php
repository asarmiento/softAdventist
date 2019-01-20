@extends('layouts.system')

@section('content')
<div id="app">
    <lists-profile></lists-profile>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
