@extends('layouts.app')

@section('content')
    @foreach ($items as $item)
        <div class="card my-4 text-white bg-responsive p-4 rounded-medium" style="background-image: url({{ asset('images/card-background.jpg') }})">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <p class="fs-5">
                            {{ $item->title }}
                        </p>
                    </div>
                    <div class="col-6 text-end ">
                        <p class="fs-3 fw-bold">
                            {{ $item->amount }}
                        </p>
                        <x-badge-amount amount="{{$item->lastMovement->amount}}"></x-badge-amount>
                    </div>
                    <div class="col-6 mt-5">
                        <a class="btn border btn-sm py-1 border-light btn-link" href="" title="Movimientos">
                            <img src="{{ asset('icons/transactions.png') }}" alt="transactions icons owconomy">
                        </a>
                        <a class="btn border btn-sm py-1 border-light btn-link" href="" title="Reservaciones">
                            <img src="{{ asset('icons/reservations.png') }}" alt="transactions icons owconomy">
                        </a>
                        <a class="btn border btn-sm py-1 border-light btn-link" href="{{ route('balances.show', $item) }}" title="Resumen del balance">
                            <img src="{{ asset('icons/balance.png') }}" alt="transactions icons owconomy">
                        </a>
                    </div>
                    <div class="col-6 mt-5 text-end">
                        <a class="btn border btn-sm py-1 border-light btn-link" href="" title="Nueva transaccion">
                            <img src="{{ asset('icons/transaction.png') }}" alt="transactions icons owconomy">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
