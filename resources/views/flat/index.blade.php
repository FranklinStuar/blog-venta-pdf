<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title','Inicio') - Neurocodigo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name='robots' content='noodp' />
    <meta name="googlebot" content="noodp">
    <meta name="”slurp”" content="noodp">
    <meta name="”msnbot”" content="noodp">
    <meta name="msapplication-tooltip" content="Tecnología y avances para su educación"/>
    <meta name="msapplication-starturl" content="{{ url('/') }}"/>
    <meta property="fb:pages" content="323152764504875" />
    <meta property="fb:api_id" content="197798067417693" />
    
	<meta name="title" content="Neurocodigo">
	<meta name="description" content="{{ $system->description }}">
	<meta name="news_keywords" content="{{ $system->keywords }}">
	<meta name="author" content="{{ url('/') }}">
	<meta name="owner" content="Neurocodigo">
	<meta name="subjetc" content="Neurocodigo">
	<meta name="languaje" content="es">
	<meta name="revisit-after" content="30">


	<!-- Twitter Card data -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@publisher_handle">
	<meta name="twitter:title" content="Neurocodigo">
	<meta name="twitter:description" content="{{ $system->description }}">
	<meta name="twitter:creator" content="@author_handle">
	<!-- Twitter Summary card images. Igual o superar los 200x200px -->
	<meta name="twitter:image" content="{{ url('image/neurocodigo.png') }}">



	<meta property="og:url"                content="{{ url('/') }}" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="Neurocodigo" />
	<meta property="og:description"        content="{{ $system->description }}" />
	<meta property="og:image"              content="{{ url('image/neurocodigo.png') }}" />
	<meta property="og:updated_time" content="{{ Carbon\Carbon::now() }}">

	<meta name="DC.Creator" content="Neurocodigo" />
	<meta name="DC.Date" content="{{ Carbon\Carbon::now() }}" />
	<meta name="DC.Source" content="Neurocodigo" />
	<link rel="canonical" href="{{ url('/') }}" />




    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ url('css/animate.css') }}" rel="stylesheet">
    <link href="{{ url('css/main.css') }}" rel="stylesheet">
    <link href="{{ url('css/style.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ url('js/html5shiv.js') }}"></script>
    <script src="{{ url('js/respond.min.js') }}"></script>
    <![endif]-->       
    
    <link rel="apple-touch-icon" sizes="64x64" href="{{ url('images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ url('images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ url('images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ url('images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ url('images/favicon.png') }}">
    {!! $system->tag_script !!}
    <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '197798067417693',
      xfbml      : true,
      version    : 'v2.10'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/es_ES/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
</head><!--/head-->
<body>
    <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                {{-- <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('images/neurocodigo.png') }}" alt="logo"></a> --}}
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    {{-- <li class="active"><a href="{{ url('/') }}">Inicio</a></li> --}}
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Servicios <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            @foreach($categories as $category)
                                <li><a href="{{ route('show-service',$category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ route('kits.list') }}">Precios</a></li>
                    <li><a href="{{ url('https://youtube.com/'.$system->youtube) }}">Youtube</a></li>
                    @if(Auth::user())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('profile') }}">Perfil</a></li>
                                @if(Auth::user()->isRole('superadmin') || Auth::user()->isRole('admin'))
                                    <li><a href="{{ route('admin') }}">Administrar</a></li>
                                @endif
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="lnr lnr-exit"></i> <span>Cerrar Sesion</span></a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                              {{ csrf_field() }}
                                          </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ url('login') }}">Iniciar Sesión</a></li>
                        <li><a href="{{ url('register') }}">Registrarse</a></li>
                    @endif
                    <li><a href="{{ route('show-service',['faq']) }}">FAQ</a></li>
                    <li><a href="{{ route('show-service',['contacts']) }}">Contactos</a></li>
                    <li>
                        <a class="facebook" href="https://www.facebook.com/{{ $system->facebook }}">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
    
                        <a class="instagram" href="https://www.instagram.com/{{ $system->instagram }}">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a class="youtube" href="https://www.youtube.com/{{ $system->youtube }}">
                            <i class="fa fa-youtube" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header><!--/header-->

    <main>


        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <i class="fa fa-times-circle"></i> {{ \Session::get('error') }}
            </div>
        @endif
        @if(\Session::has('errors'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                @foreach($errors as $error)
                    <i class="fa fa-times-circle"></i> {{ $error->message }}
                @endforeach
            </div>
        @endif
        
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <i class="fa fa-times-circle"></i> {{ \Session::get('success') }}
            </div>
        @endif


        <div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-sm-offset-1">
                	<a class="navbar-bran" href="{{ url('/') }}"><img src="{{ url('images/neurocodigo.png') }}" alt="logo"><h1>Neurocodigo</h1></a>
				</div>
				<div class="col-md-8">
					<section id="recent-works">
						<div class="container">
							<div class="row">
								
								<div class="col-md-9 scroller-slider ">
									<div id="scroller" class="carousel slide">
										<div class="carousel-inner">
											@foreach($categories as $index => $category)
												@if($index == 0 || ($index%6)==0)
													<div class="item @if($index == 0) active @endif">
														<div class="row">
												@endif
															<div class="col-md-2 col-sm-4 col-xs-4 item-access">
																<div class="portfolio-item">
																	<div class="item-inner">
																		<img class="img-responsive" src="{{ url('storage/'.$category->image) }}" alt="{{ $category->name }}">
																		<h5>
																			{{ $category->name }}
																		</h5>
																		<div class="overlay">
																			<a class="preview btn btn-danger" title="{{ $category->excerpt }}" href="{{ route('show-service',[$category->slug]) }}" title="{{ $category->name }}"><i class="fa fa-eye"></i></a>
																		</div>
																	</div>
																</div>
															</div>   

												@if((($index+1)%6)==0 || $index == count($categories)-1)
														</div><!--/.row-->
													</div><!--/.item-->
												@endif
											@endforeach
										</div>
									</div>
								</div>
								<div class="col-md-2 scroller-slider ">
									<div class="btn-group scroller-move">
										<a class="btn btn-danger btn-xs" href="#scroller" data-slide="prev"><i class="fa fa-angle-left"></i></a>
										<a class="btn btn-danger btn-xs" href="#scroller" data-slide="next"><i class="fa fa-angle-right"></i></a>
									</div>
								</div>
							</div><!--/.row-->
						</div>
					</section><!--/#recent-works-->
				</div>
				
			</div>

			<div class="space emerald"></div>
			<div class="row">
				<div class="col-md-8">
					<section id="main-slider" class="no-margin">
						<div class="carousel slide wet-asphalt">
							<ol class="carousel-indicators">
									<li data-target="#main-slider" data-slide-to="0" class="active"></li>
									<li data-target="#main-slider" data-slide-to="1"></li>
									<li data-target="#main-slider" data-slide-to="2"></li>
									<li data-target="#main-slider" data-slide-to="3"></li>
							</ol>
							<div class="carousel-inner">

								<div class="item active" style="background-image: url({{ url('images/slider/bg1.jpg') }})">
									<div class="container">
										<div class="row">
											<div class="col-sm-12">
												<div class="carousel-content centered">
													<h2 class="boxed animation animated-item-1">Capacitación gratuita</h2><br>
													<p class="boxed animation animated-item-2">Aprovecha nuestra capacitación gratuita llevando al máximo las redes sociales</p>
													<br>
													<a class="btn btn-md animation animated-item-3" href="{{ url('https://youtube.com/'.$system->youtube) }}">Ir a youtube</a>
												</div>
											</div>
										</div>
									</div>
								</div><!--/.item-->

								<div class="item" style="background-image: url({{ url('images/slider/bg3.jpeg') }})">
									<div class="container">
										<div class="row">
											<div class="col-sm-12">
												<div class="carousel-content center centered">
													<h2 class="boxed animation animated-item-1">Capacitación gratuita</h2><br>
													<p class="boxed animation animated-item-2">Aprovecha nuestra capacitación gratuita llevando al máximo las redes sociales</p>
												</div>
											</div>
										</div>
									</div>
								</div><!--/.item-->

								<div class="item" style="background-image: url({{ url('images/slider/bg2.jpeg') }})">
									<div class="container">
										<div class="row">
											<div class="col-sm-12">
												<div class="carousel-content centered">
													<h2 class="boxed animation animated-item-1">Capacitación gratuita</h2><br>
													<p class="boxed animation animated-item-2">Aprovecha nuestra capacitación gratuita llevando al máximo las redes sociales</p>
													<br>
													<a class="btn btn-md animation animated-item-3" href="{{ url('https://youtube.com/'.$system->youtube) }}">Ir a youtube</a>
												</div>
											</div>
										</div>
									</div>
								</div><!--/.item-->

								<div class="item" style="background-image: url({{ url('images/slider/bg4.jpeg') }})">
									<div class="container">
										<div class="row">
											<div class="col-sm-12">
												<div class="carousel-content centered">
													<h2 class="boxed animation animated-item-1">Capacitación gratuita</h2><br>
													<p class="boxed animation animated-item-2">Aprovecha nuestra capacitación gratuita llevando al máximo las redes sociales</p>
													<br>
													<a class="btn btn-md animation animated-item-3" href="{{ url('https://youtube.com/'.$system->youtube) }}">Ir a youtube</a>
												</div>
											</div>
										</div>
									</div>
								</div><!--/.item-->

							</div><!--/.carousel-inner-->
						</div><!--/.carousel-->
						<a class="prev hidden-xs" href="#main-slider" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a class="next hidden-xs" href="#main-slider" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</section><!--/#main-slider-->
				</div>
				<div class="col-md-4">
					<aside class="">
						<div class="widget search">
							{!! Form::open(['route' => 'search','method'=>'GET','class'=>"form-inline waves-effect waves-light"]) !!}
								<div class="input-group">
									<input type="text" name="search" class="form-control" autocomplete="off" placeholder="Buscar" @isset ($search) value="{{ $search }}" @endisset>
										<span class="input-group-btn">
											<button class="btn btn-danger" type="button"><i class="fa fa-search"></i></button>
										</span>
								</div>
							{!! Form::close() !!}
						</div><!--/.search-->
						@include('flat.sponsors.print',['section'=>'lateral','sponsor'=>$system->sponsorRandom()])
						
						@yield('widget-more-options')

						<hr>
						<div class="widget google">
							{!! $system->tag_body !!}                 
						</div><!--/.categories-->
						@yield('tags')
						<hr>
						<h4>Visitanos en Facebook</h4>
						<div class="fb-page" data-href="https://www.facebook.com/gomecatronica/"  data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/gomecatronica/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/gomecatronica/">Mecatronica</a></blockquote></div>
				</aside>        
				</div>
			</div>
		</div>


		<section id="services" class="emerald">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-6">
						<div class="media">
							<div class="pull-left">
								<i class="icon-md fa fa-clock-o"></i>
							</div>
							<div class="media-body">
								<h3 class="media-heading">Atención permanente</h3>
								<p>Cualquier duda puede contactar con Neurocodigo y con gusto será atendido y resolveremos sus inquietudes.</p>
							</div>
						</div>
					</div><!--/.col-md-4-->
					<div class="col-md-4 col-sm-6">
						<div class="media">
							<div class="pull-left">
								<i class="fa fa-user icon-md"></i>
							</div>
							<div class="media-body">
								<h3 class="media-heading">Asesoría Personalizada</h3>
								<p>Necesita apoyo para hacer crecer su idea o Negocio, Nosotros lo apoyaremos con consultores experimentados.</p>
							</div>
						</div>
					</div><!--/.col-md-4-->
					<div class="col-md-4 col-sm-6">
						<div class="media">
							<div class="pull-left">
								<i class="fa fa-youtube-play icon-md"></i>
							</div>
							<div class="media-body">
								<h3 class="media-heading">Capacitaciónes gratuitas</h3>
								<p>Revise nuestras redes sociales y aprenda sobre las diversas capacitaciones que le ofrecemos en diferentes ambitos Sin Costo</p>
							</div>
						</div>
					</div><!--/.col-md-4-->
				</div>
			</div>
		</section><!--/#services-->

		<section id="testimonial" class="alizarin">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="center">
							<h2>Última publicaciones</h2>
						</div>

						<div class="gap"></div>
						<div  class="carousel slide">
							<div class="carousel-inner">
								@foreach($posts as $index => $post)
									@if($index == 0 || ($index%6)==0)
										<div class="item @if($index == 0) active @endif">
											<div class="row">
												@endif
												<div class="col-md-2 col-sm-6">
													<div class="portfolio-item">
														<div class="item-inner">
															<img class="img-responsive" src="{{ url('storage/'.$post->image) }}" alt="">
															<h5>
																{{ $post->title }}
															</h5>
															<div class="overlay">
																<a class="preview btn btn-danger" title="{{ $post->title }}" href="{{ route('show-post',[$post->category->slug,$post->slug]) }}"><i class="fa fa-eye"></i></a>
															</div>
														</div>
													</div>
												</div>   

												@if((($index+1)%6)==0)
											</div><!--/.row-->
										</div><!--/.item-->
									@endif
								@endforeach
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</section><!--/#testimonial-->
        
        <div>
            <center>{!! $system->tag_body !!}</center>
        </div>
    </main>

    <section id="bottom" class="wet-asphalt">
        <div class="container">
            <div class="row">
                
                <div class="col-md-3 col-sm-6">
                    <h4>Company</h4>
                    <div>
                        <ul class="arrow">
                            <li><a href="{{ route('show-service',['quienes-somos']) }}">Quienes Somos</a></li>
                            <li><a href="{{ route('show-service',['politicas-condiciones']) }}">Políticas y condiciones</a></li>
                            <li><a href="{{ route('show-service',['cuentas-premium']) }}">Cuentas de pago</a></li>
                            <li><a href="{{ route('show-service',['partners']) }}">Publicidad y Partners</a></li>
                            <li><a href="{{ route('show-service',['contacts']) }}">Contactanos</a></li>
                            <li><a href="{{ route('show-service',['faq']) }}">Preguntas Frecuentes</a></li>
                        </ul>
                    </div>
                </div><!--/.col-md-3-->
                <div class="col-md-3 col-sm-6">
                    <h4>Dirección</h4>
                    <address>
                        <strong>{{ $system->direccion  }}</strong><br>
                        <abbr title="Teléfono">Tlf:</abbr> {{ $system->telefono }}
                    </address>

                </div> <!--/.col-md-3-->
                
                <div class="col-md-6 col-sm-6">
                    <h4>Nuestros servicios</h4>
                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-md-4">
                                <div class="media">
                                    <div class="pull-left">
                                        <img class="img-show-category" src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}">
                                    </div>
                                    <div class="media-body">
                                        <span class="media-heading"><a href="{{ route('show-service',[$category->slug]) }}">{{ $category->name }}</a></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>  
                </div><!--/.col-md-6-->

            </div>
        </div>
    </section><!--/#bottom-->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2017 <a target="_blank" href="#" title="Aikire">Aikire</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li>Volver</li>
                        <li><a id="gototop" class="gototop" href="#"><i class="fa fa-chevron-up"></i></a></li><!--#gototop-->
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="{{ url('js/jquery.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ url('js/main.js') }}"></script>
</body>
</html>






