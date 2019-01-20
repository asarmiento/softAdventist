@extends('layouts.system')

@section('content')
<div id="app">
    <view-profile></view-profile>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
