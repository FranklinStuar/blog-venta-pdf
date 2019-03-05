@extends('corporate.layout')

@section('title')
	{{ $name }} | Sistema
@endsection

@section('google-script')
	{!! $system->tag_script !!}
@endsection

@section('container')
	<main>
		<!--Main layout-->
		<div class="container">

			<h1 class="title-items">{{ $type }}: {{ $name }}</h1>

			<hr class="extra-margins">

			{{-- Lista de posts con publicidad --}}
			@include('corporate.posts.template-post-list')

		</div>
		<!--/.Main layout-->
	</main>


@endsection

