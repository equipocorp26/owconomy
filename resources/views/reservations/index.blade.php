@extends('layouts.app')

@section('content')
    <div class="row bg-white rounded-medium p-4">
        <div class="col-12 text-center">
            <img src="{{ asset('images/reservations.png') }}" width="100px" alt="">
            <p class="fs-3">
                Mis Reservaciones
            </p>
            <p class="fs-5">Estas son las reservaciones que tienes en tu balance <a
                    class="fw-bold" href="{{ route('balances.show', $balance) }}">{{ $balance->title }}</a></p>
        </div>
        <div class="col-12 d-grid gap-2 my-2">
            <a href="{{ route('reservations.create', $balance) }}" class="btn btn-primary"><img src="{{ asset('icons/plus.png') }}"  class="me-2" alt=""> Reservar un monto</a>
        </div>
        <div class="col-12">
            @forelse ($items as $item)
            <x-item-list balance="{{$balance->id}}" movement="{{$item->id}}" date="{{ $item->created_at->format('d') }}" title="{{ $item->title }}"
                amount="{{ $item->amount }}" reservation="true"></x-item-list>
            @empty
                <p class="text-center p-4 text-muted">No se encontraron reservaciones</p>
            @endforelse
            {{ $items->links() }}
        </div>
    </div>
@endsection
