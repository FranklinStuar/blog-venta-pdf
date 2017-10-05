@extends('flat.layout')
@section('title')
	{{ Auth::user()->name }}
@endsection
@section('container')

<style>
	.badge-info{
		background: #01579b
	}
	.badge-danger{
		background: #f44336
	}
</style>


	<section  class="container">
		
		<div id="meet-the-team" class="row">
			<div class="col-md-3">
				<div class="center">
					<p>
						@if(Auth::user()->avatar == 'avatar.png')
							<img class="img-responsive img-thumbnail img-circle" src="{{ url('images/'.Auth::user()->avatar) }}" width="150px" alt="{{ Auth::user()->name }}" >
						@else
							<img class="img-responsive img-thumbnail img-circle" src="{{ url('storage/'.Auth::user()->avatar) }}" width="150px" alt="{{ Auth::user()->name }}" >
						@endif
					</p>
					<h4>
						<small class="designation muted"><a href="{{ route('profile.edit') }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a></small>
						<hr>
						{{ Auth::user()->name }} <br>
						<span class="designation muted">{{ Auth::user()->username }}</span>
						<span class="designation muted">{{ Auth::user()->email }} </span>
					</h4>
					
				</div>
			</div>
			<div class="col-md-4">
				<div class="gap"></div>
				<div class="panel ">
					<div class="panel-body">
						<h2 class="center">Mi publicidad</h2>
						<a href="{{ route('sponsor.list') }}" class="pull-right"> 
							<i class="fa fa-plus" aria-hidden="true"></i>
							Nueva publicidad
						</a>
					</div>
					<div class="panel-body">
						
							@if(Auth::user()->sponsors->count() >0)
								@foreach(Auth::user()->sponsors as $sponsor)
									<hr>
									<div class="sponsor-list">
										<a href="{{ route('sponsor.show-user',['sponsor'=>$sponsor->id]) }}">
											<b>{{ $sponsor->name }}</b>
											@if($sponsor->status())
												<span class="badge badge-info pull-right">Activo</span>
											@else
												<span class="badge badge-danger pull-right">Inactivo</span>
											@endif
										</a>
									</div>
								@endforeach
							@else
									<hr>
								<p>No ha realizado ninguna publicidad</p>
							@endif
					</div>
				</div>
				
						





				<div class="gap"></div>
			</div>
		</div>


	</section><!--/#about-us-->

@endsection