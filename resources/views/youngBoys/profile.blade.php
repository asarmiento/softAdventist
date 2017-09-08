<!--
 * Created by PhpStorm.
 * User: anwarsarmiento
 * Email: asarmiento@sistemasamigables.com
 * Date: 8/6/17
 * Time: 17:37
 *-->
@extends('layouts.system')


@section('content')

    <div class="">

        <h1>{{ currentUser()->nameComplete() }}</h1>
        <div class="">
            Cedula: {{ currentUser()->identification_card }}
        </div>
    </div>
@endsection



