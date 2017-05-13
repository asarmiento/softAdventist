<!--
 * Created by PhpStorm.
 * User: anwarsarmiento
 * Email: asarmiento@sistemasamigables.com
 * Date: 20/4/17
 * Time: 09:51
-->
<h1> {{currentUser()->nameComplete()}} </h1>
<h1>El Departamento de Jovenes de la Asociación Central Sur de Costa Rica</h1>
@if($data['gender'] == 'man')
    <h2>Ya eres parte de los Jovenes, que pondran a prueba su fe</h2>
@else
    <h2>Ya eres parte de las Jovenes, que pondran a prueba su fe</h2>
@endif

<p>Tienes el Numero de inscripción: <strong><a>{{$data['code']}}</a></strong> </p>
<p>
   Verifica que todos tus datos son correctos, en caso que debes corregir alguna información ponte en contacto al correo
    <strong><a>jaacscr@contadventista.org</a></strong> .
</p>
<ul>
    <li>Email: <strong><a>{{currentUser()->email}}</a></strong></li>
    <li>Edad: <strong><a>{{$data['age']}}</a></strong></li>
    <li>Iglesia: <strong><a>{{$data['church']}}</a></strong></li>
    <li>Dirección: <strong><a>{{$data['address']}}</a></strong></li>
    <li>Talla: <strong><a>{{$data['shirt_size']}}</a></strong></li>
    <li>Banco: <strong><a>{{$data['bank']}}</a></strong></li>
    <li>Metodo de Pago: <strong><a>{{$data['payment_method']}}</a></strong></li>
    <li>Numero Comprobante: <strong><a>{{$data['voucher']}}</a></strong></li>
    <li>Monto: <strong><a>{{number_format($data['amount'],2)}}</a></strong></li>
    <li>Saldo pendiente: <strong><a>{{number_format(38500-\App\Entities\Retirement::where('young_boy_id',$youngBoy->id)->sum('amount'),2)}}</a></strong></li>
</ul>
<p>
    Recuerda que la fecha limite de pago es ...., preparate para disfrutar de una aventura junto a muchos jovenes mas.
</p>

<h6><a href="http://friendlypos.net">Sistemas Amigables de Costa Rica</a></h6>