@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Posts</h3>
	<div class="panel">
		<div class="panel-body">
			<div class="col-sm-4">
				@if (Shinobi::can('post.new'))
					<a href="{{ route('posts.create') }}" class="btn btn-primary">Nuevo Post <span class="lnr lnr-plus-circle"></span></a>
				@endif
			</div>
		</div>
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Fecha</th>
						<th>Título</th>
						<th>Descrpción</th>
						<th>Categoría</th>
						{{-- <th>Kits Premium</th> --}}
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($posts as $post)
						<tr>
							<td>{{ $post->created_at->diffForHumans() }}</td>
							{{-- <td>{{ \Carbon\Carbon::createFromFormat(' F j\\, Y',explode(':',$post->created_at)[0]) }}</td> --}}
							<td>{{ $post->title }}</td>
							<td>{{ str_limit($post->excerpt,70) }}</td>
							<td>{{ $post->category->name }}</td>
							{{-- <td> --}}
								{{-- <a href="{{ route('posts.view-kit',[$post->id]) }}"> {{count($post->kits)}} Kits </a> --}}
							{{-- </td> --}}
							<td>
								@if (Shinobi::can('post.edit'))
									{!! link_to_route('posts.edit', "",['i'=>$post->id], ['class' =>'glyphicon glyphicon-pencil']) !!}
								@endif
								@if (Shinobi::can('post.show'))
									{!! link_to_route('posts.show', "",['i'=>$post->id], ['class' =>'glyphicon glyphicon-open-eye']) !!}
								@endif
								@if (Shinobi::can('post.destroy'))
									{!! Form::open(['route' => ['posts.destroy',$post->id],'method'=>'DELETE','class'=>'destroy']) !!}
										<button class="btn btn-link glyphicon glyphicon-trash"></button>
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
