@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Editar Categoría</h3>
	<div class="panel">
		<div class="panel-body">
			@include('klorofil.category.form',['url' => action('CategoriesController@update',['i'=>$category->id]),'method' =>"PUT",$edit=true])
		</div>
	</div>
@endsection