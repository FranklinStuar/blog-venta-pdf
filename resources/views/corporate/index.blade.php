@extends('corporate.layout')

@section('title')
	Neurocodigo
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

