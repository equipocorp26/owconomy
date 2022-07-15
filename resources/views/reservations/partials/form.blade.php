@csrf
<div class="col-12 text-center p-2">
    <div class="form-floating mb-3">
        <input name="title" type="text" required min="5" max="255" class="form-control" id="floatingInput"
            placeholder="mi balance #1" @isset($movement) value="{{ $movement->title }}" @endisset>
        <label for="floatingInput">Motivo</label>
    </div>
    @error('title')
        <small class="text-danger">
            {{ $message }}
        </small>
    @enderror
</div>
@if (!isset($movement))
    <div class="col-12 text-center p-2">
        <div class="form-floating mb-3">
            <input name="amount" type="number" step=".01" class="form-control" id="floatingInput"
                placeholder="monto inicial" min="-{{$balance->amount}}">
            <label for="floatingInput">Monto <small>(Si es un retiro debe ser menor a tu balance actual {{$balance->amount}})</small></label>
        </div>
        @error('amount')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>
@endif
<div class="col-6 text-center p-2 ">
    <button class="btn btn-outline-danger float-start" type="reset">Limpiar</button>
</div>
<div class="col-6 text-center p-2">
    <button class="btn btn-primary float-end" type="submit">Guardar</button>
</div>
