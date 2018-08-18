@extends('layouts.system')

@section('content')

                <div class="panel-body"><h1>Regístrate: <strong>En este paso solo estas creando un usuario para poder
                            ingresar al sistema, debes verificar tu email despues de registrarte, buscalo en la Bandeja de entrada o en Spam(correos no deseados)</strong></h1></div>
                <div class="panel-content panel col-lg-12">
                    
                    <form class="form-horizontal " style="margin-top: 40px" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('identification_card') ? ' has-error' : '' }}">
                            <label for="identification_card" class="col-md-4 control-label">Numero de Cédula</label>

                            <div class="col-md-6">
                                <input id="identification_card" type="text" class="form-control" name="identification_card" value="{{ old('identification_card') }}" required autofocus>

                                @if ($errors->has('identification_card'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('identification_card') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Apellidos</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
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
                        <div class="form-group{{ $errors->has('church_id') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Iglesia que Pertenece</label>

                            <div class="col-md-6">
                                <select name="church_id" class="form-control" required>
                                    <option value="">Seleccione una Iglesia</option>
                                    @foreach(\App\Entities\Church::where('type',true)->get() AS $church)
                                    <option value="{{$church->id}}">{{$church->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('church_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('church_id') }}</strong>
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

                        <div class="form-group center-block col-md-12">
                            <div class="col-md-5 ">

                            </div>
                           <div class="col-md-3 ">
                                <button type="submit" class="btn btn-primary">
                                    Regístrarte
                                </button>
                            </div>
                            <div class="col-md-3">
                                <a href="{{url('/ja')}}" class="btn btn-default">
                                    Regresar Login
                                </a>
                            </div>
                        </div>
                    </form>
                   
                </div>
            </div>
            <div class="row col-lg-12 text-center">
                <a>Si tienes algun problema con la inscripción escribenos a: jaacscr@contadventista.org</a>
    
                <!--video src="/videos/promo.mp4" autoplay loop controls width="500" height="400"></video-->
            </div>

@endsection
