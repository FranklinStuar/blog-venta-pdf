@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Nuevo Sponsor</h3>
	<div class="panel">
		<div class="panel-body">
			@include('klorofil.sponsors.form',['url' => route('sponsors.store'),'method' =>"POST"])
		</div>
	</div>
@endsection