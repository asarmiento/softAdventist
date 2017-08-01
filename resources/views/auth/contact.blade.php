@extends('layouts.public')

@section('content')

    <div style="margin: 0 auto; width: 50%; background: #fff" class="panel-body ">
        <div class="row col-md-12 col-lg-12 text-center">
            <div class=" row col-md-12 col-lg-12">
                <div class="panel-info">
                    <strong>
                        Este sistema puede ser usado por cualquier Iglesia Adventista del
                        Septimo Día, solo debe solicitarlo por este medio con mucho gusto le
                        ayudaremos.
                    </strong>
                </div>
            </div>
            <form class="form-horizontal" role="form" method="POST" action="{{ route('contacto') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Nombre Completo</label>
                    <div class="control-group col-md-6">
                        <input id="name" type="text" class="form-control" name="name"
                               value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">Correo Electrónico</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required
                               autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('church') ? ' has-error' : '' }}">
                    <label for="church" class="col-md-4 control-label">Nombre de la Iglesia</label>
                    <div class="col-md-6">
                        <input id="church" type="text" class="form-control" name="church"
                               value="{{ old('church') }}" required autofocus>
                        @if ($errors->has('church'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('church') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('campo') ? ' has-error' : '' }}">
                    <label for="campo" class="col-md-4 control-label">Campo Local Al que pertenece</label>
                    <div class="col-md-6">
                        <input id="campo" type="text" class="form-control"  name="campo" value="{{ old('campo') }}"
                               required>
                        @if ($errors->has('campo'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('campo') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                    <label for="message" class="col-md-4 control-label">Mensaje</label>

                    <div class="col-md-6">
                        <textarea name="message" rows="5" cols="40" required></textarea>

                        @if ($errors->has('message'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>



                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Enviar
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="text-center">
        <a>Si tienes algun problema con el envio de la información nos puede contactar: info@sistemasamigables.com</a>
     </div>

@endsection
