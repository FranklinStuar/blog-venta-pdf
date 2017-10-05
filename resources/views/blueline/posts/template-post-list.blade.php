<div class="portfolio-container" id="columns">
  <ul>
    @foreach($posts as $post)
      <li class="one-fourth web">
        <article>
          <p> <a title="{{ $post->title }}" href="{{ route('show-post',['PN'=> $post->slug]) }}" class="portfolio-item-preview" data-rel="prettyPhoto"><img src="{{ url('storage/'.$post->image) }}" alt="{{ url('storage/'.$post->title) }}" width="210" height="145" class="portfolio-img pretty-box"></a> </p>
          <h4><a href="{{ route('show-post',['PN'=> $post->slug]) }}">{{ $post->title }}</a></h4>
          <p> {{ $post->excrept }} </p>
        </article>
      </li>
    @endforeach
  </ul>
  <!--END ul-->
</div>
<!--END portfolio-wrap-->