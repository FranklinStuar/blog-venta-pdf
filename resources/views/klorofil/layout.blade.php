<!doctype html>
<html lang="es">

<head>
	<title>Neurocodigo</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	{{-- CSRF Token --}}
	<meta name="csrf-token" id="token" content="{{ csrf_token() }}">
	
	@yield('meta')
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{ url('plugins/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ url('plugins/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ url('plugins/linearicons/style.css') }}">
	<link rel="stylesheet" href="{{ url('plugins/chartist/css/chartist-custom.css') }}">
	<link rel="stylesheet" href="{{ url('plugins/Select2/css/select2.css') }}">
  	<link rel="stylesheet" href="{{url('plugins/summernote/summernote.css')}}">

	{{-- sweetalert2 --}}
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.6.2/sweetalert2.min.css">

	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{ url('klorofil/css/main.css') }}">
	
	@yield('style')
	
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{ url('klorofil/css/demo.css') }}">
	
	<!-- GOOGLE FONTS -->
	{{-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet"> --}}
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="64x64" href="{{ url('images/favicon.png') }}">
	<link rel="icon" type="image/png" sizes="64x64" href="{{ url('images/favicon.png') }}">
	
	<!--ToastMessage-->
	<link href="{{url('plugins/jquery-toastmessage/css/jquery.toastmessage.css')}}" rel="stylesheet">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body data-u="{{ url('/') }}">
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="{{ url('/') }}"><img src="{{ url('images/neurocodigo.png') }}" alt="Nerucodigo Logo" class="img-responsive logo" style="max-height: 40px;"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						

						<li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-envelope"></i>
								@if($messagesNoView)
									<span class="badge bg-danger">{{ $messagesNoView }}</span>
								@endif
							</a>
							<ul class="dropdown-menu notifications">
								<li><a href="{{ route('messages-contact.index') }}" class="more">Mensajes directos</a></li>
								@foreach($messagesContact as $message)
									<li>
									<a href="{{ route('messages-contact.show',[$message->id]) }}" class="notification-item">
										@if($message->status=='sin_revisar')
											<span class="dot bg-success"></span>
										@elseif($message->status=='revisado')
											<span class="dot bg-info"></span>
										@endif
										{{ str_limit($message->message,35) }}
									</a>
									</li>
								@endforeach
								{{-- <li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li> --}}
								{{-- <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li> --}}
								{{-- <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li> --}}
								{{-- <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li> --}}
								@if($messagesNoView > 5)
									<li><a href="{{ route('messages-contact.index') }}" class="more">Ver todos los mensajes</a></li>
								@endif
							</ul>
						</li>


						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="{{ url('images/'.Auth::user()->avatar) }}" class="img-circle" alt="Avatar"> 
									<span>{{ Auth::user()->name }}</span> 
										<i class="icon-submenu lnr lnr-chevron-down"></i>
							</a>
							<ul class="dropdown-menu">
								<li><a href="{{ route('profile') }}"><i class="lnr lnr-user"></i> <span>Mi Perfil</span></a></li>
								<li><a href="{{ route('logout') }}"
								  onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
									<i class="lnr lnr-exit"></i> <span>Salir</span></a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										  {{ csrf_field() }}
									  </form>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
				<br>
					<ul class="nav">
					@if( Shinobi::can('send-mail'))
						<li><a href="{{ route('send-email') }}">Enviar email</a></li>
					@endif
						<li><a href="{{ url('/neuro-admin') }}"><i class="lnr lnr-file-empty"></i> <span>Dashboard</span></a></li>
						<li><a href="{{ route('categories.index') }}" class="">Categorías</a></li>
						<li><a href="{{ url('/neuro-admin/posts') }}" class="">Posts</a></li>

						<li>
							<a href="#premium-sponsors-menu" data-toggle="collapse" class="collapsed">
								<span>Publicaciones</span> <i class="icon-submenu lnr lnr-chevron-left"></i>
							</a>
							<div id="premium-sponsors-menu" class="collapse ">
								<ul class="nav">
									
									<li><a href="{{ route('only-pay-post.index') }}" class="">Pagos Individuales</a></li>
									<li><a href="{{ route('premium-post.index') }}" class="">Kits</a></li>
									<li><a href="{{ route('pay-post.index') }}" class="">Pagos Kits</a></li>
								</ul>
							</div>
						</li>

						<li>
							<a href="#sponsors-menu" data-toggle="collapse" class="collapsed"><i class="lnr lnr-layers"></i> <span>Sponsors</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="sponsors-menu" class="collapse ">
								<ul class="nav">
									<li><a href="{{ route('sponsors.index') }}" class="">Sponsors</a></li>
									<li><a href="{{ route('premium-sponsor.index') }}" class="">Precios</a></li>
								</ul>
							</div>
						</li>

						<li><a href="{{ url('/neuro-admin/users') }}"><i class="lnr lnr-users"></i> <span>Usuarios</span></a></li>

						<li>
							<a href="#system-menu" data-toggle="collapse" class="collapsed"><i class="lnr lnr-cog"></i> <span>Sistema</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="system-menu" class="collapse ">
								<ul class="nav">
									<li><a href="{{ route('config') }}" class="">Configuración</a></li>
									<li><a href="{{ route('historial') }}" class="">Historial de visitas</a></li>
									{{-- <li><a href="{{ url('/neuro-admin') }}" class="">Estadisticas de Posts</a></li> --}}
									{{-- <li><a href="{{ url('/neuro-admin') }}" class="">Estadisticas de Sponsors</a></li> --}}
									{{-- <li><a href="{{ url('/neuro-admin') }}" class="">Estadisticas Usuarios</a></li> --}}
									<li><a href="{{ url('/neuro-admin/faqs') }}" class="">Faq</a></li>
								</ul>
							</div>
						</li>

						{{-- <li><a href="icons.html" class=""><i class="lnr lnr-linearicons"></i> <span>Icons</span></a></li> --}}
						<li><a href="{{ route('logout') }}"
				  onclick="event.preventDefault();
					document.getElementById('logout-form').submit();">
									<i class="lnr lnr-exit"></i> 
									<span>Cerrar Sesion</span>
				</a>
			</li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">

					@if(count($errors)>0)
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							<ul>
								@foreach($errors->all() as $error)
									<li><i class="fa fa-times-circle"></i> {{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
{{-- 
					@if(\Session::has('errors'))
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							<ul>
								@foreach(\Session::get('errors')->all() as $error)
									<li><i class="fa fa-times-circle"></i> {{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
 --}}
					@if(\Session::has('success'))
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							
									<i class="fa fa-times-circle"></i> {{ \Session::get('success') }}
								
							</ul>
						</div>
					@endif

					@yield('content')
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="http://159.203.134.10/" target="_blank">Aikire</a>. Todos los derechos reservados.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ url('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ url('plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ url('plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
	<script src="{{ url('plugins/chartist/js/chartist.min.js') }}"></script>
	<script src="{{ url('plugins/Select2/js/select2.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/sweetalert2/6.6.2/sweetalert2.min.js"></script>
	  <!-- include summernote -->
	<script type="text/javascript" src="{{url('plugins/summernote/summernote.js')}}"></script>
	<script src="{{ url('klorofil/js/klorofil-common.js') }}"></script>
	<script src="{{ url('klorofil/js/script.js') }}"></script>
	<script src="https://unpkg.com/vue"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	@yield('script')
    @stack('scripts')
	
</body>

</html>
