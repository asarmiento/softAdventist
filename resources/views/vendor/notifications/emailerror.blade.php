<!--
 * Created by PhpStorm.
 * User: anwarsarmiento
 * Email: asarmiento@sistemasamigables.com
 * Date: 20/4/17
 * Time: 09:51
-->
<h1> Hola {{$boy->user->nameComplete()}} </h1>
<h1>El Departamento de Jovenes de la Asociación Central Sur de Costa Rica</h1>

    <h2>Te desea un Feliz Sábado</h2>


<p>Tienes el Numero de inscripción: <strong><a>{{$boy->code}}</a></strong> Su saldo pendiente es: {{number_format($boy->retirements()->sum('amount'),2)}}</p>
<p>
    <img src="{{asset('img/publi.jpeg')}}" width="528" height="680">
</p>



<h6 class="text-center"><a href="http://friendlypos.net">Sistemas Amigables de Costa Rica</a></h6>

