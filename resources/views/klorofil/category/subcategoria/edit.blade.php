@extends('klorofil.layout')
@section('content')
	<h2 class="page-title"><b>{{ $parent->name }}</b> </h2>
	<h3 class="page-title">Editar Sub Categoría</h3>
	<div class="panel">
		<div class="panel-body">
			@include('klorofil.category.form',['url' => action('SubCategoriesController@update',[$parent->id, $category->id]),'method' =>"PUT",$edit=true])
		</div>
	</div>
@endsection