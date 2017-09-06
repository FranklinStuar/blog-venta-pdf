@extends('flat.posts.template')
@section('breadcrumb')
	<li class="active">Contáctanos</li>
@endsection

@section('title')
Contáctanos
@endsection

@section('metas')
	<meta name="title" content="Contactos Neurocodigo">
	<meta name="description" content="{{ str_limit($system->description,150) }}">
	<meta name="author" content="{{ url('/') }}">
	<meta name="owner" content="{{ $system->responsable }}">
	<meta name="subjetc" content="Contactos Neurocodigo">
	<meta name="languaje" content="es">
	<meta name="revisit-after" content="30">

	<!-- Twitter Card data -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@publisher_handle">
	<meta name="twitter:title" content="Contactos Neurocodigo">
	<meta name="twitter:description" content="{{ str_limit($system->description,160) }}">
	<meta name="twitter:creator" content="@author_handle">
	<!-- Twitter Summary card images. Igual o superar los 200x200px -->
	<meta name="twitter:image" content="{{ url('images/neurocodigo.png') }}">



	<meta property="og:url"        	content="{{ route('show-service',['contacts']) }}" />
	<meta property="og:type"       	content="website" />
	<meta property="og:title"      	content="Contactos Neurocodigo" />
	<meta property="og:description"	content="{{ str_limit($system->description,150) }}" />
	<meta property="og:image"      	content="{{ url('images/neurocodigo.png') }}" />

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
    <section id="contact-page" class="container">
            <div>
                <h4>Formulario de contacto</h4>
                <div class="status alert alert-success" style="display: none"></div>
                <form id="main-contact-form" class="contact" name="contact-form" method="post" action="{{ route('message-contact.save') }}" role="form">
                	{{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-5">
            				@if(Auth::user())
	                            <div class="form-group">
	                                <input name="name" type="text" class="form-control" required="required" autofocus placeholder="Nombre" value="{{ Auth::user()->name }}">
	                            </div>
	                            <div class="form-group">
	                                <input name="email" type="text" class="form-control" required="required" placeholder="Correo electrónico" value="{{ Auth::user()->email }}">
	                            </div>
		                    @else
	                            <div class="form-group">
	                                <input name="name" type="text" class="form-control" required="required" autofocus placeholder="Nombre">
	                            </div>
	                            <div class="form-group">
	                                <input name="email" type="text" class="form-control" required="required" placeholder="Correo electrónico">
	                            </div>
			                @endif
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg">Enviar Mensaje</button>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Mensaje"></textarea>
                        </div>
                    </div>
                </form>
            </div><!--/.col-sm-8-->
            <div>
                <h4>Nuestra localización</h4>
                {{-- <iframe width="100%" height="415" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.ec/maps?f=q&amp;source=s_q&amp;hl=es&amp;geocode=&amp;q=Dhaka,+Dhaka+Division,+Bangladesh&amp;aq=0&amp;oq=dhaka+ban&amp;sll=-2.9180607,-79.0023418&amp;sspn=-2.9180607,1.815491&amp;ie=UTF8&amp;hq=&amp;hnear=Dhaka+Division,+Bangladesh&amp;t=m&amp;ll=24.542126,90.293884&amp;spn=-2.9180607,-79.00234181&amp;z=8&amp;output=embed"></iframe> --}}
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d841.7640050840573!2d-79.01198109179384!3d-2.8919284396090554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91cd1805a4e1d80d%3A0xfb70794ed0bf63b9!2sMecatronica!5e1!3m2!1ses!2sec!4v1504710843071" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div><!--/.col-sm-4-->
    </section><!--/#contact-page-->
@endsection

