@extends('flat.posts.template')

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

@section('content-post')
    @include('flat.posts.list-index')
@endsection
