@extends('flat.posts.template')
@section('breadcrumb')
	<li class="active">{{ $title }}</li>
@endsection

@section('title')
{{ $title }}
@endsection

@section('metas')
	<meta name="title" content="{{ $title }}">
	<meta name="description" content="{{ str_limit($context,150) }}">
	<meta name="author" content="{{ url('/') }}">
	<meta name="owner" content="{{ $system->responsable }}">
	<meta name="subjetc" content="{{ $title }}">
	<meta name="languaje" content="es">
	<meta name="revisit-after" content="30">

	<!-- Twitter Card data -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@publisher_handle">
	<meta name="twitter:title" content="{{ $title }}">
	<meta name="twitter:description" content="{{ str_limit($context,160) }}">
	<meta name="twitter:creator" content="@author_handle">
	<!-- Twitter Summary card images. Igual o superar los 200x200px -->
	<meta name="twitter:image" content="{{ url('images/neurocodigo.png') }}">



	<meta property="og:url"                content="{{ route('show-service',[$page]) }}" />
	<meta property="og:type"               content="website" />
	<meta property="og:title"              content="{{ $title }}" />
	<meta property="og:description"        content="{{ str_limit($context,150) }}" />
	<meta property="og:image"              content="{{ url('images/neurocodigo.png') }}" />
	<meta property="og:updated_time" content="{{ $system->updated_at }}">

	<meta name="DC.Creator" content="{{ $system->responsable }}" />
	<meta name="DC.Date" content="Agosto 1 2017" />
	<meta name="DC.Source" content="Neurocodigo" />
	<meta property="article:modified_time" content="{{ $system->updated_at }}">
	<meta property="article:published_time" content="{{ $system->created_at }}">
	<link rel="canonical" href="{{ route('show-service',[$page]) }}" />

@endsection

@section('fb')

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.10&appId=197798067417693";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

@endsection

@section('content-post')
	<div class="blog">
		<div class="blog-item">
			<div class="blog-content">
				{!! $context !!}
				
			</div>
		</div><!--/.blog-item-->
	</div>


@endsection

