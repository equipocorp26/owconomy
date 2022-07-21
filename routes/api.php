<?php

use App\Http\Controllers\API\ApiBalanceController;
use App\Http\Controllers\API\ApiLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('balance',[ApiBalanceController::class,'index']);
Route::middleware(['auth'])->group(function () {
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
