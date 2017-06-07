<!--
 * Created by PhpStorm.
 * User: anwarsarmiento
 * Email: asarmiento@sistemasamigables.com
 * Date: 20/4/17
 * Time: 09:51
-->
<h2> Hola {{$boy->user->nameComplete()}} </h2>
<h3>El Departamento de Jovenes de la Asociación Central Sur de Costa Rica</h3>

    <h4>Disculpas por los inconvenientes</h4>

<p>Tienes el Numero de inscripción: <strong><a>{{$boy->code}}</a></strong> 
Su saldo pendiente es: {{number_format((38500-$boy->retirements()->sum('amount')),2)}}</p>
<ul>
    <li>Cédula: <strong><a>{{$boy->user->identification_card}}</a></strong></li>
    <li>Edad: <strong><a>{{$boy->age}}</a></strong></li>
    <li>Iglesia: <strong><a>{{$boy->church}}</a></strong></li>
    <li>Dirección: <strong><a>{{$boy->address}}</a></strong></li>
</ul>
<p>
    Recuerda que la fecha limite de pago es 15 de junio del 2017, preparate para disfrutar de una aventura junto a muchos jovenes mas.
</p>



<h6 class="text-center"><a href="http://friendlypos.net">Sistemas Amigables de Costa Rica SAOR S.A.</a></h6>

