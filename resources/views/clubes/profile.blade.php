@extends('layouts.system')

@section('content')
<div id="app">
    <view-profile specialities="{{json_encode($specialities)}}" member="{{json_encode($member)}}"></view-profile>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
