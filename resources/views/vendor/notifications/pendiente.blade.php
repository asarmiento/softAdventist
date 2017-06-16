<!--
 * Created by PhpStorm.
 * User: anwarsarmiento
 * Email: asarmiento@sistemasamigables.com
 * Date: 20/4/17
 * Time: 09:51
-->

<p>Estimado joven {{$boy->user->nameComplete()}}

    El dia de ayer fue la fecha limite para cancelar tu derecho de participacion al retiro juvenil del 2017
    Tu saldo pendiente a la fecha es de {{number_format((38500-$boy->retirements()->sum('amount')),2)}}
    Por favor debes comunicarte dentro de las proximas 24 horas al  <strong><a> telefono 6192 5448 con Eduardo Artavia,</a></strong>  de lo contrario
    tu espacio pasara a estar disponible para otra persona de la lista de espera.



<h6 class="text-center"><a href="http://friendlypos.net">Sistemas Amigables de Costa Rica SAOR S.A.</a></h6>

