@extends('flat.posts.template')
@section('breadcrumb')
    <li class="active">{{ $name }}</li>
@endsection
@section('title')
	{{ $name }}
@endsection
@section('content-post')
	@include('flat.posts.list-posts')
@endsection