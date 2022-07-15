@extends('layouts.app')

@section('content')
    <div class="row bg-white rounded-medium p-4">
        <div class="col-12 text-center">
            <p class="fs-3">
                Detalles del movimiento
            </p>
            <p class="fs-5">Balance <a class="fw-bold"
                    href="{{ route('balances.show', $balance) }}">{{ $balance->title }}</a></p>
        </div>
        <div class="col-12 my-2 py-2">
            <x-badge-amount amount="{{ $movement->amount }}"></x-badge-amount>
        </div>
        <div class="col-12 my-2 py-2">
            <span class="text-muted">Motivo: {{ $movement->title }}</span>
        </div>
        <div class="col-12 my-2 py-2">
            <span class="text-muted">Detalles: {{ $movement->detail }}</span>
        </div>
        <div class="col-12 my-2">
            <button class="btn btn-outline-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample">
                Eliminar movimiento
            </button>
            <div class="collapse mt-3" id="collapseExample">
                <form class="d-inline-block" action="{{ route('movements.destroy', [$balance,$movement]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger">Eliminar</button>
                </form>
                <button class="btn btn-primary float-end" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    No eliminar
                </button>
            </div>
        </div>
    </div>
@endsection
