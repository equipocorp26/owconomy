<?php

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\MovementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/* BALANCES */
Route::resource('balances', BalanceController::class)->names('balances');
/* MOVEMENTS */
Route::get('balances/{balance}/movements',[MovementController::class,'index'])->name('movements.index');
Route::get('balances/{balance}/movements/create',[MovementController::class,'create'])->name('movements.create');
Route::post('balances/{balance}/movements',[MovementController::class,'store'])->name('movements.store');

