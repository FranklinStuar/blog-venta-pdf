@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Editar Precio para Sponsor</h3>
			@include('klorofil.premium-sponsor.form',['edit'=>true,'url' => route('premium-sponsor.update',['i'=>$premium->id]),'method' =>"PUT"])
@endsection