@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Editar Usuario</h3>
	<div class="panel">
		<div class="panel-body">
			@include('klorofil.users.form',['url' => route('users.update',['i'=>$user->id]),'method' =>"PUT"])
		</div>
	</div>
@endsection