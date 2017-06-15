@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Editar Roles</h3>
	<div class="panel">
		<div class="panel-body">
			@include('klorofil.roles.form',['url' => route('roles.update',['i'=>$role->id]),'method' =>"PUT"])
		</div>
	</div>
@endsection