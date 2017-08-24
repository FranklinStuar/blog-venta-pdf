@extends('klorofil.layout')

@section('content')
	<h3 class="page-title">Nuevo Post</h3>
	@include('klorofil.posts.form',['url' => route('posts.store'),'method' =>"POST",'edit'=>false,'id'=>'new-post'])	
@endsection
