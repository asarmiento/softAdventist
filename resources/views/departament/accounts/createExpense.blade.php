@extends('layouts.system')

@section('content')
<div id="app">
    <create-expenses title="Nuevo Gasto" url="save-expense"  ></create-expenses>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>

@endsection