@extends('layouts.app')

@section('content')
<body background="{{asset('img/medical-ConvertImage.png')}}" style="background-repeat:no-repeat">
<div class="container">
    <div class="row">
    <br>
    <br>
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default" style="background:rgba(255, 255, 255,0.4);">
                <div class="panel-heading"><div class="center"><img src="{{asset('img/elimpaciente.png')}}" align="center"></div></div>
                <div class="panel-body" >
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label" 
                            style="hober:box-shadow:0 1px 5px 0 #000;color:#000;">Correo Electronico</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label"
                            style="hober:box-shadow:0 1px 5px 0 #000;color:#000;">Contraseña</label>
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
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label style="hober:box-shadow:0 1px 5px 0 #000;color:#000;">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-info" style="background-color:#51bce6">
                                   Ingresar
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}"><strong><font color="rgb(71, 15, 15)">
                                    ¿Has olvidado tu contraseña?</font></strong>
                                </a>
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
