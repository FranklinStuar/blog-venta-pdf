@extends('flat.posts.template')
@section('breadcrumb')
    <li class="active">Pagar con tarjeta</li>
@endsection
@section('title')
	Pagar con tarjeta
@endsection
@section('content-post')
<style>
.stripe-button{
	width: 70px;
	background: #eee;
}
</style>
    <section class="only-post-payment-card">
    	<div class="row">
    		<div class="col-sm-11 col-sm-offset-1">
    			<h3>Pagar con tarjeta de débito o crédito</h3>
    			<p>En Neurocodigo le permitimos hacer sus pagos con tarjeta de crédito o débito a través de la plataforma <a href="http://www.stripe.com">Stripe</a> siendo la plataforma más segura para realizar sus pagos.</p>
    			<p><b>Requerde:</b></p>
    			<p>Neurocodigo no guarda información de su tarjeta permitiendo proteger su información al respecto.</p>
    			<p>Si desea saber más acerca de Stripe y como aseguramos su información visite nuestras <b><a href="#"> preguntas frecuentes</a></b> con envíenos un mensaje en <b><a href="#">nuestro contacto</a></b> y con gusto le atenderemos.</p>
				{!! Form::open(['route' => ['post.payment-card',$post_slug,'pp'=>$price->id.'.'.str_random(16)], 'autocomplete'=>"off"]) !!}
					<script
					src="https://checkout.stripe.com/checkout.js" class="stripe-button"
					data-key="pk_test_Xd2SuziRV4jSvH72of9UYKvP"
					data-name="Neurocodigo"
					data-locale="auto"
					data-email="{{ Auth::user()->email }}"
					data-amount="{{ $price->price*100 }}"
					{{-- data-image="https://stripe.com/img/documentation/checkout/marketplace.png" --}}
					>
					</script>
				{!! Form::close() !!}
				
    		</div>
    	</div>
    </section>
@endsection