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

	<section id="blog" class="container">
			<div class="row">
					<aside class="col-sm-4 col-sm-push-8">
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
							
							@yield('widget-more-options')

							<hr>
							<div class="widget google">
								{!! $system->tag_body !!}                 
							</div><!--/.categories-->
							@yield('tags')
							<hr>
							<h4>Visitanos en Facebook</h4>
							<div class="fb-page" data-href="https://www.facebook.com/gomecatronica/"  data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/gomecatronica/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/gomecatronica/">Mecatronica</a></blockquote></div>
					</aside>        
					<div class="col-sm-8 col-sm-pull-4">
							@include('flat.posts.list-index')
					</div><!--/.col-md-8-->
			</div><!--/.row-->
	</section><!--/#blog-->

@endsection






