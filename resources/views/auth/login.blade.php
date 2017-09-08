@extends('layouts.app')
@section('style')
    <style>
        .demo-my-bg{
            background-image : url("img/bg-img/1.jpg");
        }
    </style>
@endsection
@section('content')
    <div id="container" class="cls-container">

        <!-- BACKGROUND IMAGE -->
        <!--===================================================-->
        <div id="bg-overlay" class="bg-img"  ></div>


        <!-- LOGIN FORM -->
        <!--===================================================-->
        <div class="cls-content">
            <div class="pull-right  " style="margin: 5px;"><a class="btn btn-default" href="{{route('contact')}}">Contactanos <i class="fa fa-send"></i></a></div>
            <div class="pull-right " style="margin: 5px;"><a class="btn btn-default" href="{{route('new-church')}}">Nueva Iglesia <i class="fa fa-map-marker"></i></a></div>
            <div class="cls-content-sm panel">

                <div class="panel-body">
                    <div class="mar-ver pad-btm">
                        <h3 class="h4 mar-no">Iniciar Sesión</h3>
                        <p class="text-muted">Inicie Sesión con su Email</p>
                    </div>
                    @if(session('alert'))
                        <p class="alert alert-success">{{session('alert')}}</p>
                    @endif
                    <form  role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}"
                                   placeholder="Correo Electrónico" autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" class="form-control" placeholder="Contraseña" name="password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="checkbox pad-btm text-left">
                            <input id="demo-form-checkbox" name="remember"  {{ old('remember') ? 'checked' : '' }} class="magic-checkbox" type="checkbox">
                            <label for="demo-form-checkbox" >Recordarme</label>
                        </div>
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Iniciar Sesion</button>
                    </form>
                </div>

                <div class="pad-all">
                    <a class="btn-link mar-rgt" href="{{ route('password.request') }}">
                        Restablecer mi Contraseña!
                    </a>
                </br>
                    <a href="https://asarmiento.github.io/softAdventist/" target="_blank" class="btn-link  ">Conoce mas de SoftAdventist</a>

                    <div class="media pad-top bord-top">
                        <div class="pull-right">
                            <a href="#" class="pad-rgt"><i class="ti-facebook icon-lg text-primary"></i></a>
                            <a href="#" class="pad-rgt"><i class="ti-twitter-alt icon-lg text-info"></i></a>
                            <a href="#" class="pad-rgt"><i class="ti-google icon-lg text-danger"></i></a>
                        </div>

                    </div>
                    <div class=" text-center">
                        Elaborado por Sistemas Amigables de Costa Rica SAOR S.A.
                    </div>
                    <div class=" text-center">
                        v3.0.4
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
            function rand(n){
// creamos un numero al azar entre 1 y 10 (o cual sea la cantidad de imágenes)
                return(Math.floor(Math.random() * n + 1 ));
            }
//guardas imagenes en el array
            var objetos = new Array(
                "/img/bg-img/bg-img-1.jpg",
                "/img/bg-img/bg-img-2.jpg",
                "/img/bg-img/bg-img-3.jpg",
                "/img/bg-img/bg-img-4.jpg",
                "/img/bg-img/bg-img-5.jpg",
                "/img/bg-img/bg-img-6.jpg",
                "/img/bg-img/bg-img-7.jpg",
                "/img/bg-img/1.jpg",
                "/img/bg-img/2.jpg",
                "/img/bg-img/3.jpg",
                "/img/bg-img/4.jpg",
                "/img/bg-img/5.jpg",
                "/img/bg-img/6.jpg",
                "/img/bg-img/7.jpg");

            function cambiar(){
                document.getElementById("bg-overlay").style.backgroundImage= "url("+objetos[rand(14)-1]+")";
            }
 </script>
@endsection
