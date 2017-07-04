@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Posts del Rol: <a href="{{ route('roles.index') }}">{{ $role->name }}</a></h3>
	<div class="panel">
		
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Descripción</th>
					</tr>
				</thead>
				<tbody>
					@foreach($role->posts as $index => $post)
						<tr>
							<td>{{ $index+1 }}</td>
							<td>{{ $post->title }}</td>
							<td>{{ str_limit($post->excerpt,100) }}</td>
							
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection