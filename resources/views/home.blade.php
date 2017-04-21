@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Formulario de Inscripcion</div>

                <div class="panel-body">
                    @if(session('alert'))
                            <p class="alert alert-success">{{session('alert')}}</p>
                    @endif
                    @if(session('error'))
                            <p class="alert alert-danger">{{session('error')}}</p>
                    @endif
                    <form action="{{route('save-inscription')}}" method="post">
                        <div class="row text-center"> {{csrf_field()}}
                            <div class="col-md-10  text-center"><h1>Hola: {{currentUser()->nameComplete()}}</h1></div>
                            <div class="col-md-10  text-center"><h1>Tu Cédula es: {{currentUser()->identification_card}}</h1></div>
                            <div class="content-box-blue col-md-12">
                                <div class="col-md-3  text-center form-group"><label>Edad: </label><input type="text" name="age"  class="form-control" placeholder="16"></div>
                                <div class="col-md-3  text-center form-group"><label>Genero: </label>
                                    <select name="gender" class="form-control">
                                        <option value="">Seleccione un Genero</option>
                                        <option value="woman">Mujer</option>
                                        <option value="man">Hombre</option>
                                    </select>
                                </div>
                                <div class="col-md-3  text-center form-group">
                                    <label>Iglesia a la que pertenece: </label>
                                    <input type="text" name="church" class="form-control" placeholder="Quepos">
                                </div>
                                <div class="col-md-3  text-center form-group">
                                    <label>Talla de Camiseta: </label>
                                    <select name="shirt_size" class="form-control">
                                        <option value="">Seleccione una Talla</option>
                                        <option value="14">14</option>
                                        <option value="16">16</option>
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                    </select>
                                </div>
                                <div class="col-md-9  text-center form-group">
                                   <label>Lugar de Residencia: </label>
                                   <input type="text" name="address"  class="form-control" placeholder="Barrio San Martin, 500 metros sur del Aeropuerto la Managua, Quepos">
                               </div>
                                <div class="col-md-3  text-center form-group">
                                    <label>Metodo de Pago: </label>
                                    <select name="payment_method" class="form-control">
                                        <option value="">Seleccione Un Metodo</option>
                                        <option value="Transferencia">Transferencia</option>
                                        <option value="Deposito">Deposito</option>
                                        <option value="Caja ACSCR">Caja ACSCR</option>
                                    </select>
                                </div>
                                <div class="col-md-3  text-center form-group">
                                    <label>Monto Abonado: </label>
                                    <input type="text" name="amount"  class="form-control" placeholder="0.00">
                                </div>
                                <div class="col-md-3  text-center form-group">
                                    <label>N° Comprobante: </label>
                                    <input type="text" name="voucher"  class="form-control" placeholder="144657">
                                </div>
                                <div class="col-md-3  text-center form-group">
                                    <label>Banco: </label>
                                    <input type="text" name="bank"  value="Banco Nacional"  class="form-control">
                                </div>
                                <div class="col-md-12   ">
                                    <input type="submit" value="Guardar" class="btn btn-default">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
