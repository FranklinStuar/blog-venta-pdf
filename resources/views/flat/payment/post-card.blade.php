@extends('flat.posts.template')
@section('breadcrumb')
    <li class="active">Pagar con tarjeta</li>
@endsection
@section('title')
	Pagar con tarjeta
@endsection
@section('content-post')
    <section class="only-post-payment-card">
    	<div class="row">
    		<div class="col-sm-11 col-sm-offset-1">
    			
				<section class="credit-card-container">
					{!! Form::open(['route' => ['post.payment-card',$post_slug,'pp'=>$price->id.'.'.str_random(16)], 'autocomplete'=>"off"]) !!}
						<div class="credit-card-background"></div>
						<div class="theCard">
						  <figure class="theCardFront">
							<div class="instructionsCards">
								<div class="variousCards"> 
									
								</div>
							</div>
							
							<br class="clear" />
							<div class="cardNumber"><font color="#f7f8f6" size="-1">NUMERO DE TARJETA</font><br/>
								<input id="credit-card-number" required name="credit-card-number" class="firstfour" input placeholder="Ingrese el código de 16 dígitos" maxlength="16"/>
								
							</div>
							<div class="credit-card-select cardExpiration"><font color="#f7f8f6" size="-1">EXPIRACION</font><br/>
								<select class="credit-card-select" required name="mounth">
									<option hidden selected disabled>Mes</option>
									<option value="01">Enero</option>
									<option value="02">Febrero</option>
									<option value="03">Marzo</option>
									<option value="04">Abril</option>
									<option value="05">Mayo</option>
									<option value="06">Junio</option>
									<option value="07">Julio</option>
									<option value="08">Agosto</option>
									<option value="09">Septiembre</option>
									<option value="10">Ocutubre</option>
									<option value="11">Noviembre</option>
									<option value="12">Diciembre</option>
								  
								</select>
								<select  class="credit-card-select" name="year" required="">
									<option hidden selected disabled>Año</option>
									<option value="2017">2017</option>
									<option value="2018">2018</option>
									<option value="2019">2019</option>
									<option value="2020">2020</option>
									<option value="2021">2021</option>
									<option value="2022">2022</option>
									<option value="2023">2023</option>
							  </select>
							  <span class="cardSecurity">
								  <input class="csc" name="csc" placeholder="CSC" maxlength="3" required />
								</span>
							</div>
							<center>
								<button class="btn btn-primary">Pagar</button>
							</center>
						</div>
				  {!! Form::close() !!}
				</section>
    		</div>
    	</div>
    </section>
@endsection