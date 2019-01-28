@extends('layouts.system')

@section('content')
<div id="app">
    <register-specialties-member></register-specialties-member>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
