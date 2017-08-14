@extends('flat.layout')
@section('container')
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
            <i class="icon-angle-left"></i>
        </a>
        <a class="next hidden-xs" href="#main-slider" data-slide="next">
            <i class="icon-angle-right"></i>
        </a>
    </section><!--/#main-slider-->

    <section id="services" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="media">
                        <div class="pull-left">
                            <i class="icon-time icon-md"></i>
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
                            <i class="icon-user icon-md"></i>
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
                            <i class="icon-youtube-play icon-md"></i>
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

    <section id="recent-works">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h3>Lo último en Neurocodigo</h3>
                    <p>Esté siempre actualizado con las atividades que le brinda Neurocodigo</p>
                    <div class="btn-group">
                        <a class="btn btn-danger" href="#scroller" data-slide="prev"><i class="icon-angle-left"></i></a>
                        <a class="btn btn-danger" href="#scroller" data-slide="next"><i class="icon-angle-right"></i></a>
                    </div>
                    <p class="gap"></p>
                </div>
                <div class="col-md-9">
                    <div id="scroller" class="carousel slide">
                        <div class="carousel-inner">
                            @foreach($posts as $index => $post)
                                @if($index == 0 || ($index%3)==0)
                                    <div class="item @if($index == 0) active @endif">
                                        <div class="row">
                                @endif
                                            <div class="col-xs-4">
                                                <div class="portfolio-item">
                                                    <div class="item-inner">
                                                        <img class="img-responsive" src="{{ url('storage/'.$post->image) }}" alt="">
                                                        <h5>
                                                            {{ $post->title }}
                                                        </h5>
                                                        <div class="overlay">
                                                            <a class="preview btn btn-danger" title="{{ $post->excerpt }}" href="{{ url('storage/'.$post->image) }}" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>   

                                @if((($index+1)%3)==0)
                                        </div><!--/.row-->
                                    </div><!--/.item-->
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div><!--/.row-->
        </div>
    </section><!--/#recent-works-->

    <section id="testimonial" class="alizarin">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="center">
                        <h2>Nuestros patrocinadores</h2>
                        <p>Neurocodigo crece ayudando a sus clientes, por ese motivo se ha decidido brindar un espacio para que sus clientes se promocionen obteniendo beneficios extras al formar parte de la comunidad del crecimiento</p>
                    </div>
                    <div class="gap"></div>
                    <div  class="carousel slide">
                        <div class="carousel-inner">
                            @foreach($posts as $index => $post)
                                @if($index == 0 || ($index%6)==0)
                                    <div class="item @if($index == 0) active @endif">
                                        <div class="row">
                                            @endif
                                            <div class="col-xs-2">
                                                <img class="img-responsive" src="{{ url('storage/'.$post->image) }}" alt="">
                                                {{-- codigo para abrir la publicidad --}}
                                            </div>   

                                            @if((($index+1)%6)==0)
                                        </div><!--/.row-->
                                    </div><!--/.item-->
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <center>publicidad de google</center>
                </div>
            </div>
        </div>
    </section><!--/#testimonial-->
@endsection
