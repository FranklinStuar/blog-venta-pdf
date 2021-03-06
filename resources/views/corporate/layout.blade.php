<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	
	<title>@yield('title')</title>

	<!-- Font Awesome -->
	<link href="{{ url('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Merriweather|Roboto|Lobster|Montserrat" rel="stylesheet">

	<!-- Bootstrap core CSS -->
	<link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

	<link rel="apple-touch-icon" sizes="64x64" href="{{ url('images/favicon.png') }}">
	<link rel="icon" type="image/png" sizes="64x64" href="{{ url('images/favicon.png') }}">
	
	<!-- Material Design Bootstrap -->
	<link href="{{ url('corporate/css/mdb.min.css') }}" rel="stylesheet">
	<link href="{{ url('corporate/css/style.css') }}" rel="stylesheet">
	@yield('google-script')
	@yield('metas')
</head>

<body>


	<header>

		<!--Navbar-->
		<nav class="navbar navbar-toggleable-md navbar-dark">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand" href="{{ url('/') }}">
				<img src="{{ url('images/logo..png') }}" alt="Sistema">
			</a>
			<div class="collapse navbar-collapse" id="navbarNav1">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link free" href="{{ route('post.free') }}"><span>Gratis</span></a>
					</li>
					<li class="nav-item dropdown btn-group">
						<a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categorías</a>
						<div class="dropdown-menu dropdown" aria-labelledby="dropdownMenu1">
							@foreach($categories as $category)
								<a href="{{ route('show-category',['cID'=>$category->slug]) }}" class="dropdown-item">{{ $category->name }}</a>
							@endforeach
						</div>
					</li>

				</ul>
				{!! Form::open(['route' => 'search','method'=>'GET','class'=>"form-inline waves-effect waves-light"]) !!}
					<input name="search" class="form-control" type="text" placeholder="Buscar" @isset ($search) value="{{ $search }}" @endisset>
				{!! Form::close() !!}
				<ul class="navbar-nav ">
					@if(Auth::user())
						<li class="nav-item dropdown btn-group">
							<a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-user" aria-hidden="true"></i> 
								@if(Auth::user())
									{{ Auth::user()->name }}
								@endif
							</a>
							<div class="dropdown-menu dropdown" aria-labelledby="dropdownMenu1">
								
							<a href="{{ url('profile') }}" class="dropdown-item">Ver Perfil</a>
							@if (Shinobi::can('dashboard.admin'))
								<a href="{{ route('admin') }}" class="dropdown-item">Administrar</a>
							@endif
							<a href="{{ route('logout') }}" 
			                      onclick="event.preventDefault();
			                       	document.getElementById('logout-form').submit();">
			                      Salir
			                  </a>

			                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			                      {{ csrf_field() }}
			                  </form>
							</div>
						</li>
					@endif
					@if(!Auth::user())
						<li class="nav-item"> <a href="{{ url('login') }}" class="nav-link">Iniciar Sesion</a> </li>
						<li class="nav-item"> <a href="{{ url('register') }}" class="nav-link">Registrarse</a> </li>
					@endif
				</ul>
			</div>
		</nav>
		<!--/.Navbar-->

	</header>
	
		@if(\Session::has('error'))
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<i class="fa fa-times-circle"></i> {{ \Session::get('error') }}
			</div>
		@endif
		
		@if(\Session::has('success'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<i class="fa fa-times-circle"></i> {{ \Session::get('success') }}
			</div>
		@endif

		@yield('container')


	<!--Footer-->
	<footer class="page-footer center-on-small-only">

		<!--Footer Links-->
		<div class="container-fluid">
			<div class="group-social">
				<center>
					<a href="http://www.facebook.com/{{ $system->facebook }}" class="btn-social btn-social-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> <span>Facebook</span></a>
					<a href="http://www.instagram.com/{{ $system->instagram }}" class="btn-social btn-social-instagram"><i class="fa fa-instagram" aria-hidden="true"></i><span>Instagram</span></a>
					<a href="http://www.youtube.com/{{ $system->youtube }}" class="btn-social btn-social-youtube"><i class="fa fa-youtube" aria-hidden="true"></i><span>Youtube</span></a>
				</center>
			</div>
			<div class="info-system">
				<center>
					<ul>
						<li><a href="#quienes-somos" data-toggle="modal" data-target="#quienesSomosModal">Quienes somos</a></li>
						<li><a href="#acerca-cuentas-premium" data-toggle="modal" data-target="#CuentasPremiumModal">Cuentas Premium</a></li>
						<li><a href="#acerca-publicidad" data-toggle="modal" data-target="#publicidadModal">Publicidad</a></li>
						<li><a href="#politicas-condiciones" data-toggle="modal" data-target="#politicasCondicionesModal">Politicas y condiciones</a></li>
					</ul>
				</center>
			</div>
			
		</div>
		<!--/.Footer Links-->

		<!--Copyright-->
		<div class="footer-copyright">
			<div class="container-fluid">
				© 2017  Copyright: <a href="http://www.desarrollador.com">desarrollador.com </a>

			</div>
		</div>
		<!--/.Copyright-->

	</footer>
	<!--/.Footer-->


	<!-- SCRIPTS -->

	<!-- JQuery -->
	<script type="text/javascript" src="{{ url('js/jquery-2.2.3.min.js') }}"></script>

	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="{{ url('corporate/js/tether.min.js') }}"></script>

	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>

	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="{{ url('corporate/js/mdb.min.js') }}"></script>
	
	@yield('script')

	<script>
	new WOW().init();
	</script>



	<!-- Quienes somos -->
	<div class="modal fade" id="quienesSomosModal" tabindex="-1" role="dialog" aria-labelledby="quienesSomosModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="quienesSomosModalLabel">Quienes somos</h4>
	      </div>
	      <div class="modal-body">
					{!! $system->quienes_somos !!}
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>


	<!-- Cuentas Premium-->
	<div class="modal fade" id="CuentasPremiumModal" tabindex="-1" role="dialog" aria-labelledby="CuentasPremiumModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="CuentasPremiumModalLabel">Acerca de las cuentas premium</h4>
	      </div>
	      <div class="modal-body">
					{!! $system->cuentas_premium !!}
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Publicidad-->
	<div class="modal fade" id="publicidadModal" tabindex="-1" role="dialog" aria-labelledby="publicidadModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="publicidadModalLabel">Acerca de la publicidad</h4>
	      </div>
	      <div class="modal-body">
					{!! $system->publicidad !!}
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Politicas y condiciones-->
	<div class="modal fade" id="politicasCondicionesModal" tabindex="-1" role="dialog" aria-labelledby="politicasCondicionesModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="politicasCondicionesModalLabel">Políticas y condiciones</h4>
	      </div>
	      <div class="modal-body">
					{!! $system->politicas_condiciones !!}
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>


</body>

</html>

