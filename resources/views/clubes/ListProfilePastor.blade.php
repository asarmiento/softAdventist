@extends('layouts.system')

@section('content')
<div id="app">
    <lists-profile-pastor></lists-profile-pastor>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
