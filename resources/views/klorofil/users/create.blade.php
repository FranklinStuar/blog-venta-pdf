@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Nuevo Usuario</h3>
	<div class="panel">
		<div class="panel-body">
			@include('klorofil.users.form',['url' => action('UsersController@store'),'method' =>"POST"])
		</div>
	</div>
@endsection