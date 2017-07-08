@extends('klorofil.layout')
@section('content')
	<h3 class="page-title"><a href="{{ route('posts.index') }}">Kits del post:</a> {{ $post->title }} </h3>
	<div class="panel">
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th></th>
						<th>Nombre</th>
						<th>Precio</th>
						<th>Tiempo de uso</th>
					</tr>
				</thead>
				<tbody>
					@foreach($post->kits as  $index => $premium)
						<tr>
							<td>{{ $index+1 }}</td>
							<td> {{ $premium->name }} </td>
							<td> $ {{ $premium->price }} </td>
							<td> {{ $premium->time() }} </td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection