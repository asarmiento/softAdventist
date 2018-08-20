<!--
 * Created by PhpStorm.
 * User: Amwar
 * Date: 21/04/2017
 * Time: 08:16 AM
-->
@extends('layouts.system')

@section('content')

                <div id="app">
                    <createja></createja>
                </div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection