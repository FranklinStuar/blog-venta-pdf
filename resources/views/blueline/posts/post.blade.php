@extends('blueline.layout')
@push('styles')
  <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css" media="all">
  <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen">
@endpush
@push('scripts')
  <!-- JS Files -->
  <script src="js/jquery.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/slides/slides.min.jquery.js"></script>
  <script src="js/cycle-slider/cycle.js"></script>
  <script src="js/nivo-slider/jquery.nivo.slider.js"></script>
  <script src="js/tabify/jquery.tabify.js"></script>
  <script src="js/prettyPhoto/jquery.prettyPhoto.js"></script>
  <script src="js/twitter/jquery.tweet.js"></script>
  <script src="js/scrolltop/scrolltopcontrol.js"></script>
  <script src="js/portfolio/filterable.js"></script>
  <script src="js/modernizr/modernizr-2.0.3.js"></script>
  <script src="js/easing/jquery.easing.1.3.js"></script>
  <script src="js/kwicks/jquery.kwicks-1.5.1.pack.js"></script>
  <script src="js/swfobject/swfobject.js"></script>
  <!-- FancyBox -->
  <script src="js/fancybox/jquery.fancybox-1.2.1.js"></script>
@endpush
@section('container')
  <div id="portfolio">
    @include('blueline.posts.template-post-list')
  </div>
  <div style="clear:both; height: 40px"></div>
@endsection
