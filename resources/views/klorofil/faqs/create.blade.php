@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Nueva Pregunta</h3>
	<div class="panel">
		<div class="panel-body">
			@include('klorofil.faqs.form',['url' => route('faqs.store'),'method' =>"POST"])
		</div>
	</div>
@endsection