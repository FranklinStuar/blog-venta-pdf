<!doctype html>
<html lang="es">

<head>
	<title>Neurocodigo</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	@yield('meta')
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{ url('plugins/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ url('plugins/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ url('plugins/linearicons/style.css') }}">
	<link rel="stylesheet" href="{{ url('plugins/chartist/css/chartist-custom.css') }}">
	<link rel="stylesheet" href="{{ url('plugins/Select2/css/select2.css') }}">

	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{ url('klorofil/css/main.css') }}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{ url('klorofil/css/demo.css') }}">
	<!-- GOOGLE FONTS -->
	{{-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet"> --}}
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{ url('klorofil/img/apple-icon.png') }}">
	{{-- <link rel="icon" type="image/png" sizes="96x96" href="{{ url('klorofil/img/favicon.png') }}"> --}}

	<!--ToastMessage-->
	<link href="{{url('plugins/jquery-toastmessage/css/jquery.toastmessage.css')}}" rel="stylesheet">
	
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="{{ url('/') }}"><img src="{{ url('klorofil/img/logo.png') }}" alt="Klorofil Logo" class="img-responsive logo" style="max-height: 30px;"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				{{-- <form class="navbar-form navbar-left">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="Buscar opción...">
						<span class="input-group-btn"><button type="button" class="btn btn-primary"> <span class="lnr lnr-magnifier"></span></button></span>
					</div>
				</form> --}}
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						{{-- <li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="badge bg-danger">5</span>
							</a>
							<ul class="dropdown-menu notifications">
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
								<li><a href="#" class="more">See all notifications</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Help</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#">Basic Use</a></li>
								<li><a href="#">Working With Data</a></li>
								<li><a href="#">Security</a></li>
								<li><a href="#">Troubleshooting</a></li>
							</ul>
						</li> --}}
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
						<!-- <li>
							<a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
						</li> -->
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
							<li><a href="{{ url('/neuro-admin') }}"><i class="lnr lnr-file-empty"></i> <span>Dashboard</span></a></li>

						@if( Shinobi::can('cayegory.list') || Shinobi::can('post.new') || Shinobi::can('post.list'))
							<li>
								<a href="#posts-menu" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Posts</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="posts-menu" class="collapse ">
									<ul class="nav">
										@if (Shinobi::can('category.list'))
											<li><a href="{{ url('/neuro-admin/categories') }}" class="">Categorias</a></li>
										@endif
										@if (Shinobi::can('post.new'))
											<li><a href="{{ url('/neuro-admin/posts/create') }}" class="">Nuevo Post</a></li>
										@endif
										@if (Shinobi::can('post.list'))
											<li><a href="{{ url('/neuro-admin/posts') }}" class="">Lista de Posts</a></li>
										@endif
									</ul>
								</div>
							</li>
						@endif
						
						<li>
							<a href="#premium-sponsors-menu" data-toggle="collapse" class="collapsed"><i class="lnr lnr-diamond"></i> <span>Premium Posts</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="premium-sponsors-menu" class="collapse ">
								<ul class="nav">
									@if (Shinobi::can('post.admin.price.new'))
											<li><a href="{{ route('premium-post.create') }}" class="">Nuevo Premium</a></li>
									@endif
									@if (Shinobi::can('post.admin.price.list'))
										<li><a href="{{ route('premium-post.index') }}" class="">Lista de precios</a></li>
									@endif
									<li><hr></li>
									@if (Shinobi::can('post.admin.pay.new'))
										<li><a href="{{ route('pay-post.create') }}" class="">Nuevo Pago</a></li>
									@endif
									@if (Shinobi::can('post.admin.pay.list'))
										<li><a href="{{ route('pay-post.index') }}" class="">Lista de pagos</a></li>
									@endif
								</ul>
							</div>
						</li>

						@if (\Shinobi::can('sponsor.admin.add') || \Shinobi::can('sponsor.admin.list'))
							<li>
								<a href="#sponsors-menu" data-toggle="collapse" class="collapsed"><i class="lnr lnr-layers"></i> <span>Sponsors</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="sponsors-menu" class="collapse ">
									<ul class="nav">
										@if (\Shinobi::can('sponsor.admin.add'))
											<li><a href="{{ route('sponsors.create') }}" class="">Nuevo Sponsor</a></li>
										@endif
										@if (\Shinobi::can('sponsor.admin.list'))
											<li><a href="{{ route('sponsors.index') }}" class="">Lista de Sponsors</a></li>
										@endif
									</ul>
								</div>
							</li>
						@endif

						@if (\Shinobi::can('sponsor.price.new') || \Shinobi::can('sponsor.price.list'))
							<li>
								<a href="#premium-posts-menu" data-toggle="collapse" class="collapsed"><i class="lnr lnr-diamond"></i> <span>Premium Sponsor</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="premium-posts-menu" class="collapse ">
									<ul class="nav">
										@if (Shinobi::can('sponsor.price.new'))
											<li><a href="{{ route('premium-sponsor.create') }}" class="">Nuevo Premium</a></li>
										@endif
										@if (Shinobi::can('sponsor.price.list'))
											<li><a href="{{ route('premium-sponsor.index') }}" class="">Lista de precios</a></li>
										@endif
										{{-- <li><a href="{{ route('payment-sponsor.index') }}" class="">Realizar Pago</a></li> --}}
									</ul>
								</div>
							</li>
						@endif
						
						@if( Shinobi::can('user.new') || Shinobi::can('user.lists') || Shinobi::can('role.list'))
							<li>
								<a href="#users-menu" data-toggle="collapse" class="collapsed"><i class="lnr lnr-users"></i> <span>Usuarios</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="users-menu" class="collapse ">
									<ul class="nav">
										@if (Shinobi::can('user.new'))
											<li><a href="{{ url('/neuro-admin/users/create') }}" class="">Nuevo</a></li>
										@endif
										@if (Shinobi::can('user.list'))
											<li><a href="{{ url('/neuro-admin/users') }}" class="">Lista de Usuarios</a></li>
										@endif
										@if (Shinobi::can('role.list'))
											<li><a href="{{ url('/neuro-admin/roles') }}" class="">Roles</a></li>
										@endif
									</ul>
								</div>
							</li>
						@endif

						<li>
							<a href="#system-menu" data-toggle="collapse" class="collapsed"><i class="lnr lnr-cog"></i> <span>Sistema</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="system-menu" class="collapse ">
								<ul class="nav">
									@if(\Shinobi::can('system.edit'))
										<li><a href="{{ route('config') }}" class="">Configuración</a></li>
									@endif
									@if(\Shinobi::can('system.edit'))
										<li><a href="{{ route('historial') }}" class="">Historial de visitas</a></li>
									@endif
									<li><a href="{{ url('/neuro-admin') }}" class="">Estadisticas de Posts</a></li>
									<li><a href="{{ url('/neuro-admin') }}" class="">Estadisticas de Sponsors</a></li>
									<li><a href="{{ url('/neuro-admin') }}" class="">Estadisticas Usuarios</a></li>
									@if(\Shinobi::can('lock'))
										<li><a href="{{ url('/neuro-admin') }}" class="">Bloquear</a></li>
									@endif
								</ul>
							</div>
						</li>

						{{-- <li><a href="icons.html" class=""><i class="lnr lnr-linearicons"></i> <span>Icons</span></a></li> --}}
						<li><a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                   	document.getElementById('logout-form').submit();">
									<i class="lnr lnr-exit"></i> 
									<span>Salir</span>
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
	<script src="{{url('plugins/jquery-toastmessage/jquery.toastmessage.js')}}"></script>
	<script src="{{ url('klorofil/js/klorofil-common.js') }}"></script>
	@yield('script')
</body>

</html>
