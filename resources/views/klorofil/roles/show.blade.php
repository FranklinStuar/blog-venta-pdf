@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">{{ $role->name }}</h3>
	<div class="panel">
		@if (Shinobi::can('permission.add'))
			<div class="panel-body">
				<div class="row">
					{!! Form::open(['route' => ['role.add-permission',$role->id],'class'=>'form-hotizontal']) !!}
							{!! Form::select('permissions[]', $permissions, null, ['class' => 'select2 form-control','multiple']) !!}
							<br>
							<button class="btn btn-primary pull-right">Agregar</button>
					{!! Form::close() !!}
				</div>
			</div>
		@endif
		<div class="panel-body">
			<div class="row">
				@foreach($permissions_role as $id => $permission)
					<div class="col-xs-6 col-sm-3">
						@if (Shinobi::can('permission.quit'))
							{!! Form::open(['route' => ['role.quit-permission',$role->id,'pId'=>$permission->id],'method'=>'POST','class'=>'destroy']) !!}
								<button class="glyphicon glyphicon-remove" ></button>
							{!! Form::close() !!}
						@endif
						{{ $permission->name }}
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection