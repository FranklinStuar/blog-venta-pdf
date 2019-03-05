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
    			<p>En Sistema le permitimos hacer sus pagos con tarjeta de crédito o débito a través de la plataforma <a href="http://www.stripe.com">Stripe</a> siendo la plataforma más segura para realizar sus pagos.</p>
    			<p><b>Requerde:</b></p>
    			<p>Sistema no guarda información de su tarjeta permitiendo proteger su información al respecto.</p>
    			<p>Si desea saber más acerca de Stripe y como aseguramos su información visite nuestras <b><a href="#"> preguntas frecuentes</a></b> o envíenos un mensaje en <b><a href="#">nuestro contacto</a></b> y con gusto le atenderemos.</p>
				{!! Form::open(['route' => $url, 'autocomplete'=>"off"]) !!}
					<script
					src="https://checkout.stripe.com/checkout.js" class="stripe-button"
					data-key="{{ $system->pk_stripe }}"
					data-name="Sistema"
					data-locale="auto"
					data-email="{{ Auth::user()->email }}"
					data-amount="{{ $price }}"
					{{-- data-image="https://stripe.com/img/documentation/checkout/marketplace.png" --}}
					>
					</script>
				{!! Form::close() !!}
				
    		</div>
    	</div>
    </section>
@endsection