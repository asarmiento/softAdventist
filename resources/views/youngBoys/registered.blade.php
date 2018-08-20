<!--
 * Created by PhpStorm.
 * User: Amwar
 * Date: 21/04/2017
 * Time: 09:28 AM
-->
<h1>El Departamento de Jovenes de la Asociación Central Sur de Costa Rica</h1>
@if($retirement->gender == 'man')
    <h2>Ya eres parte de los Jovenes con Identidad</h2>
@else
    <h2>Ya eres parte de las Jovenes con Identidad</h2>
@endif

<p>Tienes el Numero de inscripción: <strong><a>{{$retirement->code}}</a></strong></p>
<ul>
    <li>Email: <strong><a>{{$retirement->email}}</a></strong></li>
    <li>Iglesia: <strong><a>{{$retirement->church->name}}</a></strong></li>
</ul>
<p>
    Recuerda llevar el numero de Código el Sábado del Evento.
</p>

<h6><a href="http://friendlypos.net">Sistemas Amigables de Costa Rica</a></h6>
