<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title','Inicio') - Sistema</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name='robots' content='noodp' />
    <meta name="googlebot" content="noodp">
    <meta name="”slurp”" content="noodp">
    <meta name="”msnbot”" content="noodp">
    <meta name="msapplication-tooltip" content="Tecnología y avances para su educación"/>
    <meta name="msapplication-starturl" content="{{ url('/') }}"/>
    <meta property="fb:pages" content="323152764504875" />
    <meta property="fb:api_id" content="197798067417693" />
    @yield('metas')
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ url('css/animate.css') }}" rel="stylesheet">
    <link href="{{ url('css/main.css') }}" rel="stylesheet">
    <link href="{{ url('css/style.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ url('js/html5shiv.js') }}"></script>
    <script src="{{ url('js/respond.min.js') }}"></script>
    <![endif]-->       
    
    <link rel="apple-touch-icon" sizes="64x64" href="{{ url('images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ url('images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ url('images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ url('images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ url('images/favicon.png') }}">
    {!! $system->tag_script !!}
    <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '197798067417693',
      xfbml      : true,
      version    : 'v2.10'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/es_ES/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
</head><!--/head-->
<body>
    @yield('fb')
    <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('images/logo..png') }}" alt="logo"></a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    {{-- <li class="active"><a href="{{ url('/') }}">Inicio</a></li> --}}
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Servicios <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            @foreach($categories as $category)
                                <li><a href="{{ route('show-service',$category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ route('kits.list') }}">Precios</a></li>
                    <li><a href="{{ url('https://youtube.com/'.$system->youtube) }}">Youtube</a></li>
                    @if(Auth::user())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('profile') }}">Perfil</a></li>
                                @if(Auth::user()->isRole('superadmin') || Auth::user()->isRole('admin'))
                                    <li><a href="{{ route('admin') }}">Administrar</a></li>
                                @endif
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="lnr lnr-exit"></i> <span>Cerrar Sesion</span></a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                              {{ csrf_field() }}
                                          </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ url('login') }}">Iniciar Sesión</a></li>
                        <li><a href="{{ url('register') }}">Registrarse</a></li>
                    @endif
                    <li><a href="{{ route('show-service',['faq']) }}">FAQ</a></li>
                    <li><a href="{{ route('show-service',['contacts']) }}">Contactos</a></li>
                    <li>
                        <a class="facebook" href="https://www.facebook.com/{{ $system->facebook }}">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
    
                        <a class="instagram" href="https://www.instagram.com/{{ $system->instagram }}">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a class="youtube" href="https://www.youtube.com/{{ $system->youtube }}">
                            <i class="fa fa-youtube" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header><!--/header-->

    <main>


        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <i class="fa fa-times-circle"></i> {{ \Session::get('error') }}
            </div>
        @endif
        @if(\Session::has('errors'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                @foreach($errors as $error)
                    <i class="fa fa-times-circle"></i> {{ $error->message }}
                @endforeach
            </div>
        @endif
        
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <i class="fa fa-times-circle"></i> {{ \Session::get('success') }}
            </div>
        @endif


        @yield('container')
        
        <div>
            <center>{!! $system->tag_body !!}</center>
        </div>
    </main>

    <section id="bottom" class="wet-asphalt">
        <div class="container">
            <div class="row">
                
                <div class="col-md-3 col-sm-6">
                    <h4>Company</h4>
                    <div>
                        <ul class="arrow">
                            <li><a href="{{ route('show-service',['quienes-somos']) }}">Quienes Somos</a></li>
                            <li><a href="{{ route('show-service',['politicas-condiciones']) }}">Políticas y condiciones</a></li>
                            <li><a href="{{ route('show-service',['cuentas-premium']) }}">Cuentas de pago</a></li>
                            <li><a href="{{ route('show-service',['partners']) }}">Publicidad y Partners</a></li>
                            <li><a href="{{ route('show-service',['contacts']) }}">Contactanos</a></li>
                            <li><a href="{{ route('show-service',['faq']) }}">Preguntas Frecuentes</a></li>
                        </ul>
                    </div>
                </div><!--/.col-md-3-->
                <div class="col-md-3 col-sm-6">
                    <h4>Dirección</h4>
                    <address>
                        <strong>{{ $system->direccion  }}</strong><br>
                        <abbr title="Teléfono">Tlf:</abbr> {{ $system->telefono }}
                    </address>

                </div> <!--/.col-md-3-->
                
                <div class="col-md-6 col-sm-6">
                    <h4>Nuestros servicios</h4>
                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-md-4">
                                <div class="media">
                                    <div class="pull-left">
                                        <img class="img-show-category" src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}">
                                    </div>
                                    <div class="media-body">
                                        <span class="media-heading"><a href="{{ route('show-service',[$category->slug]) }}">{{ $category->name }}</a></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>  
                </div><!--/.col-md-6-->

            </div>
        </div>
    </section><!--/#bottom-->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2017 <a target="_blank" href="#" title="Desarrollador">Desarrollador</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li>Volver</li>
                        <li><a id="gototop" class="gototop" href="#"><i class="fa fa-chevron-up"></i></a></li><!--#gototop-->
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="{{ url('js/jquery.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ url('js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>