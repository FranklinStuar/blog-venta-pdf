<section id="portfolio" class="container">
	<li><a class="btn btn-default active" href="#" data-filter="*">Volver a {{ $category->name }}</a></li>
	@if(isset($subCategories))
		<ul class="portfolio-filter">
			@foreach($subCategories as $subCategory)
				<li><a class="btn btn-default" href="#" data-filter=".{{ $subCategory->slug }}">{{ $subCategory->name }}</a></li>
			@endforeach
		</ul><!--/#portfolio-filter-->
	@endif
	
	
	<ul class="portfolio-items col-3">
		@foreach($posts as $post)

			<li class="portfolio-item
				@foreach($post->subCategories as $subCategory)
					{{ $subCategory->slug }} 
				@endforeach
			">
				<div class="item-inner">
					<img src="{{ url('storage/'.$post->image) }}" alt="">
					<h5>{{ $post->title }}</h5>
					<div class="overlay">
						<a class="preview btn btn-danger" href="{{ route('show-post',[$post->category->slug,$post->slug]) }}"><i class="fa fa-eye"></i></a>              
					</div>           
				</div>           
			</li><!--/.portfolio-item-->
		@endforeach
	</ul>
	{{ $posts->links() }}
</section><!--/#portfolio-->
