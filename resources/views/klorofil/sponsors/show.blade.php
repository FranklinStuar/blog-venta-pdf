@extends('klorofil.layout')
@section('content')
	<h3 class="page-title"><a href="{{ route('sponsors.index') }}">Publicidad: </a> {{ $sponsor->name }}</h3>
		
			<div class="row">
				<div class="col-sm-5">
					<div class="panel panel-primary">
						<div class="panel-heading">Detalles</div>
						<div class="panel-body">
							
							<div class="title-detail">
								<img src="{{ url('/storage/'.$sponsor->image) }}" class="image-fluid" alt="{{ $sponsor->excerpt }}">
							</div>

							<div class="title-detail">
								<span class="title">Título</span>
								<span class="detail">{{ $sponsor->name }}</span>
							</div>

							<div class="title-detail">
								<span class="title">Descripción</span>
								<span class="detail">{{ $sponsor->excerpt }}</span>
							</div>

							<div class="title-detail">
								<span class="title">Sitio Web</span>
								<span class="detail">
									<a href="http://{{ $sponsor->web }}">{{ $sponsor->web }}</a>
								</span>
							</div>

							<div class="title-detail">
								<span class="title">Teléfono</span>
								<span class="detail">{{ $sponsor->phone }}</span>
							</div>

							<div class="title-detail">
								<span class="title">Dirección</span>
								<span class="detail">{{ $sponsor->address }}</span>
							</div>

							<div class="title-detail">
								<span class="title">Facebook</span>
								<span class="detail">
									<a href="https://www.facebook.com/{{ $sponsor->url_facebook }}">
											https://www.facebook.com/{{ $sponsor->url_facebook }}
									</a>
								</span>
							</div>

							<div class="title-detail">
								<span class="title">Instagram</span>
								<span class="detail">
									<a href="https://www.instagram.com/{{ $sponsor->url_instagram }}">
											https://www.instagram.com/{{ $sponsor->url_instagram }}
									</a>
								</span>
							</div>

							<div class="title-detail">
								<span class="title">Twitter</span>
								<span class="detail">
									<a href="https://www.twitter.com/{{ $sponsor->url_twitter }}">
											https://www.twitter.com/{{ $sponsor->url_twitter }}
									</a>
								</span>
							</div>

							<div class="title-detail">
								<span class="title">Youtube</span>
								<span class="detail">
									<a href="https://www.youtube.com/{{ $sponsor->url_youtube }}">
											https://www.youtube.com/{{ $sponsor->url_youtube }}
									</a>
								</span>
							</div>

							<div class="container-fluid">
								<center>
									@if (Shinobi::can('sponsor.admin.edit'))
										{!! link_to_route('sponsors.edit', "Editar",['i'=>$sponsor->id], ['class' =>'btn btn-primary']) !!}
									@endif
								</center>
							</div>

						</div>
					</div>
				</div>

				<div class="col-sm-7">
					<div class="panel panel-primary">
						<div class="panel-heading">Información</div>
						<div class="panel-body">
							<dl class="dl-horizontal">
								<dt>Estado</dt>
								<dd>
									@if($sponsor->status())
										<span class="badge badge-info">Activo</span>
									@else
										<span class="badge badge-danger">Inactivo</span>
									@endif

								</dd>
								<hr>
								
								<dt>Impresiones</dt>
								<dd>{{ $sponsor->prints->count() }} - <a href="{{ route('sponsors.historial',[$sponsor->id]) }}">Ver historial</a></dd>

							</dl>
						</div>
					</div>
				</div>
				
				<div class="col-sm-7">
					<div class="panel panel-primary">
						<div class="panel-heading">Pagos</div>
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Fecha</th>
									<th>Precio</th>
									<th>Estado</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($sponsor->pays as $pay)
									<tr>
										<td>{{ $pay->created_at }}</td>
										<td>$ {{ $pay->price_month }}</td>
										<td>
											@if($pay->status == 'active')
												<span class="badge badge-info">Activo</span>
											@elseif($pay->status == 'finish')
												<span class="badge badge-danger">Finalizado</span>
											@elseif($pay->status == 'canceled')
												<span class="badge badge-danger">Cancelado</span>
											@else
												<span class="badge badge-danger">Sin estado</span>
											@endif
										</td>
										<td>
											@if (Shinobi::can('sponsor.pay.show'))
												{!! link_to_route('sponsor-pays.show', "",['pID'=>$pay->id], ['class' =>'glyphicon glyphicon-eye-open']) !!}
											@endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<div class="panel-body">
							@if (Shinobi::can('sponsor.pay.create'))
								<a href="{{ route('sponsor-pays.create',['sID'=>$sponsor->id,'uID'=>$sponsor->user->id]) }}">Nuevo pago</a>
							@endif
						</div>
					</div>
				</div>
				
			</div>
@endsection
