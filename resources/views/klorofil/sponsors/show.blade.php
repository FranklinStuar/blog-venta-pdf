@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Publicidad: {{ $sponsor->name }}</h3>
		
  {{-- 'name','','web','finish','user_id','image','phone','address','url_facebook','url_twitter','url_instagram','url_youtube','status', --}}
			<div class="row">
				<div class="col-sm-5">
					<div class="panel panel-primary">
						<div class="panel-heading">Detalles</div>
						<div class="panel-body">
							<dl class="dl-horizontal">
								<dt>Título</dt>
								<dd>{{ $sponsor->name }}</dd>
								<hr>
								
								<dt>Descripción</dt>
								<dd>{{ $sponsor->excerpt }}</dd>
								<hr>

								<dt>Propietario</dt>
								<dd>{{ $sponsor->user->name }}</dd>
								<hr>

								<dt>Sitio Web</dt>
								<dd><a href="http://{{ $sponsor->web }}">{{ $sponsor->web }}</a></dd>
								<hr>

								<dt>Teléfono</dt>
								<dd>{{ $sponsor->phone }}</dd>
								<hr>

								<dt>Dirección</dt>
								<dd>{{ $sponsor->address }}</dd>
								<hr>

								<dt>Facebook</dt>
								<dd><a href="https://www.facebook.com/{{ $sponsor->url_facebook }}">https://www.facebook.com/{{ $sponsor->url_facebook }}</a></dd>
								<hr>

								<dt>Twitter</dt>
								<dd><a href="https://www.twitter.com/{{ $sponsor->url_twitter }}">https://www.twitter.com/{{ $sponsor->url_twitter }}</a></dd>
								<hr>

								<dt>Instagram</dt>
								<dd><a href="https://www.instagram.com/{{ $sponsor->url_instagram }}">https://www.instagram.com/{{ $sponsor->url_instagram }}</a></dd>
								<hr>

								<dt>Youtube</dt>
								<dd><a href="https://www.youtube.com/{{ $sponsor->url_youtube }}">https://www.youtube.com/{{ $sponsor->url_youtube }}</a></dd>

							</dl>
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
								<dd>{{ $sponsor->prints->count() }}</dd>
								<hr>

							</dl>
						</div>
					</div>
				</div>
				
				<div class="col-sm-7">
					<div class="panel panel-primary">
						<div class="panel-heading">Pagos</div>
						<div class="panel-body">
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
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
			</div>
@endsection
