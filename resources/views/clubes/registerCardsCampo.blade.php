@extends('layouts.system')

@section('content')
<div id="app">
    <create-card-member-campo></create-card-member-campo>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
