@extends('corporate.layout')

@section('title')
	Sistema
@endsection


@section('metas')
<meta name="description" content="Innovación, nuestro compromiso">
<meta name="keywords" content="sistema, neuro, codigo, mecatronica, tecnología, innovacion, futuro">
<meta name="robots" content="Index,Follow">
<meta name="author" content="sistema.com">
<meta name="owner" content="Admin">
<meta name="subjetc" content="Sistema">
<meta name="languaje" content="es">
<meta name="revisit-after" content="30">
<meta name="title" content="Sistema">



<!-- Twitter Card data -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="Sistema">
<meta name="twitter:description" content="Innovación, nuestro compromiso">
<meta name="twitter:creator" content="@author_handle">
<!-- Twitter Summary card images. Igual o superar los 200x200px -->
<meta name="twitter:image" content="{{ url('images/favicon.png') }}">


<!-- Open Graph data -->
<meta property="og:title" content="Sistema" />
<meta property="og:type" content="article" />
<meta property="og:url" content=" {{ url('/') }}" />
<meta property="og:image" content=" {{ url('images/favicon.png') }}" />
<meta property="og:description" content="Innovación, nuestro compromiso" />
<meta property="og:site_name" content="Sistema, i.e. Moz" /meta property="fb:admins" content="1311771035" />





@endsection

@section('google-script')
	{!! $system->tag_script !!}
@endsection

@section('container')
<style>

</style>
	<main>
		<!--Main layout-->
			{{-- Lista de posts con publicidad --}}
			@include('corporate.posts.template-post-list')
		<!--/.Main layout-->
	</main>


@endsection

