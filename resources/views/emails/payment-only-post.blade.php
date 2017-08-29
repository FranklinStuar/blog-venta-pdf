@extends('emails.template')

@section('title')
    Respuesta a su mensaje <br>
@endsection

@section('content')
    <b>Felilcidades,</b>
    <p>Su compra de los documentos de la publicación <a href="{{ route('show-post',[$post->category->slug,$post->slug]) }}">{{ $post->title }}</a> están ahora accesibles para su uso.</p>
    <p>Puede ver la información de su compra y las demás publicaciones en su <a href="{{ route('profile') }}">perfil </a></p>
    <b>...</b>
    <br>
@endsection

