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
        <div class="row cls-content">
            <div class="pull-right  " style="margin: 5px;"><a class="btn btn-default" href="{{route('contact')}}">Contactanos <i class="fa fa-send"></i></a></div>
            <div class="pull-right " style="margin: 5px;"><a class="btn btn-default" href="{{route('new-church')}}">Nueva Iglesia <i class="fa fa-map-marker"></i></a></div>
            <div class="panel-body panel">
                <h2>Inscripciones al Congreso Juvenil 2018 ACSCR <strong>“Se buscan Jovenes con Identidad”</strong>  Sitio de inscripción para directores.
                    Si no es director acuda a su director para que pueda hacer la inscripción</h2>
            </div>
            <div class="cls-content-sm panel">
                 <div class="panel-body">

<!--div style="padding: 5px">

<i>Inicia Sesión Con :</i><a class="" href="{{ route('social.auth', 'facebook') }}">
    <i class="fa fa-facebook-official fa-4x" aria-hidden="true"></i>
</a>

</div--><div class="pad-all btn btn-success" style="color: white">
        <a class="btn-link " style="color: white" href="{{ url('/ja') }}">
            Iniciar Sesión
        </a>

        </br>
    </div>

                </div>

                <div class="pad-all btn btn-primary" style="color: white">
                    <a class="btn-link " style="color: white" href="{{ route('register') }}">
                        Registrar
                    </a>

                    </br>
                    <p>Por primera vez.</p>
                </div>

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
                        v3.0.5
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

    <script>
  window.fbAsyncInit = function() {
	  FB.init({
		  appId      : '{your-app-id}',
		  cookie     : true,
		  xfbml      : true,
		  version    : '{latest-api-version}'
	  });
	  FB.AppEvents.logPageView();
  };

  (function(d, s, id){
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) {return;}
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js";
	  fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));


  FB.getLoginStatus(function(response) {
	  statusChangeCallback(response);
  });


  function checkLoginState() {
	  FB.getLoginStatus(function(response) {
		  statusChangeCallback(response);
	  });
  }
</script>
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

            cambiar();
 </script>
@endsection
