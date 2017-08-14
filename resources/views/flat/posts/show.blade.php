@extends('flat.posts.template')
@section('breadcrumb')
	<li><a href="{{ route('show-service',[$post->category->slug]) }}">{{ $post->category->name }}</a></li>
	<li class="active">Publicación</li>
@endsection

@section('title')
{{ $post->title }}
@endsection

@section('content-post')
	<div class="blog">
		<div class="blog-item">
			<img class="img-responsive img-blog" src="{{ url('storage/'.$post->image) }}" width="100%" alt="{{ $post->title }}" />
			<div class="blog-content">
				<h3>{{ $post->title }}</h3>
				<div class="entry-meta">
					<span><i class="icon-user"></i> <a href="{{ route('show-author',[$post->author->username]) }}">{{ $post->author->name }}</a></span>
					<span><i class="icon-folder-close"></i> <a href="{{ route('show-service',[$post->category->slug]) }}">{{ $post->category->name }}</a></span>
					<span><i class="icon-calendar"></i> {{ $post->created_at->diffForHumans() }}</span>
				</div>
				<p class="lead">{{ $post->excerpt }}</p>

				{!! $post->body !!}
				<hr>


	@if(count($post->pdfs) > 0)
		<div class="documents">
			@foreach($post->pdfs as $pdf)
				<div class="files-list">
					<div class="files-icon">
						<i class="fa pdf fa-file-pdf-o" aria-hidden="true"></i>
					</div>
					<div class="files-body">
						<h4>{{ $pdf->name }}</h4>

						@if(Auth::user() != null && ((Auth::user() != null && Auth::user()->postStatus($post->id)) || count($post->oncePrices) == 0 ||Auth::user()->isRole('superadmin')||Auth::user()->isRole('admin')))
							<small><a href="{{ route('show-pdf',[$post->category->slug,$post->slug,str_slug($pdf->name,'-'),$pdf->id]) }}">Ver Documento</a></small>
						@else
							<small>No tiene acceso para visualizar</small>
						@endif
					</div>
				</div>
			@endforeach
		</div>
	@endif

	@if(count($post->zips) > 0)
		<div class="zip">
			@foreach($post->zips as $zip)
				<div class="files-list">
					<div class="files-icon">
						<i class="fa zip fa-file-archive-o" aria-hidden="true"></i>
					</div>
					<div class="files-body">
						@if(Auth::user() && (count($post->oncePrices) == 0 ||Auth::user()->isRole('superadmin')||Auth::user()->isRole('admin') || (Auth::user()->postStatus($post->id))))
							<small><a href="{{ route('download-zip',[$post->category->slug,$post->slug,$zip->id,'token'=>$token]) }}">Decargar Archivo</a></small>
						@else
							<small>No tiene acceso para descargar</small>
						@endif
					</div>
				</div>
			@endforeach
		</div>
	@endif
	@if(count($post->zips) > 0 || count($post->pdfs) > 0)
		@if(!Auth::user())
	    <div class="center">
	        <h2>Acceso Restringido</h2>
	        <p class="lead">No tiene acceso para visualizar los archivos y/o documentos</p>
	    </div><!--/.center-->   
	    <div class="gap"></div>
	  @elseif(Auth::user())
	    @if(!Auth::user()->postStatus($post->id) && !Auth::user()->isRole('superadmin') && !Auth::user()->isRole('admin'))
				<center><h4>Obten tu acceso</h4></center>
				<div id="pricing-table" class="row">
					@foreach($post->oncePrices as $price)
						<div class="col-md-4 col-xs-12">
							<ul class="plan plan1 ">
								
								<li class="plan-price">
									<div>
										<span class="price"><sup>$</sup>{{$price->price}}</span>
										<small>{{$price->timeView()}}</small>
									</div>
								</li>
								<li class="plan-action">
								<button class="btn btn-primary btn-md btn-sm show-card">Tarjeta</button>
									<a href="#" class="btn btn-primary btn-md btn-sm">Paypal 	</a>
								</li>
							</ul>
						</div><!--/.col-md-4-->
					@endforeach
				</div> 
			@endif
		@endif
	@endif
	
				<div class="tags">
					<i class="icon-tags"></i> Tags <a class="btn btn-xs btn-primary" href="#">CSS3</a> <a class="btn btn-xs btn-primary" href="#">HTML5</a> <a class="btn btn-xs btn-primary" href="#">WordPress</a> <a class="btn btn-xs btn-primary" href="#">Joomla</a>
				</div>

				<p>&nbsp;</p>

				<div class="author well">
					<div class="media">
						<div class="pull-left">
						<style>
							.avatar{
								width: 80px
							}
						</style>
							<img class="avatar img-thumbnail" src="{{ url('images/'.$post->author->avatar) }}" alt="{{ $post->author->name }}" >
						</div>
						<div class="media-body">
							<div class="media-heading">
								<strong>{{ $post->author->name }}</strong>
							</div>
							<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper.</p>
						</div>
					</div>
				</div><!--/.author-->

				<div id="comments">
					<div id="disqus_thread"></div>
					<script>

					/**
					*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
					*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
					/*
					var disqus_config = function () {
					this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
					this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
					};
					*/
					(function() { // DON'T EDIT BELOW THIS LINE
					var d = document, s = d.createElement('script');
					s.src = 'https://neurocodigo.disqus.com/embed.js';
					s.setAttribute('data-timestamp', +new Date());
					(d.head || d.body).appendChild(s);
					})();
					</script>
					<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
				</div><!--/#comments-->
			</div>
		</div><!--/.blog-item-->
	</div>


	<section class="credit-card-container">
		{{-- {!! Form::open(['route' => ['post.payment-card',$post->id,$price->id]]) !!} --}}
			<div class="credit-card-background"></div>
			<div class="theCard">
			  <figure class="theCardFront">
				<div class="instructionsCards">
					<div class="variousCards"> 
						
					</div>
				</div>
				
				<br class="clear" />
				<div class="cardNumber"><font color="#f7f8f6" size="-1">NUMERO DE TARJETA</font><br/>
					<input id="credit-card-number" class="firstfour" input placeholder="Ingrese el código de 16 dígitos" maxlength="16" />
					
				</div>
				<div class="credit-card-select cardExpiration"><font color="#f7f8f6" size="-1">EXPIRACION</font><br/>
					<select class="credit-card-select">
						<option value="volvo">Mes</option>
						<option value="saab">Enero</option>
						<option value="mercedes">Febrero</option>
						<option value="audi">Marzo</option>
						<option value="volvo">Abril</option>
						<option value="saab">Mayo</option>
						<option value="mercedes">Junio</option>
						<option value="audi">Julio</option>
						<option value="volvo">Agosti</option>
						<option value="saab">Septiembre</option>
						<option value="mercedes">Ocutubre</option>
						<option value="audi">Noviembre</option>
						<option value="volvo">Diciembre</option>
					  
					</select>
					<select  class="credit-card-select" name="select">
						<option value="volvo">Año</option>
						<option value="audi">2017</option>
						<option value="volvo">2018</option>
						<option value="saab">2019</option>
						<option value="mercedes">2020</option>
						<option value="mercedes">2021</option>
						<option value="mercedes">2022</option>
						<option value="mercedes">2023</option>
				  </select>
				  <span class="cardSecurity">
					  <input class="csc" placeholder="CVC" maxlength="3"/>
					</span>
				</div>
				<center>
					<button class="btn btn-sm btn-primary">Pagar</button>
					<button class="btn btn-sm btn-danger cancel" type="button">Cancelar</button>
				</center>
			</div>
	  {{-- {!! Form::close() !!} --}}
	</section>
	




@endsection
@push('scripts')
	<script type="text/javascript" src="{{ url('plugins/creditCardValidator/jquery.creditCardValidator.js') }}"></script>

<script>

	$('.credit-card-container .cancel').click(function(){
		$(".credit-card-container").css({display: 'none'});
	})
	$('.show-card').click(function(){
		$(".credit-card-container").css({display: 'block'});
	})
    $(function() {
        $('#credit-card-number').validateCreditCard(function(result) {
            $('.log').html('Card type: ' + (result.card_type == null ? '-' : result.card_type.name)
                     + '<br>Valid: ' + result.valid
                     + '<br>Length valid: ' + result.length_valid
                     + '<br>Luhn valid: ' + result.luhn_valid);
        });

    });
</script>

@endpush