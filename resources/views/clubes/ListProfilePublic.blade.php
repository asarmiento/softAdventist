@extends('layouts.public')

@section('content')
<div id="app">
    <lists-profile-public></lists-profile-public>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
