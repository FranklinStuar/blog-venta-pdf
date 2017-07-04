@extends('klorofil.layout')

@section('meta')
	<meta name="csrf-token" id="token" content="{{ csrf_token() }}">
	<meta id="url" content="{{ route('premium-post.get-detail') }}">
@endsection

@section('content')
	<h3 class="page-title">Realizar pago</h3>
	<div id="post-pay-edit" class="panel">
		<div class="panel-body">
			@include('klorofil.pay-post.form',['url' => route('pay-post.update',['pID'=>$pay->id]),'method' =>"PUT",'edit'=>true])
		</div>
	</div>
@endsection

@section('script')
	  <script src="{{url('plugins/vuejs/axios.min.js')}}"></script>
		<script src="{{url('plugins/vuejs/vue@2.3.0.js')}}"></script>
@endsection