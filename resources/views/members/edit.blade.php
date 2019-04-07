@extends('layouts.system')

@section('content')
<div id="app">
    @if(userChurch())
     <edit-member members="{{json_encode($member)}}"></edit-member>
    @elseif(userCampo()) <edit-member-campo members="{{json_encode($member)}}"></edit-member-campo>
    @endif
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
