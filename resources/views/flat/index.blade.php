@extends('flat.layout')

@section('metas')
	<meta name="title" content="Neurocodigo">
	<meta name="description" content="{{ $system->description }}">
	<meta name="news_keywords" content="{{ $system->keywords }}">
	<meta name="author" content="{{ url('/') }}">
	<meta name="owner" content="Neurocodigo">
	<meta name="subjetc" content="Neurocodigo">
	<meta name="languaje" content="es">
	<meta name="revisit-after" content="30">


	<!-- Twitter Card data -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@publisher_handle">
	<meta name="twitter:title" content="Neurocodigo">
	<meta name="twitter:description" content="{{ $system->description }}">
	<meta name="twitter:creator" content="@author_handle">
	<!-- Twitter Summary card images. Igual o superar los 200x200px -->
	<meta name="twitter:image" content="{{ url('image/neurocodigo.png') }}">



	<meta property="og:url"                content="{{ url('/') }}" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="Neurocodigo" />
	<meta property="og:description"        content="{{ $system->description }}" />
	<meta property="og:image"              content="{{ url('image/neurocodigo.png') }}" />
	<meta property="og:updated_time" content="{{ Carbon\Carbon::now() }}">

	<meta name="DC.Creator" content="Neurocodigo" />
	<meta name="DC.Date" content="{{ Carbon\Carbon::now() }}" />
	<meta name="DC.Source" content="Neurocodigo" />
	<link rel="canonical" href="{{ url('/') }}" />

@endsection

@section('container')
	<section id="main-slider" class="no-margin">
		<div class="carousel slide wet-asphalt">
			<ol class="carousel-indicators">
					<li data-target="#main-slider" data-slide-to="0" class="active"></li>
					<li data-target="#main-slider" data-slide-to="1"></li>
					<li data-target="#main-slider" data-slide-to="2"></li>
					<li data-target="#main-slider" data-slide-to="3"></li>
			</ol>
			<div class="carousel-inner">

				<div class="item active" style="background-image: url({{ url('images/slider/bg1.jpg') }})">
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<div class="carousel-content centered">
									<h2 class="boxed animation animated-item-1">Capacitación gratuita</h2><br>
									<p class="boxed animation animated-item-2">Aprovecha nuestra capacitación gratuita llevando al máximo las redes sociales</p>
									<br>
									<a class="btn btn-md animation animated-item-3" href="{{ url('https://youtube.com/'.$system->youtube) }}">Ir a youtube</a>
								</div>
							</div>
						</div>
					</div>
				</div><!--/.item-->

				<div class="item" style="background-image: url({{ url('images/slider/bg3.jpeg') }})">
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<div class="carousel-content center centered">
									<h2 class="boxed animation animated-item-1">Capacitación gratuita</h2><br>
									<p class="boxed animation animated-item-2">Aprovecha nuestra capacitación gratuita llevando al máximo las redes sociales</p>
								</div>
							</div>
						</div>
					</div>
				</div><!--/.item-->

				<div class="item" style="background-image: url({{ url('images/slider/bg2.jpeg') }})">
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<div class="carousel-content centered">
									<h2 class="boxed animation animated-item-1">Capacitación gratuita</h2><br>
									<p class="boxed animation animated-item-2">Aprovecha nuestra capacitación gratuita llevando al máximo las redes sociales</p>
									<br>
									<a class="btn btn-md animation animated-item-3" href="{{ url('https://youtube.com/'.$system->youtube) }}">Ir a youtube</a>
								</div>
							</div>
						</div>
					</div>
				</div><!--/.item-->

				<div class="item" style="background-image: url({{ url('images/slider/bg4.jpeg') }})">
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<div class="carousel-content centered">
									<h2 class="boxed animation animated-item-1">Capacitación gratuita</h2><br>
									<p class="boxed animation animated-item-2">Aprovecha nuestra capacitación gratuita llevando al máximo las redes sociales</p>
									<br>
									<a class="btn btn-md animation animated-item-3" href="{{ url('https://youtube.com/'.$system->youtube) }}">Ir a youtube</a>
								</div>
							</div>
						</div>
					</div>
				</div><!--/.item-->

			</div><!--/.carousel-inner-->
		</div><!--/.carousel-->
		<a class="prev hidden-xs" href="#main-slider" data-slide="prev">
			<i class="fa fa-angle-left"></i>
		</a>
		<a class="next hidden-xs" href="#main-slider" data-slide="next">
			<i class="fa fa-angle-right"></i>
		</a>
	</section><!--/#main-slider-->

	<section id="blog" class="container">
		<div class="row">
			<div class="col-sm-8">
					@include('flat.posts.list-index')
			</div><!--/.col-md-8-->
			<aside class="col-sm-4">
					<div class="widget search">
						{!! Form::open(['route' => 'search','method'=>'GET','class'=>"form-inline waves-effect waves-light"]) !!}
							<div class="input-group">
								<input type="text" name="search" class="form-control" autocomplete="off" placeholder="Buscar" @isset ($search) value="{{ $search }}" @endisset>
									<span class="input-group-btn">
										<button class="btn btn-danger" type="button"><i class="fa fa-search"></i></button>
									</span>
							</div>
						{!! Form::close() !!}
					</div><!--/.search-->

					@include('flat.sponsors.print',['section'=>'lateral','sponsor'=>$system->sponsorRandom()])
					

					<hr>
					<div class="widget google">
						{!! $system->tag_body !!}                 
					</div><!--/.categories-->
					@yield('tags')
					<hr>
					<h4>Visitanos en Facebook</h4>
					<div class="fb-page" data-href="https://www.facebook.com/gomecatronica/"  data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/gomecatronica/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/gomecatronica/">Mecatronica</a></blockquote></div>
			</aside>        
	</div><!--/.row-->
</section><!--/#blog-->

@endsection
