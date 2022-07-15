<div class="card my-3 rounded-0 border-start border-0 border-5 border-primary bg-light">
    <div class="card-body">
        <a href="{{ route( ( !isset($reservation) ? 'movements.show' : 'reservations.show'), [$balance, $movement]) }}" class="btn btn-sm btn-primary">
            <img src="{{ asset('icons/visibility.png') }}" alt="icon show owconomy">
        </a>
        Dia: {{ $date }} - {{ $title }}
        <span class="float-end">
            <x-badge-amount amount="{{ $amount }}"></x-badge-amount>
        </span>
    </div>
</div>
