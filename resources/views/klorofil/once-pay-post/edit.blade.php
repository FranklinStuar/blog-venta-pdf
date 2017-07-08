@extends('klorofil.layout')

@section('meta')
	<meta name="csrf-token" id="token" content="{{ csrf_token() }}">
	<meta id="url" content="{{ route('posts.get-once-prices') }}">
	<meta id="url-pr" content="{{ route('posts.get-detail-once-prices') }}">
	<meta id="url-py" content="{{ route('posts-once-pay.get',['pID'=>$pay->id]) }}">
	<meta id="p" content="{{ $pay->post_id}}">
	<meta id="pop" content="{{ $pay->post_once_price_id}}">
@endsection

@section('content')
	<h3 class="page-title">Realizar pago</h3>
	<div id="only-post-pay-edit" class="panel">
		<div class="panel-body">
			@include('klorofil.once-pay-post.form',['url' => route('only-pay-post.update',['pID'=>$pay->id]),'method' =>"PUT",'edit'=>true])
		</div>
	</div>
@endsection

@section('script')
	<script src="{{url('plugins/vuejs/axios.min.js')}}"></script>
	<script src="{{url('plugins/vuejs/vue@2.3.0.js')}}"></script>
@endsection