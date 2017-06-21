@extends('corporate.layout')

@section('title')
	Neurocodigo
@endsection


@section('container')
	<main>
		<!--Main layout-->
		<div class="container">
			
			@if($featured)
				<!--First row-->
				<div class="row wow fadeIn" data-wow-delay="0.2s">
					<div class="col-lg-7">
						<!--Featured image -->
						<div class="view overlay hm-white-light z-depth-1-half">
								<img src="{{ url('/storage/'.$featured->image) }}" class="img-fluid " alt="{{ $featured->title }}">
							<div class="mask">
							</div>
						</div>
						<br>
					</div>

					<!--Main information-->
					<div class="col-lg-5">
						<h2 class="h2-responsive">{{ $featured->title }}</h2>
						<hr>
						<p>{{ $featured->excerpt }}</p>
						<a href="{{ route('show-post',['PN'=> $featured->slug]) }}" class="btn btn-info">Leer Más</a>
					</div>
				</div>
				<!--/.First row-->
			<hr class="extra-margins">
			@endif

			@include('corporate.sponsors.print')
			
			<!--Second row-->
			<div class="row">
				@foreach($posts as $post)
					<!-- Columnn-->
					<div class="col-lg-4">
						<!--Card-->
						<div class="card wow fadeIn" data-wow-delay="0.4s">

							<!--Card image-->
							<div class="view overlay hm-white-slight">
								<img src="{{ url('/storage/'.$post->image) }}" class="img-fluid" alt="{{ $post->title }}">
								<a href="#">
									<div class="mask"></div>
								</a>
							</div>
							<!--/.Card image-->

							<!--Card content-->
							<div class="card-block">
								<!--Title-->
								<h4 class="card-title">{{ $post->title }}</h4>
								<!--Text-->
								<p class="card-text">{{ $post->excerpt }}</p>
								<a href="{{ route('show-post',['PN'=> $post->slug]) }}" class="btn btn-info">Leer más</a>
							</div>
							<!--/.Card content-->

						</div>
						<!--/.Card-->
					</div>
					<!-- /.Columnn-->
				@endforeach

			</div>
			<!--/.Second row-->	

		</div>
		<!--/.Main layout-->
	</main>


@endsection

