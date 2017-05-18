<!--
 * Created by PhpStorm.
 * User: Amwar
 * Date: 21/04/2017
 * Time: 08:16 AM
-->
@extends('layouts.app')

@section('content')
    <div class="float-div">
        <div class="content-container">
            <div class="col-md-10 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Formulario de Inscripción: En este formulario registraras abonos adicionales</div>
                    <div class="panel-body">
                        @if(session('alert'))
                            <p class="alert alert-success">{{session('alert')}}</p>
                        @endif
                        @if(session('error'))
                            <p class="alert alert-danger">{{session('error')}}</p>
                        @endif
                        <div class="col-md-12  text-center"><h1>Hola: {{currentUser()->nameComplete()}}</h1></div>
                        <div class="col-md-12  text-center"><h1>Tu Cédula es: {{currentUser()->identification_card}}</h1></div>
                        <div class="col-md-12  text-center"><h1>Código: {{$youngBoy->code}}</h1></div>
                        <form action="{{route('save-registered')}}" method="post"  accept-charset="UTF-8" enctype="multipart/form-data">
                            <div class="row text-center"> {{csrf_field()}}

                                <div class="content-box-blue col-md-12">
                                    @if(emptyString($registros))
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
                                    @endif
                                    <div class="col-md-3  text-center form-group">
                                        <label>Metodo de Pago: </label>
                                        <select name="payment_method" class="form-control">
                                            <option value="">Seleccione Un Metodo</option>
                                            <option value="Transferencia">Transferencia</option>
                                            <option value="Deposito">Deposito</option>
                                            <option value="Caja ACSCR">Caja ACSCR</option>
                                        </select>
                                        @if ($errors->has('payment_method'))
                                            <span class="help-block  alert-danger">
                                        <strong>{{ $errors->first('payment_method') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3  text-center form-group">
                                        <label>Monto Abonado: </label>
                                        <input type="text" name="amount"  class="form-control" max="{{$saldo}}" value="{{old('amount')}}" placeholder="0.00">
                                        @if ($errors->has('amount'))
                                            <span class="help-block  alert-danger">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3  text-center form-group">
                                        <label>N° Comprobante: </label>
                                        <input type="text" name="voucher"  {{old('voucher')}} class="form-control" placeholder="144657">
                                        @if ($errors->has('voucher'))
                                            <span class="help-block alert-danger">
                                        <strong>{{ $errors->first('voucher') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3  text-center form-group">
                                        <label>Banco: </label>
                                        <input type="text" name="bank" {{old('bank')}}  value="Banco Nacional"  class="form-control">
                                        @if ($errors->has('bank'))
                                            <span class="help-block alert-danger">
                                        <strong>{{ $errors->first('bank') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3  text-center form-group">
                                        <label>Saldo: </label>
                                        <input type="text" name=""  value="{{number_format($saldo,2)}}" readonly class="form-control">
                                   </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Nuevo Archivo</label>
                                        <div class="col-md-6">
                                            <input type="file" class="form-control" name="file" >
                                        </div>
                                    </div>
                                    <div class="col-md-12   ">
                                        <input type="submit" value="Guardar" class="btn btn-success">
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
                </div>
                <div class="text-center">
                    <a>Si tienes algun problema con la inscripción escribenos a: jaacscr@contadventista.org</a>

                    <video src="/videos/promo.mp4" autoplay loop controls width="500" height="400"></video>
                </div>
            </div>
        </div>
    </div>
@endsection
