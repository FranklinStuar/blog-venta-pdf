@extends('corporate.layout')

@section('title')
	{{ $sponsor->name }} - Neurocodigo
@endsection


@section('container')
	<main>
		<!--Main layout-->
		<div class="container">

			<center>
				<h1>{{ $sponsor->name }}</h1>
			</center>
			<hr class="extra-margins">


			<div class="row">
				<div class="col-md-5 white">
					
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
							@if(Shinobi::can('sponsor.edit'))
									<a href="{{ route('sponsor.edit-user',['sID'=>$sponsor->id]) }}" class="btn btn-primary">Editar</a>
							@endif
						</center>
					</div>
				</div>
				<div class="col-md-7 text-center white" >
					<h3>Historial de pagos</h3>
					<hr class="extra-margins">
					@if(Shinobi::can('sponsor.pay.list'))
						@if($sponsor->pays->count() > 0)
						<div class="table-responsive">
							<table class="table table-compact">
								<thead>
									<tr>
										<th>Precio</th>
										<th>Disponible</th>
										<th>Paga con</th>
										<th>Inicio</th>
										<th>Finaliza</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach($sponsor->pays as $pay)
										<tr>
											<td>{{ $pay->price_month }}</td>
											<td>{{ $pay->prints - $pay->print_count }} impresiones</td>
											<td>
												@if($pay->method_payment == 'card')
													Tarjeta
												@elseif($pay->method_payment == 'paypal')
													Paypal
												@endif
											</td>
											<td>{{ $pay->created_at }}</td>
											<td>{{ $pay->finish_date }}</td>
											<td>
												@if(Shinobi::can('sponsor.pay.cancel') && $pay->status == 'active')
													<a href="{{ route('sponsor.cancel-pay',['sID'=>$sponsor->id,'pID'=>$pay->id]) }}" class="btn btn-danger btn-sm">Cancelar</a>
												@endif
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@endif
					@else
							<p>No tiene acceso a visualizar su propia publicidad.</p>
							<p>Si cree que esto es un error contacte con nosotros en las opciones que se presentan en la parte baja de este sitio</p>
					@endif
						<hr class="extra-margins">
				
				
					@if(Shinobi::can('sponsor.pay.new'))
						@if(count($sponsor->payActive)>0)
							<hr class="extra-margins">
							Tiene pagos activos, no puede realizar otro pago a menos que cancele los pagos activos
						@else
							<h4>No tiene pagos activos</h4>
							<a href="{{ route('sponsor.list',['sp'=>$sponsor->id]) }}" class="btn btn-info">Realizar pago</a>
						@endif
					@else
						<p>No puede agregar publicidad a la página, si desea agregar publicidad cambie de plan y disfrute de este beneficio</p>
					@endif

				</div>
			</div>

		</div>
		<!--/.Main layout-->
	</main>


@endsection

