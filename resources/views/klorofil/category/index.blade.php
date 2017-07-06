@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Categorias de Posts</h3>
	<div class="panel">
		<div class="panel-body">
			<div class="col-sm-4">
				@if (Shinobi::can('category.new') || Shinobi::can('dashboard.superadmin'))
					<a href="{{ route('categories.create') }}" class="btn btn-primary">Nueva Categoría  <span class="lnr lnr-plus-circle"></span></a>
				@endif
			</div>
		</div>
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Slug</th>
						{{-- <th>Categoría Padre</th> --}}
						<th># Posts</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $index => $category)
						<tr>
							<td>{{ $index+1 }}</td>
							<td>{{ $category->name }}</td>
							<td>{{ $category->slug }}</td>
							{{-- <td> @if($category->parent){{ $category->parent->name }}@endif</td> --}}
							<td>{{ $category->posts->count() }}</td>
							<td>
								@if (Shinobi::can('category.edit') || Shinobi::can('dashboard.superadmin'))
									{!! link_to_action('CategoriesController@edit', "",['i'=>$category->id], ['class' =>'glyphicon glyphicon-pencil']) !!}
								@endif

								@if (Shinobi::can('category.destroy') || Shinobi::can('dashboard.superadmin'))
									{!! Form::open(['action' => ['CategoriesController@destroy',$category->id],'method'=>'DELETE','style'=>'display: inline;','class'=>'destroy']) !!}
										<button class="btn btn-link glyphicon glyphicon-trash" style="transform: none;"></button>
									{!! Form::close() !!}
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection