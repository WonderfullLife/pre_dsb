<html>
<head>
    <title></title>
    <link rel="stylesheet" href="{{URL::asset('css/uikit.min.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('css/main.css')}}"/>
    <script src="{{URL::asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{URL::asset('js/uikit.min.js')}}"></script>
    <script src="{{URL::asset('js/uikit-icons.min.js')}}"></script>
</head>
<body>
<div class="main">
    <nav class="uk-navbar-container nav-ti" uk-navbar>
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li class="uk-padding-remove-bottom">
                    <div class="uk-logo uk-margin-small-left box-nav">
                        <span style="color:white" uk-icon="icon: thumbnails; ratio: 1.5"></span>
                    </div>
                    <div class="uk-navbar-dropdown uk-navbar-dropdown-width-2 menu-dd">
                        <div class="uk-navbar-dropdown-grid uk-child-width-1-2" uk-grid>
                            <div>
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li class="uk-nav-header nav-menu"><b>Mapping</b></li>
                                    <li class="uk-nav-divider uk-margin-remove-top"></li>
                                    <li><a class="logo uk-margin-auto-vertical nav-menu">Urusan </a></li>
                                    <li><a class="logo uk-margin-auto-vertical nav-menu">Program </a></li>
                                    <li><a href="{{url('maping-jenis')}}" class="logo uk-margin-auto-vertical nav-menu">Jenis </a>
                                    </li>
                                    <li class="nav-menu uk-nav-header"><b>Monitoring</b></li>
                                    <li class="uk-nav-divider uk-margin-remove-top"></li>
                                    <li><a class="nav-menu">Daerah</a></li>
                                    <li><a class="logo uk-margin-auto-vertical nav-menu">Data bersih </a></li>
                                    <li><a class="nav-menu">Data kotor</a></li>
                                </ul>
                            </div>
                            <div>
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li class="uk-nav-header nav-menu"><b>Pengaturan</b></li>
                                    <li class="uk-nav-divider uk-margin-remove-top"></li>
                                    <li><a class="logo uk-margin-auto-vertical nav-menu">Pengguna </a></li>
                                    <li><a class="logo uk-margin-auto-vertical nav-menu">Referensi </a></li>
                                    <li class="nav-menu uk-nav-header"><b>Export data</b></li>
                                    <li class="uk-nav-divider uk-margin-remove-top"></li>
                                    <li><a class="nav-menu">APBD</a></li>
                                    <li><a class="nav-menu">LRA</a></li>
                                    <li><a class="nav-menu">Referensi</a></li>
                                    <li><a class="nav-menu">Rekapitulasi</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="uk-navbar-left">
            <div class="uk-navbar-item">
                <span class="">Soclean</span>
            </div>
        </div>
        <div class="uk-navbar-right">
            <div class="uk-navbar-item">
                <span uk-toggle="target: #offcanvas-push" href="" uk-icon="icon: user"></span>
            </div>
            <div class="uk-navbar-item">
                <span class="">Administrator</span>
            </div>
        </div>
    </nav>
    <div id="offcanvas-push" uk-offcanvas="mode: push;flip:true">
        <div class="uk-offcanvas-bar">
            <button class="uk-offcanvas-close" type="button" uk-close></button>
            <h3 class="uk-text-center"><img class="uk-preserve-width uk-border-circle"
                                            src="{{URL::asset('img/avatar.png')}}" width="100" alt=""></h3>
            <ul class="uk-nav uk-navbar-dropdown-nav">
                <li class="uk-nav-header nav-menu"><b>Pengaturan</b></li>
                <li class="uk-nav-divider uk-margin-remove-top"></li>
                <li><a class="logo uk-margin-auto-vertical nav-menu">Ganti foto</a></li>
                <li><a class="logo uk-margin-auto-vertical nav-menu">Ganti username</a></li>
                <li><a class="logo uk-margin-auto-vertical nav-menu">Ganti passsword </a></li>
                <li class="nav-menu uk-nav-header"><b>History</b></li>
                <li class="uk-nav-divider uk-margin-remove-top"></li>
                <li><a class="nav-menu">Last login</a></li>
                <li><a class="nav-menu">Mapping ....</a></li>
                <li><a class="nav-menu">Mapping .....</a></li>
                <li><a class="nav-menu">/</a></li>
            </ul>
        </div>
    </div>
    @yield('content')
</div>
@stack('scripts')
</body>
</html>