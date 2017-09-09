@extends('layouts.system')

@section('content')
    <div id="app">
        <div class="col-md-12 col-lg-10">
            <!--Info Accordion-->
            <!--===================================================-->
            <div class="panel-group accordion" id="demo-acc-info">
                <div class="panel panel-info panel-colorful">
                    <!--Accordion title-->
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-parent="#demo-acc-info" data-toggle="collapse" href="#demo-acd-info-1"
                               aria-expanded="false" class="collapsed">Como utilizo SoftAdventist</a>
                        </h4>
                    </div>
                    <!--Accordion content-->
                    <div class="panel-collapse collapse" id="demo-acd-info-1" aria-expanded="false"
                         style="height: 0px;">
                        <div class="panel-body">
                            Para poder utlizar SoftAdventist, solo debe contactar a info@sistemasamigables.com
                            debe enviarnos los siguientes datos:
                            <ul>
                                <li>Iglesia
                                    <ul>
                                        <li>Nombre</li>
                                        <li>Dirección</li>
                                        <li>Telefono (opcional)</li>
                                        <li>Email (opcional)</li>
                                    </ul>
                                </li>
                                <li>Tesorero
                                    <ul>
                                        <li>Nombre</li>
                                        <li>Dirección (opcional)</li>
                                        <li>Telefono (opcional)</li>
                                        <li>Email </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info panel-colorful">
                    <!--Accordion title-->
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-parent="#demo-acc-info" data-toggle="collapse" href="#demo-acd-info-2"
                               class="collapsed" aria-expanded="false">Collapsible Group Item #2</a>
                        </h4>
                    </div>
                    <!--Accordion content-->
                    <div class="panel-collapse collapse" id="demo-acd-info-2" aria-expanded="false"
                         style="height: 0px;">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                            squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                            nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                            single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft
                            beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice
                            lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you
                            probably haven\'t heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="panel panel-info panel-colorful">
                    <!--Accordion title-->
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-parent="#demo-acc-info" data-toggle="collapse" href="#demo-acd-info-3" class=""
                               aria-expanded="true">Collapsible Group Item #3</a>
                        </h4>
                    </div>
                    <!--Accordion content-->
                    <div class="panel-collapse collapse in" id="demo-acd-info-3" aria-expanded="true">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                            squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                            nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                            single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft
                            beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice
                            lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you
                            probably haven\'t heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
            </div>
            <!--===================================================-->
            <!--End Info Accordion -->
        </div>
        <div class="row ">
            <div class="col-md-10  ">
                <div class="panel align-content-center">
                    <div class="panel-body">
                        <a name="seccion0"></a>
                        <table cellspacing=0 cellpadding=0 width="75%" align=center border=0>
                            <tbody>
                            <tr>
                                <td>
                                    <div>
                                        <img class=folding height=18
                                             src="./imagenes/ayuda/btnadd.gif" width=20><a
                                                class=folding> &nbsp;información general</a>
                                        <ul style="display: none; list-style-image: url(../imagenes/bd14582_.gif)">
                                            <li><a href="#seccion1">ingreso al sistema</a></li>
                                            <li><a href="#seccion2">sesión de usuario</a></li>
                                            <li><a href="#seccion3">cambiar clave</a></li>
                                            <li><a href="#seccion4">tipo de cambio</a></li>
                                            <li><a href="#seccion5">salir del sistema</a></li>
                                            <li><a href="#seccion41">mensajes de error</a></li>
                                            <li><a href="#seccion47">requerimientos del sistema</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div><img class=folding height=18
                                              src="./imagenes/ayuda/btnadd.gif" width=20>
                                        <a class=folding> &nbsp;administración del sistema</a>
                                        <ul style="display: none; list-style-image: url(../imagenes/bd14582_.gif)">
                                            <li><a href="#seccion15">mantenimiento de roles</a></li>
                                            <li><a href="#seccion12">mantenimiento de usuarios</a></li>
                                            <li><a href="#seccion13">mantenimiento de entidades</a></li>
                                            <li><a href="#seccion14">mantenimiento de países</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div><img class=folding height=18
                                              src="./imagenes/ayuda/btnadd.gif" width=20>
                                        <a class=folding> &nbsp;procesos de remesas</a>
                                        <ul style="display: none; list-style-image: url(../imagenes/bd14582_.gif)">
                                            <li><a href="#seccion22">recepción de remesas</a>
                                            <li><a href="#seccion23">entrega de remesas</a>
                                            <li><a href="#seccion24">consultas de remesas</a>
                                            <li><a href="#seccion25">anular remesas</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div><img class=folding height=18
                                              src="./imagenes/ayuda/btnadd.gif" width=20><a
                                                class=folding> &nbsp;liquidación de remesas</a>
                                        <ul
                                                style="display: none; list-style-image: url(../imagenes/bd14582_.gif)">
                                            <li><a href="#seccion26">solicitar liquidación de remesas entregadas</a>
                                            <li><a href="#seccion27">compensar a entidad</a>
                                            <li><a href="#seccion28">liquidar a folade</a>
                                            <li><a href="#seccion29">confirmar liquidación a folade</a>
                                            <li><a href="#seccion30">reportes de solicitudes de liquidación</a>
                                            <li><a href="#seccion31">reportes de compensaciones a entidades</a>
                                            <li><a href="#seccion32">reportes de liquidaciones a folade</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </br>
                        <table cellspacing=0 cellpadding=0 width="75%" border="0">
                            <tbody>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><a name=seccion1></a><em><strong><font
                                                        color=#ffffff>ingreso al sistema</font></strong></em></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para ingresar al sistema de remesas instantáneas el usuario debe
                                    digitar el identificador de usuario y la clave proporcionados por el administrador
                                    de su
                                    organización en la pantalla de inicio.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="154" src="imagenes/ayuda/inicio.gif"
                                                           width="492"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>una vez digitados dichos datos debe hacerse click en el
                                    botón "iniciar sesi&oacute;n" y si los datos proporcionados son correctos y v&aacute;lidos
                                    ingresar&aacute; al sistema.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>en caso de que aparezca el mensaje <strong>"ha digitado un usuario inválido o
                                        una clave incorrecta, intente de nuevo"</strong> verifique que haya escrito los
                                    datos
                                    correctamente, verifique también que la tecla mayúscula no esta activa
                                    en el teclado.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba" src="imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name=seccion2></a>sesión de usuario</font></strong></em>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>cuando un usuario ingresa al sistema se inicia una "sesión de usuario" que
                                    finalizará 5 minutos en caso de que el usuario no realice ninguna actividad,
                                    en cuyo caso el sistema mostrará la página de login con el mensaje <strong>
                                        "su sesión ha sido cerrada porque han transcurrido 5 minutos sin
                                        modificaciones"</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba" src="imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name=seccion3></a>cambiar clave </font></strong></em></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para cambiar su contraseña debe accesar a la opción del menu
                                    <em>"cambiar clave". </em>con esto el usuario podrá modificar su clave de
                                    acceso al sistema. para cambiar su contraseña deberá digitar todos los datos que se
                                    le
                                    solicitan.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="177"
                                                           src="imagenes/ayuda/cambiar_clave.gif" width="580"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba" src="imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><a name="seccion4"></a><em><strong><font
                                                        color="#ffffff">tipo de cambio</font></strong></em></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para consultar el tipo de cambio por país deberá
                                    hacer click sobre la opcin "tipo de cambio" del menú principal.
                                    con esto se abrirá una ventana aparte con la
                                    información del tipo de cambio al día de hoy de distintos paises.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name="seccion5"></a>salir del sistema</font></strong></em>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para salir del sistema correctamente debe seleccionar la opción "cerrar sesión"
                                    del menú principal. sin embargo, el sistema automáticamente cerrará la sesión
                                    después de 5 minutos
                                    sin recibir señales del que usuario.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name=seccion41></a>mensajes de error</font></strong></em>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>siempre que tenga que llenar los datos de un formulario, el sistema validará
                                    dichos datos, es así que cuando un dato requerido no es digitado o un correo
                                    electrónico no posee un formato correcto, el sistema mostrará un mensaje donde
                                    se indica los errores que se cometieron al ingresar los datos.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align="center"><img height="178"
                                                             src="./imagenes/ayuda/mensaje_error.gif"
                                                             width="434"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name=seccion47></a>requerimientos del
                                                    sistema</font></strong></em></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para que el sistema funcione correctamente es importante conocer
                                    cuales son los requerimientos mínimos que debe tener una computadora
                                    cliente.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>lo primero es tener habilitado el javascript en el internet explorer.
                                    puede verificar si lo tiene en el menú herramientas de ie ingresando en
                                    opciones de internet
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height=485
                                                           src="./imagenes/ayuda/requerimientos.jpg"
                                                           width=463></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>es importante hacer notar que el sistema está hecho para internet
                                    explorer y podrían existir algunas diferencias si se usa con otro tipo de
                                    navegador.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>las páginas web están diseñadas para una resolución de 800 x 600
                                    píxeles, por lo que utilizar otra configuración puede afectar el diseño
                                    gráfico de las mismas.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>el sistema esta diseñado para versiones recientes del internet
                                    explorer, por lo que podrían existir variaciones con versiones muy viejas.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#336699">
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name="seccion15"></a>mantenimiento de roles</font></strong></em>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>con está opción el usuario administrador del sistema podrá obtener
                                    un listado de todos los roles registrados en el sistema. esto se logra
                                    seleccionando la opción "roles" del menú principal. la lista aparecerá
                                    ordenada ascendentemente por nombre del rol.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para registrar un rol primero debe ingresar en el listado de roles (roles)
                                    luego seleccionar la opción "agregar", con lo que el sistema mostrará un
                                    formulario con los distintos datos del rol para ser ingresados.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img src="./imagenes/ayuda/agregar_rol.gif"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>una vez digitada toda la información debe hacerse click en el botón
                                    <em>agregar</em> y el rol será creado.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para modificar un rol primero debe ingresar en el listado de roles (roles)
                                    luego seleccionar la opción "modificar" que se encuentra al lado derecho
                                    del rol, con lo que el sistema mostrará un
                                    formulario con los distintos datos del rol para ser modificados.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>una vez modificados todos los datos debe hacerse click en el botón
                                    <em>actualizar</em> y dicho datos serán modificados.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para eliminar un rol primero debe ingresar en el listado de roles (roles)
                                    luego seleccionar la opción "eliminar" que se encuentra al lado derecho
                                    del rol, con lo que el sistema presentará un mensaje consultando si
                                    realmente desea eliminar al rol, al indicar que si se eliminará al rol
                                    y todos los datos relacionados al mismo.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img src="./imagenes/ayuda/modificar_rol.gif"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para darle mantenimientos a los usuarios que pertenecen al rol
                                    se debe ingresar al rol como si se fuera a modificar, una vez hecho
                                    esto debajo del formulario de modificación aparece un listado de usuarios,
                                    ahí se podrán agregar o eliminar los usuarios. y para agregar o modificar
                                    permisos se deben agregar en la lista de permisos que aparecen debajo
                                    de este mismo formulario.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#336699">
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name="seccion12"></a>mantenimiento de usuarios
                                                </font></strong></em></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>con está opción el usuario administrador del sistema podrá obtener
                                    un listado de todos los usuarios registrados en el sistema. esto se logra
                                    seleccionando la opción "usuarios" del menú principal. la lista aparecerá
                                    ordenada ascendentemente por nombre del usuario.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para registrar un usuario primero debe ingresar en el listado de usuarios (usuarios)
                                    luego seleccionar la opción "agregar", con lo que el sistema mostrará un
                                    formulario con los distintos datos del usuario para ser ingresados.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="292"
                                                           src="./imagenes/ayuda/registrar_usuario.gif"
                                                           width="568"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>una vez digitada toda la información debe hacerse click en el botón
                                    <em>agregar</em> y el usuario será creado.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para modificar un usuario primero debe ingresar en el listado de usuarios (usuarios)
                                    luego seleccionar la opción "modificar" que se encuentra al lado derecho
                                    del usuario, con lo que el sistema mostrará un
                                    formulario con los distintos datos del usuario para ser modificados.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>una vez modificados todos los datos debe hacerse click en el botón
                                    <em>actualizar</em> y dicho datos serán modificados.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para eliminar un usuario primero debe ingresar en el listado de usuarios (usuarios)
                                    luego seleccionar la opción "eliminar" que se encuentra al lado derecho
                                    del usuario, con lo que el sistema presentará un mensaje consultando si
                                    realmente desea eliminar al usuario, al indicar que si se eliminará al usuario
                                    y todos los datos relacionados al mismo.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name="seccion13"></a>mantenimiento de entidades y sucursales
                                                </font></strong></em></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>con está opción el usuario administrador del sistema podrá
                                    obtener un listado de todas las entidades registradas en el sistema. esto
                                    se logra seleccionando la opción "entidades" del menú principal. la lista
                                    aparecerá ordenada ascendentemente por nombre de la entidad. además esta
                                    opción permite realizar varias operaciones de mantenimiento como lo son
                                    crear nuevas entidades y nuevas sucursales, modificar entidades y sus sucursales
                                    o eliminar entidades y/o sucursales.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para registrar una nueva entidad se debe seleccionar la opción "agregar",
                                    que se encuentra en la parte superior del listado, seguidamente se abrirá
                                    una página donde se le solitará la información de la nueva entidad.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="528"
                                                           src="./imagenes/ayuda/agregar_entidad.gif"
                                                           width="580"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>una vez digitada toda la información debe hacerse click en el botón
                                    <em>agregar</em> y la entidad será creada.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para modificar una entidad primero debe ingresar en el listado de entidades
                                    (entidades), luego selecciona la opción "modificar" que se encuentra al lado
                                    derecho de la entidad, con lo cual el sistema mostrará un formulario con los
                                    distintos datos de la entidad para ser modificados.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="575"
                                                           src="./imagenes/ayuda/modificar_entidad.gif"
                                                           width="580"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>una vez hechos los cambios pertinente hacemos click en el botón
                                    <em>actualizar</em> y los datos serán modificados.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para eliminar una entidad primero debe ingresar en el listado de entidades
                                    (entidades)
                                    luego seleccionar la opción "eliminar" que se encuentra al lado derecho
                                    de la entidad, con lo que el sistema presentará un mensaje consultando si
                                    realmente desea eliminar a la entidad, al indicar que si se eliminará la entidad
                                    y todos los datos relacionados a la misma.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para darle mantenimientos a las sucursales de una organización debemos
                                    ingresar a la organización como si la fueramos a modificar una vez hecho
                                    esto debajo del formulario de modificación aparece un listado de sucursales
                                    con lo cual se debe seguir el mismo
                                    procedimiento que para darle mantenimiento a las entidades.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name="seccion14"></a>mantenimiento de paises
                                                </font></strong></em></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>con está opción el usuario administrador del sistema podrá
                                    obtener un listado de todas los países registradas en el sistema. esto
                                    se logra seleccionando la opción "países" del menú principal. la lista
                                    aparecerá ordenada ascendentemente por nombre del país. además esta
                                    opción permite realizar varias operaciones de mantenimiento como lo son
                                    crear, modificar y eliminar países.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para registrar un nuevo país se debe seleccionar la opción "agregar",
                                    que se encuentra en la parte superior del listado, seguidamente se abrirá
                                    una página donde se le solitará la información del nuevo país.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="177"
                                                           src="./imagenes/ayuda/agregar_pais.gif"
                                                           width="515"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>una vez digitada toda la información debe hacerse click en el botón
                                    <em>agregar</em> y país será registrado.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para modificar un país primero debe ingresar en el listado de países
                                    (países), luego selecciona la opción "modificar" que se encuentra al lado
                                    derecho del país, con lo cual el sistema mostrará un formulario con los
                                    distintos datos del país para ser modificados.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="329"
                                                           src="./imagenes/ayuda/modificar_pais.gif"
                                                           width="581"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>una vez hechos los cambios pertinente hacemos click en el botón
                                    <em>actualizar</em> y los datos serán modificados.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para eliminar un país primero debe ingresar en el listado de países (países)
                                    luego seleccionar la opción "eliminar" que se encuentra al lado derecho
                                    del país, con lo que el sistema presentará un mensaje consultando si
                                    realmente desea eliminar al país, al indicar que si se eliminará el país
                                    y todos los datos relacionados al mismo.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>para darle mantenimientos a la distribución política de un país
                                    debemos ingresar al país como si lo fueramos a modificar una vez hecho
                                    esto hacemos debajo del formulario de modificación aparece un listado de
                                    distribución política con lo cual sedebe seguir el mismo
                                    procedimiento que para darle mantenimiento a los países.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name="seccion22"></a>recibir remesas</font></strong></em>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>este proceso se encuentra separado por cuatro pasos en los cuales se solicitan
                                    los siguientes datos: </br>
                                    - monto a enviar</br>
                                    - datos del destinatario</br>
                                    - datos del remitente</br>
                                    - entidad que debe entregar (no es requerido)</br>
                                    - modalidad de identificación del destinatario</br>
                                    - descuento que se aplica (si posee el permiso para aplicarlo)</br>
                                    - entidad que recibió (cuando se esta procesando)    </br>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="450"
                                                           src="./imagenes/ayuda/recibir_1.gif"
                                                           width="554"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="573"
                                                           src="./imagenes/ayuda/recibir_2.gif"
                                                           width="541"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img src="./imagenes/ayuda/recibir_3.gif"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name="seccion23"></a>entregar remesas</font></strong></em>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>por medio de esta opción que se puede accesar seleccionando "entregar remesa" del
                                    menú,
                                    se muestran dos listados de remesas que pueden ser entregados, el primer listado
                                    se muestran las remesas que son dirigidas específicamente a la entidad a la cual
                                    pertenece el usuario. el segundo listado se muestran las remesas que no son
                                    dirigidas
                                    a ninguna entidad, pero por la zona pueden entregar ellos.
                                </td>
                            </tr>
                            <tr>
                                <td>para entregar la remesa se debe hacer click a la imagen que se encuentra a la
                                    derecha de la remesa. cuando se presenta una página con los datos de la remesa
                                    se debe presionar el botón "generar formulario de entrega" para poder entregarla.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name="seccion24"></a>consultas de
                                                    remesas</font></strong></em></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>por medio de esta opción que se puede accesar seleccionando "consultar remesas" del
                                    menú,
                                    se muestra un formulario con diferentes parámetros de consulta y varios datos que
                                    pueden ser mostrados en la respuesta final. se deben seleccionar los parámetros
                                    deseados,
                                    los datos que se desean ver y el orden en que se deben mostrar.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="591" src="./imagenes/ayuda/consultar_1.gif"
                                                           width="538"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="566" src="./imagenes/ayuda/consultar_2.gif"
                                                           width="573"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name="seccion25"></a>anular remesas</font></strong></em>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>por medio de esta opción que se puede accesar seleccionando "anular remesa" del
                                    menú,
                                    se muestra un formulario donde puede ingresar el número de la remesa, luego se
                                    muestra una
                                    página con los datos de la remesa, y posteriormente se debe presionar el botón
                                    "anular".
                                    en caso de que la remesa ya haya sido entregada no se podrá anular.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="101" src="./imagenes/ayuda/anular_1.gif" width="411">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="91" src="./imagenes/ayuda/anular_2.gif" width="421">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name="seccion26"></a>solicitar liquidación de remesas
                                                    entregadas</font></strong></em></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>por medio de esta opción que se puede accesar seleccionando "solicitar liquidación a
                                    folade" del menú,
                                    se muestra un formulario donde se deben ingresar las fechas de corte entre las
                                    cuales se encuentran las remesas
                                    entregadas que desea la entidad que le sean liquidadas. posteriormente se le muestra
                                    una página
                                    que desglosa varios datos de las remesas que han sido entregadas y no se encuentran
                                    solicitadas de liquidación o
                                    liquidadas, para realizar el proceso se debe presionar el botón "generar solicitud
                                    de liquidaci&oacute;n".
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="171"
                                                           src="./imagenes/ayuda/solicitar_liquidacion_1.gif"
                                                           width="418"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="447"
                                                           src="./imagenes/ayuda/solicitar_liquidacion_2.gif"
                                                           width="554"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name="seccion27"></a>compensar a
                                                    entidad</font></strong></em></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>por medio de esta opción que se puede accesar seleccionando "compensar a entidad"
                                    del menú,
                                    se muestra un formulario donde se debe seleccionar la entidad que se desea liquidar
                                    las remesas
                                    que ha entregado. las remesas
                                    que se liquidarán son aquellas que la entidad haya entregado y haya solicitado para
                                    liquidación.
                                    posteriormente se le muestra una página con las remesas que se pueden compensar y
                                    varios datos
                                    que se pueden agregar a la compensación, se deben seleccionar las remesas que se van
                                    a compensar
                                    y presionar el botón "siguiente". por último se muestra una página con el formulario
                                    de compensación,
                                    para finalizar se debe presionar el botón "generar compensación".
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="100" src="./imagenes/ayuda/compensar_1.gif"
                                                           width="340"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="258" src="./imagenes/ayuda/compensar_2.gif"
                                                           width="577"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name="seccion28"></a>liquidar a folade</font></strong></em>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>por medio de esta opción que se puede accesar seleccionando "liquidar a folade" del
                                    menú,
                                    se muestra un formulario donde se ingresar las fechas de corte de las remesas que se
                                    desean
                                    pagar a folade por haber sido recibidas, junto con otros datos que se pueden
                                    adjuntar a la
                                    liquidación.
                                    posteriormente se muestra una página con el formulario de liquidación, y
                                    para finalizar se debe presionar el botón "generar formulario de liquidación".
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="244" src="./imagenes/ayuda/liquidar_1.gif"
                                                           width="559"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="519" src="./imagenes/ayuda/liquidar_2.gif"
                                                           width="573"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name="seccion29"></a>confirmar liquidaciones a folade</font></strong></em>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>por medio de esta opción que se puede accesar seleccionando "confirmar liquidación a
                                    folade"
                                    del menú,
                                    se muestra un listado con todas las liquidaciones que se han realizado a folade por
                                    parte
                                    de las entidades. para confirmar se debe hacer click sobre el botón que se entra a
                                    la
                                    derecha de la liquidación, con lo que se mostrará los datos de la liquidación por
                                    último
                                    debe presionar el botón "confirmar liquidación".
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="118"
                                                           src="./imagenes/ayuda/confirmar_liquidacion_1.gif"
                                                           width="579"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="532" src="./imagenes/ayuda/liquidar_2.gif"
                                                           width="580"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name="seccion30"></a>reportes de solicitudes de liquidación</font></strong></em>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>por medio de esta opción que se puede accesar seleccionando "reportes solicitud
                                    liquidación" del menú,
                                    se muestra, para un usuario de una entidad, un listado con todos las solicitudes de
                                    liquidación
                                    que han realizado hasta el momento. para un usuario administrativo se muestran un
                                    listado de todas
                                    las solicitudes de liquidación que se ha realizado todas las entidades hasta el
                                    momento.
                                    para observar la solicitud de liquidación se debe hacer click sobre el identificador
                                    de la
                                    solicitud.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="91" src="./imagenes/ayuda/reportes_solicitudes_1.gif"
                                                           width="577"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name="seccion31"></a>reportes de compensaciones a entidades</font></strong></em>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>por medio de esta opción que se puede accesar seleccionando "reportes compensación"
                                    del menú,
                                    se muestra un listado de todas
                                    las compensaciones que se ha realizado a las entidades hasta el momento.
                                    para observar la compensación a la entidad se debe hacer click sobre el
                                    identificador de la
                                    compensación.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="75" src="./imagenes/ayuda/reportes_compensacion.gif"
                                                           width="577"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor=#336699>
                                    <div align=center><em><strong><font color=#ffffff><a
                                                            name="seccion32"></a>reportes de liquidaciones a
                                                    folade</font></strong></em></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>por medio de esta opción que se puede accesar seleccionando "reportes liquidación a
                                    folade"
                                    del menú, se muestra un listado de todas
                                    las liquidaciones que han realizado las entidades a folade hasta el momento.
                                    para observar la liquidación se debe hacer click sobre el identificador de la
                                    liquidación.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=center><img height="87" src="./imagenes/ayuda/reportes_liquidacion.gif"
                                                           width="578"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div align=right><a
                                                href="#seccion0"><img
                                                    height=15 alt="ir arriba"
                                                    src="./imagenes/ayuda/flecha-arriba.jpg"
                                                    width=13 border=0></a></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop