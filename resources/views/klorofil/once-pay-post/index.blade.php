@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Lista de pagos de publicaciones individuales</h3>
	<div class="panel">
		<div class="panel-body">
			<div class="col-sm-4">
					@if (Shinobi::can('post.admin.pay-once.new'))
						<a href="{{ route('only-pay-post.create') }}" class="btn btn-primary">Nuevo pago individual<span class="lnr lnr-plus-circle"></span></a>
					@endif

			</div>
		</div>
		{{-- 'user_id','post_id','finish','price','post_once_price_id', --}}
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Usuario</th>
						<th>Post</th>
						<th>Precio</th>
						<th>Estado</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($pays as $index => $pay)
						<tr>
							<td><a href="{{ route('users.show',[$pay->user->id]) }}">{{ $pay->user->name }}</a></td>
							<td>{{ $pay->post->title }}</td>
							<td>$ {{ $pay->price }}</td>
							<td>
								@if($pay->status == 'active')
									<span class="badge badge-info">Activo</span>
								@elseif($pay->status == 'cancel')
									<span class="badge badge-danger">Cancelado</span>
								@elseif($pay->status == 'finish')
									<span class="badge badge-danger">Finalizado</span>
								@endif
							</td>
							<td>
								@if (Shinobi::can('post.admin.pay-once.edit'))
									{!! link_to_route('only-pay-post.edit', "",['i'=>$pay->id], ['class' =>'glyphicon glyphicon-pencil']) !!}
								@endif
								@if (Shinobi::can('post.admin.pay-once.show'))
									{!! link_to_route('only-pay-post.show', "",['i'=>$pay->id], ['class' =>'glyphicon glyphicon-eye-open']) !!}
								@endif
								@if (Shinobi::can('post.admin.pay-once.cancel'))
									@if($pay->status == "active")
										{!! Form::open(['route' => ['only-pay-post.destroy',$pay->id],'method'=>'DELETE','class'=>'destroy']) !!}
											<button class="btn btn-link glyphicon glyphicon-remove"></button>
										{!! Form::close() !!}
									@endif
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{{ $pays->links() }}
		</div>
	</div>
@endsection
-