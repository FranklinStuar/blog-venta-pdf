<h2>Servicios</h2>
<div class="row">
	
	<div class="col-md-1">
		<div class="btn-group">
			<a class="btn btn-danger btn-xs" href="#scroller" data-slide="prev"><i class="fa fa-angle-left"></i></a>
			<a class="btn btn-danger btn-xs" href="#scroller" data-slide="next"><i class="fa fa-angle-right"></i></a>
		</div>
	</div>
	<div class="col-md-11">
		<div id="scroller" class="carousel slide">
			<div class="carousel-inner">
				@foreach($categories as $index => $category)
					@if($index == 0 || ($index%4)==0)
						<div class="item @if($index == 0) active @endif">
							<div class="row">
					@endif
								<div class="col-xs-3">
									<div class="portfolio-item">
										<div class="item-inner">
											<img class="img-responsive" src="{{ url('storage/'.$category->image) }}" alt="">
											<h5>
												{{ $category->name }}
											</h5>
											<div class="overlay">
												<a class="preview btn btn-danger" title="{{ $category->excerpt }}" href="{{ route('show-service',[$category->slug]) }}"><i class="fa fa-eye"></i></a>
											</div>
										</div>
									</div>
								</div>   

					@if((($index+1)%4)==0)
							</div><!--/.row-->
						</div><!--/.item-->
					@endif
				@endforeach
			</div>
		</div>
	</div>
</div>
<section id="portfolio" class="container">
	<h2>Publicaciones</h2>
	<ul class="portfolio-items col-3">
		@foreach($posts as $post)

			<li class="portfolio-item">
				<div class="item-inner">
					<img src="{{ url('storage/'.$post->image) }}" alt="">
					<h5>{{ $post->title }}</h5>
					<h6><u>{{ $post->category->name }}</u></h6>
					<div class="overlay">
						<a class="preview btn btn-danger" href="{{ route('show-post',[$post->category->slug,$post->slug]) }}"><i class="fa fa-eye"></i></a>              
					</div>           
				</div>           
			</li><!--/.portfolio-item-->
		@endforeach
	</ul>
	{{ $posts->links() }}
</section><!--/#portfolio-->
