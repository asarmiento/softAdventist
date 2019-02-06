@extends('layouts.system')

@section('content')
<div id="app">
    @if(userChurch())
    <create-member></create-member>
        @elseif(userCampo())
    <create-member-campo></create-member-campo>
        @endif
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
