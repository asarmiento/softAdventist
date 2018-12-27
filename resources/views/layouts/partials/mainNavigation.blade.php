<!--MAIN NAVIGATION-->
<!--===================================================-->
<nav id="mainnav-container">



    <div id="mainnav">
        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">
                    <!--Profile Widget-->
                    <!--================================-->

                    <div id="mainnav-profile" class="mainnav-profile">

                        <div class="profile-wrap">
                            <div class="pad-btm">
                                <span class="label label-success pull-right"></span>
                                <img class="img-circle img-sm img-border" src="{{asset('img/profile-photos/1.png')}}"
                                     alt="Profile Picture">
                            </div>
                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                 <span class="pull-right dropdown-toggle">
                                     <i class="dropdown-caret"></i>
                                 </span>
                                <p class="mnp-name">{{currentUser()->nameComplete()}}</p>
                                <span class="mnp-desc">{{currentUser()->email}}</span>
                            </a>
                        </div>
                        <div id="profile-nav" class="collapse list-group bg-trans">
                            <a href="#" class="list-group-item">
                                <i class="pli-wallet icon-lg icon-fw"></i> Link 1
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="pli-calculator-2 icon-lg icon-fw"></i> Link 2
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="pli-coin icon-lg icon-fw"></i> Link 3
                            </a>
                        </div>

                    </div>
                    <!--Shortcut buttons-->
                    <!--================================-->
                    <div id="mainnav-shortcut">
                        <ul class="list-unstyled">
                            <li class="col-xs-4" data-content="Lista de Miembros">
                                <a class="shortcut-grid" href="{{route('list-members')}}">
                                    <i class="psi-cloud"></i>
                                </a>
                            </li>
                            <li class="col-xs-4" data-content="Departamentos">
                                <a class="shortcut-grid" href="{{route('list-departament')}}">
                                    <i class="psi-data-stream"></i>
                                </a>
                            </li>
                            <li class="col-xs-4" data-content="Bancos">
                                <a class="shortcut-grid" href="{{route('create-bank')}}">
                                    <i class="psi-phone-sms"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--================================-->
                    <!--End shortcut buttons-->
                    <ul id="mainnav-menu" class="list-group">
                        <!--Category name-->
                        <li class="list-header">Miembros</li>
                        <!--Menu list item-->
                        <li class="active-link">
                            <a href="{{route('new-member')}}">
                                <i class="psi-quill-2"></i>
                                <span class="menu-title">Registrar Miembros</span>
                            </a>
                        </li>
                        <!--Menu list item-->
                        <li>
                            <a href="{{route('create-internal-control')}}">
                                <i class="psi-mail-love"></i>
                                <span class="menu-title">
									<strong>Registro Informe</strong>
								</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('list-members-due')}}">
                                <i class="psi-gamepad-2"></i>
                                <span class="menu-title">
										Entrega Mat. Esc. Sab.
                                    <!--span class="label label-success pull-right"></span-->
									</span>
                            </a>
                        </li>
                        <!--Menu list item-->
                        <li>
                            <a href="{{route('list-members-due')}}">
                                <i class="psi-usb"></i>
                                <span class="menu-title">
									Lista Mat. Esc. Sab.
								    <span class="pull-right badge badge-purple">7</span>
								</span>
                            </a>
                        </li>
                        <li class="list-divider"></li>
                        <!--Category name-->
                        <li class="list-header">Departamentos</li>
                        <!--Menu list item-->
                        <li class="active-sub">
                            <a href="#">
                                <i class="psi-mouse-3"></i>
                                <span class="menu-title">Departamentos</span>
                                <i class="arrow"></i>
                            </a>
                            <!--Submenu-->
                            <ul class="collapse in">
                                <li><a href="{{route('create-departament')}}">Nuevo Departamento</a></li>
                                <li><a href="{{route('create-cta-ing')}}">Nueva Cuenta Ingreso</a></li>
                                <li><a href="{{route('create-expenses')}}">Nueva Cuenta Gasto</a></li>
                                <li><a href="{{route('lista-cuentas-expenses')}}">Lista de Cuenta Gastos</a></li>
                                <li><a href="{{route('move-departaments')}}">Movimientos Depart.</a></li>
                                <li class="list-divider"></li>
                            </ul>
                        </li>
                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="psi-hipster-headphones"></i>
                                <span class="menu-title">
									<strong>Informes</strong>
								</span>
                                <i class="arrow"></i>
                            </a>
                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="#">Informe Semanal</a></li>
                                <li><a href="#">Inf. de Gastos x Cheques</a></li>
                                <li><a href="#">Informe Mensual</a></li>
                                <li class="list-divider"></li>
                                <li><a href="#">Inf. Mat. Esc. Sab.</a></li>

                            </ul>
                        </li>
                        <!--Menu list item->
                        <li>
                            <a href="#">
                                <i class="psi-fuel"></i>
                                <span class="menu-title">
												With label
												<span class="label label-danger pull-right">Hot</span>
											</span>
                            </a>
                            <!--Submenu->
                            <ul class="collapse">
                                <li><a href="#">Link</a></li>
                                <li><a href="#">Another link</a></li>
                                <li><a href="#">Some else here</a></li>
                                <li class="list-divider"></li>
                                <li><a href="#">Separate link</a></li>

                            </ul>
                        </li>
                        <!--Menu list item->
                        <li>
                            <a href="#">
                                <i class="psi-cursor-click"></i>
                                <span class="menu-title">
									With badge
									<span class="pull-right badge badge-success">3</span>
								</span>
                            </a>
                            <!--Submenu-->
                        <ul class="collapse">
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Another link</a></li>
                            <li><a href="#">Some else here</a></li>
                            <li class="list-divider"></li>
                            <li><a href="#">Separate link</a></li>

                        </ul>
                        </li>
                        <!--li class="list-divider"></li-->
                        <!--Category name->
                        <li class="list-header">Multi level</li>
                        <!--Menu list item->
                        <li-->
                        <a href="#">
                            <i class="psi-geo-2-star"></i>
                            <span class="menu-title">Menu Level</span>
                            <i class="arrow"></i>
                        </a>

                        <!--Submenu-->
                        <ul class="collapse">
                            <li><a href="#">Second Level Item</a></li>
                            <li><a href="#">Second Level Item</a></li>
                            <li><a href="#">Second Level Item</a></li>
                            <li class="list-divider"></li>
                            <li>
                                <a href="#">Third Level<i class="arrow"></i></a>

                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="#">Third Level Item</a></li>
                                    <li><a href="#">Third Level Item</a></li>
                                    <li><a href="#">Third Level Item</a></li>
                                    <li><a href="#">Third Level Item</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Third Level<i class="arrow"></i></a>

                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="#">Third Level Item</a></li>
                                    <li><a href="#">Third Level Item</a></li>
                                    <li><a href="#">Third Level Item</a></li>
                                    <li class="list-divider"></li>
                                    <li><a href="#">Third Level Item</a></li>
                                    <li><a href="#">Third Level Item</a></li>
                                </ul>
                            </li>
                        </ul>
                        </li-->
                    </ul>
                    <!--Widget-->
                    <!--================================-->
                    <div class="mainnav-widget">

                        <!-- Show the button on collapsed navigation -->
                        <div class="show-small">
                            <a href="#" data-toggle="menu-widget" data-target="#demo-wg-server">
                                <i class="fa fa-desktop"></i>
                            </a>
                        </div>

                        <!-- Hide the content on collapsed navigation -->
                        <div id="demo-wg-server" class="hide-small mainnav-widget-content">
                            <ul class="list-group">
                                <li class="list-header pad-no pad-ver">Simple Widget</li>
                                <li class="mar-btm">
                                    <span class="label label-primary pull-right">15%</span>
                                    <p>CPU Usage</p>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-primary" style="width: 15%;">
                                            <span class="sr-only">15%</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="mar-btm">
                                    <span class="label label-purple pull-right">75%</span>
                                    <p>Bandwidth</p>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-purple" style="width: 75%;">
                                            <span class="sr-only">75%</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="pad-ver"><a href="#" class="btn btn-success btn-bock">View Details</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--================================-->
                    <!--End widget-->
                   
                </div>
            </div>
        </div>
        <!--================================-->
        <!--End menu-->
    </div>
</nav>
<!--===================================================-->
<!--END MAIN NAVIGATION-->
