@extends('layouts.system')

@section('content')
<div id="app">
    <create-card-especialidades></create-card-especialidades>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
