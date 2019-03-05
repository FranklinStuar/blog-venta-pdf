@extends('emails.template')

@section('title')
    Pago por publicidad <br>
@endsection

@section('content')
    <b>Felilcidades, <b>{{ $sponsor->name }}</b> ha sido aceptada correctamente. Desde ahora su publicidad es pública dentro de sistema y puede revisar sus detalles en <a href="{{ route('profile') }}">su perfil</a></b>
    <b>...</b>
    <br>
@endsection

