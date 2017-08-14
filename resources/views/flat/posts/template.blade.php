@extends('flat.layout')
@section('container')

		<section id="title" class="emerald">
				<div class="container">
						<div class="row">
								<div class="col-sm-6">
										<h1>@yield('title')</h1>
										{{-- <p>Pellentesque habitant morbi tristique senectus et netus et malesuada</p> --}}
								</div>
								<div class="col-sm-6">
										<ul class="breadcrumb pull-right">
												<li><a href="{{ url('/') }}">Inicio</a></li>
												@yield('breadcrumb')
										</ul>
								</div>
						</div>
				</div>
		</section><!--/#title-->     

		<section id="blog" class="container">
				<div class="row">
						<aside class="col-sm-4 col-sm-push-8">
								<div class="widget search">
									{!! Form::open(['route' => 'search','method'=>'GET','class'=>"form-inline waves-effect waves-light"]) !!}
										<div class="input-group">
											<input type="text" name="search" class="form-control" autocomplete="off" placeholder="Buscar" @isset ($search) value="{{ $search }}" @endisset>
												<span class="input-group-btn">
													<button class="btn btn-danger" type="button"><i class="icon-search"></i></button>
												</span>
										</div>
									{!! Form::close() !!}
								</div><!--/.search-->
								@include('flat.sponsors.print',['section'=>'lateral','sponsor'=>$system->sponsorRandom()])
										<hr>
								
								@yield('files')
								<div class="widget google">
										{{-- codigo para google --}}                   
								</div><!--/.categories-->
								@yield('tags')
						</aside>        
						<div class="col-sm-8 col-sm-pull-4">
								@yield('content-post')
						</div><!--/.col-md-8-->
				</div><!--/.row-->
		</section><!--/#blog-->

@endsection