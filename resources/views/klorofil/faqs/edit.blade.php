@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Editar Pregunta</h3>
	<div class="panel">
		<div class="panel-body">
			@include('klorofil.faqs.form',['url' => route('faqs.update',[$faq->id]),'method' =>"PUT"])
		</div>
	</div>
@endsection