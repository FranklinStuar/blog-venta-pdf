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

			<div class="col-sm-3"></div>
			<div class="col-sm-6	">
				<?php
					echo $post->body;
				?>
				<div>
					<hr>
					@if(Shinobi::can('post.pdf.show'))
						<a href="{{ route('show-pdf',['pID'=>$post->slug]) }}">
							<img src="{{ url('images/pdf.png') }}" style='max-with:100%; max-height: 100px; display: block; margin: auto; cursor: pointer;' alt="pdf">
						</a>
					@else
						<center><b>No tiene acceso al archivo adjunto</b></center>
					@endif
				</div>
			</div>
		</div>
		<hr>
	</div>
	<!--/.Main layout-->
@endsection