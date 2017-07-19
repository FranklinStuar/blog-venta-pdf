<div class="row">
	<div class="col-sm-10">
		<div class="list-post">
			@foreach($posts as $post)
				<div class="card wow fadeIn" data-wow-delay="0.2s">
					<div class="img view overlay hm-white-light z-depth-1-half">
						<img class="img-fluid" src="{{ url('/storage/'.$post->image) }}" alt="{{ $post->title }}">
						<a  href="{{ route('show-post',['PN'=> $post->slug]) }}" title="{{ $post->title }}">
							<div class="mask"></div>
						</a>
					</div>
					<div class="content-post">
						<a  href="{{ route('show-post',['PN'=> $post->slug]) }}" title="{{ $post->title }}">
							<h2 class="h2-responsive">{{ $post->title }}</h2>
						</a>
						<p>{{ str_limit($post->excerpt,150) }}</p>
						<ul>
							<li class="li-author">Publicado por: <a href="{{ route('show-user',[$post->author->username]) }}">{{ $post->author->name }}</a></li>
							<li class="li-date">Realizado: {{ $post->created_at->diffForHumans() }}</li>
						</ul>
					</div>
				</div>
			@endforeach
		</div>
	</div>
	<div class="col-md-2">
		{!! $system->tag_body !!}
		@include('corporate.sponsors.print')
	</div>

</div>