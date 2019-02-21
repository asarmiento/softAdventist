@extends('layouts.system')
@section('content')
    @if(currentUser()->whereUserBelong->cargo == 'tesorero')
<div  class="panel-body" style="width: 90%; margin: 0 auto; padding-top: 0em">
    <h2 style="text-align: center">Manual de la Iglesia revisión 2015 p.76-80</h2>
   <div class="panel-default">
        <div class="col-md-12">
            <div class="col-md-6" style="text-align: justify">
                <p>
                    <strong>El tesorero y la custodia de los fondos de la iglesia.</strong> El tesorero es el
                    custodio de todos los fondos de la iglesia, que están constituidos por:
                    <ul>
                    <li>1. fondos de la asociación,</li>
                    <li>2. fondos de la iglesia local,</li>
                    <li>3. fondos pertenecientes a las organizaciones auxiliares de la iglesia local.</li>
                    </ul>
                    El tesorero deposita todos los fondos (de la asociación, de la iglesia
                    local y los de las organizaciones auxiliares de la iglesia local) en un banco
                    o en una institución financiera en una cuenta abierta a nombre de la
                    iglesia, a no ser que la asociación autorice otro sistema.
                </p><p>
                    Los dirigentes y las organizaciones de la iglesia local
                    El excedente de los fondos de la iglesia puede ser depositado en una
                    cuenta de ahorro con la autorización de la junta directiva de la iglesia.
                    Cuando se muevan sumas elevadas destinadas a construcciones u otros
                    proyectos especiales, la junta directiva de la iglesia podrá autorizar la apertura
                    de cuentas bancarias para dichos proyectos. En todo caso, tales cuentas
                    serán manejadas por el tesorero, quien informará de las mismas, y de
                    todos los demás fondos, a la iglesia.
                    Todas las cuentas bancarias de la iglesia son exclusivamente para fondos
                    de la iglesia y no deben mezclarse con ninguna otra cuenta ni con fondos
                    personales.
                </p>
                <p>
                    <strong>Fondos de la asociación.</strong>
                    Los fondos de la asociación, que incluyen los
                    diezmos, todos los fondos misioneros regulares y los destinados a proyectos
                    especiales de la asociación y las instituciones, son fondos en custodia. El
                    tesorero de la iglesia, al final de cada mes, o con más frecuencia si así lo requiere
                    la asociación, debe enviar al tesorero de la asociación el total de los
                    fondos de la asociación recibidos en ese período. La iglesia no puede en
                    ningún caso tomar prestados, usar o retener los fondos de la asociación.
                </p>
                <p>
                    <strong>Método debido para el envío de fondos a la asociación.</strong>
                     El tesorero de
                    la iglesia, al enviar las remesas al tesorero de la asociación, donde sea
                    posible legalmente, debe extender todos los cheques, los giros bancarios,
                    o cualquier otro instrumento de pago a la orden de la asociación, y no a
                    la de una persona. Debe incluir con la remesa la hoja duplicada del libro
                    de tesorería de la iglesia. La asociación proporciona los formularios para
                    las remesas (ver pp. 139-142).
                </p>
            </div>
            <div class="col-md-6" style="text-align: justify">
                <p>
                    <strong>Fondos de la iglesia local.</strong> Los fondos de la iglesia local están constituidos
                    por los fondos para los gastos de la iglesia, los de proyectos de construcción
                    y reparación de la iglesia y los destinados a la ayuda de los pobres y necesitados.
                    Estos fondos pertenecen a la iglesia local y el tesorero los desembolsa
                    únicamente por autorización de la junta directiva o de una reunión
                    administrativa de la iglesia. Sin embargo, el tesorero pagará del mismo
                    fondo de gastos los cargos recurrentes autorizados por la junta directiva.
                </p><p>
                    <strong>Fondos de las organizaciones auxiliares. </strong> Los fondos de las organizaciones
                    auxiliares incluyen los destinados a programas misioneros, a Vida Familiar,
                    al Ministerio Juvenil Adventista, a los Servicios Comunitarios Adventistas
                    o Sociedad Dorcas, a los gastos de Escuela Sabática y la porción de los
                    fondos de los Ministerios de la Salud que pertenecen a la iglesia local, y
                    pueden incluir los de la escuela de la iglesia. Todo el dinero recibido por
                    esos órganos, y para el uso de ellos, tiene que ser entregado lo antes
                    posible al tesorero de la iglesia por el secretario correspondiente, por el
                    diácono o por la persona que haya recibido los fondos. Únicamente pueden
                    desembolsarse por orden del órgano auxiliar al que pertenezcan.
                    El tesorero extenderá un recibo de todos los fondos recibidos. Cuando reciba
                    el dinero de parte del tesorero, el secretario del órgano auxiliar
                    entregará el correspondiente recibo al tesorero.
                </p><p>
                    <strong>Recibos extendidos a los miembros.</strong> El tesorero debe entregar prontamente
                    a quien corresponda un recibo de todas y cada una de las sumas
                    de dinero recibidas por la iglesia, por pequeña que sea la cantidad, y debe
                    mantener una contabilidad minuciosa de todos los recibos y de todos los
                    pagos. Todas las ofrendas generales que no estén incluidas en sobres tienen
                    que ser contadas por el tesorero en presencia de otro dirigente de la
                    iglesia, preferentemente un diácono o una diaconisa, quien extenderá el
                    recibo correspondiente a tal dirigente.
                </p><p>
                    <strong>Conservación de los documentos financieros.</strong> Los documentos financieros,
                    los comprobantes, las facturas o las constancias de pago de todos
                    los fondos recibidos o desembolsados deben conservarse de acuerdo con
                    el sistema establecido por la asociación local.
                </p>
            </div>
        </div>
    </div>
</div>
        @else
        <div  class="panel-body" >
            <img src="/img/logo union.png" width="100%" height="100%" class="img-responsive">
        </div>
    @endif
@endsection
