@extends('corporate.layout')

@section('title')
	{{ $post->title }}
@endsection

@section('container')
	<img src="{{ url('/storage/'.$post->image) }}" class="img-fluid " alt="{{ $post->title }}">
	<br>
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
			<div class="col-sm-6	">
				<?php
					echo $post->body;
				?>
				<div>
					<hr>
					@if(Shinobi::can('post.pdf.show'))
						<a href="{{ route('show-pdf',['pID'=>$post->slug]) }}">
							<img src="{{ url('images/pdf.png') }}" class="img-pdf-show" alt="Libro">
						</a>
					@else
						<center><b>No tiene acceso al archivo adjunto</b></center>
					@endif
				</div>
			</div>
		</div>
	</div>
	<!--/.Main layout-->
@endsection