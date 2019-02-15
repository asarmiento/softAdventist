@extends('layouts.system')

@section('content')
<div id="app">
     <edit-member members="{{json_encode($member)}}"></edit-member>

</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
