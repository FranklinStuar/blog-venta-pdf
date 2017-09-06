@extends('flat.posts.template')
@section('breadcrumb')
    <li class="active">Preguntas frecuentes</li>
@endsection

@section('title')
Preguntas frecuentes
@endsection

@section('metas')
    <meta name="title" content="Preguntas frecuentes Neurocodigo">
    <meta name="description" content="Preguntas frecuentes Neurocodigo">
    <meta name="author" content="{{ url('/') }}">
    <meta name="owner" content="{{ $system->responsable }}">
    <meta name="subjetc" content="Preguntas frecuentes Neurocodigo">
    <meta name="languaje" content="es">
    <meta name="revisit-after" content="30">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="Preguntas frecuentes Neurocodigo">
    <meta name="twitter:description" content="{{ str_limit($system->description,160) }}">
    <meta name="twitter:creator" content="@author_handle">
    <!-- Twitter Summary card images. Igual o superar los 200x200px -->
    <meta name="twitter:image" content="{{ url('images/neurocodigo.png') }}">



    <meta property="og:url"         content="{{ route('show-service',['contacts']) }}" />
    <meta property="og:type"        content="website" />
    <meta property="og:title"       content="Preguntas frecuentes Neurocodigo" />
    <meta property="og:description" content="{{ str_limit($system->description,150) }}" />
    <meta property="og:image"       content="{{ url('images/neurocodigo.png') }}" />

    <meta name="DC.Creator" content="{{ $system->responsable }}" />
    <meta name="DC.Date" content="Agosto 1 2017" />
    <meta name="DC.Source" content="Neurocodigo" />
    <link rel="canonical" href="{{ route('show-service',['contacts']) }}" />
@endsection

@section('fb')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.10&appId=197798067417693";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
@endsection
@section('content-post')
    <section id="faqs" class="container">
        <ul class="faq unstyled">
        @foreach($faqs as $index => $faq)
            <li>
                <span class="number">{{ $index+1 }}</span>
                <div>
                    <h4>{{ $faq->question }}</h4>
                    <p>{{ $faq->answer }}</p>
                </div>
            </li>
        @endforeach
        </ul>
    </section><!--#faqs-->
@endsection
