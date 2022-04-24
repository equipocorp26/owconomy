@extends('layouts.app')

@section('content')
    <div class="row bg-white rounded-medium p-4">
        <div class="col-12 text-center">
            <img src="{{ asset('images/balance.png') }}" width="100px" alt="">
            <p class="fs-3 mt-3">
                Nuevo balance
            </p>
            <p class="fs-6 text-muted">Aqui puedes generar un nuevo balance y tener separadas tus cuentas segun tus
                necesidades.</p>
        </div>
        <form action="" class="row">
            <div class="col-12 text-center p-2">
                <div class="form-floating mb-3">
                    <input type="text" required min="5" max="255" class="form-control" id="floatingInput" placeholder="mi balance #1">
                    <label for="floatingInput">Nombre del balance</label>
                </div>
            </div>
            <div class="col-12 text-center p-2">
                <div class="form-floating mb-3">
                    <input type="number" step=".01" min="0" class="form-control" id="floatingInput" placeholder="monto inicial">
                    <label for="floatingInput">Monto inicial <small>(Opcional)</small></label>
                </div>
            </div>
            <div class="col-6 text-center p-2 ">
                <button class="btn btn-outline-danger float-start" type="reset">Limpiar</button>
            </div>
            <div class="col-6 text-center p-2">
                <button class="btn btn-primary float-end" type="reset">Guardar</button>
            </div>
        </form>
    </div>
@endsection
