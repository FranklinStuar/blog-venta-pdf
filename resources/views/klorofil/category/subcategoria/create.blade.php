@extends('klorofil.layout')
@section('title')
Nueva sub categoria
@endsection

@section('content')
	<h2 class="page-title"><b>{{ $parent->name }}</b> </h2>
	<h3 class="page-title">Nueva Sub Categoría </h3>
	<div class="panel">
		<div class="panel-body">
			@include('klorofil.category.form',['url' => action('SubCategoriesController@store',[$parent->id]),'method' =>"POST",$edit=false])
		</div>
	</div>
@endsection