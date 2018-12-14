<!DOCTYPE html>
<html>
<head lang="en">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ranti | IF</title>

    <link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="img/favicon.png" rel="icon" type="image/png">
    <link href="img/favicon.ico" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-notifications.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/notif.css')}}">
    {{-- <script type="text/javascript" src="{{asset('js/notif.js')}}"></script>
 --}}
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @include('layouts.css')
</head>
<body onload="hidefield()" class="with-side-menu control-panel control-panel-compact @if(!Auth::check()) sidebar-hidden @endif ">
    <header class="site-header">
        <div class="container-fluid">
            <a href="#" class="site-logo">
            </a>
    
            <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
                <span>toggle menu</span>
            </button>
    
            <button class="hamburger hamburger--htla">
                <span>toggle menu</span>
            </button>
            <div class="site-header-content">
                <div class="site-header-content-in">
                    <div class="site-header-shown">
                        <div class="dropdown">
                        @if(Auth::check())
                        <button class="btn btn-sm btn-warning btn-rounded" data-toggle="modal" data-target="#MyModal{{ Auth::user()->id }}"><i class="fa fa-user"></i></button>


                                <button class="btn btn-rounded btn-lg dropdown-toggle" id="dd-header-add" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <div class="dropdown-menu mt-3" aria-labelledby="dd-header-add" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 30px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    @if(Session::get('admin_session'))
                                        <form action="{{url('switch-back') }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-secondary m-2">Switch Back</button>
                                        </form>
                                    @endif
                                </div>                            
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @if(Auth::check())
        <div class="mobile-menu-left-overlay"></div>
        <nav class="side-menu">
            <ul class="side-menu-list">
                <li class="blue">
                    <a href="{{ url('buat-rapat') }}">
                        <i class="fa fa-pencil"></i>
                        <span class="lbl">Buat Rapat</span>
                    </a>
                </li>
                <li class="gold">
                    <a href="{{ url('/') }}">
                        <i class="fa fa-book"></i>
                        <span class="lbl">Kelola Rapat</span>
                    </a>
                </li>
                <li class="green">
                    <a href="{{ url('cari-rapat') }}">
                        <i class="fa fa-search"></i>
                        <span class="lbl">Cari Rapat</span>
                    </a>
                </li>

                @if(Auth::user()->role == 1)            
                    <li class="red">
                        <a href="{{ url('/kelola-akun') }}">
                            <i class="fa fa-users"></i>
                            <span class="lbl">Kelola Akun</span>
                        </a>
                    </li>
                @endif

                <li class="dropdown dropdown-notifications">
                    <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
                      <i data-count="{{ $notifications->count() }}" class="glyphicon glyphicon-bell notification-icon"></i>  
                      <span class="lbl">Pemberitahuan</span>
                    </a>

                    <!-- NOTIFICATIONS -->
                    <div class="dropdown-menu notification-dropdown-menu" aria-labelledby="notifications-dropdown">
                        <h6 class="dropdown-header">Notifications</h6>
                        <div id="notificationsContainer" class="notifications-container"></div>
                        <!-- TOUTES -->
                        @if($notifications)
                            @foreach($notifications as $notification)
{{--                             @if(!$notifications)
                            <a class="dropdown-item dropdown-notification-all
                            " href="{{url('home')}}</a>
                                @else --}}
                            <a class="dropdown-item dropdown-notification-all
                            " href="{{url('rapat/show/'.$notification->data['message_rapat_id'].'/'.$notification->id)}}">{{ $notification->data['message_title'] }}</a>
                            {{-- @endif --}}
                            @endforeach
                        @endif

                    </div>

                </li><!-- /dropdown -->
            </ul>
        </nav>    
    @endif

    <div class="page-content">
        <div class="container-fluid">
            @yield('content')
        </div><!--.container-fluid-->
    </div><!--.page-content-->
    @if(Auth::check())
                        <div id="MyModal{{ Auth::user()->id }}" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4>Edit Akun</h4>
                              </div>
                              <form action="{{ url('/update-akunsaya') }}" method="POST">
                                @csrf
                              <div class="modal-body">
                                <input class="form-control" type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <label class="m-2">Nama</label>
                                    <input class="form-control" type="text" name="username" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label class="m-2">NIK</label>
                                    <input class="form-control" type="text" name="nik" value="{{ Auth::user()->nik }}">
                                </div>
                                <div class="form-group">
                                    <label class="m-2">Email</label>
                                    <input class="form-control" type="text" name="email" value="{{ Auth::user()->email }}">
                                </div>
                                <div class="form-group">
                                    <label class="m-2">Jabatan</label>
                                    <select id="status" class="form-control" name="status">
                                        <option value="Tenaga Pengajar" {{Auth::user()->level == "Tenaga Pengajar" ? 'selected' : '' }}>Tenaga Pengajar</option>
                                        <option value="Dosen" {{Auth::user()->level == "Dosen" ? 'selected' : '' }}>Dosen</option>
                                    </select>                                    
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="m-2">Reset Password</label>
                                    <input class="form-control" type="password" name="password" value="" minlength="6">
                                </div>
                              </div>
                              
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>                               
    @endif                                                 

    @include('layouts.js')
</body>
</html>