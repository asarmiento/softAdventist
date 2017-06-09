<!--NAVBAR-->
<!--===================================================-->
<header id="navbar">
    <div id="navbar-container" class="boxed">

        <!--Brand logo & name-->
        <!--================================-->
        <div class="navbar-header">
            <a href="index.html" class="navbar-brand">
                <img src="{{asset('img/logo.png')}}" alt="Nifty Logo" class="brand-icon">
                <div class="brand-title">
                    <span class="brand-text">Nifty</span>
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



                <!--Notification dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        <i class="pli-bell icon-lg"></i>
                        <span class="badge badge-header badge-danger"></span>
                    </a>

                    <!--Notification dropdown menu-->
                    <div class="dropdown-menu dropdown-menu-md">
                        <div class="pad-all bord-btm">
                            <p class="text-semibold text-main mar-no">You have 3 notifications.</p>
                        </div>
                        <div class="nano scrollable">
                            <div class="nano-content">
                                <ul class="head-list">

                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#">
                                            <div class="clearfix">
                                                <p class="pull-left">Progressbar</p>
                                                <p class="pull-right">70%</p>
                                            </div>
                                            <div class="progress progress-sm">
                                                <div style="width: 70%;" class="progress-bar">
                                                    <span class="sr-only">70% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left">
                                                <i class="pli-hd icon-2x icon-lg"></i>
                                            </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">With Icon</div>
                                                <small class="text-muted">15 minutes ago</small>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left">
                                                <i class="pli-power-cable icon-2x icon-lg"></i>
                                            </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">With Icon</div>
                                                <small class="text-muted">15 minutes ago</small>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left">

									<span class="icon-wrap icon-circle bg-primary">
									    <i class="pli-disk icon-lg icon-lg"></i>
									</span>
                                            </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">Circle Icon</div>
                                                <small class="text-muted">15 minutes ago</small>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <span class="badge badge-success pull-right">90%</span>
                                            <div class="media-left">

									<span class="icon-wrap icon-circle bg-danger">
									    <i class="pli-mail-open icon-lg icon-lg"></i>
									</span>
                                            </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">Circle icon with badge</div>
                                                <small class="text-muted">50 minutes ago</small>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left">

									<span class="icon-wrap bg-info">
									    <i class="pli-monitor-3 icon-lg icon-lg"></i>
									</span>
                                            </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">Square icon</div>
                                                <small class="text-muted">Last Update 8 hours ago</small>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- Dropdown list-->
                                    <li>
                                        <a href="#" class="media">
                                            <span class="label label-danger pull-right">New</span>
                                            <div class="media-left">

									<span class="icon-wrap bg-purple">
									    <i class="pli-paintbrush icon-lg icon-lg"></i>
									</span>
                                            </div>
                                            <div class="media-body">
                                                <div class="text-nowrap">Square icon with label</div>
                                                <small class="text-muted">Last Update 8 hours ago</small>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!--Dropdown footer-->
                        <div class="pad-all bord-top">
                            <a href="#" class="btn-link text-dark box-block">
                                <i class="pli-arrow-right-2 pull-right"></i>Show All Notifications
                            </a>
                        </div>
                    </div>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End notifications dropdown-->



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
                                <div class="text-center bg-info pad-all">
                                    <h4 class="text-light mar-no">Weekend shopping</h4>
                                    <div class="pad-ver box-inline">
                                                <span class="icon-wrap icon-wrap-lg icon-circle bg-trans-light">
                                                    <i class="pli-add-cart icon-4x"></i>
                                                </span>
                                    </div>
                                    <p class="pad-btm">
                                        Members get <span class="text-lg text-bold">50%</span> more points. Lorem ipsum dolor sit amet!
                                    </p>
                                    <a href="#" class="btn btn-info">Learn More...</a>
                                </div>

                            </div>
                            <div class="col-sm-4 col-md-3">

                                <!--Mega menu list-->
                                <ul class="list-unstyled">
                                    <li class="dropdown-header">Pages</li>
                                    <li><a href="#">Profile</a></li>
                                    <li><a href="#">Search Result</a></li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Sreen Lock</a></li>
                                    <li><a href="#" class="disabled">Disabled</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header">Icons</li>
                                    <li><a href="#"><span class="pull-right badge badge-purple">479</span> Font Awesome</a></li>
                                    <li><a href="#">Skycons</a></li>
                                </ul>

                            </div>
                            <div class="col-sm-4 col-md-3">

                                <!--Mega menu list-->
                                <ul class="list-unstyled">
                                    <li class="dropdown-header">Mailbox</li>
                                    <li><a href="#"><span class="pull-right label label-danger">Hot</span>Indox</a></li>
                                    <li><a href="#">Read Message</a></li>
                                    <li><a href="#">Compose</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header">Featured</li>
                                    <li><a href="#">Smart navigation</a></li>
                                    <li><a href="#"><span class="pull-right badge badge-success">6</span>Exclusive plugins</a></li>
                                    <li><a href="#">Lot of themes</a></li>
                                    <li><a href="#">Transition effects</a></li>
                                </ul>

                            </div>
                            <div class="col-sm-4 col-md-3">

                                <!--Mega menu list-->
                                <ul class="list-unstyled">
                                    <li class="dropdown-header">Components</li>
                                    <li><a href="#">Tables</a></li>
                                    <li><a href="#">Charts</a></li>
                                    <li><a href="#">Forms</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <form role="form" class="form">
                                            <div class="form-group">
                                                <label class="dropdown-header" for="demo-megamenu-input">Newsletter</label>
                                                <input id="demo-megamenu-input" type="email" placeholder="Enter email" class="form-control">
                                            </div>
                                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End mega dropdown-->

            </ul>
            <ul class="nav navbar-top-links pull-right">

                <!--Language selector-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="dropdown">
                    <a class="lang-selector dropdown-toggle" href="#" data-toggle="dropdown">
                                <span class="lang-selected">
                                    <img class="lang-flag" src="{{asset('img/flags/spain.png')}}" alt="Spain">
                                    <span class="lang-id">ES</span>
                                    <span class="lang-name">Español</span>
                                </span>
                    </a>

                    <!--Language selector menu-->
                    <ul class="head-list dropdown-menu">
                        <li>
                            <!--Spain-->
                            <a href="#">
                                <img class="lang-flag" src="{{asset('img/flags/spain.png')}}" alt="Spain">
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
                        <div class="username hidden-xs">{{currentUser()->name}}</div>
                    </a>


                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right panel-default">

                        <!-- Dropdown heading  -->
                        <div class="pad-all bord-btm">
                            <p class="text-main mar-btm"><span class="text-bold">{{currentUser()->youngBoy->retirements()->sum('amount')}}</span> de {{number_format(38500,2)}} Pagado el {{number_format((currentUser()->youngBoy->retirements()->sum('amount')/38500)*100,2)}}%</p>
                            <div class="progress progress-sm">
                                <div class="progress-bar" style="width: {{((currentUser()->youngBoy->retirements()->sum('amount')/38500)*100)}}%;">
                                    <span class="sr-only">{{number_format((currentUser()->youngBoy->retirements()->sum('amount')/38500)*100,2)}}%</span>
                                </div>
                            </div>
                        </div>


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
                                    <i class="pli-mail icon-fw icon-lg"></i> Messages
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-success pull-right">New</span>
                                    <i class="pli-gear icon-fw icon-lg"></i> Settings
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