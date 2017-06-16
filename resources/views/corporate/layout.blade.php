<!DOCTYPE html>
<html lang="es">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>@yield('title')</title>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

	<!-- Bootstrap core CSS -->
	<link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

	<!-- Material Design Bootstrap -->
	<link href="{{ url('corporate/css/mdb.min.css') }}" rel="stylesheet">

	<!-- Template styles -->
	<style rel="stylesheet">
		/* TEMPLATE STYLES */
		
		main {
			padding-top: 3rem;
			padding-bottom: 2rem;
		}
		
		.extra-margins {
			margin-top: 1rem;
			margin-bottom: 2.5rem;
		}
		 .navbar {
			background-color: #3b3b3f;
		}
		
		footer.page-footer {
			background-color: #3b3b3f;
			margin-top: 2rem;
		 
		}
	</style>

</head>

<body>


	<header>

		<!--Navbar-->
		<nav class="navbar navbar-toggleable-md navbar-dark">
			<div class="container">
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">
					<strong>Neurocódigo</strong>
				</a>
				<div class="collapse navbar-collapse" id="navbarNav1">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							{{-- <a class="nav-link">Home <span class="sr-only">(current)</span></a> --}}
						</li>
						<li class="nav-item dropdown btn-group">
							<a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categorías</a>
							<div class="dropdown-menu dropdown" aria-labelledby="dropdownMenu1">
								@foreach($categories as $category)
									<a href="{{ route('show-category',['cID'=>$category->slug]) }}" class="dropdown-item">{{ $category->name }}</a>
								@endforeach
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link">Precios</a>
						</li>
					</ul>
					{!! Form::open(['route' => 'search','method'=>'GET','class'=>"form-inline waves-effect waves-light"]) !!}
						<input name="search" class="form-control" type="text" placeholder="Buscar" @isset ($search) value="{{ $search }}" @endisset>
					{!! Form::close() !!}
					<ul class="navbar-nav mr-auto">
						<li class="nav-item dropdown btn-group">
							<a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-user" aria-hidden="true"></i> 
								@if(!Auth::guest())
									{{ Auth::user()->name }}
								@endif
							</a>
							<div class="dropdown-menu dropdown" aria-labelledby="dropdownMenu1">
								@if(!Auth::user())
									<a href="{{ url('login') }}" class="dropdown-item">Iniciar Sesion</a>
									<a href="{{ url('register') }}" class="dropdown-item">Registrarse</a>
								@else
									<a href="{{ url('profile') }}" class="dropdown-item">Ver Perfil</a>
									<a href="{{ route('admin') }}" class="dropdown-item">Administrar</a>
									<a href="{{ route('logout') }}" 
                      onclick="event.preventDefault();
                       	document.getElementById('logout-form').submit();">
                      Salir
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
								@endif
							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!--/.Navbar-->

	</header>

			@yield('container')


	<!--Footer-->
	<footer class="page-footer center-on-small-only">

		<!--Footer Links-->
		<div class="container-fluid">
			<div class="row">

				<!--First column-->
				<div class="col-md-3 offset-lg-1 hidden-lg-down">
					<h5 class="title">ABOUT MATERIAL DESIGN</h5>
					<p>Material Design (codenamed Quantum Paper) is a design language developed by Google. </p>

					<p>Material Design for Bootstrap (MDB) is a powerful Material Design UI KIT for most popular HTML, CSS, and JS framework - Bootstrap.</p>
				</div>
				<!--/.First column-->

				<hr class="hidden-md-up">

				<!--Second column-->
				<div class="col-lg-2 col-md-4 offset-lg-1">
					<h5 class="title">First column</h5>
					<ul>
						<li><a href="#!">Link 1</a></li>
						<li><a href="#!">Link 2</a></li>
						<li><a href="#!">Link 3</a></li>
						<li><a href="#!">Link 4</a></li>
					</ul>
				</div>
				<!--/.Second column-->

				<hr class="hidden-md-up">

				<!--Third column-->
				<div class="col-lg-2 col-md-4">
					<h5 class="title">Second column</h5>
					<ul>
						<li><a href="#!">Link 1</a></li>
						<li><a href="#!">Link 2</a></li>
						<li><a href="#!">Link 3</a></li>
						<li><a href="#!">Link 4</a></li>
					</ul>
				</div>
				<!--/.Third column-->

				<hr class="hidden-md-up">

				<!--Fourth column-->
				<div class="col-lg-2 col-md-4">
					<h5 class="title">Third column</h5>
					<ul>
						<li><a href="#!">Link 1</a></li>
						<li><a href="#!">Link 2</a></li>
						<li><a href="#!">Link 3</a></li>
						<li><a href="#!">Link 4</a></li>
					</ul>
				</div>
				<!--/.Fourth column-->

			</div>
		</div>
		<!--/.Footer Links-->

		<!--Copyright-->
		<div class="footer-copyright">
			<div class="container-fluid">
				© 2017  Copyright: <a href="http://159.203.134.10/">aikire.com </a>

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
	
	<script>
	new WOW().init();
	</script>

</body>

</html>

