<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>JA ACSCR</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="css/reset.css" />

        <link rel="stylesheet" href="css/styles.css" />

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



            <div class="content">



            @if(\Carbon\Carbon::now()->format('Y-m-d')=='2017-05-29 ')
                    <div><h1>Hemos Cerrado la Inscripción</h1></div>
                    @else


                    <div class="content-box-green "  style="margin: 0 auto; text-align: center; width: 70%; align-content: center">
                        <h1>No te lo Puedes perder, Yo sé en Quien he Creído</h1>
                        <ul style="font-size: 14px; list-style: none; color: #000; font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;
                    text-align: left">Pasos a Seguir
                        <li>1. Registrarse como Usuario</li>
                        <li>2. Verificar su Email (Usted recibira un email para comprobacion, si no esta en la Bandeja de entrada busquedlo en spam)</li>
                        <li>3. Inicie sesion</li>
                        <li>4. Inscribase llenando todos los datos y subiendo una imagen del deposito</li>
                    </ul>
                    </div>
                    <div class="btn-button"  style="margin: 15px">   <a href="{{ url('/register') }}" class="content-box-green">INSCRIBETE</a>


                </div>
                    <div class="timer-area">
                        <ul id="countdown">
                            <li> <span class="days">00</span>
                                <p class="timeRefDays">Dias</p>
                            </li>
                            <li> <span class="hours">00</span>
                                <p class="timeRefHours">Horas</p>
                            </li>
                            <li> <span class="minutes">00</span>
                                <p class="timeRefMinutes">Minutos</p>
                            </li>
                            <li> <span class="seconds">00</span>
                                <p class="timeRefSeconds">Segundos</p>
                            </li>
                        </ul>
                    </div>

                    <div class="footer" style="background-color: #f7f7f7; text-align: center; ">
                    <a href="http://friendlypos.net" class="text-color"> Elaborado por Sistemas Amigables de Costa Rica SAOR S.A</a>
                </div>

            </div>
@endif

        </div>
        <script
                src="https://code.jquery.com/jquery-3.2.1.js"
                integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
                crossorigin="anonymous"></script>
        <script src="http://code.jquery.com/jquery-latest.js"></script>


            <script src="js/countdown.js"></script>
        <script>

            $(document).ready(function(){
                $("#countdown").countdown({
                        date: "29 may 2017 23:00:00",
                        format: "on"
                    },

                    function() {
// callback function
                    });
            });


        </script>

    </div>
    </body>

</html>
