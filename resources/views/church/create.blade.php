@extends('layouts.system')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 ">
            <div class="panel panel-default">
                <div class="panel-heading">Registro de iglesias</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="identification_card" class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('logintud') ? ' has-error' : '' }}">
                            <label for="logintud" class="col-md-4 control-label">Longitud</label>
                            <div class="col-md-6">
                                <input id="logintud" type="text" class="form-control" name="logintud" value="{{ old('logintud') }}" required autofocus>
                                @if ($errors->has('logintud'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('logintud') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('latitud') ? ' has-error' : '' }}">
                            <label for="latitud" class="col-md-4 control-label">Latitud</label>
                            <div class="col-md-6">
                                <input id="latitud" type="text" class="form-control" name="latitud" value="{{ old('latitud') }}" required autofocus>
                                @if ($errors->has('latitud'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('latitud') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo Electrónico</label>
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
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

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
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Regístrarte
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center">
                <video src="/videos/promo.mp4" autoplay loop controls width="500" height="400"></video>
            </div>
        </div>
    </div>
</div>
@endsection
