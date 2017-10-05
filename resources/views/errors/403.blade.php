@extends('flat.layout')

@section('title')
	Página no encontrada
@endsection

@section('container')

    <section id="error" class="container">
        <h1>Permiso denegado</h1>
        <p>No tiene acceso para ingresar a este sitio. <br> Si cree que es un error comuníquese con el administrador y con gusto le resolveremos sus dudas</p>
        <a class="btn btn-success" href="{{ url('/') }}">Volver a la página principal</a>
    </section><!--/#error-->

@endsection
