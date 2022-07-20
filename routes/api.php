<?php

use App\Http\Controllers\API\ApiLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Autenticacion */
Route::get('login',[ApiLoginController::class,'login']);
Route::get('logout',[ApiLoginController::class,'logout']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
