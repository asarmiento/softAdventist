@extends('layouts.system')

@section('content')
<div id="app">
    <create-church-deposits title="Depositos de la Iglesia" url="save-church-deposit"
                            banks="{{json_encode($banks)}}"
                            banks="{{json_encode($banks)}}"
    ></create-church-deposits>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
