@extends('layouts.system')

@section('content')
<div id="app">
    <create-assistance></create-assistance>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
