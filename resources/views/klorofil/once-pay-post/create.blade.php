@extends('klorofil.layout')

@section('meta')
	<meta name="csrf-token" id="token" content="{{ csrf_token() }}">
	<meta id="url" content="{{ route('posts.get-once-prices') }}">
	<meta id="url-pr" content="{{ route('posts.get-detail-once-prices') }}">
@endsection

@section('content')
	<h3 class="page-title">Realizar <a href="{{ route('only-pay-post.index') }}">pago individual</a></h3>
	<div id="only-post-pay-new" class="panel">
		<div class="panel-body">
			@include('klorofil.once-pay-post.form',['url' => route('only-pay-post.store'),'method' =>"POST",'edit'=>false])
		</div>
	</div>
@endsection

@section('script')
	<script src="{{url('plugins/vuejs/axios.min.js')}}"></script>
	<script src="{{url('plugins/vuejs/vue@2.3.0.js')}}"></script>
@endsection