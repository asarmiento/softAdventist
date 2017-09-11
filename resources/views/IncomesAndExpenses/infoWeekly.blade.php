<!--
 * Created by PhpStorm.
 * User: Amwar
 * Date: 06/07/2017
 * Time: 11:30 AM
-->
@extends('layouts.system')

@section('content')
    <div id="app">
        <list-weekly-info title="Lista de Informes Semanales"
                          source="/tesoreria/list-de-informes-semanales"
        ></list-weekly-info>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>

@endsection
