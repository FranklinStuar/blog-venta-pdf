@if(Shinobi::can('sponsor.quit.others') == false && isset($sponsor_show)) 

	<a href="#{{ str_slug($sponsor_show->name) }}" class="sponsor-show " data-toggle="modal" data-target="#sponsorModal">	
		<img src="{{ url('/storage/'.$sponsor_show->image) }}"  alt="{{ $sponsor_show->excerpt }}">
		<span class="title-sponsor">{{ $sponsor_show->name }}</span>
		{{-- <span class="description-sponsor">{{ $sponsor_show->excerpt }}</span> --}}
	</a>

<!-- Modal -->
<div class="modal fade" id="sponsorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document" aria-labelledby="myModalLabel">
			{{-- 
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button> 
			--}}
		<div class="modal-sponsor white">
			<div>
				<div class="title-sponsor">
					<span class="name">{{ $sponsor_show->name }}</span>
					@if($sponsor_show->excerpt)
						<span class="info space-sponsor"> - {{ $sponsor_show->excerpt }}</span>
					@endif
					@if($sponsor_show->address)
						<span class="info"><b>Dirección: </b>{{ $sponsor_show->address }}</span>
					@endif
					@if($sponsor_show->phone)
						<span class="info"><b>Teléfono: </b>{{ $sponsor_show->phone }}</span>
					@endif
				</div>
				<img src="{{ url('/storage/'.$sponsor_show->image) }}"  alt="{{ $sponsor_show->excerpt }}" class="img-sponsor">
				<div class="btn-social-sponsor-group" role="group" aria-label="...">
					@if($sponsor_show->web)
						<a href="http://{{ $sponsor_show->web }}"  target="_blank" class="btn-social-sponsor btn-web" title="{{ $sponsor_show->web }}">
							<i class="fa fa-globe" aria-hidden="true"></i>
						</a>
					@endif
					@if($sponsor_show->url_facebook)
						<a href="https://facebook.com/{{ $sponsor_show->url_facebook }}"  target="_blank" class="btn-social-sponsor btn-facebook" title="{{ $sponsor_show->url_facebook }}">
							<i class="fa fa-facebook" aria-hidden="true"></i>
						</a>
					@endif
					@if($sponsor_show->url_instagram)
						<a href="https://instagram.com/{{ $sponsor_show->url_instagram }}"  target="_blank" class="btn-social-sponsor btn-instagram" title="{{ $sponsor_show->url_instagram }}">
							<i class="fa fa-instagram" aria-hidden="true"></i>
						</a>
					@endif
					@if($sponsor_show->url_youtube)
						<a href="https://youtube.com/{{ $sponsor_show->url_instagram }}"  target="_blank" class="btn-social-sponsor btn-youtube" title="{{ $sponsor_show->url_youtube }}">
							<i class="fa fa-youtube" aria-hidden="true"></i>
						</a>
					@endif
					@if($sponsor_show->url_twitter)
						<a href="https://twitter.com/{{ $sponsor_show->url_twitter }}"  target="_blank" class="btn-social-sponsor btn-twitter" title="{{ $sponsor_show->url_twitter }}">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					@endif
				</div>
			</div>
		</div>
		 
	</div>
</div>
@endif