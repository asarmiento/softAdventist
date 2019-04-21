<!--NAVBAR-->
<!--===================================================-->
<header id="navbar">
    <div id="navbar-container" class="boxed">

        <!--Brand logo & name-->
        <!--================================-->
        <div class="navbar-header">
            <a href="{{route('home')}}" class="navbar-brand">
                <img src="{{asset('img/Logo-IASD.png')}}" alt="Nifty Logo" class="brand-icon">
                <div class="brand-title">
                    <span class="brand-text">Soft-Adventist</span>
                </div>
            </a>
        </div>
        <!--================================-->
        <!--End brand logo & name-->


        <!--Navbar Dropdown-->
        <!--================================-->
        <div class="navbar-content clearfix">


            <ul class="nav navbar-top-links pull-left">

                <!--Navigation toogle button-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="tgl-menu-btn">
                    <a class="mainnav-toggle" href="#">
                        <i class="pli-view-list icon-lg"></i>
                    </a>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Navigation toogle button-->


            @include('layouts.partials.notification')


            <!--Mega dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="mega-dropdown">
                    <a href="#" class="mega-dropdown-toggle">
                        <i class="pli-layout-grid icon-lg"></i>
                    </a>
                    <div class="dropdown-menu mega-dropdown-menu">
                        <div class="clearfix">
                            <div class="col-sm-12 col-md-3">

                                <!--Mega menu widget-->
                                <div class="text-center bg-success pad-all">
                                    <h4 class="text-light mar-no">SoftAdventist</h4>
                                    <div class="pad-ver box-inline">
                                                <span class="icon-wrap icon-wrap-lg icon-circle bg-trans-light">
                                                    <img style="border-radius: 10px" width="100" height="100"
                                                         src="{{asset('img/Logo-IASD.png')}}"></img>
                                                </span>
                                    </div>
                                    <!--p class="pad-btm">
                                        Members get <span class="text-lg text-bold">50%</span> more points. Lorem ipsum dolor sit amet!
                                    </p-->
                                    <a href="https://asarmiento.github.io/softAdventist/" class="btn btn-info">Leer
                                        Mas...</a>
                                </div>

                            </div>
                            @if(currentUser()->whereUserBelong == null)
                                <div class="col-sm-4 col-md-3">
                                    <ul>
                                        <li class="dropdown-header">Ustede no tiene asignado Ningun Cargo o
                                            Departamento
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <div class="col-sm-4 col-md-3">

                                    <!--Mega menu list-->
                                    <ul class="list-unstyled">
                                        <li class="dropdown-header">Miembros</li>
                                        <li><a href="/softadventist/perfile-clubes">Mi Perfil</a></li>
                                        <li><a href="{{route('new-member')}}">Registrar Miembros</a></li>
                                        <li><a href="{{route('list-members')}}">Lista Miembros</a></li>
                                        @if(currentUser()->whereUserBelong->cargo == 'secretario')
                                            <li><a href="{{route('asistencia-member')}}">Asistencia de Sábados</a></li>
                                        @endif
                                        @if(currentUser()->whereUserBelong->cargo == 'tesorero')
                                            <li><a href="{{route('regMemMatEscSab')}}">Cobro a Miembros</a></li>
                                        @endif
                                        <li><a href="#" class="disabled"></a></li>
                                        <li class="divider"></li>
                                        @if(currentUser()->whereUserBelong->cargo == 'tesorero')
                                            <li class="dropdown-header">Cuentas Bancarias</li>
                                            <li><a href="{{route('create-bank')}}">Cuentas Bancarias<span
                                                        class="pull-right badge badge-purple"></span></a></li>
                                            <li><a href="{{route('register-deposit')}}">Depositos Iglesia</a></li>
                                            <li><a href="{{route('deposit-local-field')}}">Depositos al Campo Local</a>
                                            </li>
                                            <li><a href="{{route('create-check')}}">Cheques</a></li>
                                            <li><a href="#" class="disabled"></a></li>
                                            <li class="divider"></li>
                                        @endif
                                    </ul>
                                    @if(currentUser()->whereUserBelong->cargo == 'secretario')

                                        <ul class="list-unstyled">
                                            <li class="dropdown-header">Visitantes</li>
                                            <li><a href="{{route('new-visitor')}}">Registrar Visitas</a></li>
                                            <li><a href="{{route('list-visitor')}}">Lista Visitas</a></li>
                                        </ul>
                                    @endif
                                    @if(currentUser()->whereUserBelong->list_departament_id == null)
                                        <ul>
                                            <li class="dropdown-header">Ustede no tiene asignado el Departamento de
                                                Jovenes
                                            </li>
                                        </ul>
                                    @else
                                        @if((currentUser()->whereUserBelong->cargo == 'secretario' || currentUser()->whereUserBelong->cargo == 'director' || currentUser()->whereUserBelong->cargo == 'departamental' )
                                        )
                                            <ul class="list-unstyled">
                                                <li class="dropdown-header">Departamento de Jovenes</li>
                                                <li><a href="{{route('list-ja')}}">Lista de jovenes</a></li>
                                                <li><a href="{{route('register-club-director')}}">Registro de
                                                        Directores</a></li>
                                                @if(currentUser()->whereUserBelong->list_departament_id == 4 || currentUser()->whereUserBelong->list_departament_id == 7 || userCampo())
                                                <li><a href="{{route('register-card-ja')}}">Registrar Tarjetas a
                                                        Conquistadores</a></li>
                                                @endif
                                                @if(currentUser()->whereUserBelong->list_departament_id == 5 || userCampo())
                                                <li><a href="{{route('register-card-aventurero')}}">Registrar Tarjetas a
                                                        Aventureros</a></li>
                                                @endif
                                                @if(userCampo())
                                                    <li><a href="{{route('list-ja-pastor')}}">Lista de Pastores</a></li>
                                                    <li><a href="{{route('register-card-gm-lj')}}">Registrar de Guia Mayor-Lider Juvenitl</a></li>
                                                <li><a href="{{route('editar-clave-user')}}">Cambio de Contraseña a Usuarios</a></li>
                                                <li><a href="{{route('register-specialidades-ja')}}">Registrar Especialidades</a></li>
                                                @endif
                                                <li><a href="{{route('register-specialties-ja')}}">Registrar
                                                        Especialidades a jovenes</a></li>
                                            </ul>
                                        @endif
                                    @endif
                                </div>
                                @if(currentUser()->whereUserBelong->cargo == 'tesorero')
                                    <div class="col-sm-4 col-md-3">

                                        <!--Mega menu list-->
                                        <ul class="list-unstyled">
                                            <li class="dropdown-header">Departamentos</li>
                                            <li><a href="{{route('create-departament')}}"><span
                                                        class="pull-right label label-danger"></span>Crear Departamentos</a>
                                            </li>
                                        <!--li><a href="{{route('change-status')}}">Activar o Desactivar Departamento</a></li-->
                                            <li><a href="{{route('create-incomes')}}">Crear Cuentas de Ingresos</a></li>
                                            <li><a href="{{route('create-expenses')}}">Crear Cuentas de Gastos</a></li>
                                            <li class="divider"></li>
                                            <li class="dropdown-header"></li>
                                            <li><a href="{{route('lista-internal-control')}}"></span>Lista de Controles
                                                    Internos</a></li>
                                            <li><a href="{{route('lists-departament')}}"></span>Lista de
                                                    Departamentos</a></li>
                                            <li><a href="{{route('lista-de-cuentas-de-ingresos')}}">Lista Cuentas de
                                                    Ingresos</a></li>
                                            <li><a href="{{route('lista-cuentas-expenses')}}">Lista Cuentas de
                                                    Gastos</a></li>

                                        </ul>
                                    </div>
                                    <div class="col-sm-4 col-md-3">
                                        <!--Mega menu list-->
                                        <ul class="list-unstyled">
                                            <li class="dropdown-header">Registros</li>
                                            <li><a href="{{route('create-internal-control')}}">Registro de Ingresos</a>
                                            </li>
                                            <li><a href="{{route('transfer-of-accounts')}}">Traspaso entre Cuentas</a>
                                            </li>
                                            <li><a href="{{route('register-expenses')}}">Registro de Gastos</a></li>
                                            <li><a href="{{route('list-expenses')}}">Lista de Gastos</a></li>
                                            <li><a href="#"></a></li>
                                            <li class="divider"></li>
                                            <li class="dropdown-header">Informes</li>
                                            <li><a href="">Informe Mensual</a></li>
                                            <li><a href="{{route('lista-de-informes-semanales')}}">Informe Semanal</a>
                                            </li>
                                            <li><a href="#">Saldos por Departamentos</a></li>
                                            <li><a href="#">Saldo por Cuentas</a></li>
                                            <!--li>
                                                <form role="form" class="form">
                                                    <div class="form-group">
                                                        <label class="dropdown-header" for="demo-megamenu-input">Newsletter</label>
                                                        <input id="demo-megamenu-input" type="email" placeholder="Enter email" class="form-control">
                                                    </div>
                                                    <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                                </form>
                                            </li-->
                                        </ul>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </li>

                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End mega dropdown-->

            </ul>
            <ul class="nav navbar-top-links pull-right">
                <li class="dropdown"><a href="{{route('help')}}"><i class="fa fa-question-circle"></i> Manual de Usuario</a>
                </li>
                <!--Language selector-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="dropdown">
                    <a class="lang-selector dropdown-toggle" href="#" data-toggle="dropdown">
                                <span class="lang-selected">
                                    <img class="lang-flag" src="{{asset('img/flags/CR.png')}}" alt="Spain">
                                    <span class="lang-id">ES</span>
                                    <span class="lang-name">Español</span>
                                </span>
                    </a>

                    <!--Language selector menu-->
                    <ul class="head-list dropdown-menu">
                        <li>
                            <!--Spain-->
                            <a href="#">
                                <img class="lang-flag" src="{{asset('img/flags/CR.png')}}" alt="Spain">
                                <span class="lang-id">ES</span>
                                <span class="lang-name">Espa&ntilde;ol</span>
                            </a>
                        </li>
                        <li>
                            <!--English-->
                            <a href="#" class="active">
                                <img class="lang-flag" src="{{asset('img/flags/united-kingdom.png')}}" alt="English">
                                <span class="lang-id">EN</span>
                                <span class="lang-name">Ingles</span>
                            </a>
                        </li>
                        <li>
                            <!--France-->
                            <a href="#">
                                <img class="lang-flag" src="{{asset('img/flags/france.png')}}" alt="France">
                                <span class="lang-id">FR</span>
                                <span class="lang-name">Frances</span>
                            </a>
                        </li>
                        <li>
                            <!--Germany-->
                            <a href="#">
                                <img class="lang-flag" src="{{asset('img/flags/germany.png')}}" alt="Germany">
                                <span class="lang-id">DE</span>
                                <span class="lang-name">Aleman</span>
                            </a>
                        </li>
                        <li>
                            <!--Italy-->
                            <a href="#">
                                <img class="lang-flag" src="{{asset('img/flags/italy.png')}}" alt="Italy">
                                <span class="lang-id">IT</span>
                                <span class="lang-name">Italiano</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End language selector-->


                <!--User dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li id="dropdown-user" class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class="pull-right">
                                    <!-- You may use image instead of an icon.
                                    <!--<img class="img-circle img-user media-object" src="{{asset('img/av1.png')}}" alt="Profile Picture">-->
                                        <i class="pli-male ic-user"></i>
                                </span>
                        @if(currentUser())
                            <div class="username hidden-xs">{{currentUser()->name}}</div>
                        @else
                            <div class="username hidden-xs"></div>
                        @endif
                    </a>


                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right panel-default">
                    @if(currentUser())
                        @if(currentUser()->youngBoy()->count()>0)
                            <!-- Dropdown heading  -->
                                <div class="pad-all bord-btm">
                                    <p class="text-main mar-btm"><span
                                            class="text-bold">{{currentUser()->youngBoy->retirements()->sum('amount')}}</span>
                                        de {{number_format(0,2)}} Pagado
                                        el {{number_format((currentUser()->youngBoy->retirements()->sum('amount')/38500)*100,2)}}
                                        %</p>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar"
                                             style="width: {{((currentUser()->youngBoy->retirements()->sum('amount')/38500)*100)}}%;">
                                            <span class="sr-only">{{number_format((currentUser()->youngBoy->retirements()->sum('amount')/1)*100,2)}}%</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="pad-all bord-btm">
                                    <p class="text-main mar-btm"><span class="text-bold">0</span>
                                        de {{number_format(0,2)}} Pagado el 0%</p>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" style="width: 0%;">
                                            <span class="sr-only">0%</span>
                                        </div>
                                    </div>
                                </div>
                        @endif
                    @endif
                    <!-- User dropdown menu -->
                        <ul class="head-list">
                            <li>
                                <a href="{{route('profile')}}">
                                    <i class="pli-male icon-fw icon-lg"></i> Perfil
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="badge badge-danger pull-right">9</span>
                                    <i class="pli-mail icon-fw icon-lg"></i> Mensajes
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-success pull-right">New</span>
                                    <i class="pli-gear icon-fw icon-lg"></i> Configurar
                                </a>
                            </li>
                        </ul>

                        <!-- Dropdown footer -->
                        <div class="pad-all text-right">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();"
                               class="btn btn-primary">
                                <i class="pli-unlock icon-fw"></i> Cerrar Sesion
                            </a>
                        </div>
                    </div>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End user dropdown-->

                <li>
                    <a href="#" class="aside-toggle navbar-aside-icon">
                        <i class="pci-ver-dots"></i>
                    </a>
                </li>
            </ul>

        </div>
        <!--================================-->
        <!--End Navbar Dropdown-->

    </div>
</header>
<!--===================================================-->
<!--END NAVBAR-->
