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
        <form action="{{ route('balances.store') }}" method="POST" class="row">
            @include('balances.partials.form')
        </form>
    </div>
@endsection
