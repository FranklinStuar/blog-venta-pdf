@extends('corporate.layout')

@section('title')
	{{ $search }} | Neurocodigo
@endsection


@section('container')
	<main>
		<!--Main layout-->
		<div class="container">

			<h1>Resultados de: {{ $search }}</h1>

			<hr class="extra-margins">

			<div class="row">
				@foreach($posts as $post)
				<div class="col-sm-10">
					<!-- Row-->
					<div class="row wow fadeIn" data-wow-delay="0.2s">
						<div class="col-lg-4">
							<!--post image -->
							<div class="view overlay hm-white-light z-depth-1-half">
									<img src="{{ url('/storage/'.$post->image) }}" class="img-fluid " alt="{{ $post->title }}">
								<div class="mask">
								</div>
							</div>
							<br>
						</div>

						<!--Main information-->
						<div class="col-lg-8">
							<h2 class="h2-responsive">{{ $post->title }}</h2>
							<hr>
							<p>{{ $post->excerpt }}</p>
							<a href="{{ route('show-post',['PN'=> $post->slug]) }}" class="btn btn-info">Leer Más</a>
						</div>
					</div>
					<!--/. Row-->
					<hr class="extra-margins">
				</div>
				@endforeach
			</div>


		</div>
		<!--/.Main layout-->
	</main>


@endsection

