@extends('blueline.layout')

@push('scripts')
  <script src="{{ url('js/jquery.tools.min.js') }}"></script>
  <script>
    $(function () {
      $("#prod_nav ul").tabs("#panes > div", {
          effect: 'fade',
          fadeOutSpeed: 400
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      $(".pane-list li").click(function () {
          window.location = $(this).find("a").attr("href");
          return false;
      });
    });
  </script>
@endpush

@section('container')
 <!-- tab panes -->
  <div id="prod_wrapper">
    <div id="panes">
      <div> <img src="{{ url('img/demo/7.jpg') }}" alt="">
        <h1>Documentos Gratis</h1>
        <p>Nuestro compromiso nos lleva a estar en  la vanguardia de la información en tecnología; pesando en nuestros potenciales clientes, ponemos a dispocion esta seccion donde encotrara documentacion que le pueda ayudar a realizar sus tareas y procesos.
        </p>
        <p style="text-align:right; margin-right: 16px"><a href="#" class="button">Más Información</a> <a href="#" class="button">Descargar Ahora</a></p>
      </div>
    </div>
    <!-- END tab panes -->
    <div style="clear:both"></div>
    <!-- navigator -->
    <div id="prod_nav">
      <ul>
         <li><a href="javascript();"><img src="img/demo/10.jpg" alt="" width="160" height="109"><strong>Inmovilizadores de Vehículos</strong></a></li>
      </ul>
    </div>
    <!-- END navigator -->
  </div>
  <!-- END prod wrapper -->
  <section class="information-index">
    <div style="clear:both"></div>
    <div class="one-third">
      <h2>Soluciones Multidisciplinarias</h2>
      <p align="justify">Aquí encontrará una proforma de soluciones ajustadas a sus  requerimientos, siempre basados en pruebas de laboratorio y campo.</p>
      <p style="text-align:right; margin-right: 15px"><a href="#" class="button_small">Find out more</a></p>
    </div>
    <div class="one-third">
      <h2>Bienvenidos Auspiciantes</h2>
      <p align="justify">Nuestro mayor apoyo son ustedes  que hacen posible que día tras día podamos brindar un mayor y mejores números de  soluciones a nuestros clientes.</p>
      <p style="text-align:right; margin-right: 15px"><a href="#" class="button_small">Contact Us Today</a></p>
    </div>
    <div class="one-third last">
      <h2>Últimas Novedades</h2>
      <p align="justify">Aquí encontrara los últimos artículos,  esquemas y más publicados por nuestro talento humano que está a vuestro  servicio. </p>
      <p style="text-align:right; margin-right: 15px"><a href="#" class="button_small">Read Article</a></p>
    </div>
    <div style="clear:both"></div>
    <div class="box_highlight" style="margin-top:40px">
      <h2 style="text-align:center">Some kind of sales pitch goes here!</h2>
    </div>
    <div style="clear:both; height: 20px"></div>
  </section>
@endsection
