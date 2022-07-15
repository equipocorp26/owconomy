@extends('layouts.app')

@section('content')
    <div class="row bg-white rounded-medium p-4">
        <div class="col-12 text-center">
            <img src="{{ asset('images/reservations.png') }}" width="100px" alt="">
            <p class="fs-3 mt-3">
                Nueva reservacion
            </p>
            <p class="fs-6 text-muted">Aqui puedes reservar un monto de tu balance.</p>
        </div>
        <form action="{{ route('reservations.store',$balance) }}" method="POST" class="row">
            @include('reservations.partials.form')
        </form>
    </div>
@endsection
