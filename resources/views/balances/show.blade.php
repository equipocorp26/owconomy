@extends('layouts.app')

@section('content')
    <div class="row bg-white rounded-medium p-4">
        <div class="col-12 text-center">
            <p class="fs-3">
                Hola, {{$balance->user->name}}
            </p>
            <p class="fs-5">Este es el resumen de tu balance <span class="fw-bold">{{$balance->title}}</span></p>
        </div>
        <div class="col-6 col-lg-3 text-center p-2">
            <div class="card border-0">
                <div class="card-body">
                    <img src="{{ asset('images/balance.png') }}" width="100px" alt="">
                    <span class="d-block my-3">
                        Balance general
                    </span>
                    <x-badge-amount amount="{{$balance->amount}}"></x-badge-amount>
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
                    <x-badge-amount amount="{{$balance_month}}"></x-badge-amount>
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
                    <p>{{$movements}}</p>
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
                    <p>{{$reservations}}</p>
                </div>
            </div>
        </div>
        <div class="col-12 border-top pt-5">
            <h3>Movimientos Recientes este mes</h3>
        </div>
        <div class="col-12">
            @forelse ($movements_month as $item)
                <div class="card my-3 rounded-0 border-start border-0 border-5 border-primary bg-light">
                    <div class="card-body">
                        Dia: {{$item->created_at->format('d')}} - {{$item->title}}
                        <span class="float-end"><x-badge-amount amount="{{$item->amount}}"></x-badge-amount></span>
                    </div>
                </div>
            @empty
                <p class="text-center p-4 text-muted">No hay movimientos este mes</p>
            @endforelse
            @if ($movements_month->count())
                <button class="btn btn-primary float-end">Ver Todos los movimientos</button>
            @endif
        </div>
    </div>
@endsection
