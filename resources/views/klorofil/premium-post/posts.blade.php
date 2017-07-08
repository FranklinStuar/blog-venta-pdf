@extends('klorofil.layout')
@section('content')
	<h3 class="page-title"><a href="{{ route('premium-post.index') }}">Posts del Kit: </a> {{ $kit->name }}</h3>
	<div class="panel">
		<div class="panel-body">
			{!! Form::open(['route' => ['premium-post.add-post',$kit->id],'class'=>'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-md-10">
						{!! Form::select('post_id', $posts, null, ['class'=>'select2 form-control','required']) !!}	
					</div>
					<div class="col-md-2">
						<button class="btn btn-primary">Agregar</button>
					</div>
				 </div>

			{!! Form::close() !!}		
		</div>
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Descripción</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($kit->posts as $index => $post)
						<tr>
							<td>{{ $index+1 }}</td>
							<td>{{ $post->title }}</td>
							<td>{{ str_limit($post->excerpt,100) }}</td>
							<td>
								{!! Form::open(['route' => ['premium-post.destroy-post',$kit->id,$post->id],'method'=>'DELETE','class'=>'destroy']) !!}
									<button class="btn btn-link glyphicon glyphicon-trash" style="transform: none;"></button>
								{!! Form::close() !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection