@extends('layouts.app')

@section('content')
    <div class="row bg-white rounded-medium p-4">
        <div class="col-12 text-center">
            <img src="{{ asset('images/balance.png') }}" width="100px" alt="">
            <p class="fs-3 mt-3">
                Editar balance
            </p>
            <p class="fs-6 text-muted">Puedes modificar el titulo del balance.</p>
        </div>
        <form action="{{ route('balances.update',$balance) }}" method="POST" class="row">
            @method('PUT')
            @include('balances.partials.form')
        </form>
    </div>
@endsection
