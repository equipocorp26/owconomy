<?php

use App\Http\Controllers\API\ApiBalanceController;
use App\Http\Controllers\API\ApiCurrencyController;
use App\Http\Controllers\API\ApiLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Balances */
Route::get('balances',[ApiBalanceController::class,'index']);
Route::post('balances',[ApiBalanceController::class,'store']);
Route::get('balances/{balance}',[ApiBalanceController::class,'show']);
Route::put('balances/{balance}',[ApiBalanceController::class,'update']);
/* Currency */
Route::get('currencies',[ApiCurrencyController::class,'index']);
Route::middleware(['auth'])->group(function () {
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
