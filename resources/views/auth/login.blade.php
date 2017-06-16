@extends('layouts.app')
@section('style')
    <style>
        .demo-my-bg{
            background-image : url("img/1.jpg");
        }
    </style>
@endsection
@section('content')
    <div id="container" class="cls-container">

        <!-- BACKGROUND IMAGE -->
        <!--===================================================-->
        <div id="bg-overlay" class="bg-img" ></div>


        <!-- LOGIN FORM -->
        <!--===================================================-->
        <div class="cls-content">
            <div class="cls-content-sm panel">
                <div class="panel-body">
                    <div class="mar-ver pad-btm">
                        <h3 class="h4 mar-no">Iniciar Sesion</h3>
                        <p class="text-muted">Inicie Sesion con su Cuenta</p>
                    </div>
                    @if(session('alert'))
                        <p class="alert alert-success">{{session('alert')}}</p>
                    @endif
                    <form  role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="checkbox pad-btm text-left">
                            <input id="demo-form-checkbox" name="remember"  {{ old('remember') ? 'checked' : '' }} class="magic-checkbox" type="checkbox">
                            <label for="demo-form-checkbox" >Remember me</label>
                        </div>
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Iniciar Sesion</button>
                    </form>
                </div>

                <div class="pad-all">
                    <a class="btn-link mar-rgt" href="{{ route('password.request') }}">
                        Restablecer mi Contraseña!
                    </a>
                    <a href="#" class="btn-link mar-lft"></a>

                    <div class="media pad-top bord-top">
                        <div class="pull-right">
                            <a href="#" class="pad-rgt"><i class="ti-facebook icon-lg text-primary"></i></a>
                            <a href="#" class="pad-rgt"><i class="ti-twitter-alt icon-lg text-info"></i></a>
                            <a href="#" class="pad-rgt"><i class="ti-google icon-lg text-danger"></i></a>
                        </div>
                        <div class=" text-center">
                            Elaborado por Sistemas Amigables de Costa Rica SAOR S.A.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--===================================================-->



    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->


@endsection
@section('scripts')

    <script type="text/javascript">
        $(document).ready(function () {
            $("#bg-overlay").onmousemove(function () {
                alert('hola');
            });
            /*function imagen() {
                var imagen = document.getElementById('');

                var misimagenes=['img/bg-img/bg-img-1.jpg',
                    'img/bg-img/bg-img-2.jpg',
                    'img/bg-img/bg-img-3.jpg',
                    'img/bg-img/bg-img-4.jpg',
                    'img/bg-img/bg-img-5.jpg',
                    'img/bg-img/bg-img-6.jpg',
                    'img/bg-img/bg-img-7.jpg',
                ];

                for (i=0;i< misimagenes.length;i++){

                    var rango_superior = 1;
                    var rango_inferior = 5;
                    var aleatorio = Math.floor(Math.random()*(rango_superior-(rango_inferior-1))) + rango_inferior;
                    imagen.appendChild(document.write('style="background-image: url('+misimagenes[aleatorio]+')"'));

                    //  document.getElementById("#bg-overlay").write("'")

                }
            }*/
        })

    </script>
@endsection
