<!--
 * Created by PhpStorm.
 * User: anwarsarmiento
 * Email: asarmiento@sistemasamigables.com
 * Date: 20/4/17
 * Time: 09:51
-->
<h1> Hola {{$user->nameComplete()}} </h1>
<h1>El Departamento de Jovenes de la Asociación Central Sur de Costa Rica</h1>


@if($user->youngBoy()->count() > 0)
<p>Tienes el Numero de inscripción: <strong><a>{{$user->youngBoy->code}}</a></strong> </p>
@else
  <p>No tenemos numero de inscripcion de usted.</p>
@endif
<p>
    Te Felicitamos por haberte inscripto, para el gran retiro de jóvenes del 30 junio al 2 Julio.
</p>
<p>
    Disculpas las molestias si tuviste problema al registrarte si este email no lleva tu numero de registro es por que todavía no estas inscrito,
    favor iniciar sesión con este email y la contraseña que hayas registrado. Si no la recuerdas restablécela.
    Si al ingresar en la parte de abajo no te sale los depósitos que hayas hecho entonces favor registrarlo.
    Cualquier ayuda que ocupes contactarnos al correo jaacscr@contadventista.org con tus datos.

</p>
<p>
    Que tengas un Feliz dia.

</p>
<p>

    Agradecemos su ayuda.
</p>



<h6 class="text-center"><a href="http://friendlypos.net">Sistemas Amigables de Costa Rica</a></h6>

