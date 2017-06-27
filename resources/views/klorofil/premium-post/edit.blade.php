@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Editar Precio para Premium de Post</h3>
			@include('klorofil.premium-post.form',['edit'=>true,'url' => route('premium-post.update',['i'=>$premium->id]),'method' =>"PUT"])
@endsection