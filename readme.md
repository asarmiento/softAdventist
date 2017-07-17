<p align="center"><img width="200" height="113" src="http://logo.contadventista.org/Logo-sistemas-amigables.png"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Acerca de SoftAdventist

SoftFriendly es una aplicación elaborada en laravel <img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"> (Backend) y Vue.js 2 (frontend), Hecho por Sistemas Amigables de Costa Rica SAOR S.A. como un apoyo a la Iglesia Adventista del Septimo Dia de Quepos.

Fue creada al observar la necesidad de un sistema para los tesoreros(as) de las diferentes iglesias Adventistas del Septimo Dia. tambien como un sistema de inscripción para diferentes retiros que elaboran las iglesias o los campos locales.

La iglesia que se utilizo para hacer la primera implementacion es la [Iglesia Adventista de Quepos](https://www.facebook.com/Se%C3%B1or-Transformame-Quepos-1258988047526063/), tambien fue utilizada la parte de inscripción por el departamento de Jovenes de la Asociación Central Sur de Costa Rica.

Si desea que su Iglesia utilice este sistema favor contactar a Anwar Sarmiento [asarmiento@sistemasamigables.com](mailto:asarmiento@sistemasamigables.com)


- Este sistema le ayudara a controlar 100% todas las entradas y salidas de su iglesia, le ahorra tiempo ya que 
solo debe registrar cada uno de sus ingresos (Control Interno y sobres de Diezmos) y sus salidas 
(Cheques y Facturas de Gastos), genera los informes semanales y los recibos para los miembros en caso,
que el sobre de diezmo no lo traiga incluido.

## Iglesia o Grupo

Las iglesias podran llevar control de sus ingresos y gastos, tambien control de los informes a los campos locales, control de los materiales de escuela sabatica u otros gastos.
<ul>
<li>Control Interno
<ul><li>
<p>
Debe registrar los datos del control interno de cada sabado y escanear el
original que tiene las firmas de las personas que ayudaron a contar el dinero
junto con los sobres. 
</p>	
<p>
	Esa imagen sera enviada al campo local al cual pertenece su iglesia cuando 
	registre el deposito al campo local correspondinte a los informes.
</p>	
</li></ul>
</li>	
<li> Sobres de Diezmos
<ul><li><p>
	Debe registrar cada no de los sobres depositados en sabado por la mañana e incluidos 
 	en el control interno del sabado.
</p><p>
    SoftAdventist Registrara las ofrendas y Fondos de Inversion en el plan 60,20,20.
</p><p>
	Todas las ofredas especificas que sean depositadas indicadas en el sobre de Diezmos 
	debe Registrar cada monto donde corresponde segun como lo haya indicado la persona 
	que entrego el sobre.
</p></li></ul>
</li>
<li> Recibos
<ul><li><p>
	Por cada uno de los sobres de diezmos que son registrados en el sistema generara un
	recibo, que se mostrara en el momento de finalizar el proceso de registros. 
</p><p>
	Podra descargarlo en ese momento o Imprimirlo es un archivo PDF, tambien puede 
	reimprimir un recibo las veces que desee, solo que iran con la leyenda copia. 
</p></li></ul>
</li>
<li> Control Semanal
<ul><li><p>
	Una vez finalizado el proceso de registro de los sobres de Diezmos tambien podra 
	imprimir o descargar el informe semanal las veces que desee. 
</p></li></ul>
</li>
<li> Cuentas Bancarias
<ul><li><p>
	El sistema le ayuda a llevar el control de sus cuentas bancarias, para indicarle 
	el saldo que debe tener segun los ingresos y salidas de su iglesia. 
</p><p>
	SoftAdventist le permite controlar una o mas cuentas bancarias, actualmente solo 
	control las cuentas en moneda local. <strong>"proxima version multimonedas"</strong>
</p></li></ul>
</li>
<li> Departamentos
<ul><li><p>
	SoftAdventist le controla el presupuesto de cada uno de los departamentos de su iglesia. 
</p><p>
	El sistema puede trabajar por porcentajes en cada departamento sin importar el porcentage 
	que tenga, SoftAdventist toma el 60% de las ofrendas y los reparte en cada departamento segun
	sus porcentages.. 
</p>
<p>
	En Caso que su iglesia trabaja con un fondo en comun sin porcentages por departamento, SoftAvdentist
	tambien puede controlar los fondos de su iglesia. 
</p>
<p>
	SoftAdventist le permite poder tener sub cuentas de ingresos o Gastos para cada departamento, segun como 
	sea necesario para su iglesia por ejemplo:
	<ul><li>Ingreso Sub Cuenta de Fondo de Iglesia
    		<ul>
    		<li>Pro-Construccón</li>
    		<li>Revistas Prioridades</li>
    		</ul>
    	</li>
    	<li>Ingreso Sub Cuenta de Escuela Sabatica
            <ul>
            	<li>Materiales Escuela Sabatica</li>
            </ul>
        </li>
    </ul>
	<ul><li>Gastos de Iglesia
		<ul>
		<li>Limpieza Iglesia</li>
		<li>Energia Electrica</li>
		<li>Agua</li>
		<li>Telefono</li>
		</ul>
	</li></ul>
</p></li></ul>
</li>
<li> Cheques
<ul><li><p>
	Debe registrarse todos los cheques elaborados de todas las cuentas bancarias de la iglesia, incluso 
	 los cheques anulados tambien, igualmente debe escanear la copia del cheque con la firma de recibido
	 por la persona a quien se dirigio el cheque.
</p><p>
	SoftAdventist desminuira cada cheque del saldo de su cuenta bancaria donde corresponda el mismo.
</p></li></ul>
</li>
<li> Gastos
<ul><li><p>
	Cada gasto esta ligado a una sub cuenta de ingresos de un departamento segun sea la necesidad de la
	 iglesia, tambien esta ligado a un cheque o en su defecto a cobros bancarios por emision de chequeras.
</p><p>
	Cada gasto debe estar respaldado por una factura o comprobante de caja <strong>(si la junta de la 
	Iglesia ha tomado un voto donde permite al tesorero(a) registrar gastos sin factura solo con un 
	comprobante de caja firmao por el director del departamento).</strong> 
</p>
</li></ul>
</li>
<li> Miembros de Iglesia
<ul><li>
<p>
	Se deben registrar a todos los miembros de Iglesia adultos, adolecentes, niños o visitas que han 
	depositado un sobre de diezmos. 
</p>
</li></ul>
</li>
<li> Control de Material Escuela Sabaticas
<ul><li><p>
	Sabemos lo complicado es poder controlar los pagos de materiales de escuela sabatica que son entregados 
	a los miembros de iglesia. SoftAdventist le aydua a poder controlar esos pagos hecho por los miembros
	segun el material que se le fue entregado.
</p></li></ul>
</li>
<li> Depositos de la Iglesia
<ul><li>
<p>
	Debe depositar todo el dinero recibido cada sabado a las cuentas de la iglesia y registrar esos 
	mismos depositos en SoftAdventist para poder controlar adecuadamente los movimientos de las cuentas
	bancarias y quede registro de los ingresos y salidas en el sistema. 
</p>
</li></ul>
</li>
<li> Depositos al Campo Local
<ul><li>
<p>
	Una vez hecho el deposito del cheque emitido en la cuenta del campo local al que pertenece la iglesia,
	debe escanearlo luego registralo en SoftAdventist, le aparecera los informes que fueron seleccionados 
	a la hora de registro del cheque. 
</p>
<p>
	Cuando finaliza el registro del deposito SoftAdventist enviara un email al campo local con copia al email 
	del pastor de su iglesia que incluira. <strong>Imagen Control Interno firmado, todos los informes semanales
	imagen del deposito hecho a la cuenta del campo local.</strong>
</p>
</li></ul>
</li>
</ul>

## Otras Opciones

Este sistema tambien cuenta con un modulo de contro de registros para una actividad
de la iglesia o campo Local.
Si tiene una actividad programada para su Iglesia o Campo Local solo contacte a
Anwar Sarmiento el email 
[asarmiento@sistemasamigables.com](mailto:asarmiento@sistemasamigables.com).

El se encargara de darle los accesos y darle la ruta para que todos las personas 
puedan registrarse.

## Vulnerabilidades de Seguridad

Si descubres una vulnerabilidad de seguridad en SoftAdventist favor comunicarlo a 
Anwar Sarmiento al email 
[asarmiento@sistemasamigables.com](mailto:asarmiento@sistemasamigables.com)