{{-- <div class="list-categories">
	@foreach($categories as $category)
		{{ $category->name }}
	@endforeach
</div> --}}
<div class="sponsor-google-list">{!! $system->tag_body !!}</div>
<div class="list-post">
	@foreach($posts as $index =>$post)

		@if(($index==2 || ($index>9 && ($index+1) % 5 ==0)) && isset($sponsor_show))
			<div class="preview-post preview-sponsor">
				@include('corporate.sponsors.print')
			</div>
		@endif
		@if(($index+1) % 8 ==0)
			<div class="preview-post preview-sponsor">
				{!! $system->tag_body !!}
			</div>
		@endif
		<div class="preview-post">
			<a  href="{{ route('show-post',['PN'=> $post->slug]) }}" title="{{ $post->title }}">
				<div class="img-preview-post">
					<img src="{{ url('/storage/'.$post->image) }}" alt="{{ $post->title }}">
				</div>
				<div class="title-preview-post">
					<h2>{{ $post->title }}</h2>

				</div>
			</a>
		</div>

	@endforeach
	
</div>