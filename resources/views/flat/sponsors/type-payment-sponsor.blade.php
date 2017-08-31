@extends('flat.layout')

@section('title')
Pago Publicidad
@endsection

@section('container')
	<div class="container">
		
        <div class="gap"></div>
        <h1 class="center">Orden de pago</h1>
        <p class="lead center">Continue con el siguiente paso para culminar el pago.</p>
        <div class="gap"></div>
		<div class="row">
			<div class="col-sm-3">
				<img src="{{ url('/storage/'.$sponsor->image) }}" class="img-fluid " alt="{{ $sponsor->name }}">
			</div>
			<div class="col-sm-6">
				
				<dl class="dl-horizontal">
					<dt>Titulo</dt>
					<dd>{{ $sponsor->name }}</dd>
				</dl>
				
				<dl class="dl-horizontal">
					<dt>Descripción</dt>
					<dd>{{ $sponsor->excerpt }}</dd>
				</dl>
				
				<dl class="dl-horizontal">
					<dt>Sitio Web</dt>
					<dd>{{ $sponsor->web }}</dd>
				</dl>
				
				<dl class="dl-horizontal">
					<dt>Dirección</dt>
					<dd>{{ $sponsor->direccion }}</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Teléfono</dt>
					<dd>{{ $sponsor->phone }}</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Facebok</dt>
					<dd>http://www.facebook.com/<u>{{ $sponsor->url_facebook }}</u></dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Twitter</dt>
					<dd>http://www.twitter.com/<u>{{ $sponsor->url_twitter }}</u></dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Instagram</dt>
					<dd>http://www.instagram.com/<u>{{ $sponsor->url_instagram }}</u></dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Youtube</dt>
					<dd>http://www.youtube.com/<u>{{ $sponsor->url_youtube }}</u></dd>
				</dl>

			</div>

			<div class="col-sm-3">
				
				<div id="pricing-table" >
                    <ul class="plan plan1 @if($sponsor_premium->featured) featured @endif ">
                        <li class="plan-name">
                            <h3>
                            	<b>{{ $sponsor_premium->prints }}</b> impresiones 
						  		
                            </h3>
                        </li>
                        <li class="plan-price">
                            <div>
                                <span class="price"><sup>$</sup>{{ $sponsor_premium->price_month }}</span>
                                <small>{{ $sponsor_premium->months }} @if($sponsor_premium->months == 1) Mes @else Meses @endif</small>
                            </div>
                        </li>

				  		@foreach($sponsor_premium->details as $detail)
	                        <li>
	                            <strong>{{ $detail->title }}</strong> {{ $detail->excerpt }}
	                        </li>
					  	@endforeach

                        <li class="plan-action">
                            <a href="{{ route('sponsor.payment-card',['sprice'=>$sponsor_premium->id.'x'.$sponsor_premium->price_month,'sp'=>$sponsor->id]) }}" class="btn btn-primary btn-md">
								<i class="fa fa-credit-card" aria-hidden="true"></i> 
								<span>Tarjeta</span>
							</a>
							
                            <a href="{{ route('sponsor.make-payment-paypal',[$sponsor_premium->id,$sponsor->id]) }}" class="btn btn-primary btn-md">
								<i class="fa fa-paypal" aria-hidden="true"></i> 
								<span>Paypal</span>
							</a>

                        </li>
                    </ul>
                </div><!--/.pricing-table-->
			</div>
		</div>
	</div>

@endsection
