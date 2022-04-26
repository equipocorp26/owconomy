@extends('layouts.app')

@section('content')
    <div class="row bg-white rounded-medium p-4">
        <div class="col-12 text-center">
            <img src="{{ asset('images/movements.png') }}" width="100px" alt="">
            <p class="fs-3 mt-3">
                Nuevo movimiento
            </p>
            <p class="fs-6 text-muted">Aqui puedes generar un nuevo movimiento de tu balance.</p>
        </div>
        <form action="{{ route('movements.store',$balance) }}" method="POST" class="row">
            @include('movements.partials.form')
        </form>
    </div>
@endsection
