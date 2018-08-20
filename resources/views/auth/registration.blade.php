<!--
 * Created by PhpStorm.
 * User: anwarsarmiento
 * Email: asarmiento@sistemasamigables.com
 * Date: 20/4/17
 * Time: 09:51
-->
<h1>Bienvenido(a): {{$user->nameComplete()}} </h1>
<h2>Sistema de Control Departamento de Jovenes ACSCR</h2>
<h3>Iglesia : {{$user->member->church->name}}</h3>
<p>
    <label>Debe Presionar el link de Abajo para aceptar el correo, luego tedaran de alta para que puedas entrar al sistema</label>
        <a href="{{$url}}">Presiona Aqui</a>
</p>