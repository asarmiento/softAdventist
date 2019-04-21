@extends('layouts.system')

@section('content')
<div id="app">
    <create-card-member></create-card-member>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
