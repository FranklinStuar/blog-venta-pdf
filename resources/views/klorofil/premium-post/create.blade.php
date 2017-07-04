@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Nuevo Precio para Premium de Post</h3>
			@include('klorofil.premium-post.form',['edit'=>false,'url' => route('premium-post.store'),'method' =>"POST"])
	
@endsection