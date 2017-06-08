@extends('layouts.system')

@section('content')
<div class="panel-body">
                        @if(session('alert'))
                            <p class="alert alert-success">{{session('alert')}}</p>
                        @endif
                        @if(session('error'))
                            <p class="alert alert-danger">{{session('error')}}</p>
                        @endif
                        <div class="col-md-12  text-center"><h1>Hola: {{currentUser()->nameComplete()}}</h1></div>
                        <div class="col-md-12  text-center"><h1>Tu Cédula es: {{currentUser()->identification_card}}</h1></div>
                        <form action="{{route('save-inscription')}}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                            <div class="row text-center"> {{csrf_field()}}
                                <div class="content-box-blue col-md-12">
                                    <div class="col-md-4  text-center form-group"><label>Código: </label>
                                        <input type="text" name="code" readonly="readonly"  class="form-control" value="{{ $code}}">
                                        <input type="hidden" name="code" readonly="readonly"  class="form-control" value="{{ $code}}">
                                    </div>
                                    <div class="col-md-4  text-center form-group"><label>Fecha de Nacimiento: </label>
                                        <input type="date" name="birthdate"  class="form-control"  value="{{old('birthdate')}}"  placeholder="0000-00-00">
                                        @if ($errors->has('birthdate'))
                                            <span class="help-block  alert-danger">
                                        <strong>{{ $errors->first('birthdate') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4  text-center form-group"><label>Genero: </label>
                                        <select name="gender" class="form-control">
                                            <option value="">Seleccione un Genero</option>
                                            <option value="woman" @if (\Illuminate\Support\Facades\Input::old('gender') == 'woman') selected="selected" @endif>Mujer</option>
                                            <option value="man" @if (\Illuminate\Support\Facades\Input::old('gender') == 'man') selected="selected" @endif>Hombre</option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="help-block  alert-danger">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-5  text-center form-group">
                                        <label>Iglesia a la que pertenece: </label>
                                        <input type="text" name="church" class="form-control"  value="{{old('amount')}}"  placeholder="Quepos">
                                        @if ($errors->has('church'))
                                            <span class="help-block  alert-danger">
                                        <strong>{{ $errors->first('church') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-5  text-center form-group">
                                        <label>Talla de Camiseta: </label>
                                        <select name="shirt_size" class="form-control">
                                            <option value="">Seleccione una Talla</option>
                                            <option value="14" @if (\Illuminate\Support\Facades\Input::old('shirt_size') == '14') selected="selected" @endif>14</option>
                                            <option value="16" @if (\Illuminate\Support\Facades\Input::old('shirt_size') == '16') selected="selected" @endif>16</option>
                                            <option value="XS" @if (\Illuminate\Support\Facades\Input::old('shirt_size') == 'XS') selected="selected" @endif>XS</option>
                                            <option value="S" @if (\Illuminate\Support\Facades\Input::old('shirt_size') == 'S') selected="selected" @endif>S</option>
                                            <option value="M" @if (\Illuminate\Support\Facades\Input::old('shirt_size') == 'M') selected="selected" @endif>M</option>
                                            <option value="L" @if (\Illuminate\Support\Facades\Input::old('shirt_size') == 'L') selected="selected" @endif>L</option>
                                            <option value="XL" @if (\Illuminate\Support\Facades\Input::old('shirt_size') == 'XL') selected="selected" @endif>XL</option>
                                            <option value="XXL" @if (\Illuminate\Support\Facades\Input::old('shirt_size') == 'XXL') selected="selected" @endif>XXL</option>
                                        </select>
                                        @if ($errors->has('shirt_size'))
                                            <span class="help-block  alert-danger">
                                        <strong>{{ $errors->first('shirt_size') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-12  text-center form-group">
                                        <label>Lugar de Residencia: </label>
                                        <input type="text" name="address"  class="form-control"  value="{{old('address')}}"  placeholder="Barrio San Martin, 500 metros sur del Aeropuerto la Managua, Quepos">
                                        @if ($errors->has('address'))
                                            <span class="help-block  alert-danger">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4  text-center form-group">
                                        <label>Metodo de Pago: </label>
                                        <select name="payment_method" class="form-control">
                                            <option value="">Seleccione Un Metodo</option>
                                            <option value="Transferencia" @if (\Illuminate\Support\Facades\Input::old('payment_method') == 'Transferencia') selected="selected" @endif>Transferencia</option>
                                            <option value="Deposito" @if (\Illuminate\Support\Facades\Input::old('payment_method') == 'Deposito') selected="selected" @endif>Deposito</option>
                                            <option value="Caja ACSCR" @if (\Illuminate\Support\Facades\Input::old('payment_method') == 'Caja ACSCR') selected="selected" @endif>Caja ACSCR</option>
                                        </select>
                                        @if ($errors->has('payment_method'))
                                            <span class="help-block  alert-danger">
                                        <strong>{{ $errors->first('payment_method') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4  text-center form-group">
                                        <label>Monto Abonado: </label>
                                        <input type="number" name="amount"  class="form-control" max="{{$saldo}}" value="{{old('amount')}}" placeholder="8500">
                                        @if ($errors->has('amount'))
                                            <span class="help-block  alert-danger">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4  text-center form-group">
                                        <label>N° Comprobante: </label>
                                        <input type="text" name="voucher"  {{old('voucher')}} class="form-control" placeholder="144657">
                                        @if ($errors->has('voucher'))
                                            <span class="help-block alert-danger">
                                        <strong>{{ $errors->first('voucher') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4  text-center form-group">
                                        <label>Banco: </label>
                                        <input type="text" name="bank" {{old('bank')}}  value="Banco Nacional"  class="form-control">
                                        @if ($errors->has('bank'))
                                            <span class="help-block alert-danger">
                                        <strong>{{ $errors->first('bank') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4  text-center form-group">
                                        <label>Saldo: </label>
                                        <input type="text" name=""  value="{{number_format($saldo,2)}}" readonly class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Imagen del Deposito</label>
                                        <div class="col-md-6">
                                            <input type="file" class="form-control" name="file" >
                                        </div>
                                    </div>
                                    <div class="col-md-12   ">
                                        <input type="submit" value="Guardar" class="btn btn-default">

                                    </div>
                                </div>
                            </div>
                        </form>
                        <div>
                            <table class="table tab-content">
                                <thead>
                                <th>Comprobante</th>
                                <th>fecha</th>
                                <th>Monto</th>
                                </thead>
                                <tbody>
                                @foreach($registros AS $registro)
                                    <tr>
                                        <td>{{$registro->voucher}}</td>
                                        <td>{{$registro->date}}</td>
                                        <td>{{$registro->amount}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

@endsection