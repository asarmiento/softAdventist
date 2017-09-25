<!--
 * Created by PhpStorm.
 * User: Amwar
 * Date: 22/07/2017
 * Time: 05:56 PM
-->
@extends('layouts.errors')
@section('style')
    <style>
        html, body {
            height: 100%;
        }
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }
        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }
        .content {
            text-align: center;
            display: inline-block;
        }
        .title {
            font-size: 52px;
            margin-bottom: 40px;
        }
    </style>
@stop
@section('content')
    <div class="container">
        <div class="content">
            <div class="title">@lang('Error 42S22 ') Esta Información no tiene ninguna reglación debe verificar que tiene todos los datos completos</div>
        </div>
    </div>
@stop