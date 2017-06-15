@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Nuevo Rol</h3>
	<div class="panel">
		<div class="panel-body">
			@include('klorofil.roles.form',['url' => route('roles.store'),'method' =>"POST"])
		</div>
	</div>
@endsection