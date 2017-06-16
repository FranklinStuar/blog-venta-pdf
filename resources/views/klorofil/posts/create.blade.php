@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Nuevo Post</h3>
	@include('klorofil.posts.form',['url' => route('posts.store'),'method' =>"POST"])
	
@endsection

@section('script')
  <!--nicEdit-->
  <script src="{{ url('nicEdit/nicEdit.js') }}" type="text/javascript"></script>
  <script>
  $(function(){
      new nicEditor({fullPanel : true}).panelInstance('full-edit')
  })
</script>
@endsection