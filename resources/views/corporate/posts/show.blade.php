@extends('corporate.layout')

@section('title')
	{{ $post->title }}
@endsection

@section('container')
	
	<div  class="img-show-post">
		<img src="{{ url('/storage/'.$post->image) }}" alt="{{ $post->title }}">
		{{-- <img src="{{ url('images/Google-Material-Design-840x473.jpg') }}" alt=""> --}}
	</div>

	<center><h1>{{ $post->title }}</h1></center>

	<hr>

	<!--Main layout-->
	<div class="container-fluid">
		<div class="row">

			<div class="col-sm-3">

				<p>
					<b>Autor</b> : <a href="{{ route('show-user',['uID'=>$post->author->username]) }}">{{ $post->author->name }}</a>
				</p>
				<p>
					<b>Fecha</b> : {{ $post->created_at }}
				</p>
				<p>
					<b>Categoría</b> : <a href="{{ route('show-category',['cID'=>$post->category->slug]) }}">{{ $post->category->name }}</a>
				</p>
				<hr class="extra-margins">
				@include('corporate.sponsors.print',['print'=>'all'])
			</div>
			<div class="col-sm-6">
				<?php
					echo $post->body;
				?>
			</div>
		</div>

		<div class="container-img-pdf">
			<center>
				@if(Auth::user() && Auth::user()->postStatus($post->id) /* && Shinobi::can('post.pdf.show')*/)
					@foreach($post->pdfs as $pdf)
						<a href="{{ route('show-pdf',['pID'=>$pdf->id]) }}">
							<img src="{{ url('images/pdf.png') }}" class="img-pdf-show" alt="Libro">
						</a>
					@endforeach
				</center>
				@else
					@if(count($post->oncePrices))
						<h3>Accesa a los archivos para tener una mejor experiencia en su aprendizaje</h3>
					@endif

					@foreach($post->oncePrices as $price)
						<div class="list-group list-prices">
						  <div class="list-group-item item-time">
						  	Plan de {{$price->timeView()}}
					  	</div>
						  <div class="list-group-item item-price">
						  	$ {{$price->price}}
						  </div>
						  <div class="list-group-item item-link">
					  		<a href="{{ route('post.payments',['pID'=>$post->id,'prID'=>$price->id]) }}" class="btn btn-info">Obtener</a>
						  </div>
						</div>
					@endforeach
				@endif
			</center>
		</div>
	</div>
	<!--/.Main layout-->
@endsection