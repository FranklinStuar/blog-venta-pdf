@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Nueva Categoría</h3>
	<div class="panel">
		<div class="panel-body">
			@include('klorofil.category.form',['url' => action('CategoriesController@store'),'method' =>"POST"])
		</div>
	</div>
@endsection