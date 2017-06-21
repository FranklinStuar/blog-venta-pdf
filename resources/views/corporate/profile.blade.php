@extends('corporate.layout')

@section('title')
	{{ Auth::user()->name }} - Neurocodigo
@endsection


@section('container')
	<main>
		<!--Main layout-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<img src="{{ url('images/avatar.png') }}" alt="{{ Auth::user()->name }}" style="max-width: 200px; border-radius: 50%;">
				</div>
				<div class="col-sm-6">
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

					<p>
						<a href="{{ route('profile.edit') }}" class="profile-detail"> 
							@if(Auth::user()->date_birth != null)
								<b><i class="fa fa-calendar" aria-hidden="true"></i></b>
								<span>{{ Auth::user()->date_birth }}</span>
							@else
								<b><i class="fa fa-calendar" aria-hidden="true"></i> </b>
								<span>Fije su fecha de nacimiento</span>
							@endif
							<i class="fa fa-pencil" aria-hidden="true"></i> 
						</a>
					</p>
					@show
					
				</div>
			</div>
			
			<hr>

			<div class="row">
				<div class="col-sm-6">
					<center><h3>Estado de cuenta</h3></center>
					<p>
						Actualmente no tiene cuenta para disfrutar todos los beneficios que se le ofrece la página de Neurocodigo
					</p>
					<p>
						Obtenga su cuenta y disfrute todos los beneficios que le ofrecemos en Neurocodigo
					</p>
				</div>

				<div class="col-sm-6">
					<center>
						<h3>Publicidades</h3>
						@if(Shinobi::can('sponsor.add'))
							<a href="{{ route('sponsor.list') }}" class="btn btn-info">Realizar publicidad</a>
						@else
							<p>No puede agregar publicidad, mejore su cuenta y disfrute de todos los beneficios que ofrece Neurocodigo</p>
						@endif
					</center>
						
						<hr>
						
						@if(Auth::user()->sponsors->count() >0)
							@if(Shinobi::can('sponsor.show.own'))
								@foreach(Auth::user()->sponsors as $sponsor)
									<div >
										<a href="{{ route('sponsor.show-user',['sponsor'=>$sponsor->id]) }}">
										@if($sponsor->status())
											<span class="badge badge-info">Activo</span>
										@else
											<span class="badge badge-danger">Inactivo</span>
										@endif
											<b>{{ $sponsor->name }}</b>
										</a>
									</div>
									<hr>
								@endforeach
							@else
								<p>No puede visualizar su publicidad, mejore su cuenta y disfrute de todos los beneficios que ofrece Neurocodigo</p>
							@endif
						@else
							<p>No ha realizado ninguna publicidad</p>
						@endif

				</div>
			</div>
		</div>
		<!--/.Main layout-->
	</main>


@endsection

