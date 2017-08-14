@extends('flat.layout')

@section('title')
	Página no encontrada
@endsection

@section('container')

    <section id="error" class="container">
        <h1>404, Página no encontrada</h1>
        <p>La página que está buscando no existe o a ocurrido un error</p>
        <a class="btn btn-success" href="{{ url('/') }}">Volver a la página principal</a>
    </section><!--/#error-->

@endsection
