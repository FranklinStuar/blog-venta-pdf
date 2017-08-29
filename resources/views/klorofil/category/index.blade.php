@extends('klorofil.layout')
@section('content')
<style>

.img-show-category{
	max-width: 40px;
	max-height: 40px;
}

</style>
	<h3 class="page-title">Categorias de Posts</h3>
	<div class="panel" id="categories">
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
						<th><span class="glyphicon glyphicon-picture"></span></th>
						<th>Nombre</th>
						<th>Sub Categorías</th>
						<th># Posts</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $index => $category)
						<tr>
							<td><img src="{{ Storage::url($category->image) }}" alt="img_{{ $category->slug }}" class="img-show-category"></td>
							<td>{{ $category->name }}</td>
							<td>
								@foreach($category->subCategories as $subCategory)
									<button class="btn btn-link">{{ $subCategory->name }}</button>
									{!! link_to_action('SubCategoriesController@edit', "",[$category->id,$subCategory->id], ['class' =>'glyphicon glyphicon-pencil']) !!}
									{!! Form::open(['action' => ['SubCategoriesController@destroy',$category->id,$category->id],'method'=>'DELETE','style'=>'display: inline;','class'=>'destroy']) !!}
										<button class="btn btn-link glyphicon glyphicon-trash" style="transform: none;"></button>
									{!! Form::close() !!}
									<hr>
								@endforeach
								{!! link_to_action('SubCategoriesController@create', 'Nueva Sub Categoría', [$category->id], []) !!}
							</td>
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
@push('scripts')
<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

</script>
@endpush