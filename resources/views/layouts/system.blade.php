<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tesoreria') }}</title>

    <!-- Font -->
    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nifty.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pace.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/magic-check.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/line-icons/premium-line-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/solid-icons/premium-solid-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/demo/nifty-demo-icons.min.css')}}" rel="stylesheet">

@yield('style')
<!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="container" class="effect mainnav-sm">
    <!-- NAVBAR -->
        @include('layouts.partials.navBar')
    <!-- END NAVBAR -->
    <div class="boxed">

        <!--CONTENT CONTAINER-->
            @include('layouts.partials.contentContantainer')
        <!--END CONTENT CONTAINER-->


        <!--MAIN NAVIGATION-->
            @include('layouts.partials.mainNavigation')
        <!--END MAIN NAVIGATION-->


        <!--ASIDE-->
            @include('layouts.partials.aside')
        <!--END ASIDE-->

    </div>

        @include('layouts.partials.footer')


    <!-- SCROLL PAGE BUTTON -->
    <!--===================================================-->
    <button class="scroll-top btn">
        <i class="pci-chevron chevron-up"></i>
    </button>
    <!--===================================================-->


</div>
<!--===================================================-->
<!-- END OF CONTAINER -->


<!-- Scripts -->

<script src="{{ asset('js/pace.min.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/nifty.min.js') }}"></script>
@yield('scripts')
</body>
</html>