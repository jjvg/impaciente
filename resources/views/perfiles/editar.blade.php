@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">Edita tu perfil</div>

                <div class="panel-body">
                    <form action="{{route('perfil.update')}}" method="post" enctype="multipart/form-data">
                        
                        {{csrf_field()}}

                        <div class="form-group">

                            <label for="avatar">Subir Avatar</label>
                            <span class="btn btn-info btn-file">
                                <input type="file" class="file" name="avatar" accept="image/*">
                            </span>

                        <div class="form-group">

                            <label for="direccion">De donde eres</label>
                            <input type="text" class="form-control" value="{{ $info->direccion }}" name="direccion" required>
                            
                        </div>

                        <div class="form-group">

                            <label for="direccion">Sobre mi</label>
                           <textarea name="informacion" id="informacion" cols="30" rows="10" class="form-control" required>{{ $info->informacion }}</textarea>
                            
                        </div>

                        <div class="form-group">

                           <p class="text-center">
                               <button class="btn btn-info btn-lg" type="submit">
                                    Guardar Cambios     
                               </button>
                           </p>     
                           
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
 
</div>

                           
@endsection
