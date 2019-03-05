

@extends('corporate.layout')

@section('title')
	Realizar pago - Sistema
@endsection

@section('style')
	<link href="{{ url('plugins/cardjs/card-js.min.css') }}" rel="stylesheet">

  <style type="text/css">
    .my-custom-class {
      border: 1px dashed #f00 !important;
    }
  </style>

@endsection

@section('container')
	<br>
	<br>
	<br>
	<br>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<img src="{{ url('images/credit-card.png') }}" alt="Credit Card image">
				{!! Form::open(['route' => ['post.make-payment-card','pstID'=>$post->id,'prID'=>$price->id],'autocomplete'=>"off" ]) !!}
				  <div class="card-js">
				    <input type="text" name="credit-card-number" class="card-number my-custom-class" value="{{ old('credit-card-number') }}" required>
				    <input type="text" name="expiry-month" class="expiry-month" value="{{ old('expiry-month') }}" required>
				    <input type="text" name="expiry-year" class="expiry-year" value="{{ old('expiry-year') }}" required>
				    <input type="text" name="credit-validation-code" class="cvc" value="{{ old('credit-validation-code') }}" required>
				  </div >
				  <br>
				  <center><button class="btn btn-primary">Realizar Pago</button></center>
				{!! Form::close() !!}
			</div>
			<div class="col-sm-9">
				<h3 class="text-center">Detalles del pedido</h3>

				<div class="title-detail">
					<span class="title">Libros de la publicación: </span>
					<span class="detail">
						<a href="{{ route('show-post',['pID'=>$post->slug]) }}">{{ $post->title }}</a>
					</span>
				</div>

				<div class="title-detail">
					<span class="title">Precio a cancelar:</span>
					<span class="detail">$ {{ $price->price }} por {{$price->timeView()}} </span>
				</div>

			</div>
		</div>
	</div>
<br>
<br>
<br>
<br>
<br>
@endsection

@section('script')
	<script type="text/javascript" src="{{ url('plugins/cardjs/card-js.min.js') }}"></script>
@endsection
