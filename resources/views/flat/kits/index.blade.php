@extends('flat.layout')

@section('title')
	Precios kits
@endsection


@section('container')
	
    <section id="pricing">
        <div class="container">
            <div class="center">
                <h2>Precios para kits</h2>
                <p class="lead">Obtenga nuestros kits listos para estudiar, trabajar y crear el futuro del mundo.</p>
            </div><!--/.center-->   
            <div class="gap"></div>
            <div id="pricing-table" class="row">
				@foreach($kits as $kit)
	                <div class="col-md-4 col-xs-6">
	                    <ul class="plan plan1 ">
	                        <li class="plan-name">
	                            <h3>
	                            	{{ $kit->name }}
							  		
	                            </h3>
	                        </li>
	                        <li class="plan-price">
	                            <div>
	                                <span class="price"><sup>$</sup>{{ $kit->price }}</span>
	                                <small>{{ $kit->time() }}</small>
	                            </div>
	                        </li>

					  		@foreach($kit->details as $detail)
		                        <li>
		                            <strong>{{ $detail->title }}</strong> {{ $detail->excerpt }}
		                        </li>
						  	@endforeach
							
							<li class="plan-action">
								Por el momento no se puede hacer pedido, en unos días tendremos todo listo, para más detalles enviénos un mensaje a <a href="{{ route('show-service',['contact']) }}">nuestro contacto</a> y le estaremos dando información
							</li>
	                        {{-- <li class="plan-action">
				  				<a href="#" class="btn btn-primary btn-xs">Ver publicaciones</a>
				  				<br><br><br>
				  				<a href="#" class="btn btn-primary ">Obtener acceso</a>
	                        </li> --}}
	                    </ul>
	                </div><!--/.col-md-4-->
                @endforeach
            </div> 
        </div>
    </section><!--/#pricing-->

@endsection

