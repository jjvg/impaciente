@extends('layouts.app')

@section('content')
<body  background="{{asset('img/medical-ConvertImage.png')}}" style="background-repeat:no-repeat">
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background:rgba(255, 255, 255,0.4);">
                <div class="panel-heading"><div class="center"><img src="{{asset('img/elimpaciente.png')}}" align="center"></div></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('genero') ? ' has-error' : '' }}">
                            <label for="genero" class="col-md-4 control-label" style="hober:box-shadow:0 1px 5px 0 #000;color:#000;"
                            >Genero</label>

                            <div class="col-md-6">
                               <select name="genero" id="genero" class="form-control">
                                   <option value="1">Masculino</option>
                                   <option value="0">Femenino</option>
                               </select>

                                @if ($errors->has('genero'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('genero') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label" style="hober:box-shadow:0 1px 5px 0 #000;color:#000;"
                            >Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label" style="hober:box-shadow:0 1px 5px 0 #000;color:#000;"
                            >Direccion de E-Mail </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label" style="hober:box-shadow:0 1px 5px 0 #000;color:#000;"
                            >Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label" style="hober:box-shadow:0 1px 5px 0 #000;color:#000;"
                            >Confirmar Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary"  style="background-color:#51bce6">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
