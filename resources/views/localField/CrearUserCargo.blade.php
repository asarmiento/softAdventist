<!--?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 28/12/2018
 * Time: 12:26:PM
-->
@extends('layouts.system')

@section('content')
    <div id="app">
        <create-user-cargo></create-user-cargo>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
