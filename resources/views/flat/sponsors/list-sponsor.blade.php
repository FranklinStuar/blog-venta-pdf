@extends('flat.layout')

@section('title')
	Precios publicidad
@endsection


@section('container')
	
    <section id="pricing">
        <div class="container">
            <div class="center">
                <h2>Precios para publicidad</h2>
                <p class="lead">Sea parte de la comunidad de sistema y obtenga grandes beneficios para su empresa mediante la mejor promoción que le brinda sistema</p>
            </div><!--/.center-->   
            <div class="gap"></div>
            <div id="pricing-table" class="row">
				@foreach($premiums as $premium)
	                <div class="col-md-4 col-xs-6">
	                    <ul class="plan plan1 @if($premium->featured) featured @endif ">
	                        <li class="plan-name">
	                            <h3>
	                            	<b>{{ $premium->prints }}</b> impresiones 
							  		
	                            </h3>
	                        </li>
	                        <li class="plan-price">
	                            <div>
	                                <span class="price"><sup>$</sup>{{ $premium->price_month }}</span>
	                                <small>{{ $premium->months }} @if($premium->months == 1) Mes @else Meses @endif</small>
	                            </div>
	                        </li>

					  		@foreach($premium->details as $detail)
		                        <li>
		                            <strong>{{ $detail->title }}</strong> {{ $detail->excerpt }}
		                        </li>
						  	@endforeach

	                        <li class="plan-action">
								@if(isset($sponsor))
					  				<a href="{{ route('sponsor.payment',['sprice'=>$premium->id.'x'.$premium->price_month,'sp'=>$sponsor->id]) }}" class="btn btn-primary btn-md">Obtener</a>
								@else
					  				<a href="{{ route('sponsor.create',['sprice'=>$premium->id.'x'.$premium->price_month]) }}" class="btn btn-primary btn-md">Obtener</a>
					  			@endif
	                        </li>
	                    </ul>
	                </div><!--/.col-md-4-->
                @endforeach
            </div> 
        </div>
    </section><!--/#pricing-->

@endsection

