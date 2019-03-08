@extends('layouts.system')

@section('content')
<div id="app">
    <create-card-member-aventureros></create-card-member-aventureros>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
