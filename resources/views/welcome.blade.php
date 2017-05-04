<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>JA ACSCR</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Latest compiled and minified CSS -->
         <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                float: left;
                height: 200px;
                text-align: center;
                width: 100%;
            }

            .btn-button {
                font-size: 84px;
                color: #000;
                width: 100%;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .logo-text{
                float: left;

            }
            .logo-baner{
                float: left;

            }
            .text-color{
                color: #000;
                font-size: 16px;
                text-align: center;
                text-decoration-line: none;
            }
            .content-box-blue,
            .content-box-green,{
                margin: 0 0 25px;
                overflow: hidden;
                padding: 20px;
            }

            .content-box-blue {
                background-color: #d8ecf7;
                border: 1px solid #afcde3;
                text-decoration-line: none;
            }

            .content-box-green {
                background-color: #d9edc2;
                border: 1px solid #b2ce96;
                text-decoration-line: none;
            }
        </style>
    </head>
    <body>
    <div id="app">
    <?php \App\Entities\Visitor::create(['ip'=>\Illuminate\Support\Facades\Request::ip(),'date'=>\Carbon\Carbon::now()->format('Y-m-d')]); ?>
    <!--div class="baner ">
        <IMG src="img/baner.jpeg" width="400" height="600"/>
    </div-->
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                @if (Auth::guest())
                    <a href="{{ route('login') }}">Iniciar Sesión</a>
                @endif
            </div>
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/registrado/inscription') }}">Inicio</a>

                    @endif
                </div>
            @endif

                <div class="logo-baner">
                    <img src="/img/baner.jpeg" height="700" width="400">
                </div>
            <div class="content">
                <div class="btn-button">
                    <ul style="font-size: 14px; list-style: none; color: #000; font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;
                    text-align: left">Pasos a Seguir
                        <li>1. Registrarse como Usuario</li>
                        <li>2. Verificar su Email (Usted recibira un email para comprobacion, si no esta en la Bandeja de entrada busquedlo en spam)</li>
                        <li>3. Inicie sesion</li>
                        <li>4. Inscribase llenando todos los datos y subiendo una imagen del deposito</li>
                    </ul>
                    <a href="{{ url('/register') }}" class="content-box-green">INSCRIBETE</a>
                    <a href="" class="content-box-blue">INFORMACIÓN</a>
                </div>
                <div>
                    <video src="/videos/promo.mp4" autoplay loop controls width="500" height="400"></video>
                </div>
                <div class="content-box-green"><a>Si tienes algun problema con la inscripción escribenos a: jaacscr@contadventista.org</a>
                </div>
                <div class="footer" style="background-color: #f7f7f7; text-align: center; ">
                    <a href="http://friendlypos.net" class="text-color"> Elaborado por Sistemas Amigables de Costa Rica SAOR S.A</a>
                </div>
            </div>


        </div>


    </div>
    </body>

</html>
