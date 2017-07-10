@extends('klorofil.layout')
@section('meta')
  	<link rel="stylesheet" href="{{url('plugins/summernote/summernote.css')}}">
@endsection
@section('content')
	
	<h3 class="page-title">Editar Usuario</h3>
	@include('klorofil.posts.form',['url' => route('posts.update',['i'=>$post->id]),'method' =>"PUT",'edit'=>true])
	
@endsection

@section('script')
  
  <!-- include summernote -->
<script type="text/javascript" src="{{url('plugins/summernote/summernote.js')}}"></script>

  <script type="text/javascript">
    $(function() {
      $('.summernote').summernote({
        height: 200
      });

    });
  </script>

@endsection

