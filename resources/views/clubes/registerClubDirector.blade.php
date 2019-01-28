@extends('layouts.system')

@section('content')
<div id="app">
    <create-club-director></create-club-director>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
