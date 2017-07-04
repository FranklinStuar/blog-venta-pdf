@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Nuevo Precio para Sponsor</h3>
			@include('klorofil.premium-sponsor.form',['edit'=>false,'url' => route('premium-sponsor.store'),'method' =>"POST"])
	
@endsection