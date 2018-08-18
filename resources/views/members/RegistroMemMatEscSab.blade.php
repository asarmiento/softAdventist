<!--
 * Created by PhpStorm.
 * User: Anwar Sarmiento Ramo
 * Date: 28/4/2018
 * Time: 05:11:PM
-->
@extends('layouts.system')

@section('content')
    <div id="app">
        <register-payment-members></register-payment-members>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
