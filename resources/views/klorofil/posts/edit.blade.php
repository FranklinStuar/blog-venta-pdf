@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Editar Usuario</h3>
	@include('klorofil.posts.form',['url' => route('posts.update',['i'=>$post->id]),'method' =>"PUT"])
	
@endsection