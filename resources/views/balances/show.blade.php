@extends('layouts.app')

@section('content')
    <balances-show-component
        prop_balance_id="{{Crypt::encrypt($balance->id)}}"
    ></balances-show-component>
    {{-- <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="fs-3">
                    Hola, BALANCE <a href="#"
                        class="btn btn-primary btn-sm"><img src="{{ asset('icons/edit.png') }}" alt="edit icon owconomy"></a>
                </p>
                <p class="fs-5">Este es el resumen de tu balance <span
                        class="fw-bold">TITULO</span></p>
            </div>
        </div>
    </div>
    <div class="row bg-white rounded-medium p-4">
        <div class="col-6 col-lg-3 text-center p-2">
            <div class="card border-0">
                <div class="card-body">
                    <img src="{{ asset('images/balance.png') }}" width="100px" alt="">
                    <span class="d-block my-3">
                        Balance general
                    </span>
                    <x-badge-amount amount="{{ $balance->amount }}"></x-badge-amount>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 text-center p-2">
            <div class="card border-0">
                <div class="card-body">
                    <img src="{{ asset('images/calendar.png') }}" width="100px" alt="">
                    <span class="d-block my-3">
                        Balance del mes
                    </span>
                    <x-badge-amount amount="{{ $balance_month }}"></x-badge-amount>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 text-center p-2">
            <div class="card border-0">
                <div class="card-body">
                    <img src="{{ asset('images/movements.png') }}" width="100px" alt="">
                    <span class="d-block my-3">
                        Movimientos
                    </span>
                    <p>{{ $movements }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 text-center p-2">
            <div class="card border-0">
                <div class="card-body">
                    <img src="{{ asset('images/reservations.png') }}" width="100px" alt="">
                    <span class="d-block my-3">
                        Reservaciones
                    </span>
                    <p>{{ $reservations }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 border-top pt-5">
            <h3>Movimientos recientes este mes</h3>
        </div>
        <div class="col-12">
            <balances-show-component prop_user="{{ Crypt::encrypt(Auth::id()) }}"></balances-show-component>
            @if ($movements_month->count())
                <a href="{{ route('movements.index', $balance) }}" class="btn btn-primary float-end my-2">Movimientos</a>
            @endif
        </div>
        <div class="col-12 border-top pt-5">
            <h3>Reservaciones recientes este mes</h3>
        </div>
        <div class="col-12">
            @forelse ($reservations_month as $item)
                <x-item-list balance="{{$balance->id}}" movement="{{$item->id}}" date="{{ $item->created_at->format('d') }}" title="{{ $item->title }}"
                    amount="{{ $item->amount }}" reservation="true"></x-item-list>
            @empty
                <p class="text-center p-4 text-muted">No hay reservaciones este mes</p>
            @endforelse
            @if ($movements_month->count())
                <a href="{{ route('reservations.index', $balance) }}" class="btn btn-primary float-end my-2">Reservaciones</a>
            @endif
        </div>
        <div class="col-12 border-top pt-5">
            <h3 class="text-danger fs-5 text-muted">Eliminar balance</h3>
            <p class="text-muted fs-6 fw-light">Este proceso es irreversible y perderas todos los registros asociados a este
                balance, no afectara a los demas balances que tengas.</p>
        </div>
        <div class="col-12">
            <button class="btn btn-outline-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample">
                Eliminar balance
            </button>
            <div class="collapse mt-3" id="collapseExample">
                <form class="d-inline-block" action="{{ route('balances.destroy', $balance) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger">Eliminar</button>
                </form>
                <button class="btn btn-primary float-end" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample">
                No eliminar
            </button>
            </div>
        </div>
    </div> --}}
@endsection
