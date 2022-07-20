<?php

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;


/* No Auth */
Auth::routes();
/* Auth */
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    /* BALANCES */
    Route::resource('balances', BalanceController::class)->names('balances');
    /* MOVEMENTS */
    Route::get('balances/{balance}/movements',[MovementController::class,'index'])->name('movements.index');
    Route::get('balances/{balance}/movements/create',[MovementController::class,'create'])->name('movements.create');
    Route::post('balances/{balance}/movements',[MovementController::class,'store'])->name('movements.store');
    Route::get('balances/{balance}/movements/{movement}',[MovementController::class,'show'])->name('movements.show');
    Route::delete('balances/{balance}/movements/{movement}',[MovementController::class,'destroy'])->name('movements.destroy');
    /* RESERVACIONES */
    Route::get('balance/{balance}/reservations',[ReservationController::class,'index'])->name('reservations.index');
    Route::get('balances/{balance}/reservations/create',[ReservationController::class,'create'])->name('reservations.create');
    Route::post('balances/{balance}/reservations',[ReservationController::class,'store'])->name('reservations.store');
    Route::get('balances/{balance}/reservations/{reservation}',[ReservationController::class,'show'])->name('reservations.show');
    Route::delete('balances/{balance}/reservations/{reservation}',[ReservationController::class,'destroy'])->name('reservations.destroy');
    Route::post('balances/{balance}/reservations/{reservation}',[ReservationController::class,'check'])->name('reservations.check');
});


