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
		<div class="container">
			{{-- Lista de posts con publicidad --}}
			@include('corporate.posts.template-post-list')
		</div>
		<!--/.Main layout-->
	</main>


@endsection

