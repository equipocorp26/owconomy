@extends('layouts.app')

@section('content')
    <div class="row bg-white rounded-medium p-4">
        <div class="col-12 text-center">
            <img src="{{ asset('images/movements.png') }}" width="100px" alt="">
            <p class="fs-3">
                Mis Movimientos
            </p>
            <p class="fs-5">Estos son los movimientos que tienes en tu balance <span
                    class="fw-bold">{{ $balance->title }}</span></p>
        </div>
        <div class="col-12">
            <form action="{{ route('movements.index', ['balance' => $balance]) }}" class="row">
                <div class="col-md-6 my-2 col-lg-3">
                    <div class="form-floating mb-3">
                        <input name="date_start" type="date" min="5" max="255" class="form-control" id="floatingInput"
                            placeholder="Fecha" value="@if(request('this_month', null)) {{request('date_start', null)}} @endif ">
                        <label for="floatingInput">Fecha Inicio</label>
                    </div>
                    @error('date_start')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6 my-2 col-lg-3">
                    <div class="form-floating mb-3">
                        <input name="date_end" type="date" max="{{ date('Y-m-d') }}" class="form-control"
                            id="floatingInput" placeholder="Fecha" value="@if(request('this_month', null)) {{request('date_end', null)}} @endif">
                        <label for="floatingInput">Fecha Final</label>
                    </div>
                    @error('date_end')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6 my-2 col-lg-2">
                    <div class="form-floating">
                        <select required class="form-select" id="floatingSelect" name="type"
                            aria-label="Tipo de movimientos">
                            <option {{ request('type', null) === null ? 'selected' : '' }} value="null" selected>Todos</option>
                            <option {{ request('type', null) === 1 ? 'selected' : '' }} value="1">Entradas</option>
                            <option {{ request('type', null) === 0 ? 'selected' : '' }} value="0">Salidas</option>
                        </select>
                        <label for="floatingSelect">Tipo</label>
                    </div>
                    @error('type')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6 my-2 col-lg-2 text-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true"
                            {{ request('this_month', null) == true ? 'checked' : '' }} id="flexCheckDefault"
                            name="this_month">
                        <label class="form-check-label" for="flexCheckDefault">
                            Este mes
                        </label>
                    </div>
                    @error('this_month')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6 my-2 col-lg-1 text-center">
                    <a href="{{ route('movements.index', $balance) }}" type="reset" class="btn btn-danger btn-sm"><img
                            src="{{ asset('icons/clear-filter.png') }}" alt="search icon owconomy"></a>
                </div>
                <div class="col-md-6 my-2 col-lg-1 text-center">
                    <button class="btn btn-primary btn-sm"><img src="{{ asset('icons/filter.png') }}"
                            alt="search icon owconomy"></button>
                </div>
            </form>
        </div>
        <div class="col-12 d-grid gap-2 my-2">
            <a href="{{ route('movements.create', $balance) }}" class="btn btn-primary"><img src="{{ asset('icons/plus.png') }}"  class="me-2" alt=""> Agregar Movimiento</a>
        </div>
        <div class="col-12">
            @forelse ($items as $item)
                <x-item-list date="{{ $item->created_at->format('d') }}" title="{{ $item->title }}"
                    amount="{{ $item->amount }}"></x-item-list>
            @empty
                <p class="text-center p-4 text-muted">No se encontraron movimientos</p>
            @endforelse
            {{ $items->links() }}
        </div>
    </div>
@endsection
