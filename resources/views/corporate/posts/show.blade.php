@extends('corporate.layout')

@section('meta')
<meta name="description" content="{{ str_limit($post->meta_description,160) }}">
<meta name="keywords" content="{{ $post->meta_keywords }}">
<meta name="robots" content="Index,Follow">
<meta name="author" content="{{ $post->author->name }}">
<meta name="subjetc" content="{{ $post->seo_title }}">
<meta name="languaje" content="es">
<meta name="revisit-after" content="30">
<meta name="title" content="{{ $post->seo_title }}">

@endsection

@section('title')
	{{ $post->title }}
@endsection

@section('google-script')
	{!! $system->tag_script !!}
@endsection

@section('container')

	<div class="main-post">
		
		<div class="title-post">
			
			<h1>{{ $post->title }}</h1>
			<ul>
				<li>
					<a href="{{ route('show-user',['uID'=>$post->author->username]) }}">{{ $post->author->name }}</a>
				</li>
				<li>
					<a href="{{ route('show-category',['cID'=>$post->category->slug]) }}">{{ $post->category->name }}</a>
				</li>
				<li>
					{{ $post->created_at }}
				</li>
			</ul>
		</div>

		<!--Main layout-->
		<div class="container">
			<div class="row">
				<div class="col-sm-8 concept" >
					{!! $system->tag_body !!}
					<?php
						echo $post->body;
					?>
					<div class="comments-post">
						<h3>Comentarios</h3>
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
						                            
					</div>
				</div>

				<div class="col-sm-4">
					<div class="title-other-post">Publicaciones que pueden interesarte</div>
					@foreach($post->otherPosts() as $other_post)
						<div class="other-posts">
							<div class="img">
								<img src="{{ url('/storage/'.$other_post->image) }}" class="img-fluid " alt="{{ $other_post->title }}">
							</div>
							<div class="post-content">
								<a href="{{ route('show-post',['PN'=> $other_post->slug]) }}">
									{{ str_limit($other_post->title,30) }}
								</a>
								<p>{{ str_limit($other_post->excerpt,50) }}</p>
							</div>
						</div>
					@endforeach
					<hr>
					@include('corporate.sponsors.print',['print'=>'all'])
					
					@if(count($post->pdfs) > 0)
						<div class="container-img-pdf">
								@if(Auth::user() && Auth::user()->postStatus($post->id) /* && Shinobi::can('post.pdf.show')*/)
									<p>Acceda a los documentos y obtenga la mejor experiencia y el mejor conocimiento</p>
									@foreach($post->pdfs as $pdf)
										<ul>
											<li>
												<a href="{{ route('show-pdf',['pID'=>$pdf->id]) }}" class="link-pdf-show">
													<img src="{{ url('images/pdf.png') }}" class="img-pdf-show" alt="Libro">
													<span> {{ $pdf->name }} </span>
												</a>
											</li>
										</ul>
									@endforeach
								
								@else
									@if(count($post->oncePrices))
										<h3>Accesa a los archivos para tener una mejor experiencia en su aprendizaje</h3>
									@endif

									@foreach($post->oncePrices as $price)
										<ul >
											<li>
													$ {{$price->price}} -
													<span class="time-premium">Plan de {{$price->timeView()}}</span> 
												<a href="{{ route('post.payments',['pID'=>$post->id,'prID'=>$price->id]) }}" class="">
													Obtener acceso
												</a>
										  </div>
											</li>
										</ul>
									
									@endforeach
								@endif
								
						</div>
					@endif
				</div>
			</div>
		</div>
		<!--/.Main layout-->
	</div>
@endsection