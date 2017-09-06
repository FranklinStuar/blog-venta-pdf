@extends('klorofil.layout')
@section('content')
	<h3 class="page-title"><a href="{{ route('faqs.index') }}">Pregunta:</a> {{ $faq->question }}</h3>
	<div class="panel">
		<div class="panel-body">
			<p>{{ $faq->answer }}</p>
		</div>
	</div>
@endsection
