<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>Neurocódigo</title>

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
						<li class="nav-item">
							<a class="nav-link">Características</a>
						</li>
						<li class="nav-item">
							<a class="nav-link">Precios</a>
						</li>
						<li class="nav-item">
							<a href="{{ url('home') }}" class="nav-link">Perfil</a>
						</li>
						<li class="nav-item dropdown btn-group">
							<a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
							<div class="dropdown-menu dropdown" aria-labelledby="dropdownMenu1">
								<a class="dropdown-item">Action</a>
								<a class="dropdown-item">Another action</a>
								<a class="dropdown-item">Something else here</a>
							</div>
						</li>
					</ul>
					<form class="form-inline waves-effect waves-light">
						<input class="form-control" type="text" placeholder="Search">
					</form>
					<ul class="navbar-nav mr-auto">
						<li class="nav-item dropdown btn-group">
							<a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-user" aria-hidden="true"></i>
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

	<main>

		<!--Main layout-->
		<div class="container">
			<!--First row-->
			<div class="row wow fadeIn" data-wow-delay="0.2s">
				<div class="col-lg-7">
					<!--Featured image -->
					<div class="view overlay hm-white-light z-depth-1-half">
						<img src="http://mdbootstrap.com/img/Photos/Slides/img%20%2877%29.jpg" class="img-fluid " alt="">
						<div class="mask">
						</div>
					</div>
					<br>
				</div>

				<!--Main information-->
				<div class="col-lg-5">
					<h2 class="h2-responsive">We are professionals</h2>
					<hr>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis pariatur quod ipsum atque quam dolorem voluptate officia sunt placeat consectetur alias fugit cum praesentium ratione sint mollitia, perferendis natus quaerat!</p>
					<a href="" class="btn btn-info">Get it now!</a>
				</div>
			</div>
			<!--/.First row-->

			<hr class="extra-margins">

			<!--Second row-->
			<div class="row">
				<!--First columnn-->
				<div class="col-lg-4">
					<!--Card-->
					<div class="card wow fadeIn" data-wow-delay="0.4s">

						<!--Card image-->
						<div class="view overlay hm-white-slight">
							<img src="http://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20(37).jpg" class="img-fluid" alt="">
							<a href="#">
								<div class="mask"></div>
							</a>
						</div>
						<!--/.Card image-->

						<!--Card content-->
						<div class="card-block">
							<!--Title-->
							<h4 class="card-title">Card title</h4>
							<!--Text-->
							<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							<a href="#" class="btn btn-info">Read more</a>
						</div>
						<!--/.Card content-->

					</div>
					<!--/.Card-->
				</div>
				<!--First columnn-->

				<!--Second columnn-->
				<div class="col-lg-4">
					<!--Card-->
					<div class="card wow fadeIn" data-wow-delay="0.6s">

						<!--Card image-->
						<div class="view overlay hm-white-slight">
							<img src="http://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20(21).jpg" class="img-fluid" alt="">
							<a href="#">
								<div class="mask"></div>
							</a>
						</div>
						<!--/.Card image-->

						<!--Card content-->
						<div class="card-block">
							<!--Title-->
							<h4 class="card-title">Card title</h4>
							<!--Text-->
							<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							<a href="#" class="btn btn-info">Read more</a>
						</div>
						<!--/.Card content-->

					</div>
					<!--/.Card-->
				</div>
				<!--Second columnn-->

				<!--Third columnn-->
				<div class="col-lg-4">
					<!--Card-->
					<div class="card wow fadeIn" data-wow-delay="0.8s">

						<!--Card image-->
						<div class="view overlay hm-white-slight">
							<img src="http://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20(12).jpg" class="img-fluid" alt="">
							<a href="#">
								<div class="mask"></div>
							</a>
						</div>
						<!--/.Card image-->

						<!--Card content-->
						<div class="card-block">
							<!--Title-->
							<h4 class="card-title">Card title</h4>
							<!--Text-->
							<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							<a href="#" class="btn btn-info">Read more</a>
						</div>
						<!--/.Card content-->

					</div>
					<!--/.Card-->
				</div>
				<!--Third columnn-->
			</div>
			<!--/.Second row-->
		</div>
		<!--/.Main layout-->

	</main>

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