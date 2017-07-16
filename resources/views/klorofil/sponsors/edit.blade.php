@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Editar {{ $sponsor->name }}</h3>
	<div class="panel">
		<div class="panel-body">
			@include('klorofil.sponsors.form',['url' => route('sponsors.update',['sID'=>$sponsor->id]),'method' =>"PUT",'edit'=>true])
		</div>
	</div>
@endsection