<!DOCTYPE HTML>
<html lang="es">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>@yield('title','Sistema')</title>
  <meta charset="utf-8">
  <!-- Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />
  <!-- CSS Files -->
  <link rel="stylesheet" href="{{ url('css/style.css') }}">
  <link rel="stylesheet" href="{{ url('menu/css/simple_menu.css') }}">
  @stack('styles')
  
  @yield('google-script')
  @yield('metas')
</head>
<body>
  <header class="header">
    <div id="site_title"></div>
    <!-- Main Menu -->
    <ol id="menu">
      <li class="active_menu_item"><a href="{{url('/')}}">INICIO</a></li>
      <li class="active_menu_item">
        <!-- sub menu -->
   
      </li>
      <!-- END sub menu -->
      <li><a href="#">Servicios</a>
        <!-- sub menu -->
        <ol>
          @foreach($categories as $category)
            <li><a href="{{ route('show-category',['cID'=>$category->slug]) }}">{{ $category->name }}</a></li>
          @endforeach
          {{-- <li class="last"><a href="tableros.html">Tbablero/Odómetro</a></li> --}}
        </ol>
      </li>
      <!-- END sub menu -->
      <li></li>
      <li></li>
      {{-- <li><a href="{{url('/')}}">Elementos</a></li> --}}
      <li><a href="#">Proyectos</a>
        <!-- sub menu -->
        <ol>
          <li><a href="{{url('/')}}">Simulador ECU</a></li>
          <li class="last"><a href="https://www.youtube.com/user/cnvsevilla">Canal de Videos</a></li>
        </ol>
      </li>
      <!-- END sub menu -->
      <li><a href="contact.html">Contactos</a></li>
    </ol>
    <div align="center">
      <p><a href="{{url('/')}}"><img src="{{ url('img/demo/logo..png') }}" alt="" width="298" height="52"></a></p>
      <p>La información que hace posible encontrar tus ideas</p>
    </div>
  </header>
  <main id="container">
    @yield('container')
  </main>
  <footer id="footer">
    <!-- First Column -->
    <div class="one-fourth">
      <h3>    Enlaces útiles</h3>
      <ul class="footer_links">
        <li><a href="#">Lorem Ipsum</a></li>
        <li><a href="#">Ellem Ciet</a></li>
        <li><a href="#">Currivitas</a></li>
        <li><a href="#">Salim Aritu</a></li>
      </ul>
    </div>
    <!-- Second Column -->
    <div class="one-fourth">
      <h3>Términos</h3>
      <ul class="footer_links">
        <li><a href="#">Lorem Ipsum</a></li>
        <li><a href="#">Ellem Ciet</a></li>
        <li><a href="#">Currivitas</a></li>
        <li><a href="#">Salim Aritu</a></li>
      </ul>
    </div>
    <!-- Third Column -->
    <div class="one-fourth">
      <h3>Información</h3>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet enim id dui tincidunt vestibulum rhoncus a felis.
      <div id="social_icons"> Theme by <a href="http://www.csstemplateheaven.com">CssTemplateHeaven</a><br>
        Photos © <a href="http://dieter.no">Dieter Schneider</a> </div>
    </div>
    <!-- Fourth Column -->
    <div class="one-fourth last">
      <h3>Redes Sociales</h3>
      <img src="img/icon_fb.png" alt=""> <img src="img/icon_twitter.png" alt=""> <img src="img/icon_in.png" alt=""> </div>
    <div style="clear:both"></div>
  </footer>
  <!-- JS Files -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
  @stack('scripts')
</body>
</html>