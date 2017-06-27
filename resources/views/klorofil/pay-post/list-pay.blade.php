@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Lista de pagos</h3>
	<div class="panel">
		<div class="panel-body">
			<div class="col-sm-4">
				<a href="{{ route('pay-post.create') }}" class="btn btn-primary">Nuevo Pago  <span class="lnr lnr-plus-circle"></span></a>
			</div>
		</div>
		<div class="panel-body table-responsive">
			<table class="table">
			{{-- <caption>'price', 'observations', 'user_id', 'role_id', 'post_price_id', 'method_payment', 'status', 'finish', 'created_at'</caption> --}}
				<thead>
					<tr>
						<th>#</th>
						<th>Usuario</th>
						<th>Premium</th>
						<th>Precio</th>
						<th>Rol</th>
						<th>Estado</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($pays as $index => $pay)
						<tr>
							<td>{{ $index + 1 }}</td>
							<td>{{ $pay->user->name }}</td>
							<td>{{ $pay->postPrice->name }}</td>
							<td>$ {{ $pay->price }}</td>
							<td>{{ $pay->role->name }}</td>
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
								@if (Shinobi::can('post.admin.pay.edit'))
									{!! link_to_route('pay-post.edit', "",['i'=>$pay->id], ['class' =>'glyphicon glyphicon-pencil']) !!}
								@endif
								@if (Shinobi::can('post.admin.pay.show'))
									{!! link_to_route('pay-post.show', "",['i'=>$pay->id], ['class' =>'glyphicon glyphicon-eye-open']) !!}
								@endif
								@if (Shinobi::can('post.admin.pay.cancel'))
									@if($pay->status == "active")
										{!! Form::open(['route' => ['pay-post.destroy',$pay->id],'method'=>'DELETE','class'=>'destroy']) !!}
											<button class="btn btn-link glyphicon glyphicon-remove"></button>
										{!! Form::close() !!}
									@endif
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
