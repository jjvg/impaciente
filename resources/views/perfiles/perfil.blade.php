@extends('layouts.app')

@section('content')
	<div class="container-fluid">
	<div class="col-lg-8">
	</div>

	<div class="col-lg-4">
		<div class="panel panel-warning">
			<div class="panel-heading">

				<p class="text-center">
					{{$user->name}} Perfil
				</p>

			</div>

			<div class="panel-body">
				<center>
					<img src="{{ Storage::url($user->avatar)}}" width="140px" height="140px" style="border-radius: 50%;">
				</center>
				<br>
				<p class="text-center">
					
					<strong>De donde eres</strong>

				</p>
				<p class="text-center">
					
				{{$user->perfil->direccion}}

				</p>

				<br>
				<p class="text-center">

					@if(Auth::id() == $user->id)

							<a href="{{route('perfil.edit')}}" class="btn bnt-lg btn-warning">Editar Perfil</a>
					@endif
					
				</p>
			</div>
		</div>

		
		<div class="panel panel-success">
			<div class="panel-body">

				<friend :perfil_user_id="{{$user->id}}"></friend>

			</div>
		</div>
		
		
			<div class="panel panel-warning">
			<div class="panel-heading">

				<p class="text-center">
					Sobre mi.
				</p>

			</div>
		
			<div class="panel-body">
				
				<p class="text-center">

				{{$user->perfil->informacion}}
					
				</p>
				
			</div>
		</div>
	</div>
</div>
@stop