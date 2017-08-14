@extends('flat.posts.template')
@section('breadcrumb')
    <li class="active">{{ $name }}</li>
@endsection
@section('title')
	{{ $name }}
@endsection
@section('content-post')
	<div class="blog">
        @foreach($posts as $post)
            <div class="blog-item">
                <img class="img-responsive img-blog" src="{{ url('storage/'.$post->image) }}" width="100%" alt="" />
                <div class="blog-content">
                    <a href="{{ route('show-post',[$post->category->slug,$post->slug]) }}"><h3>{{ $post->title }}</h3></a>
                    <div class="entry-meta">
		                <span><i class="icon-user"></i> <a href="{{ route('show-author',[$post->author->username]) }}">{{ $post->author->name }}</a></span>
		                <span><i class="icon-folder-close"></i> <a href="{{ route('show-service',[$post->category->slug]) }}">{{ $post->category->name }}</a></span>
		                <span><i class="icon-calendar"></i> {{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <p>{{ $post->excerpt }}</p>
                    <a class="btn btn-default" href="{{ route('show-post',[$post->category->slug,$post->slug]) }}">Leer más <i class="icon-angle-right"></i></a>
                </div>
            </div><!--/.blog-item-->
        @endforeach
		{{ $posts->links() }}
        
    </div>
@endsection