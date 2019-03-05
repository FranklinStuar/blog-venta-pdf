@extends('corporate.layout')

@section('title')
	{{ Auth::user()->name }} - Sistema
@endsection


@section('container')
	<main>
		<!--Main layout-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<img src="{{ url('images/avatar.png') }}" alt="{{ Auth::user()->name }}" class="image-profile" >
				</div>
				<div class="col-sm-6 profile-information">
					@section('user')
					<h2>{{ Auth::user()->name }}</h2>
					
					<hr>

					<p>
						<a href="{{ route('profile.edit') }}" class="profile-detail"> 
							<b><i class="fa fa-envelope" aria-hidden="true"></i></b>
							<span>{{ Auth::user()->email }}</span>
							<i class="fa fa-pencil" aria-hidden="true"></i> 
						</a>
					</p>
					
					<p>
						<a href="{{ route('profile.edit') }}" class="profile-detail">
							<b><i class="fa fa-user" aria-hidden="true"></i></b>
							<span>{{ Auth::user()->username }}</span>
							<i class="fa fa-pencil" aria-hidden="true"></i> 
						</a>
					</p>

					<p>
						<a href="{{ route('profile.edit') }}" class="profile-detail"> 
							@if(Auth::user()->gender == "men")
								<b><i class="fa fa-male" aria-hidden="true"></i></b>
								<span>Hombre</span>
							@elseif(Auth::user()->gender == "women")
								<b><i class="fa fa-female" aria-hidden="true"></i></b>
								<span>Mujer</span>
							@else
								<b>
									<i class="fa fa-male" aria-hidden="true"></i>
									<i class="fa fa-female" aria-hidden="true"></i>
								</b>
								<span>Especificar</span>
							@endif
							<i class="fa fa-pencil" aria-hidden="true"></i> 
						</a>
					</p>

					@show
					
				</div>
			</div>
			
			<hr>

			<div class="row ">
				<div class="col-sm-6">
					<div class="panel panel-information">
					  <div class="panel-heading">Pagos activos</div>
					  <div class="panel-body">
					    
							@if(count(Auth::user()->postOncePays->where('status','active')) > 0)
								<ul>
									<li>
										@foreach(Auth::user()->postOncePays->where('status','active') as $once_pay)
											<a href="" data-toggle="modal" data-target="#myModal{{$once_pay->post->id}}">
												{{ $once_pay->post->title }}
											</a>
											<div class="modal fade" id="myModal{{$once_pay->post->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											  <div class="modal-dialog modal-lg" role="document">
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Detalles de la compra</h4>
												  </div>
												  <div class="modal-body">
													<table class="table">
														<thead>
															<tr>
																<th>Publicación</th>
																<th>Realizado</th>
																<th>Finaliza</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>{{ $once_pay->post->title }}</td>
																<td>{{ $once_pay->created_at }}</td>
																<td>{{ $once_pay->finish }}</td>
															</tr>
														</tbody>
													</table>
												  </div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
													{{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
												  </div>
												</div>
											  </div>
											</div>
										@endforeach
									</li>
								</ul>
							@else
								<p>
									Actualmente no tiene archivos o documentos comprados
								</p>
								<p>
									Realice la compra de documentos o archivos a su elección y disfrute todos los beneficios que le ofrecemos en Sistema
								</p>
							@endif
							<small>
								El estado de la cuenta le indica si ha comprado el acceso a los documentos o archivos de las publicaciones. Los pagos son únicos y no se vuelven a cobrar como una suscripción. Si la fecha de compra ha expirado tendrá que comprar nuevamente.
							</small>
					  </div>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="panel panel-information">
					  <div class="panel-heading">
					  	<span>Lista de publicidades</span>
							<a href="{{ route('sponsor.list') }}"> 
								<i class="fa fa-plus" aria-hidden="true"></i>
								Nuevo
							</a>
				  	</div>
					  <div class="panel-body">
							@if(Auth::user()->sponsors->count() >0)
								@foreach(Auth::user()->sponsors as $sponsor)
									<div class="sponsor-list">
										<a href="{{ route('sponsor.show-user',['sponsor'=>$sponsor->id]) }}">
											<b>{{ $sponsor->name }}</b>
											@if($sponsor->status())
												<span class="badge badge-info">Activo</span>
											@else
												<span class="badge badge-danger">Inactivo</span>
											@endif
										</a>
									</div>
									<hr>
								@endforeach
							@else
								<p>No ha realizado ninguna publicidad</p>
							@endif
					  </div>
					</div>
						

				</div>
			</div>
		</div>
		<!--/.Main layout-->
	</main>


@endsection

